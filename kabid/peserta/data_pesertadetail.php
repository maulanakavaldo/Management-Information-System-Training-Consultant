<?php
// error_reporting(1);
//require "../koneksi.php";

$id  = $_GET["id"];

$query  = "SELECT * FROM tb_pendaftaran, tb_jenismagang, tb_periode WHERE tb_pendaftaran.id_peserta='$id'";
$result = mysqli_query($CON, $query);
$data   = mysqli_fetch_array($result);
/*
$query1  = "SELECT * FROM tb_pendaftaran, tb_magang WHERE tb_pendaftaran.id_peserta=tb_magang.id_peserta AND tb_pendaftaran.id_peserta='$id'";
$result1 = mysqli_query($CON, $query1);
$data1   = mysqli_fetch_array($result1);
*/

//set sudah dibaca = Y kalau sudah dibaca
//$update = mysqli_query($CON, "UPDATE pesan SET status='Baru' WHERE id=$no");


?>

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-6">
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <br>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="info text-right" style="width:150px;">ID Peserta :</td>
                                        <td><?php echo $data['id_peserta']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="info text-right" style="width:150px;">No KTP :</td>
                                        <td><?php echo $data['no_ktp']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="info text-right" style="width:150px;">Nama Peserta :</td>
                                        <td><?php echo $data['nama_peserta']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="info text-right" style="width:150px;">Jenis Kelamin:</td>
                                        <td><?php echo $data['jekel']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="info text-right" style="width:150px;">Alamat :</td>
                                        <td><?php echo $data['alamat']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="info text-right" style="width:150px;">Usaha :</td>
                                        <td><?php echo $data['usaha']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="info text-right" style="width:150px;">Hasil Produk :</td>
                                        <td><?php echo $data['hasil_produk']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="info text-right" style="width:150px;">No. Telp :</td>
                                        <td><?php echo $data['no_telp']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="info text-right" style="width:150px;">Nama_Magang :</td>
                                        <td><?php echo $data['nama_magang']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="info text-right" style="width:150px;">Username :</td>
                                        <td><?php echo $data['username']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="info text-right" style="width:150px;">Password :</td>
                                        <td><?php echo $data['password']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="info text-right" style="width:150px;">Status :</td>
                                        <td><?php echo $data['status']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="info text-right" style="width:150px;">Periode :</td>
                                        <td><?php echo $data['tahun']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">

                        <center><a target=_blank" href="../foto/user/<?php echo $data['foto']; ?>"><img src="../foto/user/<?php echo $data["foto"]; ?>" <img src="../foto/user/<?php echo $data['foto']; ?>" class="img-responsive" alt="Nature Image 1" />
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">

                        <center><a target=_blank" href="../foto/file/<?php echo $data['sk_desa']; ?>"><img src="../foto/file/<?php echo $data["sk_desa"]; ?>" <img src="../foto/file/<?php echo $data['sk_desa']; ?>" class="img-responsive" alt="Nature Image 1" />
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT WRAPPER -->