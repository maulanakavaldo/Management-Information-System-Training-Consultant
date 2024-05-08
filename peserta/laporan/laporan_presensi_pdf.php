<?php
if (@$_POST['id_magang']) {
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
			$this->Cell(0, 10, 'Laporan Data Presensi Magang ' . explode('|', $_POST['id_magang'])['1'], 0, 1, 'C');
			$this->Ln(10);

			if ($this->data['tahun']) {
				$h = 25;
				$left = 10;
				$top = 80;
				#tableheader
				$this->SetFont("", "B", 8);
				$this->SetFillColor(200, 200, 200);
				$this->SetX($left += 20);
				$this->Cell(50, $h * 3, 'ID Peserta', 1, 0, 'C', true);
				$this->SetX($left += 50);
				$this->Cell(90, $h * 3, 'No KTP', 1, 0, 'C', true);
				$this->SetX($left += 90);
				$this->Cell(150, $h * 3, 'Nama Peserta', 1, 0, 'C', true);
				$size = 590 / $this->data['size'];
				$last_left_set = 150;
				$last_left = $last_left_set;
				$left = 170;
				foreach ($this->data['tahun'] as $key => $value) {
					$this->SetX($left += $last_left);
					$this->Cell($size * $value['w'], $h, $value['n'], 1, 0, 'C', true);
					$last_left = $size * $value['w'];
				}
				$this->Ln(25);
				$last_left = $last_left_set;
				$left = 170;
				foreach ($this->data['bulan'] as $key => $value) {
					$this->SetX($left += $last_left);
					$this->Cell($size * $value['w'], $h, $value['n'], 1, 0, 'C', true);
					$last_left = $size * $value['w'];
				}
				$this->Ln(25);
				$last_left = $last_left_set;
				$left = 170;
				foreach ($this->data['hari'] as $key => $value) {
					$this->SetX($left += $last_left);
					$this->Cell($size * $value['w'], $h, $value['n'], 1, 0, 'C', true);
					$last_left = $size * $value['w'];
				}
				$this->Ln(25);
				$this->SetFont('Arial', '', 9);
				$this->SetFillColor(255);
				foreach ($this->data['data'] as $key => $value) {
					$left = 10;
					$this->SetX($left += 20);
					$this->Cell(50, $h, $key, 1, 0, 'C', true);
					$this->SetX($left += 50);
					$this->Cell(90, $h, $value['no_ktp'], 1, 0, 'L', true);
					$this->SetX($left += 90);
					$this->Cell(150, $h, $value['nama_peserta'], 1, 0, 'L', true);
					$last_left = $last_left_set;
					$left = 170;
					foreach ($value['presensi'] as $key1 => $value1) {
						$this->SetX($left += $last_left);
						$this->Cell($size * 1, $h, $value1, 1, 0, 'C', true);
						$last_left = $size * 1;
					}
					$this->Ln(25);
				}
			}
			// $this->SetWidths(array(20,50,90,150,40,200,120,130,80));
			// $this->SetAligns(array('C','L','L','L','C','L'));

			// foreach ($this->data as $baris) {
			// 	$this->Row(
			// 		array($no++, 
			// 		$baris['id_peserta'], 
			// 		$baris['no_ktp'], 
			// 		$baris['nama_peserta'], 
			// 		$baris['jekel'],
			// 		$baris['alamat'],
			// 		$baris['usaha'],
			// 		$baris['hasil_produk'],
			// 		$baris['no_telp'],
			// 	));
			// }

		}

		public function printPDF()
		{
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
			$this->Cell(0, 10, '(.....................................................)                                                                                  (.....................................................)', 0, 1, 'C');
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
	$id_magang = explode('|', $_POST['id_magang'])['0'];
	#ambil data dari DB dan masukkan ke array
	$tgl_presensi = array();
	$s_pre = mysqli_query($CON, "SELECT date_format(tgl,'%d') as hari, date_format(tgl,'%M') as bulan, date_format(tgl,'%Y') as tahun, GROUP_concat(id_peserta) as peserta FROM `tb_presensi` natural join tb_magang WHERE id_magang='" . addslashes(@$id_magang) . "' GROUP by tgl") or die(mysqli_error($CON));
	while ($h_pre = mysqli_fetch_array($s_pre)) {
		$list_peserta = array();
		foreach (explode(',', $h_pre['peserta']) as $key => $value) {
			$list_peserta[$value] = 1;
		}
		$tgl_presensi[$h_pre['tahun']][$h_pre['bulan']][$h_pre['hari']] = $list_peserta;
	}
	$r_tb_header = array(
		'tahun' => array(),
		'bulan' => array(),
		'hari' => array()
	);
	$r_size = 0;
	foreach ($tgl_presensi as $key => $value) {
		$r_tahun = 0;
		foreach ($value as $key1 => $value1) {
			$r_bulan = 0;
			foreach ($value1 as $key2 => $value2) {
				$r_size++;
				$r_tahun++;
				$r_bulan++;
				$r_tb_header['hari'][] = array(
					'w' => '1',
					'n' => $key2
				);
			}
			$r_tb_header['bulan'][] = array(
				'w' => $r_bulan,
				'n' => $key1
			);
		}
		$r_tb_header['tahun'][] = array(
			'w' => $r_tahun,
			'n' => $key
		);
	}
	$r_tb_header['size'] = $r_size;
	$s_pembimbing = mysqli_query($CON, "SELECT * FROM tb_pendaftaran natural join tb_Magang where id_magang = '" . addslashes(@$id_magang) . "'") or die(mysqli_error($CON));
	while ($data = mysqli_fetch_array($s_pembimbing)) {
		$is_masuk = array();
		foreach ($tgl_presensi as $key => $value) {
			foreach ($value as $key1 => $value1) {
				foreach ($value1 as $key2 => $value2) {
					$is_masuk[] = (array_key_exists($data['id_peserta'], $value2)) ? 'v' : '-';
				}
			}
		}
		$r_tb_header['data'][$data['id_peserta']]['no_ktp'] = $data['no_ktp'];
		$r_tb_header['data'][$data['id_peserta']]['nama_peserta'] = $data['nama_peserta'];
		$r_tb_header['data'][$data['id_peserta']]['presensi'] = $is_masuk;
	}
	// pr($r_tb_header);
	// exit();
	$data = $r_tb_header;
	// $query = "SELECT tb_pendaftaran.id_peserta, tb_pendaftaran.no_ktp,tb_pendaftaran.nama_peserta,tb_pendaftaran.jekel,tb_pendaftaran.alamat,tb_pendaftaran.usaha,tb_pendaftaran.hasil_produk,tb_pendaftaran.no_telp FROM tb_pendaftaran, tb_daftarmagang WHERE tb_pendaftaran.id_magang=tb_daftarmagang.id_magang and tb_daftarmagang.id_magang='$id_magang'";
	// $sql = mysqli_query($CON, $query);
	// while ($row = mysqli_fetch_assoc($sql)) {
	// 	array_push($data, $row);
	// }

	//pilihan
	$options = array(
		'filename' => '', //nama file penyimpanan, kosongkan jika output ke browser
		'destinationfile' => '', //I=inline browser (default), F=local file, D=download
		'paper_size' => 'F4',	//paper size: F4, A3, A4, A5, Letter, Legal
		'orientation' => 'L' //orientation: P=portrait, L=landscape
	);

	$tabel = new FPDF_AutoWrapTable($data, $options);
	$tabel->printPDF();
} else {
?>
	<script type="text/javascript">
		window.close();
	</script>
<?php
}
?>