<?php
// Initialize the session
session_start();
header('Content-Type: text/html; charset=UTF-8');
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
    header("location: login.php");
    exit;
}
include_once "config.php";

$query = mysqli_query($link,"SELECT id_apuesta,nombre FROM apuestasdisponibles");
$id_user = $_SESSION['id']; // id del usuario cuya sesion esta iniciada.

// Consultar pinfcoins actuales
$pinfcoins_array = mysqli_fetch_array(mysqli_query($link, "SELECT pinfcoins FROM users WHERE '$id_user' = id"));
$pinfcoins = $pinfcoins_array['pinfcoins'];

$id_apuesta = $cantidad = $resultado = $cod_apuesta = "";
$cantidad_err = "";

$user_actual = $_SESSION['id'];
$amigos_consulta = mysqli_query($link, "SELECT id, username FROM users, amistades WHERE usuario1 = '$user_actual' AND usuario2 = id AND amigos = 1");


if(isset($_POST['id_apuesta']))
{
   $id_apuesta = $_POST['id_apuesta'];
   $id_apostado = $_POST['objetivo'];

   $numero =$id_apuesta; //Con esto sabremos la longitud de la id de apuesta para general el codigo de apuesta.
   $numero2 = $id_apostado;
    $id_apuesta_long = 1;
    $id_apostado_long = 1;
    do{
	    $numero = floor($numero / 10);
        $id_apuesta_long = $id_apuesta_long*10;
    } while ($numero > 0);
    do{
        $numero2 = floor($numero2/10);
        $id_apostado_long = $id_apostado_long*10;
    }while($numero2 > 0);

    $cod_apuesta = ($id_user * $id_apuesta_long) + $id_apuesta; //Con esto, deberiamos tener siempre un código único, por ejemplo, usuario 154 y cod apuesta 3.
    $cod_apuesta = ($cod_apuesta * $id_apostado_long)+ $id_apostado;
    // cod apuesta = (154 * 100 * 10)+3, por lo que tendriamos 154003
   
}

// Validamos que la cantidad introducida sea real, un numero y este entre el 1 y el 50
if(empty ($_POST["cantidad"])){
    $cantidad_err = "Introduce una cantidad real";     
} elseif($_POST["cantidad"] >=1 && $_POST["cantidad"] <= 50 && is_numeric($_POST["cantidad"])){
    $cantidad = $_POST["cantidad"];
} else{
    $cantidad_err = "Introduce un valor numérico superior a 0 hasta un máximo de 50."; 
}

if($cantidad>$pinfcoins)
{
    $cantidad_err = "No tienes suficientes Pinfcoins. Tienes $pinfcoins PinfCoins";
}

if(isset($_POST['resultado']))
{
   $resultado = $_POST['resultado'];
   
}

if(empty($cantidad_err)){
    
    // Preparamos la consulta que vamos a introducir a la base de datos.
    $sql = "INSERT INTO apuestas (id_user, id_apuesta, id_apostado, cod_apuesta, cantidad_apostada, resultado_user) VALUES (?,?,?,?,?,?)";

    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "iiiiii",$param_iduser, $param_apuesta, $param_apostado, $param_codapuesta, $param_cantidad, $param_resultado);
        
        // Ponemos los parametros con sus respectivos valores.
        $param_iduser = $id_user;
        $param_apuesta = $id_apuesta;
        $param_apostado = $_POST['objetivo'];
        $param_cantidad = $cantidad; 
        $param_resultado = $resultado;
        $param_codapuesta = $cod_apuesta;
        
        // Ejecuta la orden
        if(mysqli_stmt_execute($stmt)){
            // Redirige a la pagina princial
            mysqli_stmt_close($stmt);
            $pinfcoins = $pinfcoins - $cantidad;
            $sql = "UPDATE users SET pinfcoins=? WHERE id=$id_user";
            $stmt= $link->prepare($sql);
            $stmt->bind_param("i",$pinfcoins);
            $stmt->execute();

            header("location: main.php");
            // Close statement
            
           
        } else{
            $cantidad_err = "Error, Puede que ya hayas apostado en esta asignatura, solo puedes apostar 1 vez.";
        }
        
       
    }
}

// Close connection
mysqli_close($link);



?>



<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/x-icon" href="images/MonedaFinal-ConvertImage.ico" />      
    <meta charset="UTF-8">
    <title>5&Bet - Zona de Apuestas</title>
    <link rel="stylesheet" href="css/principal.css">
    <link rel="stylesheet" href="css/all.css" > <!-- Iconos de FontAwesome -->
    <link rel="stylesheet" href="css/social.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="css/social2.css">

</head>
<body class="apuesta">

    <?php include "barra_navegacion.php"; ?>

<div class="container" style="max-width:1400px;margin-top:100px">
    <div class="Apuesta">
        <a href="main.php"><img src="images/logo.png" class="avatar" alt="Imagen Avatar"></a>             
        <h1>Apuesta</h1>
        <h2>Rellena estos datos para poder apostar.</h2>
        <form action="apuesta.php" method="post">
            <div class="form-group"> 
                <h3>Asignatura</h3>
                <div class="content-select">
                    <select class="select" name="id_apuesta" required>
                        <option value="">Seleccione una Asignatura</option>
                        <?php     
                            while($datos = mysqli_fetch_array($query))
                            {
                        ?>
                            <option value="<?php echo $datos['id_apuesta']?>"> <?php echo $datos['nombre']?> </option>
                        <?php    
                            }
                        ?>
                    </select>
                </div>
            </div>
            <i></i>
            <div class="form-group">
                <h3>Objetivo de la apuesta</h3>
                <div class="content-select">
                    <select id="objetivo" name="objetivo" required>
                        <option value = "">---</option>
                        <option value = "<?php echo $_SESSION['id']?>">Tú (apuesta personal)</option>
                        <?php
                            while ($amigos = mysqli_fetch_array($amigos_consulta))
                            {
                            ?>
                                <option value = "<?php echo $amigos['id']?>">
                                    <?php echo $amigos['username']?>
                                </option>
                            <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            <i></i>
            <div class="two-columns">
                <div class="form-group <?php echo (!empty($cantidad_err)) ? 'has-error' : ''; ?>">       
                        <h3>Cantidad (PinfCoins)</h3>
                        <input type="text" name="cantidad" class="form-control" placeholder= "Máx. 50 PinfCoins" value="<?php echo $cantidad; ?>"> 
                        <h4><span class="help-block"><?php echo $cantidad_err; ?></span></h4>
                </div>
                <div class="form-group <?php echo (!empty($cantidad_err)) ? 'has-error' : ''; ?>">    
                    <h3>Resultado</h3>
                    <div class="content-select">
                        <select id="resultado" name="resultado">
                            <option value=1>Aprobado</option>
                            <option value=-1>Suspenso</option>
                        </select>
                        <h4><?php echo "Tus pinfcoins: $pinfcoins"; ?></h4>
                    </div>
                </div>
            </div>
            <div style="text-align:center;">
                <input type="submit" class="btn btn-primary" value="Apostar">
                <a href="main.php" id="boton" class="btn btn-primary">Cancelar</a>   
            </div>
        </form>
    </div> 
</div>   
</body>
</html>