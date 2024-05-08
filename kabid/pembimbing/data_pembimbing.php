<section class="content-header">
  <h1>
    Data Pembimbing
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-television" class="active"></i> Data Pembimbing</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Pembimbing</h3>
        </div>
        <!-- /.box-header -->

        <a href="?page=tambah_pembimbing" class="btn btn-success"><span class="fa fa-plus-square"></span> Tambah Data</a>
        <br><br>
        <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>ID Pembimbing</th>
                <th>Nik</th>
                <th>Nama</th>
                <th>Jekel</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Foto</th>
                <th style="text-align: center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = mysqli_query($CON, "SELECT tb_pembimbing.id_pembimbing, tb_pembimbing.nik,tb_pembimbing.nama_pembimbing,tb_pembimbing.jekel,tb_pembimbing.alamat,tb_pembimbing.no_telp,tb_pembimbing.foto FROM tb_pembimbing");
              $no = 1;
              while ($data = mysqli_fetch_array($query)) {
              ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['id_pembimbing']; ?></td>
                  <td><?php echo $data['nik']; ?></td>
                  <td><?php echo $data['nama_pembimbing']; ?></td>
                  <td><?php echo $data['jekel']; ?></td>
                  <td><?php echo $data['alamat']; ?></td>
                  <td><?php echo $data['no_telp']; ?></td>
                  <td><img src="../foto/user/<?php echo $data['foto']; ?>" class="img-responsive" style="width: 80px;"></td>
                  <td align="center">
                    <a href="?page=edit_pembimbing&id=<?php echo $data['id_pembimbing']; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span> Edit</a>
                    <a href="?page=hapus_pembimbing&id=<?php echo $data['id_pembimbing']; ?>" class="btn btn-danger" onclick="return confirm('Hapus Data Ini?');"><span class="fa fa-trash-o"></span> Hapus</a>
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