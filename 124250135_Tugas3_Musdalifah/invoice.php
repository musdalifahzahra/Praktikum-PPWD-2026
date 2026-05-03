<?php
session_start();
require "functions.php";

if (!$_SESSION["registrasi"]) {
  header("location: register.php");
  exit();
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Invoice Pemesanan Tiket</title>
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
  <div class="isi invoice justify-content-center d-flex align-items-center">
    <!-- form -->
    <form class="row g-3 p-5 m-2 justify-content-center d-flex align-items-center" action="formpesan.php" method="post">
      <!-- judul -->
      <div class="col-md-12 pb-4">
        <p class="judul">INVOICE PEMESANAN TIKET</p>
      </div>

      <div class="form">
        <?php
        $id_pesanan = $_GET["id_pesanan"];
        $pesanan = read_row("SELECT * FROM pesanan WHERE id = $id_pesanan");
        $id_film = $pesanan['film'];
        $film = read_row("SELECT * FROM film WHERE id = $id_film")["judul"];
        $invoice = [
          "Nama" => $pesanan["nama"],
          "Email" => $pesanan["email"],
          "Film" => $film,
          "Jumlah Tiket" => $pesanan["jumlah"],
          "Kursi" => $pesanan["kursi"],
          "Metode Pembayaran" => $pesanan["pembayaran"],
          "Harga per Tiket" => "Rp" . number_format($pesanan["harga_tiket"], 0, ',', '.'),
          "Total Bayar" => "Rp" . number_format($pesanan["total_bayar"], 0, ',', '.')
        ];
        ?>
        <table>
          <!-- php perulangan -->
          <?php foreach ($invoice as $key => $value): ?>
            <tr>
              <td><?php echo $key ?></td>
              <td><?php echo ": " . $value ?></td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
      <div class="aksi col-md-12">
        <a href="edit.php?id_pesanan=<?= $id_pesanan ?>">Edit Pesanan</a>
        <a href="delete.php?id_pesanan=<?= $id_pesanan ?>">Batalkan Pesanan</a>

      </div>
      <!-- pesan lagi -->
      <div class="col-md-12">
        <button type="submit">Pesan lagi</button>
      </div>

    </form>
  </div>
</body>

</html>