<?php
   include_once 'config.php';
   session_start();
   
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
   $cantidad = $cantidad_err = "";
   $target_file = 
   $id_user =  $_SESSION['id'];
   if(isset($_FILES['image'])){
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $tmp = explode('.',$_FILES['image']['name']);
      $file_ext = end($tmp);  
      
      $extensions= array("pdf");
      
      if(in_array($file_ext,$extensions)=== false){
         $cantidad_err = "Solo se pueden subir pdf, prueba de nuevo";
      }
      
      if($file_size > 2097152){
         $cantidad_err='File size must be excately 2 MB';
      }
      
      // Check if file already exists
      
      if (file_exists("expedientes/".$id_user.".pdf")) {
        $cantidad_err='Ya existe tu expediente en la base.';
      }

       if(empty ($_POST["cantidad"])){
        $cantidad_err = "Introduce tus creditos aprobados";     
    } elseif($_POST["cantidad"] >=1 && is_numeric($_POST["cantidad"])){
        $cantidad = $_POST["cantidad"];
    } else{
        $cantidad_err = "Introduce un valor numérico superior a 0"; 
    }

      if(empty($cantidad_err)==true){
         move_uploaded_file($file_tmp,"expedientes/".$id_user.".pdf");
         echo "Success";
         $sql2 = "UPDATE users SET pinfcoins = $cantidad WHERE id = $id_user";
         mysqli_query($link,$sql2);
         header("location: main.php");

      }
   }

?>
<html>
   <head>
      <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
      <link rel="icon" type="image/x-icon" href="images/MonedaFinal-ConvertImage.ico" />
      <title>5&Bet - Expendiente</title>
      <link rel="stylesheet" href="css/registro.css">
      <link rel="stylesheet" href="css/bootstrap.min.css">
   </head>
   <body class="Expediente">
      <div class="register-box">
         <a href="main.php"><img src="images/logo.png" class="avatar" alt="Imagen Avatar"></a> 
         <form action="expediente.php" method="POST" enctype="multipart/form-data">
            <div class="form-group <?php echo (!empty($cantidad_err)) ? 'has-error' : ''; ?>">       
               <h1>Obtención PinfCoins</h1>
               <p class="Warning">AVISO: La cantidad introducida debe corresponder con los créditos aprobados.</p>
               <p class="Warning">Un moderador revisará que la cantidad introducida corresponde con el expediente, en el caso de que no coincidan será excluido del uso de esta plataforma y perderá todas las ganancias obtenidas con ese credito.</p>
               <input type="text" name="cantidad" class="form-control Expediente" placeholder= "Introduce tus creditos" value=""> 
               <span class="help-block Expediente"><?php echo $cantidad_err; ?></span>
      
                  <input type="file" name="image" />
                  <div style="text-align:center">
                     <input type="submit" class="btn btn-primary Expediente" value="Aceptar">
                     <a href="main.php" id="boton" class="btn btn-primary Expediente">Cancelar</a>
                  </div>

            </div>
         </form>
      </div>
   </body>
</html>

