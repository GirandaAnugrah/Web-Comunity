<?php 
require 'functions.php';
session_start();
if(!isset($_GET['id'])){
    header("Location: index.php");
    die;
}
$id = $_GET['id'];
if(isset($_GET['follow'])){
    $idUser = $_SESSION['id_user'];
    $dateNow = date("Y-m-d");
    $query = "INSERT INTO follower(id_user,id_follower,date_follow)
              VALUES ('$id','$idUser','$dateNow')";
    mysqli_query($conn,$query);
}
$query = "SELECT * FROM user WHERE id = $id";
$user = mysqli_query($conn,$query);
$user = mysqli_fetch_assoc($user);
if($user == NULL){
    header("Location: index.php");
    die;
}
$postingan = query("SELECT * FROM postingan WHERE id_user = '$id' ORDER BY id DESC");
$kiriman = 0;
$jmlLike = 0;
foreach($postingan as $val) {
    $kiriman++;
    $jmlLike += $val['jml_like'];
}
$follower = mysqli_query($conn, "SELECT (SELECT foto_profil FROM user WHERE id = id_follower) foto,
                        (SELECT username FROM user WHERE id = id_follower) myusername FROM follower WHERE id_user = '$id'");

$jmlFol = query("SELECT id_user FROM follower WHERE id_user = $id");
$jmlFol = count($jmlFol);
function getValue($id,$name){
    $query = "SELECT $name FROM user WHERE id = $id";
    $res = getData($query,"$name");
    return $res;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Detail User</title>
    <style>
      body {
        background-color: #C6CCE0;
      }
    </style>
  </head>
  <body>
    <?php include('navbar.php'); ?>
    <div id="conDefault" class="container mt-5 col-md-9">
      <div class="row mb-3 d-flex flex-row justify-content-around border-bottom bg-white shadow-sm">
        <div class="col-md-3 m-3 d-md-m-auto">
              <img  width="150px" height="150px" class="rounded-circle border border-primary" src="img/profil/<?= $user['foto_profil']; ?>" alt="">
        </div>
        <div class="col-md-8 m-3">
              <div class="clearfix">
                <h3 class="float-start"><?= $user['username']; ?></h3>
                <a href="detailuser.php?id=<?= $id; ?>&follow=true" class="badge rounded-pill bg-primary border-white text-decoration-none shadow-sm mx-2 mt-2">Follow</a>
              </div>
              <div class="d-flex">
                <h5><?= $kiriman; ?> Posts</h5> 
                <h5 class="mx-3"><?= $jmlFol; ?> Followers</h5>
                <h5 class="mx-3"><?= $jmlLike; ?> Likes</h5> 
              </div>
              <p><?= $user['description']; ?></p>
        </div>
      </div>
    </div>
    <div class="container col-md-9 m-auto row">
        <div class="col-md-6">
            <?php if($follower != NULL)  :?>
            <div class="rounded d-none d-xxl-block bg-white shadow">
              <h5 class="text-center m-3">Follow</h5>
              <div class="d-flex flex-wrap justify-content-around">
                <?php $i = 0; while($val = mysqli_fetch_assoc($follower)) { $i++;?>
                  <div class="p-2">
                    <img height="120px" width="120px" src="img/profil/<?= $val['foto']; ?>" class="img-thumbnail mt-2" alt="...">
                    <p class="text-center"><?= $val['myusername']; ?></p>
                  </div>
                  <?php if($i > 5) break; } ?>
                </div>
            </div>
            <?php endif ?>
        </div>
        <div class="col-md-6">
            <?php foreach($postingan as $val) : ?>
                <div class="card shadow-sm col-md-10 mt-4 mx-auto" >
                  <div class="border-bottom">
                    <div class="dflex m-2">
                      <img class="border border-dark rounded-circle" width="40px" height="40px" src="img/profil/<?= getValue($val['id_user'],'foto_profil'); ?>" alt="">
                      <a class="text-decoration-none text-dark fw-bold mx-2" href=""><?= getValue($val['id_user'],'username'); ?></a>
                    </div>
                  </div>
                  <?php if($val['postingan_gambar'] !== '-1') : ?>
                    <img src="img/posting/<?= $val['postingan_gambar']; ?>" class="card-img-top" alt="...">
                  <?php endif ?>
                  <div class="card-body">
                    <p class="card-text"><?= $val['postingan_text']; ?></p>
                  </div>
                  <div class="d-flex">
                    <h3 class="m-2"><span><i class="bi bi-heart-fill"></i></span></h3>
                    <h3 class="m-2"><span><i class="bi bi-chat-dots-fill"></i></i></span></h3>
                  </div>
                  <input class="form-control" type="text" placeholder="Comment..." aria-label="Comment">
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>