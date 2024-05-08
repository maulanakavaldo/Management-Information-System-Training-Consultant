<?php
$id = $_GET['id'];

$sql = "SELECT * FROM tb_pembimbing WHERE id_pembimbing='" . addslashes($id) . "'";
$query = mysqli_query($CON, $sql) or die(mysqli_error($CON));
$data = mysqli_fetch_array($query);

if (isset($_POST['simpan'])) {
  $nik = $_POST['nik'];
  $nama_pembimbing = $_POST['nama_pembimbing'];
  $jekel = $_POST['jekel'];
  $alamat = $_POST['alamat'];
  $no_telp = $_POST['no_telp'];
  $sumber     = $_FILES['foto']['tmp_name'];
  $target     =  '../foto/user/';
  $foto  = $_FILES["foto"]["name"];

  if ($foto == "") {
    $simpan = mysqli_query($CON, "UPDATE tb_pembimbing SET nik='" . addslashes($nik) . "', nama_pembimbing='" . addslashes($nama_pembimbing) . "', jekel='$jekel', alamat='$alamat', no_telp='$no_telp' WHERE id_pembimbing='$id'") or die(mysqli_error($CON));
  } else {
    $sql1 = mysqli_query($CON, "select * from tb_pembimbing where id_pembimbing='$id'") or die(mysqli_error($CON));
    $folder = mysqli_fetch_array($sql1);
    $tempat = $folder['foto'];
    $imagedelet = "../foto/user/$tempat";
    unlink($imagedelet);
    $pindah = move_uploaded_file($sumber, $target . $foto);
    $simpan = mysqli_query($CON, "UPDATE tb_pembimbing SET nik='$nik', nama_pembimbing='$nama_pembimbing', jekel='$jekel', alamat='$alamat', no_telp='$no_telp', foto='$foto' WHERE id_pembimbing='$id'") or die(mysqli_error($CON));
  }

  if ($simpan) {
    echo "<div class='alert alert-success'>
                <a href='?page=data_pembimbing' class='close' data-dismiss='alert'>
                &times;
                </a> Edit Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_pembimbing'>";
  } else {
    echo "<div class='alert alert-success'>
                <a href='?page=data_pembimbing' class='close' data-dismiss='alert'>
                &times;
                </a> Edit Data Gagal
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_pembimbing'>";
  }
}
?>
<section class="content-header">
  <h1>
    Edit Pembimbing
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-television" class="active"></i> Data Pembimbing</a></li>
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
                <input type="text" class="form-control" name="id_pembimbing" value="<?php echo $data['id_pembimbing']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nik</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nik" placeholder="Nik" value="<?php echo $data['nik']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama Pembimbing</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_pembimbing" placeholder="Nama Pembimbing" value="<?php echo $data['nama_pembimbing']; ?>" required>
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
              <label for="inputPassword3" class="col-sm-2 control-label">Foto Anda</label>
              <div class="col-sm-10">
                <input type="file" id="exampleInputFile" name="foto">
                <br>
                <label><?php echo $data['foto'] ?></label>
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