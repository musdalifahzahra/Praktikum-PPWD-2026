<?php
session_start();
require "functions.php";
$_SESSION["registrasi"] = false;
$cara_registrasi = 1;
if (isset($_GET["login"])) {
  $cara_registrasi = $_GET["login"];
}

$error = false;
$email_terpakai = false;
$username_terpakai = false;

// baca tabel users
$read_users = "SELECT * FROM users";
$users = read($read_users);

// registrasi dengan Login
if ($cara_registrasi == 2 && (isset($_POST["registrasi"]))) {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  foreach ($users as $row):
    if ($email == $row["email"] && $username == $row["username"]) {
      $_SESSION["registrasi"] = true;
      $_SESSION["username"] = $username;
      header("location: dashbord.php");
      exit();
    }
  endforeach;
  $error = true;
}

// registrasi dengan SignUp
else if (isset($_POST["registrasi"])) {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  foreach ($users as $row):
    if ($email == $row["email"]) {
      $email_terpakai = true;
    } else if ($username == $row["username"]) {
      $username_terpakai = true;
    }
  endforeach;

  if (!$email_terpakai && !$username_terpakai) {
    if (insert_users($_POST) > 0) {
      $_SESSION["registrasi"] = true;
      $_SESSION["username"] = $username;
      header("location: dashbord.php");
      exit();
    }
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="registercss.css" />
</head>

<body>
  <div class="latar"></div>
  <!-- kiri -->
  <div class="isi">
    <div class="kiri">
      <div class="sapa">
        <h2>Temukan Film Favoritmu <br />dan pesan tiket dengan mudah <br />kapan saja dan di mana saja</h2>
      </div>
      <div class="bagmer">
        <img src="coverFilm/bag mer.jpg" alt="" />
      </div>
    </div>
    <!-- kanan -->
    <div class="kanan">
      <form action="" method="POST">
        <p class="login">Registrasi</p>
        <div class="inputemailpassword">
          <div class="username">
            <label for="username">username</label><br />
            <input type="username" id="username" name="username" />
          </div>
          <div class="email">
            <label for="email">Email</label><br />
            <input type="email" id="email" name="email" placeholder="124250135@gmail.com" />
          </div>
          <div class="password">
            <label for="password">Password</label><br />
            <input type="password" id="password" name="password" required />
          </div>

          <div class="pesanerror">
            <?php if ($error == true) { ?>
              <p style="color: #e50914; text-align : right;"> Email atau Password Salah!</p>
            <?php } else if ($email_terpakai == true) { ?>
              <p style="color: #e50914; text-align : right;"> Email tersebut telah terdaftar </p>
            <?php } else if ($username_terpakai == true) { ?>
              <p style="color: #e50914; text-align : right;"> username tersebut telah digunakan </p>
            <?php } ?>
          </div>

          <?php if ($cara_registrasi == 1) { ?>
            <button type="submit" name="registrasi">Sign Up</button><br>
            <span style="text-align: center;">Have an Account? <a href="register.php?login=2">Login</a></span>

          <?php } else { ?>
            <button type="submit" name="registrasi">Login</button><br>
            <span style="text-align: center;">Haven't an Account? <a href="register.php?login=1">Sign Up</a></span>
          <?php } ?>

        </div>
      </form>
    </div>
  </div>
</body>

</html>