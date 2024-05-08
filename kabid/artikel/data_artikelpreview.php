<?php
$id = $_GET['id'];

$sql = "SELECT * FROM tb_artikel WHERE id_artikel='$id'";
$query = mysqli_query($CON, $sql) or die(mysqli_error($CON));
$data = mysqli_fetch_array($query);

if (isset($_POST['simpan'])) {
  $id_artikel = $_POST['id_artikel'];
  $judul = $_POST['judul'];
  $isi = $_POST['isi'];
  $kategori = $_POST['kategori'];
  $tanggal = $_POST['tanggal'];


  $simpan = mysqli_query($CON, "UPDATE tb_artikel SET judul='$judul', isi='$isi', kategori='$kategori', tanggal='$tanggal' WHERE id_artikel='$id_artikel'") or die(mysqli_error($CON));

  if ($simpan) {
    echo "<div class='alert alert-success'>
                <a href='?page=data_artikel' class='close' data-dismiss='alert'>
                &times;
                </a> Edit Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_artikel'>";
  } else {
    echo "<div class='alert alert-success'>
                <a href='?page=data_artikel' class='close' data-dismiss='alert'>
                &times;
                </a> Edit Data Gagal
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_artikel'>";
  }
}
?>
<section class="content-header">
  <h1>
    Edit Artikel
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-television" class="active"></i> Data Artikel</a></li>
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
              <label for="inputEmail3" class="col-sm-2 control-label">ID Artikel</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="id_artikel" value="<?php echo $data['id_artikel']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">judul</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="judul" placeholder="judul artikel" value="<?php echo $data['judul']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Isi Artikel</label>
              <div class="col-sm-10">
                <textarea name="isi" id="editor1" rows="10" cols="80" required><?php echo $data['isi']; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Kategori</label>
              <div class="col-sm-10">
                <select class="form-control" name="kategori">
                  <option value="artikel">Artikel</option>
                  <option value="berita" <?php if ($data['kategori'] == "berita") {
                                            echo 'selected';
                                          } ?>>Berita</option>
                  <option value="informasi" <?php if ($data['kategori'] == "informasi") {
                                              echo 'selected';
                                            } ?>>Informasi</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tanggal</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" name="tanggal" placeholder="tanggal" value="<?php echo $data['tanggal']; ?>" required>
              </div>
            </div>

          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="?page=data_artikel" class="btn btn-default">Batal</a>
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