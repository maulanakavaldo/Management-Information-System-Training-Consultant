<?php
$id = $_GET['id'];
$id_user = $userlogin;
$sql = "SELECT * FROM tb_pelatihan WHERE id_pelatihan='$id'";
$sql1 = "SELECT * FROM tb_user WHERE id_user='$id_user'";
$sql_pdf = "SELECT * FROM tb_pendaftaran WHERE id_pendaftaran='$id'";
$sql_sts = "SELECT * FROM tb_status WHERE id_pendaftaran='$id'";

$sql_plt = "SELECT * from tb_pendaftaran inner join tb_pelatihan ON tb_pendaftaran.id_pelatihan=tb_pelatihan.id_pelatihan INNER JOIN tb_status on tb_pendaftaran.id_pendaftaran=tb_status.id_pendaftaran where tb_pendaftaran.id_pendaftaran='$id' ";

$query = mysqli_query($CON, $sql) or die(mysqli_error($CON));
$query1 = mysqli_query($CON, $sql1) or die(mysqli_error($CON));
$query_pdf = mysqli_query($CON, $sql_pdf) or die(mysqli_error($CON));
$query_sts = mysqli_query($CON, $sql_sts) or die(mysqli_error($CON));

$query_plt = mysqli_query($CON, $sql_plt) or die(mysqli_error($CON));


$data = mysqli_fetch_array($query);
$data1 = mysqli_fetch_array($query1);
$data_pdf = mysqli_fetch_array($query_pdf);
$data_sts = mysqli_fetch_array($query_sts);

$data_plt = mysqli_fetch_array($query_plt);

