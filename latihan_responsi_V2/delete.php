<?php
require "functions.php";
if (isset($_GET["id_peminjaman"])) {
    $id_peminjaman = $_GET["id_peminjaman"];
    $query = "DELETE FROM peminjaman WHERE id_peminjaman = '$id_peminjaman'";
    if (delete($query) > 0) {
        header("location: home.php");
        exit();
    }
}
