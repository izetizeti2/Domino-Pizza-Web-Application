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
        <title>Dokumentacioni</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style3.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="favicon.ico">
       
    </head>

    <body>
        
     
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

          
            
            
            </div>
            <div class="container">
                <div class="box">
                   <A href="pica.php" ><img src="picamenys.jpeg"></A>
                    <h2>Pica Speciale</h2>
                </div>
                <div class="box">
                    <A href="anesoret.php" ><img src="anesoret2.jpeg"></A>
                    <h2>Anesoret</h2>
                </div>
                <div class="box">
                    <A href="pijet.php" ><img src="pijet2.jpeg"></A>
                    <h2>Pijet</h2>
                </div>
                <div class="box">
                    <A href="desert.php" ><img src="desert1.jpeg"></A>
                    <h2>Desert</h2>
                </div>
                
            </div>
            
    </body>
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
              <p style="font-weight: bold;"><i class="fas fa-print me-3"></i> + 383 45 123 456</p>
            </div>
            <!-- Grid column -->
          </div>
          <!-- Grid row -->
        </div>
      </section>
      <!-- Section: Links  -->
    
      <!-- Copyright -->
      <div class="text-center p-4" rgba >
        © 2022 Copyright:
        <a class="text-reset fw-bold" href="dokumentacioni.html">Domino's Kosovo</a>
      </div>
      <!-- Copyright -->
    </footer>
    <!-- Footer -->
</html>