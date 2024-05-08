<div class="right_col" role="main">
  <section class="content-header">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3> Data Peserta </h3>
        </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="col-xs-12">
        <div class="box-header">
          <div class="x_panel">
            <div class="x_title">
              <h2>Data Peserta Ditolak</h2>
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

            <a href="?page=data_pesertacalon" class="btn bg-navy btn-flat margin"><span class="fa fa-mail-reply (alias)""></span> Data Calon Peserta</a>
              <br><br>
                <table id=" datatable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>ID Peserta</th>
                    <th>Nama Peserta</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Nama Perusahaan</th>
                    <th>Produk</th>
                    <th>Nama Pelatihan</th>
                    <th>Status</th>
                    <th>Tahun Periode</th>
                    <th>Foto Peserta</th>
                    <th>SCAN tdi</th>
                    <th style="text-align: center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = mysqli_query($CON, "SELECT * FROM tb_pendaftaran,tb_periode,tb_jenispelatihan WHERE tb_pendaftaran.id_jenispelatihan=tb_jenispelatihan.id_jenispelatihan and tb_pendaftaran.id_periode=tb_periode.id_periode and tb_pendaftaran.status='ditolak'");
                  $no = 1;
                  while ($data = mysqli_fetch_array($query)) {
                  ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $data['id_peserta']; ?></td>
                      <td><?php echo $data['nama_peserta']; ?></td>
                      <td><?php echo $data['alamat']; ?></td>
                      <td><?php echo $data['no_hp']; ?></td>
                      <td><?php echo $data['nama_perusahaan']; ?></td>
                      <td><?php echo $data['produk']; ?></td>
                      <td><?php echo $data['nama_pelatihan']; ?></td>
                      <td><?php echo $data['status']; ?></td>
                      <td><?php echo $data['tahun']; ?></td>

                      <td><a target=_blank" href="../foto/user/<?php echo $data['foto_diri']; ?>"><img src="../foto/user/<?php echo $data['foto_diri']; ?>" class="img-responsive" style="width: 80px;"></td>
                      <td><a target=_blank" href="../foto/tdi/<?php echo $data['tdi']; ?>"><img src="../foto/tdi/<?php echo $data['tdi']; ?>" class="img-responsive" style="width: 80px;"></td>

                      <td align="center">
                        <a href="?page=data_pesertadetail&id=<?php echo $data['id_peserta']; ?>" class="btn btn-warning"><span class="fa fa-hospital-o"></span> Detail</a>
                        <a href="?page=edit_pesertaditolak&id=<?php echo $data['id_peserta']; ?>" class="btn btn-info"><span class="fa fa-pencil"></span> Edit</a>
                        <a href="?page=hapus_peserta&id=<?php echo $data['id_peserta']; ?>&idm=<?php echo $data['id_jenispelatihan']; ?>" class="btn btn-danger" onclick="return confirm('Hapus Data Ini?');"><span class="fa fa-trash-o"></span> Hapus</a>

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