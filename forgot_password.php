<?php
session_start();
$email = "";

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}
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
                <h2>Forgot Password</h2>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Lidhuni me databazën
                    $connect = mysqli_connect("localhost", "root", "", "domino");
                    

                    // Kontrolloni lidhjen me databazën
                    if (!$connect) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    // Merrni vlerat e shënuara nga përdoruesi
                    $newPassword = $_POST['newPassword'];
                    $confirmPassword = $_POST['confirmPassword'];

                    // Verifikoni fjalëkalimin e ri dhe konfirmimin e tij
                    if ($newPassword === $confirmPassword) {
                        // Hashimi i fjalëkalimit me md5
                        $hashedPassword = md5($newPassword);

                        // Përditësoni fjalëkalimin në databazë
                        $query = "UPDATE regjistrohu SET password = '$hashedPassword' WHERE email = '$email'";
                        $result = mysqli_query($connect, $query);

                        if ($result) {
                            echo "Password updated successfully.";
                            session_unset(); // Fshini të gjitha variablat e sesionit
                            session_destroy(); // Zhdukeni sesionin
                            header("Location: kyqu.php"); // Redirekto përdoruesin në faqen e hyrjes
                            exit();
                        } else {
                            echo "Error updating password: " . mysqli_error($connect);
                        }
                    } else {
                        echo "Password and confirmation password do not match.";
                    }

                    // Mbyll lidhjen me databazën
                    mysqli_close($connect);
                }
                ?>
                <form action="" method="POST">
                    
                <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                      <img src="domino1.png" width="100px">
                    </div>

                    
                    <div class="form-outline mb-4">
                            <input type="password" class="form-control form-control-lg" name="newPassword" placeholder="New Password" required>
                            <label class="form-label" for="form2Example17">New Password</label>
                            </div>

                            <div class="form-outline mb-4">
                            <input type="password" class="form-control form-control-lg" name="confirmPassword" placeholder="Confirm Password" required>
                            <label class="form-label" for="form2Example17">Confirm Password</label>
                            </div>
                            
                            <div class="pt-1 mb-4">
                            <input type="submit" class="btn btn-dark btn-lg btn-block" value="Change Password">
                            </div>
                    
                </form>
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
