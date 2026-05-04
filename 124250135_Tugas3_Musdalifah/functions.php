<?php
$conn = mysqli_connect("localhost", "root", "", "pemesanan_tiket");

// SELECT
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

// INSERT
function insert_users($data)
{
    global $conn;
    $username = htmlspecialchars($data["username"]);
    $email = htmlspecialchars($data["email"]);
    $password = htmlspecialchars($data["password"]);

    $query = "INSERT INTO users
              VALUES
              ('', '$username', '$email', '$password')
              ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function insert_pesanan($data)
{
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);

    $id_film = htmlspecialchars($data["film"]);
    $film = read_row("SELECT * FROM film WHERE id = $id_film");
    $hargatiket = $film["harga"];

    $jumlahtiket = htmlspecialchars($data["jumlahtiket"]);
    $kursi = htmlspecialchars($data["pilihkursi"]);
    $pilihbayar = htmlspecialchars($data["pilihbayar"]);
    $totalbayar = $jumlahtiket * $hargatiket;

    $query = "INSERT INTO pesanan
              VALUES
              ('', '$nama', '$email', '$id_film', '$jumlahtiket', '$kursi', '$pilihbayar', '$hargatiket', '$totalbayar')
              ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function update_pesanan($data)
{
    global $conn;
    $id_pesanan = htmlspecialchars($data["id_pesanan"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);

    $id_film = htmlspecialchars($data["film"]);
    $film = read_row("SELECT * FROM film WHERE id = $id_film");
    $hargatiket = $film["harga"];

    $jumlahtiket = htmlspecialchars($data["jumlahtiket"]);
    $kursi = htmlspecialchars($data["pilihkursi"]);
    $pilihbayar = htmlspecialchars($data["pilihbayar"]);
    $totalbayar = $jumlahtiket * $hargatiket;

    $query = "UPDATE pesanan
              SET
              nama = '$nama',
              email = '$email',
              film = '$id_film',
              jumlah = '$jumlahtiket',
              kursi = '$kursi',
              pembayaran = '$pilihbayar',
              harga_tiket = '$hargatiket',
              total_bayar = '$totalbayar'
              WHERE id = $id_pesanan
              ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// DELETE
function delete($id_pesanan)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM pesanan WHERE id = $id_pesanan");
    return mysqli_affected_rows($conn);
}
