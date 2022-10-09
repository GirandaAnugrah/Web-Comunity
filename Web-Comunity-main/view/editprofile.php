<?php 
require '../functions.php';
session_start();
if(isset($_POST['key'])){
  $id = $_POST['key'];
  $result = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'");
  $row = mysqli_fetch_assoc($result);
}

if(isset($_POST['edit'])){
  $username = $_POST['username'];
  if(editProfile($_POST) > 0) {
    $_SESSION['user_login'] = $username;
    header("Location: ../profile.php");
}else {
    echo "
    <script>
        alert('data gagal diubah');
        document.location.href = '../index.php';
    </script>
    ";
}
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

    <title>Edit Profile</title>
    <style>
        body {
            background-color: #eeee;
        }
        .container{
          background-color: white;
        }
    </style>
  </head>
  <body>
    <div class="container col-md-7 mt-5 p-3 rounded">
      <center><img  width="150px" height="150px" class="rounded-circle border border-primary" src="../img/profil/<?= $row['foto_profil']; ?>" alt=""></center>
    <form action="editprofile.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $row['id']; ?>">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" value="<?= $row['username']; ?>">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="<?= $row['nama']; ?>">
        </div>
        <div class="mb-3">
          <label for="decription" class="form-label">Bio</label>
          <textarea class="form-control" name="description" id="decription"  rows="3"><?= $row['description']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="<?= $row['email']; ?>">
        </div>
        <button class="btn btn-success" name="edit">Submit</button>
    </form>
    </div>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
</html>