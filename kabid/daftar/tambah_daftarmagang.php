<?php
if (isset($_POST['simpan'])) {
  $id_magang = $_POST['id_magang'];
  $nama_magang = $_POST['nama_magang'];
  $tempat = $_POST['tempat'];
  $jadwal = $_POST['jadwal'];
  $kuota = $_POST['kuota'];
  $sql = "INSERT INTO tb_jenismagang VALUES('$id_magang','$nama_magang','$tempat','$jadwal','$kuota')";
  $simpan = mysqli_query($CON, $sql) or die(mysqli_error($CON));
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
    Tambah Jenis Magang
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-television" class="active"></i> Data Jenis Magang</a></li>
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
              <label for="inputEmail3" class="col-sm-2 control-label">ID Magang</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="id_magang" value="<?php echo $hasilkode ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama Magang</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_magang" placeholder="Nama Magang" required>
              </div>
            </div>
            <div class="form-group">
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
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="?page=data_daftarmagang" class="btn btn-default">Batal</a>
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