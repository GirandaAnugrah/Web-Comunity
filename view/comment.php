<?php
session_start();
require '../functions.php';
$id_posting = $_GET['id'];
$id_user = $_SESSION['id_user'];
$comment = $_GET['comment'];
$tgl = date("Y-m-d");
$query = "INSERT INTO comment(id_postingan,id_user,comment,tanggal_comment) 
          VALUES('$id_posting','$id_user','$comment','$tgl')";
mysqli_query($conn,$query);
?>

<h1>Hello World</h1>