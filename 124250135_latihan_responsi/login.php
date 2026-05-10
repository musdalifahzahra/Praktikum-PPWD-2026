<?php
session_start();
require "function.php";

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $query = "SELECT * FROM users WHERE username ='$username'";
    $data = read_row($query);

    if ($data != null) {
        if ($password == $data["password"]) {
            $_SESSION["login"] = true;
            header("location: home.php");
            exit();
        } else {
            $_SESSION["error_login"] = "Username atau Password salah";
        }
    } else {
        $_SESSION["error_login"] = "Username atau Password salah";
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
    <form action="" method="post">
        <label for="username">Username</label><br>
        <input type="text" name="username"><br>
        <label for="password">Password</label><br>
        <input type="text" name="password"><br>
        <?php
        if (isset($_SESSION["error_login"])) {
        ?>
            <span><?= $_SESSION["error_login"] ?></span><br>
        <?php }
        unset($_SESSION["error_login"]);
        ?>
        <button type="submit" name="login"> Login</button><br>
        <span> Belum punya akun? <a href="register.php"> Registrasi</a></span>
    </form>
</body>

</html>