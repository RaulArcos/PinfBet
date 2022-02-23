<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET")    // Solicitud de registro de chat
    {
        $user_actual = $_GET['user_actual'];    // ID del cliente
        $user_otro = $_GET['user_otro'];        // ID del usuario con el que se chatea

        $enlace = mysqli_connect("localhost", "root", "", "pinf");

        // Se comprueba si existe una conversación
        $chat_consulta = mysqli_query($enlace, "SELECT id_chat FROM chats WHERE (usuario1 = '$user_actual' AND usuario2 = '$user_otro') OR (usuario1 = '$user_otro' AND usuario2 = '$user_actual')");

        if (mysqli_num_rows($chat_consulta) > 0)
        {
            $id_chat = mysqli_fetch_array($chat_consulta)['id_chat'];

            $chat = fopen($id_chat . ".txt", "r");  // Apertura del fichero conversación
            $log = "";

            while (!feof($chat))
            {
                $log .= fgets($chat) . "<br>";  // Lectura de todo el fichero
            }

            fclose($chat);
            mysqli_close($enlace);

            echo $log;
        }
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST")  // Envío de mensajes
    {
        $user_actual = $_POST['user_actual'];   // ID del usuario cliente
        $user_otro = $_POST['user_otro'];       // ID del usuario con el que se chatea
        $msj = $_POST['mensaje'];               // Mensaje enviado

        $enlace = mysqli_connect("localhost", "root", "", "pinf");

        // Se comprueba si ya existe una conversación
        $chat_consulta = mysqli_query($enlace, "SELECT id_chat FROM chats WHERE (usuario1 = '$user_actual' AND usuario2 = '$user_otro') OR (usuario1 = '$user_otro' AND usuario2 = '$user_actual')");

        // Si no existe conversación se registra una nueva en la base de datos y se obtiene su ID
        if (mysqli_num_rows($chat_consulta) == 0)
        {
            mysqli_query($enlace, "INSERT INTO chats (usuario1, usuario2) VALUES ('$user_actual', '$user_otro')");
            $chat_consulta = mysqli_query($enlace, "SELECT id_chat FROM chats WHERE usuario1 = '$user_actual' AND usuario2 = '$user_otro'");
        }

        $id_chat = mysqli_fetch_array($chat_consulta)['id_chat'];

        // Búsqueda del nombre de usuario del cliente
        $nombre_user_actual = mysqli_fetch_array(mysqli_query($enlace, "SELECT username FROM users WHERE id = '$user_actual'"))['username'];

        mysqli_close($enlace);

        // Apertura/creación del fichero conversación e inserción del mensaje
        $chat = fopen($id_chat . ".txt", "a");
        fwrite($chat, "<i>(" . date("d/m/Y H:i:s") . ")</i> <b>" . $nombre_user_actual . "</b>: " . $msj . "\n");
        fclose($chat);
    }
?>