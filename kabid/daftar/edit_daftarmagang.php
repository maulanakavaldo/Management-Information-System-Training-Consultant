<?php
$id = $_GET['id'];

$sql = "SELECT * FROM tb_jenismagang WHERE id_magang='$id'";
$query = mysqli_query($CON, $sql) or die(mysqli_error($CON));
$data = mysqli_fetch_array($query);

if (isset($_POST['simpan'])) {
  $id_magang = $_POST['id_magang'];
  $nama_magang = $_POST['nama_magang'];
  $tempat = $_POST['tempat'];
  $jadwal = $_POST['jadwal'];
  $kuota = $_POST['kuota'];


  $simpan = mysqli_query($CON, "UPDATE tb_jenismagang SET nama_magang='$nama_magang', tempat='$tempat', jadwal='$jadwal', kuota='$kuota' WHERE id_magang='$id_magang'") or die(mysqli_error($CON));

  if ($simpan) {
    echo "<div class='alert alert-success'>
                <a href='?page=data_daftarmagang' class='close' data-dismiss='alert'>
                &times;
                </a> Edit Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_daftarmagang'>";
  } else {
    echo "<div class='alert alert-success'>
                <a href='?page=data_daftarmagang' class='close' data-dismiss='alert'>
                &times;
                </a> Edit Data Gagal
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_daftarmagang'>";
  }
}
?>
<section class="content-header">
  <h1>
    Edit jenis Magang
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
                <input type="text" class="form-control" name="id_magang" value="<?php echo $data['id_magang']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama Magang</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_magang" placeholder="Nama_magang" value="<?php echo $data['nama_magang']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tempat</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="tempat" placeholder="tempat" value="<?php echo $data['tempat']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Jadwal</label>
              <div class="col-sm-3">
                <input type="date" class="form-control" name="jadwal" placeholder="jadwal" value="<?php echo $data['jadwal']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Kuota</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="kuota" placeholder="kuota" value="<?php echo $data['kuota']; ?>" required>
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