<section class="content-header">
  <h1>
    Data User
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-television" class="active"></i> Data User</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data User</h3>
        </div>
        <!-- /.box-header -->
        <a href="?page=tambah_user" class="btn btn-success"><span class="fa fa-plus-square"></span> Tambah Data</a>
        <br><br>
        <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>ID User</th>
                <th>NIK</th>
                <th>NAMA</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Username</th>
                <th>Password</th>
                <th>Status</th>
                <th>Foto</th>
                <th style="text-align: center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = mysqli_query($CON, "SELECT * FROM tb_user");
              $no = 1;
              while ($data = mysqli_fetch_array($query)) {
              ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['id_user']; ?></td>
                  <td><?php echo $data['nik']; ?></td>
                  <td><?php echo $data['nama']; ?></td>
                  <td><?php echo $data['jekel']; ?></td>
                  <td><?php echo $data['alamat']; ?></td>
                  <td><?php echo $data['no_telp']; ?></td>
                  <td><?php echo $data['username']; ?></td>
                  <td><?php echo $data['password']; ?></td>
                  <td><?php echo $data['status']; ?></td>
                  <td><img src="../foto/user/<?php echo $data['foto']; ?>" class="img-responsive" style="width: 80px;"></td>
                  <td align="center">
                    <a href="?page=edit_user&id=<?php echo $data['id_user']; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span> Edit</a>
                    <a href="?page=hapus_user&id=<?php echo $data['id_user']; ?>" class="btn btn-danger" onclick="return confirm('Hapus Data Ini?');"><span class="fa fa-trash-o"></span> Hapus</a>
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