<?php
if (isset($_POST['simpan'])) {
  $id_penilaian = $_POST['id_penilaian'];
  $nama_magang = $_POST['nama_magang'];
  $nama_peserta = $_POST['nama_peserta'];
  $nama = $_POST['nama'];
  $nilai = $_POST['nilai'];
  $keterangan = $_POST['keterangan'];
  $sumber     = $_FILES['foto']['tmp_name'];
  $target     =  '../foto/user/';
  $nama_foto  = $_FILES["foto"]["name"];

  $pindah     = move_uploaded_file($sumber, $target . $nama_foto);

  $sumber1     = $_FILES['sk_desa']['tmp_name'];
  $target1     =  '../foto/file/';
  $nama_foto1  = $_FILES["sk_desa"]["name"];

  $pindah1     = move_uploaded_file($sumber1, $target1 . $nama_foto1);
  //$sk_desa = $_POST['sk_desa'];
  $query = "INSERT INTO tb_penilaian VALUES('$id_penilaian','$nama_magang','$nama_peserta','$nama','$nilai','$keterangan')";

  $simpan = mysqli_query($CON, $query) or die(mysqli_error($CON));
  if ($simpan) {
    echo "<div class='alert alert-success'>
                <a href='?page=data_penilaian' class='close' data-dismiss='alert'>
                &times;
                </a> Simpan Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_penilaian'>";
  } else {
    echo "<div class='alert alert-warning'>
                <a href='?page=data_penilaian' class='close' data-dismiss='alert'>
                &times;
                </a> Simpan Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_penilaian'>";
  }
}

$query = "select max(id_penilaian) from tb_penilaian";
$sql = mysqli_query($CON, $query) or die(mysqli_error($CON));
$kode = mysqli_fetch_array($sql);
if ($kode) {
  $nilaikode = substr($kode[0], 0);
  $kodenya = (int) $nilaikode;
  $kodenya = $kodenya + 1;
  $hasilkode = "" . str_pad($kodenya, 1, "0", STR_PAD_LEFT);
} else {
  $hasilkode = "1";
}
?>
<section class="content-header">
  <h1>
    Laporan Penilaian
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-television" class="active"></i> Laporan Penilaian</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Silahkan Pilih Penilaian Yang Ingin Dicetak</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="laporan/laporan_penilai_pdf.php" target="_blank">
          <div class="box-body">

            <div class="form-group">
              <label class="col-sm-4 control-label">Nama Magang</label>
              <div class="col-sm-4">
                <select class="form-control" name="id_magang">
                  <!-- <option disabled="disabled" selected="selected">Pilih*</option> -->
                  <?php
                  $s_magang = mysqli_query($CON, "SELECT * FROM tb_jenismagang") or die(mysqli_error($CON));
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