<?php
//Archivos necesarios
include_once __DIR__ . '/includesranking/config/config.php';
include_once __DIR__ . '/includesranking/config/init.php';

$img_src = "assetsranking/images/bg-card3.png";
$imgbinary = fread(fopen($img_src, "r"), filesize($img_src));
$img_str = base64_encode($imgbinary);
?>
<!DOCTYPE html>
<html lang="es">

<head>

   <script src = "js/jquery-3.5.1.js"></script>
   <script>

         $(document).ready(function() {

            $("body").hide().fadeIn(2000);

         });

   </script>

   <link rel="icon" type="image/x-icon" href="images/MonedaFinal-ConvertImage.ico" />
   <meta charset="UTF-8">
   <title>5&Bet - Ranking</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="favicon.ico" type="image/x-icon" />
   <link rel="stylesheet" href="css/reset.css">
   <link rel="stylesheet" href="css/ranking.css">
   <link rel="stylesheet" href="assetsranking/css/bootstrap.min.css">
   <link rel="stylesheet" href="assetsranking/css/font-awesome.css">
   <link rel="stylesheet" href="assetsranking/css/style.css?v=<?php echo time(); ?>">
</head>

<body>
   <div class="leaderboard">
      <a href="main.php"><img src="images/logo.png" class="avatar" alt="Imagen Avatar"></a> 
      <h1>
         <img class="moneda" src="images/MonedaFinal.PNG">
         Top 10 Jugadores
         <img class="moneda" src="images/MonedaFinal.PNG">
      </h1>
      <ol>
         <?php require __DIR__ . '/includesranking/components/getRanking/loader.php'; ?>
      </ol>
      <div class="volver">
         <a href="main.php" class="btn">Volver</a>
      </div>
   </div>

</body>

</html>