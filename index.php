<?php 
session_start();
require('functions.php');
$postingan = query("SELECT * FROM postingan ORDER BY tanggal_posting DESC");

if(isset($_POST['send_comment'])){
  if(!isset($_SESSION['id_user'])){
    header("Location: profile.php");
    die;
  }
  $idpostingan = $_POST['id_postingan'];
  $iduser = $_POST['id_user'];
  $comment = $_POST['comment'];
  $date = $dateNow = date("Y-m-d");

  $query = "INSERT INTO comment(id_postingan,id_user,comment,tanggal_comment)
            VALUES ('$idpostingan','$iduser','$comment','$date')";
  mysqli_query($conn,$query);
}

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
    <link rel="stylesheet" href="style.css">
    <title>Komunitas Pemrog</title>
  </head>
  <style>
    body{
      background-color: #FFF0F5;
    }
  </style>
  <body>
    <?php include('navbar.php') ?>
    <div class="container col-md-6 mt-5">
      <?php foreach($postingan as $val) : ?>
        <div class="card shadow-sm col-md-8  mt-4" >
          <div class="border-bottom">
            <div class="dflex m-2">
              <img class="border border-dark rounded-circle" width="40px" height="40px" src="img/profil/<?= getValue($val['id_user'],'foto_profil'); ?>" alt="">
              <a class="text-decoration-none text-dark fw-bold mx-2" href="detailuser.php?id=<?= $val['id_user']; ?>"><?= getValue($val['id_user'],'username'); ?></a>
            </div>
          </div>
          <div class="posting" data-img="<?= $val['postingan_gambar']; ?>" data-username="<?= getValue($val['id_user'],'username'); ?>" data-profil="<?= getValue($val['id_user'],'foto_profil'); ?>" data-text="<?= $val['postingan_text']; ?>">
            <div class="card-body">
            <p class="card-text"><?= $val['postingan_text']; ?></p>
            </div>
            <?php if($val['postingan_gambar'] !== '-1') : ?>
              <img src="img/posting/<?= $val['postingan_gambar']; ?>" class="card-img-top border-bottom" alt="...">
            <?php endif ?>
          </div>
            <!-- <h5><?= $val['jml_like']; ?></h5>
            <div class="d-flex border-bottom">
              <h3 class="mx-2"><i class="bi bi-hand-thumbs-up-fill"></i></h3>
              <h3 class="mx-2"><i class="bi bi-chat-dots-fill"></i></h3>
            </div> -->
            <form action="index.php" method="post" class="d-flex my-2">
              <input id="id_post"  type="hidden" name="id_postingan" value="<?= $val['id']; ?>"> 
              <input type="hidden" name="id_user" value="<?= $_SESSION['id_user']; ?>"> 
                <?php if(isset($_SESSION['foto_profil'])): ?>
                  <img width="25px" height="25px" class="rounded-circle border border-secondary m-2" src="img/profil/<?= $_SESSION['foto_profil']; ?>" alt="">
                <?php endif ?>
              <input id="comment" class="form-control rounded-pill" type="text" placeholder="Comment..." aria-label="Comment" name="comment">
              <button id="sendComment" class="btn btn-info rounded-circle mx-2" type="submit" name="send_comment"><i class="bi bi-send-fill"></i></button>
            </form>
        </div>
        <?php endforeach ?>
      </div>
      <footer class="fixed-bottom d-xxl-none ">
      <?php include('footer.php') ?>
    </footer>

    <!-- Modal -->
    <div id="detailPosting" class="modal" tabindex="-1">
      <div id="besarModal" class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-body">
          <div class="container-fluid">
              <div class="row">
                <div id="gambarDt" class="col-md-7 overflow-auto">
                  <img id="imgPosting" src="img/posting/2.jpg" alt="">
                </div>
                <div id="sesuai" class="col-md-5 ms-auto border-start ">
                  <div class="username d-flex border-bottom">
                  <img id="detailProfile" width="25px" height="25px" class="rounded-circle border border-secondary m-2" alt="">
                    <p id="detailUsername" class="fw-bold m-2"></p>
                  </div>
                  <div class="detailtext">
                    <p id="detailText"></p>
                    <div style="height: 400px;" class="comment">
                    </div>
                    <div class="my-2">
                      <form action="index.php" method="post" class="d-flex">
                          <input id="id_post"  type="hidden" name="id_postingan" value="<?= $val['id']; ?>"> 
                          <input type="hidden" name="id_user" value="<?= $_SESSION['id_user']; ?>"> 
                            <?php if(isset($_SESSION['foto_profil'])): ?>
                              <img width="25px" height="25px" class="rounded-circle border border-secondary my-2" src="img/profil/<?= $_SESSION['foto_profil']; ?>" alt="">
                            <?php endif ?>
                          <input id="comment" class="form-control rounded-pill" type="text" placeholder="Comment..." aria-label="Comment" name="comment">
                          <button id="sendComment" class="btn btn-info rounded-circle mx-2" type="submit" name="send_comment"><i class="bi bi-send-fill"></i></button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal -->
    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
  </body>
</html>