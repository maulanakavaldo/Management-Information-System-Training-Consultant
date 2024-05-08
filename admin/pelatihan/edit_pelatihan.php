<?php
$id = $_GET['id'];
$query = mysqli_query($CON, "SELECT * from tb_pelatihan where id_pelatihan = '" . $id . "'");
$data = mysqli_fetch_array($query);



if (isset($_POST['simpan'])) {
  $nama_pelatihan = $_POST['nama_plt'];
  $id_bidangplt = $_POST['bdgplt'];
  // $jadwal = $_POST['jadwal'];
  // $tgl_jadwal = date("Y-m-d", strtotime($jadwal));
  $tgl_mulai = $_POST['tgl_mulai'];
  $tgl_akhir = $_POST['tgl_akhir'];
  $tempat = $_POST['tempat'];
  // $kuota = $_POST['kuota'];
  $harga = $_POST['harga'];

  $simpan = mysqli_query($CON, "UPDATE tb_pelatihan SET nama_pelatihan='$nama_pelatihan', id_bidangplt='$id_bidangplt', tempat='$tempat', tgl_mulai='$tgl_mulai', tgl_akhir='$tgl_akhir', biaya=$harga WHERE id_pelatihan='$id'") or die(mysqli_error($CON));

  if ($simpan) {
    echo "<div class='right_col' role='main'>
    <div class='alert alert-success'>
                <a href='?page=data_daftarpelatihan' class='close' data-dismiss='alert'>
                &times;
                </a> Edit Data Berhasil
                </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_pelatihan'>";
  } else {
    echo "<div class='right_col' role='main'>
    <div class='alert alert-danger'>
                <a href='?page=data_daftarpelatihan' class='close' data-dismiss='alert'>
                &times;
                </a> Edit Data Gagal
                </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=#'>";
  }
}
?>
<div class="right_col" role="main">
  <section class="content-header">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Edit Pelatihan</h3>
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
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Nama Pelatihan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama_plt" value="<?php echo $data['nama_pelatihan']; ?>" placeholder="Nama Pelatihan ..." required>
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
                          <option value="<?php echo $row['id_bidangplt'] ?>" <?php echo $row['id_bidangplt'] == $data['id_bidangplt'] ? 'selected="selected"' : '' ?>><?php echo $row['nama_bidang'] ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Tempat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="tempat" value="<?php echo $data['tempat']; ?>" placeholder="Tempat" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Mulai</label>
                    <div class="col-sm-3">
                      <input type="date" class="form-control" name="tgl_mulai" value="<?php echo $data['tgl_mulai']; ?>" placeholder="" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Berakhir</label>
                    <div class="col-sm-3">
                      <input type="date" class="form-control" name="tgl_akhir" value="<?php echo $data['tgl_akhir']; ?>" placeholder="" required>
                    </div>
                  </div>
                  <!-- <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Kuota</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" name="kuota" value="" placeholder="Kuota" required>
                    </div>
                  </div> -->

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