<?php
session_start();
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // php Variabel
  $email = $_POST["email"];
  $password = $_POST["password"];
  // phppercabangan
  if ($email === "135@gmail.com" and $password === "135") {
    $_SESSION["email"] = $_POST["email"];
    header("location: T2-2-dashbord.php");
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
  <title>Login</title>
  <link rel="stylesheet" href="T2-1-logincss.css" />
</head>

<body>

  <div class="latar"></div>

  <div class="isi">
    <div class="kiri">
      <div class="sapa">
        <h2>Temukan Film Favoritmu <br />dan pesan tiket dengan mudah <br />kapan saja dan di mana saja</h2>
      </div>
      <div class="bagmer">
        <img src="coverFilm/bag mer.jpg" alt="" />
      </div>
    </div>

    <div class="kanan">
      <form action="" method="post">
        <p class="login">Login</p>
        <div class="inputemailpassword">
          <div class="email">
            <label for="email">Email</label><br />
            <input type="email" id="email" name="email" placeholder="124250135@example.com" />
          </div>
          <div class="password">
            <label for="password">Password</label><br />
            <input type="password" id="password" name="password" required />
          </div>

          <div class="pesanerror">
            <?php if ($error == true) { ?>
              <p style="color: #e50914; text-allign  left;"> Email atau Password Salah!</p>
            <?php } ?>
          </div>

          <button type="submit">Login</button>
        </div>
      </form>
    </div>



  </div>
</body>

</html>