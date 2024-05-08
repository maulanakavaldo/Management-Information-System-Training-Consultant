<?php
include "koneksi.php";
if (@$_GET['page'] == '') {
?>
  <div class="col-md-9">
    <div class="panel panel-default">
      <div class="panel-body">
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h2 class="box-title"><b>
                      <center>JENIS PELATIHAN YANG BISA DIIKUTI<center>
                    </b></h2>
                </div>
                <div class="box-body">
                  <br>
                  <?php
                  $thn = date('Y');
                  $query = mysqli_query($CON, "SELECT * FROM tb_periode WHERE tahun='$thn' order by tgl_mulai DESC") or die(mysqli_error($CON));
                  $datane = mysqli_fetch_array($query);
                  ?>
                  <table border="" cellspacing="1" cellpadding="1" width="90%" align="center">
                    <caption>
                      <h3>Periode Pendaftaran di Buka: <?php echo $datane['tgl_mulai'] . ' sampai ' . date('d F Y',  strtotime($datane['tgl_selesai'])); ?></h3> <br /><br />
                    </caption>

                    <thead>
                      <tr bgcolor="grey" class="header">
                        <th>No</th>
                        <th>Nama Pelatihan</th>
                        <th>Tempat</th>
                        <th>Jadwal</th>
                        <th>
                          <center>Sisa Kuota</center>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $tampilkan = "SELECT * FROM tb_jenispelatihan left join tb_pelatihan on tb_jenispelatihan.id_jenispelatihan=tb_pelatihan.id_jenispelatihan WHERE kuota > 0 ";
                      //$tampilkan = mysqli_query($CON, "SELECT * FROM tb_pelatihan NATURAL JOIN tb_jenispelatihan on tb_pelatihan.id_jenispelatihan=tb_jenispelatihan.id_jenispelatihan WHERE kuota > 0 and tb_pelatihan.id_pelatihan is null");
                      $no = 1;
                      $query = mysqli_query($CON, $tampilkan);
                      if ($query === FALSE) {
                        die(mysqli_error($CON));
                      }
                      while ($data = mysqli_fetch_array($query)) {
                      ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $data['nama_pelatihan']; ?></td>
                          <td><?php echo $data['tempat']; ?></td>
                          <td><?php echo $data['jadwal']; ?></td>
                          <td>
                            <center><?php echo $data['kuota']; ?></center>
                          </td>
                        </tr>
                      <?php
                        $no++;
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <div class="col-md-9">
    <div class="panel panel-default">
      <div class="panel-body " style="text-align: center;">

        <?php
        $now = date('Y-m-d');
        // $now = '2019-01-21';
        $tgl_a = date('Y-m-d', strtotime('-1 days', strtotime($datane['tgl_mulai'])));
        $tgl_b = date('Y-m-d', strtotime('+1 days', strtotime($datane['tgl_selesai'])));

        if ($now >= $tgl_a and $now <= $tgl_b) {
          echo '<br> <label> Silahkan Daftar Untuk Pelatihan</label>
            <br>
            <a href="?page=tambah_peserta" class="button btn-success bt-lg" style="color:black">MENDAFTAR</a>';
        } else {
          echo "<br> <div style='color:red'>BUKAN PERIODE PENDAFTARAN</div>";
        }
        ?>
      </div>
    </div>
  </div>
  <div style="padding:20px 0 0 0;" class="row"></div>
<?php
} elseif ($_GET['page'] == 'tambah_peserta') {
  include "admin/peserta/tambah_peserta_umum.php";
} elseif ($_GET['page'] == 'kontak') {
  include "kontak.php";
} elseif ($_GET['page'] == 'pengumuman') {
  include "pengumuman.php";
} elseif ($_GET['page'] == 'form_pendaftaran') {
  include "form_pendaftaran.php";
} elseif ($_GET['page'] == 'visi_misi') {
  include "visi_misi.php";
} elseif ($_GET['page'] == 'kalender_coba') {
  include "kalender_coba.php";
} elseif ($_GET['page'] == 'selayang_pandang') {
  include "selayang_pandang.php";
} elseif ($_GET['page'] == 'tugas_fungsi') {
  include "tugas_fungsi.php";
} elseif ($_GET['page'] == 'struktur_organisasi') {
  include "struktur_organisasi.php";
}
?>