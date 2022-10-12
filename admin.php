<?php
session_start();
require('functions.php');
if(!isset($_SESSION['login'])){
  header("Location: profile.php");
  die;
}
?>
<?php if($_SESSION['user_type'] == 'admin'):?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>Admin Page</title>
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
      <div id="adminOptions" class="col-md-8 mt-3 overflow-auto">
        <h2 class="mt-3">Export Statistic Reports</h2>
        <form action="pdfHasilexport.php" method="POST">
            <select class="form-select" name="kategori" required>
                <option selected value="">Kategori</option>
                <option value="javascript">Javascript</option>
                <option value="php">PHP</option>
                <option value="java">Java</option>
                <option value="golang">Golang</option>
                <option value="ruby">Ruby</option>
                <option value="c++">C++</option>
            </select>
            <button type="submit" class="btn btn-primary mt-3">Export To PDF</button>
        </form>
        <h2 class="mt-3">Ban User</h2>
      </div>
    </div>
      <footer class="fixed-bottom d-xxl-none ">
      <?php include('footer.php'); ?>
    </footer>
  </body>
</html>
<?php 
else:
  header('location: index.php');
endif;
?>