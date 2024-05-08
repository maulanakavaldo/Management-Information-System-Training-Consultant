<?php
$id = $_GET['id'];

$sql = "SELECT * FROM tb_periode WHERE id_periode='$id'";
$query = mysqli_query($CON, $sql) or die(mysqli_error($CON));
$data = mysqli_fetch_array($query);

if (isset($_POST['simpan'])) {
  $id_periode = $_POST['id_periode'];
  $tahun = $_POST['tahun'];
  $tgl_mulai = $_POST['tgl_mulai'];
  $tgl_selesai = $_POST['tgl_selesai'];


  $simpan = mysqli_query($CON, "UPDATE tb_periode SET tahun='$tahun', tgl_mulai='$tgl_mulai', tgl_selesai='$tgl_selesai' WHERE id_periode='$id_periode'") or die(mysqli_error($CON));

  if ($simpan) {
    echo "<div class='alert alert-success'>
                <a href='?page=data_periode' class='close' data-dismiss='alert'>
                &times;
                </a> Edit Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_periode'>";
  } else {
    echo "<div class='alert alert-success'>
                <a href='?page=data_periode' class='close' data-dismiss='alert'>
                &times;
                </a> Edit Data Gagal
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_periode'>";
  }
}
?>
<section class="content-header">
  <h1>
    Edit Periode
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
                <input type="text" class="form-control" name="id_periode" value="<?php echo $data['id_periode']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tahun</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="tahun" placeholder="tahun" value="<?php echo $data['tahun']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Mulai</label>
              <div class="col-sm-5">
                <input type="date" class="form-control" name="tgl_mulai" placeholder="tanggal mulai" value="<?php echo $data['tgl_mulai']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Selesai</label>
              <div class="col-sm-5">
                <input type="date" class="form-control" name="tgl_selesai" placeholder="tanggal selesai" value="<?php echo $data['tgl_selesai']; ?>" required>
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