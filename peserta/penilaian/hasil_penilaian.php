<?php
if (isset($_POST['simpan']) and @$_POST['penilaian'] and @$_POST['id_pemagangan']) {
  $query = "DELETE FROM tb_penilaian WHERE id_pemagangan='" . addslashes($_POST['id_pemagangan']) . "' and tgl='" . date('Y-m-d') . "'";
  $query_hapus = mysqli_query($CON, $query) or die(mysqli_error($CON));

  $simpan = 0;

  foreach ($_POST['penilaian'] as $key => $value) {
    $peserta = explode('|', $value);
    $sql = "INSERT INTO tb_penilaian VALUES('','$_POST[id_pemagangan]','" . date('Y-m-d') . "','$peserta[0]')";
    // pr($sql);
    $out = mysqli_query($CON, $sql) or die(mysqli_error($CON));
    // pr($out);
    $simpan = 1;
  }
  if ($simpan) {
    echo "<div class='alert alert-success'>
    <a href='?page=data_magang' class='close' data-dismiss='alert'>
    &times;
    </a> Simpan Data Berhasil
    </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=tambah_penilaian&id=" . @$_GET['id'] . "'";
  }
}

if (@$_GET['id']) {
  $s_pembimbing = mysqli_query($CON, "SELECT id_pembimbing, nama_pembimbing,tempat,jadwal,nama_magang,id_pemagangan FROM tb_pembimbing NATURAL join tb_magang natural join tb_jenismagang WHERE id_magang='" . addslashes($_GET['id']) . "' GROUP by id_magang") or die(mysqli_error($CON));
  while ($h_pembimbing = mysqli_fetch_array($s_pembimbing)) {
    $id_pembimbing = $h_pembimbing['id_pembimbing'];
    $nama_pembimbing = $h_pembimbing['nama_pembimbing'];
    $tempat = $h_pembimbing['tempat'];
    $jadwal = $h_pembimbing['jadwal'];
    $nama_magang = $h_pembimbing['nama_magang'];
    $id_pemagangan = $h_pembimbing['id_pemagangan'];
  }
?>
  <section class="content-header">
    <h1>
      Kelola Penilaian <?php echo $nama_magang; ?>
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
            <h3 class="box-title">Hasil Penilaian</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal" method="post">
            <div class="box-body">

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <a href="?page=data_penilaian" class="btn btn-default">Kembali</a>
              <button type="submit" class="btn btn-info pull-right" name="simpan">Simpan</button>
            </div>
            <!-- /.box-footer -->
          </form>
          <div class="text-center">
            <h4>Daftar Peserta</h4>
          </div>
          <?php
          $tgl_penilaian = array();
          $s_pre = mysqli_query($CON, "SELECT date_format(tgl,'%d') as hari, date_format(tgl,'%M') as bulan, date_format(tgl,'%Y') as tahun, GROUP_concat(id_peserta) as peserta FROM tb_presensi natural join tb_magang natural join tb_jenismagang WHERE id_magang='" . addslashes(@$_GET['id']) . "' GROUP by tgl") or die(mysqli_error($CON));
          while ($h_pre = mysqli_fetch_array($s_pre)) {
            $list_peserta = array();
            foreach (explode(',', $h_pre['peserta']) as $key => $value) {
              $list_peserta[$value] = 1;
            }
            $tgl_penilaian[$h_pre['tahun']][$h_pre['bulan']][$h_pre['hari']] = $list_peserta;
          }
          $r_tb_header = array(
            'tahun' => '',
            'bulan' => '',
            'hari' => ''
          );
          foreach ($tgl_penilaian as $key => $value) {
            $r_tahun = 0;
            foreach ($value as $key1 => $value1) {
              $r_bulan = 0;
              foreach ($value1 as $key2 => $value2) {
                $r_tahun++;
                $r_bulan++;
                $r_tb_header['hari'] .= '<th class="text-center">' . $key2 . '</th>';
              }
              $r_tb_header['bulan'] .= '<th class="text-center" colspan="' . $r_bulan . '">' . $key1 . '</th>';
            }
            $r_tb_header['tahun'] .= '<th class="text-center" colspan="' . $r_tahun . '">' . $key . '</th>';
          }
          // pr($tgl_presensi);
          // pr($r_tb_header);
          ?>
          <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped" style="padding: 10px">
              <thead>
                <tr>
                  <th style="vertical-align: middle; " class="text-center" rowspan="3">ID Peserta</th>
                  <th style="vertical-align: middle; " class="text-center" rowspan="3">No KTP</th>
                  <th style="vertical-align: middle; " class="text-center" rowspan="3">Nama Peserta</th>
                  <th style="vertical-align: middle; " class="text-center" rowspan="3">Absensi</th>
                  <th style="vertical-align: middle; " class="text-center" rowspan="3">Nilai Perusahaan</th>
                  <th style="vertical-align: middle; " class="text-center" rowspan="3">Nilai Akhir</th>
                  <th style="vertical-align: middle; " class="text-center" rowspan="3">Hasil Penilaian</th>
                </tr>
              </thead>
              <tbody class="tampil_daftar_peserta">
                <?php
                $s_pembimbing = mysqli_query($CON, "SELECT * FROM tb_pendaftaran A, tb_jenismagang B, tb_penilaian C WHERE A.id_magang=B.id_magang AND C.id_magang=B.id_magang AND C.id_peserta=A.id_peserta AND C.id_magang = '" . addslashes($_GET['id']) . "'") or die(mysqli_error($CON));
                while ($data = mysqli_fetch_array($s_pembimbing)) {
                ?>
                  <tr>
                    <td><?php echo $data['id_peserta']; ?></td>
                    <td><?php echo $data['no_ktp']; ?></td>
                    <td><?php echo $data['nama_peserta']; ?></td>
                    <td><?php echo $data['absensi']; ?></td>
                    <td><?php echo $data['nilai']; ?></td>
                    <td><?php echo $data['nilai_akhir']; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                  </tr>
                <?php
                }
                ?>
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
<?php
}
?>