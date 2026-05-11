<?php
require "koneksi.php";

function read_rows($query)
{
    global $conn;
    $data = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($data)) {
        $rows[] = $row;
    }
    return $rows;
}

function read_row($query)
{
    global $conn;
    $data = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($data);
    return $row;
}


function create_user($data)
{
    global $conn;
    $email = $data["email"];
    $username = $data["username"];
    $password = $data["password"];

    $query = "INSERT INTO users 
              VALUES ('', '$email', '$username', '$password')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
