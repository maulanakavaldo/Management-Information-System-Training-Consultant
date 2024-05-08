<div class="right_col" role="main">
  <section class="content-header">

    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3> Laporan Perusahaan </h3>
        </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="col-xs-12">
        <div class="box-header with-border">
          <div class="x_panel">
            <div class="x_title">
              <h2>Silahkan Dicetak</h2>
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
              <form class="form-horizontal" method="post" action="laporan/laporan_perusahaan_pdf.php" target="_blank">
                <!-- /.box-body -->
                <div class="box-footer">
                  <input type="submit" class="btn btn-success" name="cetak" value="Cetak PDF">
                </div>
                <!-- /.box-footer -->
              </form>

              <table id="datatable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Fax</th>
                    <th>Alamat</th>
                    <th>Bidang</th>
                    <th style="text-align: center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = mysqli_query($CON, "SELECT tb_perusahaan.id_psh, tb_perusahaan.nama, tb_perusahaan.tlp_kantor, tb_perusahaan.fax,tb_perusahaan.alamat,tb_bidangpsh.nama_bidang FROM tb_perusahaan Inner JOIN tb_bidangpsh on tb_perusahaan.id_bidangpsh=tb_bidangpsh.id_bidangpsh order by nama");
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
          </div>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>