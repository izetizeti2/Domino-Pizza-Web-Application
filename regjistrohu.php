<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Domino";

// Krijoni lidhjen me databazën
$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrollo nqs forma është paraqitur
if($_SERVER["REQUEST_METHOD"] == "POST") {
  // Marrni vlerën e email-it nga fusha e formës
  $email = $_POST["email"];

  // Kontrolloni nqs emaili ekziston në databazë
  $sql = "SELECT * FROM regjistrohu WHERE email = '$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo "Ky email tashmë është i regjistruar!";
  } else {
    // Marrni vlerat e tjera nga fushat e formës
    $emri = $_POST["emri"];
    $mbiemri = $_POST["mbiemri"];
    $password = md5($_POST["password"]); // Hash passwordin me md5
    $roli=$_POST["roli"];

    // Kontrollo nqs të gjitha fushat janë të mbushura
    if(empty($emri) || empty($mbiemri) || empty($email) || empty($_POST["password"]) || empty($roli)) {
      echo "Ju lutemi plotësoni të gjitha fushat!";
    } else {
      // Krijoni një kërkesë SQL për të futur të dhënat në tabelën e regjistrimit
      $sql = "INSERT INTO regjistrohu (emri, mbiemri, email, password, roli)
      VALUES ('$emri', '$mbiemri', '$email', '$password' , '$roli')";

      if ($conn->query($sql) === TRUE) {
        echo "Të dhënat u futën me sukses!";
        header('Location: kyqu.php'); // Dërgo përdoruesin në faqen e loginit
        exit; // Dal nga skripti pasi keni bërë përcjelljen e faqes
      } else {
        echo "Gabim gjatë futjes së të dhënave: " . $conn->error;
      }
    }
  }
}


?>
<!DOCTYPE html>
<html>
<head>
<title>Regjistrohu</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="icon" href="favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<!-- Section: Design Block -->
<section class="text-center text-lg-start">
<style>
  .cascading-right {
    margin-right: -50px;
  }

  @media (max-width: 991.98px) {
    .cascading-right {
      margin-right: 0;
    }
  }
</style>
<!-- Jumbotron -->
<div class="container py-4">
  <div class="row g-0 align-items-center">
    <div class="col-lg-6 mb-5 mb-lg-0">
      <div class="card cascading-right" style="
          background: hsla(0, 0%, 100%, 0.55);
          backdrop-filter: blur(30px);
          ">
        <div class="card-body p-5 shadow-5 text-center">
          <h2 class="fw-bold mb-5">Regjistrohu tani</h2>
          <form method="POST">
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="text" id="form3Example1" class="form-control" name="emri" required />
                  <label class="form-label" for="form3Example1">Emri</label>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="text" id="form3Example2" class="form-control" name="mbiemri" required />
                  <label class="form-label" for="form3Example2">Mbiemri</label>
                </div>
              </div>
            </div>

            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="form3Example3" class="form-control" name="email" required />
              <label class="form-label" for="form3Example3">Adresa e Email-it</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" id="form3Example4" class="form-control" name="password" required />
              <label class="form-label" for="form3Example4">Fjalëkalimi</label>
            </div>

            <div class="form-outline mb-4">
              <select name="roli" type="text" id="form3Example4" class="form-control" required>
              <option disabled selected hidden></option>
                  <option>user</option>
                  <option>puntor</option>
                </select>
              <label class="form-label" for="form3Example4">Roli</label>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Regjistrohu</button>

            <!-- Register buttons -->
            <div class="text-center">
              <!-- Links -->
              <p> 
                <a href="https://www.facebook.com/Dominos" class="text-reset"><img src="facebook.png" width="20px"></a>
                <a href="https://twitter.com/dominos?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor" class="text-reset"><img src="twitter-sign.png" width="20px"></a>
                <a href="https://www.instagram.com/dominos/?hl=en" class="text-reset"><img src="instagram.png" width="20px"></a>
                <a href="https://www.youtube.com/c/dominos" class="text-reset"><img src="youtube.png" width="20px"></a>
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-6 mb-5 mb-lg-0">
      <img src="domiopica.jpeg" class="w-100 rounded-4 shadow-4" alt="" />
    </div>
  </div>
</div>
<!-- Jumbotron -->
</section>
<!-- Section: Design Block -->
</body>
</html>