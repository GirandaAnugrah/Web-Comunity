<?php
require 'functions.php';
session_start();
if (isset($_POST['deleteAction'])) {
  $idUser = $_POST['userID'];
  if (deleteUser($idUser) > 0) {
    header("Location: index.php");
    die;
  }
  header("Location: detailuser.php?id=$idUser");
  unset($_POST['deleteAction']);
  die;
}

if (isset($_POST['banned'])) {
  $id = $_POST['userID'];
  banned($_POST);
  header("Location: detailuser.php?id=$id");
  die;
}
if (isset($_POST['unBanned'])) {
  $id = $_POST['userID'];
  $query = "UPDATE user SET status = NULL WHERE id = $id";
  mysqli_query($conn, $query);
  header("Location: detailuser.php?id=$id");
  die;
}

if (isset($_POST['tmp-bann'])) {
  $id = $_POST['userID'];
  temp_banned($_POST);
  header("Location: detailuser.php?id=$id");
  die;
}

if (isset($_POST['unBann-tmp'])) {
  $id = $_POST['userID'];
  unBann_tmp($id);
  header("Location: detailuser.php?id=$id");
  die;
}

if (!isset($_GET['id'])) {
  header("Location: index.php");
  die;
}
$id = $_GET['id'];
$idUser = $_SESSION['id_user'];
if (isset($_GET['follow'])) {
  $dateNow = date("Y-m-d");
  $query = "INSERT INTO follower(id_user,id_follower,date_follow)
              VALUES ('$id','$idUser','$dateNow')";
  mysqli_query($conn, $query);
}
$query = "SELECT * FROM user WHERE id = $id";
$user = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($user);
if ($user == NULL) {
  header("Location: index.php");
  die;
}
$following = false;
$query = "SELECT date_follow FROM follower WHERE id_user = '$id' AND id_follower = '$idUser'";
$fol = mysqli_query($conn, $query);
if (mysqli_fetch_assoc($fol)) {
  $following = true;
}

