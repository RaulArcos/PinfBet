<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
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
$amigos_consulta = mysqli_query($link, "SELECT id, name FROM users");


if(isset($_POST['id_apuesta']))
{
    $id_apuesta = $_POST['id_apuesta'];
    $id_apostado = $_POST['objetivo'];
    
   $numero =$id_apuesta; //Con esto sabremos la longitud de la id de apuesta para general el codigo de apuesta.
    $id_apuesta_long = 1;
    do{
	    $numero = floor($numero / 10);
	    $id_apuesta_long = $id_apuesta_long*10;
    } while ($numero > 0);

    $cod_apuesta = ($id_apostado * $id_apuesta_long) + $id_apuesta; //Con esto, deberiamos tener siempre un código único, por ejemplo, usuario 154 y cod apuesta 3.
    // cod apuesta = (154 * 100 * 10)+3, por lo que tendriamos 154003
   
}
if(isset($_POST['resultado']))
{
   $resultado = $_POST['resultado'];
   


    // Preparamos la consulta que vamos a introducir a la base de datos.
    $sql = "INSERT INTO resultados (cod_resultado, id_user, id_apuesta, resultado) VALUES (?,?,?,?)";
     
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "iiii", $param_codapuesta,$param_iduser, $param_apuesta, $param_resultado);
        
        // Ponemos los parametros con sus respectivos valores.
        $param_iduser = $_POST['objetivo'];
        $param_apuesta = $id_apuesta;    
        $param_resultado = $resultado;
        $param_codapuesta = $cod_apuesta;
        
        // Ejecuta la orden
        if(mysqli_stmt_execute($stmt)){
            // Redirige a la pagina princial
            mysqli_stmt_close($stmt);
            // Close statement
            echo "Guardado!";
           
        } else{
            echo "Error, ya has añadido el resultado de este alumno, prueba con otro";
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
    <title>Resultados Alumnos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
 
    
    <div class="wrapper">
        
      
        <h2>RESULTADOS</h2>
        <p>Rellena con los alumnos y sus resultados</p>
        <form action="resultados.php" method="post">
        <div class="form-group">
                <label>Alumno</label>
                    <select id="objetivo" name="objetivo" required>
                        <?php
                            while ($amigos = mysqli_fetch_array($amigos_consulta))
                            {
                            ?>
                                <option value = "<?php echo $amigos['id']?>">
                                    <?php echo $amigos['name']?>
                                </option>
                            <?php
                            }
                        ?>
                    </select>
            </div>

        
            <div class="form-group"> 
            <label>Asignatura</label>
                <select name="id_apuesta">
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
            <div class="form-group <?php echo (!empty($cantidad_err)) ? 'has-error' : ''; ?>">
            <label>Resultado</label>
            <select id="resultado" name="resultado">
                <option value=1>Aprobado</option>
                <option value=-1>Suspenso</option>
            </select>
            </div>  

                <input type="submit" class="btn btn-primary" value="Guardar">
                <a href="main.php" class="btn btn-primary">Volver</a>
            
        </form>
    </div>    
</body>
</html>