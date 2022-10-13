<?php
require 'functions.php';
session_start();
$error = false;
if (isset($_POST['signUp'])) {
  if (signUp($_POST) > 0) {
    $_SESSION['login'] = true;
    $_SESSION['user_login'] = $_POST['username'];
  } else {
    header("Location: profile.php?error-message=Data entry failed");
  }
}
if (isset($_POST['login'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
  if (mysqli_num_rows($result)) {
    $row = mysqli_fetch_assoc($result);
    if ($row['status'] != NULL) {
      header("Location: profile.php?error-message=Your account has been banned");
      die;
    }
    if ($row['tmp_bann'] != NULL) {
      $dateNow = date('Y-m-d h:i:s');
      $send_date = date("Y-m-d h:i:s", strtotime($row['tmp_bann']));
      if ($dateNow < $send_date) {
        header("Location: profile.php?error-message=Your account has been banned until $send_date");
        die;
      } else {
        unBann_tmp($row['id']);
      }
    }
    if (password_verify($password, $row["password"])) {
      $_SESSION['login'] = true;
      $_SESSION['user_login'] = $username;
      header("Location: profile.php");
      die;
    } else {
      header("Location: profile.php?error-message=Password does not match");
      die;
    }
  } else {
    header("Location: profile.php?error-message=Username not found");
    die;
  }
}
if (isset($_GET['error-message'])) {
  $error = $_GET['error-message'];
}

if (isset($_POST['changePhoto'])) {
  changeFotoProfile($_POST);
  header("Location: profile.php");
}

if (isset($_SESSION['login'])) {
  $username = mysqli_real_escape_string($conn, $_SESSION['user_login']);
  $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
  $row = mysqli_fetch_assoc($result);
  $_SESSION['id_user'] = $row['id'];
  $_SESSION['foto_profil'] = $row['foto_profil'];
  $_SESSION['user_type'] = $row['usertype'];
  $userid = $row['id'];
  $userid = mysqli_real_escape_string($conn, $row['id']);
  $postingan = query("SELECT * FROM postingan WHERE id_user = '$userid' ORDER BY id DESC");
  $kiriman = 0;
  $jmlLike = 0;
  foreach ($postingan as $val) {
    $kiriman++;
    $jmlLike += $val['jml_like'];
  }
  $follower = mysqli_query($conn, "SELECT (SELECT foto_profil FROM user WHERE id = id_follower) foto,
                                         (SELECT username FROM user WHERE id = id_follower) myusername FROM follower WHERE id_user = '$userid'");
  // var_dump($follower);die;
  $jmlFol = query("SELECT id_user FROM follower WHERE id_user = $userid");
  $jmlFol = count($jmlFol);
}



if (isset($_POST['send'])) {
  if (posting($_POST) > 0) {
    header("Location: profile.php");
  } else {
    header("Location: profile.php?error-message=Data entry failed");
  }
}

if (isset($_POST['deleteAction'])) {
  $idpostingan = $_POST['postID'];
  $query = "DELETE FROM comment WHERE id_postingan = '$idpostingan';";
  $query .= "DELETE FROM likes WHERE id_postingan = '$idpostingan';";
  $query .= "DELETE FROM postingan WHERE id = '$idpostingan'";
  mysqli_multi_query($conn, $query);
  header("Location: profile.php");
  unset($_POST['deleteAction']);
}



function handleLike()
{
  global $postingan;
  $jml = 0;
  foreach ($postingan  as $val) {
    $jml +=  getLike($val['id']);
  }
  return $jml;
}

function getValue($id, $name)
{
  $query = "SELECT $name FROM user WHERE id = $id";
  $res = getData($query, "$name");
  return $res;
}
function getJmlLike($id)
{
  $query = query("SELECT * FROM likes WHERE id_postingan = '$id'");
  $likes = 0;
  foreach ($query as $val) {
    $likes++;
  }
  return $likes;
}
function getAmountCommentar($id)
{
  $query = query("SELECT * FROM comment WHERE id_postingan = '$id'");
  $jml = 0;
  foreach ($query as $val) {
    $jml++;
  }
  return $jml;
}
function selisihWaktu($time)
{
  $waktu_awal = strtotime($time);
  $waktu_akhir = strtotime(date("Y-m-d h:i:s"));
  $diff = $waktu_akhir - $waktu_awal;
  $jam = floor($diff / (60 * 60));
  $menit = $diff - $jam * (60 * 60);
  if ($jam > 24) {
    $now = floor($jam / 24);
    return $now . " hari yang lalu";
  } else {
    if ($jam < 1) {
      return floor($menit / 60) . " menit yang lalu";
    }
    return $jam . " jam Yang lalu";
  }
}


function checkLikes($idPost, $idUser)
{
  global $conn;
  $query = "SELECT * FROM likes WHERE id_postingan = '$idPost' AND id_user = '$idUser'";
  $row = mysqli_query($conn, $query);
  if (mysqli_num_rows($row) > 0) {
    return "text-danger";
  }
  return "text-dark";
}

function getLove($id)
{
  $user = $_SESSION['id_user'];
  if (checkLikes($id, $user) === 'text-danger') return "bi-heart-fill";
  else return "bi-heart";
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <script src="js/jquery-3.6.1.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <title>Profile</title>
  <style>
    body {
      background-color: #C6CCE0;
    }
  </style>
</head>
<?php
if (!isset($_SESSION['login'])) {
  echo "
            <script>
            $(document).ready(function(){
                    $('#myModal').modal('show');
            });
            </script>
            ";
} else {
  echo '
            <script>
            $(document).ready(function(){
                $("#content").removeClass("visually-hidden");
                $("#conDefault").addClass("visually-hidden");
            });
            </script>
            ';
}
if (isset($_GET['posting']) && isset($_SESSION['login'])) {
  echo "
          <script>
          $(document).ready(function(){
                  $('#postingModal').modal('show');
          });
          </script>
      ";
}
?>

<body>
  <nav class="fixed-top d-xxl-none ">
    <?php include('view/footerSm.php') ?>
  </nav>
  <div class="modal" id="myModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php if (isset($_GET['signUp'])) include('view/signUp.php');
    else if (!isset($_SESSION['login'])) include('view/login.php');
    else include('view/edit_fotoprofile.php'); ?>
  </div>
  <?php include('navbar.php'); ?>
  <div id="postingModal" class="modal">
    <?php include('view/postingan.php'); ?>
  </div>
  <div id="conDefault" class="container mt-5 col-md-9">
    <div class="row mb-3 d-flex flex-row justify-content-around border-bottom bg-white shadow-sm">
      <div class="col-md-3 m-3 d-md-m-auto">
        <img width="150px" height="150px" class="rounded-circle border border-primary" src="img/profil/default-profile.png" alt="">
      </div>
      <div class="col-md-8 m-3">
        <div class="clearfix">
          <h3 class="float-start">User12345</h3>
          <form action="#" method="post">
            <button class="badge rounded-pill bg-primary border-white shadow-sm mx-2 mt-2">Edit Profile</button>
          </form>
        </div>
        <div class="d-flex">
          <h5>0 Kiriman</h5>
          <h5 class="mx-3">0 Followers</h5>
          <h5 class="mx-3">0 Likes</h5>
        </div>

      </div>
    </div>
  </div>
  <div style="background-color: #C6CCE0;" id="content" class="container mt-5 col-md-9 visually-hidden">
    <div class="row mb-3 d-flex flex-row justify-content-around bg-white border-bottom shadow-sm rounded-3">
      <div class="col-md-3 m-3 d-md-m-auto">
        <img id="foto-profil" width="150px" height="150px" class="rounded-circle border border-primary" src="img/profil/<?= $row['foto_profil']; ?>" alt="">
        <form id="changeFotoProfile" class="visually-hidden" action="profile.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $row['id']; ?>">
          <div class="col-8">
            <center><label for="formFileSm" class="form-label text-center">Change foto Profile</label></center>
            <input class="form-control form-control-sm" id="formFileSm" type="file" name="foto_profil">
          </div>
          <button class="badge rounded-pill bg-primary border-white shadow-sm mt-1" name="changePhoto">Edit Profile</button>
        </form>
      </div>
      <div class="col-md-8 m-3">
        <div class="clearfix">
          <h3 class="float-start"><?= $row['username']; ?></h3>
          <form action="view/editprofile.php" method="post">
            <input type="hidden" name="key" value="<?= $row['id']; ?>">
            <button class="badge rounded-pill bg-primary border-white shadow-sm mx-2 mt-2">Edit Profile</button>
          </form>
          <?php if (isset($_SESSION['user_type'])) : ?>
            <?php if ($_SESSION['user_type'] == 'admin') : ?>
              <a href="adminData.php" class="badge rounded-pill bg-success text-decoration-none rounded-pill float-end">Statistic Admin</a>
            <?php endif ?>
          <?php endif ?>
        </div>
        <div class="d-flex">
          <h5><?= $kiriman; ?> Kiriman</h5>
          <h5 class="mx-3"><?= $jmlFol; ?> Followers</h5>
          <h5 class="mx-3"><?= handleLike(); ?> Likes</h5>
        </div>
        <p class="fw-bold fs-5"><?= $row['nama']; ?></p>
        <p><?= $row['description']; ?></p>
      </div>
    </div>
    <!-- Postingan -->
    <div class="row container mx-auto">
      <div class="col-md-6">
        <?php if ($follower != NULL) : ?>
          <div class="rounded d-none d-xxl-block bg-white shadow">
            <h5 class="text-center m-3">Follow</h5>
            <div class="d-flex flex-wrap justify-content-around">
              <?php $i = 0;
              while ($val = mysqli_fetch_assoc($follower)) {
                $i++; ?>
                <div class="p-2">
                  <img height="120px" width="120px" src="img/profil/<?= $val['foto']; ?>" class="img-thumbnail mt-2" alt="...">
                  <p class="text-center"><?= $val['myusername']; ?></p>
                </div>
              <?php if ($i > 5) break;
              } ?>
            </div>
          </div>
        <?php endif ?>
      </div>
      <div id="my-post" class="col-md-6 overflow-auto">
        <div id="postingan_text" class="postingan">
          <div class="bg-white rounded-3 shadow">
            <div id="postingan_text" class="p-4">
              <div style="background-color: #eeee;" class="border rounded-pill">
                <h5 class="mx-3 m-2">What do you think now?</h5>
              </div>
            </div>
          </div>
        </div>
        <?php foreach ($postingan as $val) : ?>
          <?php include("card.php") ?>
        <?php endforeach ?>
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
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div style="height: 650px;" id="gambarDt" class="col-md-7 overflow-auto">
                <img id="imgPosting" class="m-auto" src="img/posting/2.jpg" alt="">
              </div>
              <div id="sesuai" class="col-md-5 ms-auto">
                <div class="username d-flex border-bottom">
                  <img id="detailProfile" width="25px" height="25px" class="rounded-circle border border-secondary m-2" alt="">
                  <div class="user">
                    <p id="detailUsername" class="fw-bold mx-2 my-1"></p>
                    <span id="tanggal" style="opacity: 0.5;" class="mx-1 my-1 fs-6"></span>
                  </div>
                </div>
                <div class="detailtext">
                  <p id="detailText"></p>
                  <div style="height: 350px;" id="modalComment" class="mt-2  overflow-auto">
                  </div>
                  <div class="my-2">
                    <form action="#" id="form" class="d-flex my-2 form" data-user="<?= $_SESSION['id_user']; ?>">
                      <?php if (isset($_SESSION['foto_profil'])) : ?>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="js/script.js"></script>

  <script>
    $(document).ready(function() {
      $(".form").submit(function(event) {
        const id = $(this).data("id");
        const user = $(this).data("user");
        const key = ".comment" + id.toString();
        const com = $("#inputComment").val();
        const param = ".com" + id.toString();
        $(param).load("comment.php", {
          newComment: com,
          idPosting: id,
          idUser: user
        })
        $(key).val(null);
        event.preventDefault();
      });

      $('.like').click(function() {
        var postid = $(this).attr('id');
        var userid = $(this).data("user");
        $(this).toggleClass("text-danger");
        $(this).toggleClass("text-dark");
        $(this).children().toggleClass("bi-heart-fill");
        $(this).children().toggleClass("bi-heart");
        const id = $(this).data("id");
        const user = $(this).data("user");
        const param = ".jmlLike" + id.toString();
        $(param).load("like.php", {
          postid: id,
          userid: user,
          liked: true
        })
      })

      $(".posting").click(function() {
        if ($(window).width() < 767) {
          console.log("Hello");
          $("#my-post").removeClass("overflow-auto");
          $("#imgPosting").removeAttr("src");
          $("#gambarDt").addClass("visually-hidden");
          $("#besarModal").removeClass("modal-xl");
          $("#sesuai").removeClass("col-md-5");
          $("#sesuai").addClass("col-md-12");
        }
      })

    })
  </script>
  <script src="js/script.js"></script>
</body>

</html>