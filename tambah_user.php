<?php
include "koneksi.php";

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
    $target     =  'foto/user/';
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



<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="foto/logo/icon_jsi.png" type="image/x-icon" />

  <title>Jogja Smart Indotama</title>
  <!-- select2 -->
  <!-- <link rel="stylesheet" href="dist/js/select2.min.css" /> -->

  <!-- Bootstrap -->
  <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="vendors/bootstrap/dist/css/select2.min.css">
    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap-select.css"> -->

  <!-- Bootstrap Select -->
  <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap-select.min.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css"> -->



  <!-- Font Awesome -->
  <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- NProgress -->
  <link rel="stylesheet" href="vendors/nprogress/nprogress.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="vendors/iCheck/skins/flat/green.css">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- bootstrap-progressbar -->
  <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <!-- JQVMap -->
  <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
  <!-- bootstrap-daterangepicker -->
  <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  <!-- Datatables -->
  <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">


        <!-- form start -->
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">ID User</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="id_user" value="" readonly>
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

            <!-- <div class="form-group">
                            <label class="col-sm-2 control-label">Jenis Pelatihan</label>
                            <div class="col-sm-5">
                              <select class="form-control" name="jns_pelatihan">
                                <option>Pilih</option>
                                <?php
                                $sql = mysqli_query($CON, "SELECT id_bidangpelatihan, nama_bidang FROM tb_bidangpelatihan ORDER BY nama_bidang") or die(mysqli_error($CON));
                                while ($dt_mg  = mysqli_fetch_array($sql)) {
                                ?>
                                  <option value="<?php echo $dt_mg['id_bidangpelatihan']; ?>"><?php echo $dt_mg['nama_bidang'] ?></option>
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
      <!-- </div> -->
      <!-- /.col -->

      <!-- footer content -->
      <footer>
        <div class="pull-right">
          <b>Jogja Smart Indotama </b> by <a href="">Copyright &copy; 2021</a>
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>

  <!-- Select Search -->
  <script src="bower_components/bootstrap/dist/js/jquery-3.2.1.min.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

  <script src="bower_components/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script> -->

  <script src="bower_components/bootstrap/dist/js/bootstrap-select.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script> -->


  <!-- jQuery -->
  <script src="vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- <script src="vendors/bootstrap/dist/js/jquery-2.1.4.min.js"></script> -->
  <!-- <script src="vendors/bootstrap/dist/js/select2.min.js"></script> -->

  <!-- FastClick -->
  <script src="vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="vendors/nprogress/nprogress.js"></script>
  <!-- Chart.js -->
  <script src="vendors/Chart.js/dist/Chart.min.js"></script>
  <!-- gauge.js -->
  <script src="vendors/gauge.js/dist/gauge.min.js"></script>
  <!-- bootstrap-progressbar -->
  <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
  <!-- iCheck -->
  <script src="vendors/iCheck/icheck.min.js"></script>
  <!-- Skycons -->
  <script src="vendors/skycons/skycons.js"></script>
  <!-- Flot -->
  <script src="vendors/Flot/jquery.flot.js"></script>
  <script src="vendors/Flot/jquery.flot.pie.js"></script>
  <script src="vendors/Flot/jquery.flot.time.js"></script>
  <script src="vendors/Flot/jquery.flot.stack.js"></script>
  <script src="vendors/Flot/jquery.flot.resize.js"></script>
  <!-- Flot plugins -->
  <!-- <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="vendors/flot.curvedlines/curvedLines.js"></script> -->

  <!-- /////////////// -->
  <!-- DateJS -->
  <script src="vendors/DateJS/build/date.js"></script>

  <!-- JQVMap -->
  <!-- <script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script> -->
  <!-- bootstrap-daterangepicker -->
  <script src="vendors/moment/min/moment.min.js"></script>
  <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- CK Editor -->
  <!-- <script src="ckeditor1/ckeditor.js"></script> -->
  <!-- Datatables -->
  <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
  <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
  <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
  <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
  <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
  <script src="vendors/jszip/dist/jszip.min.js"></script>
  <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
  <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
  <!-- Custom Theme Scripts -->
  <script src="build/js/custom.min.js"></script>



</body>

</html>