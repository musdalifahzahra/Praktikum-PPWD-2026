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
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <span class="kiri">Profile</span>
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
            <h5>Cek riwayat peminjamanmu disini</h5>
            <?php
            $query = "SELECT * FROM peminjaman";
            $peminjaman = read_rows($query);
            ?>
            <table>
                <tr>
                    <th  style="text-align: center; width:10px">ID</th>
                    <th>Laboratorium</th>
                    <th  style="text-align: right;">Timestamp</th>
                </tr>
                <?php foreach ($peminjaman as $row): ?>
                    <tr>
                        <td style="text-align: center;"><?= $row["id_peminjaman"] ?></td>
                        <?php
                        $id_lab = $row["id_laboratorium"];
                        $nama_lab = "SELECT  * FROM laboratorium WHERE id_laboratorium = '$id_lab'";
                        ?>
                        <td><?= "Laboratorium " . read_row($nama_lab)["nama"]; ?></td>
                        <?php $id_jam = $row["id_jam"];
                        $nama_jam = "SELECT * FROM jam WHERE id_jam = '$id_jam'";
                        ?>
                        <td style="text-align: right;"><?= $row["tanggal"] . " " .  read_row($nama_jam)["jam"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>

</html>