$postingan = query("SELECT * FROM postingan WHERE id_user = '$id' ORDER BY id DESC");
$kiriman = 0;
$jmlLike = 0;
foreach ($postingan as $val) {
  $kiriman++;
  $jmlLike += $val['jml_like'];
}
$follower = mysqli_query($conn, "SELECT (SELECT foto_profil FROM user WHERE id = id_follower) foto,
                        (SELECT username FROM user WHERE id = id_follower) myusername FROM follower WHERE id_user = '$id'");

$jmlFol = query("SELECT id_user FROM follower WHERE id_user = $id");
$jmlFol = count($jmlFol);
function getValue($id, $name)
{
  $query = "SELECT $name FROM user WHERE id = $id";
  $res = getData($query, "$name");
  return $res;
}

if (isset($_POST['send_comment'])) {
  if (!isset($_SESSION['id_user'])) {
    header("Location: profile.php");
    die;
  }
  $idpostingan = $_POST['id_postingan'];
  $iduser = $_POST['id_user'];
  $comment = $_POST['comment'];
  $date = $dateNow = date("Y-m-d");

  $query = "INSERT INTO comment(id_postingan,id_user,comment,tanggal_comment)
            VALUES ('$idpostingan','$iduser','$comment','$date')";
  mysqli_query($conn, $query);
}

if (isset($_POST['deleteAction'])) {
  $idpostingan = $_POST['postID'];
  $query = "DELETE FROM likes WHERE id_postingan = $idpostingan";
  mysqli_query($conn, $query);
  $query1 = "DELETE FROM comment WHERE id_postingan = '$idpostingan'";
  mysqli_query($conn, $query1);
  $query2 = "DELETE FROM postingan WHERE id = '$idpostingan'";
  mysqli_query($conn, $query2);
  header("Location: index.php");
  unset($_POST['deleteAction']);
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
    return $now . " days ago";
  } else {
    if ($jam < 1) {
      return floor($menit / 60) . " minutes ago";
    }
    return $jam . " hours ago";
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
        <img width="150px" height="150px" class="rounded-circle border border-primary" src="img/profil/<?= $user['foto_profil']; ?>" alt="">
      </div>
      <div class="col-md-8 m-3 d-flex">
        <div class="d">
          <div class="clearfix">
            <h3 class="float-start"><?= $user['username']; ?></h3>
            <?php if (!$following) : ?>
              <a href="detailuser.php?id=<?= $id; ?>&follow=true" class="badge rounded-pill bg-primary border-white text-decoration-none shadow-sm mx-2 mt-2">Follow</a>
            <?php endif ?>
          </div>
          <div class="d-flex">
            <h5><?= $kiriman; ?> Posts</h5>
            <h5 class="mx-3"><?= $jmlFol; ?> Followers</h5>
            <h5 class="mx-3"><?= $jmlLike; ?> Likes</h5>
          </div>
          <p><?= $user['description']; ?></p>
        </div>
        <?php if (isset($_SESSION['user_type'])) : ?>
          <?php if ($_SESSION['user_type'] == 'admin') : ?>
            <div class="bd-higlight ms-auto">
              <form action="detailuser.php" class="  mt-3" method="post">
                <button style="border: none;" type="submit" class="badge bg-danger border-none" name="deleteAction" value="Delete"><span class="bi bi-trash">Delete</span></button> <br>
                <input type="hidden" name="userID" value="<?= $user['id'] ?>" />
              </form>
              <?php if ($user['tmp_bann'] == NULL) : ?>
                <div class="bd-highlight  mt-3">
                  <button style="border: none;" id="temp-bann" class="badge bg-warning"><i class="bi bi-clock"></i>Tmp Banned</span></button> <br>
                </div>
              <?php else : ?>
                <form action="detailuser.php" class="bd-highlight mt-3" method="post">
                  <button style="border: none;" type="submit" class="badge bg-info" name="unBann-tmp"><i class="bi bi-clock"></i>Tmp unBanned</button>
                  <input type="hidden" name="userID" value="<?= $user['id'] ?>" />
                </form>
              <?php endif ?>
              <?php if ($user['status'] != NULL) : ?>
                <form action="detailuser.php" class="bd-highlight mt-3" method="post">
                  <button style="border: none;" type="submit" class="badge bg-info" name="unBanned" value="unBanned"><i class="bi bi-exclamation-lg"></i>Unbanned</span></button>
                  <input type="hidden" name="userID" value="<?= $user['id'] ?>" />
                </form>
              <?php else : ?>
                <form action="detailuser.php" class="bd-highlight mt-3" method="post">
                  <button style="border: none;" type="submit" class="badge bg-dark" name="banned" value="banned"><i class="bi bi-exclamation-lg"></i> Banned</span></button>
                  <input type="hidden" name="userID" value="<?= $user['id'] ?>" />
                </form>
              <?php endif ?>
            </div>
          <?php endif ?>
        <?php endif ?>
      </div>
    </div>
  </div>
  <div class="container col-md-9 m-auto row">
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
    <div class="col-md-6">
      <?php foreach ($postingan as $val) : ?>
        <?php include("card.php") ?>
      <?php endforeach ?>
    </div>
  </div>

  <!-- MOdal Temporary Banned -->
  <div class="modal fade" id="modalTempBann" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Temporary Banned</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="detailuser.php" method="post">
            <input type="hidden" name="userID" value="<?= $user['id'] ?>" />
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Date End</label>
              <input type="date" class="form-control" name="tmp-date">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Time End</label>
              <input type="time" class="form-control" name="tmp-time">
            </div>
            <div class="modal-footer">
              <button class="btn btn-warning" name="tmp-bann">Banned</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- END TEMP bann -->


  <!-- Modal post -->
  <div id="detailPosting" class="modal" tabindex="-1">
    <div id="besarModal" class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div id="gambarDt" class="col-md-7 overflow-auto">
                <img style="height: 100%;width:100%;" id="imgPosting" class="m-auto" src="img/posting/2.jpg" alt="">
              </div>
              <div id="sesuai" class="col-md-5 ms-auto ">
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
  <!-- end0 -->
  <script src="js/jquery-3.6.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      $('#temp-bann').click(function() {
        // console.log("HEllo");
        $("#modalTempBann").modal("show");
      })
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
    });
  </script>
  <script src="js/script.js"></script>
</body>

</html>