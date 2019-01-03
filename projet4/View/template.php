<?php
if (!isset($_SESSION)) {
    session_start(); 
 } 
?>

<!DOCTYPE html>
<html>
    <head>
      <script src="../View/jquery.min.js"></script>
      <meta charset="utf-8" />
      <title><?= $title ?></title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <script src="../js/ckeditor/ckeditor.js"></script>



      <title>Billet simple pour l'Alaska</title>

      <!-- Bootstrap core CSS -->
      
      <!-- Custom fonts for this template -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
      <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
      <!-- Custom styles for this template -->
      
      <link href="../css/css/bootstrap.css" rel="stylesheet">
      <link href="../css/css/clean-blog.css" rel="stylesheet">
      <link href="../css/css/media.css" rel="stylesheet">     
    </head>
        
    <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="index.php">Billet simple pour l'Alaska</a>
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
            <?php  if(!empty($_SESSION)){?>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=logOut&amp;" title="Logout"><i class="fas fa-sign-out-alt"></i></a>
            </li>
            <?php } ?>
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
              <h1>Billet simple pour l'Alaska</h1>
              <span class="subheading">La formidable aventure</span>
            </div>
          </div>
        </div>
      </div>
    </header>
    <?php  if(!empty($_SESSION)){?>
    <?php if ($_SESSION['statu'] =='admin') { ?>
    <h3 class="bonjour">Bonjour <?= $_SESSION['username']?></h3>
    <div class="container-fluid">         
     <?= $content ?> 
  </div>
  <?php } ?>
  <?php } ?>

    <!-- Main Content -->
    <?php if (empty($_SESSION) || $_SESSION['statu'] =='user' ) { ?>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-preview">           
              <?= $content ?>
          </div>       
        </div>
      </div>
    </div>
    <?php } ?>
    <hr>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="footer">
          <?php if (!empty($_SESSION)) { ?>
              <p>Vous êtes connecté avec <?= $_SESSION['username'] ?> vous pouvez vous déconnecter <a href="index.php?action=logOut"><em> ici </em></a></p>
          <?php } ?>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/clean-blog.min.js"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>

    </body>
</html>