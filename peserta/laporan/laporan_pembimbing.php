<?php
if (isset($_POST['simpan'])) {
  $id_peserta = $_POST['id_pembimbing'];
  $no_ktp = $_POST['nik'];
  $nama_peserta = $_POST['nama_pembimbing'];
  $jekel = $_POST['jekel'];
  $alamat = $_POST['alamat'];
  $no_telp = $_POST['no_telp'];
  $status = $_POST['status'];
  $sumber     = $_FILES['foto']['tmp_name'];
  $target     =  '../foto/user/';
  $nama_foto  = $_FILES["foto"]["name"];

  $pindah     = move_uploaded_file($sumber, $target . $nama_foto);
  //$sk_desa = $_POST['sk_desa'];
  $query = "INSERT INTO tb_pembimbing VALUES('$id_pembimbing','$nik','$nama_pembimbing','$jekel','$alamat','$no_telp','$status','$nama_foto')";

  $simpan = mysqli_query($CON, $query) or die(mysqli_error($CON));
  if ($simpan) {
    echo "<div class='alert alert-success'>
                <a href='?page=data_pembimbing' class='close' data-dismiss='alert'>
                &times;
                </a> Simpan Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_pembimbing'>";
  } else {
    echo "<div class='alert alert-warning'>
                <a href='?page=data_pembimbing' class='close' data-dismiss='alert'>
                &times;
                </a> Simpan Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_pembimbing'>";
  }
}

$query = "select max(id_pembimbing) from tb_pembimbing";
$sql = mysqli_query($CON, $query) or die(mysqli_error($CON));
$kode = mysqli_fetch_array($sql);
if ($kode) {
  $nilaikode = substr($kode[0], 2);
  $kodenya = (int) $nilaikode;
  $kodenya = $kodenya + 1;
  $hasilkode = "PB" . str_pad($kodenya, 4, "0", STR_PAD_LEFT);
} else {
  $hasilkode = "PB0001";
}
?>
<section class="content-header">
  <h1>
    Laporan Pembimbing
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
        <form class="form-horizontal" method="post" action="laporan/laporan_pembimbing_pdf.php" target="_blank">

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