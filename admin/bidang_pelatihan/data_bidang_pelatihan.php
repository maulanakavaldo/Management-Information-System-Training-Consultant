    <div class="right_col" role="main">
      <section class="content">

        <div class="">
          <div class="page-title">

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box-header">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Data Bidang Pelatihan</h2>
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
                      <a href="?page=tambah_bidang_pelatihan" class="btn btn-primary"><span class="fa fa-plus-square"></span> Tambah Data</a>
                      <br><br>

                      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>ID </th>
                            <th>Nama Bidang</th>
                            <!--<th>Tempat</th>
                  <th>Jadwal</th>
                  <th>Sisa Kuota</th>-->
                            <th style="text-align: center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query = mysqli_query($CON, "SELECT * FROM tb_bidangplt order by id_bidangplt ASC");
                          $no = 1;
                          while ($data = mysqli_fetch_array($query)) {
                          ?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo $data['id_bidangplt']; ?></td>
                              <td><?php echo $data['nama_bidang']; ?></td>
                              <!--<td><?php echo $data['tempat']; ?></td>
                  <td><?php echo $data['jadwal']; ?></td>
                  <td><?php echo $data['kuota']; ?></td>-->
                              <td align="center">
                                <a href="?page=edit_bidang_pelatihan&id=<?php echo $data['id_bidangplt']; ?>" class="btn btn-warning fa fa-pencil"></a>
                                <a href="?page=hapus_bidang_pelatihan&id=<?php echo $data['id_bidangplt']; ?>" class="btn btn-danger fa fa-trash-o" onclick="return confirm('Hapus Data Ini?');"></a>
                              </td>
                            </tr>
                          <?php
                            $no++;
                          }
                          ?>
                      </table>
                    </div>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>

      </section>