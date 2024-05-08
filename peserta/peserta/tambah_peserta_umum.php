<html>

<head>

  <style type="text/css">
    caption {
      font-size: x-large
    }

    /*----mengatur link secara umum ----*/
    a:link {
      color: #600;
    }

    a:visited {
      color: #600;
    }

    a:hover {
      color: #ffffff;
    }

    a:active {
      color: #0F0;
    }
  </style>

</head>
<?php
if (isset($_POST['simpan'])) {
  $id_peserta = $_POST['id_peserta'];
  $no_ktp = $_POST['no_ktp'];
  $nama_peserta = $_POST['nama_peserta'];
  $jekel = $_POST['jekel'];
  $alamat = $_POST['alamat'];
  $no_hp = $_POST['no_hp'];
  $nama_perusahaan = $_POST['nama_perusahaan'];
  $produk = $_POST['produk'];
  $nama_pelatihan = $_POST['nama_pelatihan'];

  $sumber     = $_FILES['foto_diri']['tmp_name'];
  $target     =  'foto/user/';
  $nama_foto  = $id_peserta . '_ft_' . $_FILES["foto_diri"]["name"];
  $pindah     = move_uploaded_file($sumber, $target . $nama_foto);

  $sumber1     = $_FILES['tdi']['tmp_name'];
  $target1     =  'foto/tdi/';
  $nama_foto1  = $id_peserta . '_tdi_' . $_FILES["tdi"]["name"];

  $username = $_POST['username'];
  $password = $_POST['password'];
  $tahun     = $_POST['tahun'];
  $pindah1     = move_uploaded_file($sumber1, $target1 . $nama_foto1);

  $query = "INSERT INTO tb_pendaftaran VALUES('" . addslashes($id_peserta) . "','" . addslashes($no_ktp) . "','" . addslashes($nama_peserta) . "','" . addslashes($jekel) . "','" . addslashes($alamat) . "','" . addslashes($no_hp) . "','" . addslashes($nama_perusahaan) . "','" . addslashes($produk) . "','" . addslashes($nama_pelatihan) . "','" . addslashes($nama_foto) . "','" . addslashes($nama_foto1) . "','" . addslashes($username) . "','" . addslashes($password) . "','Calon','" . addslashes($tahun) . "')";
  $update_kuota = mysqli_query($CON, "UPDATE tb_pelatihan SET kuota=kuota-1 WHERE id_jenispelatihan='$nama_pelatihan'") or die(mysqli_error($CON));
  $simpan = mysqli_query($CON, $query) or die(mysqli_error($CON));
  if ($simpan) {
    echo "<div class='alert alert-success'>
      <a href='?page=data_peserta' class='close' data-dismiss='alert'>
      &times;
      </a> Simpan Data Berhasil
      </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page='>";
  } else {
    echo "<div class='alert alert-warning'>
      <a href='?page=data_peserta' class='close' data-dismiss='alert'>
      &times;
      </a> Simpan Data Berhasil
      </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page='>";
  }
}

$query = "select max(id_peserta) from tb_pendaftaran";
$sql = mysqli_query($CON, $query) or die(mysqli_error($CON));
$kode = mysqli_fetch_array($sql);
if ($kode) {
  $nilaikode = substr($kode[0], 1);
  $kodenya = (int) $nilaikode;
  $kodenya = $kodenya + 1;
  $hasilkode = "P" . str_pad($kodenya, 4, "0", STR_PAD_LEFT);
} else {
  $hasilkode = "P0001";
}
?>
<script language="javascript">
  function hanyaAngka(e, decimal) {
    var key;
    var keychar;
    if (window.event) {
      key = window.event.keyCode;
    } else
    if (e) {
      key = e.which;
    } else return true;

    keychar = String.fromCharCode(key);
    if ((key == null) || (key == 0) || (key == 8) || (key == 9) || (key == 13) || (key == 27)) {
      return true;
    } else
    if ((("0123456789").indexOf(keychar) > -1)) {
      return true;
    } else
    if (decimal && (keychar == ".")) {
      return true;
    } else return false;
  }
