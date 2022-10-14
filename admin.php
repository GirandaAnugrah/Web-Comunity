<?php
session_start();
require('functions.php');
if (!isset($_SESSION['login'])) {
  header("Location: profile.php");
  die;
}
if ($_SESSION['user_type'] != 'admin') {
  header("Location: index.php");
  die;
}
$userInfo = query('SELECT * FROM user');
function handleLike($id)
{
  $postingan = query("SELECT * FROM postingan WHERE id_user = '$id'");
  $jml = 0;
  foreach ($postingan  as $val) {
    $jml +=  getLike($val['id']);
  }
  return $jml;
}

function comment($id)
{
  $comm = query("SELECT * FROM comment WHERE id_postingan = '$id'");
  return count($comm);
}
function handleComment($id)
{
  $postingan = query("SELECT * FROM postingan WHERE id_user = '$id'");
  $jml = 0;
  foreach ($postingan as $post) {
    $jml += comment($post['id']);
  }
  return $jml;
}
function postingan($id)
{
  $postingan = query("SELECT * FROM postingan WHERE id_user = '$id'");
  return count($postingan);
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
  <title>Admin Page</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
  <script src="js/jquery-3.6.1.min.js"></script>
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
    <div id="adminOptions" class="col-md-12 mt-3 overflow-auto">
      <h2 class="mt-3">Export Statistic Reports</h2>
      <?php if (isset($_GET['message'])) : ?>
        <div class="alert alert-success m-2" role="alert">
          <?= $_GET['message']; ?>
        </div>
      <?php endif ?>
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
      <a href="adminData.php?setExel=true" class="btn btn-success text-decoration-none my-2">Export To Exel</a>
      <h2 class="mt-3">Ban User</h2>
      <table id="userTable" class="table table-striped" style="width:100%">
        <thead>
          <tr>
            <th>ID User</th>
            <th>Username</th>
            <th>Nama User</th>
            <th>Email</th>
            <th>Likes</th>
            <th>Comments</th>
            <th>Posts</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($userInfo as $val) : ?>
            <tr>
              <td><?= $val['id']; ?></td>
              <td><a class="text-decoration-none" href="detailuser.php?id=<?= $val['id']; ?>"><?= $val['username']; ?></a></td>
              <td><?= $val['nama']; ?></td>
              <td><?= $val['email']; ?></td>
              <td><?= handleLike($val['id']); ?></td>
              <td><?= handleComment($val['id']); ?></td>
              <td><?= postingan($val['id']); ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
        <tfoot>
          <tr>
            <th>ID User</th>
            <th>Username</th>
            <th>Nama User</th>
            <th>Email</th>
            <th>Likes</th>
            <th>Comments</th>
            <th>Posts</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  <footer class="fixed-bottom d-xxl-none ">
    <?php include('footer.php'); ?>
  </footer>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#userTable').DataTable();
    });
  </script>
</body>

</html>