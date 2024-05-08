<?php
if (isset($_POST['simpan'])) {
  $id_pemagangan = $_POST['id_pemagangan'];
  $nama_magang = $_POST['nama_magang'];
  $tempat = $_POST['tempat'];
  $jadwal = $_POST['jadwal'];
  $nama_pembimbing = $_POST['nama_pembimbing'];

  $query = "INSERT INTO tb_magang VALUES('$id_pemagangan','$nama_magang','$tempat','$jadwal','$nama_pembimbing')";

  $simpan = mysqli_query($CON, $query) or die(mysqli_error($CON));
  if ($simpan) {
    echo "<div class='alert alert-success'>
                <a href='?page=data_magang' class='close' data-dismiss='alert'>
                &times;
                </a> Simpan Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_magang'>";
  } else {
    echo "<div class='alert alert-warning'>
                <a href='?page=data_magang' class='close' data-dismiss='alert'>
                &times;
                </a> Simpan Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_magang'>";
  }
}

$query = "select max(id_pemagangan) from tb_magang";
$sql = mysqli_query($CON, $query) or die(mysqli_error($CON));
$kode = mysqli_fetch_array($sql);
if ($kode) {
  $nilaikode = substr($kode[0], 2);
  $kodenya = (int) $nilaikode;
  $kodenya = $kodenya + 1;
  $hasilkode = "MG" . str_pad($kodenya, 4, "0", STR_PAD_LEFT);
} else {
  $hasilkode = "MG0001";
}
?>
<section class="content-header">
  <h1>
    Laporan Magang
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-television" class="active"></i> Laporan Pembimbing</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Silahkan Dicetak</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="laporan/laporan_magang_pdf.php" target="_blank">

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