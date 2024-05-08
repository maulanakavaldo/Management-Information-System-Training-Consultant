    <section class="content-header">
      <h1>
        Data Presensi Magang
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-television" class="active"></i> Data Magang</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Magang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>ID Magang</th>
                    <th>Nama Magang</th>
                    <th>Tempat</th>
                    <th>Jadwal</th>
                    <th>Nama Pembimbing</th>
                    <th>Jumlah Peserta</th>
                    <th style="text-align: center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = mysqli_query($CON, "SELECT *, COUNT(id_peserta) as jumlah FROM tb_pembimbing NATURAL join tb_magang NATURAL JOIN tb_jenismagang LEFT JOIN tb_pendaftaran on tb_pendaftaran.id_magang=tb_jenismagang.id_magang WHERE 1 GROUP by tb_jenismagang.id_magang");
                  $no = 1;
                  while ($data = mysqli_fetch_array($query)) {
                  ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $data['id_pemagangan']; ?></td>
                      <td><?php echo $data['nama_magang']; ?></td>
                      <td><?php echo $data['tempat']; ?></td>
                      <td><?php echo $data['jadwal']; ?></td>
                      <td><?php echo $data['nama_pembimbing']; ?></td>
                      <td><?php echo $data['jumlah']; ?></td>
                      <td align="center">
                        <a href="?page=tambah_presensi&id=<?php echo $data['id_magang']; ?>" class="btn btn-success"><span class="fa fa-building-o"></span> Kelola Presensi</a>
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