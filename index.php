<?php
   // Initialize the session
   session_start();
?>

<!DOCTYPE html>
<html lang="es">
   <link rel="icon" type="image/x-icon" href="images/MonedaFinal-ConvertImage.ico" />
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
   <title>5&Bet - Casa de Apuestas</title>
   <meta name="keywords" content="Apuestas">
   <meta name="description" content="Casa de apuestas de 5&Bet">
   <meta name="author" content="5&Bet">
   
      <link rel="stylesheet" href="css/master.css?n=1">
      <link rel="stylesheet" href="css/all.css" > <!-- Iconos de FontAwesome -->
      <link rel="shortcut icon" href="" type="image/x-icon" />
      <link rel="apple-touch-icon" href="">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="css/colors.css">	
      <link rel="stylesheet" href="css/versions.css">
      <link rel="stylesheet" href="css/responsive.css">
      <link rel="stylesheet" href="css/custom.css">
      <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      <link rel="stylesheet" href="css/3dslider.css" />
      <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
      <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
      <script src="js/3dslider.js"></script>
   </head>
   
   <body class="CasaDeApuestas" data-spy="scroll" data-target=".header">
      <!-- LOADER -->
      <div id="preloader">
         <img class="preloader" src="images/moneda.gif" alt="La Moneda">
      </div>
      <!-- END LOADER -->
      <section id="top">
         <header>
            <div class="container">
               <div class="header-top">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="full">
                           <div class="logo">
                              <a href="index.php"><img src="images/logo.png"  height="80"/></a>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="right_top_section">
                           <!-- button section -->
                           <?php
                           // Si el usuario está logueado se le da la bienvenida y cambian los iconos
                           if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
                           {
                           ?>
                              <ul class="login">
                                 <li class="login-modal">
                                    <a href="main.php" class="login"><i class="fa fa-user"></i>Menú principal</a>
                                 </li>
                                 <li>
                                    <div class="cart-option">
                                       <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Cerrar sesión</a>
                                    </div>
                                 </li>
                              </ul>
                           <?php
                           }
                           else
                           {
                           ?>
                              <ul class="login">
                                 <li class="login-modal">
                                    <a href="login.php" class="login"><i class="fas fa-sign-in-alt"></i>Iniciar sesión</a>
                                 </li>
                                 <li>
                                    <div class="cart-option">
                                       <a href="register.php"><i class ="fa fa-user"></i>Registrarse</a>
                                    </div>
                                 </li>
                              </ul>
                           <?php
                           }
                           ?>
                           <!-- end button section -->
                        </div>
                     </div>
                  </div>
               </div>
               <div class="header-bottom">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="full">
                           <div class="main-menu-section">
                              <div class="menu">
                                 <nav class="navbar navbar-inverse">
                                    <div class ="container-fluid">
                                       <div class="navbar-header">
                                          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                                          <span class="sr-only">Barra Navegacion</span>
                                          <span class="icon-bar"></span> <!-- Para crear el logo de botón en versión móvil -->
                                          <span class="icon-bar"></span>
                                          <span class="icon-bar"></span>
                                          </button>
                                       </div>
                                    </div>
                                    <div class="collapse navbar-collapse js-navbar-collapse">
                                       <ul class="nav navbar-nav">
                                          <?php
                                          // Si el usuario está logueado se le da la bienvenida y cambian los iconos
                                          if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
                                          {
                                          ?>
                                             <li><a class ="login" href="main.php"><i class = "fa fa-user"></i>  Menu Principal</a></li>
                                             <li><a href="logout.php"><i class = "fa fa-user"></i> Cerrar Sesion</a></li>
                                          <?php
                                          } else {
                                          ?>
                                             <li><a class ="login" href="login.php"><i class = "fa fa-user"></i>  Iniciar Sesion</a></li>
                                             <li><a href="register.php"><i class = "fa fa-user"></i> Registrarse</a></li>
                                          <?php } ?>
                                       </ul>
                                    </div>
                                    <!-- /.nav-collapse -->
                                 </nav>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </header>
         <div class="full-slider">
            <div id="carousel-example-generic" class="carousel">
               <!-- Wrapper for slides -->
               <div class="carousel-inner" role="listbox">
                  <!-- First slide -->
                  <div class="item active primerafoto" data-ride="carousel">
                     <div class="carousel-caption">
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12"></div>
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                           <div class="slider-contant" data-animation="animated fadeInRight">
                              <?php
                              // Si el usuario está logueado se le da la bienvenida y cambian los iconos
                              if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){?>
                                 <h3>Bienvenido,<br><span style="color: #ec8464"><?php $nombre = $_SESSION['username']; echo $nombre;?></span></h3>
                              <?php 
                              } else {
                              ?>
                              <h3>Donde <span style="color: #ec8464;">apuestan</span><br>los que <span style="color: #ec8464">aprueban</span></h3>
                              <h4>(Y los que no, se <span style="color: #ec8464;">divierten</span>)</h4>
                              <?php } ?>
                              <button class="btn btn-primary btn-lg"><a href="main.php">Apuesta ya</a></button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="news">
               <div class="container">
                  <div class="heading-slider">
                     <p class="headline"><i class="fa fa-star" aria-hidden="true"></i> Noticias Estrellas :</p>
                     <h1>
                     <a href="" class="typewrite" data-period="2000" data-type='[ "EDNL se mantiene con cuotas altas despues de otro año de suspensos.", "Se comenta que SSI este año esta en buena racha de aprobados.", "El COVID-19 mantiene la incertidumbre entre los grupos universitarios"]'>
                     <span class="wrap"></span>
                     </a>
                     </h1>
                     <span class="wrap"></span>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <footer id="footer" class="footer">
         <div class="container">
            <div class="row">
               <div class="col-md-4">
                  <div class="full">
                     <div class="footer-widget">
                        <div class="footer-logo">
                           <img src="images/footer-logo.png" alt="#" />
                        </div>
                        <p>Juega con responsabilidad.<br>+18<br><br>
                        <i class="fas fa-quote-left fa-pull-left"></i>
                        La suerte, mala o buena, siempre está<br> con nosotros. Pero tiene una manera de favorecer a los inteligentes y darle la espalda a la estupidez.</p>
                     </div>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="full">
                     <div class="footer-widget">
                        <h3>Mapa del sitio</h3>
                        <ul class="footer-menu">
                           <li><a href="#top">Inicio</a></li>
                           <?php
                           if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
                           {
                              
                           ?> 
                              <li><a href="main.php" target="_self">Menú principal</a></li>
                           <?php
                           }
                           else
                           {
                           ?> 
                              <li><a href="login.php" target="_self">Iniciar sesión</a></li>
                              <li><a href="register.php" target="_self">Registrarse</a></li>
                           <?php
                           }
                           ?>
                           <li><a href="terminosYcondiciones-5&Bet.pdf" target="_blank">Términos y condiciones</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="full">
                     <div class="footer-widget">
                        <h3>Contacta con nosotros</h3>
                        <ul class="address-list">
                           <li><i class="fa fa-map-marker"></i>Av. Universidad de Cádiz, 10, 11519 Puerto Real, Cádiz</li>
                           <li><i class="fa fa-phone"></i> 956 48 32 00</li>
                           <li><i style="font-size:20px;top:5px;" class="fa fa-envelope"></i><a href = "mailto:5&bet@gmail.com"> 5&bet@gmail.com </a></li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="full">
                     <div class="contact-footer">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3205.6634342794637!2d-6.204227585228313!3d36.53811339010932!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x152f79854b8f0de1%3A0x8d075bd9e5895558!2sEscuela%20Superior%20de%20Ingenier%C3%ADa!5e0!3m2!1ses!2ses!4v1607443397000!5m2!1ses!2ses" width="600" height="350" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="footer-bottom">
            <div class="container">
               <p>Copyright © 2021 5&Bet.com Derechos Reservados.</p>
            </div>
         </div>
      </footer>
      <a href="#home" data-scroll class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>
      <!-- ALL JS FILES -->
      <script src="js/all.js"></script>
      <!-- ALL PLUGINS -->
      <script src="js/custom.js"></script>
   </body>
</html>