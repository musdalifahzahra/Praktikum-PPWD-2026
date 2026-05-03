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
  <title>Dashbord</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="dashbordcss.css" />
  <link rel="stylesheet" href="navbar.css" />
</head>

<body>
  <header>
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

    <div class="jumbotron">
      <div class="teksnikmati">
        <h1>NIKMATI</h1>
        <h1 class="red">FILM</h1>
        <h1>FAVORITMU</h1>
      </div>
      <p>
        Di balik layar yang menyala, selalu ada kisah yang menginspirasi, menghibur, dan menggetarkan hati. Melalui layanan ini, kami menghadirkan kemudahan bagi Anda untuk memesan tiket dan menjadi bagian dari setiap momen yang tak
        terlupakan di bioskop.
      </p>
    </div>
  </header>

  <main>
    <p class="now">Now Playing</p>
    <!-- php array list film -->
    <?php
    $query = "SELECT * FROM film";
    $listfilm = read_rows($query);
    ?>

    <section class="listfilm">
      <?php foreach($listfilm as $film): ?>
        <article class="film">
          <img src="<?= $film["cover"]; ?>" alt="<?= $film["judul"]; ?>" class="cover" />
          <div class="isifilm">
            <p class="judul"><?= $film["judul"]; ?></p>
            <p class="genre"><?= $film["genre"]; ?></p>
            <p class="durasi"><?= "±" . $film["durasi"] . " Menit"; ?><br/>Tayang pukul <?= $film["jam_tayang"]; ?></p>
            <p class="deskripsi"><?= $film["deskripsi"]; ?></p>
            <p class="harga">Rp<?= number_format($film["harga"], 0, ',', '.'); ?></p>
          </div>
        </article>
      <?php endforeach; ?>
    </section>

    <!-- pesan sekarang -->
    <form action="formpesan.php" method="post">
      <div id="pesan">
        <button type="submit">Pesan Sekarang</button>
      </div>
    </form>
  </main>

  <footer></footer>
</body>

</html>