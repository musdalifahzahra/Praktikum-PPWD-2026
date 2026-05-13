<?php
session_start();
require "functions.php";

if (isset($_POST["registrasi"])) {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $read_user = "SELECT * FROM users";
    $user = read_rows($read_user);

    foreach ($user as $row) {
        if ($email == $row["email"]) {
            $_SESSION["error_registrasi"] = "Email telah terdaftar";
            header("location: register.php");
            exit();
        } else if ($username == $row["username"]) {
            $_SESSION["error_registrasi"] = "Username telah digunakan";
            header("location: register.php");
            exit();
        }
    }

    if (strlen($username) > 20) {
        $_SESSION["error_registrasi"] = "Username tidak boleh lebih dari 20 karakter!";
        header("location: register.php");
        exit();
    } else if (strlen($password) < 6) {
        $_SESSION["error_registrasi"] = "Password minimal terdiri dari 6 karakter!";
        header("location: register.php");
        exit();
    } else {
        if (create_user($_POST) > 0) {
            header("location: login.php");
            exit();
        }
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
            <h2>REGISTER</h2>
            <p class="sapa">Mulai ajukan peminjaman lab</p>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username"">
            </div>
            <div class=" mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"">
            </div>

            <button name=" registrasi">Buat Akun</button><br>
                    <?php if (isset($_SESSION["error_registrasi"])) { ?>
                        <span><?= $_SESSION["error_registrasi"] ?></span>
                    <?php }
                    unset($_SESSION["error_registrasi"]); ?>
                    <span>Sudah punya akun? <a href="login.php"> Login</a></span>
            </form>
        </div>
    </div>
</body>

</html>