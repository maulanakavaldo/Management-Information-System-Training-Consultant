<?php
include "koneksi.php";
session_start();


$username = ($_POST['username']);
$password = base64_encode($_POST['password']);
$login = $_POST['login'];

echo $password;

//ADMIN CLOUD
if ($login) { // jika login di klik
  if ($username == "" || $password == "") { // dan jika text user dan pass masih kosong
?>
    <!-- muncul peringatan dari javascript -->
    <script type="text/javascript">
      alert("Username atau password masih kosong");
      window.location.href = "index.php"
    </script>
    <?php
  }
  //jika tidak kosong
  else {
    $query = mysqli_query($CON, "SELECT * FROM tb_admin WHERE  username='$username' and password='$password'") or die(mysqli_error($CON));
    $data = mysqli_fetch_array($query);
    $cek = mysqli_num_rows($query);
    if ($cek >= 1) {
      if ($data['status'] == "petugas") {
        $_SESSION['id_admin'] = $data['id_admin'];
        // maka menuju ke halaman index.php
        header("location: admin/index.php");
        //dan jika levelnya operator
      } elseif ($data['status'] == "kabid") {
        $_SESSION['id_admin'] = $data['id_admin'];
        // maka menuju ke halaman index.php
        header("location: kabid/index.php");
      }
    } elseif ($cek < 1) {
      $query1 = mysqli_query($CON, "SELECT * FROM tb_user WHERE  username='$username' and password='$password'") or die(mysqli_error($CON));
      $data1 = mysqli_fetch_array($query1);
      $cek1 = mysqli_num_rows($query1);
      if ($cek1 >= 1) {
        $_SESSION['id_user'] = $data1['id_user'];
        // maka menuju ke halaman index.php
        header("location: peserta/index.php");
      } else {
    ?>
        <!-- muncul peringatan kalau login gagal dan langsung kembali ke halaman login.php-->
        <script type="text/javascript">
          alert("Login Gagal .");
          window.location.href = "index.php"
        </script>
<?php
      }
    }
  }
}
?>