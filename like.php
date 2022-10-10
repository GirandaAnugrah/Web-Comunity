<?php 
require 'functions.php';
$idPosting = $_POST['idPosting'];
if(isset($_POST['idUser'])){
    $idUser = $_POST['idUser'];
    $date = date("Y-m-d h:i:s");
    $query = mysqli_query($conn,"SELECT * FROM likes WHERE id_user = '$idUser' AND id_postingan = '$idPosting'");
    $cek = mysqli_num_rows($query);
    if(empty($cek)){       
        $query = "INSERT INTO likes(id_postingan,id_user,waktu)
        VALUES('$idPosting','$idUser','$date')";
        mysqli_query($conn,$query); 
    }
}
$like = query("SELECT * FROM likes WHERE id_postingan = '$idPosting'");
$jml = 0;
foreach($like as $val){
    $jml++;
}
?>

<span><?= $jml; ?></span>