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
    $insert_berhasil = mysqli_affected_rows($conn);

    // updayte data tersedia
    $query = "UPDATE tersedia SET
              status = '0'
              WHERE id_lab = '$id_lab' AND id_jam = '$id_jam'";

    mysqli_query($conn, $query);

    $delete_berhasil =  mysqli_affected_rows($conn);

    return $insert_berhasil + $delete_berhasil;
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
// function update_tersedia($data)
// {
//     global $conn;
//     $id_peminjaman = $data["id_peminjaman"];
//     $id_lab = $data["id_lab"];
//     $tanggal = $data["tanggal"];
//     $id_jam = $data["jam"];

//     $query = "UPDATE tersedia SET
//               status = '0'
//               WHERE id_lab = '$id_lab' AND id_jam = '$id_jam'";

//     mysqli_query($conn, $query);

//     return mysqli_affected_rows($conn);
// }

function delete($id_peminjaman)
{
    global $conn;
    // update tersedia
    // baca data peminjamanan
    $read_peminjaman = "SELECT * FROM peminjaman WHERE id_peminjaman = $id_peminjaman";
    $peminjaman = read_row($read_peminjaman);

    $id_lab_pinjam = $peminjaman["id_laboratorium"];
    $id_jam_pinjam = $peminjaman["id_jam"];

    $query = "UPDATE tersedia SET
              status = '1'
              WHERE id_lab = '$id_lab_pinjam' AND id_jam = '$id_jam_pinjam' ";
    mysqli_query($conn, $query);
    $update_berhasil =  mysqli_affected_rows($conn);

    // hapus data peminjaman
    $query = "DELETE FROM peminjaman WHERE id_peminjaman = '$id_peminjaman'";
    mysqli_query($conn, $query);
    $delete_berhasil =  mysqli_affected_rows($conn);
    return $update_berhasil + $delete_berhasil;
}

function read_tersedia()
{
    global $conn;
    $query = "SELECT tersedia.id_lab, jam.jam
            FROM tersedia
            JOIN jam ON tersedia.id_jam = jam.id_jam
            WHERE tersedia.status = '1'
            ORDER BY tersedia.id_lab, tersedia.id_jam";
    $data = mysqli_query($conn, $query);
    $data_tersedia = [];

    while ($row = mysqli_fetch_assoc($data)) {
        $id_lab = $row["id_lab"];
        $nama_lab = read_row("SELECT * FROM laboratorium WHERE id_laboratorium = '$id_lab'");
        $data_tersedia[$nama_lab["nama"]][] = $row["jam"];
    }

    return $data_tersedia;
}
