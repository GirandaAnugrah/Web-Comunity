<?php
session_start();
require('functions.php');

if (isset($_GET['sort'])) {
  if ($_GET['sort'] === 'trend') {
    $query = "SELECT * FROM postingan ORDER BY (SELECT (COUNT(*) * 0.3) FROM likes WHERE id_postingan = id)+(SELECT (COUNT(*) * 0.7) FROM comment WHERE id_postingan = id) DESC";
  } else if ($_GET['sort'] === 'likes') {
    $query = "SELECT * FROM postingan ORDER BY (SELECT COUNT(*) FROM likes WHERE id_postingan = id)DESC";
  } else {
    $query = "SELECT * FROM postingan ORDER BY tanggal_posting DESC";
  }
} else {
  $query = "SELECT * FROM postingan ORDER BY (SELECT (COUNT(*) * 0.3) FROM likes WHERE id_postingan = id)+(SELECT (COUNT(*) * 0.7) FROM comment WHERE id_postingan = id) DESC";
}
$postingan = query($query);

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
  mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=0");
  $query2 = "DELETE FROM postingan WHERE id = '$idpostingan'";
  mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=1");
  mysqli_query($conn, $query2);
  header("Location: index.php");
  unset($_POST['deleteAction']);
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css">
  <script src="js/jquery-3.6.1.min.js"></script>
  <title>Komunitas Pemrog</title>
</head>
<style>
  body {
    background-color: #C6CCE0;
  }

  #dashbord::-webkit-scrollbar {
    display: none;
  }
</style>

<body>
  <?php include('navbar.php') ?>
  <footer class="fixed-top d-xxl-none ">
    <?php include('view/footerSm.php') ?>
  </footer>
  <div class="container col-md-9 mt-5 row m-auto d-flex justify-content-between bg-white">
    <div class="col-md-4 mt-3 d-none d-xl-block">
      <?php include('navLeft.php') ?>
    </div>
    <div id="dashbord" style="height: 695px;" class="col-md-8 mt-3 overflow-auto">
      <?php foreach ($postingan as $val) : ?>
        <?php include('card.php') ?>
      <?php endforeach ?>
    </div>
  </div>
  <footer class="fixed-bottom d-xxl-none ">
    <?php include('footer.php'); ?>
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
              <div style="max-height: 100%; max-width:100%;" id="gambarDt" class="col-md-7 overflow-auto">
                <img id="imgPosting" class="m-auto" src="img/posting/2.jpg" alt="">
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
  <!-- End Modal -->
  <script src="js/jquery-3.6.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script type="text/javascript">
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