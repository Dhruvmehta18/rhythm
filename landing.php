<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Landing page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Oswald:400,700"> 
    <link rel="stylesheet" href="css/bootstrap.min.css">  
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <?php
	session_start();
  if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
    header('Location: main.php');
} 
else if(!isset($_SESSION['logged_in']) || (isset($_SESION['logged_in']) && $_SESSION['logged_in'] == 0)){
?>
  <body>
  <div class="site-wrap">
    <div class="site-blocks-cover overlay" style="background-image: url('landing.jpg');" data-aos="fade" data-stellar-background-ratio="0.5" data-aos="fade">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7 text-center" data-aos="fade-up" data-aos-delay="400">
            <h1 class="mb-4">Turn On The Feeling With Music</h1>
            <p><a href="index.php" class="btn btn-primary px-4 py-3">Login to continue</a></p>
          </div>
        </div>
      </div>
    </div>
</div>
  <script src="js/aos.js"></script>
  <script src="js/main.js"></script>  
  </body>
</html>
<?php
}
?>