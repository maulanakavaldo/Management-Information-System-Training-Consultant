<?php
session_start();
error_reporting(0);
include('koneksi.php');
require('fpdf/fpdf.php');


$pdf = new FPDF("L", "cm", "A4");

$pdf->SetMargins(0.5, 1, 1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 11);
$pdf->Image('images/php.png', 1, 1, 2, 2);
$pdf->SetX(4);
$pdf->MultiCell(19.5, 0.5, 'Jogja Smart Indotama', 0, 'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5, 0.5, 'Telepon : +62 ', 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetX(4);
$pdf->MultiCell(19.5, 0.5, 'Bantul, Yogyakarta', 0, 'L');
$pdf->SetX(4);
$pdf->Line(1, 3.1, 28.5, 3.1);
$pdf->SetLineWidth(0.1);
$pdf->Line(1, 3.2, 28.5, 3.2);
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(25.5, 0.7, "Data Perusahaan", 0, 10, 'C');
$pdf->ln(1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(5, 0.7, "Printed On : " . date("D-d/m/Y"), 0, 0, 'C');
$pdf->ln(1);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(7, 0.8, 'Nama Perusahaan', 1, 0, 'C');
$pdf->Cell(9, 0.8, 'Alamat', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'Telepon Kantor', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Fax', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$no = 1;

// $from = $_POST['from'];
// $end = $_POST['end'];
$query = mysqli_query($CON, "SELECT nama, alamat, tlp_kantor, fax FROM tb_perusahaan");
while ($lihat = mysqli_fetch_array($query)) {

    $pdf->Cell(1, 0.8, $no, 1, 0, 'C');
    $pdf->Cell(7, 0.8, $lihat['nama'], 1, 0, 'C');
    $pdf->Cell(9, 0.8, $lihat['alamat'], 1, 0, 'C');
    $pdf->Cell(4.5, 0.8, $lihat['tlp_kantor'], 1, 0, 'C');
    $pdf->Cell(4.5, 0.8, $lihat['fax'], 1, 0, 'C');

    $no++;
}
$pdf->ln(1);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(40.5, 0.7, "Approve", 0, 10, 'C');

$pdf->ln(1);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(40.5, 0.7, "Admin", 0, 10, 'C');

$pdf->Output("DataPerusahaan.pdf", "I");
