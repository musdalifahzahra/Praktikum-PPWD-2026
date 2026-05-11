<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "peminjaman_laboratorium";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Maaf koneksi gagal" . mysqli_connect_error());
}