if (isset($_POST['simpan'])) {
    $pdd_terakhir = $_POST['pdd_terakhir'];
    $jurusan = $_POST['jurusan'];
    $nama_atasan = $_POST['nama_atasan'];
    $jbt_atasan = $_POST['jbt_atasan'];
    $jumlah = $_POST['jumlah'];

    $sumber     = $_FILES['foto']['tmp_name'];
    $target     =  '../foto/bukti_bayar/';
    $nama_foto  = $id_user . '_bukti_' . $_FILES["foto"]["name"];
    $foto_cek  = $_FILES["foto"]["name"];

    $sql1 = mysqli_query($CON, "select bukti from tb_status where id_pendaftaran='$id'") or die(mysqli_error($CON));
    $folder = mysqli_fetch_array($sql1);
    $tempat = $folder['bukti'];

    if ($foto_cek == "") {
        $simpan = mysqli_query($CON, " UPDATE tb_pendaftaran, tb_status SET tb_pendaftaran.pdd_terakhir='$pdd_terakhir', tb_pendaftaran.jurusan='$jurusan', tb_pendaftaran.nama_atasan='$nama_atasan', tb_pendaftaran.jbt_atasan='$jbt_atasan',tb_pendaftaran.jmlh_peserta=$jumlah WHERE tb_pendaftaran.id_pendaftaran='$id ' AND tb_status.id_pendaftaran='$id' ") or die(mysqli_error($CON));
    } else if ($tempat == '') {
        $pindah = move_uploaded_file($sumber, $target . $nama_foto);
        $simpan = mysqli_query($CON, "UPDATE tb_pendaftaran, tb_status SET tb_pendaftaran.pdd_terakhir='$pdd_terakhir', tb_pendaftaran.jurusan='$jurusan', tb_pendaftaran.nama_atasan='$nama_atasan', tb_pendaftaran.jbt_atasan='$jbt_atasan',tb_pendaftaran.jmlh_peserta=$jumlah, tb_status.bukti='$nama_foto' WHERE tb_pendaftaran.id_pendaftaran='$id' AND tb_status.id_pendaftaran='$id' ") or die(mysqli_error($CON));
    } else {
        $imagedelet = "../foto/bukti_bayar/$tempat";
        unlink($imagedelet);
        $pindah = move_uploaded_file($sumber, $target . $nama_foto);
        $simpan = mysqli_query($CON, "UPDATE tb_pendaftaran, tb_status SET tb_pendaftaran.pdd_terakhir='$pdd_terakhir', tb_pendaftaran.jurusan='$jurusan', tb_pendaftaran.nama_atasan='$nama_atasan', tb_pendaftaran.jbt_atasan='$jbt_atasan',tb_pendaftaran.jmlh_peserta=$jumlah, tb_status.bukti='$nama_foto' WHERE tb_pendaftaran.id_pendaftaran='$id' AND tb_status.id_pendaftaran='$id' ") or die(mysqli_error($CON));
    }

    if ($simpan) {
        echo "<div class='right_col' role='main'>
            <div class='alert alert-success'>
            <a href='?page=data_peserta' class='close' data-dismiss='alert'>
            &times;
            </a> Pendaftaran Berhasil
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


?>

<div class="right_col" role="main">
    <section class="content-header">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Edit Pelatihan</h3>
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
                                    <label for="inputPassword3" class="col-sm-2 control-label">Pelatihan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama_plt" placeholder="Nama" value="<?php echo $data_plt['nama_pelatihan']; ?>" readonly required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Jadwal</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="jadwal" placeholder="Nama" value="<?php echo $data_plt['tgl_mulai'] . " s/d " . $data_plt['tgl_akhir']; ?>" readonly required>
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
                                    <label for="inputPassword3" class="col-sm-2 control-label">Pendidikan Terakhir</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="pdd_terakhir">
                                            <?
                                            $sql_pdd = mysqli_query($CON, "SELECT * FROM tb_pendaftaran WHERE id_pendaftaran='$id'");
                                            while ($row = mysqli_fetch_array($sql_pdd)) {
                                                if ($row['pdd_terakhir'] == 'SMA') {
                                                    echo '<option value="SMA" selected="selected">SMA</option>';
                                                    echo '<option value="SMK">SMK</option>';
                                                    echo '<option value="S1">S1</option>';
                                                    echo '<option value="S2">S2</option>';
                                                    echo '<option value="S3">S3</option>';
                                                } else if ($row['pdd_terakhir'] == 'SMK') {
                                                    echo '<option value="SMA" >SMA</option>';
                                                    echo '<option value="SMK" selected="selected">SMK</option>';
                                                    echo '<option value="S1">S1</option>';
                                                    echo '<option value="S2">S2</option>';
                                                    echo '<option value="S3">S3</option>';
                                                } else if ($row['pdd_terakhir'] == 'S1') {
                                                    echo '<option value="SMA">SMA</option>';
                                                    echo '<option value="SMK">SMK</option>';
                                                    echo '<option value="S1" selected="selected">S1</option>';
                                                    echo '<option value="S2">S2</option>';
                                                    echo '<option value="S3">S3</option>';
                                                } else if ($row['pdd_terakhir'] == 'S2') {
                                                    echo '<option value="SMA" >SMA</option>';
                                                    echo '<option value="SMK">SMK</option>';
                                                    echo '<option value="S1">S1</option>';
                                                    echo '<option value="S2" selected="selected">S2</option>';
                                                    echo '<option value="S3">S3</option>';
                                                } else if ($row['pdd_terakhir'] == 'S3') {
                                                    echo '<option value="SMA" >SMA</option>';
                                                    echo '<option value="SMK">SMK</option>';
                                                    echo '<option value="S1">S1</option>';
                                                    echo '<option value="S2">S2</option>';
                                                    echo '<option value="S3" selected="selected">S3</option>';
                                                }
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Jurusan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="jurusan" placeholder="Jurusan..." value="<?php echo $data_pdf['jurusan']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Nama Atasan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama_atasan" placeholder="" value="<?php echo $data_pdf['nama_atasan']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Jabatan Atasan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="jbt_atasan" placeholder="" value="<?php echo $data_pdf['jbt_atasan']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Jumlah Peserta</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="jumlah" placeholder="" value="<?php echo $data_pdf['jmlh_peserta']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Bukti Bayar</label>
                                    <div class="col-sm-10">
                                        <input type="file" id="exampleInputFile" name="foto">
                                        <br>
                                        <label><?php echo $data_sts['bukti'] ?></label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <a href="?page=data_peserta" class="btn btn-default">Batal</a>
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