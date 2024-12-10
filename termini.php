<?php
session_start();

// Lidhja me bazën e të dhënave (përdorni lidhjen e përgatitur të deklaruar nëse është e mundur)
$conn = new mysqli("localhost", "root", "", "Domino");

// Kontrolloni nëse është dërguar forma dhe procesoni të dhënat
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['emri']) && isset($_POST['email']) && isset($_POST['data_koha']) && isset($_POST['ora'])) {
        $emri = $_POST['emri'];
        $email = $_POST['email'];
        $data_koha = $_POST['data_koha'];
        $ora = $_POST['ora'];

        // Validimi i të dhënave të hyrjes
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email-i i dhënë nuk është i vlefshëm.";
            exit;
        }

        // Kontrollo nëse ora është e zënë
        $sql_check = "SELECT COUNT(*) as num FROM terminet WHERE data_koha = ? AND ora = ? AND e_zene = 1";
        $stmt = $conn->prepare($sql_check);
        $stmt->bind_param("ss", $data_koha, $ora);
        $stmt->execute();
        $result_check = $stmt->get_result();
        $row = $result_check->fetch_assoc();
        if ($row['num'] > 0) {
            echo "Orari është i zënë, ju lutem zgjidhni një orë tjetër.";
            exit;
        }

        // Shtimi i terminit në bazën e të dhënave
        $sql_insert = "INSERT INTO terminet (emri, email, data_koha, ora, e_zene) VALUES (?, ?, ?, ?, 1)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bind_param("ssss", $emri, $email, $data_koha, $ora);
        if ($stmt->execute()) {
            echo "Termini u regjistrua me sukses!";
        } else {
            echo "Gabim gjatë regjistrimit të terminit: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Të dhënat e nevojshme mungojnë!";
    }
}

// Mbyll lidhjen me bazën e të dhënave
$conn->close();
?>


<!DOCTYPE html>
<html>

<head>
    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css">
    <link rel="icon" href="favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .fotot {
            padding-left: 10%;
            padding-right: 10%;
            height: 550px;
        }
    </style>

</head>

<body>
    <header>
    </header>

    <div class="container py-4">
        <div class="row g-0 align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="card cascading-right"
                    style="background: hsla(0, 0%, 100%, 0.55); backdrop-filter: blur(30px);">
                    <div class="card-body p-5 shadow-5 text-center">
                        <h2 class="fw-bold mb-5">Regjistrohu tani</h2>
                        <form method="POST">
                            <h2>Forma për Termine të Konsultimeve</h2>
                            <div class="mb-3">
                                <label for="emri" class="form-label">Emri</label>
                                <input type="text" class="form-control" id="emri" name="emri">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="data_koha" class="form-label">Zgjidhni Diten e Konsultimit</label>
                                <select class="form-select" id="data_koha" name="data_koha">
                                    <option value="<?php echo date('Y-m-d', strtotime('next Monday')); ?>">E Hënë
                                        (<?php echo date('Y-m-d', strtotime('next Monday')); ?>)</option>
                                    <option value="<?php echo date('Y-m-d', strtotime('next Tuesday')); ?>">E Martë
                                        (<?php echo date('Y-m-d', strtotime('next Tuesday')); ?>)</option>
                                    <option value="<?php echo date('Y-m-d', strtotime('next Wednesday')); ?>">E Mërkurë
                                        (<?php echo date('Y-m-d', strtotime('next Wednesday')); ?>)</option>
                                    <option value="<?php echo date('Y-m-d', strtotime('next Thursday')); ?>">E Enjte
                                        (<?php echo date('Y-m-d', strtotime('next Thursday')); ?>)</option>
                                    <option value="<?php echo date('Y-m-d', strtotime('next Friday')); ?>">E Premte
                                        (<?php echo date('Y-m-d', strtotime('next Friday')); ?>)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="ora" class="form-label">Zgjidhni Oren e Konsultimit</label>
                                <select class="form-select" id="ora" name="ora">
                                    <?php
                                    // Shfaq dropdown listën për zgjedhjen e orës vetëm nëse është zgjedhur një datë dhe kontrollo për orët e zënë
                                    if (isset($_POST['data_koha'])) {
                                        for ($ora = 9; $ora <= 17; $ora++) {
                                            if (!in_array($ora, $oret_zene)) {
                                                echo '<option value="' . sprintf("%02d", $ora) . ':00">' . sprintf("%02d", $ora) . ':00</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Dërgo</button>

              </form>


           

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
      
        </div>
      </div>
    </div>

<!-- Footer -->

<!-- Footer -->
</html>
