<?php
session_start();
require "functions.php";

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit();
}

if (isset($_GET["cari"])) {
    if (!empty($_GET["lab_cari"]) || !empty($_GET["jam_cari"])) {
        $data_tersedia = read_tersedia($_GET);
    } else {
        $data_tersedia = read_tersedia(0);
    }
} else {
    $data_tersedia = read_tersedia(0);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
        <section>
            <div class="search">
                <form action="">
                    <input type="text" class="form-control" name="lab_cari" placeholder="Cari laboratorium" value="">
                    <select class=" form-select" aria-label="Default select example" name="jam_cari">
                        <option value="">Jam</option>
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
                    <button name="cari" class="tombol">Cari</button>
                    <a href="home.php" class="tombol" style="text-decoration: none;">Reset</a>
                </form>
            </div>
            <br>

            <!-- LABORATORIUM YG TERSEDIA  -->
            <!-- cari data lab yg tersedia  -->
            <?php
            // $data_tersedia = read_tersedia();
            ?>
            <h5 style="margin-top: 5px;">Laboratorium yang tersedia hari ini</h5>
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
            <h5>Ajuan pinjaman saat ini</h5>
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
                        <span style="font-size: small;"><?= $row["tanggal"] . " " . read_row($nama_jam)["jam"] ?></span>
                        <span class="jam satu-jam"> <?= read_row($nama_jam)["jam"] ?></span>
                        <div class="aksi">
                            <a href="delete.php?id_peminjaman=<?= $row["id_peminjaman"] ?>" class="tombol trans">Hapus</a>
                            <a href="edit.php?id_peminjaman=<?= $row["id_peminjaman"] ?>" class="tombol">Edit</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div style="text-align: right;">
                <a href="add.php"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                    </svg>
                </a>
            </div>
        </section>
    </div>
</body>

</html>