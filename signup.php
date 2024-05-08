<?php session_start(); ?>
<?php require_once("koneksi.php"); ?>

<?php

?>

<?php

if (isset($_POST['simpan'])) {
    if (@$_FILES['foto']['name']) {
        $id_user = $_POST['id_user'];
        $nama = $_POST['nama_lengkap'];
        $jekel = $_POST['jekel'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $alamat = $_POST['alamat'];
        $no_hp = $_POST['no_hp'];
        $username = $_POST['uname'];
        $password = base64_encode($_POST['password']);
        $sumber     = $_FILES['foto']['tmp_name'];
        $target     =  'foto/user/';
        $nama_foto  = $id_user . '_' . $_FILES["foto"]["name"];

        $pindah     = move_uploaded_file($sumber, $target . $nama_foto);

        $simpan = mysqli_query($CON, "INSERT INTO tb_user VALUES('$id_user','$nama','$jekel','$tgl_lahir','$alamat','$no_hp', '$username', '$password', '$nama_foto')");

        if ($simpan) {
            echo "<div class='alert alert-success'>
        <a href='' class='close' data-dismiss='alert'>
        &times;
        </a> Simpan Data Berhasil. Silakan <a href='index.php'>Login</a>
        </div>";

            echo "<meta http-equiv='refresh' content='5; url='>";
        } else {
            echo "<div class='alert alert-warning'>
        <a href='' class='close' data-dismiss='alert'>
        &times;
        </a> Simpan Data Berhasil
        </div>";

            echo "<meta http-equiv='refresh' content='1; url='>";
        }
    } else {
        echo "<div class='right_col' role='main'>
        <div class='alert alert-warning'>
        <a href='?page=data_user' class='close' data-dismiss='alert'>
        &times;
        </a> Wajib Upload Foto
        </div></div>";

        echo "<meta http-equiv='refresh' content='1; url=#'>";
    }
}



$query = "select max(id_user) from tb_user";
$sql = mysqli_query($CON, $query) or die(mysqli_error($CON));
$kode = mysqli_fetch_array($sql);
if ($kode) {
    $nilaikode = substr($kode[0], 1);
    $kodenya = (int) $nilaikode;
    $kodenya = $kodenya + 1;
    $hasilkode = "U" . str_pad($kodenya, 4, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "U0001";
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Jogja Smart Indotama || SIGN UP</title>
    <link href="backend/css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="backend/assets/img/icon_jsi.png" />
    <script data-search-pseudo-elements defer src="backend/js/all.min.js"></script>
    <script src="backend/js/feather.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5 mb-3">
                                <div class="card-header justify-content-center">
                                    <h3 class="font-weight-light my-4">Buat Akun</h3>
                                </div>
                                <div class="card-body">
                                    <form action="signup.php" method="POST" enctype="multipart/form-data">


                                        <div class="form-group" hidden>
                                            <label for="inputEmail3" class="col-sm-2 control-label">ID User</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="id_user" value="<?php echo $hasilkode ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="">Nama Lengkap</label>
                                                    <input name="nama_lengkap" class="form-control py-4" id="" type="text" placeholder="Masukkan nama lengkap..." required="true" />
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group"><label class="small mb-1" for="">Jenis Kelamin</label>
                                            <div class="col-sm-5">
                                                <select class="form-control" name="jekel">
                                                    <option>Pilih</option>
                                                    <option value="L">Laki-laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="">TanggalLahir</label>
                                                    <input name="tgl_lahir" class="form-control py-4" id="" type="date" placeholder="" required="true" />
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="">Alamat</label>
                                                    <input name="alamat" class="form-control py-4" id="" type="text" placeholder="Masukkan alamat..." />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="">NO HP</label>
                                                    <input name="no_hp" class="form-control py-4" id="" type="text" placeholder="08132232xxx" required="true" />
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group"><label class="small mb-1" for="">username</label>
                                            <input name="uname" class="form-control py-4" id="" type="text" aria-describedby="" placeholder="username" required="true" />
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group"><label class="small mb-1" for="">Password</label>
                                                    <input name="password" class="form-control py-4" id="" type="password" placeholder="password" required="true" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-2 control-label">Foto </label>
                                            <div class="col-sm-10">
                                                <input type="file" id="exampleInputFile" name="foto" required>
                                            </div>
                                        </div>
                                        <div class="g-recaptcha" data-sitekey="6LcuzwwbAAAAADotVv8TTrDVXWiTg41kqK76IC6e"></div>

                                        <div class="form-group mt-4 mb-0">
                                            <button name="simpan" class="btn btn-primary btn-block" type="submit">Create Account</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small">
                                        <a href="index.php">Sudah punya akun? Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!--Script JS-->
    <script src="backend/js/jquery-3.4.1.min.js"></script>
    <script src="backend/js/bootstrap.bundle.min.js"></script>
    <script src="backend/js/scripts.js"></script>
</body>

</html>