<div class="home m-4 rounded-pill "><a href="index.php" class="fs-4 fw-bold text-dark text-decoration-none"><i class="bi bi-house-door"></i> Home</a></div>
        <div class="category m-4 rounded-pill "><a href="category.php?id=1" class="fs-4 fw-bold text-dark text-decoration-none"><i class="bi bi-stack"></i> Category</a></div>
        <div class="profile m-4 rounded-pill "><a href="profile.php" class="fs-4 fw-bold text-dark text-decoration-none"><i class="bi bi-person-circle"></i> Profile</a></div>
        <div class="note">
          <?php if(!isset($_SESSION['login'])){ ?>
            <p style="opacity: 0.5;" >Sign in to follow creators, like videos, and view comments.</p>
          <div class="d-grid gap-2">
            <a href="profile.php" class="btn btn-outline-warning text-decoration-none">LogIn</a>
          </div>  
          <?php } ?>
          <div class="categ m-3">
            <div class="d-flex">
              <img height="40px" width="40px" src="img/banner/bann-javascript.png" class="rounded-circle" alt="">
              <a href="category.php?id=1" class="text-decoration-none text-dark m-2 fs-5">Javascript</a>
            </div>
            <div class="d-flex">
              <img height="40px" width="40px" src="img/banner/bann-php.png" class="rounded-circle" alt="">
              <a href="category.php?id=2" class="text-decoration-none text-dark m-2 fs-5">Php</a>
            </div>
            <div class="d-flex">
              <img height="40px" width="40px" src="img/banner/bann-java.png" class="rounded-circle" alt="">
              <a href="category.php?id=3" class="text-decoration-none text-dark m-2 fs-5">Java</a>
            </div>
            <div class="d-flex">
              <img height="40px" width="40px" src="img/banner/bann-golang.png" class="rounded-circle" alt="">
              <a href="category.php?id=4" class="text-decoration-none text-dark m-2 fs-5">Golang</a>
            </div>
            <div class="d-flex">
              <img height="40px" width="40px" src="img/banner/bann-ruby.png" class="rounded-circle" alt="">
              <a href="category.php?id=5" class="text-decoration-none text-dark m-2 fs-5">Ruby</a>
            </div>
            <div class="d-flex">
              <img height="40px" width="40px" src="img/banner/bann-c++.png" class="rounded-circle" alt="">
              <a href="category.php?id=6" class="text-decoration-none text-dark m-2 fs-5">C++</a>
            </div>
          </div>
        </div>