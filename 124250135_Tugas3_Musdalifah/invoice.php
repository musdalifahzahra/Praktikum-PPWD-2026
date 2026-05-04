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

<!-- bootstrap dropdown -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<body class="">
  <nav>
    <div>
      <span>MOVIE</span>
    </div>
    <div class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
        style="display: flex; flex-direction: row; align-items: center;">
        <div>
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
          </svg>
          <span> <?php echo $_SESSION["username"]; ?> </span>
        </div>
      </a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="logout.php" style="text-align: center; padding:0px">Logout
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out-icon lucide-log-out">
              <path d="m16 17 5-5-5-5" />
              <path d="M21 12H9" />
              <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
            </svg>
          </a>
        </li>
      </ul>
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
        <a href="edit.php?id_pesanan=<?= $id_pesanan ?>" class="satu_aksi">Edit Pesanan</a>
        <a href="delete.php?id_pesanan=<?= $id_pesanan ?>" class="satu_aksi">Batalkan Pesanan</a>
      </div>

      <!-- pesan lagi -->
      <div class="col-md-12">
        <button type="submit">Pesan lagi</button>
      </div>

    </form>
  </div>
</body>

</html>