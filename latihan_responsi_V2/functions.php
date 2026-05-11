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

function create_peminjaman($data)
{
    global $conn;
    $id_lab = $data["id_lab"];
    $tanggal = $data["tanggal"];
    $id_jam = $data["jam"];

    $query = "INSERT INTO peminjaman
              VALUES ('', '$id_lab', '$tanggal', '$id_jam')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function update_peminjaman($data)
{
    global $conn;
    $id_peminjaman = $data["id_peminjaman"];
    $id_lab = $data["id_lab"];
    $tanggal = $data["tanggal"];
    $id_jam = $data["jam"];

    $query = "UPDATE peminjaman SET
              id_laboratorium= '$id_lab',
              tanggal= '$tanggal',
              id_jam= '$id_jam'

              WHERE id_peminjaman = '$id_peminjaman'";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function delete($query)
{
    global $conn;
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}