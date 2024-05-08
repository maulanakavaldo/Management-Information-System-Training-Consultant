<?php
include '../../koneksi.php';
$s_pendamping = mysqli_query($CON, "SELECT tb_perusahaan.id_psh, tb_perusahaan.nama_pendamping FROM `tb_perusahaan` left join tb_pelatihan on tb_perusahaan.id_psh=tb_pelatihan.id_psh left join tb_jenispelatihan on tb_jenispelatihan.id_jenispelatihan=tb_pelatihan.id_jenispelatihan GROUP by tb_perusahaan.id_psh") or die(mysqli_error($CON));
while ($h_pendamping = mysqli_fetch_array($s_pendamping)) {
    echo "<option value='$h_pendamping[id_psh]'>$h_pendamping[nama_pendamping]</option>";
}
