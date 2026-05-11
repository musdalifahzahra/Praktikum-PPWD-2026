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

    <div class="search-bar">
        <input type="text" name="lab_cari" placeholder="Cari Laboratorium">
        <select class="form-select" aria-label="Default select example" name="jam_cari">
            <option selected>Jam</option>
            <?php
            $read_jam = "SELECT * FROM jam";
            $jam = read_rows($read_jam);
            foreach ($jam as $row):
            ?>
                <option value="<?= $row["id_jam"] ?>"><?= $row["jam"] ?></option>
            <?php
            endforeach;
            ?>
        </select>
        <button name="cari">Cari</button>
    </div>


    <section class="wrap-card">
        <h5>Laboratorium yang tersedia hari ini</h5>
        <?php
        $read_tersedia = "SELECT * FROM tersedia";
        ?>
    </section>

    <section class="wrap-card">
        <h5>Ajuan pinjaman sata ini</h5>
        <?php
        $read_peminjaman = "SELECT * FROM peminjaman ORDER BY id_peminjaman DESC LIMIT 5";
        $peminjaman = read_rows($read_peminjaman);

        foreach ($peminjaman as $row):
        ?>
            <div class="card">
                <?php
                $id_lab = $row["id_laboratorium"];
                $nama_lab = "SELECT * FROM laboratorium WHERE id_laboratorium = '$id_lab'";

                $id_jam = $row["id_jam"];
                $nama_jam = "SELECT * FROM jam WHERE id_jam = '$id_jam'";
                ?>

                <span><?= read_row($nama_lab)["nama"] ?></span>
                <span><?= $row["tanggal"] . " " . read_row($nama_jam)["jam"] ?></span>
                <span class="jam"> <?= read_row($nama_jam)["jam"] ?></span>
                <div class="aksi">
                    <a href="delete.php?id_peminjaman=<?= $row["id_peminjaman"] ?>">Hapus</a>
                    <a href="edit.php?id_peminjaman=<?= $row["id_peminjaman"] ?>">Edit</a>
                </div>
            </div>
        <?php endforeach; ?>

        <a href="add.php">tambah</a>
    </section>
</body>

</html>