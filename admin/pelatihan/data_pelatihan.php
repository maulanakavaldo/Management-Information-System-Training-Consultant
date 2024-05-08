    <div class="right_col" role="main">
      <section class="content">

        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Data Pelatihan</h3>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box-header">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Data Pelatihan</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                    </div>
                    <!-- /.box-header -->
                    <a href="?page=tambah_pelatihan" class="btn btn-primary"><span class="fa fa-plus-square"></span> Tambah Data</a>
                    <br><br>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Pelatihan</th>
                          <th>Bidang Pelatihan</th>
                          <th>Tempat</th>
                          <th>Jadwal</th>
                          <!-- <th>Kuota</th> -->
                          <th>Harga</th>
                          <th style="text-align: center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        // $tampilkan = "SELECT tb_bidangplt.id_bidangplt, tb_pelatihan.id_pelatihan, tb_bidangplt.nama_pelatihan, tb_pelatihan.tempat, tb_pelatihan.jadwal, tb_pelatihan.kuota, tb_perusahaan.nama_pendamping from tb_bidangplt inner join tb_pelatihan on tb_bidangplt.id_bidangplt=tb_pelatihan.id_bidangplt inner join tb_perusahaan on tb_perusahaan.id_psh=tb_pelatihan.id_psh order by id_pelatihan ASC";
                        $tampilkan = "SELECT * from tb_bidangplt inner join tb_pelatihan on tb_bidangplt.id_bidangplt=tb_pelatihan.id_bidangplt order by id_pelatihan ASC";
                        $no = 1;
                        $query = mysqli_query($CON, $tampilkan);
                        if ($query === FALSE) {
                          die(mysqli_error($CON));
                        }
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data['nama_pelatihan']; ?></td>
                            <td><?php echo $data['nama_bidang']; ?></td>
                            <td><?php echo $data['tempat']; ?></td>
                            <td><?php echo $data['tgl_mulai']; ?> s.d <?php echo $data['tgl_akhir']; ?></td>
                            <!-- <td><?php echo $data['kuota']; ?></td> -->
                            <td>Rp. <?php echo $data['biaya']; ?></td>
                            <td align="center">
                              <a href="?page=edit_pelatihan&id=<?php echo $data['id_pelatihan']; ?>" class="btn btn-warning fa fa-pencil"></a>
                              <a href="?page=hapus_pelatihan&id=<?php echo $data['id_pelatihan']; ?>" class="btn btn-danger fa fa-trash-o" onclick="return confirm('Hapus Data Ini?');"></a>
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
              <!-- /.col -->
            </div>
            <!-- /.row -->
      </section>