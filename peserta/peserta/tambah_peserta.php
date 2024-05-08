<?php
if (isset($_POST['simpan'])) 
{
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
  $target     =  '../foto/user/';
  $nama_foto  = $id_peserta.'_ft_'.$_FILES["foto_diri"]["name"];

  $pindah     = move_uploaded_file($sumber, $target.$nama_foto);

  $sumber1     = $_FILES['tdi']['tmp_name'];
  $target1     =  '../foto/tdi/';
  $nama_foto1  = $id_peserta.'_tdi_'.$_FILES["tdi"]["name"];
  $username = $_POST['username'];
  $password = $_POST['password']
  $status = $_POST['status'];
  $tahun     = $_POST['tahun'];

  $pindah1     = move_uploaded_file($sumber1, $target1.$nama_foto1);
  $query = "INSERT INTO tb_pendaftaran VALUES('".addslashes($id_peserta)."','".addslashes($no_ktp)."','".addslashes($nama_peserta)."','".addslashes($jekel)."','".addslashes($alamat)."','".addslashes($no_hp)."','".addslashes($nama_perusahaan)."','".addslashes($produk)."','".addslashes($nama_pelatihan)."','".addslashes($nama_foto)."','".addslashes($nama_foto1)."','".addslashes($username)."','".addslashes($password)."','Calon','".addslashes($tahun)."')";
  $update_kuota=mysqli_query($CON, "UPDATE tb_jenispelatihan SET kuota=kuota-1 WHERE id_jenispelatihan='$nama_pelatihan'") or die(mysqli_error($CON));
  $simpan = mysqli_query($CON, $query) or die(mysqli_error($CON));
  if ($simpan) 
  {
    echo "<div class='alert alert-success'>
      <a href='?page=data_peserta' class='close' data-dismiss='alert'>
      &times;
      </a> Simpan Data Berhasil
      </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_peserta'>";

  }else
  {
    echo "<div class='alert alert-warning'>
      <a href='?page=data_peserta' class='close' data-dismiss='alert'>
      &times;
      </a> Simpan Data Berhasil
      </div>";

    echo "<meta http-equiv='refresh' content='1; url=?page=data_peserta'>";
  }
}

$query = "select max(id_peserta) from tb_pendaftaran";
$sql = mysqli_query($CON, $query) or die(mysqli_error($CON));
$kode = mysqli_fetch_array($sql);
if ($kode) 
{
  $nilaikode = substr($kode[0], 1);
  $kodenya = (int) $nilaikode;
  $kodenya = $kodenya + 1;
  $hasilkode = "P".str_pad($kodenya, 4, "0", STR_PAD_LEFT);
}else
{
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
    if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
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
function cekKtpPemilik()
{
    no_ktp = document.getElementById("no_ktp").value;
    
    $.ajax({
        url:"ajax/cek.php?act=cekKtpPemilik&no_ktp="+no_ktp,
        data:"no_ktp="+no_ktp,
        success:function(data){
                    if(data > 0)
                    {
                        document.getElementById("form-ktp").className = "form-group has-error";
                        $("#pesanKTP").html("Data tersebut sudah terdaftar");
                        document.getElementById("tombol").disabled = true;
                    }
                    else
                    {
                        document.getElementById("form-ktp").className = "form-group";
                        $("#pesanKTP").html("");
                        document.getElementById("tombol").disabled = false;
                    }
            },
        dataType:"html"
        });
}


</script>
<div class="right_col" role="main">
<section class="content-header">
 <div class="">
            <div class="page-title">
              <div class="title_left">
      <h3> Tambah Peserta</h3>
      </div>

</section>

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
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">ID Peserta</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="id_peserta" value="<?php echo $hasilkode ?>" readonly>
              </div>
            </div>
            <div class="form-group" id="form-ktp">
              <label for="inputPassword3" class="col-sm-2 control-label">No Ktp</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="no_ktp" name="no_ktp" placeholder="No KTP" onkeypress="return hanyaAngka(event, false)" onkeyup="cekKtpPemilik()" maxlength="16" required>
              </div>
              <div class="help-block col-xs-12 col-sm-reset inline" id="pesanKTP"></div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_peserta" placeholder="Nama Peserta" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Jenis Kelamin</label>
              <div class="col-sm-10">
                <select class="form-control" name="jekel">
                  <option>Pilih</option>
                  <option value="L">Laki-laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="3" placeholder="Enter ..." name="alamat" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">No. Telepon </label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="no_hp" placeholder="Nomer Telepon" onkeypress="return hanyaAngka(event, false)" maxlength="12" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nama Perusahaan</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_perusahaan" placeholder="Nama Perusahaan" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Produk</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="produk" placeholder="Produk" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama Pelatihan</label>
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
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Foto Peserta</label>
              <div class="col-sm-10">
                <input type="file"  name="foto_diri" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Scan tdi</label>
              <div class="col-sm-10">
                <input type="file"  name="tdi" required>
              </div>
            </div>
            <div class="form-group" id="form-username">
              <label for="inputPassword3" class="col-sm-2 control-label">Username</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" onkeyup="cekUsername()" placeholder="username" required>
              </div>
              <div class="help-block col-xs-12 col-sm-reset inline" id="pesanUsername"></div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="password" placeholder="password" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tahun Periode</label>
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
            </div>
            </div>
          <div class="box-footer">
            <a href="?page=data_peserta" class="btn btn-danger btn-lg">Batal</a>
            <button type="submit" class="btn btn-info pull-right btn-lg" id="tombol" name="simpan" >Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>