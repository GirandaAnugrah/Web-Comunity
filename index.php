<?php 
require('functions.php');
$postingan = query("SELECT * FROM postingan");

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Komunitas Pemrog</title>
  </head>
  <body>
    <?php include('navbar.php') ?>
    <div class="container col-md-6 mt-5">
      <?php foreach($postingan as $val) : ?>
        <div class="card shadow-sm col-md-8  mt-4">
          <div class="border-bottom">
            <div class="dflex m-2">
              <img class="border border-dark rounded-circle" width="40px" height="40px" src="img/profil/<?= getValue($val['id_user'],'foto_profil'); ?>" alt="">
              <a class="text-decoration-none text-dark fw-bold mx-2" href=""><?= getValue($val['id_user'],'username'); ?></a>
            </div>
          </div>
          <?php if($val['postingan_gambar'] !== NULL) : ?>
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
      <footer class="fixed-bottom d-xxl-none ">
      <?php include('footer.php') ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>