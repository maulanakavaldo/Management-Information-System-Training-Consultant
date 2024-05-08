<?php


/**
 * @author Achmad Solichin
 * @website http://achmatim.net
 * @email achmatim@gmail.com
 */
require_once("../../fpdf17/fpdf.php");

class FPDF_AutoWrapTable extends FPDF
{
	private $data = array();
	private $options = array(
		'filename' => '',
		'destinationfile' => '',
		'paper_size' => 'F4',
		'orientation' => 'L'
	);

	function __construct($data = array(), $options = array())
	{
		parent::__construct();
		$this->data = $data;
		$this->options = $options;
	}

	public function rptDetailData()
	{
		//
		$border = 0;
		$this->AddPage();
		$this->SetAutoPageBreak(true, 60);
		$this->AliasNbPages();
		$left = 25;

		//header
		$this->Image('../../foto/logo/logo.png', 30, 10, 52.5); // logo
		$this->SetFont("", "B", 18);
		$this->SetX(225);
		$this->MultiCell(500, 20, 'Dinas Tenaga Kerja, Perindustrian, Koperasi, Usaha Kecil dan Menengah Kabupaten ', 0, 'C');
		$this->Cell(0, 20, " ", "B");
		$this->Ln(30);
		$this->SetFont("", "B", 12);
		$this->SetX($left);
		$this->Cell(0, 10, 'Laporan Data Peserta ', 0, 1, 'C');
		$this->Ln(10);

		$h = 25;
		$left = 40;
		$top = 80;
		#tableheader
		$this->SetFont("", "B", 8);
		$this->SetFillColor(200, 200, 200);
		$left = $this->GetX();
		$this->Cell(20, $h, 'NO', 1, 0, 'L', true);
		$this->SetX($left += 20);
		$this->Cell(60, $h, 'ID Peserta', 1, 0, 'C', true);
		$this->SetX($left += 60);
		$this->Cell(100, $h, 'Nama', 1, 0, 'C', true);
		$this->SetX($left += 100);
		$this->Cell(200, $h, 'Alamat', 1, 0, 'C', true);
		$this->SetX($left += 200);
		$this->Cell(50, $h, 'Jekel', 1, 0, 'C', true);
		$this->SetX($left += 50);
		$this->Cell(100, $h, 'Telp', 1, 0, 'C', true);
		$this->SetX($left += 100);
		$this->Cell(150, $h, 'Nama Perusahaan', 1, 0, 'C', true);
		$this->SetX($left += 150);
		$this->Cell(150, $h, 'Nama Pelatihan', 1, 0, 'C', true);
		$this->SetX($left += 150);
		$this->Cell(50, $h, 'Periode', 1, 0, 'C', true);
		$this->Ln(25);

		$this->SetFont('Arial', '', 9);
		$this->SetWidths(array(20, 60, 100, 200, 50, 100, 150, 150, 50));
		$this->SetAligns(array('C', 'L', 'L', 'L', 'C', 'L'));
		$no = 1;
		$this->SetFillColor(255);
		foreach ($this->data as $baris) {
			$this->Row(
				array(
					$no++,
					$baris['id_peserta'],
					$baris['nama_peserta'],
					$baris['alamat'],
					$baris['jekel'],
					$baris['no_hp'],
					$baris['nama_perusahaan'],
					$baris['nama_pelatihan'],
					$baris['tahun'],
				)
			);
		}
	}

	public function printPDF()
	{

		$q_kepala = mysqli_query($CON, "SELECT nama from tb_user WHERE status in ('kabid','kadin')") or die(mysqli_error($CON));
		$i = 0;
		$result = array();
		while ($datane = mysqli_fetch_array($q_kepala)) {
			$result[$i++] = $datane[0];
		}

		$tgl = date('d-M-Y');
		if ($this->options['paper_size'] == "F4") {
			$a = 8.3 * 72; //1 inch = 72 pt
			$b = 13.0 * 72;
			$this->FPDF($this->options['orientation'], "pt", array($a, $b));
		} else {
			$this->FPDF($this->options['orientation'], "pt", $this->options['paper_size']);
		}

		$this->SetAutoPageBreak(false);
		$this->AliasNbPages();
		$this->SetFont("Arial", "B", 9);
		//$this->AddPage();

		$this->rptDetailData();
		$this->Ln(10);
		$this->SetFont("Arial", "B", 9);
		$this->Cell(0, 10, ', ' . $tgl, 0, 1, 'R');
		$this->Ln(1);
		$this->Cell(0, 10, '   Kepala Dinas                                                                                                   Kepala Bidang Perindustrian', 0, 1, 'C');
		$this->Ln(60);
		// pr($GLOBALS);
		$this->SetX(0);
		$this->Cell(0, 10, '( ' . $result[0] . ' )                                                                                  ( ' . $result[1] . ' )', 0, 1, 'C');
		$this->Output($this->options['filename'], $this->options['destinationfile']);
	}

