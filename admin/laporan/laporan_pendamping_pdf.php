<?php


/**
 * @author Achmad Solichin
 * @website http://achmatim.net
 * @email achmatim@gmail.com
 */
include "../../koneksi.php";
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
		$this->Cell(0, 10, 'Laporan Data Perusahaan ', 0, 1, 'C');
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
		$this->Cell(120, $h, 'ID Perusahaan', 1, 0, 'C', true);
		$this->SetX($left += 120);
		$this->Cell(120, $h, 'Nik', 1, 0, 'C', true);
		$this->SetX($left += 120);
		$this->Cell(150, $h, 'Nama', 1, 0, 'C', true);
		$this->SetX($left += 150);
		$this->Cell(70, $h, 'Jenis Kelamin', 1, 0, 'C', true);
		$this->SetX($left += 70);
		$this->Cell(190, $h, 'Alamat', 1, 0, 'C', true);
		$this->SetX($left += 190);
		$this->Cell(200, $h, 'No Telepon', 1, 0, 'C', true);
		// $this->SetX($left += 80); $this->Cell(80, $h, 'Nama magang', 1, 1, 'C',true);
		$this->Ln(25);

		$this->SetFont('Arial', '', 9);
		$this->SetWidths(array(20, 120, 120, 150, 70, 190, 200));
		$this->SetAligns(array('C', 'L', 'L', 'L', 'C', 'L'));
		$no = 1;
		$this->SetFillColor(255);
		foreach ($this->data as $baris) {
			$this->Row(
				array(
					$no++,
					$baris['id_psh'],
					$baris['nik'],
					$baris['nama_pendamping'],
					$baris['jekel'],
					$baris['alamat'],
					$baris['no_hp'],
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
$query = "SELECT * from tb_perusahaan";
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
