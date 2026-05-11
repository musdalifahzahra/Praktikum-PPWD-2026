<?php
// TAMBAHANNNN
// cek kesamaan username

session_start();
require "functions.php";

if (isset($_POST["registrasi"])) {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FORM users WHERE username = $username";
    if (read_row($query) > 0) {
        if ($password == read_row($query)["password"]) {
            $_SESSION["login"] = true;
            header("location: home.php");
            exit();
        } else {
            $_SESSION["error-login"] = "Password tidak valid";
            header("location: login.php");
        }
    } else {
        $_SESSION["error-login"] = "Username tidak ditemukan";
        header("location: login.php");
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>REGISTER</h1>
    <h2>Mulai ajukan peminjaman lab</h2>
    <div class="form">
        <form action="" method="POST">
            <label for="username">Username</label><br>
            <input type="text" name="username"><br>
            <label for="password">Password</label><br>
            <input type="password" name="password"><br>
            <button name="registrasi">Buat Akun</button><br>
            <?php if (isset($_SESSION["error_registrasi"])) { ?>
                <span><?= $_SESSION["error_registrasi"] ?></span>
            <?php }
            unset($_SESSION["error_registrasi"]); ?>
            <span>Belum punya akun? <a href="Registrasi.php"> Registrasi</a></span>
        </form>
    </div>
</body>

</html>