<?php
session_start();
require "functions.php";

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit();
}

// if (isset($_POST["submit_pinjaman"])) {
//     if (create_peminjaman($_POST) > 1) {
//         header("location: home.php");
//         exit();
//     }
// }

if (isset($_POST["submit_pinjaman"])) {
    $cek_tersedia = update_peminjaman_ketersediaan($_POST);
    if ($cek_tersedia != '1') {
        $_SESSION["error_ubah"] = "Waktu yang dipilih sudah tidak tersedia";
        header("location: add.php");
        exit();
    } else {
        if (create_peminjaman($_POST) > 0) {
            header("location: home.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
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

    <div class="wrap-smua form" style="margin-top: 80px;">
        <div class="wrap-form">
            <h5 style="text-align: center; margin-bottom: 0px">Silahkan masukkan data</h5><br>
            <form action="" method="POST">
                <!-- nama lab -->
                <div>
                    <label for="nama_lab">Nama Laboratorium</label><br>
                    <select class="form-select" name="id_lab" aria-label="Default select example" required>
                        <option>Nama Laboratorium</option>
                        <?php
                        $query = "SELECT * FROM laboratorium";
                        $lab = read_rows($query);
                        foreach ($lab as $row):
                        ?>
                            <option value="<?= $row["id_laboratorium"] ?>"><?= "Laboratorium " . $row["nama"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- tanggal -->
                <div class="">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" required style="color: black;">
                </div>

                <!-- jam -->
                <div>
                    <label for="">Jam Mulai</label>
                    <div class="jam">

                        <?php
                        $query_jam = "SELECT * FROM jam";
                        $jam = read_rows($query_jam);
                        $i = 1;
                        foreach ($jam as $row):
                        ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="<?= $row["id_jam"] ?>" name="jam" id="jam<?= $i ?>" required>
                                <label class="form-check-label" for="jam<?= $i ?>">
                                    <?= $row["jam"] ?>
                                </label>
                            </div>
                        <?php
                            $i++;
                        endforeach; ?>
                    </div>
                </div>
                <!-- nampilin erro -->
                <?php
                if (isset($_SESSION["error_ubah"])) {
                ?>
                    <span>
                        <?= $_SESSION["error_ubah"] ?>
                    </span>
                <?php
                }
                unset($_SESSION["error_ubah"]);
                ?>
                <!-- aksi -->
                <div class="aksi">
                    <a href="home.php" class="tombol trans">Batalkan pesanan</a>
                    <button type="submit" name="submit_pinjaman" class="tombol">Ajukan Pinjaman</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>