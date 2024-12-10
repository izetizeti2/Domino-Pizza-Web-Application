<?php
session_start();
// Resti i kodit tuaj për home.php
?>

<?php

if (isset($_SESSION['user'])) {
    // Sesioni është i hapur
    echo "Sesioni është i hapur për përdoruesin: " . $_SESSION['user'];
} else {
    // Sesioni është i mbyllur
    echo "Sesioni është i mbyllur.";
}
?>

<?php

if (isset($_POST['dil'])) {
    // Fshirja e sesionit dhe ridrejtimi tek faqja "kyqu.php"
    session_destroy();
    header("Location: kyqu.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css">
    <link rel="icon" href="favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
</head>

<body>
  <style>
    .fotot{
      padding-left: 10%;
      padding-right: 10%;
      height: 550px;
    }
  </style>
    
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark header-backgraund">
        <div class="container-fluid header">
          <a class="navbar-brand nav-link" href="home.php"><img src="logo.png" width="50" height="50" ></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
            <?php if (isset($_SESSION['user'])): ?>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="porosit_online.php">Porosit Online</a>
              </li>
              <?php endif; ?>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="meny.php">Menu</a>
              </li>
              <?php if (isset($_SESSION['user'])): ?>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="checkuot4.php">Checkout</a>
              </li>
              <?php endif; ?>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="Rrethnesh.php">Rreth Nesh</a>
              </li>
              <?php if (isset($_SESSION['user'])): ?>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="aplikimi.php">Aplikimi</a>
              </li>
              <?php endif; ?>
              <?php if (isset($_SESSION['user'])): ?>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="termini.php">Termini</a>
              </li>
              <?php endif; ?>
            </ul>
            <form class="d-flex hapesira-e-butonit">
                <?php if (!isset($_SESSION['user'])): ?>
                <button type="submit" class="btn btn-light" value="regjistrohu">
               <img src="signin2.jpeg" width="30px">
                <a href="regjistrohu.php">Regjistrohu</a>
               </button>
                <?php endif; ?>
                </form>

            <form class="d-flex hapesira-e-butonit" method="post">
              <?php if (isset($_SESSION['user'])): ?>
                <button type="submit" class="btn btn-light" name="dil" value="dil"><img src="login2.png" width="30px"> Dil</button>
              <?php else: ?>
                <button type="submit" class="btn btn-light" name="kyqu" value="kyqu"><img src="login2.png" width="30px"><a href="kyqu.php"> Kyqu</a></button>
              <?php endif; ?>
            </form>
          </div>
        </div>
      </nav>
  </header>
  
  <div><br>
    <?php if (isset($_SESSION['user'])): ?>  
    <form class="hapesira-e-butonit " id="paragrafi1">
      <p>- FILLONI POROSIONE - <button type="submit" class="btn btn-danger" value="regjistrohu"><a href="dergesa.php"> DERGESA </a></button> ose <button type="submit" class="btn btn-danger" value="regjistrohu"><a href="MerrMeVeti.php">MERR ME VETI</a></button> - </p>
    </form>
    <?php endif; ?>
  </div><br>

  <div id="carouselExampleIndicators" class="carousel slide container" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner fotot">
      <div class="carousel-item active">
        <img src="oferta5.jpg" class="d-block w-100" alt="Oferta1"  height="550px">
      </div>
      <div class="carousel-item">
        <img src="oferta6.jpeg" class="d-block w-100" alt="Oferta2" height="550px">
      </div>
      <div class="carousel-item">
        <img src="oferta3.jpeg" class="d-block w-100" alt="Oferta3" height="550px">
      </div>
    </div>
    <button class="carousel-control-prev container" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next container" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

</body>
<br>

<!-- Footer -->
<footer class="foteri">
  <!-- Section: Social media -->
  <!-- Section: Links  -->
  <br>
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>DOMINO'S PIZZA
          </h6>
          <p style="font-weight: bold;">
            Faqja zyrtare e Domino's Pizza Kosove. Bejme shperndarjen e picave ose marrjen me vete. Online mund te gjeni oferta te ndryshme ditore.
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Products
          </h6>
          <p>
                <a href="pica.php" class="text-reset">Pica</a>
              </p>
              <p>
                <a href="anesoret.php" class="text-reset">Anesoret</a>
              </p>
              <p>
                <a href="pijet.php" class="text-reset">Pije</a>
              </p>
              <p>
                <a href="desert.php" class="text-reset">Desert</a>
              </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Useful links
          </h6>
          <p>
            <a href="https://www.facebook.com/Dominos" class="text-reset"><img src="facebook.png" width="25px"> Facebook</a>
          </p>
          <p>
            <a href="https://twitter.com/dominos?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor" class="text-reset"><img src="twitter-sign.png" width="25px"> Twitter</a>
          </p>
          <p>
            <a href="https://www.instagram.com/dominos/?hl=en" class="text-reset"><img src="instagram.png" width="25px"> Instagram</a>
          </p>
          <p>
            <a href="https://www.youtube.com/c/dominos" class="text-reset"><img src="youtube.png" width="25px"> Youtube</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Contact
          </h6>
          <p style="font-weight: bold;"><i class="fas fa-home me-3"></i> Prizren , Prishtine </p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            <a style="opacity: 0.6;" href = "mailto: abc@example.com">info@example.com</a>
          </p>
          <p style="font-weight: bold;"><i class="fas fa-phone me-3"></i> + 383 44 123 456</p>
          <p style="font-weight: bold;"><i class="fas fa-print me-3"></i> + 383 44 987 654</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2023 DOMINO'S PIZZA:
    <a class="text-reset fw-bold" href="https://www.dominos.com/">dominos.com</a>
  </div>
</footer>
<!-- Footer -->
</html>