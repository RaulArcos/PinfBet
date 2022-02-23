<?php
include_once 'config.php';
$id_user = $_SESSION['id']; // id del usuario cuya sesion esta iniciada.

$qRes = "SELECT * FROM users WHERE id = $id_user";
$qQuery = mysqli_query($link,$qRes);    

//Descargamos todos los datos de la base de datos.

$mostrar = mysqli_fetch_array($qQuery);

// Usuario cliente
// Ponemos los parametros con sus respectivos valores.
$_SESSION["loggedin"] = true;
$name_user = $_SESSION["name"] = $mostrar["name"];
$username_user = $_SESSION["username"] =$mostrar["username"];                           
$created_at_user = $_SESSION["created_at"] =  $mostrar["created_at"];
$pinfcoins_user = $_SESSION["pinfcoins"] = $mostrar["pinfcoins"];
$profile_image_user = $_SESSION["profile_image"] = $mostrar["profile_image"];
$bio_user = $_SESSION["bio"] = $mostrar["bio"];
$privacidad_user = $_SESSION["privacidad"] = $mostrar["privacidad"];

// Ejecuta la orden

// Usuario específico
if (isset($_GET['id']))
{
        $id = $_GET['id'];

        if ($id == $_SESSION['id'])     header("location: main.php");

        $datos_sql = "SELECT * FROM users WHERE id = $id";
        $datos_consulta = mysqli_query($link, $datos_sql);

        if (mysqli_num_rows($datos_consulta) > 0)        //Si el id introducido existe
        {
                $datos = mysqli_fetch_array($datos_consulta);

                // Sobreescribir variables con las del usuario específico
                $id_user = $id;
                $name_user = $datos['name'];
                $username_user = $datos['username'];
                $created_at_user = $datos['created_at'];
                $pinfcoins_user = $datos['pinfcoins'];
                $profile_image_user = $datos['profile_image'];
                $bio_user = $datos['bio'];
                $privacidad_user = $datos['privacidad'];

        }
        else    header("location: main.php");   // Si el id introducido no existe
}

?>