<?php
if (isset($_POST['simpan'])) {
  $id_penilaian = $_POST['id_penilaian'];
  $nama_pelatihan = $_POST['nama_pelatihan'];
  $nama_peserta = $_POST['nama_peserta'];
  $nama = $_POST['nama'];
  $nilai = $_POST['nilai_akhir'];
  $keterangan = $_POST['keterangan'];

  //$sk_desa = $_POST['sk_desa'];
  $query = "INSERT INTO tb_penilaian VALUES('$id_penilaian','$nama_pelatihan','$nama_peserta','$nama','$nilai_akhir','$keterangan')";

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
<div class="right_col" role="main">
  <section class="content-header">

    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3> Laporan Penilaian </h3>
        </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="col-xs-12">
        <div class="box-header with-border">
          <div class="x_panel">
            <div class="x_title">
              <h2>Silahkan Pilih Penilaian Yang Ingin Dicetak </h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="laporan/laporan_penilaian_pdf.php" target="_blank">
              <div class="box-body">

                <div class="form-group">
                  <label class="col-sm-4 control-label">Nama Pelatihan</label>
                  <div class="col-sm-4">
                    <select class="form-control" name="id_jenispelatihan">
                      <!-- <option disabled="disabled" selected="selected">Pilih*</option> -->
                      <?php
                      $s_pelatihan = mysqli_query($CON, "SELECT * FROM tb_jenispelatihan") or die(mysqli_error($CON));
                      while ($h_pelatihan = mysqli_fetch_array($s_pelatihan)) {
                        echo "<option value='$h_pelatihan[id_jenispelatihan]|$h_pelatihan[nama_pelatihan]'>$h_pelatihan[nama_pelatihan]</option>";
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