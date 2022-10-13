<?php
require "../functions.php";
if (isset($_POST['verify'])) {
    $otp = mysqli_escape_string($conn, $_POST['code']);
    $verifyquery = "SELECT * FROM user WHERE code = '$otp'";
    $runverify = mysqli_query($conn, $verifyquery);
    if ($runverify) {
        if (mysqli_num_rows($runverify) > 0) {
            $newquery = "UPDATE user SET CODE = NULL";
            header("Location: newPassword.php");
        } else {
            header("Location: otp.php?message=Invalid Verification Code");
        }
    } else {
        header("Location: otp.php?message=Failed checking Verification Code");
    }
}


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Verify Email</title>
    <style>
        body {
            background-color: #C6CCE0;
        }

        #forgot {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>
    <div class="jumbotron d-flex align-item-center">
        <div id="forgot" class="container col-md-3 bg-white rounded p-3">
            <div class="text border-bottom">
                <h3 class="text-center">Email Verification</h3>
            </div>
            <?php if (isset($_GET['message'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_GET['message']; ?>
                </div>
            <?php endif ?>
            <form action="otp.php" method="post">
                <div class="mb-3">
                    <input type="number" class="form-control" name="code" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Verification Code" required>
                </div>
                <center><button style="background-color: #141E61;" type="submit" name="verify" class="btn text-white">Verify</button></center>
                <span class="m-auto">Back to <a href="../index.php">main</a></span class="text-center">
            </form>
        </div>
    </div>
    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>