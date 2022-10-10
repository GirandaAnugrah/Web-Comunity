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

function getJmlLike($id){
  $query = query("SELECT * FROM likes WHERE id_postingan = '$id'");
  $likes = 0;
  foreach($query as $val) {
    $likes++;
  }
  return $likes;
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
      background-color: #C6CCE0;
    }
  </style>
  <body>
    <?php include('navbar.php') ?>
    <div class="container col-md-6 mt-5">
      <?php foreach($postingan as $val) : ?>
        <div class="card shadow-sm col-md-8  mt-4" >
          <div class="border-bottom">
            <div class="dflex m-2">
              <img class="border border-dark rounded-circle" width="40px" height="40px" src="img/profil/<?= getValue($val['id_user'],'foto_profil'); ?>"  alt="">
              <a class="text-decoration-none text-dark fw-bold mx-2" href="detailuser.php?id=<?= $val['id_user']; ?>"><?= getValue($val['id_user'],'username'); ?></a>
            </div>
          </div>
          <div class="content">
            <div class="card-body">
            <p class="card-text"><?= $val['postingan_text']; ?></p>
            </div>
            <?php if($val['postingan_gambar'] !== '-1') : ?>
              <img src="img/posting/<?= $val['postingan_gambar']; ?>" class="card-img-top border-bottom" alt="...">
            <?php endif ?>
          </div>
          <div class="d-flex">
            <div class="mx-4 m-2"><span class="jmlLike<?= $val['id']; ?>"><?= getJmlLike($val['id']); ?></span><a class="like fs-3" data-id="<?= $val['id']; ?>" data-user="<?= $_SESSION['id_user']; ?>"><i class="bi bi-hand-thumbs-up"></i></i></a></div>
            <div class="mx-2 m-2"><a class="fs-3 posting" data-img="<?= $val['postingan_gambar']; ?>" data-username="<?= getValue($val['id_user'],'username'); ?>" data-profil="<?= getValue($val['id_user'],'foto_profil'); ?>" data-text="<?= $val['postingan_text']; ?>" data-id="<?= $val['id']; ?>"><i class="bi bi-chat"></i></a></div>
          </div>
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
                  <img id="imgPosting" class="m-auto" src="img/posting/2.jpg" alt="">
                </div>
                <div id="sesuai" class="col-md-5 ms-auto border-start ">
                  <div class="username d-flex border-bottom">
                  <img id="detailProfile" width="25px" height="25px" class="rounded-circle border border-secondary m-2" alt="">
                    <p id="detailUsername" class="fw-bold m-2"></p>
                  </div>
                  <div class="detailtext">
                    <p id="detailText"></p>
                    <div style="height: 400px;" id="modalComment" class="mt-2">
                    </div>
                    <div class="my-2">
                    <form action="#" id="form" class="d-flex my-2 form"  data-user="<?= $_SESSION['id_user']; ?>">
                        <?php if(isset($_SESSION['foto_profil'])): ?>
                          <img width="30px" height="30px" class="rounded-circle border border-secondary m-2" src="img/profil/<?= $_SESSION['foto_profil']; ?>" alt="">
                        <?php endif ?>
                      <input id="inputComment" class="form-control rounded-pill" type="text" placeholder="Comment..." aria-label="Comment">
                      <button class="btn btn-info rounded-circle mx-2 sendComment" type="submit"><i class="bi bi-send-fill"></i></button>
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

    <script>
      $(document).ready(function () {
      $( ".form" ).submit(function( event ) {
        const id = $(this).data("id");
        const user = $(this).data("user");
        const key = ".comment" + id.toString();
        const com = $("#inputComment").val();
        // if(!com){
        //   com = $("#inputComment").val();
        // }
        console.log(key);
        console.log(com);
        const param = ".com" + id.toString();
        $(param).load("comment.php",{
          newComment: com,
          idPosting: id,
          idUser: user
        })
        $(key).val(null);
        event.preventDefault();
      });
    $(".like").click(function(){
      // console.log("hello");
      const id = $(this).data("id");
      const user = $(this).data("user");
      console.log(id + " "+ user);
      const param = ".jmlLike" + id.toString();
      $(param).load("like.php",{
        idPosting : id,
        idUser: user
      })
    })
  })
    </script>
        <script src="js/script.js"></script>
  </body>
</html>