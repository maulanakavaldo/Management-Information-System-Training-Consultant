<?php
if (isset($_POST['simpan'])) {
  if (@$_FILES['foto']['name']) {
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $jekel = $_POST['jekel'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_hp'];
    $status = $_POST['status'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $jns_pelatihan = $_POST['jns_pelatihan'];
    $sumber     = $_FILES['foto']['tmp_name'];
    $target     =  '../foto/user/';
    $nama_foto  = $id_user . '_' . $_FILES["foto"]["name"];

    $pindah     = move_uploaded_file($sumber, $target . $nama_foto);

    $simpan = mysqli_query($CON, "INSERT INTO tb_user VALUES('$id_user','$nama','$jekel','$alamat','$no_hp', '$username', '$password', '$nama_foto', '$status')");

    $simpan2 = mysqli_query($CON, "INSERT INTO tb_hubung VALUES ('$id_user','$jns_pelatihan')") or die(mysqli_error($CON));

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

<script language="javascript">
  function hanyaAngka(e, decimal) {
    var key;
    var keychar;
    if (window.event) {
      key = window.event.keyCode;
    } else
    if (e) {
      key = e.which;
    } else return true;

    keychar = String.fromCharCode(key);
    if ((key == null) || (key == 0) || (key == 8) || (key == 9) || (key == 13) || (key == 27)) {
      return true;
    } else
    if ((("0123456789").indexOf(keychar) > -1)) {
      return true;
    } else
    if (decimal && (keychar == ".")) {
      return true;
    } else return false;
  }
</script>
<div class="right_col" role="main">
  <section class="content-header">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3> Tambah User</h3>
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
            <div class="x_content">
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
                      <input type="text" class="form-control" name="no_hp" placeholder="Nomer Telepon" onkeypress="return hanyaAngka(event, false)" maxlength="12" required>
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
                        <!-- <option value="petugas">Petugas</option> -->
                        <option value="kadin">Kadin</option>
                        <option value="kabid">Kabid</option>
                        <!-- <option value="kabid">Kepala Bidang</option>
                      <option value="kadin">Kepala Dinas</option> -->
                        <!-- <option value="petugas">Petugas</option> -->
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Jenis Pelatihan</label>
                    <div class="col-sm-5">
                      <select class="form-control" name="jns_pelatihan">
                        <option>Pilih</option>
                        <?php
                        $sql = mysqli_query($CON, "SELECT id_jenispelatihan, nama_pelatihan FROM tb_jenispelatihan ORDER BY nama_pelatihan") or die(mysqli_error($CON));
                        while ($dt_mg  = mysqli_fetch_array($sql)) {
                        ?>
                          <option value="<?php echo $dt_mg['id_jenispelatihan']; ?>"><?php echo $dt_mg['nama_pelatihan'] ?></option>
                        <?php
                        }
                        ?>
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