	private $widths;
	private $aligns;

	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths = $w;
	}

	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns = $a;
	}

	function Row($data)
	{
		//Calculate the height of the row
		$nb = 0;
		for ($i = 0; $i < count($data); $i++)
			$nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		$h = 20 * $nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for ($i = 0; $i < count($data); $i++) {
			$w = $this->widths[$i];
			$a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x = $this->GetX();
			$y = $this->GetY();
			//Draw the border
			$this->Rect($x, $y, $w, $h);
			//Print the text
			$this->MultiCell($w, 20, $data[$i], 0, $a);
			//Put the position to the right of the cell
			$this->SetXY($x + $w, $y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if ($this->GetY() + $h > $this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w, $txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw = &$this->CurrentFont['cw'];
		if ($w == 0)
			$w = $this->w - $this->rMargin - $this->x;
		$wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
		$s = str_replace("\r", '', $txt);
		$nb = strlen($s);
		if ($nb > 0 and $s[$nb - 1] == "\n")
			$nb--;
		$sep = -1;
		$i = 0;
		$j = 0;
		$l = 0;
		$nl = 1;
		while ($i < $nb) {
			$c = $s[$i];
			if ($c == "\n") {
				$i++;
				$sep = -1;
				$j = $i;
				$l = 0;
				$nl++;
				continue;
			}
			if ($c == ' ')
				$sep = $i;
			$l += $cw[$c];
			if ($l > $wmax) {
				if ($sep == -1) {
					if ($i == $j)
						$i++;
				} else
					$i = $sep + 1;
				$sep = -1;
				$j = $i;
				$l = 0;
				$nl++;
			} else
				$i++;
		}
		return $nl;
	}
} //end of class

/* contoh penggunaan dengan data diambil dari database mysql
	 * 
	 * 1. buatlah database di mysql
	 * 2. buatlah tabel 'pegawai' dengan field: nip, nama, alamat, email dan website
	 * 3. isikan beberapa contoh data ke tabel pegawai tersebut.
	 * 
	 * */

#koneksi ke database (disederhanakan)
include "../../koneksi.php";
//$id_magang = explode('|', $_POST['id_magang'])['0'];
#ambil data dari DB dan masukkan ke array
$data = array();
$query = "SELECT tb_pelatihan.id_pelatihan, tb_pendaftaran.no_hp, tb_pendaftaran.jekel, tb_pendaftaran.id_peserta, tb_pendaftaran.nama_peserta, tb_pendaftaran.alamat, tb_pendaftaran.nama_perusahaan, tb_pendaftaran.produk, tb_jenispelatihan.nama_pelatihan, tb_pendaftaran.status, tb_periode.tahun, tb_pendaftaran.foto_diri, tb_pendaftaran.tdi from tb_pendaftaran inner join tb_pelatihan on tb_pelatihan.id_pelatihan=tb_pendaftaran.id_pelatihan inner join tb_jenispelatihan on tb_pelatihan.id_jenispelatihan=tb_jenispelatihan.id_jenispelatihan inner join tb_periode on tb_pendaftaran.id_periode=tb_periode.id_periode where tb_pendaftaran.status='diterima' order by nama_pelatihan";
$sql = mysqli_query($CON, $query);
while ($row = mysqli_fetch_assoc($sql)) {
	array_push($data, $row);
}

//pilihan
$options = array(
	'filename' => '', //nama file penyimpanan, kosongkan jika output ke browser
	'destinationfile' => '', //I=inline browser (default), F=local file, D=download
	'paper_size' => 'F4',	//paper size: F4, A3, A4, A5, Letter, Legal
	'orientation' => 'L' //orientation: P=portrait, L=landscape
);

$tabel = new FPDF_AutoWrapTable($data, $options);
$tabel->printPDF();
