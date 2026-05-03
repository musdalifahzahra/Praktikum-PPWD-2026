<?php
session_start();
require "functions.php";
$error = false;

if (!$_SESSION["registrasi"]) {
    header("location: register.php");
    exit();
}

if (isset($_POST["pesan"])) {
    if (update_pesanan($_POST) > 0) {
        $id_pesanan = read_row("SELECT * FROM pesanan ORDER BY id DESC LIMIT 1")["id"];
        header("location: invoice.php?id_pesanan=$id_pesanan");
        exit();
    } else {
        $error = true;
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Pesan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="T3-3-4-5.css" />
    <link rel="stylesheet" href="navbar.css" />
</head>

<body class="">
    <nav>
        <div>
            <span>MOVIE</span>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
            </svg>
            <span> <?php echo $_SESSION["username"]; ?> </span>
        </div>
    </nav>

    <div class="latar"></div>
    <div class="isi justify-content-center d-flex align-items-center">
        <?php
        $id_pesanan = $_GET["id_pesanan"];
        $pesanan = read_row("SELECT * FROM pesanan WHERE id = $id_pesanan");
        ?>
        <!-- form -->
        <form class="row g-3 p-5 m-2 justify-content-center d-flex align-items-center" action="" method="POST">
            <!-- judul -->
            <div class="col-md-12 pb-4">
                <p class="judul">FORM EDIT PEMESANAN</p>
            </div>
            <!-- id pesanan -->
             <input type="hidden" name="id_pesanan" value="<?= $pesanan["id"] ?>">
            <!-- nama -->
            <div class="col-md-6">
                <label for="inputnama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="inputnama" name="nama" value="<?= $pesanan["nama"] ?>" />
            </div>
            <!-- email -->
            <div class="col-md-6">
                <label for="inputemail" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputemail" name="email" value="<?= $pesanan["email"] ?>" required />
            </div>
            <!-- pilih film -->
            <p class="labelfilmdipesan">Film Yang Ingin Dipesan</p>
            <select class="form-select" name="film" aria-label="Default select example" required>
                <option selected value="">Film Yang Ingin Dipesan</option>
                <?php
                $film = read_rows("SELECT * FROM film");
                foreach ($film as $row):
                ?>
                    <option value="<?= $row["id"] ?>" <?= ($row["id"] == $pesanan["film"]) ? 'selected' : '' ?>><?= $row["judul"] ?></option>
                <?php endforeach; ?>
            </select>

            <!-- jumtiket -->
            <div class="col-md-6">
                <label for="jumlahtiket" class="form-label">Jumlah Tiket</label>
                <input type="number" min="1" class="form-control" name="jumlahtiket" id="jumlahtiket" value="<?= $pesanan["jumlah"] ?>" required />
            </div>

            <!-- kursi -->
            <div class="col-md-6">
                <label for="pilihkursi" class="form-label">Pilih Kursi</label>
                <input type="text" class="form-control" name="pilihkursi" id="pilihkursi" value="<?= $pesanan["kursi"] ?>" required />
            </div>

            <!-- pilih bayar -->
            <div class="col-md-12">
                <p>Metode Pembayaran</p>
                <div class="pilihbayar">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="pilihbayar" value="Cash" id="cash" <?= ((trim($pesanan["pembayaran"])) == "Cash") ? 'checked' : '' ?>required />
                        <label class="form-check-label" for="cash"> Cash </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="pilihbayar" value="Qris" id="qris" <?= ((trim($pesanan["pembayaran"])) == "Qris") ? 'checked' : '' ?>required />
                        <label class="form-check-label" for="qris"> Qris </label>
                    </div>
                </div>
            </div>
            <?php var_dump($pesanan["pembayaran"]); ?>
            <?php if ($error == true) { ?>
                <span style="color: #ffff;">Maaf pemesanan gagal, silahkan pesan ulang</span>
            <?php } ?>
            <!-- pesan -->
            <div class="col-md-12">
                <button type="submit" name="pesan">Pesan</button>
            </div>
            <!-- muat ulang -->
            <div class="col-md-12"><button type="reset">Muat Ulang</button></div>
        </form>



    </div>
</body>

</html>