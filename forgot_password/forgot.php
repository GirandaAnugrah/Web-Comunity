<?php
include('../functions.php');
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// require '../vendor/phpmailer/autoload.php';

if (isset($_POST['forgot'])) {
    $email = $_POST['email'];
    $checkEmail = "SELECT * FROM user WHERE email = '$email'";
    $checkresult = mysqli_query($conn, $checkEmail);
    if (mysqli_num_rows($checkresult) > 0) {
        $_SESSION['myEmail'] = $email;
        $code = rand(999999, 111111);
        $updateCode = "UPDATE user SET code = $code WHERE email = '$email'";
        $updateRes = mysqli_query($conn, $updateCode);
        if ($updateRes) {
            try {
                $sender = 'giranda19okt2003@gmail.com';
                $name_sender = "Neko Care";
                $subject = "Email Verification Code";
                $message = "our verification code is $code";
                $mail = new PHPMailer(true);
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = $sender;
                $mail->Password = 'xzyshmayhtwiwdha';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;
                $mail->SMTPSecure = 'ssl';

                $mail->setFrom($sender, $name_sender);
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $message;

                $send = $mail->send();
            } catch (Exception $e) {
                echo "Mailer Error";
            }
            if ($send) {
                $message = "We've sent a verification code to your Email <br> $email";
                // $_SESSION['message'] = $message;
                header("location: ./otp.php?message=$message");
            } else {
                header("Location : ./forgot.php?error=Failed while sending code!");
            }
        } else {
            header("Location : ./forgot.php?error=Failed inserting data into database");
        }
    } else {
        header("Location: ./forgot.php?error=Failed your email is not registered");
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

    <title>Forgot password</title>
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
                <h3 class="text-center">Forgot Password</h3>
            </div>
            <?php if (isset($_GET['error'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_GET['error']; ?>
                </div>
            <?php endif ?>
            <form action="forgot.php" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                </div>
                <center><button style="background-color: #141E61;" type="submit" name="forgot" class="btn text-white">Send Email</button></center>
            </form>
        </div>
    </div>
    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>