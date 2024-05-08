<?php
if (isset($_POST['simpan'])) {
  $id_pelatihan = $_POST['id_pelatihan'];
  $nama_pelatihan = $_POST['nama_pelatihan'];
  $tempat = $_POST['tempat'];
  $jadwal = $_POST['jadwal'];
  $nama_pendamping = $_POST['nama_pendamping'];

  $query = "INSERT INTO tb_pelatihan VALUES('$id_pelatihan','$nama_pelatihan','$tempat','$jadwal','$nama_pendamping')";

  $simpan = mysqli_query($CON, $query) or die(mysqli_error($CON));
  if ($simpan) {
    echo "<div class='alert alert-success'>
                <a href='?page=data_pelatihan' class='close' data-dismiss='alert'>
                &times;
                </a> Simpan Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_pelatihan'>";
  } else {
    echo "<div class='alert alert-warning'>
                <a href='?page=data_pelatihan' class='close' data-dismiss='alert'>
                &times;
                </a> Simpan Data Berhasil
                </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_pelatihan'>";
  }
}

$query = "select max(id_pelatihan) from tb_pelatihan";
$sql = mysqli_query($CON, $query) or die(mysqli_error($CON));
$kode = mysqli_fetch_array($sql);
if ($kode) {
  $nilaikode = substr($kode[0], 2);
  $kodenya = (int) $nilaikode;
  $kodenya = $kodenya + 1;
  $hasilkode = "MG" . str_pad($kodenya, 4, "0", STR_PAD_LEFT);
} else {
  $hasilkode = "MG0001";
}
?>
<div class="right_col" role="main">
  <section class="content-header">

    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3> Laporan Pelatihan </h3>
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

              <a href="?page=tambah_perusahaan" class="btn btn-primary"><span class="fa fa-plus-square"></span> Tambah Data</a>
              <br><br>
              <table id="datatable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>ID Perusahaan</th>
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
                  $query = mysqli_query($CON, "SELECT tb_perusahaan.id_psh, tb_perusahaan.nama, tb_perusahaan.tlp_kantor, tb_perusahaan.fax,tb_perusahaan.alamat,tb_bidangpsh.nama_bidang FROM tb_perusahaan Inner JOIN tb_bidangpsh on tb_perusahaan.id_bidangpsh=tb_bidangpsh.id_bidangpsh order by id_psh ASC ");
                  $no = 1;
                  while ($data = mysqli_fetch_array($query)) {
                  ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $data['id_psh']; ?></td>
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
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="laporan/laporan_pelatihan_pdf.php" target="_blank">

              <!-- /.box-body -->
              <div class="box-footer">
                <center>
                  <input type="submit" class="btn btn-success btn-lg" name="cetak" value="CETAK PDF">
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
  </section>