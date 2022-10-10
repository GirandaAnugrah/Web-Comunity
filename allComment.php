<?php 
require 'functions.php';
$idPosting = $_POST['idPosting'];
if(isset($_POST['idUser'])){
  
}
$query = "SELECT * FROM comment WHERE id_postingan = '$idPosting' ORDER BY tanggal_comment";
$myComment = query($query);
function getValue($id,$name){
    $query = "SELECT $name FROM user WHERE id = $id";
    $res = getData($query,"$name");
    return $res;
  }
?>
    <?php foreach($myComment as $com) : ?>
    <div class="commment rounded-pill my-2">
        <img width="20px" height="20px" class="rounded-circle" src="img/profil/<?= getValue($com['id_user'],'foto_profil') ?>" alt="">
    <span class="fw-bold fs-6"><?= getValue($com['id_user'],'username') ?></span>
    <span><?= $com['comment']; ?></span>
    </div>
    <?php endforeach ?>