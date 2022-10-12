<?php
require('functions.php');
require('fpdf184/fpdf.php');
$kategori = $_POST['kategori'];
$stmt = mysqli_prepare($conn, "SELECT * FROM POSTINGAN WHERE kategori = ?");
mysqli_stmt_bind_param($stmt, "s", $kategori);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$pdf = new FPDF();
$pagewidth = $pdf->GetPageWidth();
$lMargin = ($pagewidth - 200) / 2;
$pdf->SetLeftMargin($lMargin);
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

$pdf->Cell(200, 10, "Postingan Kategori" . " " . ucfirst($kategori), 1, 1, 'C');
$pdf->Cell(50, 10, 'Email', 1, 0, 'C');
$pdf->Cell(30, 10, 'Username', 1, 0, 'C');
$pdf->Cell(15, 10, 'Like', 1, 0, 'C');
$pdf->Cell(15, 10, 'Komen', 1, 0, 'C');
$pdf->Cell(90, 10, 'Konten', 1, 1, 'C');

while($row = mysqli_fetch_assoc($result)){
    $stmtCurr = mysqli_prepare($conn, "SELECT * FROM user WHERE id = ?");
    mysqli_stmt_bind_param($stmtCurr, "s", $row['id_user']);
    mysqli_stmt_execute($stmtCurr);
    $dataInfo = mysqli_stmt_get_result($stmtCurr);
    $curr = mysqli_fetch_assoc($dataInfo);

    $pdf->Cell(50, 10, $curr['email'], 1, 0, 'C');
    $pdf->Cell(30, 10, $curr['username'], 1, 0, 'C');
    $pdf->Cell(15, 10, $row['jml_like'], 1, 0, 'C');
    $pdf->Cell(15, 10, 'N/A', 1, 0, 'C');
    $pdf->Multicell(90, 10, $row['postingan_text'], 1, 'C');
}

$pdf->Output();
?>