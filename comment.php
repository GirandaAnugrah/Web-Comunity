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
        <div class="hidden"></div>
        <div class="likeComment m-2">
            <a style="color: black;" class="likeComm" data-idP="<?= $idPosting; ?>" data-idU="<?= $com['id_user']; ?>"><i class="bi bi-heart"></i></a>
        </div>
    </div>
    <?php endforeach ?>
<script>
    // console.log("ini like comment");
    $(".likeComm").click(function(){
        const idP = $(this).data('idP');
        const idU = $(this).data('idU');
        $(this).addClass("text-danger");
        $(this).children().removeClass("bi-heart");
        $(this).children().addClass("bi-heart-fill");
        // $(".hidden").load("view/commentLike.php", { idP: idP,idU: idU });
    })
</script>