</script>

<script>
  function cekKtpPemilik() {
    no_ktp = document.getElementById("no_ktp").value;

    $.ajax({
      url: "ajax/cek.php?act=cekKtpPemilik&no_ktp=" + no_ktp,
      data: "no_ktp=" + no_ktp,
      success: function(data) {
        if (data > 0) {
          document.getElementById("form-ktp").className = "form-group has-error";
          $("#pesanKTP").html("Data tersebut sudah terdaftar");
          document.getElementById("tombol").disabled = true;
        } else {
          document.getElementById("form-ktp").className = "form-group";
          $("#pesanKTP").html("");
          document.getElementById("tombol").disabled = false;
        }
      },
      dataType: "html"
    });
  }
</script>

<title>BIDANG PERINDUSTRIAN DISNAKERPERINKOP</title>

<body>
  <blockquote>Untuk Mengikuti Pelatihan IKM <br>
    Silahkan Lakukan Proses Pendaftaran Terlebih Dahulu</blockquote>
</body>

</html>

<table align="center" cellpadding="2" cellspacing="10">
  <tr>
    <td colspan="3" align="center" width="700" height="40" bgcolor="#CCCC99"><b>
        <font size="+2" color="#600">PENDAFTARAN</font>
      </b>
    </td>
  </tr>

  <tr>
    <td colspan="3" align="left" width="200" height="20"></td>
  </tr>
  <tr>

    <form class="form-horizontal" method="post" enctype="multipart/form-data">
  <tr>
    <div class="form-group">
      <td width="32%">ID Peserta</td>
      <td width="2%">:</td>
      <td width="66%">
        <div class="col-sm-6">
          <input type="text" class="form-control" name="id_peserta" size="30" value="<?php echo $hasilkode ?>" readonly>
        </div>
      </td>
    </div>
  </tr>

  <tr>
    <div class="form-group" id="form-ktp">
      <td width="32%">No KTP</td>
      <td width="2%">:</td>
      <td width="66%">
        <div class="col-sm-10">
          <input type="text" class="form-control" size="30" id="no_ktp" name="no_ktp" placeholder="No KTP" onkeypress="return hanyaAngka(event, false)" onkeyup="cekKtpPemilik()" maxlength="16" required>
        </div>
      </td>
      <div class="help-block col-xs-12 col-sm-reset inline" id="pesanKTP"></div>
    </div>
  </tr>

  <tr>
    <div class="form-group">
      <td width="32%">Nama</td>
      <td width="2%">:</td>
      <td width="66%">
        <div class="col-sm-10">
          <input type="text" class="form-control" size="30" name="nama_peserta" placeholder="Nama Peserta" required>
        </div>
      </td>
    </div>
  </tr>

  <tr>
    <div class="form-group">
      <td width="32%">Jenis Kelamin</td>
      <td width="2%">:</td>
      <td width="66%">
        <input type="radio" name="jekel" value="L"> Laki-laki</br>
        <input type="radio" name="jekel" value="P"> Perempuan</br>
      </td>
    </div>
  </tr>

  <tr>
    <div class="form-group">
      <td width="32%">Usaha</td>
      <td width="2%">:</td>
      <td width="66%">
        <div class="col-sm-10">
          <input type="text" class="form-control" size="30" name="usaha" placeholder="Usaha" required>
        </div>
      </td>
    </div>
  </tr>

  <tr>
    <div class="form-group">
      <td width="32%">Alamat</td>
      <td width="2%">:</td>
      <td width="66%">
        <div class="col-sm-10">
          <textarea class="form-control" cols="40" rows="3" placeholder="(Penting...!) Alamat Lengkap Anda" name="alamat" required></textarea>
        </div>
      </td>
    </div>
  </tr>

  <tr>
    <div class="form-group">
      <td width="32%">No. Telepon</td>
      <td width="2%">:</td>
      <td width="66%">
        <div class="col-sm-10">
          <input type="text" class="form-control" size="30" name="no_hp" placeholder="(Penting...!) Nomer Telepon Aktif" onkeypress="return hanyaAngka(event, false)" maxlength="12" required>
        </div>
      </td>
    </div>
  </tr>

  <tr>
    <div class="form-group">
      <td width="32%">Nama Perusahaan</td>
      <td width="2%">:</td>
      <td width="66%">
        <div class="col-sm-10">
          <input type="text" class="form-control" size="30" name="nama_perusahaan" placeholder="Nama Perusahaan" required>
        </div>
      </td>
    </div>
  </tr>

  <tr>
    <div class="form-group">
      <td width="32%">Produk</td>
      <td width="2%">:</td>
      <td width="66%">
        <div class="col-sm-10">
          <input type="text" class="form-control" size="30" name="produk" placeholder="Produk" required>
        </div>
      </td>
    </div>
  </tr>

  <tr>
    <div class="form-group">
      <td width="32%">Nama Pelatihan</td>
      <td width="2%">:</td>
      <td width="66%">
        <div class="col-sm-10">
          <select class="form-control" name="nama_pelatihan">
            <option>Pilih*</option>
            <?php
            $s_pelatihan = mysqli_query($CON, "SELECT tb_jenispelatihan.id_jenispelatihan, tb_jenispelatihan.nama_pelatihan FROM tb_jenispelatihan left join tb_pelatihan on tb_jenispelatihan.id_jenispelatihan=tb_pelatihan.id_jenispelatihan WHERE kuota > 0 and tb_pelatihan.id_pelatihan is null") or die(mysqli_error($CON));
            while ($h_pelatihan = mysqli_fetch_array($s_pelatihan)) {
              echo "<option value='$h_pelatihan[id_jenispelatihan]'>$h_pelatihan[nama_pelatihan]</option>";
            }
            ?>
          </select>
        </div>
      </td>
    </div>
  </tr>

  <tr>
    <div class="form-group">
      <td width="32%">Foto Peserta</td>
      <td width="2%">:</td>
      <td width="66%">
        <div class="col-sm-10">
          <input type="file" name="foto_diri" required>
        </div>
      </td>
    </div>
  </tr>

  <tr>
    <div class="form-group">
      <td width="32%">Scan TDI</td>
      <td width="2%">:</td>
      <td width="66%">
        <div class="col-sm-10">
          <input type="file" name="tdi" required>
        </div>
      </td>
    </div>
  </tr>

  <tr>
    <div class="form-group" id="form-username">
      <td>Username</td>
      <td>:</td>
      <td>
        <div class="col-sm-10">
          <input type="text" class="form-control" size="30" id="username" name="username" onkeyup="cekUsername()" placeholder="Username" required>
        </div>
        <div class="help-block col-xs-12 col-sm-reset inline" id="pesanUsername"></div>
      </td>
    </div>
  </tr>

  <tr>
    <div class="form-group">
      <td>Password</td>
      <td>:</td>
      <td>
        <div class="col-sm-10">
          <input type="text" class="form-control" size="30" name="password" placeholder="Password" required>
        </div>
      </td>
    </div>
  </tr>

  <tr>
    <div class="form-group">
      <td width="32%">Tahun Periode</td>
      <td width="2%">:</td>
      <td width="66%">
        <div class="col-sm-2">
          <select class="form-control" name="tahun" readonly>
            <?php
            $s_periode = mysqli_query($CON, "SELECT id_periode,tahun FROM tb_periode") or die(mysqli_error($CON));
            while ($h_periode = mysqli_fetch_array($s_periode)) {
              echo "<option value='$h_periode[id_periode]'>$h_periode[tahun]</option>";
            }
            ?>
          </select>
        </div>
      </td>
    </div>
  </tr>

  <tr>
    <td width="32%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="66%">
      <div class="box-footer">
        <a href="?page=data_peserta" class="btn btn-danger btn-lg">Batal</a>
        <button type="submit" class="btn btn-info pull-right btn-lg" name="simpan">Simpan</button>
      </div>
    </td>
  </tr>
  <br><br>
  <tr height="20" bgcolor="#CCCC99">
    <td colspan="3">
  </tr>
</table>
</form>