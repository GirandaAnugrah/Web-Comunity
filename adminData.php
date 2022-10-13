<?php
require 'functions.php';
require_once __DIR__ . '/vendor/autoload.php';
if (isset($_SESSION['user_type'])) {
  if ($_SESSION['user_type'] !== 'admin') {
    header("Location: index.php");
  }
} else {
  header("Location: index.php");
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$user = query("SELECT * FROM user");

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

if (isset($_GET['setExel'])) {
  $i = 1;
  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  foreach ($user as $val) {
    $sheet->setCellValue('A' . $i, $val['nama']);
    $sheet->setCellValue('B' . $i, $val["email"]);
    $sheet->setCellValue('C' . $i, $val["username"]);
    $sheet->setCellValue('D' . $i, handleLike($val['id']));
    $sheet->setCellValue('E' . $i, handleComment($val['id']));
    $i++;
  }
  $writer = new Xlsx($spreadsheet);
  $writer->save('statistic_report.xlsx');
  $inputFileType = 'Xlsx';
  $inputFileName = __DIR__ . '/statistic_report.xlsx';
  $reader = IOFactory::createReader($inputFileType);
  $reader->setReadDataOnly(true);
  $spreadsheet = $reader->load($inputFileName);
  $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
  header("Location: adminData.php?message=Successfully print document");
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
  <title>Admin Report</title>
</head>

<body>
  <?php include("navbar.php") ?>
  <h2 style="margin-top: 80px;" class="text-center">Admin Report</h2>
  <div class="container">
    <a href="adminData.php?setExel=tru" class="btn btn-success text-decoration-none">Export statistics report</a>
    <div class="col-md-5">
      <?php if (isset($_GET['message'])) : ?>
        <div class="alert alert-success m-2" role="alert">
          <?= $_GET['message']; ?>
        </div>
      <?php endif ?>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Username</th>
          <th scope="col">likes</th>
          <th scope="col">Comment</th>
          <th scope="col">Post</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;
        foreach ($user as $val) : ?>
          <tr>
            <th scope="row"><?= $i; ?></th>
            <td><?= $val['nama']; ?></td>
            <td><?= $val['email']; ?></td>
            <td><?= $val['username']; ?></td>
            <td><?= handleLike($val['id']); ?></td>
            <td><?= handleComment($val['id']); ?></td>
            <td><?= postingan($val['id']); ?></td>
          </tr>
        <?php $i++;
        endforeach ?>
      </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>