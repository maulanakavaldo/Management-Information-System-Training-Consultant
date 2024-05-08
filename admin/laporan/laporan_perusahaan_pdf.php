<?php

// $servername    = "localhost";
// $username    = "root";
// $password    = "";
// $dbname        = "disnakerperinkop";

// $conn    = mysqli_connect($servername, $username, $password, $dbname);
// if (!$conn) {
// 	die("Connection Failed: " . mysqli_connect_error());
// }

// Koneksi library FPDF
include('../../koneksi.php');
require('../../fpdf/fpdf.php');
// Setting halaman PDF

$pdf = new FPDF("L", "cm", "A4");

$pdf->SetMargins(1, 2, 1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 18);
$pdf->SetTextColor(194, 8, 8);
$pdf->Image('../../foto/logo/JSI.png', 2, 1.8, 2, 2);
$pdf->SetX(4);
$pdf->Cell(1.7, 0, 'Jogja', 0, 0, 'L');
// Hijau
$pdf->SetTextColor(27, 209, 27);
$pdf->Cell(2, 0, 'Smart', 0, 0, 'L');
$pdf->SetX(4);
//hitam
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(0, 1.3, 'Indotama', 0, 'L');
$pdf->SetX(4);
$pdf->SetFont('Times', '', 10);
$pdf->MultiCell(10.5, 0.2, 'Telepon : (0274) 4541267 / +6281320285228 ', 0, 'L');
$pdf->SetX(4);
$pdf->MultiCell(10.5, 0.5, 'Bantul, Yogyakarta', 0, 'L');

$pdf->Line(1, 4.1, 38.5, 4.1);
$pdf->SetLineWidth(0.1);
$pdf->Line(1, 4.2, 38.5, 4.2);
$pdf->SetLineWidth(0);

$pdf->ln(1);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(25.5, 0.7, "Data Perusahaan", 0, 10, 'C');
$pdf->ln(1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(5, 0.7, "Dicetak : " . date("d/m/Y"), 0, 0, 'C');
$pdf->ln(1);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(8, 0.8, 'Nama Perusahaan', 1, 0, 'C');
$pdf->Cell(8, 0.8, 'Alamat', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Telepon Kantor', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Fax', 1, 0, 'C');
$pdf->Cell(6, 0.8, 'Bidang', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$no = 1;

$query = mysqli_query($CON, "SELECT tb_perusahaan.id_psh, tb_perusahaan.nama, tb_perusahaan.tlp_kantor, tb_perusahaan.fax,tb_perusahaan.alamat,tb_bidangpsh.nama_bidang FROM tb_perusahaan Inner JOIN tb_bidangpsh on tb_perusahaan.id_bidangpsh=tb_bidangpsh.id_bidangpsh order by nama");
while ($lihat = mysqli_fetch_array($query)) {

	$pdf->Cell(1, 0.8, $no, 1, 0, 'C');
	$pdf->Cell(8, 0.8, $lihat['nama'], 1, 0, 'L');
	$pdf->Cell(8, 0.8, $lihat['alamat'], 1, 0, 'L');
	$pdf->Cell(3, 0.8, $lihat['tlp_kantor'], 1, 0, 'C');
	$pdf->Cell(2, 0.8, $lihat['fax'], 1, 0, 'C');
	$pdf->Cell(6, 0.8, $lihat['nama_bidang'], 1, 1, 'C');

	$no++;
}
$pdf->ln(1);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(40.5, 0.7, "Approve", 0, 10, 'C');

$pdf->ln(1);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(40.5, 0.7, "Admin", 0, 10, 'C');

$pdf->Output();
