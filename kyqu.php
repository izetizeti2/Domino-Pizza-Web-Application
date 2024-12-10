
<?php
session_start(); // Fillo sesionin

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Domino";

// Krijo një lidhje me bazën e të dhënave
$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrollo nqs është dërguar forma
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Merr vlerat nga fushat e formës
  $email = $_POST["email"];
  $password = md5($_POST["password"]); // Hash passwordin duke përdorur MD5

  // Kërko në tabelën "regjistrohu" për të dhënat e kyçjes
  $sql = "SELECT * FROM regjistrohu WHERE email = '$email' AND password = '$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Ruan emailin dhe rolin në sesion
    $_SESSION["user"] = $email;
    $_SESSION["role"] = $row["roli"];

    // Ridrejto sipas rolit
    if ($row["roli"] == "user") {
      header("Location: home.php");
      exit();
    } elseif ($row["roli"] == "puntor") {
      header("Location: homepuntori.php");
      exit();
    }
    exit();
  } else {
    echo "Emaili ose fjalëkalimi është i pasaktë!";
  }
}

// Mbyll lidhjen me bazën e të dhënave
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Signin Template · Bootstrap v5.1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    <link rel="icon" href="favicon.ico">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .center {
  margin: auto;
  width: 50%;
  border: 3px solid green;
  padding: 10px;
  height: 120%;
}
.izet-bosi{
    margin: auto;
    padding: auto;
}
    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
</head>
<body>
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="picakyqu.jpeg" height="700px" width="480px"
                  alt="login form"  style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
  
                  <form method="POST">
  
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                      <img src="domino1.png" width="100px">
                    </div>
  
                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Kyqu ne llogarine tuaj</h5>
  
                    <div class="form-outline mb-4">
                      <input type="email" id="form2Example17" class="form-control form-control-lg" name="email" required/>
                      <label class="form-label" for="form2Example17">Email address</label>
                    </div>
  
                    <div class="form-outline mb-4">
                      <input type="password" id="form2Example27" class="form-control form-control-lg" name="password" required/>
                      <label class="form-label" for="form2Example27">Password</label>
                    </div>
                    <a href="fp.php">Forgot passsword!</a>
                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block" type="submit">Kyqu</button>
                    </div>
  
                   
                  </form>
                <a href="regjistrohu.php">Regjistrohu</a>
                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</body>
</html>
