<div class="card shadow-sm col-md-12  mt-4">
    <div class="border-bottom">
        <div class="dflex m-2">
            <div class="user d-flex bd-highlight">
                <div class="img">
                    <img class="border border-dark rounded-circle " width="40px" height="40px" src="img/profil/<?= getValue($val['id_user'], 'foto_profil'); ?>" alt="">
                </div>
                <div class="inf">
                    <a class="text-decoration-none text-dark fw-bold mx-2 my-2" href="detailuser.php?id=<?= $val['id_user']; ?>"><?= getValue($val['id_user'], 'username'); ?> | <?= strtoupper($val['kategori']); ?></a> <br>
                    <span style="opacity: 0.5;" class="m-2 fs-6"><?= selisihWaktu($val['tanggal_posting']); ?></span class="inline-block">
                </div>
                <?php if (isset($_SESSION['user_type'])) : ?>
                    <?php if ($_SESSION['user_type'] === 'admin' || $_SESSION['id_user'] === $val['id_user']) : ?>
                        <form action="#" class="bd-highlight ms-auto" method="post">
                            <button type="submit" class="btn btn-danger" name="deleteAction" value="Delete"><span class="bi bi-trash"></span></button>
                            <input type="hidden" name="postID" value="<?= $val['id'] ?>" />
                        </form>
                    <?php endif ?>
                <?php endif ?>
            </div>

        </div>
    </div>
    <div class="content">
        <div class="card-body">
            <p class="card-text"><?= $val['postingan_text']; ?></p>
        </div>
        <?php if ($val['postingan_gambar'] !== '-1') : ?>
            <img src="img/posting/<?= $val['postingan_gambar']; ?>" class="card-img-top border-bottom" alt="...">
        <?php endif ?>
    </div>
    <div class="d-flex">
        <span class="inline ms-2 fs-6 mt-2 bd-highlight jmlLike<?= $val['id']; ?>"><?= getJmlLike($val['id']); ?></span><span class="m-2">Likes</span>
        <span style="opacity: 0.5;" class="inline ms-auto fs-6 mt-2 bd-highlight"><?= getAmountCommentar($val['id']); ?> Comments</span>
    </div>
    <div class="d-flex border-top">


        <?php if (isset($_SESSION['login'])) : ?>
            <div class="mx-4 my-auto"><a style="color: black;" class="like fs-3 <?= checkLikes($val['id'], $_SESSION['id_user']); ?>" data-id="<?php echo $val['id'] ?>" data-user="<?= $_SESSION['id_user']; ?>"><i class="bi <?= getLove($val['id']); ?>"></i></a></div>
        <?php else : ?>
            <div class="mx-4 my-auto"><a class="fs-3 text-dark"><i class="bi bi-heart"></i></a></div>
        <?php endif ?>
        <div class="ms-2 my-auto"><a class="fs-3 posting text-dark" data-img="<?= $val['postingan_gambar']; ?>" data-username="<?= getValue($val['id_user'], 'username'); ?>" data-profil="<?= getValue($val['id_user'], 'foto_profil'); ?>" data-text="<?= $val['postingan_text']; ?>" data-id="<?= $val['id']; ?>" data-kategori="<?= $val['kategori']; ?>"><i class="bi bi-chat"></i></a></div>
    </div>
</div>