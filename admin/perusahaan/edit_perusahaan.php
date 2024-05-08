<?php
$id = $_GET['id'];

$sql = "SELECT * FROM tb_perusahaan inner join tb_bidangpsh on tb_perusahaan.id_bidangpsh=tb_bidangpsh.id_bidangpsh WHERE id_psh='" . addslashes($id) . "'";
$query = mysqli_query($CON, $sql) or die(mysqli_error($CON));
$data = mysqli_fetch_array($query);

if (isset($_POST['simpan'])) {
  $nama_perusahaan = $_POST['nama_perusahaan'];
  $tlp_kantor = $_POST['tlp_kantor'];
  $fax = $_POST['fax'];
  $alamat = $_POST['alamat'];
  $bidangpsh = $_POST['bidang_psh'];
  $rate = $_POST['rate'];
  $cro = $_POST['cro'];
  $simpan = mysqli_query($CON, "UPDATE tb_perusahaan SET id_bidangpsh='" . addslashes($bidangpsh) . "',nama='" . addslashes($nama_perusahaan) . "',tlp_kantor='$tlp_kantor', fax='$fax', alamat='$alamat', rate='$rate', cro='$cro' WHERE id_psh='$id'") or die(mysqli_error($CON));


  if ($simpan) {
    echo "
    <div class='right_col' role='main'>
    <div class='alert alert-success'>
                <a href='?page=data_perusahaan' class='close' data-dismiss='alert'>
                &times;
                </a> Edit Data Berhasil
                </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_perusahaan'>";
  } else {
    echo "
    <div class='right_col' role='main'>
    <div class='alert alert-success'>
                <a href='?page=data_perusahaan' class='close' data-dismiss='alert'>
                &times;
                </a> Edit Data Gagal
                </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_perusahaan'>";
  }
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
    if ((key == null) || (key == 0) || (key == 8) || (key == 9) || (key == 13) || (key == 27) || (key == " ")) {
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
          <h3>Edit Perusahaan</h3>
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
                  <label for="inputEmail3" class="col-sm-2 control-label">ID Perusahaan</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="id_psh" value="<?php echo $data['id_psh']; ?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Nama Perusahaan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_perusahaan" value="<?php echo $data['nama']; ?>" placeholder="Nama Perusahaan" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Telepon Kantor</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="tlp_kantor" placeholder="02xx xxx" value="<?php echo $data['tlp_kantor']; ?>" onkeypress="return hanyaAngka(event, false)">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Fax</label>
                  <div class="col-sm-10">
                    <input type="" class="form-control" name="fax" placeholder="Fax" value="<?php echo $data['fax']; ?>" onkeypress="return hanyaAngka(event, false)">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="alamat"><?php echo $data['alamat']; ?></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Bidang Perusahaan</label>
                  <div class="col-sm-10">
                    <select class="selectpicker form-control" name="bidang_psh" data-live-search="true" required>
                      <option value=""></option>
                      <?php
                      // ambil data dari database
                      $query = "SELECT * FROM tb_bidangpsh";
                      $hasil = mysqli_query($CON, $query);
                      while ($row = mysqli_fetch_array($hasil)) {
                      ?>
                        <option value="<?php echo $row['id_bidangpsh'] ?>" <?php echo $row['nama_bidang'] == $data['nama_bidang'] ? 'selected="selected"' : '' ?>><?php echo $row['nama_bidang'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Rate</label>
                  <div class="col-sm-5">
                    <select class="form-control" name="rate">
                      <?php
                      // ambil data dari database
                      $query = "SELECT * FROM tb_perusahaan where id_psh='$id'";
                      $hasil = mysqli_query($CON, $query);
                      while ($row = mysqli_fetch_array($hasil)) {
                        if ($row['rate'] == 'Low') {
                          echo '<option value="Low" selected="selected">Low</option>';
                          echo '<option value="Middle">Middle</option>';
                          echo '<option value="High">High</option>';
                        } else if ($row['rate'] == 'Middle') {
                          echo '<option value="Low">Low</option>';
                          echo '<option value="Middle" selected="selected">Middle</option>';
                          echo '<option value="High">High</option>';
                        } else {
                          echo '<option value="Low">Low</option>';
                          echo '<option value="Middle">Middle</option>';
                          echo '<option value="High" selected="selected">High</option>';
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">CRO</label>
                  <div class="col-sm-5">
                    <select class="form-control" name="cro" required>
                      <?php
                      // ambil data dari database
                      $query = "SELECT * FROM tb_perusahaan where id_psh='$id'";
                      $hasil = mysqli_query($CON, $query);
                      while ($row = mysqli_fetch_array($hasil)) {
                        if ($row['cro'] == 'Wulan') {
                          echo '<option value="Wulan" selected="selected">Wulan</option>';
                          echo '<option value="Ela">Ela</option>';
                          echo '<option value="Devi">Devi</option>';
                        } else if ($row['cro'] == 'Middle') {
                          echo '<option value="Wulan">Wulan</option>';
                          echo '<option value="Ela" selected="selected">Ela</option>';
                          echo '<option value="Devi">Devi</option>';
                        } else {
                          echo '<option value="Wulan">Wulan</option>';
                          echo '<option value="Ela">Ela</option>';
                          echo '<option value="Devi" selected="selected">Devi</option>';
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">No. Telepon </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="no_hp" placeholder="Nomer Telepon" onkeypress="return hanyaAngka(event, false)"" value=" <?php echo $data['no_hp']; ?>" maxlength="12" required>
                  </div>
                </div> -->


                <!-- /.box-body -->
                <div class="box-footer">
                  <a href="?page=data_perusahaan" class="btn btn-default">Batal</a>
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