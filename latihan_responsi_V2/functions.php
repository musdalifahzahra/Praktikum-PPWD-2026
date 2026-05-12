<?php
require "koneksi.php";

// MEMBACA DATABASE
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
function read_tersedia($filter)
{
    global $conn;
    if ($filter == 0) {
        $query = "SELECT tersedia.id_lab, jam.jam
            FROM tersedia
            JOIN jam ON tersedia.id_jam = jam.id_jam
            WHERE tersedia.status = '1'
            ORDER BY tersedia.id_lab, tersedia.id_jam";
    } else {

        $lab_cari = $filter["lab_cari"];
        $jam_cari =  $filter["jam_cari"];

        // cari id laboratorium
        $read_lab_cari = "SELECT * FROM laboratorium WHERE nama LIKE '%$lab_cari%'";
        $id_lab_tampil = read_row($read_lab_cari)["id_laboratorium"];

        if (!empty($lab_cari)  && !empty($jam_cari)) {
            $query = "SELECT tersedia.id_lab, jam.jam
            FROM tersedia
            JOIN jam ON tersedia.id_jam = jam.id_jam
            WHERE 
            tersedia.id_lab = '$id_lab_tampil' AND
            tersedia.status = '1' 
            AND
            jam.id_jam = '$jam_cari'
            ORDER BY tersedia.id_lab, tersedia.id_jam";
        } else if (!empty($lab_cari)) {
            $query = "SELECT tersedia.id_lab, jam.jam
            FROM tersedia
            JOIN jam ON tersedia.id_jam = jam.id_jam
            WHERE 
            tersedia.id_lab = '$id_lab_tampil' AND
            tersedia.status = '1' 
            -- AND
            -- jam.id_jam = '$jam_cari'
            ORDER BY tersedia.id_lab, tersedia.id_jam";
        } else if (!empty($jam_cari)) {
            $query = "SELECT tersedia.id_lab, jam.jam
            FROM tersedia
            JOIN jam ON tersedia.id_jam = jam.id_jam
            WHERE 
            -- tersedia.id_lab = '$id_lab_tampil' AND
            tersedia.status = '1' 
            AND
            jam.id_jam = '$jam_cari'
            ORDER BY tersedia.id_lab, tersedia.id_jam";
        }
    }

    $data = mysqli_query($conn, $query);
    $data_tersedia = [];

    while ($row = mysqli_fetch_assoc($data)) {
        $id_lab = $row["id_lab"];
        $nama_lab = read_row("SELECT * FROM laboratorium WHERE id_laboratorium = '$id_lab'");
        $data_tersedia[$nama_lab["nama"]][] = $row["jam"];
    }

    return $data_tersedia;
}

// MEMBUAT / MEMASUKAN DATA
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

    // input peminjaman ke tabel peminjaman
    $query = "INSERT INTO peminjaman
              VALUES ('', '$id_lab', '$tanggal', '$id_jam')";
    mysqli_query($conn, $query);
    $insert_peminjaman = mysqli_affected_rows($conn);

    // input tabel riwayat
    $query = "INSERT INTO riwayat
              VALUES ('', '$id_lab', '$tanggal', '$id_jam')";
    mysqli_query($conn, $query);
    $insert_riwayat = mysqli_affected_rows($conn);

    // updayte tabel tersedia
    $query = "UPDATE tersedia SET
              status = '0'
              WHERE id_lab = '$id_lab' AND id_jam = '$id_jam'";
    mysqli_query($conn, $query);

    $update_tersedia =  mysqli_affected_rows($conn);

    return $insert_peminjaman + $insert_riwayat + $update_tersedia;
}

// UPDATE DATA
function update_peminjaman_ketersediaan($data)
{
    global $conn;
    $id_lab = $data["id_lab"];
    $id_jam = $data["jam"];

    // cek data lab yg mw dipinjam tersedia enggak
    $read_tersedia = "SELECT * FROM tersedia 
                      WHERE id_lab = '$id_lab' AND id_jam ='$id_jam'";
    $tersedia = read_row($read_tersedia);

    if ($tersedia["status"] == '1') {
        $ubah_peminjaman = '1';
    } else {
        $ubah_peminjaman = '0';
    }
    return $ubah_peminjaman;
}
function update_peminjaman($data)
{
    global $conn;
    $id_peminjaman = $data["id_peminjaman"];
    $lab_sesudah = $data["id_lab"];
    $tanggal = $data["tanggal"];
    $jam_sesudah = $data["jam"];
    // 1. update tersedia
    // 1.1 baca data peminjaman sesui id biar tau sebelumnya dy minjam apa
    $read_peminjaman = "SELECT * FROM peminjaman WHERE id_peminjaman = '$id_peminjaman'";
    $lab_sebelum = read_row($read_peminjaman)["id_laboratorium"];
    $jam_sebelum = read_row($read_peminjaman)["id_jam"];

    // 1.2 update tersedia yg sebelumnya
    $query_tersedia = "UPDATE tersedia SET
                       status = '1'
                       WHERE id_lab = '$lab_sebelum' AND id_jam = '$jam_sebelum'";
    mysqli_query($conn, $query_tersedia);
    // 1.3 update tersedia setelah di ubah
    $query_tersedia = "UPDATE tersedia SET
                       status = '0'
                       WHERE id_lab = '$lab_sesudah' AND id_jam = '$jam_sesudah'";
    mysqli_query($conn, $query_tersedia);

    // 2. update card peminjaman
    $query = "UPDATE peminjaman SET
              id_laboratorium= '$lab_sesudah',
              tanggal= '$tanggal',
              id_jam= '$jam_sesudah'

              WHERE id_peminjaman = '$id_peminjaman'";

    mysqli_query($conn, $query);

    // 2. update data riwayat
    $query = "UPDATE riwayat SET
              id_laboratorium= '$lab_sesudah',
              tanggal= '$tanggal',
              id_jam= '$jam_sesudah'

              WHERE id_riwayat = '$id_peminjaman'";

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
