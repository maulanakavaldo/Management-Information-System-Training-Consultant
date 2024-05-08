<section class="content-header">
  <h1>
    Data Jenis Magang
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-television" class="active"></i> Data Jenis Magang</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Jenis Magang</h3>
        </div>
        <!-- /.box-header -->
        <a href="?page=tambah_daftarmagang" class="btn btn-success"><span class="fa fa-plus-square"></span> Tambah Data</a>
        <br><br>
        <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>ID magang</th>
                <th>Nama Magang</th>
                <th>Tempat</th>
                <th>Jadwal</th>
                <th>Sisa Kuota</th>
                <th style="text-align: center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = mysqli_query($CON, "SELECT * FROM tb_jenismagang");
              $no = 1;
              while ($data = mysqli_fetch_array($query)) {
              ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['id_magang']; ?></td>
                  <td><?php echo $data['nama_magang']; ?></td>
                  <td><?php echo $data['tempat']; ?></td>
                  <td><?php echo $data['jadwal']; ?></td>
                  <td><?php echo $data['kuota']; ?></td>
                  <td align="center">
                    <a href="?page=edit_daftarmagang&id=<?php echo $data['id_magang']; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span> Edit</a>
                    <a href="?page=hapus_daftarmagang&id=<?php echo $data['id_magang']; ?>" class="btn btn-danger" onclick="return confirm('Hapus Data Ini?');"><span class="fa fa-trash-o"></span> Hapus</a>
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