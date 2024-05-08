<?php
if (isset($_POST['simpan'])) {
  $id_artikel = $_POST['id_artikel'];
  $judul = $_POST['judul'];
  $isi = $_POST['isi'];
  $kategori = $_POST['kategori'];
  $tanggal = date('Y-m-d');
  $sql = "INSERT INTO tb_artikel VALUES('$id_artikel','$judul','$isi','$kategori','$tanggal','$userlogin')";
  $simpan = mysqli_query($CON, $sql) or die(mysqli_error($CON));
  if ($simpan) {
    echo "<div class='alert alert-success'>
                <a href='?page=data_artikel' class='close' data-dismiss='alert'>
                &times;
                </a> Simpan Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_artikel'>";
  } else {
    echo "<div class='alert alert-warning'>
                <a href='?page=data_artikel' class='close' data-dismiss='alert'>
                &times;
                </a> Simpan Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_artikel'>";
  }
}

$query = "select max(id_artikel) from tb_artikel";
$sql = mysqli_query($CON, $query) or die(mysqli_error($CON));
$kode = mysqli_fetch_array($sql);
if ($kode) {
  $nilaikode = substr($kode[0], 2);
  $kodenya = (int) $nilaikode;
  $kodenya = $kodenya + 1;
  $hasilkode = "AR" . str_pad($kodenya, 4, "0", STR_PAD_LEFT);
} else {
  $hasilkode = "AR0001";
}
?>
<section class="content-header">
  <h1>
    Tambah Artikel
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
                <input type="text" class="form-control" name="id_artikel" value="<?php echo $hasilkode ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Judul</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="judul" placeholder="judul" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Isi Artikel</label>
              <div class="col-sm-10">
                <textarea name="isi" id="editor1" rows="10" cols="80"></textarea required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Kategori</label>
                  <div class="col-sm-5">
                    <select class="form-control" name="kategori" required>
                      <option>Pilih</option>                      
                      <option value="Artikel">Artikel</option>
                      <option value="Berita">Berita</option>
                      <option value="Informasi">Informasi</option>
                    </select>
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="?page=data_artikel" class="btn btn-default">Batal</a>
                <button type="submit" class="btn btn-info pull-right" name="simpan" >Simpan</button>
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