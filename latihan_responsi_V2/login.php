<?php
session_start();
require "functions.php";

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username = '$username'";
    if (read_row($query) > 0) {
        if ($password == read_row($query)["password"]) {
            $_SESSION["login"] = true;
            header("location: home.php");
            exit();
        } else {
            $_SESSION["error-login"] = "Password tidak valid";
            header("location: login.php");
            exit();
        }
    } else {
        $_SESSION["error-login"] = "Username tidak ditemukan";
        header("location: login.php");
        exit();
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
    <h1>LOGIN</h1>
    <h2>Selamat Datang Kembali</h2>
    <div class="form">
        <form action="" method="POST">
            <label for="username">Username</label><br>
            <input type="text" name="username" required><br>
            <label for="password">Password</label><br>
            <input type="password" name="password" required><br>
            <button name="login">Masuk</button><br>
            <?php if (isset($_SESSION["error-login"])) { ?>
                <span><?= $_SESSION["error-login"] ?></span><br>
            <?php }
            unset($_SESSION["error-login"]); ?>
            <span>Belum punya akun? <a href="Register.php"> Registrasi</a></span>
        </form>
    </div>
</body>

</html>