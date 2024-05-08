<?php
if (isset($_POST['simpan'])) {
  $id_peserta = $_POST['id_peserta'];
  $no_ktp = $_POST['no_ktp'];
  $nama_peserta = $_POST['nama_peserta'];
  $jekel = $_POST['jekel'];
  $alamat = $_POST['alamat'];
  $usaha = $_POST['usaha'];
  $hasil_produk = $_POST['hasil_produk'];
  $no_telp = $_POST['no_telp'];
  $nama_magang = $_POST['nama_magang'];
  $sumber     = $_FILES['foto']['tmp_name'];
  $target     =  '../foto/user/';
  $nama_foto  = $_FILES["foto"]["name"];

  $pindah     = move_uploaded_file($sumber, $target . $nama_foto);

  $sumber1     = $_FILES['sk_desa']['tmp_name'];
  $target1     =  '../foto/file/';
  $nama_foto1  = $_FILES["sk_desa"]["name"];

  $pindah1     = move_uploaded_file($sumber1, $target1 . $nama_foto1);
  //$sk_desa = $_POST['sk_desa'];
  $query = "INSERT INTO tb_pendaftaran VALUES('$id_peserta','$no_ktp','$nama_peserta','$jekel','$alamat','$usaha','$hasil_produk','$no_telp','$nama_magang','$nama_foto','$nama_foto1')";

  $simpan = mysqli_query($CON, $query) or die(mysqli_error($CON));
  if ($simpan) {
    echo "<div class='alert alert-success'>
                <a href='?page=data_peserta' class='close' data-dismiss='alert'>
                &times;
                </a> Simpan Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_peserta'>";
  } else {
    echo "<div class='alert alert-warning'>
                <a href='?page=data_peserta' class='close' data-dismiss='alert'>
                &times;
                </a> Simpan Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_peserta'>";
  }
}

$query = "select max(id_peserta) from tb_pendaftaran";
$sql = mysqli_query($CON, $query) or die(mysqli_error($CON));
$kode = mysqli_fetch_array($sql);
if ($kode) {
  $nilaikode = substr($kode[0], 1);
  $kodenya = (int) $nilaikode;
  $kodenya = $kodenya + 1;
  $hasilkode = "P" . str_pad($kodenya, 4, "0", STR_PAD_LEFT);
} else {
  $hasilkode = "P0001";
}
?>
<section class="content-header">
  <h1>
    Laporan Presensi
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-television" class="active"></i> Laporan Magang</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Silahkan Pilih Magang Yang Ingin Dicetak</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="laporan/laporan_presensi_pdf.php" target="_blank">
          <div class="box-body">

            <div class="form-group">
              <label class="col-sm-4 control-label">Nama Magang</label>
              <div class="col-sm-4">
                <select class="form-control" name="id_magang">
                  <!-- <option disabled="disabled" selected="selected">Pilih*</option> -->
                  <?php
                  $s_magang = mysqli_query($CON, "select id_magang, nama_magang from tb_jenismagang NATURAL JOIN tb_magang NATURAL JOIN tb_presensi GROUP by id_magang") or die(mysqli_error($CON));
                  while ($h_magang = mysqli_fetch_array($s_magang)) {
                    echo "<option value='$h_magang[id_magang]|$h_magang[nama_magang]'>$h_magang[nama_magang]</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <center>
              <input type="submit" class="btn btn-success btn-lg" name="cetak" value="CETAK PDF">
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>