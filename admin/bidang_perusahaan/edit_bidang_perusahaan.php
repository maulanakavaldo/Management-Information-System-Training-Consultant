<?php
$id = $_GET['id'];

$sql = "SELECT * FROM tb_bidangpsh WHERE id_bidangpsh='" . addslashes($id) . "'";
$query = mysqli_query($CON, $sql) or die(mysqli_error($CON));
$data = mysqli_fetch_array($query);

if (isset($_POST['simpan'])) {
  // $bidangpsh = $_POST['bidangpsh'];
  $nama_bidangpsh = $_POST['nama_bidangpsh'];

  $simpan = mysqli_query($CON, "UPDATE tb_bidangpsh SET nama_bidang='" . addslashes($nama_bidangpsh) . "'  WHERE id_bidangpsh='$id'") or die(mysqli_error($CON));

  if ($simpan) {
    echo "
    <div class='right_col' role='main'>
    <div class='alert alert-success'>
                <a href='?page=data_bidang_perusahaan' class='close' data-dismiss='alert'>
                &times;
                </a> Edit Data Berhasil
                </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_bidang_perusahaan'>";
  } else {
    echo "
    <div class='right_col' role='main'>
    <div class='alert alert-success'>
                <a href='?page=data_bidang_perusahaan' class='close' data-dismiss='alert'>
                &times;
                </a> Edit Data Gagal
                </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_bidang_perusahaan'>";
  }
}
?>
<div class="right_col" role="main">
  <section class="content-header">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Edit Bidang Perusahaan</h3>
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
            <div class="x_content"></div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">ID Bidang</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="id_bidangpsh" value="<?php echo $data['id_bidangpsh']; ?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Nama bidang</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_bidangpsh" placeholder="Nama bidang" value="<?php echo $data['nama_bidang']; ?>" required>
                  </div>
                </div>

                <!-- /.box-body -->
                <div class="box-footer">
                  <a href="?page=data_bidang_perusahaan" class="btn btn-default">Batal</a>
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