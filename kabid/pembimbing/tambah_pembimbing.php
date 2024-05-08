<?php
if (isset($_POST['simpan'])) {
  $id_pembimbing = $_POST['id_pembimbing'];
  $nik = $_POST['nik'];
  $nama_pembimbing = $_POST['nama_pembimbing'];
  $jekel = $_POST['jekel'];
  $alamat = $_POST['alamat'];
  $no_telp = $_POST['no_telp'];
  $sumber     = $_FILES['foto']['tmp_name'];
  $target     =  '../foto/user/';
  $foto  = $_FILES["foto"]["name"];

  $pindah     = move_uploaded_file($sumber, $target . $foto);
  $sql = "INSERT INTO tb_pembimbing VALUES('$id_pembimbing','$nik','$nama_pembimbing','$jekel','$alamat','$no_telp','$foto')";
  $simpan = mysqli_query($CON, $sql) or die(mysqli_error($CON));
  if ($simpan) {
    echo "<div class='alert alert-success'>
                <a href='?page=data_pembimbing' class='close' data-dismiss='alert'>
                &times;
                </a> Simpan Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_pembimbing'>";
  } else {
    echo "<div class='alert alert-warning'>
                <a href='?page=data_pembimbing' class='close' data-dismiss='alert'>
                &times;
                </a> Simpan Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_pembimbing'>";
  }
}

$query = "select max(id_pembimbing) from tb_pembimbing";
$sql = mysqli_query($CON, $query) or die(mysqli_error($CON));
$kode = mysqli_fetch_array($sql);
if ($kode) {
  $nilaikode = substr($kode[0], 2);
  $kodenya = (int) $nilaikode;
  $kodenya = $kodenya + 1;
  $hasilkode = "PB" . str_pad($kodenya, 4, "0", STR_PAD_LEFT);
} else {
  $hasilkode = "PB0001";
}
?>
<section class="content-header">
  <h1>
    Tambah Pembimbing
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-television" class="active"></i> Data pembimbing</a></li>
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
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">ID Pembimbing</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="id_pembimbing" value="<?php echo $hasilkode ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nik</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nik" placeholder="Nik Pembimbing" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama Pembimbing</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_pembimbing" placeholder="Nama Pembimbing" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Jenis Kelamin</label>
              <div class="col-sm-10">
                <select class="form-control" name="jekel">
                  <option>Pilih</option>
                  <option value="L">Laki-laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="3" placeholder="Enter ..." name="alamat"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">No. Telepon </label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="no_telp" placeholder="Nomer Telepon" required>
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Foto</label>
              <div class="col-sm-10">
                <input type="file" id="exampleInputFile" name="foto" required>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <a href="?page=data_pembimbing" class="btn btn-default">Batal</a>
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