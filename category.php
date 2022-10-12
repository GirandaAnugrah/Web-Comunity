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
function getJmlLike($id){
  $query = query("SELECT * FROM likes WHERE id_postingan = '$id'");
  $likes = 0;
  foreach($query as $val) {
    $likes++;
  }
  return $likes;
}
function getAmountCommentar($id){
  $query = query("SELECT * FROM comment WHERE id_postingan = '$id'");
  $jml = 0;
  foreach($query as $val) {
    $jml++;
  }
  return $jml;
}
function selisihWaktu($time){
  $waktu_awal =strtotime($time);
  $waktu_akhir =strtotime(date("Y-m-d h:i:s"));
  $diff =$waktu_akhir - $waktu_awal;
  $jam =floor($diff / (60 * 60));
  $menit = $diff - $jam * (60 * 60);
  if($jam > 24){
    $now = floor($jam/24);
    return $now ." hari yang lalu";
  }else{
    if($jam < 1){
      return floor($menit/60) . " menit yang lalu";
    }
    return $jam . " jam Yang lalu";
  }
}

function checkLikes($idPost, $idUser){
  global $conn;
  $query = "SELECT * FROM likes WHERE id_postingan = '$idPost' AND id_user = '$idUser'";
  $row = mysqli_query($conn,$query);
  $cek = mysqli_num_rows($row);
    if(empty($cek)){       
        return false;
    }
    return true;
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
  <link rel="stylesheet" href="style.css">
    <title>Category</title>
    <style>
    body {
        background-color: #C6CCE0;
      }
      #dashbord::-webkit-scrollbar {
        display: none;
      }
  </style>
  </head>
  <body>
  <?php include('navbar.php'); ?>
  <nav class="fixed-top d-xxl-none ">
      <?php include('view/footerSm.php') ?>
    </nav>

  <div class="container col-md-9 mt-5 rounded bg-white">
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
      <div class="row">
      <div class="col-md-4 mt-3 d-none d-xl-block">
          <?php include('navLeft.php') ?>
      </div>
        <div class="col-md-8">
        <div id="dashbord" style="height: 630px;" class="container col-md-10 mt-5 overflow-auto">
          <?php foreach($postingan as $val) : ?>
              <div class="card shadow-sm col-md-11  mt-4 m-auto" >
                <div class="border-bottom">
                  <div class="dflex m-2">
                    <div class="user d-flex ">
                      <div class="img">
                        <img class="border border-dark rounded-circle " width="40px" height="40px" src="img/profil/<?= getValue($val['id_user'],'foto_profil'); ?>"  alt="">
                      </div>
                      <div class="inf">
                        <a class="text-decoration-none text-dark fw-bold mx-2 my-2" href="detailuser.php?id=<?= $val['id_user']; ?>"><?= getValue($val['id_user'],'username'); ?></a> <br>
                        <span style="opacity: 0.5;" class="m-2 fs-6"><?= selisihWaktu($val['tanggal_posting']); ?></span class="inline-block">
                      </div>
                      <!-- <?php if(isset($_SESSION['login']) && ($_SESSION['id_user'] == $val['id_user'] || $_SESSION['user_type'] == 'admin')) : ?>
                      <form action="index.php" method="post">
                        <input type="hidden" name="postID" value="<?= $val['id']?>" />
                        <button type="submit" class="btn btn-danger" name="deleteAction" value="Delete"><span class="bi bi-trash"></span></button>
                      </form>
                    <?php endif ?> -->
                    </div>

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
                  <span class="inline ms-2 fs-6 mt-2 bd-highlight jmlLike<?= $val['id']; ?>"><?= getJmlLike($val['id']); ?></span><span class="m-2">Likes</span>
                  <span style="opacity: 0.5;" class="inline ms-auto fs-6 mt-2 bd-highlight"><?= getAmountCommentar($val['id']); ?> Comments</span>
                  </div>
                <div class="d-flex border-top">
                  <?php if(!isset( $_SESSION['id_user'])){ ?>
                    <div class="mx-4 my-auto"><a style="color: black;" class="fs-3" ><i class="bi bi-heart"></i></a></div>
                  <?php }else if(checkLikes($val['id'], $_SESSION['id_user'])){ ?>
                    <div class="mx-4 my-auto"><a  class="like fs-3 text-danger"><i class="bi bi-heart-fill"></i></a></div>
                  <?php }else { ?>
                    <div class="mx-4 my-auto"><a style="color: black;" class="like fs-3" data-id="<?= $val['id']; ?>" data-user="<?= $_SESSION['id_user']; ?>"><i class="bi bi-heart"></i></a></div>
                  <?php } ?>
                  <div class="ms-2 my-auto"><a class="fs-3 posting text-dark" data-img="<?= $val['postingan_gambar']; ?>" data-username="<?= getValue($val['id_user'],'username'); ?>" data-profil="<?= getValue($val['id_user'],'foto_profil'); ?>" data-text="<?= $val['postingan_text']; ?>" data-id="<?= $val['id']; ?>" data-kategori="<?= $val['kategori']; ?>"><i class="bi bi-chat"></i></a></div>
                </div>
              </div>
            <?php endforeach ?>
          </div>
        </div>
      </div>
      
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
                    <div class="user">
                      <p id="detailUsername" class="fw-bold mx-2 my-1"></p>
                      <span id="tanggal" style="opacity: 0.5;" class="mx-1 my-1 fs-6"></span>
                    </div>
                  </div>
                  <div class="detailtext">
                    <p id="detailText"></p>
                    <div style="height: 400px;" id="modalComment" class="mt-2  overflow-auto">
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
      $(this).addClass("text-danger")
      $(this).children().removeClass("bi-heart");
      $(this).children().addClass("bi-heart-fill");
      const id = $(this).data("id");
      const user = $(this).data("user");
      console.log(id + " "+ user);
      const param = ".jmlLike" + id.toString();
      $(param).load("like.php",{
        idPosting : id,
        idUser: user
      })
    })
    $(".likeComm").click(function(){
        $(this).addClass("text-danger");
        $(this).children().removeClass("bi-heart");
        $(this).children().addClass("bi-heart-fill");
    })
  })

    </script>
        <script src="js/script.js"></script>
  </body>
</html>