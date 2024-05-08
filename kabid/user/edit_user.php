<?php
$id = $_GET['id'];
$sql = "SELECT * FROM tb_user WHERE id_user='$id'";
$query = mysqli_query($CON, $sql) or die(mysqli_error($CON));
$data = mysqli_fetch_array($query);

if (isset($_POST['simpan'])) {
  $id_user = $_POST['id_user'];
  $nik = $_POST['nik'];
  $nama = $_POST['nama'];
  $jekel = $_POST['jekel'];
  $alamat = $_POST['alamat'];
  $no_telp = $_POST['no_telp'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sumber     = $_FILES['foto']['tmp_name'];
  $target     =  '../foto/user/';
  $foto  = $id_user . '_' . $_FILES["foto"]["name"];
  $foto_cek  = $_FILES["foto"]["name"];
  $status = $_POST['status'];

  if ($foto_cek == "") {
    $simpan = mysqli_query($CON, "UPDATE tb_user SET nik='$nik', nama='$nama', jekel='$jekel', alamat='$alamat', 
    no_telp='$no_telp', username='$username', password='$password', status='$status' WHERE id_user='$id'") or die(mysqli_error($CON));
  } else {
    $sql1 = mysqli_query($CON, "select foto from tb_user where id_user='$id_user'") or die(mysqli_error($CON));
    $folder = mysqli_fetch_array($sql1);
    $tempat = $folder['foto'];
    $imagedelet = "../foto/user/$tempat";
    unlink($imagedelet);
    $pindah = move_uploaded_file($sumber, $target . $foto);
    $simpan = mysqli_query($CON, "UPDATE tb_user SET nik='$nik', nama='$nama', jekel='$jekel', alamat='$alamat', 
    no_telp='$no_telp', username='$username', password='$password', foto='$foto', status='$status' WHERE id_user='$id'") or die(mysqli_error($CON));
  }

  if ($simpan) {
    echo "<div class='alert alert-success'>
    <a href='?page=data_user' class='close' data-dismiss='alert'>
    &times;
    </a> Edit Data Berhasil
    </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_user'>";
  } else {
    echo "<div class='alert alert-success'>
    <a href='?page=data_user' class='close' data-dismiss='alert'>
    &times;
    </a> Edit Data Gagal
    </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_user'>";
  }
}

?>
<section class="content-header">
  <h1>
    Edit User
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
                <input type="text" class="form-control" name="id_user" value="<?php echo $data['id_user']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">NIK</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nik" placeholder="NIK" value="<?php echo $data['nik']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?php echo $data['nama']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Jenis Kelamin</label>
              <div class="col-sm-10">
                <select class="form-control" name="jekel">
                  <option value="L">Laki-laki</option>
                  <option value="P" <?php if ($data['jekel'] == "P") {
                                      echo 'selected';
                                    } ?>>Perempuan</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="3" placeholder="Enter ..." name="alamat"><?php echo $data['alamat']; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">No. Telepon </label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="no_telp" placeholder="Nomer Telepon" value="<?php echo $data['no_telp']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Username</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="username" placeholder="Pilih Username Anda" value="<?php echo $data['username']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="password" placeholder="ganti password" value="<?php echo $data['password']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Foto</label>
              <div class="col-sm-10">
                <input type="file" id="exampleInputFile" name="foto">
                <br>
                <label><?php echo $data['foto'] ?></label>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Status</label>
              <div class="col-sm-10">
                <select class="form-control" name="status">
                  <option> <?php echo $data['status']; ?></option>
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