<?php
session_start();
require "function.php";

if (isset($_POST["buat_akun"])) {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (strlen($username) > 20) {
        $_SESSION["error_daftar"] = "Username tidak boleh lebih dari 20 karakter";
        header("location: register.php");
        exit();
    }
    if (strlen($password) < 6) {
        $_SESSION["error_daftar"] = "Password minimal terdiri dari 6 karakter";
        header("location: register.php");
        exit();
    }

    $query = "SELECT * FROM users";
    $data = read_rows($query);
    foreach ($data as $row):
        if ($email == $row["email"]) {
            $_SESSION["error_daftar"] = "Email tersebut telah terdaftar";
        } else if ($username == $row["username"]) {
            $_SESSION["error_daftar"] = "Username tersebut telah digunakan";
        }
    endforeach;
    if (!isset($_SESSION["error_daftar"])) {
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
    <form action="" method="POST" class="form">
        <label for="email">Email</label><br>
        <input type="email" name="email" require><br>
        <label for="username">Username</label><br>
        <input type="text" name="username" require><br>
        <label for="password">Password</label><br>
        <input type="text" name="password" require><br>
        <?php
        if (isset($_SESSION["error_daftar"])) {
        ?>
            <span><?= $_SESSION["error_daftar"] ?></span><br>
        <?php }
        unset($_SESSION["error_daftar"]); ?>

        <button type="submit" name="buat_akun"> buat akun</button><br>
        <span> sudah punya akun? <a href="login.php"> Login</a></span>
    </form>
</body>

</html>