<?php
session_start();
require "functions.php";
$_SESSION["registrasi"] = false;
$registrasi = 1; // 1=signUp, 2=logIn
if (isset($_GET["registrasi"])) {
  $registrasi = $_GET["registrasi"];
}

$error = false;
$email_terpakai = false;
$username_terpakai = false;

// baca tabel users
$read_users = "SELECT * FROM users";
$users = read_rows($read_users);

// registrasi dengan Login
if ($registrasi == 2 && (isset($_POST["registrasi"]))) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  foreach ($users as $row):
    if ($username == $row["username"] && $password == $row["password"]) {
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
      header("location: register.php?registrasi=2");
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
        <?php if ($registrasi == 1) { ?>
          <p class="login">Registrasi</p>
        <?php } else { ?>
          <p class="login">Login</p>
        <?php } ?>
        <div class="inputemailpassword">

          <div class="username">
            <label for="username">Username</label><br />
            <input type="username" id="username" name="username" required />
          </div>
          <div class="email" <?php if ($registrasi != 1) echo "hidden"; ?>>
            <label for="email">Email</label><br />
            <input type="email" id="email" name="email" placeholder="example@gmail.com" />
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

          <?php if ($registrasi == 1) { ?>
            <button type="submit" name="registrasi">Sign Up</button><br>
            <span style="display: flex; justify-content:center; margin-top:5px">Have an Account? <a href="register.php?registrasi=2"> Login</a></span>

          <?php } else { ?>
            <button type="submit" name="registrasi">Login</button><br>
            <span style="display: flex; justify-content:center; margin-top:5px">Haven't an Account? <a href="register.php?registrasi=1"> Sign Up</a></span>
          <?php } ?>

        </div>
      </form>
    </div>
  </div>
</body>

</html>