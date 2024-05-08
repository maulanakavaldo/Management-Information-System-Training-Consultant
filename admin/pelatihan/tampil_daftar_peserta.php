<?php
include '../../koneksi.php';
$s_pendamping = mysqli_query($CON, "SELECT * FROM tb_pendaftaran inner join tb_pelatihan inner join tb_jenispelatihan where id_jenispelatihan = '" . addslashes($_POST['post']) . "' AND status='diterima'") or die(mysqli_error($CON));
while ($data = mysqli_fetch_array($s_pendamping)) {
?>
	<tr>
		<td><?php echo $data['id_peserta']; ?></td>
		<td><?php echo $data['no_ktp']; ?></td>
		<td><?php echo $data['nama_peserta']; ?></td>
		<td><?php echo $data['jekel']; ?></td>
		<td><?php echo $data['alamat']; ?></td>
		<td><?php echo $data['no_hp']; ?></td>
		<td><?php echo $data['nama_perusahaan']; ?></td>
		<td><?php echo $data['produk']; ?></td>
		<td><img src="../foto/user/<?php echo $data['foto_diri']; ?>" class="img-responsive" style="width: 80px;"></td>
		<td><img src="../foto/tdi/<?php echo $data['tdi']; ?>" class="img-responsive" style="width: 80px;"></td>
	</tr>
<?php
}
?>