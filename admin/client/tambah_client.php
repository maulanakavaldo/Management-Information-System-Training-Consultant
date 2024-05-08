<?php
if (isset($_POST['simpan'])) {
  $id_client = $_POST['id_client'];
  $id_psh = $_POST['id_psh'];
  $nama = $_POST['nama'];
  $no_hp = $_POST['no_hp'];
  $email = $_POST['email'];
  $ext = $_POST['ext'];
  $jabatan = $_POST['jabatan'];

  $simpan = mysqli_query($CON, "INSERT INTO tb_client VALUES('$id_client','$id_psh','$nama','$no_hp','$email', '$ext','$jabatan')");

  // $simpan2 = mysqli_query($CON, "INSERT INTO tb_hubung VALUES ('$id_client','$jns_magang')") or die(mysqli_error($CON));

  if ($simpan) {
    echo "
    <div class='right_col' role='main'>
    <div class='alert alert-success'>
      <a href='?page=data_client' class='close' data-dismiss='alert'>
      &times;
      </a> Simpan Data Berhasil
      </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_client'>";
  } else {
    echo "
    <div class='right_col' role='main'>
    <div class='alert alert-warning'>
      <a href='?page=dataclientr' class='close' data-dismiss='alert'>
      &times;
      </a> Simpan Data Berhasil
      </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_client'>";
  }
}

$query = "select max(id_client) from tb_client";
$sql = mysqli_query($CON, $query) or die(mysqli_error($CON));
$kode = mysqli_fetch_array($sql);
if ($kode) {
  $nilaikode = substr($kode[0], 2);
  $kodenya = (int) $nilaikode;
  $kodenya = $kodenya + 1;
  $hasilkode = "IC" . str_pad($kodenya, 4, "0", STR_PAD_LEFT);
} else {
  $hasilkode = "IC0001";
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
          <h3> Tambah Client</h3>
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
                    <label for="inputEmail3" class="col-sm-2 control-label">ID Client</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="id_client" value="<?php echo $hasilkode ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">No. HP </label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="no_hp" placeholder="Nomer HP" onkeypress="return hanyaAngka(event, false)" maxlength="15">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="email" placeholder="johndoe@gmail.com" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Fax ext</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="ext" placeholder="Masukkan fax ext jika ada..." onkeypress="return hanyaAngka(event, false)" maxlength="8">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Jabatan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="jabatan" placeholder="">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Perusahaan</label>
                    <div class="col-sm-5">
                      <select class="selectpicker form-control" name="id_psh" data-live-search="true" required>
                        <option value=""></option>
                        <?php
                        // ambil data dari database
                        $query = "SELECT * FROM tb_perusahaan";
                        $hasil = mysqli_query($CON, $query);
                        while ($row = mysqli_fetch_array($hasil)) {
                        ?>
                          <option value="<?php echo $row['id_psh'] ?>"><?php echo $row['nama'] ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <!-- <div class="form-group">
                  <label class="col-sm-2 control-label">Jenis  Magang</label>
                  <div class="col-sm-5">
                    <select class="form-control" name="jns_magang">
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
                </div> -->

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