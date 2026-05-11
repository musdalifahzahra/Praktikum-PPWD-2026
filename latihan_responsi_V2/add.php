<?php
session_start();
require "functions.php";

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit();
}

if (isset($_POST["submit_pinjaman"])) {
    if (create_peminjaman($_POST) > 0) {
        header("location: home.php");
        exit();
    }
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

    <div class="wrap">
        <h5>Silahkan masukkan data</h5>
        <form action="" method="POST">
            <!-- nama lab -->
            <label for="nama_lab">Nama Laboratorium</label><br>
            <select class="form-select" name="id_lab" aria-label="Default select example">
                <option selected>Nama Laboratorium</option>
                <?php
                $query = "SELECT * FROM laboratorium";
                $lab = read_rows($query);
                foreach ($lab as $row):
                ?>
                    <option value="<?= $row["id_laboratorium"] ?>"><?= "Laboratorium " . $row["nama"] ?></option>
                <?php endforeach; ?>
            </select>

            <!-- tanggal -->
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" name="tanggal">
            </div>

            <!-- jam -->
            <label for="">Jam Mulai</label>
            <?php
            $query_jam = "SELECT * FROM jam";
            $jam = read_rows($query_jam);
            $i = 1;
            foreach ($jam as $row):
            ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="<?= $row["id_jam"] ?>" name="jam" id="jam<?= $i ?>">
                    <label class="form-check-label" for="jam<?= $i ?>">
                        <?= $row["jam"] ?>
                    </label>
                </div>
            <?php
                $i++;
            endforeach; ?>

            <!-- aksi -->
            <div class="aksi">
                <button type="reset">Batalkan Pinjaman</button>
                <button type="submit" name="submit_pinjaman">Ajukan Pinjaman</button>
            </div>
        </form>
    </div>
</body>

</html>