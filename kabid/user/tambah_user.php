<?php
if (isset($_POST['simpan'])) {
  if (@$_FILES['foto']['name']) {
    $id_user = $_POST['id_user'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $jekel = $_POST['jekel'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $status = $_POST['status'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sumber     = $_FILES['foto']['tmp_name'];
    $target     =  '../foto/user/';
    $nama_foto  = $id_user . '_' . $_FILES["foto"]["name"];

    $pindah     = move_uploaded_file($sumber, $target . $nama_foto);

    $simpan = mysqli_query($CON, "INSERT INTO tb_user VALUES('$id_user','$nik','$nama','$jekel','$alamat','$no_telp', '$username', '$password', '$nama_foto', '$status')");

    if ($simpan) {
      echo "<div class='alert alert-success'>
      <a href='?page=data_user' class='close' data-dismiss='alert'>
      &times;
      </a> Simpan Data Berhasil
      </div>";

      echo "<meta http-equiv='refresh' content='1; url=?page=data_user'>";
    } else {
      echo "<div class='alert alert-warning'>
      <a href='?page=data_user' class='close' data-dismiss='alert'>
      &times;
      </a> Simpan Data Berhasil
      </div>";

      echo "<meta http-equiv='refresh' content='1; url=?page=data_user'>";
    }
  } else {
    echo "<div class='alert alert-warning'>
    <a href='?page=data_user' class='close' data-dismiss='alert'>
    &times;
    </a> Wajib Upload Foto
    </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_user'>";
  }
}

$query = "select max(id_user) from tb_user";
$sql = mysqli_query($CON, $query) or die(mysqli_error($CON));
$kode = mysqli_fetch_array($sql);
if ($kode) {
  $nilaikode = substr($kode[0], 1);
  $kodenya = (int) $nilaikode;
  $kodenya = $kodenya + 1;
  $hasilkode = "U" . str_pad($kodenya, 4, "0", STR_PAD_LEFT);
} else {
  $hasilkode = "U0001";
}
?>
<section class="content-header">
  <h1>
    Tambah User
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-television" class="active"></i> Data User</a></li>
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
              <label for="inputEmail3" class="col-sm-2 control-label">ID User</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="id_user" value="<?php echo $hasilkode ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">NIK</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nik" placeholder="NIK" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama" placeholder="Nama" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Jenis Kelamin</label>
              <div class="col-sm-5">
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
                <textarea class="form-control" rows="3" placeholder="Enter ..." name="alamat" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">No. Telepon </label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="no_telp" placeholder="Nomer Telepon" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Usename</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="username" placeholder="Usename" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="password" placeholder="Password" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Foto </label>
              <div class="col-sm-10">
                <input type="file" id="exampleInputFile" name="foto" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Status</label>
              <div class="col-sm-5">
                <select class="form-control" name="status">
                  <option>Pilih</option>
                  <option value="petugas">Petugas</option>
                  <option value="eo">EO</option>
                  <option value="pemilik_industri">Pemilik Industri</option>
                  <option value="kabid">Kepala Bidang</option>
                  <option value="kadin">Kepala Dinas</option>
                  <option value="peserta">Peserta</option>
                </select>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="?page=data_user" class="btn btn-default">Batal</a>
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