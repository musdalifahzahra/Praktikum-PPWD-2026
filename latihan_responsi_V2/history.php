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
</head>

<body>
    <nav>
        <span class="kiri">Profile</span>
        <div class="kanan">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="history.php">Riwatat</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="wrap">
        <h5>Cek riwayat peminjamanmu disini</h5>
        <?php
        $query = "SELECT * FROM peminjaman";
        $peminjaman = read_rows($query);
        ?>

        <table>
            <tr>
                <th>ID</th>
                <th>Laboratorium</th>
                <th>Timestamp</th>
            </tr>
            <?php foreach ($peminjaman as $row): ?>
                <tr>
                    <td><?= $row["id"] ?></td>
                    <?php
                    $id_lab = $row["id_laboratorium"];
                    $nama_lab = "SELECT  * FROM laboratorium WHERE id_laboratorium = '$id_lab'";
                    ?>
                    <td><?= read_row($nama_lab)["nama"]; ?></td>
                    <td><?= $row["tanggal"] . " " .  $row["jam"] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>