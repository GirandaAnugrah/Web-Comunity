<?php
require "functions.php";
$id = mysqli_real_escape_string($conn, $_POST['key']);
if ($_POST['key'] == NULL) {
    die;
}

$user = query("SELECT * FROM user WHERE username LIKE '%$id%' LIMIT 5");

?>

<div style="width: 120px;" class="bg-white rounded-bottom rounded-end">
    <?php foreach ($user as $val) : ?>
        <div class="d-flex m-2">
            <img width="20px" height="20px" class="rounded-circle mt-2" src="img/profil/<?= $val['foto_profil']; ?>" alt="">
            <a class="text-decoration-none text-dark fw-bold m-2" href="detailuser.php?id=<?= $val['id']; ?>"><?= $val['username']; ?></a> <br>
        </div>
    <?php endforeach ?>
</div>