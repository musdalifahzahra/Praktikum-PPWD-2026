<?php
$conn = mysqli_connect("localhost", "root", "", "pemesanan_tiket");

// READ
function read($query)
{
    global $conn;
    $data = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($data)) {
        $rows[] = $row;
    }
    return $rows;
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
