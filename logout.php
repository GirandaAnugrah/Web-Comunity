<?php 
    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();
    if(isset($_GET['change'])){
        header("Location: profile.php");
        die;
    }
    header("Location: index.php");
?>