<?php
require_once "../koneksi.php";
if (@$_GET['page'] == '') {
?>


  <!-- Main content -->
  <div class="right_col" role="main">
    <section class="content">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Home</h3>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Selamat Datang</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <div class="box-body table-responsive">
                    <!-- mengatur tampilan gambar agar sesuai besarnya content -->
                    <img class="img-responsive pad" src="../foto/logo/" alt="">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="panel panel-default">
                    <a src="../foto/logo/loginn.jpg"></a>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
    </section>
  </div>

<?php
} elseif ($_GET['page'] == 'data_user') {
  include "user/data_user.php";
} elseif ($_GET['page'] == 'tambah_user') {
  include "user/tambah_user.php";
} elseif ($_GET['page'] == 'edit_user') {
  include "user/edit_user.php";
} elseif ($_GET['page'] == 'tambah_admin') {
  include "user/tambah_admin.php";
} elseif ($_GET['page'] == 'hapus_user') {
  $id = $_GET['id'];
  $query = "DELETE FROM tb_admin WHERE id_admin='$id'";
  $query_hapus = mysqli_query($CON, $query) or die(mysqli_error($CON));

  if ($query_hapus) {
    echo "
    <div class='right_col' role='main'>
    <div class='alert alert-success'>
        <a href='?page=data_user' class='close' data-dismiss='alert'>
        &times;
        </a> Hapus Data Berhasil
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_user'>";
  } else {
    echo "<div class='right_col' role='main'>
    <div class='alert alert-warning'>
        <a href='data_user' class='close' data-dismiss='alert'>
        &times;
        </a> Hapus Data Gagal
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_user'>";
  }
} elseif ($_GET['page'] == 'data_pesertacalon') {
  include "peserta/data_pesertacalon.php";
} elseif ($_GET['page'] == 'data_pesertaditolak') {
  include "peserta/data_pesertaditolak.php";
} elseif ($_GET['page'] == 'data_peserta') {
  include "peserta/data_peserta.php";
} elseif ($_GET['page'] == 'tambah_peserta') {
  include "peserta/tambah_peserta.php";
} elseif ($_GET['page'] == 'tambah_pendaftaran') {
  include "peserta/tambah_pendaftaran.php";
} elseif ($_GET['page'] == 'edit_peserta') {
  include "peserta/edit_peserta.php";
} elseif ($_GET['page'] == 'edit_pesertacalon') {
  include "peserta/edit_pesertacalon.php";
} elseif ($_GET['page'] == 'edit_pesertaditolak') {
  include "peserta/edit_pesertaditolak.php";
} elseif ($_GET['page'] == 'data_pesertadetail') {
  include "peserta/data_pesertadetail.php";
} elseif ($_GET['page'] == 'cetak_sertifikat') {
  include "peserta/cetak_sertifikat.php";
} elseif ($_GET['page'] == 'hapus_peserta') {

  $id = $_GET['id'];
  $idm = $_GET['idm'];
  $query = "DELETE FROM tb_pendaftaran WHERE id_peserta='$id'";
  $lihat = mysqli_query($CON, "SELECT * from tb_pelatihan where id_pelatihan = '$idm'");
  $dt = mysqli_fetch_array($lihat);
  $kurang = $dt['kuota'] + 1;
  $update_kuota = mysqli_query($CON, "UPDATE tb_pelatihan SET kuota=$kurang WHERE id_pelatihan='$idm'") or die(mysqli_error($CON));
  $query_hapus = mysqli_query($CON, $query) or die(mysqli_error($CON));

  if ($update_kuota) {
    echo "<div class='right_col' role='main'>
    <div class='alert alert-success'>
        <a href='?page=data_pesertacalon' class='close' data-dismiss='alert'>
        &times;
        </a> Hapus Data Berhasil
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_pesertacalon'>";
  } else {
    echo "<div class='right_col' role='main'>
    <div class='alert alert-warning'>
        <a href='data_pesertacalon' class='close' data-dismiss='alert'>
        &times;
        </a> Hapus Data Gagal
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_pesertacalon'>";
  }
} elseif ($_GET['page'] == 'data_perusahaan') {
  include "perusahaan/data_perusahaan.php";
} elseif ($_GET['page'] == 'tambah_perusahaan') {
  include "perusahaan/tambah_perusahaan.php";
} elseif ($_GET['page'] == 'edit_perusahaan') {
  include "perusahaan/edit_perusahaan.php";
} elseif ($_GET['page'] == 'hapus_perusahaan') {
  $id = $_GET['id'];
  $query = "DELETE FROM tb_perusahaan WHERE id_psh='$id'";
  $query_hapus = mysqli_query($CON, $query) or die(mysqli_error($CON));

  if ($query_hapus) {
    echo "
    <div class='right_col' role='main'>
    <div class='alert alert-success'>
        <a href='?page=data_perusahaan' class='close' data-dismiss='alert'>
        &times;
        </a> Hapus Data Berhasil
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_perusahaan'>";
  } else {
    echo "
    <div class='right_col' role='main'>
    <div class='alert alert-warning'>
        <a href='data_perusahaan' class='close' data-dismiss='alert'>
        &times;
        </a> Hapus Data Gagal
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_perusahaan'>";
  }
} elseif ($_GET['page'] == 'data_bidang_perusahaan') {
  include "bidang_perusahaan/data_bidang_perusahaan.php";
} elseif ($_GET['page'] == 'tambah_bidang_perusahaan') {
  include "bidang_perusahaan/tambah_bidang_perusahaan.php";
} elseif ($_GET['page'] == 'edit_bidang_perusahaan') {
  include "bidang_perusahaan/edit_bidang_perusahaan.php";
} elseif ($_GET['page'] == 'hapus_bidang_perusahaan') {
  $id = $_GET['id'];
  $query = "DELETE FROM tb_bidangpsh WHERE id_bidangpsh='$id'";
  $query_hapus = mysqli_query($CON, $query) or die(mysqli_error($CON));

  if ($query_hapus) {
    echo "
    <div class='right_col' role='main'>
    <div class='alert alert-success'>
        <a href='?page=data_bidang_perusahaan' class='close' data-dismiss='alert'>
        &times;
        </a> Hapus Data Berhasil
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_bidang_perusahaan'>";
  } else {
    echo "
    <div class='right_col' role='main'>
    <div class='alert alert-warning'>
        <a href='data_bidang_perusahaan' class='close' data-dismiss='alert'>
        &times;
        </a> Hapus Data Gagal
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_bidang_perusahaan'>";
  }
} elseif ($_GET['page'] == 'data_client') {
  include "client/data_client.php";
} elseif ($_GET['page'] == 'tambah_client') {
  include "client/tambah_client.php";
} elseif ($_GET['page'] == 'edit_client') {
  include "client/edit_client.php";
} elseif ($_GET['page'] == 'data_client_cro1') { //
  include "client/data_client_cro1.php";
} elseif ($_GET['page'] == 'data_client_cro2') {
  include "client/data_client_cro2.php";
} elseif ($_GET['page'] == 'data_client_cro3') {
  include "client/data_client_cro3.php";
} elseif ($_GET['page'] == 'hapus_client') {
  $id = $_GET['id'];
  $query = "DELETE FROM tb_client WHERE id_client='$id'";
  $query_hapus = mysqli_query($CON, $query) or die(mysqli_error($CON));

  if ($query_hapus) {
    echo "
    <div class='right_col' role='main'>
    <div class='alert alert-success'>
        <a href='?page=data_client' class='close' data-dismiss='alert'>
        &times;
        </a> Hapus Data Berhasil
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_client'>";
  } else {
    echo "
    <div class='right_col' role='main'>
    <div class='alert alert-warning'>
        <a href='data_client' class='close' data-dismiss='alert'>
        &times;
        </a> Hapus Data Gagal
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_client'>";
  }
} elseif ($_GET['page'] == 'data_bidang_pelatihan') {
  include "bidang_pelatihan/data_bidang_pelatihan.php";
} elseif ($_GET['page'] == 'tambah_bidang_pelatihan') {
  include "bidang_pelatihan/tambah_bidang_pelatihan.php";
} elseif ($_GET['page'] == 'edit_bidang_pelatihan') {
  include "bidang_pelatihan/edit_bidang_pelatihan.php";
} elseif ($_GET['page'] == 'hapus_bidang_pelatihan') {
  $id = $_GET['id'];
  $query = "DELETE FROM tb_bidangplt WHERE id_bidangplt='$id'";
  $query_hapus = mysqli_query($CON, $query) or die(mysqli_error($CON));

  if ($query_hapus) {
    echo "<div class='right_col' role='main'>
    <div class='alert alert-success'>
        <a href='?page=data_bidang_pelatihan' class='close' data-dismiss='alert'>
        &times;
        </a> Hapus Data Berhasil
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_bidang_pelatihan'>";
  } else {
    echo "<div class='right_col' role='main'>
    <div class='alert alert-warning'>
        <a href='data_bidang_pelatihan' class='close' data-dismiss='alert'>
        &times;
        </a> Hapus Data Gagal
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_bidang_pelatihan'>";
  }
} elseif ($_GET['page'] == 'data_pendaftaran') {
  include "pelatihan/data_pendaftaran.php";
} elseif ($_GET['page'] == 'laporan_pendaftaran') {
  include "laporan/laporan_pendaftaran.php";
} elseif ($_GET['page'] == 'acc_pendaftaran') {
  $id = $_GET['id'];

  $query_acc = mysqli_query($CON, "UPDATE  tb_status set status='Sudah Bayar' WHERE id_pendaftaran='" . addslashes($id) . "'") or die(mysqli_error($CON));

  if ($query_acc) {
    echo "
    <div class='right_col' role='main'>
    <div class='alert alert-success'>
        <a href='?page=data_pendaftaran' class='close' data-dismiss='alert'>
        &times;
        </a> Berhasil
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_pendaftaran'>";
  } else {
    echo "<div class='right_col' role='main'>
    <div class='alert alert-warning'>
        <a href='?page=data_pendaftaran' class='close' data-dismiss='alert'>
        &times;
        </a>Gagal
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_pendaftaran'>";
  }
} elseif ($_GET['page'] == 'data_pelatihan') {
  include "pelatihan/data_pelatihan.php";
} elseif ($_GET['page'] == 'tambah_pelatihan') {
  include "pelatihan/tambah_pelatihan.php";
} elseif ($_GET['page'] == 'edit_pelatihan') {
  include "pelatihan/edit_pelatihan.php";
} elseif ($_GET['page'] == 'hapus_pelatihan') {
  $id = $_GET['id'];

  $query = "DELETE FROM tb_pelatihan WHERE id_pelatihan='" . addslashes($id) . "'";
  $query_hapus = mysqli_query($CON, $query) or die(mysqli_error($CON));

  if ($query_hapus) {
    echo "
    <div class='right_col' role='main'>
    <div class='alert alert-success'>
        <a href='?page=data_pelatihan' class='close' data-dismiss='alert'>
        &times;
        </a> Hapus Data Berhasil
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_pelatihan'>";
  } else {
    echo "<div class='right_col' role='main'>
    <div class='alert alert-warning'>
        <a href='data_pelatihan' class='close' data-dismiss='alert'>
        &times;
        </a> Hapus Data Gagal
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_pelatihan'>";
  }
} elseif ($_GET['page'] == 'absensi') {
  include "kehadiran/absensi.php";
} elseif ($_GET['page'] == 'data_kehadiran') {
  include "kehadiran/data_kehadiran.php";
} elseif ($_GET['page'] == 'tambah_kehadiran') {
  include "kehadiran/tambah_kehadiran.php";
} elseif ($_GET['page'] == 'edit_kehadiran') {
  include "kehadiran/edit_kehadiran.php";
} elseif ($_GET['page'] == 'hasil_kehadiran') {
  include "kehadiran/hasil_kehadiran.php";
} elseif ($_GET['page'] == 'masuk') {
  include "kehadiran/masuk.php";
} elseif ($_GET['page'] == 'tidak') {
  include "kehadiran/tidak.php";
} elseif ($_GET['page'] == 'hapus_kehadiran') {
  $id = $_GET['id'];
  $query = "DELETE FROM tb_kehadiran WHERE id_hadir='$id'";
  $query_hapus = mysqli_query($CON, $query) or die(mysqli_error($CON));

  if ($query_hapus) {
    echo "<div class='right_col' role='main'>
    <div class='alert alert-success'>
        <a href='?page=data_kehadiran' class='close' data-dismiss='alert'>
        &times;
        </a> Hapus Data Berhasil
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_kehadiran'>";
  } else {
    echo "<div class='right_col' role='main'>
    <div class='alert alert-warning'>
        <a href='data_kehadiran' class='close' data-dismiss='alert'>
        &times;
        </a> Hapus Data Gagal
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_kehadiran'>";
  }
} elseif ($_GET['page'] == 'data_laporan') {
  include "laporan/laporan.php";


  if ($query_hapus) {
    echo "
    <div class='right_col' role='main'>
    <div class='alert alert-success'>
        <a href='?page=data_laporan' class='close' data-dismiss='alert'>
        &times;
        </a> Hapus Data Berhasil
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_laporan'>";
  } else {
    echo "<div class='right_col' role='main'>
    <div class='alert alert-warning'>
        <a href='data_laporan' class='close' data-dismiss='alert'>
        &times;
        </a> Hapus Data Gagal
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_laporan'>";
  }
} elseif ($_GET['page'] == 'data_periode') {
  include "periode/data_periode.php";
} elseif ($_GET['page'] == 'tambah_periode') {
  include "periode/tambah_periode.php";
} elseif ($_GET['page'] == 'edit_periode') {
  include "periode/edit_periode.php";
} elseif ($_GET['page'] == 'hapus_periode') {
  $id = $_GET['id'];
  $query = "DELETE FROM tb_periode WHERE id_periode='$id'";
  $query_hapus = mysqli_query($CON, $query) or die(mysqli_error($CON));

  if ($query_hapus) {
    echo "<div class='right_col' role='main'>
    <div class='alert alert-success'>
        <a href='?page=data_periode' class='close' data-dismiss='alert'>
        &times;
        </a> Hapus Data Berhasil
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_periode'>";
  } else {
    echo "<div class='right_col' role='main'>
    <div class='alert alert-warning'>
        <a href='data_periode' class='close' data-dismiss='alert'>
        &times;
        </a> Hapus Data Gagal
        </div></div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_periode'>";
  }
} elseif ($_GET['page'] == 'laporan_jenispelatihan') {
  include "laporan/laporan_jenispelatihan.php";
} elseif ($_GET['page'] == 'laporan_peserta') {
  include "laporan/laporan_peserta.php";
} elseif ($_GET['page'] == 'laporan_perusahaan') {
  include "laporan/laporan_perusahaan.php";
} elseif ($_GET['page'] == 'laporan_pendamping') {
  include "laporan/laporan_pendamping.php";
} elseif ($_GET['page'] == 'laporan_pelatihan') {
  include "laporan/laporan_pelatihan.php";
} elseif ($_GET['page'] == 'laporan_kehadiran') {
  include "laporan/laporan_kehadiran.php";
} elseif ($_GET['page'] == 'laporan_pesertaditolak') {
  include "laporan/laporan_pesertaditolak.php";
} elseif ($_GET['page'] == 'cetak_sertifikat') {
  include "laporan/cetak_sertifikat.php";
}
?>