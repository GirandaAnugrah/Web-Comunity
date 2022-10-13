<?php
require 'functions.php';
session_start();
$idPosting = $_POST['idPosting'];

if (isset($_POST['delComment'])) {
    $idCom = $_POST['idComment'];
    $query = "DELETE FROM commentlike WHERE id_comment = '$idCom'";
    mysqli_query($conn, $query);
    $query = "DELETE FROM comment WHERE id = '$idCom'";
    mysqli_query($conn, $query);
    unset($_POST['delComment']);
}
if (isset($_POST['likeComment'])) {
    $id_user = $_POST['idUser'];
    $id_comment = $_POST['idComment'];
    $query = "INSERT INTO commentlike(id_comment,id_user) VALUES ('$id_comment','$id_user')";
    mysqli_query($conn, $query);
    unset($_POST['delComment']);
}
if (isset($_POST['newComment'])) {
    $comment = $_POST['newComment'];
    $idUser = $_POST['idUser'];
    $date = date("Y-m-d h:i:s");
    $insert = "INSERT INTO comment(id_postingan,id_user,comment,tanggal_comment)
            VALUES('$idPosting','$idUser','$comment','$date')";
    mysqli_query($conn, $insert);
    $query = "SELECT * FROM comment WHERE id_postingan = '$idPosting' ORDER BY tanggal_comment";
} else {
    $query = "SELECT * FROM comment WHERE id_postingan = '$idPosting' ORDER BY tanggal_comment";
}


$myComment = query($query);
function getValue($id, $name)
{
    $query = "SELECT $name FROM user WHERE id = $id";
    $res = getData($query, "$name");
    return $res;
}

function checkLike($idU, $idC)
{
    global $conn;
    $query = "SELECT * FROM commentlike WHERE id_comment = '$idC' AND id_user = '$idU'";
    $check = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($check);
    if (empty($row)) {
        return 'text-dark';
    } else {
        return 'text-danger';
    }
}
?>
<div id="commen" class="comen">
    <?php foreach ($myComment as $com) : ?>
        <div class="d-flex justify-content-between">
            <?php if (isset($_SESSION['user_type'])) : ?>
                <?php if ($_SESSION['user_type'] === 'admin' || $_SESSION['id_user'] === $com['id_user']) : ?>
                    <a class="my-2 text-danger delCom" id="<?= $com['id']; ?>" Post="<?= $idPosting; ?>"><span class="bi bi-trash"></span></a>
                <?php endif ?>
            <?php endif ?>
            <div class="commment col-10 rounded-pill my-2">
                <img width="20px" height="20px" class="rounded-circle" src="img/profil/<?= getValue($com['id_user'], 'foto_profil') ?>" alt="">
                <span class="fw-bold fs-6"><?= getValue($com['id_user'], 'username') ?></span>
                <span><?= $com['comment']; ?></span>
            </div>
            <div class="hidden"></div>
            <div class="likeComment m-2">
                <a style="color: black;" class="likeComm <?= checkLike($_SESSION['id_user'], $com['id']); ?>" idP="<?= $idPosting; ?>" idU="<?= $_SESSION['id_user']; ?>" idC="<?= $com['id']; ?>"><i class="bi bi-heart"></i></a>
            </div>
        </div>
    <?php endforeach ?>
</div>
<script>
    // console.log("ini like comment");
    $(".likeComm").click(function() {
        const idU = $(this).attr('idU');
        const idC = $(this).attr('idC');
        const idP = $(this).attr('idP');
        $(this).addClass("text-danger");
        $(this).children().removeClass("bi-heart");
        $(this).children().addClass("bi-heart-fill");
        $("#commen").load("comment.php", {
            idPosting: idP,
            idUser: idU,
            idComment: idC,
            likeComment: true
        });
    });
    $(document).ready(function() {
        $(".delCom").click(function() {
            const idU = $(this).attr("id");
            const idP = $(this).attr("Post");

            $("#commen").load("comment.php", {
                idPosting: idP,
                idComment: idU,
                delComment: true
            });
        });
    });
</script>