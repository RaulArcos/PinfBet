<?php
    // Initialize the session
    session_start();
    
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }

    if (isset($_GET['p']) && ($_GET['p'] == 0 || $_GET['p'] == 1))
    {
        $_SESSION['privacidad'] = $privacidad = $_GET['p'];
        $id = $_SESSION['id'];
        $link = mysqli_connect("localhost", "root", "", "pinf");

        mysqli_query($link, "UPDATE users SET privacidad = '$privacidad' WHERE id = $id");
    }
    include_once "actualizardatos.php"; 
?>
 
<!DOCTYPE html>
<html lang="es">
    <head>
        <link rel="icon" type="image/x-icon" href="images/MonedaFinal-ConvertImage.ico" />  
        <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>5&Bet - Perfil</title>
        <link rel="shortcut icon" href="" type="image/x-icon" />
        <link rel="apple-touch-icon" href="">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="css/registro.css">
        <link rel="stylesheet" href="css/colors.css">	
        <link rel="stylesheet" href="css/versions.css">
        <link rel="stylesheet" href="css/responsive.css">
        <link rel="stylesheet" href="css/custom.css">
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
   </head>

    <body>
        <div class="control-usuario">
            <a><img src="<?php echo 'imagenesperfil/' . $_SESSION["profile_image"] ?>" class="avatar" alt="Imagen Avatar"></a>
                <h1>Hola <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>, este es tu perfil.</h1>

                <h3 style="color: #337ab7;">Privacidad:
                    <?php if ($_SESSION['privacidad']) { ?>
                        <span style="color: #d8302f"> Privado <i class="fas fa-lock"></i></span>
                    <?php } else { ?>
                        <span style="color: lime"> Publico <i class="fas fa-lock-open"></i></span>
                    <?php } ?>
                </h3>
                <hr>

                    <p><i class="fas fa-user-circle"></i><span style="color: #337ab7; font-size: 16px; font-weight: 600"> Nombre: </span> <?php echo $_SESSION["name"];?></p>
                    <p><i class="fas fa-coins"></i></i><span style="color: #337ab7; font-size: 16px; font-weight: 600"> Creditos: </span> <?php echo $_SESSION["pinfcoins"];?> PinfCoins</p>
                    <p><i class="fas fa-comment"></i><span style="color: #337ab7; font-size: 16px; font-weight: 600"> Bio: </span> "<?php echo $_SESSION["bio"];?>"</p>
                
            <p>
                <div class="Links">
                    <a href = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?p=" . (($_SESSION['privacidad']) ? "0" : "1"); ?>" class = "btn2 btn-warning">Cambiar privacidad</a>
                    <a href="reset-password.php" class="btn2 btn-warning">Cambiar contraseña</a>
                    <a href="form.php" class="btn2 btn-warning">Editar perfil</a>
                    <a href="logout.php" class="btn2 btn-danger">Cerrar sesión</a>
                    <a href="main.php" class="btn2 btn-primary">Volver</a>
                </div>
            </p>
        </div>
    </body>
</html>