<?php
require 'functions.php';
require_once __DIR__ . '/vendor/autoload.php';
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: profile.php");
  die;
}
if ($_SESSION['user_type'] != 'admin') {
  header("Location: index.php");
  die;
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
  header("Location: admin.php?message=Successfully print document Xlsx");
}
