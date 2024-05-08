    <div class="right_col" role="main">
      <section class="content">

        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Data Peserta</h3>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box-header">
                  <div class="x_panel">
                    <div class="x_title">
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                      </ul>
                      <h3>Data Peserta</h3>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>ID Peserta</th>
                            <th>Nama Peserta</th>
                            <th>Alamat</th>
                            <th>Jekel</th>
                            <th>Nama Pelatihan</th>
                            <th>Jumlah Pertemuan</th>
                            <th style="text-align: center">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $tampilkan = "SELECT tb_kehadiran.presensi, count(tb_kehadiran.id_peserta) as jumlah,tb_jenispelatihan.nama_pelatihan, tb_pendaftaran.id_peserta, tb_pendaftaran.nama_peserta, tb_pendaftaran.alamat, tb_pendaftaran.jekel, tb_pendaftaran.produk, tb_jenispelatihan.nama_pelatihan, tb_pendaftaran.status, tb_periode.tahun, tb_pendaftaran.foto_diri, tb_pendaftaran.tdi from tb_pendaftaran inner join tb_kehadiran on tb_pendaftaran.id_peserta=tb_kehadiran.id_peserta inner join tb_pelatihan on tb_pelatihan.id_pelatihan=tb_pendaftaran.id_pelatihan inner join tb_jenispelatihan on tb_pelatihan.id_jenispelatihan=tb_jenispelatihan.id_jenispelatihan inner join tb_periode on tb_pendaftaran.id_periode=tb_periode.id_periode where tb_kehadiran.presensi = 'masuk' group by id_peserta order by nama_pelatihan ASC";
                          $query = mysqli_query($CON, $tampilkan);
                          $no = 1;
                          while ($data = mysqli_fetch_array($query)) {
                          ?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo $data['id_peserta']; ?></td>
                              <td><?php echo $data['nama_peserta']; ?></td>
                              <td><?php echo $data['alamat']; ?></td>
                              <td><?php if ($data['jekel'] == 'L') {
                                    echo "Laki-Laki";
                                  } else {
                                    echo "Perempuan";
                                  } ?>
                              </td>
                              <td><?php echo $data['nama_pelatihan']; ?></td>
                              <td><?php echo $data['jumlah']; ?></td>
                              <td align="center">
                                <?php
                                if ($data['jumlah'] == 5) {
                                  if ($data['presensi'] == 'diterbitkan') {
                                    echo "<center>Sudah Diterbitkan</center>";
                                  } elseif ($data['presensi'] == 'tidak') {
                                    echo "Belum memenuhi syarat";
                                  } else {
                                    echo '<form method="post" action="laporan/cetak_sertifikat.php" target = "_blank">
                              <input type=hidden name = id value=' . $data['id_peserta'] . '>
                              <input type="submit" value="CETAK SERTIFIKAT" class="btn btn-info">
                            </div>
                          </form>';
                                  }
                                } else {
                                  echo "Tidak";
                                }
                                ?>
                              </td>
                            </tr>
                          <?php
                            $no++;
                          }
                          ?>
                      </table>
                    </div>
                    <!-- /.box -->
                  </div>
                  <!-- /.col -->
                </div>
              </div>
              <!-- /.row -->
      </section>