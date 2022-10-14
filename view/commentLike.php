<?php 
require '../functions.php';
$idP = $_POST['idP'];
$idU = $_POST['idU'];
$stmt = mysqli_prepare($conn, "SELECT jml_like FROM comment WHERE id_postingan = ? AND id_user = ?");
mysqli_stmt_bind_param($stmt, "ss", $idP, $idU);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
mysqli_fetch_all($res, MYSQLI_ASSOC);
$jml = $res['jml_like'];
// $query = "SELECT jml_like FROM comment WHERE id_postingan = '$idP' AND id_user = '$idU'";
// $jml = mysqli_query($conn,$query);
$jml = $jml +1;


?>