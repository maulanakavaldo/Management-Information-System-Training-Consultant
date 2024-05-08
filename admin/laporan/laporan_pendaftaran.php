<div class="right_col" role="main">
  <section class="content-header">

    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3> Laporan Pendaftaran </h3>
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
              <form class="form-horizontal" method="post" action="laporan/laporan_pendaftaran_pdf.php" target="_blank">
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
                    <th>Pelatihan</th>
                    <th>Jadwal</th>
                    <th>Tempat</th>
                    <th>Jumlah</th>
                    <th>Biaya</th>
                    <th>Status Bayar</th>
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
                      <td>
                        <center><?php echo $data['status'];  ?></center>
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