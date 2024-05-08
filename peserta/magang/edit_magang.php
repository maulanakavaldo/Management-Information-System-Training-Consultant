<?php
if (isset($_POST['simpan']) and @$_POST['id_pembimbing'] and @$_POST['id_magang'] and @$_GET['id']) {

  $simpan = 0;
  $query = "select max(id_pemagangan) from tb_magang";
  $sql = mysqli_query($CON, $query) or die(mysqli_error($CON));
  $kode = mysqli_fetch_array($sql);
  if ($kode) {
    $nilaikode = substr($kode[0], 2);
    $kodenya = (int) $nilaikode;
    $hasilkode = $kodenya + 1;
  } else {
    $hasilkode = 1;
  }
  // pr($_POST);

  $hasilkode2 = 'MG' . str_pad($hasilkode, 4, "0", STR_PAD_LEFT);
  $hasilkode +=  1;
  // pr($hasilkode2);
  $sql = "UPDATE tb_magang SET id_pembimbing='$_POST[id_pembimbing]' WHERE id_magang='$_POST[id_magang]'";
  $out = mysqli_query($CON, $sql) or die(mysqli_error($CON));
  // pr($out);
  $simpan = 1;

  if ($simpan) {
    echo "<div class='alert alert-success'>
    <a href='?page=data_magang' class='close' data-dismiss='alert'>
    &times;
    </a> Simpan Data Berhasil
    </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_magang'>";
  } else {
    echo "<div class='alert alert-warning'>
    <a href='?page=data_magang' class='close' data-dismiss='alert'>
    &times;
    </a> Belum Ada Peserta
    </div>";
  }
}

if (@$_GET['id'] and @$_GET['nm']) {
?>
  <section class="content-header">
    <h1>
      Edit Magang
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-television" class="active"></i> Data Magang</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Silahkan isi data dengan benar</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal" method="post">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Nama Magang</label>
                <div class="col-sm-10">
                  <select class="form-control cari_id_magang" name="id_magang" id="id_magang" onchange="changeValue(this.value)">
                    <?php
                    $s_pembimbing = mysqli_query($CON, "SELECT id_pembimbing, nama_pembimbing,tempat,jadwal FROM tb_pembimbing NATURAL join tb_magang natural join tb_jenismagang WHERE id_magang='" . addslashes($_GET['id']) . "' GROUP by id_magang") or die(mysqli_error($CON));
                    while ($h_pembimbing = mysqli_fetch_array($s_pembimbing)) {
                      $id_pembimbing = $h_pembimbing['id_pembimbing'];
                      $nama_pembimbing = $h_pembimbing['nama_pembimbing'];
                      $tempat = $h_pembimbing['tempat'];
                      $jadwal = $h_pembimbing['jadwal'];
                    }
                    ?>
                    <option value="<?php echo $_GET['id']; ?>" class="cari_id_magang_<?php echo $_GET['id']; ?>" tempat="<?php echo $tempat; ?>" jadwal="<?php echo $jadwal; ?>"><?php echo $_GET['nm']; ?></option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Nama Pembimbing</label>
                <div class="col-sm-10">
                  <select class="form-control pembimbing_free" name="id_pembimbing">
                    <?php
                    echo "<option value='$id_pembimbing'>$nama_pembimbing</option>";
                    $s_pembimbing = mysqli_query($CON, "SELECT tb_pembimbing.id_pembimbing, tb_pembimbing.nama_pembimbing FROM `tb_pembimbing` left join tb_magang on tb_magang.id_pembimbing=tb_pembimbing.id_pembimbing left join tb_jenismagang on tb_jenismagang.id_magang=tb_magang.id_magang where tb_jenismagang.jadwal > '" . addslashes($_POST['post']) . "' + INTERVAL 1 day or tb_jenismagang.jadwal < '" . addslashes($_POST['post']) . "' - INTERVAL 1 day or tb_jenismagang.id_magang is null GROUP by tb_pembimbing.id_pembimbing") or die(mysqli_error($CON));
                    while ($h_pembimbing = mysqli_fetch_array($s_pembimbing)) {
                      echo "<option value='$h_pembimbing[id_pembimbing]'>$h_pembimbing[nama_pembimbing]</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Jadwal</label>
                <div class="col-sm-3">
                  <input type="date" class="form-control jadwal_tampil" name="jadwal" id="jadwal" placeholder="Jadwal" readonly>
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Tempat</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control tempat_tampil" name="tempat" id="tempat" placeholder="Tempat" readonly>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <a href="?page=data_magang" class="btn btn-default">Batal</a>
              <button type="submit" class="btn btn-info pull-right" name="simpan">Simpan</button>
            </div>
            <!-- /.box-footer -->
          </form>
          <div class="text-center">
            <h4>Daftar Peserta</h4>
          </div>
          <div class="table-responsive">
            <table class="table table-hover" id="example1" style="padding: 10px">
              <thead>
                <tr>
                  <th>ID Peserta</th>
                  <th>No KTP</th>
                  <th>Nama Peserta</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat</th>
                  <th>Usaha</th>
                  <th>Hasil Produk</th>
                  <th>No Telepon</th>
                  <th>File Foto Peserta</th>
                  <th>SCAN Surat Keterangan Desa</th>
                </tr>
              </thead>
              <tbody class="tampil_daftar_peserta">

              </tbody>
            </table>
          </div>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <script type="text/javascript">
    // function changeValue(id_keluar){ 
    // document.getElementById('tempat').value = dtKeluar[id_keluar].tempat; 
    // document.getElementById('jadwal').value = dtKeluar[id_keluar].jadwal; 
    // }; 
  </script>
<?php
}
?>