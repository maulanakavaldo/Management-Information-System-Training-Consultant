<?php
if (isset($_POST['simpan'])) {
  $id_bidangplt = $_POST['id_bidangplt'];
  $nama_bidang = $_POST['nama_bidang'];

  $sql = "INSERT INTO tb_bidangplt VALUES('$id_bidangplt','$nama_bidang')";
  $simpan = mysqli_query($CON, $sql) or die(mysqli_error($CON));
  if ($simpan) {
    echo "<div class='right_col' role='main'>
    <div class='alert alert-success'>
                <a href='?page=data_bidang_pelatihan' class='close' data-dismiss='alert'>
                &times;
                </a> Simpan Data Berhasil
                </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_bidang_pelatihan'>";
  } else {
    echo "<div class='right_col' role='main'>
    <div class='alert alert-warning'>
                <a href='?page=data_bidang_pelatihan' class='close' data-dismiss='alert'>
                &times;
                </a> Simpan Data Berhasil
                </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_bidang_pelatihan'>";
  }
}

$query = "select max(id_bidangplt) from tb_bidangplt";
$sql = mysqli_query($CON, $query) or die(mysqli_error($CON));
$kode = mysqli_fetch_array($sql);
if ($kode) {
  $nilaikode = substr($kode[0], 2);
  $kodenya = (int) $nilaikode;
  $kodenya = $kodenya + 1;
  $hasilkode = "BP" . str_pad($kodenya, 4, "0", STR_PAD_LEFT);
} else {
  $hasilkode = "BP0001";
}
?>
<div class="right_col" role="main">
  <section class="content-header">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3> Tambah Jenis Pelatihan</h3>
        </div>

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box-header with-border">
          <div class="x_panel">
            <div class="x_title">
              <h2>Silahkan isi data dengan benar</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <!-- /.box-header -->
              <!-- form start -->
              <form class="form-horizontal" method="post">
                <div class="box-body">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">ID</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="id_bidangplt" value="<?php echo $hasilkode ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Nama Bidang</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama_bidang" placeholder="Nama Bidang" required>
                    </div>
                  </div>
                  <!--<div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Tempat</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="tempat" placeholder="Tempat" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Jadwal</label>
                  <div class="col-sm-3">
                    <input type="date" class="form-control" name="jadwal" placeholder="Jadwal" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Kuota</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="kuota" placeholder="Kuota" required>
                  </div>
                </div>
              </div> -->
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <a href="?page=data_bidang_pelatihan" class="btn btn-default">Batal</a>
                    <button type="submit" class="btn btn-info pull-right" name="simpan">Simpan</button>
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