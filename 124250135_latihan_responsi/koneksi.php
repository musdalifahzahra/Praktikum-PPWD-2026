<?php
$conn =mysqli_connect("localhost", "root", "", "peminjaman_laboratorium");
if(!$conn){
    die("Maaf koneksi Gagal" . mysqli_connect_error());
}
?>