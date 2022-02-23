<?php
// Initialize the session
session_start();


// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

include_once "actualizardatos.php";


$user_actual = $_SESSION['id']; // Usuario cliente

/* Consultar si el usuario que hay en pantalla es amigo del cliente */
$amigos_sql = "SELECT * FROM amistades WHERE usuario1 = '$user_actual' AND usuario2 = '$id_user' AND amigos = 1";
$amigos_consulta = mysqli_query($link, $amigos_sql);

if (mysqli_num_rows($amigos_consulta) > 0) $amigos = true;
else $amigos = false;
?>


<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/x-icon" href="images/MonedaFinal-ConvertImage.ico" />
    <title>5&Bet - Menu Principal</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/all.css"> <!-- Iconos de FontAwesome -->
    <link rel="stylesheet" href="css/principal.css">
    <link rel="stylesheet" href="css/muro.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="css/social2.css">
</head>

<body class="main">

    <?php include "barra_navegacion.php"; ?>

    <!-- Page Container -->
    <div style="margin-top:70px; width:100%">
        <div class="w3-col w3-container m3 l3">
            <div class="CajaPerfil w3-padding">
                <h1 class="w3-center"><b><?php echo htmlspecialchars($username_user); ?></b> <?php if ($privacidad_user) { ?><i class="fas fa-lock" title="Este perfil es privado"></i><?php } ?></h1>
                <p class="w3-center"><img src="<?php echo 'imagenesperfil/' . $profile_image_user ?>" width="90" height="90" alt=""></p>
                <p><i class="fas fa-user-circle fa-fw"></i><span style="color: #337ab7; font-size: 16px; font-weight: 600"> Nombre: </span><?php echo $name_user; ?></p>
                <?php
                if($pinfcoins_user == 0 && $id_user == $_SESSION['id']){ ?>
                    <p><i class="fas fa-coins fa-fw"></i><span style="color: #337ab7; font-size: 16px; font-weight: 600"> Tienes 0 PinfCoins...</p>
                    <p><a href="expediente.php" class="coins btn btn-danger">Sube tu expediente y empieza a apostar</a></p>
                <?php
                } else {?>
                    <p><i class="fas fa-coins fa-fw"></i><span style="color: #337ab7; font-size: 16px; font-weight: 600"> Creditos: </span><?php echo $pinfcoins_user;?> PinfCoins</p>
                <?php
                }
                ?>
                <p><i class="fas fa-comment-dots fa-fw"></i><span style="color: #337ab7; font-size: 16px; font-weight: 600"> Bio: </span><?php echo $bio_user; ?></p>
            </div>
            <div>
                <?php include "lista_amigos.php"; ?>
            </div>
        </div>
        <div class="w3-col w3-container m4 l6">
            <div class="CajaPerfil w3-padding" style="max-height:600px;">
                <h2><b>Últimas Apuestas</b></h2>
                <?php require __DIR__ . '/actualizarapuesta.php'; ?>
            </div>
        </div>
        <div class="w3-col w3-container m3 l3">
            <?php include "muros.php"; ?>
        </div>
    </div>
    <script>
        // Accordion
        function myFunction(id) {
            var x = document.getElementById(id);
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
                x.previousElementSibling.className += " w3-theme-d1";
            } else {
                x.className = x.className.replace("w3-show", "");
                x.previousElementSibling.className =
                    x.previousElementSibling.className.replace(" w3-theme-d1", "");
            }
        }

        // Used to toggle the menu on smaller screens when clicking on the menu button
        function openNav() {
            var x = document.getElementById("navDemo");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }
    </script>

</body>

</html>