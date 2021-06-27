<?php
session_start();
error_reporting(0);
include('includes/config.php');
if ($_SESSION['alogin'] != '') {
    $_SESSION['alogin'] = '';
}
if (isset($_POST['find'])) {
    $rollid = $_POST['rollid'];
    $sql = "SELECT RollId FROM tblstudents WHERE RollId=:rollid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':rollid', $rollid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $_SESSION['alogin'] = $_POST['rollid'];
        echo "<script type='text/javascript'> document.location = 'results.html'; </script>";
    } else {

        echo "<script>alert('Invalid Details');</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Find Result</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="../frontend/login/images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../frontend/login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../frontend/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../frontend/login/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../frontend/login/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../frontend/login/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../frontend/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="../frontend/login/css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="../frontend/login/images/img-01.png" alt="IMG">
                </div>

                <form action="results.html" class="login100-form validate-form" method="POST">
                    <span class="login100-form-title">
                        School Result Management System
                    </span>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="rollid" pattern="[0-9]{5,}" title="Syntax error" placeholder="Enter your Roll Id " require>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="container-login100-form-btn">
                        <button type="submit" name="find" class="login100-form-btn">
                            Find
                        </button>
                    </div>



                    <div class="text-center p-t-136">
                        <a class="txt2" href="index.html">
                            Back to Home
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!--===============================================================================================-->
    <script src="../frontend/login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="../frontend/login/vendor/bootstrap/js/popper.js"></script>
    <script src="../frontend/login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="../frontend/login/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="../frontend/login/vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="../frontend/login/js/main.js"></script>

</body>


</html>