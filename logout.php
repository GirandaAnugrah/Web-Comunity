<?php 
    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();
    if(isset($_GET['back'])){
        header("Location: profile.php");
        die;
    }
    header("Location: index.php");
?>