<?php
if (isset($_POST['simpan'])) {
  $id_peserta = $_POST['id_magang'];
  $no_ktp = $_POST['nama_magang'];
  $nama_peserta = $_POST['tempat'];
  $jekel = $_POST['jadwal'];
  $alamat = $_POST['kuota'];
  //$sk_desa = $_POST['sk_desa'];
  $query = "INSERT INTO tb_jenismagang VALUES('$id_magang','$nama_magang','$tempat','$jadwal','$kuota')";

  $simpan = mysqli_query($CON, $query) or die(mysqli_error($CON));
  if ($simpan) {
    echo "<div class='alert alert-success'>
                <a href='?page=data_daftarmagang' class='close' data-dismiss='alert'>
                &times;
                </a> Simpan Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_daftarmagang'>";
  } else {
    echo "<div class='alert alert-warning'>
                <a href='?page=data_daftarmagang' class='close' data-dismiss='alert'>
                &times;
                </a> Simpan Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_daftarmagang'>";
  }
}

$query = "select max(id_magang) from tb_jenismagang";
$sql = mysqli_query($CON, $query) or die(mysqli_error($CON));
$kode = mysqli_fetch_array($sql);
if ($kode) {
  $nilaikode = substr($kode[0], 2);
  $kodenya = (int) $nilaikode;
  $kodenya = $kodenya + 1;
  $hasilkode = "DM" . str_pad($kodenya, 4, "0", STR_PAD_LEFT);
} else {
  $hasilkode = "DM0001";
}
?>
<section class="content-header">
  <h1>
    Laporan Jenis Magang
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-television" class="active"></i> Laporan Jenis Magang</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Silahkan Cetak Laporan</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="laporan/laporan_jenismagang_pdf.php" target="_blank">
          <div class="box-body">

            <!-- <div class="form-group"> -->
            <center><input type="submit" class="btn btn-success btn-lg" name="cetak" value="CETAK PDF"></center>
            <!--  </div> -->
            <!-- /.box-body -->
            <div class="box-footer">
              <center>

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