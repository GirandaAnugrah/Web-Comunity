<div class="home m-4 rounded-pill "><a href="index.php" class="fs-4 fw-bold text-dark text-decoration-none link-hover"><i class="bi bi-house-door"></i> Home</a></div>
<div class="category m-4 rounded-pill "><a href="category.php?id=1" class="fs-4 fw-bold text-dark text-decoration-none link-hover"><i class="bi bi-stack"></i> Category</a></div>
<?php if (isset($_SESSION['login'])) : ?>
  <div class="profile m-4 rounded-pill "><a href="profile.php" class="fs-4 fw-bold text-dark text-decoration-none link-hover"><img height="30px" width="30px" class="rounded-circle" src="img/profil/<?= $_SESSION['foto_profil']; ?>" alt=""> <?= $_SESSION['user_login']; ?></a></div>
  <div class="profile m-4 rounded-pill "><a href="profile.php?posting=true" class="fs-4 fw-bold text-dark text-decoration-none link-hover"><i class="bi bi-plus-square"></i> Post</a></div>
<?php else : ?>
  <div class="profile m-4 rounded-pill "><a href="profile.php" class="fs-4 fw-bold text-dark text-decoration-none link-hover"><i class="bi bi-person-circle"></i> Profile</a></div>
<?php endif ?>
<div class="note">
  <?php if (!isset($_SESSION['login'])) { ?>
    <p style="opacity: 0.5;">Sign in to follow creators, like videos, and view comments.</p>
    <div class="d-grid gap-2">
      <a href="profile.php" class="btn btn-outline-warning text-decoration-none">LogIn</a>
    </div>
  <?php } ?>
  <div class="categ m-3">
    <div class="d-flex">
      <img height="40px" width="40px" src="img/banner/bann-javascript.png" class="rounded-circle" alt="">
      <a href="category.php?id=1" class="text-decoration-none text-dark m-2 fs-5 link-hover">Javascript</a>
    </div>
    <div class="d-flex">
      <img height="40px" width="40px" src="img/banner/bann-php.png" class="rounded-circle" alt="">
      <a href="category.php?id=2" class="text-decoration-none text-dark m-2 fs-5 link-hover">Php</a>
    </div>
    <div class="d-flex">
      <img height="40px" width="40px" src="img/banner/bann-java.png" class="rounded-circle" alt="">
      <a href="category.php?id=3" class="text-decoration-none text-dark m-2 fs-5 link-hover">Java</a>
    </div>
    <div class="d-flex">
      <img height="40px" width="40px" src="img/banner/bann-golang.png" class="rounded-circle" alt="">
      <a href="category.php?id=4" class="text-decoration-none text-dark m-2 fs-5 link-hover">Golang</a>
    </div>
    <div class="d-flex">
      <img height="40px" width="40px" src="img/banner/bann-ruby.png" class="rounded-circle" alt="">
      <a href="category.php?id=5" class="text-decoration-none text-dark m-2 fs-5 link-hover">Ruby</a>
    </div>
    <div class="d-flex">
      <img height="40px" width="40px" src="img/banner/bann-c++.png" class="rounded-circle" alt="">
      <a href="category.php?id=6" class="text-decoration-none text-dark m-2 fs-5 link-hover">C++</a>
    </div>
  </div>
  <div class="sort">
    <a href="index.php?sort=trend" class="badge bg-light text-dark text-decoration-none">#Trending Now</a>
    <a href="index.php?sort=likes" class="badge m-2 bg-light text-dark text-decoration-none">#Most likes</a>
    <a href="index.php?sort=latest" class="badge m-2 bg-light text-dark text-decoration-none">#Latest</a>
  </div>
</div>