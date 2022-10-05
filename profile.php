<?php 
    require 'functions.php';
    session_start();
    if(isset($_POST['signUp'])){
        if(signUp($_POST) > 0){
            $_SESSION['login'] = true;
            $_SESSION['user_login'] = $_POST['username'];
        }else {
            header("Location: profile.php");
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
            }
        }
    }


    if(isset($_SESSION['login'])){
        $username = $_SESSION['user_login'];
        $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
        $row = mysqli_fetch_assoc($result);
        $userid = $row['id'];
        $postingan = query("SELECT * FROM postingan WHERE id_user = '$userid'");
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
    <title>Profile</title>
  </head>
  <body>
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
            });
            </script>
            ';
        }
    ?>
    <div class="modal" id="myModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <?php if(isset($_GET['signUp'])) include('view/signUp.php');
        else include('view/login.php'); ?>
    </div>
    <?php include('navbar.php'); ?>
    <div id="content" class="container col-md-9 visually-hidden">
        <div class="row m-3 d-flex flex-row">
            <div class="col-md-3 m-3">
                <?php if($row['foto_profil'] !== 'NULL'){ ?>
                  <img width="150px" height="150px" class="rounded-circle border border-primary" src="img/profil/<?= $row['foto_profil']; ?>" alt="">
                <?php }else { ?>
                  <img width="150px" height="150px" class="rounded-circle border border-primary" src="img/profil/default-profile.png" alt="">
                <?php } ?>
            </div>
            <div class="col-md-6" m-3>
              <div class="clearfix">
                <h3 class="float-start"><?= $row['username']; ?></h3>
                <form action="view/editprofile.php" method="post">
                  <input type="hidden" name="key" value="<?= $row['id']; ?>">
                  <button class="badge rounded-pill bg-primary border-white shadow-sm mx-2 mt-2">Edit Profile</button>
                </form>
              </div>
              <div class="d-flex">
                <h5>Kiriman</h5> 
                <h5 class="mx-3">Follow</h5> 
                <h5 class="mx-3">Followers</h5>
              </div>
                <p><?= $row['description']; ?></p>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-center flex-wrap">
        <?php foreach($postingan as $val) : ?>
        <div class="container col-md-6">
        <div class="card shadow-sm col-md-10 mt-4" >
          <div class="border-bottom">
            <div class="dflex m-2">
              <?php if($row['foto_profil'] !== 'NULL'){ ?>
                <img class="border border-dark rounded-circle" width="40px" height="40px" src="img/profil/<?= getValue($val['id_user'],'foto_profil'); ?>" alt="">
                <?php }else { ?>
                  <img class="border border-dark rounded-circle" width="40px" height="40px" src="img/profil/default-profile.png" alt="">
              <?php } ?>
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
      </div>
        <?php endforeach ?>
        </div>
        

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>