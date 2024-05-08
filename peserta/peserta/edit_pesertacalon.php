<?php
$id = $_GET['id'];

$sql = "SELECT * FROM tb_pendaftaran natural join tb_jenispelatihan WHERE id_peserta='$id'";
$query = mysqli_query($CON, $sql) or die(mysqli_error($CON));
$data = mysqli_fetch_array($query);

if (isset($_POST['simpan'])) {
  $id_peserta = $_POST['id_peserta'];
  $no_ktp = $_POST['no_ktp'];
  $nama_peserta = $_POST['nama_peserta'];
  $jekel = $_POST['jekel'];
  $alamat = $_POST['alamat'];
  $no_hp = $_POST['no_hp'];
  $nama_perusahaan = $_POST['nama_perusahaan'];
  $produk = $_POST['produk'];
  $id_jenispelatihan = $_POST['id_jenispelatihan'];

  $sumber     = $_FILES['foto_diri']['tmp_name'];
  $target     =  '../foto/user/';
  $foto_diri = $_FILES["foto_diri"]["name"];
  $foto_diriup = $id_peserta . '_ft_' . $_FILES["foto_diri"]["name"];

  $sumber2     = $_FILES['tdi']['tmp_name'];
  $target2     =  '../foto/tdi/';
  $tdi  = $_FILES["tdi"]["name"];
  $tdiup    = $id_peserta . '_tdi_' . $_FILES["tdi"]["name"];

  $username = $_POST['username'];
  $password = $_POST['password'];
  $status = $_POST['status'];
  $id_periode = $_POST['id_periode'];

  if ($foto_diri == "" && $tdi == "") {
    $simpan = mysqli_query($CON, "UPDATE tb_pendaftaran SET id_peserta='$id_peserta', no_ktp='$no_ktp', nama_peserta='$nama_peserta', jekel='$jekel', alamat='$alamat', no_hp='$no_hp', nama_perusahaan='$nama_perusahaan', produk='$produk', id_jenispelatihan='$id_jenispelatihan', username='$username', password='$password', status='$status', id_periode='$id_periode'  WHERE id_peserta='$id'") or die(mysqli_error($CON));
  } elseif ($tdi == "") {
    $sql1 = mysqli_query($CON, "select * from tb_pendaftaran WHERE id_peserta='$id'") or die(mysqli_error($CON));
    $folder1 = mysqli_fetch_array($sql1);
    $tempat1 = $folder1['foto_diri'];
    $imagedelet1 = "../foto/user/$tempat1";
    unlink($imagedelet1);
    $pindah = move_uploaded_file($sumber, $target . $foto_diriup);
    $simpan = mysqli_query($CON, "UPDATE tb_pendaftaran SET id_peserta='$id_peserta', no_ktp='$no_ktp', nama_peserta='$nama_peserta', jekel='$jekel', alamat='$alamat', no_hp='$no_hp', nama_perusahaan='$nama_perusahaan', produk='$produk', id_jenispelatihan='$id_jenispelatihan', foto_diri='$foto_diriup', username='$username', password='$password', status='$status', id_periode='$id_periode'  WHERE id_peserta='$id'") or die(mysqli_error($CON));
  } elseif ($foto_diri == "") {
    $sql2 = mysqli_query($CON, "select * from tb_pendaftaran WHERE id_peserta='$id'") or die(mysqli_error($CON));
    $folder2 = mysqli_fetch_array($sql2);
    $tempat2 = $folder2['tdi'];
    $imagedelet2 = "../foto/tdi/$tempat2";
    unlink($imagedelet2);
    $pindah = move_uploaded_file($sumber2, $target2 . $tdiup);
    $simpan = mysqli_query($CON, "UPDATE tb_pendaftaran SET id_peserta='$id_peserta', no_ktp='$no_ktp', nama_peserta='$nama_peserta', jekel='$jekel', alamat='$alamat', no_hp='$no_hp', nama_perusahaan='$nama_perusahaan', produk='$produk', id_jenispelatihan='$id_jenispelatihan', tdi='$tdiup', username='$username', password='$password', status='$status', id_periode='$id_periode'  WHERE id_peserta='$id'") or die(mysqli_error($CON));
  } else {
    $sql3 = mysqli_query($CON, "select * from tb_pendaftaran WHERE id_peserta='$id'") or die(mysqli_error($CON));

    $folder1 = mysqli_fetch_array($sql3);
    $tempat1 = $folder1['foto_diri'];
    $imagedelet1 = "../foto/user/$tempat1";
    unlink($imagedelet1);
    $pindah1 = move_uploaded_file($sumber, $target . $foto_diriup);

    $tempat2 = $folder1['tdi'];
    $imagedelet2 = "../foto/tdi/$tempat2";
    unlink($imagedelet2);
    $pindah2 = move_uploaded_file($sumber2, $target2 . $tdiup);
    $simpan = mysqli_query($CON, "UPDATE tb_pendaftaran SET id_peserta='$id_peserta', no_ktp='$no_ktp', nama_peserta='$nama_peserta', jekel='$jekel', alamat='$alamat', no_hp='$no_hp', nama_perusahaan='$nama_perusahaan', produk='$produk', id_jenispelatihan='$id_jenispelatihan', foto_diri='$foto_diriup', tdi='$tdiup', username='$username', password='$password', status='$status', id_periode='$id_periode'  WHERE id_peserta='$id'") or die(mysqli_error($CON));
  }

  if ($simpan) {
    echo "<div class='alert alert-success'>
                <a href='?page=data_pesertacalon' class='close' data-dismiss='alert'>
                &times;
                </a> Edit Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_pesertacalon'>";
  } else {
    echo "<div class='alert alert-success'>
                <a href='?page=data_pesertacalon' class='close' data-dismiss='alert'>
                &times;
                </a> Edit Data Gagal
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_pesertacalon'>";
  }
}
?>
<div class="right_col" role="main">
  <section class="content-header">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3> Data Calon Peserta</h3>
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
                  <label for="inputPassword3" class="col-sm-2 control-label">No. Telepon </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="no_hp" placeholder="Nomer Telepon" value="<?php echo $data['no_hp']; ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Nama Perusahaan Anda</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_perusahaan" placeholder="nama perusahaan anda" value="<?php echo $data['nama_perusahaan']; ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Produk anda</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="produk" placeholder="produk yang anda hasilkan" value="<?php echo $data['produk']; ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Pelatihan</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="id_jenispelatihan" value="<?php echo $data['nama_pelatihan']; ?>">
                      <option><?php echo $data['nama_pelatihan']; ?></option>
                      <?php
                      $s_nama_pelatihan = mysqli_query($CON, "SELECT * FROM tb_jenispelatihan") or die(mysqli_error($CON));
                      while ($h_nama_pelatihan = mysqli_fetch_array($s_nama_pelatihan)) {
                        if ($data[id_jenispelatihan] == $h_nama_pelatihan[id_jenispelatihan]) {
                          echo "<option value='$h_nama_pelatihan[id_jenispelatihan]' selected='$data[id_jenispelatihan]'>$h_nama_pelatihan[nama_pelatihan]</option>";
                        } else {
                          echo "<option value='$h_nama_pelatihan[id_jenispelatihan]'>$h_nama_pelatihan[nama_pelatihan]</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="input" class="col-sm-2 control-label">Foto Anda</label>
                  <div class="col-sm-10">
                    <input type="file" name="foto_diri">
                    <br>
                    <label><?php echo $data['foto_diri'] ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="input" class="col-sm-2 control-label">Scan tdi</label>
                  <div class="col-sm-10">
                    <input type="file" name="tdi">
                    <br>
                    <label><?php echo $data['tdi'] ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Username</label>
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
                <a href="?page=data_pesertacalon" class="btn btn-default">Batal</a>
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