<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $email = $fecha_nacim = "";
$username_err = $password_err = $confirm_password_err = $email_err = $cajita_err = $fecha_err = $cajita_err2 = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Introduce un nombre de Usuario.";
    }
    else if (($longitud = strlen($_POST['username'])) < 4 || $longitud > 20)    // Comprobar longitud del nombre
    {
        $username_err = "El nombre de usuario debe tener entre 4 y 20 caracteres.";
    }
    else
    {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Este Nombre ya está en Uso.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Error, Prueba de nuevo(Línea 37 register php)";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    //Validando el correo
    if(empty(trim($_POST["email"]))){
        $email_err = "Por favor introduce un correo.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "Este correo ya ha sido registrado.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Error, Prueba de nuevo(Línea 69 register php)";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Introduce una contraseña.";     
    } elseif(strlen(trim($_POST["password"])) < 8){
        $password_err = "La contraseña debe tener almenos 8 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Confirma tu contraseña.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Las contraseñas no coinciden.";
        }
    }

    // Validar aceptación de los términos
    if (!(isset($_POST["lacajita"]))) 
    {
        $cajita_err = "Debe aceptar los términos del servicio.";
    }

    // Validar aceptación de la descarga
    if (!(isset($_POST["lacajita2"]))) 
    {
        $cajita_err2 = "Debe aceptar la descarga de responsabilidades.";
    }

    // Check input errors before inserting in database
    if(empty($username_err)&& empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($cajita_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, `password`, email, profile_image) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_password, $param_email,$param_photo);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_email = $email;
            $param_fecha = $fecha_nacim;
            $param_photo = "default.jpg";

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Error, Prueba de nuevo(Línea 116 register php)";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="image/x-icon" href="images/MonedaFinal-ConvertImage.ico" />
    <meta charset="UTF-8">
    <title>5&Bet - Nuevo registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- Sie Icons -->
   <link rel="shortcut icon" href="" type="image/x-icon" />
   <link rel="apple-touch-icon" href="">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <!-- Site CSS -->
   <link rel="stylesheet" href="style.css">
   <!--Login CSS -->
   <link rel="stylesheet" href="css/registro.css">
   <!-- Colors CSS -->
   <link rel="stylesheet" href="css/colors.css">
   <!-- ALL VERSION CSS -->	
   <link rel="stylesheet" href="css/versions.css">
   <!-- Responsive CSS -->
   <link rel="stylesheet" href="css/responsive.css">
   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/custom.css">
   <!-- font family -->
   <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">    
</head>
<body style="display:inline-table">
    <div class="register-box">
        <a href="index.php"><img src="images/logo.png" class="avatar" alt="Imagen Avatar"></a>             
        <h1>Registro</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <!-- Nombre de usuario -->
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label for = "username">Usuario</label>
                <input type="text" placeholder="Introduzca Usuario" id = "username" name="username" class="form-control" value="<?php echo $username; ?>" autocomplete = "off">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>

            <!-- E-mail -->
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label for = "email">Email</label>
                <input type="email" placeholder ="Introduzca Email" id = "email" name="email" class="form-control" value="<?php echo $email; ?>" autocomplete = "off">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>

            <!-- Contraseña -->
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label for = "password">Contraseña</label>
                <input type="password" placeholder="Introduzca Contraseña" id = "password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>

            <!-- Confirmar contraseña -->
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label for = "confirm_password">Repite Contraseña</label>
                <input type="password" placeholder="Confirmar Contraseña" id = "confirm_password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>

            <!-- Confirmar términos -->
            <div class="form-group <?php echo (!empty($cajita_err)) ? 'has-error' : ''; ?>">
                <label id="lacajita"><input type="checkbox" id="lacajita" name="lacajita">He leído y acepto los <a href="terminosYcondiciones-5&Bet.pdf" target="_blank">términos y condiciones</a></label> 
                <span class="help-block" id="lacajita"><?php echo $cajita_err; ?></span>
            </div>
            
            <!-- Confirmar Descarga Responsibilidades -->
            <div class="form-group <?php echo (!empty($cajita_err2)) ? 'has-error' : ''; ?>">
                <label id="lacajita"><input type="checkbox" id="lacajita" name="lacajita2">He leído y acepto la <a href="Descarga de Responsabilidades-5&Bet.pdf" target="_blank">Descarga de Responsabilidades</a></label> 
                <span class="help-block" id="lacajita"><?php echo $cajita_err2; ?></span>
            </div>

            <!-- Submit -->
            <div class="form-group">
                <input type="submit" value="Registrarse">
            </div>
            
            <p>¿Ya tienes cuenta? <a href="login.php">Entra aquí</a>.</p>
        </form>
    </div>    
</body>
</html>