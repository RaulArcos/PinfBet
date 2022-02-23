<?php
// Initialize the session
session_start();
header('Content-Type: text/html; charset=ISO-8859-1');
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
  $id = $_SESSION["id"];
  $msg = "";
  $msg_class = "";

  if (isset($_POST['save_profile'])) 
  {
    $profileImageName = "";

    $conn = mysqli_connect("localhost", "root", "", "pinf");

    // for the database
    if ($_FILES['profileImage']['error'] == 0)  // Si no hay error en la subida
    {
      $profileImageName = time() . '-' . $_FILES["profileImage"]["name"];

      // For image upload
      $target_dir = "imagenesperfil/";
      $target_file = $target_dir . basename($profileImageName);

      // VALIDATION
      // validate image size. Size is calculated in Bytes
      if($_FILES['profileImage']['size'] > 200000)
      {
        $msg = "Image size should not be greated than 200Kb";
        $msg_class = "alert-danger";
      }
      // check if file exists
      if(file_exists($target_file))
      {
        $msg = "File already exists";
        $msg_class = "alert-danger";
      }
    }
    
    // Upload image only if no errors
    if (empty($error))
    {
      if ($profileImageName != "")  // Si se ha cambiado la imagen
      {
        if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) 
        {
          $sql = "UPDATE users SET profile_image = '$profileImageName' WHERE id = $id";
          
          if(!(mysqli_query($conn, $sql)))
          {
            $msg = "There was an error in the database";
            $msg_class = "alert-danger";
          }
        } 
        else 
        {
          $error = "There was an error uploading the file";
          $msg = "alert-danger";
        }
      }

      // Actualizar nombre y bio
      $nombre = $_POST['nombre'];
      $bio = $_POST['bio'];
      
      mysqli_query($conn, "UPDATE users SET `name` = '$nombre', bio = '$bio' WHERE id = $id");

      // Mensaje de confirmación
      $msg = "Perfil actualizado";
      $msg_class = "alert-success";
    }
    mysqli_close($conn);
  }
?>