<?php
session_start();

function generateId() {
    $date = new DateTime();
    $id = $date->getTimestamp();
    return $id;
}

if (isset($_SESSION['user'])) {
    echo "Sesioni është i hapur për përdoruesin: " . $_SESSION['user'];
} else {
    echo "Sesioni është i mbyllur.";
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Domino";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Lidhja me bazën e të dhënave dështoi: " . mysqli_connect_error());
}

if (isset($_POST['shto_shport'])) {
    $sasia = $_POST['sasia'];

    $query = "SELECT * FROM menu";
    $result = mysqli_query($conn, $query);

    $usedIds = array();

    foreach ($sasia as $index => $quantity) {
        if ($quantity > 0) {
            mysqli_data_seek($result, $index);
            $row = mysqli_fetch_assoc($result);

            $produkti = $row['emri'];
            $qmimi = $row['qmimi'];

            $id = generateId();

            $check_query = "SELECT * FROM porosit WHERE id = '$id'";
            $check_result = mysqli_query($conn, $check_query);
            $existing_rows = mysqli_num_rows($check_result);

            while ($existing_rows > 0) {
                $id = generateId();
                $check_query = "SELECT * FROM porosit WHERE id = '$id'";
                $check_result = mysqli_query($conn, $check_query);
                $existing_rows = mysqli_num_rows($check_result);
            }

            $usedIds[] = $id;

            $totali = $qmimi * $quantity;

            $insert_query = "INSERT INTO porosit (useri, produkti, qmimi, sasia, id, totali) 
                            VALUES ('" . $_SESSION['user'] . "', '$produkti', '$qmimi', '$quantity','$id','$totali')";

            mysqli_query($conn, $insert_query);
        }
    }
}

$query = "SELECT * FROM menu";
$result = mysqli_query($conn, $query);

if (isset($_POST['dil'])) {
    // Fshirja e sesionit dhe ridrejtimi tek faqja "kyqu.php"
    session_destroy();
    header("Location: kyqu.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.19/dist/css/uikit.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="favicon.ico">
</head>

<body>
    <style>
        body {
            overflow: scroll;
        }

        .container {
            margin: auto;
            margin-top: 20px;
        }

        .col-md-,
        .col-lg-4 {
            margin-bottom: 20px;
        }

        .sty {
            font-size: 18px !important;
            color: black !important;
        }

        .num {
            width: 80px;
            height: 30px;
            border: 3px solid black;
            border-radius: 5px;
            font-size: 18px;
            padding: 5px;
        }

        .uk-border-circle {
            width: 100px !important;
            height: 100px !important;
        }

        .fa-cart-arrow-down {
            color: white;
            font-size: 50px;
            cursor: pointer;
            padding-left: 20px;
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

    <body>
        <div class="container">
            <h2>Porosit ketu!</h2>
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th>Produkti</th>
                        <th>Qmimi</th>
                        <th>Sasia</th>
                    </tr>
                </thead>
                <form method='post'>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo $row['emri']; ?></td>
                                <td><?php echo $row['qmimi']; ?> €</td>
                                <td>
                                    <input class='num' type='number' name='sasia[]' min='0' value='0'>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan='3' style='text-align:right;'>
                                <button type='submit' class='btn btn-primary' name='shto_shport'>Shto në shportë</button>
                            </td>
                        </tr>
                    </tfoot>
                </form>
            </table>
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