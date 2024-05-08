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
                  <h2>Data Perusahaan</h2>
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

                  <a href="?page=tambah_perusahaan" class="btn btn-primary"><span class="fa fa-plus-square"></span> Tambah Data</a>

                  <br><br>
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
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Fax</th>
                        <th>Alamat</th>
                        <th>Bidang</th>
                        <!-- <th>Rate</th>
                        <th>CRO</th> -->
                        <th style="text-align: center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      // if ($rate = 'Semua') {
                      $query = mysqli_query($CON, "SELECT * FROM tb_perusahaan Inner JOIN tb_bidangpsh on tb_perusahaan.id_bidangpsh=tb_bidangpsh.id_bidangpsh order by id_psh ASC ");
                      // } else {
                      // $query = mysqli_query($CON, "SELECT tb_perusahaan.id_psh, tb_perusahaan.nama, tb_perusahaan.tlp_kantor, tb_perusahaan.fax,tb_perusahaan.alamat,tb_perusahaan.rate, tb_bidangpsh.nama_bidang FROM tb_perusahaan Inner JOIN tb_bidangpsh on tb_perusahaan.id_bidangpsh=tb_bidangpsh.id_bidangpsh where rate ='$rate'order by id_psh ASC ");
                      // }

                      $no = 1;
                      while ($data = mysqli_fetch_array($query)) {
                      ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $data['nama']; ?></td>
                          <td><?php echo $data['tlp_kantor']; ?></td>
                          <td><?php echo $data['fax']; ?></td>
                          <td><?php echo $data['alamat']; ?></td>
                          <td><?php echo $data['nama_bidang']; ?></td>
                          <!-- <td><?php echo $data['rate']; ?></td>
                          <td><?php echo $data['cro']; ?></td> -->

                          <td style=" text-align: center; width:'auto-width'">
                            <a href="?page=edit_perusahaan&id=<?php echo $data['id_psh']; ?>" class="btn btn-warning fa fa-pencil"></a>
                            <a href="?page=hapus_perusahaan&id=<?php echo $data['id_psh']; ?>" class="btn btn-danger fa fa-trash-o" onclick="return confirm('Hapus Data Ini?');"></a>
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