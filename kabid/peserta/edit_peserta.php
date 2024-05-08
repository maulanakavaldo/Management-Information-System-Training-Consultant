<?php
$id = $_GET['id'];

$sql = "SELECT * FROM tb_pendaftaran natural join tb_jenismagang WHERE id_peserta='$id'";
$query = mysqli_query($CON, $sql) or die(mysqli_error($CON));
$data = mysqli_fetch_array($query);

if (isset($_POST['simpan'])) {
  $id_peserta = $_POST['id_peserta'];
  $no_ktp = $_POST['no_ktp'];
  $nama_peserta = $_POST['nama_peserta'];
  $jekel = $_POST['jekel'];
  $alamat = $_POST['alamat'];
  $usaha = $_POST['usaha'];
  $hasil_produk = $_POST['hasil_produk'];
  $no_telp = $_POST['no_telp'];
  $id_magang = $_POST['id_magang'];

  $sumber     = $_FILES['foto']['tmp_name'];
  $target     =  '../foto/user/';
  $foto = $_FILES["foto"]["name"];
  $fotoup = $id_peserta . '_ft_' . $_FILES["foto"]["name"];

  $sumber2     = $_FILES['sk_desa']['tmp_name'];
  $target2    =  '../foto/file/';
  $sk_desa = $_FILES["sk_desa"]["name"];
  $sk_desaup = $id_peserta . '_sk_' . $_FILES["sk_desa"]["name"];

  $username = $_POST['username'];
  $password = $_POST['password'];
  $status = $_POST['status'];
  $id_periode = $_POST['id_periode'];

  if ($foto == "" && $sk_desa == "") {
    $simpan = mysqli_query($CON, "UPDATE tb_pendaftaran SET id_peserta='$id_peserta', no_ktp='$no_ktp', nama_peserta='$nama_peserta', jekel='$jekel', alamat='$alamat', usaha='$usaha', hasil_produk='$hasil_produk', no_telp='$no_telp', id_magang='$id_magang', username='$username', password='$password', status='$status', id_periode='$id_periode'  WHERE id_peserta='$id'") or die(mysqli_error($CON));
  } elseif ($sk_desa == "") {
    $sql1 = mysqli_query($CON, "select * from tb_pendaftaran WHERE id_peserta='$id'") or die(mysqli_error($CON));
    $folder1 = mysqli_fetch_array($sql1);
    $tempat1 = $folder1['foto'];
    $imagedelet1 = "../foto/user/$tempat1";
    unlink($imagedelet1);
    $pindah = move_uploaded_file($sumber, $target . $fotoup);
    $simpan = mysqli_query($CON, "UPDATE tb_pendaftaran SET id_peserta='$id_peserta', no_ktp='$no_ktp', nama_peserta='$nama_peserta', jekel='$jekel', alamat='$alamat', usaha='$usaha', hasil_produk='$hasil_produk', no_telp='$no_telp', id_magang='$id_magang', foto='$fotoup', username='$username', password='$password', status='$status', id_periode='$id_periode' WHERE id_peserta='$id'") or die(mysqli_error($CON));
  } elseif ($foto == "") {
    $sql2 = mysqli_query($CON, "select * from tb_pendaftaran WHERE id_peserta='$id'") or die(mysqli_error($CON));
    $folder2 = mysqli_fetch_array($sql2);
    $tempat2 = $folder2['sk_desa'];
    $imagedelet2 = "../foto/file/$tempat2";
    unlink($imagedelet2);
    $pindah = move_uploaded_file($sumber2, $target2 . $sk_desaup);
    $simpan = mysqli_query($CON, "UPDATE tb_pendaftaran SET id_peserta='$id_peserta', no_ktp='$no_ktp', nama_peserta='$nama_peserta', jekel='$jekel', alamat='$alamat', usaha='$usaha', hasil_produk='$hasil_produk', no_telp='$no_telp', id_magang='$id_magang', sk_desa='$sk_desaup', username='$username', password='$password', status='$status', id_periode='$id_periode' WHERE id_peserta='$id'") or die(mysqli_error($CON));
  } else {
    $sql3 = mysqli_query($CON, "select * from tb_pendaftaran WHERE id_peserta='$id'") or die(mysqli_error($CON));

    $folder1 = mysqli_fetch_array($sql3);
    $tempat1 = $folder1['foto'];
    $imagedelet1 = "../foto/user/$tempat1";
    unlink($imagedelet1);
    $pindah1 = move_uploaded_file($sumber, $target . $fotoup);

    $tempat2 = $folder1['sk_desa'];
    $imagedelet2 = "../foto/file/$tempat2";
    unlink($imagedelet2);
    $pindah2 = move_uploaded_file($sumber2, $target2 . $sk_desaup);
    $simpan = mysqli_query($CON, "UPDATE tb_pendaftaran SET id_peserta='$id_peserta', no_ktp='$no_ktp', nama_peserta='$nama_peserta', jekel='$jekel', alamat='$alamat', usaha='$usaha', hasil_produk='$hasil_produk', no_telp='$no_telp', id_magang='$id_magang', foto='$fotoup', sk_desa='$sk_desaup', username='$username', password='$password', status='$status', id_periode='$id_periode' WHERE id_peserta='$id'") or die(mysqli_error($CON));
  }



  if ($simpan) {
    echo "<div class='alert alert-success'>
                <a href='?page=data_peserta' class='close' data-dismiss='alert'>
                &times;
                </a> Edit Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_peserta'>";
  } else {
    echo "<div class='alert alert-success'>
                <a href='?page=data_peserta' class='close' data-dismiss='alert'>
                &times;
                </a> Edit Data Gagal
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_peserta'>";
  }
}
?>
<section class="content-header">
  <h1>
    Edit Peserta
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-television" class="active"></i> Data Peserta</a></li>
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
              <label for="inputEmail3" class="col-sm-2 control-label">ID Peserta</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="id_peserta" value="<?php echo $data['id_peserta']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">No KTP</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="no_ktp" placeholder="No ktp" value="<?php echo $data['no_ktp']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_peserta" placeholder="Nama peserta" value="<?php echo $data['nama_peserta']; ?>" required>
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
                <textarea class="form-control" rows="3" placeholder="Enter ..." name="alamat" required><?php echo $data['alamat']; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Usaha Anda</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="usaha" placeholder="usaha anda" value="<?php echo $data['usaha']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Hasil Produk anda</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="hasil_produk" placeholder="hasil yang anda hasilkan" value="<?php echo $data['hasil_produk']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">No. Telepon </label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="no_telp" placeholder="Nomer Telepon" value="<?php echo $data['no_telp']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama Magang</label>
              <div class="col-sm-10">
                <select class="form-control" name="id_magang" value="<?php echo $data['nama_magang']; ?>">
                  <option><?php echo $data['nama_magang']; ?></option>
                  <?php
                  $s_nama_magang = mysqli_query($CON, "SELECT * FROM tb_jenismagang") or die(mysqli_error($CON));
                  while ($h_nama_magang = mysqli_fetch_array($s_nama_magang)) {
                    if ($data[id_magang] == $h_nama_magang[id_magang]) {
                      echo "<option value='$h_nama_magang[id_magang]' selected='$data[id_magang]'>$h_nama_magang[nama_magang]</option>";
                    } else {
                      echo "<option value='$h_nama_magang[id_magang]'>$h_nama_magang[nama_magang]</option>";
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="input" class="col-sm-2 control-label">Foto Anda</label>
              <div class="col-sm-10">
                <input type="file" name="foto">
                <br>
                <label><?php echo $data['foto'] ?></label>
              </div>
            </div>
            <div class="form-group">
              <label for="input" class="col-sm-2 control-label">Surat Keterangan Desa</label>
              <div class="col-sm-10">
                <input type="file" name="sk_desa">
                <br>
                <label><?php echo $data['sk_desa'] ?></label>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Usename</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="username" placeholder="username" value="<?php echo $data['username']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="password" placeholder="password" value="<?php echo $data['password']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Status</label>
              <div class="col-sm-10">
                <select class="form-control" name="status">
                  <option value="calon" <?php if ($data['status'] == "calon") {
                                          echo 'selected';
                                        } ?>>Calon</option>
                  <option value="diterima" <?php if ($data['status'] == "diterima") {
                                              echo 'selected';
                                            } ?>>Diterima</option>
                  <option value="ditolak" <?php if ($data['status'] == "ditolak") {
                                            echo 'selected';
                                          } ?>>Ditolak</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tahun Periode</label>
              <div class="col-sm-10">
                <select class="form-control" name="id_periode">

                  <?php
                  $s_periode = mysqli_query($CON, "SELECT id_periode,tahun FROM tb_periode");
                  while ($h_periode = mysqli_fetch_array($s_periode)) {
                    if ($data[id_periode] == $h_periode[id_periode]) {
                      echo "<option value='$h_periode[id_periode]' selected='$data[id_periode]'>$h_periode[tahun]</option>";
                    } else {
                      echo "<option value='$h_periode[id_periode]'>$h_periode[tahun]</option>";
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="?page=data_peserta" class="btn btn-default">Batal</a>
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