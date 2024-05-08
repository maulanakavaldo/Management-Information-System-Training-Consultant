    <div class="right_col" role="main">
      <section class="content">

        <div class="">
          <div class="page-title">
            <!-- <div class="title_left">
              <h3>Data Client</h3>
            </div> -->

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box-header">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Data Client</h2>
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
                      <!--<a href="?page=tambah_user" class="btn btn-success"><span class="fa fa-plus-square"></span> Tambah Data</a>-->
                      <a href="?page=tambah_client" class="btn btn-primary"><span class="fa fa-plus-square"></span> Tambah Data</a>

                      <a href="?page=data_client" class="btn fa fa-home"></a>
                      <a href="?page=data_client_cro1" class="btn"><span class=""></span> Wulan</a>
                      <a href="?page=data_client_cro2" class="btn"><span class=""></span> Ela</a>
                      <a href="?page=data_client_cro3" class="btn"><span class=""></span> Devi</a>
                      <br><br>
                      <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Perusahaan</th>
                            <th>Nama</th>
                            <th>Alamat Perusahaan</th>
                            <th>No HP</th>
                            <th>email</th>
                            <th>Telepon Kantor</th>
                            <th>ext</th>
                            <th>Jabatan</th>
                            <th>Bidang Perusahaan</th>
                            <!-- <th>CRO</th> -->
                            <th style="text-align:center; width:max-content">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query = mysqli_query($CON, "SELECT * FROM tb_client INNER JOIN tb_perusahaan ON tb_client.id_psh=tb_perusahaan.id_psh inner join tb_bidangpsh on tb_perusahaan.id_bidangpsh=tb_bidangpsh.id_bidangpsh;");
                          $no = 1;
                          while ($data = mysqli_fetch_array($query)) {
                          ?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo $data['nama']; ?></td>
                              <td><?php echo $data['nama_client']; ?></td>
                              <td><?php echo $data['alamat']; ?></td>
                              <td><?php echo $data['no_hp']; ?></td>
                              <td><?php echo $data['email']; ?></td>
                              <td><?php echo $data['tlp_kantor']; ?></td>
                              <td><?php echo $data['ext']; ?></td>
                              <td><?php echo $data['jabatan']; ?></td>
                              <td><?php echo $data['nama_bidang']; ?></td>
                              <!-- <td><?php echo $data['cro']; ?></td> -->
                              <td style=" text-align:center; width:max-content">
                                <a href="?page=edit_client&id=<?php echo $data['id_client']; ?>" class="btn btn-warning fa fa-pencil"></a>
                                <a href="?page=hapus_client&id=<?php echo $data['id_client']; ?>" class="btn btn-danger fa fa-trash-o" onclick="return confirm('Hapus Data Ini?');"></a>
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

          </div>
        </div>

      </section>