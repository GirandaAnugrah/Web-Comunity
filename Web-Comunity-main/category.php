<?php 
session_start();
require 'functions.php';
$id = $_GET['id'];
$forum = mysqli_query($conn,"SELECT * FROM forum WHERE id = $id");
$forum = mysqli_fetch_assoc($forum);
$postingan = query("SELECT * FROM postingan WHERE id_forum = $id");


function getValue($id,$name){
  $query = "SELECT $name FROM user WHERE id = $id";
  $res = getData($query,"$name");
  return $res;
}
// var_dump($postingan); die;
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <title>Category</title>
  </head>
  <body>
  <?php include('navbar.php'); ?>
  <div class="container col-md-9 mt-5 rounded">
    <div> 
      <img height="400rem" src="img/banner/<?= $forum['banner']; ?>" class="d-block w-100 rounded" alt="...">
    </div>
    <h2><?= $forum['nama_forum']; ?></h2>
    <p><?= $forum['deskripsi']; ?></p>
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link page" href="category.php?id=1">Javascript</a>
        </li>
        <li class="nav-item">
          <a class="nav-link page" href="category.php?id=2">Php</a>
        </li>
        <li class="nav-item">
          <a class="nav-link page" href="category.php?id=3">Java</a>
        </li>
        <li class="nav-item">
          <a class="nav-link page" href="category.php?id=4">Golang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link page" href="category.php?id=5">Ruby</a>
        </li>
        <li class="nav-item">
          <a class="nav-link page" href="category.php?id=6">C++</a>
        </li>
      </ul>
      <div class="container col-md-10 mt-5">
      <?php foreach($postingan as $val) : ?>
        <div class="card shadow-sm col-md-8  mt-4 mx-auto">
            <div class="border-bottom">
              <div class="dflex m-2">
                <img class="border border-dark rounded-circle" width="40px" height="40px" src="img/profil/<?= getValue($val['id_user'],'foto_profil'); ?>" alt="">
                <a class="text-decoration-none text-dark fw-bold mx-2" href=""><?= getValue($val['id_user'],'username'); ?></a>
              </div>
            </div>
            <div class="card-body">
            <p class="card-text"><?= $val['postingan_text']; ?></p>
            </div>
            <?php if($val['postingan_gambar'] !== '-1') : ?>
              <img src="img/posting/<?= $val['postingan_gambar']; ?>" class="card-img-top border-bottom" alt="...">
            <?php endif ?>
              <div class="container_comment"></div>
              <form action="index.php" method="post" class="d-flex my-2">
                <input type="hidden" name="id_postingan" value="<?= $val['id']; ?>"> 
                <input type="hidden" name="id_user" value="<?= $_SESSION['id_user']; ?>"> 
                  <?php if(isset($_SESSION['foto_profil'])): ?>
                    <img width="25px" height="25px" class="rounded-circle border border-secondary m-2" src="img/profil/<?= $_SESSION['foto_profil']; ?>" alt="">
                  <?php endif ?>
                <input class="form-control rounded-pill" type="text" placeholder="Comment..." aria-label="Comment" name="comment">
                <button class="btn btn-info rounded-circle mx-2" type="submit" name="send_comment"><i class="bi bi-send-fill"></i></button>
              </form>
          </div>
          <?php endforeach ?>
      </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>