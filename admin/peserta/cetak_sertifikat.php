<div class="right_col" role="main">
  <section class="content-header">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3> Cetak Sertifikat </h3>
        </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box-header">
          <div class="x_panel">
            <div class="x_title">
              <h2>Cetak Sertifikat Peserta</h2>
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

            <!-- <a href="?page=tambah_peserta" class="btn btn-success"><span class="fa fa-plus-square"></span> Tambah Data</a>
              <br><br> -->

            <!-- =================================  Pencarian ==================================  -->
            <div class="row">
              <form method="post">
                <div class="col-xs-3">
                  <div class="form-group">
                    <select class="form-control" name="jns_pelatihan">
                      <option>Pilih*</option>
                      <?php
                      $q_jns = mysqli_query($CON, "SELECT * FROM tb_jenispelatihan ORDER BY nama_pelatihan") or die(mysqli_error($CON));
                      while ($dt_jns = mysqli_fetch_array($q_jns)) {
                      ?>
                        <option value="<?php echo $dt_jns['id_jenispelatihan'] ?>"><?php echo $dt_jns['nama_pelatihan'] ?></option>
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
                //================================= Query Pencarian ==================================
                if (isset($_POST['btncari'])) {
                  $query = mysqli_query($CON, "SELECT * FROM tb_pendaftaran,tb_periode,tb_jenispelatihan WHERE tb_pendaftaran.id_jenispelatihan=tb_jenispelatihan.id_jenispelatihan and tb_pendaftaran.id_periode=tb_periode.id_periode and (tb_pendaftaran.status='diterima' AND tb_jenispelatihan.id_jenispelatihan='" . $_POST['jns_pelatihan'] . "')");
                } else {
                  $query = mysqli_query($CON, "SELECT * FROM tb_pendaftaran,tb_periode,tb_jenispelatihan WHERE tb_pendaftaran.id_jenispelatihan=tb_jenispelatihan.id_jenispelatihan and tb_pendaftaran.id_periode=tb_periode.id_periode and tb_pendaftaran.status='diterima'");
                }
                //====================================================================================

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
                      <!-- <a href="?page=edit_peserta&id=<?php echo $data['id_peserta']; ?>" class="btn btn-info"><span class="fa fa-pencil"></span> Edit</a>
                    <a href="?page=hapus_peserta&id=<?php echo $data['id_peserta']; ?>&idm=<?php echo $data['id_jenispelatihan']; ?>" class="btn btn-danger" onclick="return confirm('Hapus Data Ini?');"><span class="fa fa-trash-o"></span> Hapus</a> -->

                      <form target="_blank" method="post" action="laporan/cetak_sertifikat.php">

                        <input type="hidden" name="id_peserta" value="<?php echo $data['id_peserta']; ?>">
                        <input type="hidden" name="id_jenispelatihan" value="<?php echo $data['nama_pelatihan']; ?>">
                        <input type="submit" name="cetak" class="btn btn-success" value="cetak">
                      </form>
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