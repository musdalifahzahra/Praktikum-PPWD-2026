<?php
session_start();
require "functions.php";

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <span class="kiri"><?= $_SESSION["username"] ?></span>
        <div class="kanan">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="history.php">Riwayat</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="wrap-smua">
        <div class="wrap-riwayat">
            <h5 style="text-align: center;">Cek riwayat peminjamanmu disini</h5>
            <?php
            $query = "SELECT * FROM peminjaman ORDER BY id_peminjaman  DESC";
            $peminjaman = read_rows($query);
            ?>
            <div class="satu-riwayat th">
                <span>ID</span>
                <span>Laboratorium</span>
                <span style="text-align: right;">Timestamp</span>
            </div>
            <?php foreach ($peminjaman as $row): ?>
                <div class="satu-riwayat">
                    <span><?= $row["id_peminjaman"] ?></span>
                    <?php
                    $id_lab = $row["id_laboratorium"];
                    $nama_lab = "SELECT  * FROM laboratorium WHERE id_laboratorium = '$id_lab'";
                    ?>
                    <span><?= "Laboratorium " . read_row($nama_lab)["nama"]; ?></span>
                    <?php $id_jam = $row["id_jam"];
                    $nama_jam = "SELECT * FROM jam WHERE id_jam = '$id_jam'";
                    ?>
                    <span style="text-align: right;"><?= $row["tanggal"] . " " .  read_row($nama_jam)["jam"] ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>