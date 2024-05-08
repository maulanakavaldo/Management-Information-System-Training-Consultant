<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "db_jsi";

$CON = mysqli_connect($host, $username, $password, $db);
if (!$CON) {
    die("Koneksi gagal:" . mysqli_connect_error());
}
