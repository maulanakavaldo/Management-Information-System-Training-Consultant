<section class="content-header">
  <h1>
    Data Penilaian
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-television" class="active"></i> Data Penilaian</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Penilaian</h3>
        </div>
        <!-- /.box-header -->
        <!-- <a href="?page=tambah_penilaian" class="btn btn-success"><span class="fa fa-plus-square"></span> Tambah Data</a> -->

        <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>ID Magang</th>
                <th>Nama Magang</th>
                <th>Nama Pemilik industri</th>
                <th style="text-align: center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = mysqli_query($CON, "SELECT *, COUNT(id_peserta) as jumlah FROM tb_user NATURAL join tb_magang NATURAL JOIN tb_jenismagang LEFT JOIN tb_pendaftaran on tb_pendaftaran.id_magang=tb_jenismagang.id_magang WHERE 1 GROUP by tb_jenismagang.id_magang");
              $no = 1;
              while ($data = mysqli_fetch_array($query)) {

              ?>

                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['id_magang']; ?></td>
                  <td><?php echo $data['nama_magang']; ?></td>
                  <td><?php echo $data['nama']; ?></td>
                  <td align="center">
                    <a href="?page=tambah_penilaian&id=<?php echo $data['id_magang']; ?>" class="btn bg-navy btn-flat margin"><span class="fa fa-pencil"></span> Kelola Penilaian</a>

                    <a href="?page=hasil_penilaian&id=<?php echo $data['id_magang']; ?>" class="btn btn-success"><span class="fa fa-suitcase"></span> Hasil Penilaian</a>
                    <!-- <a href="?page=hapus_penilaian&id=<?php echo $data['id_penilaian']; ?>" class="btn btn-danger" onclick="return confirm('Hapus Data Ini?');"><span class="fa fa-trash-o"></span> Hapus</a> -->
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