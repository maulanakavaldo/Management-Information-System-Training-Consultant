<?php
if (isset($_POST['simpan']) and @$_POST['id_pembimbing'] and @$_POST['id_magang']) {
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
  $sql = "INSERT INTO tb_Magang VALUES('$hasilkode2','$_POST[id_magang]','$_POST[id_pembimbing]')";
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


?>
<section class="content-header">
  <h1>
    Tambah Magang
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
                  <option value="0" disabled="disabled" selected="selected">Pilih*</option>
                  <?php
                  $result = mysqli_query($CON, "SELECT tb_magang.id_pemagangan, tb_jenismagang.id_magang, tb_jenismagang.nama_magang, tb_jenismagang.tempat,tb_jenismagang.jadwal FROM `tb_jenismagang` left join tb_magang on tb_jenismagang.id_magang=tb_magang.id_magang");
                  while ($row = mysqli_fetch_array($result)) {
                    if (is_null($row['id_pemagangan'])) {
                      echo '<option value="' . $row['id_magang'] . '" class="cari_id_magang_' . $row['id_magang'] . '" tempat="' . $row['tempat'] . '" jadwal="' . $row['jadwal'] . '">' . $row['nama_magang'] . '</option>';
                    }
                  }
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Nama Pembimbing</label>
              <div class="col-sm-10">
                <select class="form-control pembimbing_free" name="id_pembimbing">
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