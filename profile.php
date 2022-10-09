<?php 
    require 'functions.php';
    session_start();
    $error = false;
    if(isset($_POST['signUp'])){
        if(signUp($_POST) > 0){
            $_SESSION['login'] = true;
            $_SESSION['user_login'] = $_POST['username'];
        }else {
          header("Location: profile.php?error-message=Data entry failed");
        }
    }
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
        if(mysqli_num_rows($result)){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password,$row["password"])){
                $_SESSION['login'] = true;
                $_SESSION['user_login'] = $username; 
                header("Location: profile.php");
                die;
            }else {
              header("Location: profile.php?error-message=Password does not match");
              die;
            }
        }else {
              header("Location: profile.php?error-message=Username not found");
              die;
        }
    }
    if(isset($_GET['error-message'])){
      $error = $_GET['error-message'];
    }

    if(isset($_POST['changePhoto'])){
      changeFotoProfile($_POST);
      header("Location: profile.php");
    }

    if(isset($_SESSION['login'])){
        $username = $_SESSION['user_login'];
        $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id_user'] = $row['id'];
        $_SESSION['foto_profil'] = $row['foto_profil'];
        $userid = $row['id'];
        $postingan = query("SELECT * FROM postingan WHERE id_user = '$userid' ORDER BY id DESC");
        $kiriman = 0;
        $jmlLike = 0;
        foreach($postingan as $val) {
          $kiriman++;
          $jmlLike += $val['jml_like'];
        }
        $follower = mysqli_query($conn, "SELECT (SELECT foto_profil FROM user WHERE id = id_follower) foto,
                                         (SELECT username FROM user WHERE id = id_follower) myusername FROM follower WHERE id_user = '$userid'");

        $jmlFol = query("SELECT id_user FROM follower WHERE id_user = $userid");
        $jmlFol = count($jmlFol);
    }

    if(isset($_POST['send'])){
      if(posting($_POST) > 0){
        header("Location: profile.php");
      }else {
        header("Location: profile.php?error-message=Data entry failed");
      }
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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
        if(!isset($_SESSION['login'])){
            echo "
            <script>
            $(document).ready(function(){
                    $('#myModal').modal('show');
            });
            </script>
            ";
        }else {
          echo '
            <script>
            $(document).ready(function(){
                $("#content").removeClass("visually-hidden");
                $("#conDefault").addClass("visually-hidden");
            });
            </script>
            ';
        }
    ?>
  <body>
    <div class="modal" id="myModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <?php if(isset($_GET['signUp'])) include('view/signUp.php');
        else if(!isset($_SESSION['login'])) include('view/login.php');
        else include('view/edit_fotoprofile.php');?>
    </div>
    <?php include('navbar.php'); ?>
    <div id="postingModal" class="modal">
        <?php include('view/postingan.php'); ?>
    </div>
    <div id="conDefault" class="container mt-5 col-md-9">
      <div class="row mb-3 d-flex flex-row justify-content-around border-bottom bg-white shadow-sm">
        <div class="col-md-3 m-3 d-md-m-auto">
              <img  width="150px" height="150px" class="rounded-circle border border-primary" src="img/profil/default-profile.png" alt="">
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
              <form id="changeFotoProfile" action="profile.php" method="post" enctype="multipart/form-data">
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
              </div>
              <div class="d-flex">
                <h5><?= $kiriman; ?> Kiriman</h5> 
                <h5 class="mx-3"><?= $jmlFol; ?> Followers</h5>
                <h5 class="mx-3"><?= $jmlLike; ?> Likes</h5> 
              </div>
                <p><?= $row['description']; ?></p>
            </div>
        </div>
        <!-- Postingan -->
        <div class="row col-12 mx-auto d-flex justify-content-between">
          <div class="col-md-5 rounded d-none d-xxl-block bg-white shadow">
            <?php if(mysqli_fetch_assoc($follower))  :?>
              <h5 class="text-center m-3">Follow</h5>
            <?php endif ?>
              <div class="d-flex flex-wrap justify-content-around">
                <?php for($i = 0; $i < 6; $i++) { $val = mysqli_fetch_assoc($follower) ?>
                  <div class="p-2">
                    <img height="120px" width="120px" src="img/profil/<?= $val['foto']; ?>" class="img-thumbnail mt-2" alt="...">
                    <p class="text-center"><?= $val['myusername']; ?></p>
                  </div>
                <?php } ?>
              </div>
          </div>
          <div id="my-post" class="col-md-7 overflow-auto">
            <div id="postingan_text" class="postingan">
              <div class="bg-white rounded-3 shadow">
                <div id="postingan_text" class="p-4">
                  <div style="background-color: #eeee;" class="border rounded-pill">
                    <h5 class="mx-3 m-2">What do you think now?</h5>
                  </div>
                </div>
              </div>
            </div>
          <?php foreach($postingan as $val) : ?>
              <div class="container">
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
              </div>
            <?php endforeach ?>
          </div>
        </div>
    </div>
    <footer class="fixed-bottom d-xxl-none ">
      <?php include('footer.php') ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
  </body>
</html>