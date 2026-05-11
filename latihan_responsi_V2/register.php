<?php
// TAMBAHANNNN
// cek kesamaan username

session_start();
require "functions.php";

if (isset($_POST["registrasi"])) {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (strlen($username) > 20) {
        $_SESSION["error_registrasi"] = "Username tidak boleh lebih dari 20 karakter";
        header("location: register.php");
        exit();
    } else if (strlen($password) < 6) {
        $_SESSION["error_registrasi"] = "Password minimal terdiri dari 6 katakter";
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
</head>

<body>
    <h1>REGISTER</h1>
    <h2>Mulai ajukan peminjaman lab</h2>
    <div class="form">
        <form action="" method="POST">
            <label for="email">Email</label><br>
            <input type="email" name="email"><br>
            <label for="username">Username</label><br>
            <input type="text" name="username"><br>
            <label for="password">Password</label><br>
            <input type="password" name="password"><br>
            <button name="registrasi">Buat Akun</button><br>
            <?php if (isset($_SESSION["error_registrasi"])) { ?>
                <span><?= $_SESSION["error_registrasi"] ?></span>
            <?php }
            unset($_SESSION["error_registrasi"]); ?>
            <span>Sudah punya akun? <a href="login.php"> Login</a></span>
        </form>
    </div>
</body>

</html>