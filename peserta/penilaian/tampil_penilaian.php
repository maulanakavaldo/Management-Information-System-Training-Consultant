<?php
include '../../koneksi.php';
$s_pembimbing = mysqli_query($CON, "SELECT * FROM tb_pendaftaran where id_magang = '" . addslashes($_POST['post']) . "'") or die(mysqli_error($CON));
while ($data = mysqli_fetch_array($s_pembimbing)) {
?>
	<!-- <form class="form-horizontal" method="post"> -->
	<tr>
		<td><?php echo $data['id_peserta']; ?></td>
		<td><?php echo $data['no_ktp']; ?></td>
		<td><?php echo $data['nama_peserta']; ?></td>
		<td><?php echo $data['jekel']; ?></td>
		<td><?php echo $data['alamat']; ?></td>
		<td><img src="../foto/user/<?php echo $data['foto']; ?>" class="img-responsive" style="width: 80px;"></td>
		<td><input type="number" class="form-control" min="0" name="nilai[]"></td>
		<td><input type="hidden" class="form-control" name="id_magang" value="<?php echo $data['id_magang'] ?>"><input type="text" class="form-control" name="keterangan[]"></td>
	</tr>

<?php
}
?>
<tr>
	<td colspan="8">
		<center><input type="submit" class="btn btn-info" name="btnsimpan" value="Simpan1"></center>
	</td>
</tr>
<tr>

	<!-- <input type="submit" class="btn btn-info" name="btnsimpan" value="Simpan1" > -->
</tr>
<!-- </form> -->