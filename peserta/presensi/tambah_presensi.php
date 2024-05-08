<?php
if (isset($_POST['simpan']) and @$_POST['presensi'] and @$_POST['id_pemagangan']) {
  $query = "DELETE FROM tb_presensi WHERE id_pemagangan='" . addslashes($_POST['id_pemagangan']) . "' and tgl='" . date('Y-m-d') . "'";
  $query_hapus = mysqli_query($CON, $query) or die(mysqli_error($CON));

  $simpan = 0;

  foreach ($_POST['presensi'] as $key => $value) {
    $peserta = explode('|', $value);
    $sql = "INSERT INTO tb_presensi VALUES('','$_POST[id_pemagangan]','" . date('Y-m-d') . "','$peserta[0]')";
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

    echo "<meta http-equiv='refresh' content='1; url=?page=tambah_presensi&id=" . @$_GET['id'] . "'";
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
      Kelola Presensi Magang <?php echo $nama_magang; ?>
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
            <h3 class="box-title">Tambah Presensi</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal" method="post">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Nama Pembimbing</label>
                <div class="col-sm-10">
                  <input type="hidden" name="id_pemagangan" value="<?php echo $id_pemagangan; ?>">
                  <input type="text" name="" id="input" class="form-control" value="<?php echo $nama_pembimbing; ?>" readonly="readonly" required="required" pattern="" title="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-10">
                  <select name="" id="input" class="form-control" required="required" readonly="readonly">
                    <option value=""><?php echo date('d M Y'); ?></option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Peserta</label>
                <div class="col-sm-10">
                  <div class="checkbox">
                    <?php
                    $s_pembimbing = mysqli_query($CON, "SELECT * FROM tb_pendaftaran natural join tb_Magang where id_magang = '" . addslashes($_GET['id']) . "'") or die(mysqli_error($CON));
                    while ($data = mysqli_fetch_array($s_pembimbing)) {
                    ?>
                      <div class="row" style="padding-left: 20px">
                        <label>
                          <input type="checkbox" name="presensi[]" value="<?php echo $data['id_peserta'] . '|' . $data['id_pemagangan']; ?>" checked="checked">
                          <?php echo $data['id_peserta'] . ' | ' . $data['no_ktp'] . ' | ' . $data['nama_peserta']; ?>
                        </label>
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <a href="?page=data_presensi" class="btn btn-default">Kembali</a>
              <button type="submit" class="btn btn-info pull-right" name="simpan">Simpan</button>
            </div>
            <!-- /.box-footer -->
          </form>
          <div class="text-center">
            <h4>Daftar Presensi</h4>
          </div>
          <?php
          $tgl_presensi = array();
          $s_pre = mysqli_query($CON, "SELECT date_format(tgl,'%d') as hari, date_format(tgl,'%M') as bulan, date_format(tgl,'%Y') as tahun, GROUP_concat(id_peserta) as peserta FROM tb_presensi natural join tb_magang natural join tb_jenismagang WHERE id_magang='" . addslashes(@$_GET['id']) . "' GROUP by tgl") or die(mysqli_error($CON));
          while ($h_pre = mysqli_fetch_array($s_pre)) {
            $list_peserta = array();
            foreach (explode(',', $h_pre['peserta']) as $key => $value) {
              $list_peserta[$value] = 1;
            }
            $tgl_presensi[$h_pre['tahun']][$h_pre['bulan']][$h_pre['hari']] = $list_peserta;
          }
          $r_tb_header = array(
            'tahun' => '',
            'bulan' => '',
            'hari' => ''
          );
          foreach ($tgl_presensi as $key => $value) {
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
                  <?php echo $r_tb_header['tahun']; ?>
                </tr>
                <tr>
                  <?php echo $r_tb_header['bulan']; ?>
                </tr>
                <tr>
                  <?php echo $r_tb_header['hari']; ?>
                </tr>
                <tr>
                </tr>
              </thead>
              <tbody class="tampil_daftar_peserta">
                <?php
                $s_pembimbing = mysqli_query($CON, "SELECT * FROM tb_pendaftaran natural join tb_magang where id_magang = '" . addslashes($_GET['id']) . "'") or die(mysqli_error($CON));
                while ($data = mysqli_fetch_array($s_pembimbing)) {
                ?>
                  <tr>
                    <td><?php echo $data['id_peserta']; ?></td>
                    <td><?php echo $data['no_ktp']; ?></td>
                    <td><?php echo $data['nama_peserta']; ?></td>
                    <?php
                    foreach ($tgl_presensi as $key => $value) {
                      foreach ($value as $key1 => $value1) {
                        foreach ($value1 as $key2 => $value2) {
                          $is_masuk = (array_key_exists($data['id_peserta'], $value2)) ? 'v' : '-';
                          echo '<td class="text-center">' . $is_masuk . '</td>';
                        }
                      }
                    }
                    ?>
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