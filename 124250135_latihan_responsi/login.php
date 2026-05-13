<?php
session_start();
require "functions.php";

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username = '$username'";
    if (read_row($query) > 0) {
        if ($password == read_row($query)["password"]) {
            $_SESSION["id_user"] = read_row($query)["id_user"];
            $_SESSION["username"] = $username;
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="wrap-masuk">
        <div class="masuk">
            <h2>LOGIN</h2>
            <p class="sapa">Selamat Datang Kembali</p>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class=" mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button name=" login">Masuk</button><br>
                <?php if (isset($_SESSION["error-login"])) { ?>
                    <span><?= $_SESSION["error-login"] ?></span><br>
                <?php }
                unset($_SESSION["error-login"]); ?>
                <span>Belum punya akun? <a href="Register.php"> Registrasi</a></span>
            </form>
        </div>
    </div>
</body>

</html>