<?php
if (!isset($_SESSION)) {
    session_start(); 
 } 
?>

<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8" />
      <title><?= $title ?></title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <script src="../web/ckeditor/ckeditor.js"></script>


      <title>Billet simple pour l'alaska</title>

      <!-- Bootstrap core CSS -->
      
      <!-- Custom fonts for this template -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
      <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
      <!-- Custom styles for this template -->
      
      <link href="../css/css/bootstrap.css" rel="stylesheet">
      <link href="../css/css/clean-blog.css" rel="stylesheet">     
    </head>
        
    <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="index.php">Billet simple pour l'alaska</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=inscription&amp;">login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
        <!-- Page Header -->
    <header class="masthead" style="background-image: url('img/home-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>billet simple pour l'alaska</h1>
              <span class="subheading">la formidable aventure</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-preview">           
            	<?= $content ?>
          </div>       
        </div>
      </div>
    </div>

    <hr>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="footer">
          <?php if (!empty($_SESSION)) { ?>
              <p>vous êtes connecter avec <?= $_SESSION['username'] ?> vous pouvez vous déconnecté <a href="index.php?action=logOut"><em> ici </em></a></p>
          <?php } ?>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/clean-blog.min.js"></script>

    </body>
</html>