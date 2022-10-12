<?php 
require '../functions.php';
$idP = $_POST['idP'];
$idU = $_POST['idU'];
$query = "SELECT jml_like FROM comment WHERE id_postingan = '$idP' AND id_user = '$idU'";
$jml = mysqli_query($conn,$query);
$jml = $jml +1;


?>