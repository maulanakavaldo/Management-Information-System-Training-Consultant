<?php
$id = $_GET['id'];
$id_user = $userlogin;
$sql = "SELECT * FROM tb_pelatihan WHERE id_pelatihan='$id'";
$sql1 = "SELECT * FROM tb_user WHERE id_user='$id_user'";
$query = mysqli_query($CON, $sql) or die(mysqli_error($CON));
$query1 = mysqli_query($CON, $sql1) or die(mysqli_error($CON));

$data = mysqli_fetch_array($query);
$data1 = mysqli_fetch_array($query1);

if (isset($_POST['simpan'])) {
    $id_pdf = $_POST['id_pdf'];
    $id_plt = $id;
    $id_user = $_POST['id_user'];
    $id_status = $_POST['id_status'];
    $pdd_terakhir = $_POST['pdd_terakhir'];
    $jurusan = $_POST['jurusan'];
    $nama_atasan = $_POST['nama_atasan'];
    $jbt_atasan = $_POST['jbt_atasan'];
    $jumlah = $_POST['jumlah'];

    if ($jumlah != 0) {
        $simpan = mysqli_query($CON, " INSERT INTO tb_pendaftaran VALUES('$id_pdf','$id_plt','$id_user','$id_status','$pdd_terakhir','$jurusan','$nama_atasan','$jbt_atasan',$jumlah,now())") or die(mysqli_error($CON));
        // mysqli_query($CON, " INSERT INTO tb_status (id_pendaftaran, `status`) values('$id_pdf','Belum Bayar');") or die(mysqli_error($CON));
        mysqli_query($CON, " INSERT INTO tb_status values('$id_status','$id_pdf','','1')") or die(mysqli_error($CON));

        echo "<div class='right_col' role='main'>
        <div class='alert alert-success'>
        <a href='?page=data_peserta' class='close' data-dismiss='alert'>
        &times;
        </a> Pendafftaran Berhasil
        </div></div>";

        echo "<meta http-equiv='refresh' content='1; url=?page=data_peserta'>";
    } else {
        echo "<div class='right_col' role='main'>
    <div class='alert alert-danger'>
    <a href='?page=data_pelatihan' class='close' data-dismiss='alert'>
    &times;
    </a> Gagal
    </div></div>";

        echo "<meta http-equiv='refresh' content='1; url=?page=data_pelatihan'>";
    }
}

$query = "select max(id_pendaftaran) from tb_pendaftaran";
$sql = mysqli_query($CON, $query) or die(mysqli_error($CON));
$kode = mysqli_fetch_array($sql);
if ($kode) {
    $nilaikode = substr($kode[0], 2);
    $kodenya = (int) $nilaikode;
    $kodenya = $kodenya + 1;
    $hasilkode = "PD" . str_pad($kodenya, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "PD001";
}

$query1 = "select max(id_status) from tb_status";
$sql_s = mysqli_query($CON, $query1) or die(mysqli_error($CON));
$kode_s = mysqli_fetch_array($sql_s);
if ($kode_s) {
    $nilaikode_s = substr($kode_s[0], 2);
    $kodenya_s = (int) $nilaikode_s;
    $kodenya_s = $kodenya_s + 1;
    $hasilkode_s = "IS" . str_pad($kodenya_s, 4, "0", STR_PAD_LEFT);
} else {
    $hasilkode_s = "IS0001";
}
?>

?>
<div class="right_col" role="main">
    <section class="content-header">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Daftar Pelatihan</h3>
                </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box-header with-border">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Silahkan isi data dengan benar</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content"></div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">ID Pendaftaran</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="id_pdf" value="<?php echo $hasilkode; ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">ID status</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="id_status" value="<?php echo $hasilkode_s; ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">ID User</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="id_user" value="<?php echo $data1['id_user']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?php echo $data1['nama']; ?>" readonly required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Jenis Kelamin</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="jekel" readonly>
                                            <option value="L">Laki-laki</option>
                                            <option value="P" <?php if ($data1['jekel'] == "P") {
                                                                    echo 'selected';
                                                                } ?>>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="3" placeholder="Enter ..." readonly name="alamat"><?php echo $data1['alamat']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">No. HP </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="no_hp" placeholder="Nomer HP" value="<?php echo $data1['no_hp']; ?>" readonly required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Pendidikan Terkahir</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="pdd_terakhir" readonly>
                                            <option value="">- Pilih -</option>
                                            <option value="SMA">SMA</option>
                                            <option value="SMK">SMK</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                            <option value="S3">S3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Jurusan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="jurusan" placeholder="Jurusan...">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Nama Atasan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama_atasan" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Jabatan Atasan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="jbt_atasan" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Jumlah Peserta</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="jumlah" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <a href="?page=data_user" class="btn btn-default">Batal</a>
                                <button type="submit" class="btn btn-info pull-right" name="simpan">Simpan</button>
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