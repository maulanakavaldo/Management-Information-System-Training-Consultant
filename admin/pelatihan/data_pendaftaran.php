<div class="right_col" role="main">
  <section class="content">

    <div class="">
      <div class="page-title">
        <!-- <div class="title_left">
              <h3>Data Perusahaan</h3>
            </div> -->

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box-header">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Data Pendaftaran</h2>
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

                  <!-- Pencarian -->



                  <!-- <div class="row">
                    <form method="post">
                      <div class="col-xs-3">
                        <div class="form-group">
                          <select class="form-control" name="rate">
                            <option>- Rate -</option>
                            <option value="Low">Low</option>
                            <option value="Middle">Middle</option>
                            <option value="High">High</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-3">
                        <div class="form-group">
                          <input type="submit" name="btncari" value="Search" class="btn btn-info">
                        </div>
                      </div>
                    </form> 
                  </div> -->

                  <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                      <tr style="text-align: center;">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Pelatihan</th>
                        <th>Jadwal</th>
                        <th>Tempat</th>
                        <th>Jumlah</th>
                        <th>Biaya</th>
                        <th>Bukti Bayar</th>
                        <th>Status Bayar</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      // if ($rate = 'Semua') {

                      // $query = mysqli_query($CON, "SELECT tb_user.nama, tb_pelatihan.nama_pelatihan, tb_pelatihan.tgl_mulai, tb_pelatihan.tgl_akhir, tb_pelatihan.tempat, tb_pendaftaran.jmlh_peserta  FROM tb_user Inner JOIN tb_pendaftaran on tb_user.id_user=tb_pendaftaran.id_user inner join tb_pelatihan on tb_pendaftaran.id_pelatihan=tb_pelatihan.id_pelatihan");
                      $query = mysqli_query($CON, "SELECT * FROM tb_user Inner JOIN tb_pendaftaran on tb_user.id_user=tb_pendaftaran.id_user inner join tb_pelatihan on tb_pendaftaran.id_pelatihan=tb_pelatihan.id_pelatihan inner join tb_status on tb_pendaftaran.id_pendaftaran = tb_status.id_pendaftaran");
                      // $query = mysqli_query($CON, "SELECT * FROM tb_pendaftaran");

                      // } else {
                      // $query = mysqli_query($CON, "SELECT tb_perusahaan.id_psh, tb_perusahaan.nama, tb_perusahaan.tlp_kantor, tb_perusahaan.fax,tb_perusahaan.alamat,tb_perusahaan.rate, tb_bidangpsh.nama_bidang FROM tb_perusahaan Inner JOIN tb_bidangpsh on tb_perusahaan.id_bidangpsh=tb_bidangpsh.id_bidangpsh where rate ='$rate'order by id_psh ASC ");
                      // }

                      $no = 1;
                      while ($data = mysqli_fetch_array($query)) {
                      ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $data['nama']; ?></td>
                          <td><?php echo $data['nama_pelatihan']; ?></td>
                          <td><?php echo $data['tgl_mulai']; ?> s.d <?php echo $data['tgl_akhir']; ?></td>
                          <td><?php echo $data['tempat']; ?></td>
                          <td><?php echo $data['jmlh_peserta']; ?></td>
                          <td><?php echo $data['biaya'] * $data['jmlh_peserta']; ?></td>
                          <td style="height:50px;width:30px">
                            <?php
                            if ($data['bukti'] != "") {
                              echo "<a target='_blank' href='../foto/bukti_bayar/" . $data['bukti'] . "'><img src='../foto/bukti_bayar/" .  $data['bukti'] . "' class='img-responsive'>";
                            } else {
                              echo "";
                            }
                            ?>
                          </td>


                          <td><?php
                              if ($data['status'] == 'Sudah Bayar') {
                                echo "<span class='btn btn-success btn-xs'>" . $data['status'] . "</span>";
                              } else {
                                echo "<span class='btn btn-danger btn-xs'>" . $data['status'] . "</span>";
                              }
                              ?>
                          </td>

                          <td style=" text-align: center; width:'auto-width'">
                            <!-- <a href="?page=edit_pendaftaran&id=<?php echo $data['id_plt']; ?>" class="btn btn-warning fa fa-pencil"></a> -->
                            <a href="?page=acc_pendaftaran&id=<?php echo $data['id_pendaftaran']; ?>" class="btn btn-success btn-xs" onclick="return confirm('ACC Pendaftaran Ini?');"><span>ACC</span></a>
                            <a href="?page=hapus_pendaftaran&id=<?php echo $data['id_plt']; ?>" class="btn btn-danger fa fa-trash-o" onclick="return confirm('Hapus Data Ini?');"></a>
                          </td>
                        </tr>
                      <?php
                        $no++;
                      }
                      ?>
                  </table>
                </div>

                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
  </section>