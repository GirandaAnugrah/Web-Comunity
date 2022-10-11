<?php 
require 'functions.php';
$idPosting = $_POST['idPosting'];
if(isset($_POST['newComment'])){
    $comment = $_POST['newComment'];
    $idUser = $_POST['idUser'];
    $date = date("Y-m-d h:i:s");
    $insert = "INSERT INTO comment(id_postingan,id_user,comment,tanggal_comment)
            VALUES('$idPosting','$idUser','$comment','$date')";
    mysqli_query($conn,$insert);
    $query = "SELECT * FROM comment WHERE id_postingan = '$idPosting' ORDER BY tanggal_comment";
}else{
    $query = "SELECT * FROM comment WHERE id_postingan = '$idPosting' ORDER BY tanggal_comment";
}
$myComment = query($query);
function getValue($id,$name){
    $query = "SELECT $name FROM user WHERE id = $id";
    $res = getData($query,"$name");
    return $res;
  }
?>
    <?php foreach($myComment as $com) : ?>
    <div class="d-flex justify-content-between">
        <div class="commment rounded-pill my-2">
            <img width="20px" height="20px" class="rounded-circle" src="img/profil/<?= getValue($com['id_user'],'foto_profil') ?>" alt="">
        <span class="fw-bold fs-6"><?= getValue($com['id_user'],'username') ?></span>
        <span><?= $com['comment']; ?></span>
        </div>
        <div class="likeComment m-2">
            <a<i class="bi bi-hand-thumbs-up"></i></a>
        </div>
    </div>
    <?php endforeach ?>