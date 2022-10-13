<?php
require "../functions.php";
session_start();
if (isset($_POST['newPass'])) {
    $password1 = mysqli_real_escape_string($conn, $_POST['password1']);
    $password2 = mysqli_real_escape_string($conn, $_POST['password2']);

    if ($password1 !== $password2) {
        header("Localhost: newPassword.php?message=Confirm Password does not match");
        die;
    } else {
        if (strlen(trim($password1)) < 8) {
            header("Localhost: newPassword.php?message=Use 8 or more character with a mix of letters, number & symbols");
            die;
        }
        $password = password_hash($password1, PASSWORD_BCRYPT);
        $email = $_SESSION['myEmail'];
        $query = "UPDATE user SET password = '$password' WHERE email = '$email'";
        $updatePass = mysqli_query($conn, $query) or die("Query Failed");
        session_unset($email);
        session_destroy();
        header("Location: ../profile.php");
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

    <title>Change Password</title>
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
                <h3 class="text-center">Change Password</h3>
            </div>
            <?php if (isset($_GET['message'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_GET['message']; ?>
                </div>
            <?php endif ?>
            <form action="newPassword.php" method="post">
                <div class="mb-3">
                    <input type="password" class="form-control" name="password1" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password2" placeholder="Confirm Password" required>
                </div>
                <center><button style="background-color: #141E61;" type="submit" name="newPass" class="btn text-white">Change</button></center>
                <span class="m-auto">Back to <a href="../index.php">dashboard</a></span class="text-center">
            </form>
        </div>
    </div>
    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>