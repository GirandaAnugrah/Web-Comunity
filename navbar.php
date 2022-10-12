<nav style="background-color: #141E61;" class="navbar navbar-expand-lg navbar-dark prim shadow-sm fixed-top d-none d-xxl-block">
  <div class="container-fluid col-md-9">
  <img src="img/profil/neko.png" alt="nekocare" width="50"/>
    <a class="navbar-brand" href="index.php">NekoCare</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarSupportedContent">
      <form class="d-flex m-auto col-md-5">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light rounded-circle" type="submit"><i class="bi bi-search"></i></button>
      </form>
      <div class="logout">
        <?php if(!isset($_SESSION['login'])){ ?>
          <a href="profile.php" class="btn btn-outline-warning text-decoration-none">SignIn</a>
        <?php }else{ ?>
          <a href="logout.php" class="btn btn-outline-warning text-decoration-none">Logout</a>
        <?php } ?>
      </div>
    </div>
  </div>
</nav>