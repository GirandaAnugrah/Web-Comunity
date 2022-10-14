<?php
session_start();
if ($_SESSION['user_type'] != 'admin') {
    header("Location: index.php");
    die;
}
require('functions.php');
require('fpdf184/fpdf.php');
$kategori = $_POST['kategori'];
$stmt = mysqli_prepare($conn, "SELECT * FROM POSTINGAN WHERE kategori = ?");
mysqli_stmt_bind_param($stmt, "s", $kategori);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    header("Location: admin.php?errorMessage=NoData");
    exit();
}

$pdf = new FPDF('P', 'mm', [600, 550]);
$pagewidth = $pdf->GetPageWidth();
$lMargin = ($pagewidth - 480) / 2;
$pdf->SetLeftMargin($lMargin);
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

$pdf->Cell(480, 10, "Postingan Kategori" . " " . ucfirst($kategori), 1, 1, 'C');
$pdf->Cell(100, 10, 'Email', 1, 0, 'C');
$pdf->Cell(80, 10, 'Nama Lengkap', 1, 0, 'C');
$pdf->Cell(40, 10, 'Username', 1, 0, 'C');
$pdf->Cell(15, 10, 'Like', 1, 0, 'C');
$pdf->Cell(15, 10, 'Komen', 1, 0, 'C');
$pdf->Cell(100, 10, 'Konten Foto', 1, 0, 'C');
$pdf->Cell(130, 10, 'Konten', 1, 1, 'C');

while ($row = mysqli_fetch_assoc($result)) {
    $stmtCurr = mysqli_prepare($conn, "SELECT * FROM user WHERE id = ?");
    mysqli_stmt_bind_param($stmtCurr, "s", $row['id_user']);
    mysqli_stmt_execute($stmtCurr);
    $dataInfo = mysqli_stmt_get_result($stmtCurr);
    $curr = mysqli_fetch_assoc($dataInfo);

    $stmtLike = mysqli_prepare($conn, "SELECT * FROM likes WHERE id_postingan = ?");
    mysqli_stmt_bind_param($stmtLike, "s", $row['id']);
    mysqli_stmt_execute($stmtLike);
    $like = mysqli_stmt_get_result($stmtLike);
    $likeAmt = 0;


    while ($likerow = mysqli_fetch_assoc($like)) {
        $likeAmt++;
    }

    $stmtCmnt = mysqli_prepare($conn, "SELECT * FROM comment WHERE id_postingan = ?");
    mysqli_stmt_bind_param($stmtCmnt, "s", $row['id']);
    mysqli_stmt_execute($stmtCmnt);
    $cmt = mysqli_stmt_get_result($stmtCmnt);
    $cmtAmt = 0;

    while ($cmtrow = mysqli_fetch_assoc($cmt)) {
        $cmtAmt++;
    }

    $stmtPhoto = mysqli_prepare($conn, "SELECT * FROM postingan WHERE id = ?");
    mysqli_stmt_bind_param($stmtPhoto, "s", $row['id']);
    mysqli_stmt_execute($stmtPhoto);
    $res = mysqli_stmt_get_result($stmtPhoto);
    $res2 = mysqli_fetch_assoc($res);

    if ($res2['postingan_gambar'] != -1) {
        $photoUrl = './img/posting/' . $res2['postingan_gambar'];
    } else {
        $photoUrl = '';
    }

    $pdf->Cell(100, 10, $curr['email'], 1, 0, 'C');
    $pdf->Cell(80, 10, $curr['nama'], 1, 0, 'C');
    $pdf->Cell(40, 10, $curr['username'], 1, 0, 'C');
    $pdf->Cell(15, 10, $likeAmt, 1, 0, 'C');
    $pdf->Cell(15, 10, $cmtAmt, 1, 0, 'C');
    if ($photoUrl != '') {
        $pdf->Cell(100, 50, "", 0, 0, 'C', $pdf->Image($photoUrl, $pdf->GetX() + 1, $pdf->GetY() + 1, 100, 50));
        // $pdf->Cell(100, 100,$pdf->Image($photoUrl ,$pdf->GetX(),$pdf->GetY(),-300), 1, 0);
    } else {
        $pdf->Cell(100, 50, 'No Picture', 1, 0, 'C');
    }
    if ($row['postingan_text'] != '') {
        $pdf->Multicell(130, 10, $row['postingan_text'], 1, 'C');
    } else {
        $pdf->Cell(130, 55, 'No text', 1, 1, 'C');
    }
}

$pdf->Output();
