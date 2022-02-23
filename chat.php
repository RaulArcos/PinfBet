<?php
    // Inicializa la sesión
    session_start();
    
    // Comprueba si el usuario esta logueado
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
    {
        header("location: login.php");
        exit;
    }

    $user_actual = $_SESSION['id']; // ID usuario cliente
    $user_otro = $_GET['id'];   // ID usuario con el que se chatea

    $link = mysqli_connect("localhost", "root", "", "pinf");

    // Comprobar si el usuario del ID introducido es amigo del cliente
    $comprobar_amistad = "SELECT * FROM amistades WHERE usuario1 = '$user_actual' AND usuario2 = '$user_otro' AND amigos = 1";

    if (mysqli_num_rows(mysqli_query($link, $comprobar_amistad)) == 0)    // Si no son amigos se devuelve al main
    {
        mysqli_close($link);
        header("location: main.php");
    }
    else
    {
?>
<!DOCTYPE html>
<html lang="es">
<head>
<link rel="icon" type="image/x-icon" href="images/MonedaFinal-ConvertImage.ico" />  
    <title>5&Bet - Chat</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/all.css" > <!-- Iconos de FontAwesome -->
    <link rel="stylesheet" href="css/principal.css">
    <link rel="stylesheet" href="css/social.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="css/social2.css">
    <script src = "js/jquery-3.5.1.js"></script>

    <script type = "text/javascript">

        $(document).ready(function() {

            setInterval (cargar_log, 500);  // Recarga el registro del chat cada 500ms

            // Solicita el registro del chat
            function cargar_log()
            {
                var datos = {user_actual:<?php echo $user_actual; ?>,   // Se envían las IDs del cliente
                    user_otro:<?php echo $user_otro; ?>}        // y el usuario con el que se chatea

                $.get("procesarchat.php", datos, mostrar_chat); // Solicita los datos
            }

            // Muestra la conversación en el contenedor
            function mostrar_chat(datos_rec)
            {
                $("#caja_chat").html(datos_rec);
            }

            // Envía los mensajes del usuario cliente al servidor
            $("#formulario").submit(function(event) {

                event.preventDefault(); // Cancela el comportamiento predeterminado del formulario

                var datos_env = $(this).serialize();    // Envuelve los datos del formulario

                $.post("procesarchat.php", datos_env);  // Envía los datos

                $("#mensaje").val("");  // Limpia el campo texto del formulario

            });
        })

        //Load the file containing the chat log
	    function loadLog(){		
		var oldscrollHeight = $("#caja_chat").attr("scrollHeight") - 20; //Scroll height before the request
		$.ajax({
			success: function(cargar_log){		
				$("#caja_chat").html(datos_rec); //Insert chat log into the #chatbox div	
				
				//Auto-scroll			
				var newscrollHeight = $("#caja_chat").attr("scrollHeight") - 20; //Scroll height after the request
				if(newscrollHeight > oldscrollHeight){
					$("#caja_chat").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
				}				
		  	},
		});
	}

        // Para evitar el reenvío de formularios al actualizar o moverse por las páginas
        if (window.history.replaceState)
        {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>
<body>
                
    <!-- Barra de navegación -->
    <?php include "barra_navegacion.php"; ?>

        <div class="CajaChat"> 
            <a href="index.php"><img src="images/logo.png" class="avatar" alt="Imagen Avatar"></a>             
            <h1>Chat</h1>
    <?php
            $username_otro = mysqli_fetch_array(mysqli_query($link, "SELECT username FROM users WHERE id = '$user_otro'"))['username'];
    ?>
            Chateando con <i><a href = "main.php?id=<?php echo $user_otro; ?>" target = "_self"><?php echo $username_otro; ?></a></i>;

            <!-- Contenedor de conversación -->
            <div class = "Conversacion" id = "caja_chat"></div>
            <br>
            <h2>Escribe a continuación</h2>
            <!-- Formulario de envío -->
            <form id = "formulario" method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $user_otro; ?>">
                <input type = "text" id = "mensaje" name = "mensaje" placeholder = "Escribe tu mensaje..." value = "">
                <input type = "hidden" id = "user_actual" name = "user_actual" value = "<?php echo $user_actual; ?>">
                <input type = "hidden" id = "user_otro" name = "user_otro" value = "<?php echo $user_otro; ?>">
                <input type = "submit" value = "Enviar">
                <div class="form-group">
                    <p><a href="main.php" class="boton">Volver</a></p>
                </div>
            </form>
        </div>
</body>
</html>

<?php
    }
?>

