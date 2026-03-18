<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Pesan</title>
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
      <span> <?php echo $_SESSION["email"]; ?> </span>
    </div>
  </nav>

  <div class="latar"></div>
  <div class="isi justify-content-center d-flex align-items-center">
    <!-- form -->
    <form class="row g-3 p-5 m-2 justify-content-center d-flex align-items-center" action="T2-4-berhasil.php" method="post">
      <!-- judul -->
      <div class="col-md-12 pb-4">
        <p class="judul">FORM PEMESANAN</p>
      </div>
      <!-- nama -->
      <div class="col-md-6">
        <label for="inputnama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="inputnama" name="nama" />
      </div>
      <!-- email -->
      <div class="col-md-6">
        <label for="inputemail" class="form-label">Email</label>
        <input type="email" class="form-control" id="inputemail" name="email" placeholder="124250135@example.com" required />
      </div>
      <!-- pilih film -->
      <p class="labelfilmdipesan">Film Yang Ingin Dipesan</p>
      <select class="form-select" name="film" aria-label="Default select example" required>
        <option selected value="">Film Yang Ingin Dipesan</option>
        <option value="Jumbo">Jumbo</option>
        <option value="Goat">Goat</option>
        <option value="Five Nights at Freddy's 2">Five Nights at Freddy's 2</option>
        <option value="Sore">Sore</option>
        <option value="Rangga & Cinta">Rangga & Cinta</option>
      </select>

      <!-- jumtiket -->
      <div class="col-md-6">
        <label for="jumlahtiket" class="form-label">Jumlah Tiket</label>
        <input type="number" min="1" class="form-control" name="jumlahtiket" id="jumlahtiket" required />
      </div>

      <!-- kursi -->
      <div class="col-md-6">
        <label for="pilihkursi" class="form-label">Pilih Kursi</label>
        <input type="text" class="form-control" name="pilihkursi" id="pilihkursi" required />
      </div>

      <!-- pilih bayar -->
      <div class="col-md-12">
        <p>Metode Pembayaran</p>
        <div class="pilihbayar">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pilihbayar" value="Cash" id="cash" required />
            <label class="form-check-label" for="cash"> Cash </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="pilihbayar" value="Qris" id="qris" required />
            <label class="form-check-label" for="qris"> Qris </label>
          </div>
        </div>
      </div>

      <!-- pesan -->
      <div class="col-md-12">
        <button type="submit">Pesan</button>
      </div>
      <!-- muat ulang -->
      <div class="col-md-12"><button type="reset">Muat Ulang</button></div>
    </form>

    <!-- php array -->
    <?php
    $_SESSION["jumlahtiket"] = $_POST["jumlahtiket"];
    $_SESSION["hargapertiket"] = 50000;
    $_SESSION["invoice"] = [
      "Nama" => $_POST["nama"],
      "Email" => $_POST["email"],
      "Film yang Dipesan" => $_POST["film"],
      "Jumlah Tiket" => $_POST["jumlahtiket"],
      "Kursi yang Dipilih " => $_POST["pilihkursi"],
      "Metode Pembayaran" => $_POST["pilihbayar"],
      "Harga Pertiket" => $hargapertiket,
      "Total Pembayaran" => $hargapertiket * $jumlahtiket
    ];
    ?>

  </div>
</body>

</html>