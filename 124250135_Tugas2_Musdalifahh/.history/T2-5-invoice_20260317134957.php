<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Invoice Pemesanan Tiket</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="T2-3-4-5.css" />
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
      <span> <?php echo "$_SESSION[email]"; ?> </span>
    </div>
  </nav>

  <div class="latar"></div>
  <div class="isi invoice justify-content-center d-flex align-items-center">
    <!-- form -->
    <form class="row g-3 p-5 m-2 justify-content-center d-flex align-items-center" action="T2-3-formpesan.php" method="post">
      <!-- judul -->
      <div class="col-md-12 pb-4">
        <p class="judul">INVOICE PEMESANAN TIKET</p>
      </div>
      <!-- php array -->
      <?php
      $hargapertiket = 50000;
      $jumlahtiket = $_POST[jumlahtiket];
      $invoice = [
        "Nama" => $_POST["nama"],
        "Email" => $_POST["email"],
        "Film yang Dipesan" => $_POST["film"],
        "Jumlah Tiket" => $_POST["jumlahtiket"],
        "Kursi yang Dipilih " => $_POST["pilihkursi"],
        "Metode Pembayaran" => $_POST["pilihbayar"],
        "Harga Pertiket" => $hargapertiket,
        "Total Pembayaran" => $hargapertiket * $jumlahtiket)
      ];
      ?>
      
      <table>
        <!-- php perulangan -->
        <?php foreach ($invoice as $arrayinvoice => $value): ?>
          <tr>
            <td><?php echo $arrayinvoice ?></td>
            <td><?php echo ": " . $value ?></td>
          </tr>
        <?php endforeach; ?>
      </table>

      <!-- pesan lagi -->
       <input type="hidden" name="email" value="<?= $_POST["email"] ?>">
      <div class="col-md-12">
        <button type="submit">Pesan lagi</button>
      </div>

    </form>
  </div>
</body>

</html>