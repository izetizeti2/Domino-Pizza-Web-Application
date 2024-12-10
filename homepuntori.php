<?php
session_start(); // Fillo sesionin
if (isset($_SESSION['user'])) {
  // Sesioni është i hapur
  echo "Sesioni është i hapur për përdoruesin: " . $_SESSION['user'];
} else {
  // Sesioni është i mbyllur
  echo "Sesioni është i mbyllur.";
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "domino";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Lidhja me bazën e të dhënave dështoi: " . mysqli_connect_error());
}

// Kontrollo nqs është klikuar butoni "Dil"
if (isset($_POST['dil'])) {
  session_unset(); // Hiq të gjitha variablat e sesionit
  session_destroy(); // Shkatërro sesionin
  header("Location: kyqu.php"); // Ridrejto në faqen kyqu.php
  exit(); // Dal nga skedari aktual
}

if (isset($_POST['fshij'])) {
    $rowId = $_POST['row_id']; // Merr ID-në e rreshtit të zgjedhur për të fshirë
    $id = mysqli_real_escape_string($conn, $rowId); // Rregullojë vlerën e ID-së për t'i shmangur gjetjet SQL-injection
    $deleteQuery = "DELETE FROM porosit WHERE id = '$id'";
    if (mysqli_query($conn, $deleteQuery)) {
      // Fshirja u krye me sukses
      header("Refresh:0"); // Rifresko faqen pas fshirjes
      exit();
    } else {
      // Gabim gjatë fshirjes
      echo "Gabim gjatë fshirjes: " . mysqli_error($conn);
    }
}

// Shfaqja e të dhënave të aplikimeve
$sql = "SELECT * FROM porosit";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dokumentacioni</title>
    
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
  
  <header >
    <nav class="navbar navbar-expand-lg navbar-dark header-backgraund">
        <div class="container-fluid header">
          <a class="navbar-brand nav-link" href="homepuntori.php"><img src="logo.png" width="50" height="50" ></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="aplikimetpuntori.php">Aplikimi</a>
              </li>
            </ul>
            <form class="d-flex" method="post">
              <button type="submit" class="btn btn-light" name="dil" value="Dil"><img src="login2.png" width="30px"><a href="kyqu.php">Dil</a></button>
            </form>
          </div>
        </div>
      </nav>
  </header>

  <div><br>
    <body></body>
  </div><br>

  <div class="container">
    <h2>Porosit:</h2>
    <table class="table table-dark table-hover">
      <thead>
        <tr>
          <th>Useri</th>
          <th>Produkti</th>
          <th>Qmimi</th>
          <th>Saisa</th>
          <th>id</th>
          <th>Totali</th>
          <th>Fshij</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['useri'] . "</td>";
            echo "<td>" . $row['produkti'] . "</td>";
            echo "<td>" . $row['qmimi'] . "</td>";
            echo "<td>" . $row['sasia'] . "</td>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['totali'] . "</td>";
            echo "<td> 
            <form method='post'>
              <input type='hidden' name='row_id' value='" . $row['id'] . "'>
              <button type='submit' class='btn btn-danger' name='fshij'>Fshij</button>
            </form>
            </td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='4'>Nuk ka të dhëna për të shfaqur.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Footer -->
  <footer class="foteri" >
    <div class="text-center p-4" rgba>
      © 2022 Domino's Kosovo
    </div>
  </footer>
  <!-- Footer -->
</body>
</html>