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
        <section>
            <div class="search-bar">
                <div class="">
                    <input type="text" class="form-control" name="lab_cari" placeholder="Cari laboratorium">
                </div>
                <select class=" form-select" aria-label="Default select example" name="jam_cari">
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
            <br>

            <!-- LABORATORIUM YG TERSEDIA  -->
            <!-- cari data lab yg tersedia -->
            <?php
            $data_tersedia = read_tersedia();
            ?>
            <h5>Laboratorium yang tersedia hari ini</h5>
            <div class="wrap-card">
                <?php foreach ($data_tersedia as $lab => $daftar_jam): ?>
                    <div class="card">
                        <span><?= "Laboratorium " . $lab ?></span>
                        <div class="wrap-jam">
                            <?php foreach ($daftar_jam as $jam): ?>
                                <span class="satu-jam"><?= $jam ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section>
            <h5>Ajuan pinjaman sata ini</h5>
            <div class="wrap-card">
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

                        <span><?= "Laboratorium " . read_row($nama_lab)["nama"] ?></span>
                        <span><?= $row["tanggal"] . " " . read_row($nama_jam)["jam"] ?></span>
                        <span class="jam"> <?= read_row($nama_jam)["jam"] ?></span>
                        <div class="aksi">
                            <a href="delete.php?id_peminjaman=<?= $row["id_peminjaman"] ?>">Hapus</a>
                            <a href="edit.php?id_peminjaman=<?= $row["id_peminjaman"] ?>">Edit</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <a href="add.php">tambah</a>
        </section>
    </div>
</body>

</html>