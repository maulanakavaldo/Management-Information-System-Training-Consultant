<?php
if (isset($_POST['simpan'])) {
  $id_periode = $_POST['id_periode'];
  $tahun = $_POST['tahun'];
  $tgl_mulai = $_POST['tgl_mulai'];
  $tgl_selesai = $_POST['tgl_selesai'];
  $sql = "INSERT INTO tb_periode VALUES('$id_periode','$tahun','$tgl_mulai','$tgl_selesai')";
  $simpan = mysqli_query($CON, $sql) or die(mysqli_error($CON));
  if ($simpan) {
    echo "<div class='alert alert-success'>
                <a href='?page=data_periode' class='close' data-dismiss='alert'>
                &times;
                </a> Simpan Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_periode'>";
  } else {
    echo "<div class='alert alert-warning'>
                <a href='?page=data_periode' class='close' data-dismiss='alert'>
                &times;
                </a> Simpan Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_periode'>";
  }
}

$query = "select max(id_periode) from tb_periode";
$sql = mysqli_query($CON, $query) or die(mysqli_error($CON));
$kode = mysqli_fetch_array($sql);
if ($kode) {
  $nilaikode = substr($kode[0], 3);
  $kodenya = (int) $nilaikode;
  $kodenya = $kodenya + 1;
  $hasilkode = "PER" . str_pad($kodenya, 4, "0", STR_PAD_LEFT);
} else {
  $hasilkode = "PER0001";
}
?>
<section class="content-header">
  <h1>
    Tambah Periode
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-television" class="active"></i> Data Periode</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Silahkan isi data dengan benar</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">ID Periode</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="id_periode" value="<?php echo $hasilkode ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tahun Periode</label>
              <div class="col-sm-10">
                <input type="year" class="form-control" name="tahun_periode" placeholder="tahun periode" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Mulai</label>
              <div class="col-sm-5">
                <input type="date" class="form-control" name="tgl_mulai" placeholder="tanggal mulai" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Selesai</label>
              <div class="col-sm-5">
                <input type="date" class="form-control" name="tgl_selesai" placeholder="tanggal Selesai" required>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="?page=data_periode" class="btn btn-default">Batal</a>
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