<?php
require "functions.php";
$id = mysqli_real_escape_string($conn, $_POST['key']);
if ($_POST['key'] == NULL) {
    die;
}

$param = "%{$id}%";
$stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE username LIKE ? LIMIT 5");
mysqli_stmt_bind_param($stmt, "s", $param);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

?>

<div style="width: 120px;" class="bg-white rounded-bottom rounded-end">
    <?php while ($val = mysqli_fetch_assoc($result)) : ?>
        <div class="d-flex m-2">
            <img width="20px" height="20px" class="rounded-circle mt-2" src="img/profil/<?= $val['foto_profil']; ?>" alt="">
            <a class="text-decoration-none text-dark fw-bold m-2" href="detailuser.php?id=<?= $val['id']; ?>"><?= $val['username']; ?></a> <br>
        </div>
    <?php endwhile ?>
</div>