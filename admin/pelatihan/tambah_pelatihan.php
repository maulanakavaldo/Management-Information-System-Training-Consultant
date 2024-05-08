<?php
if (isset($_POST['simpan'])) {
  $id_plt = $_POST['id_plt'];
  $nama_pelatihan = $_POST['nama_plt'];
  $tgl_mulai = $_POST['tgl_mulai'];
  $tgl_mulai = date("Y-m-d", strtotime($tgl_mulai));
  $bdg_plt = $_POST['bdgplt'];
  $tgl_akhir = $_POST['tgl_akhir'];
  $tempat = $_POST['tempat'];
  $kuota = $_POST['kuota'];
  $biaya = $_POST['harga'];

  $query = "INSERT INTO tb_pelatihan VALUES ('$id_plt', '$bdg_plt', '$nama_pelatihan', '$tempat', '$tgl_mulai', '$tgl_akhir', $kuota,$biaya)";
  $simpan = mysqli_query($CON, $query) or die(mysqli_error($CON));
  if ($simpan) {
    echo "<div class='right_col' role='main'><div class='alert alert-success'>
      <a href='?page=data_pelatihan' class='close' data-dismiss='alert'>
      &times;
      </a> Simpan Data Berhasil
      </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_pelatihan'>";
  } else {
    echo "<div class='right_col' role='main'><div class='alert alert-warning'>
      <a href='?page=data_pelatihan' class='close' data-dismiss='alert'>
      &times;
      </a> Simpan Data Berhasil
      </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_pelatihan'>";
  }
}

$query = "select max(id_pelatihan) from tb_pelatihan";
$sql = mysqli_query($CON, $query) or die(mysqli_error($CON));
$kode = mysqli_fetch_array($sql);
if ($kode) {
  $nilaikode = substr($kode[0], 2);
  $kodenya = (int) $nilaikode;
  $kodenya = $kodenya + 1;
  $hasilkode = "T" . str_pad($kodenya, 4, "0", STR_PAD_LEFT);
} else {
  $hasilkode = "T0001";
}
?>

<div class="right_col" role="main">
  <section class="content-header">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Tambah Pelatihan</h3>
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
              <form class="form-horizontal" method="post">
                <div class="box-body">

                  <div class="form-group" hidden>
                    <label for="inputPassword3" class="col-sm-2 control-label">ID Pelatihan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="id_plt" value="<?php echo $hasilkode ?>" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Nama Pelatihan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama_plt" value="" placeholder="Nama Pelatihan ..." required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Bidang Pelatihan</label>
                    <div class="col-sm-10">
                      <select class="selectpicker form-control" name="bdgplt" data-live-search="true" required>
                        <option value=""></option>
                        <?php
                        // ambil data dari database
                        $query = "SELECT * FROM tb_bidangplt";
                        $hasil = mysqli_query($CON, $query);
                        while ($row = mysqli_fetch_array($hasil)) {
                        ?>
                          <option value="<?php echo $row['id_bidangplt'] ?>"><?php echo $row['nama_bidang'] ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Tempat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="tempat" value="" placeholder="Tempat pelatihan" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Mulai</label>
                    <div class="col-sm-3">
                      <input type="date" class="form-control" name="tgl_mulai" value="" placeholder="" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Berakhir</label>
                    <div class="col-sm-3">
                      <input type="date" class="form-control" name="tgl_akhir" value="" placeholder="" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Kuota</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" name="kuota" value="<?php echo $data['kuota']; ?>" placeholder="Kuota" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Biaya</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" name="harga" value="<?php echo $data['biaya']; ?>" placeholder="Harga" required>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <a href="?page=data_pelatihan" class="btn btn-default">Batal</a>
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