    <div class="right_col" role="main">
      <section class="content">

        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Data Peserta Ditolak</h3>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box-header">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Data Peserta Ditolak </h2>
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

                    <a href="?page=data_pesertacalon" class="btn btn-primary btn-flat margin"><span class="fa fa-mail-reply (alias)""></span> Data Calon Peserta</a>
              <br><br>

              <!-- =================================  Pencarian ==================================  -->
            <div class=" row">
                        <form method="post">
                          <div class="col-xs-3">
                            <div class="form-group">
                              <select class="form-control" name="jns_pelatihan">
                                <option>Pilih*</option>
                                <?php
                                $q_jns = mysqli_query($CON, "SELECT * FROM tb_jenispelatihan left join tb_pelatihan on tb_jenispelatihan.id_jenispelatihan=tb_pelatihan.id_jenispelatihan GROUP BY nama_pelatihan") or die(mysqli_error($CON));
                                while ($dt_jns = mysqli_fetch_array($q_jns)) {
                                ?>
                                  <option value="<?php echo $dt_jns['id_pelatihan']; ?>"><?php echo $dt_jns['nama_pelatihan'] ?></option>
                                <?php
                                }
                                ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-xs-3">
                            <div class="form-group">
                              <input type="submit" name="btncari" value="Search" class="btn btn-info">
                            </div>
                          </div>
                        </form>
                  </div>
                  <!-- =======================================================================================  -->
                  <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID Peserta</th>
                        <th>Nama Peserta</th>
                        <th>Alamat</th>
                        <th>Nama Perusahaan</th>
                        <th>Produk</th>
                        <th>Nama Pelatihan</th>
                        <th>Status</th>
                        <th>Tahun Periode</th>
                        <th>Foto Peserta</th>
                        <th>File TDI</th>
                        <th style="text-align: center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      //================================= Query Pencarian ==================================
                      if (isset($_POST['btncari'])) {
                        $tampilkan = "SELECT tb_pelatihan.id_pelatihan,tb_pendaftaran.id_peserta, tb_pendaftaran.nama_peserta, tb_pendaftaran.alamat, tb_pendaftaran.nama_perusahaan, tb_pendaftaran.produk, tb_jenispelatihan.nama_pelatihan, tb_pendaftaran.status, tb_periode.tahun, tb_pendaftaran.foto_diri, tb_pendaftaran.tdi from tb_pendaftaran inner join tb_pelatihan on tb_pelatihan.id_pelatihan=tb_pendaftaran.id_pelatihan inner join tb_jenispelatihan on tb_pelatihan.id_jenispelatihan=tb_jenispelatihan.id_jenispelatihan inner join tb_periode on tb_pendaftaran.id_periode=tb_periode.id_periode where tb_pendaftaran.status='ditolak' and tb_pendaftaran.id_pelatihan = '" . $_POST['jns_pelatihan'] . "'";
                        $query = mysqli_query($CON, $tampilkan);
                        $no = 1;
                        while ($data = mysqli_fetch_array($query)) {
                      ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data['id_peserta']; ?></td>
                            <td><?php echo $data['nama_peserta']; ?></td>
                            <td><?php echo $data['alamat']; ?></td>
                            <td><?php echo $data['nama_perusahaan']; ?></td>
                            <td><?php echo $data['produk']; ?></td>
                            <td><?php echo $data['nama_pelatihan']; ?></td>
                            <td><?php echo $data['status']; ?></td>
                            <td><?php echo $data['tahun']; ?></td>

                            <td><a target=_blank" href="../foto/user/<?php echo $data['foto_diri']; ?>"><img src="../foto/user/<?php echo $data['foto_diri']; ?>" class="img-responsive" style="width: 80px;"></td>
                            <td><a target=_blank" href="../foto/tdi/<?php echo $data['tdi']; ?>"><img src="../foto/tdi/<?php echo $data['tdi']; ?>" class="img-responsive" style="width: 80px;"></td>

                            <td align="center">
                              <a href="?page=data_pesertadetail&id=<?php echo $data['id_peserta']; ?>" class="btn btn-warning"><span class="fa fa-hospital-o"></span> Detail</a>
                              <a href="?page=edit_pesertacalon&id=<?php echo $data['id_peserta']; ?>" class="btn btn-info"><span class="fa fa-pencil"></span> Edit</a>
                              <a href="?page=hapus_peserta&id=<?php echo $data['id_peserta']; ?>&idm=<?php echo $data['id_pelatihan']; ?>" class="btn btn-danger" onclick="return confirm('Tolak Peserta Ini?');"><span class="fa fa-trash-o"></span> Hapus</a>

                            </td>
                          </tr>
                      <?php
                          $no++;
                        }
                      }
                      ?>
                  </table>
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
      </section>