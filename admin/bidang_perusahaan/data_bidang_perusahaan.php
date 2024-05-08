    <div class="right_col" role="main">
      <section class="content">

        <div class="">
          <div class="page-title">
            <!-- <div class="title_left">
              <h3>Data Bidang Perusahaan</h3>
            </div> -->

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box-header">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Data Bidang Perusahaan</h2>
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

                      <a href="?page=tambah_bidang_perusahaan" class="btn btn-primary"><span class="fa fa-plus-square"></span> Tambah Data</a>
                      <br><br>
                      <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>ID Bidang</th>
                            <th>Nama Bidang</th>
                            <th style="text-align: center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query = mysqli_query($CON, "SELECT * from tb_bidangpsh");
                          $no = 1;
                          while ($data = mysqli_fetch_array($query)) {
                          ?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo $data['id_bidangpsh']; ?></td>
                              <td><?php echo $data['nama_bidang']; ?></td>

                              <td style=" text-align: center; width:'auto-width'">
                                <a href="?page=edit_bidang_perusahaan&id=<?php echo $data['id_bidangpsh']; ?>" class="btn btn-warning fa fa-pencil"></a>
                                <a href="?page=hapus_bidang_perusahaan&id=<?php echo $data['id_bidangpsh']; ?>" class="btn btn-danger fa fa-trash-o" onclick="return confirm('Hapus Data Ini?');"></a>
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