<?php
if (isset($_POST['simpan'])) {
  $id_psh = $_POST['id_psh'];
  $namapsh = $_POST['nama_perusahaan'];
  $tlp_kantor = $_POST['tlp_kantor'];
  $fax = $_POST['fax'];
  $alamat = $_POST['alamat'];
  $bidang_psh = $_POST['bidang_psh'];
  $rate = $_POST['rate'];
  $cro = $_POST['cro'];

  $sql = "INSERT INTO tb_perusahaan VALUES('$id_psh','$bidang_psh', '$namapsh', '$alamat', '$tlp_kantor','$fax','$rate','$cro')";
  $simpan = mysqli_query($CON, $sql) or die(mysqli_error($CON));
  if ($simpan) {
    echo "      
          <div class='right_col' role='main'>
          <div class='alert alert-success'>
          <a href='?page=data_perusahaan' class='close' data-dismiss=''>
          &times;
          </a> Simpan Data Berhasil
          </div>
          </div> ";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_perusahaan'>";
  } else {
    echo "
          <div class='right_col' role='main'>
          <div class='alert alert-warning'>
          <a href='?page=data_perusahaan' class='close' data-dismiss='alert'>
          &times;
          </a> Simpan Data Gagal
          </div>
          </div> ";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_perusahaan'>";
  }
}

$query = "select max(id_psh) from tb_perusahaan";
$sql = mysqli_query($CON, $query) or die(mysqli_error($CON));
$kode = mysqli_fetch_array($sql);
if ($kode) {
  $nilaikode = substr($kode[0], 2);
  $kodenya = (int) $nilaikode;
  $kodenya = $kodenya + 1;
  $hasilkode = "IP" . str_pad($kodenya, 4, "0", STR_PAD_LEFT);
} else {
  $hasilkode = "IP0001";
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
          <h3>Tambah Perusahaan</h3>
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
                    <label for="inputEmail3" class="col-sm-2 control-label">ID Perusahaan</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="id_psh" value="<?php echo $hasilkode ?>" readonly>
                    </div>
                  </div>




                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Nama Perusahaan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama_perusahaan" placeholder="Nama Perusahaan" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Telepon Kantor</label>
                    <div class="col-sm-10">
                      <input class="form-control" name="tlp_kantor" placeholder="Telepon Kantor" onkeypress="return hanyaAngka(event, false)">
                    </div>
                  </div>



                  <div class="form-group">
                    <label class="col-sm-2 control-label">Bidang Perusahaan</label>
                    <div class="col-sm-10">

                      <!-- <select class="selectpicker form-control" name="bidang_psh" data-live-search="true" required> -->
                      <select class="form-control select2 selectpicker" name="bidang_psh" data-live-search="true" required>
                        <option value=""></option>
                        <?php
                        //ambil dari db
                        $bd_psh = "select * from tb_bidangpsh order by id_bidangpsh";
                        $hasil = mysqli_query($CON, $bd_psh);
                        while ($data = mysqli_fetch_array($hasil)) {
                        ?>
                          <option value="<?php echo $data['id_bidangpsh'] ?>"><?php echo $data['nama_bidang'] ?></option>
                        <?php
                        }
                        ?>
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
                    <label for="inputPassword3" class="col-sm-2 control-label">Fax</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="fax" placeholder="Fax" onkeypress="return hanyaAngka(event, false)" maxlength="15">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Rate</label>
                    <div class="col-sm-5">
                      <select class="form-control" name="rate" required>
                        <option value="Low" aria-selected="true">Low</option>
                        <option value="Middle">Middle</option>
                        <option value="Higt">High</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">CRO</label>
                    <div class="col-sm-5">
                      <select class="form-control" name="cro" required>
                        <option value="">- Pilih -</option>
                        <option value="Wulan">Wulan</option>
                        <option value="Ela">Ela</option>
                        <option value="Devi">Devi</option>
                      </select>
                    </div>
                  </div>


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