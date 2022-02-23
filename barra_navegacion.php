<?php
    $user_actual = $_SESSION['id']; // Usuario cliente

    /* Bloque comprobar notificaciones */
    $contador_notis = 0;
    $bandera_solicitudes = false; // Bandera solicitudes de amistad

    $enlace = mysqli_connect("localhost", "root", "", "pinf");
  
    // Comprobar solicitudes de amistad pendientes
    $comprobar_solicitudes = "SELECT * FROM amistades WHERE usuario2 = '$user_actual' and solicitud = 1 and amigos = 0";
    $comprobar_consulta = mysqli_query($enlace, $comprobar_solicitudes);
  
    if (($numero_solicitudes = mysqli_num_rows($comprobar_consulta)) > 0) // Si hay solicitudes
    {
      $bandera_solicitudes = true;
      $contador_notis += $numero_solicitudes;
    }
    /* Fin bloque notificaciones */

    mysqli_close($enlace);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <link rel="stylesheet" href="css/BarraNavegacion.css">
</head>
<body>
  <!-- Navbar -->
  <nav class="navegacion">
    <ol>
      <li class="navegacion-item elemento"><a href="main.php" style="text-decoration:none;"><img src="images/logo.png" class="avatar" alt="Imagen Avatar"></li>
      <li class="navegacion-item"><a href="apuesta.php" title="Apostar"><i class="fas fa-coins w3-margin-right"></i>Apostar</a></li>
      <li class="navegacion-item"><a href="rankingmain.php" title="Ranking"><i class="fas fa-list-ol w3-margin-right"></i>Ranking</a></li>
      <li class="navegacion-item"><a href="social.php" title="Social"><i class="fas fa-grin-wink w3-margin-right"></i>Social</a></li>
    
      <!-- Bloque notificaciones -->
      <?php
        if ($contador_notis > 0)
        {
      ?>
        <li class="navegacion-item">
          <a><i class="fas fa-envelope w3-margin-right"></i>Notificaciones</a>
            <span class="w3-badge w3-right w3-small w3-deep-orange">
              <?php echo $contador_notis; ?>
            </span>
            <ol class="sub-navegacion">
              <?php
                if ($bandera_solicitudes)
                {
              ?>
                <li class="navegacion-item"><a href="social.php">
                  <?php if ($numero_solicitudes == 1) {?>Nueva solicitud de amistad</a></li>
                  <?php }else{ echo $numero_solicitudes;?> nuevas solicitudes de amistad</a></li>
              <?php
                  }
                }
              ?>
            </ol>
        </li>
      <?php
        }
        else
        {
      ?>
        <li class="navegacion-item"><a><i class="far fa-envelope-open w3-margin-right"></i>Notificaciones</li></a>
      <?php
        }
      ?>
      <!-- Fin bloque notificaciones -->
      
      <li class="navegacion-item elemento-perfil"><a href="perfil.php" title="Mi cuenta">
        <?php echo $_SESSION["username"]?>
        <img src="<?php echo 'imagenesperfil/' . $_SESSION["profile_image"] ?>" class="w3-circle w3-margin-left" style="width:25px; height:25px;" alt="Mi avatar"></a>
      </li>
    </ol>
  </nav>
</body>