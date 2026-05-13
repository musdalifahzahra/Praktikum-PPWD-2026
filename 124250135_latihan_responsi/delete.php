<?php
require "functions.php";
if (isset($_GET["id_peminjaman"])) {
    $id_peminjaman = $_GET["id_peminjaman"];
    
    if (delete($id_peminjaman) > 1) {
        header("location: home.php");
        exit();
    }
}
