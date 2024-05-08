<?php
//error_reporting(0);

function TanggalIndo($date)
{
  $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

  //Tanggal Indo
  $tahun = substr($date, 0, 4);
  $bulan = substr($date, 5, 2);
  $tgl   = substr($date, 8, 2);

  $result = $tgl . " " . $BulanIndo[(int)$bulan - 1] . " " . $tahun;
  return ($result);
}



// pendefinisian folder font pada FPDF
define('FPDF_FONTPATH', '../../dist/fpdf/font/');
require('../../dist/fpdf/fpdf.php');

// seperti sebelunya, kita membuat class anakan dari class FPDF
class PDF extends FPDF
{

  function Header()
  {
    //$this->Image('../src/img/.png',5.5,1,1.5);
    $this->Image('sertifikat1.jpg', 0, 0, 30, 21);
    $this->SetTextColor(0, 0, 0, 1.00); // warna tulisan
    $this->SetFont('times', 'B', '14'); // font yang digunakan
    // membuat cell dg panjang 19 dan align center 'C'

    //Tanggal Sekarang
    date_default_timezone_set('Asia/Jakarta');
    $tanggal = mktime(date('m'), date('d'), date('Y'));
    $tglsekarang = date('Y-m-d', $tanggal);


    include "../../koneksi.php";

    $query = "SELECT * FROM tb_pendaftaran natural join tb_jenismagang natural join tb_penilaian natural join tb_magang natural join tb_periode";

    $sql = mysqli_query($CON, $query);
    while ($data = mysqli_fetch_array($sql)) {
      $this->Cell(13, 13.5, ' Nama ', 0, 0, 'R');
      $this->Cell(2, 13.5, ' : ', 0, 0, 'R');
      $this->Cell(10, 13.5, $data['nama_peserta'], 0, 0, 'L');
      $this->Ln(7);
      $this->Cell(13, 1, ' Alamat ', 0, 0, 'R');
      $this->Cell(2, 1, ' : ', 0, 0, 'R');
      $this->Cell(12, 1, $data['alamat'], 0, 0, 'L');
      $this->Ln(0.8);
      $this->SetFont('times', 'B', '20');
      $this->Cell(28, 5, $data['nama_magang'], 0, 0, 'C');
      $this->Ln(1);
      $this->SetFont('times', '', '13');
      $this->Cell(7.7, 1, '  ', 0, 0, 'R');
      $this->Cell(12.5, 4.5, 'Yang diselenggarakan oleh Jogja Smart Indotama kota ', 0, 0, 'C');
      $this->Ln(0.6);
      $this->Cell(5.7, 1, '  ', 0, 0, 'R');
      $this->Cell(17, 4.5, 'yang bertanggalkan' . ' ' . TanggalIndo($data['tgl_mulai']) . ' ' . 'sampai ' . TanggalIndo($data['tgl_selesai']) . ' dengan nilai' . ' ' . $data['nilai'] . ' ' . 'hasil yang :', 0, 0, 'C');
      $this->Ln(0.9);
      $this->SetFont('times', 'B', '26');
      $this->Cell(7.7, 1, '  ', 0, 0, 'R');
      $this->Cell(12.5, 4.3, $data['keterangan'], 0, 0, 'C');
      $this->Ln(0.7);
      $this->SetFont('times', '', '14');
      $this->Cell(18.8, 1, '  ', 0, 0, 'R');
      $this->Cell(7.6, 5, ',' . ' ' . TanggalIndo($tglsekarang), 0, 0, 'C');
    }

    $this->SetFont('times', 'B', '11'); // font yang digunakan
    //$this->Cell(21,0.3,'UPT. BLK ',0,0,'C');
    $this->Ln(1.5);
    $this->SetFont('times', 'B', '9');
    $this->SetFillColor(233, 233, 233, 1.00); // warna isi
    $this->SetTextColor(0, 0, 0); // warna teks untuk th
    //bawah
    /*$this->Cell(1);
   $this->Cell(0.60,1,'No.','TB',0,'L',1); // cell dengan panjang 1
   $this->Cell(1.90,1,'ID Peserta','TB',0,'C',1); // cell dengan panjang 1
   $this->Cell(2.90,1,'NIK','TB',0,'C',1);
   $this->Cell(3.50,1,'Nama','TB',0,'C',1); // cell dengan panjang 3
   $this->Cell(2.50,1,' Kejuruan','TB',0,'C',1);
   $this->Cell(1.90,1,'  Pelaksanaan','TB',0,'C',1);
   $this->Cell(1.30,1,'Nilai','TB',0,'C',1);
   $this->Cell(2.00,1,'Keterangan','TB',0,'C',1);
   */
    // panjang cell bisa disesuaikan
    $this->Ln();
  }

  function Footer()
  {
    $this->SetY(-2, 5);
    //$this->Cell(0,1,$this->PageNo(),0,0,'C');
  }
}

include "../../koneksi.php";

$query = "SELECT * FROM tb_pendaftaran natural join tb_periode natural join tb_jenismagang natural join tb_penilaian";

$sql = mysqli_query($CON, $query);
$i = 0;

while ($data = mysqli_fetch_array($sql)) {

  $cell[$i][0] = $data['id_peserta'];
  $cell[$i][2] = $data['nama_peserta'];
  $cell[$i][3] = $data['nama_magang'];
  $cell[$i][5] = $data['nilai'];
  $cell[$i][6] = $data['keterangan'];
  $i++;
}
// orientasi Potrait
// ukuran cm
// kertas A4
$pdf = new PDF('L', 'cm', 'A4');

$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial', '', '8');
//perulangan untuk membuat tabel
/*for($j=0;$j<$i;$j++){
  $pdf->Cell(1);
  $pdf->Cell(0.60,1,$j+1,'B',0,'C');
  $pdf->Cell(1.90,1,$cell[$j][0],'B',0,'C');
  $pdf->Cell(2.90,1,$cell[$j][1],'B',0,'L');
  $pdf->Cell(3.50,1,$cell[$j][2],'B',0,'L');
  $pdf->Cell(2.50,1,$cell[$j][3],'B',0,'C');
  $pdf->Cell(1.90,1,$cell[$j][4],'B',0,'C');
  $pdf->Cell(1.30,1,$cell[$j][5],'B',0,'C');
  $pdf->Cell(2.00,1,$cell[$j][6],'B',0,'C');

  $pdf->Ln();
 }
*/
$pdf->Output(); // ditampilkan
