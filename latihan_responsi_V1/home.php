<?php
session_start();
require "function.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body>
    <nav>
        <div class="kiri"><span>profile</span></div>
        <div class="kanan">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="riwayat.php">Riwayat</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <!-- search bar -->
    <section class="search-bar">
        <form action="">
            <input type="text" placeholder="Cari laboratorium" name="lab_cari">
            <select class="form-select" aria-label="Default select example" name="jam_cari">
                <option selected>Open this select menu</option>
                <option value="08:00">08:00</option>
                <option value="10:30">10:30</option>
                <option value="13:00">13:00</option>
                <option value="15:30">15:30</option>
            </select>
            <button type="submit" name="cari">Cari</button>
        </form>
    </section>

    <?php
    if (isset($_GET["cari"])) {
        $lab_cari = null;
        if (isset($_GET["lab_cari"])) $lab_cari = $_GET["lab_cari"];
        $jam_cari = null;
        if (isset($_GET["jam_cari"])) $jam_cari = $_GET["jam_cari"];

        $query_tersedia = "
            SELECT * FROM laboratorium 
            JOIN tersedia 
            ON tersedia.id_laboratorium=laboratorium.id_laboratorium
            WHERE (laboratorium.nama LIKE '%$lab_cari%' OR tersedia.jam LIKE '%$jam_cari%') AND tersedia.status = '1'
            ";
        $tersedia = read_rows($query_tersedia);
    } else {
        $query_tersedia = "
            SELECT * FROM laboratorium 
            JOIN tersedia 
            ON tersedia.id_laboratorium=laboratorium.id_laboratorium
            WHERE tersedia.status = '1'
            ";
        $tersedia = read_rows($query_tersedia);
    }
    ?>
    <!-- labor tersedia -->
    <h5>Laboratorium yang Tersedia Hari Ini</h5>
    <section class="" style="background-color: blue; display: flex; gap: 5px;">
        <?php
        foreach ($tersedia as $row):
        ?>
        <div class="satu-lab">
            <span><?= $row["nama"] ?></span>
            <div class="jam-tersedia">
                
            </div>
        </div>
        <?php endforeach; ?>




        <!-- HAPUS -->
        <?php
        $query_lab = "SELECT * FROM laboratorium";
        $tersedia = read_rows($query_lab);
        foreach ($tersedia as $row):
        ?>
            <div class="satu-lab" style="background-color: blanchedalmond;">
                <span><?= $row["nama"] ?></span><br>
                <?php
                $id_lab = $row["id_laboratorium"];
                $query_tersedia = "SELECT * FROM tersedia WHERE id_laboratorium = '$id_lab' AND status ='1'";
                $status = read_rows($query_tersedia);
                foreach ($status as $row):
                ?>
                    <span><?= $row["jam"] ?></span>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </section>

    <!-- labor pinjaman -->
    <h5>Ajuan Pinjaman Saat Ini</h5>
    <section class="" style="background-color: blue; display: flex; gap: 5px;">
        <?php
        $query_peminjaman = "SELECT * FROM peminjaman";
        $peminjaman = read_rows($query_peminjaman);
        foreach ($peminjaman as $row):
        ?>
            <div class="satu-lab" style="background-color: blanchedalmond;">
                <?php
                $id_lab = $row["id_laboratorium"];
                $query_lab = "SELECT * FROM laboratorium WHERE id = '$id_lab'";
                ?>
                <span><?= read_row($query_lab)["nama"] ?></span><br>
                <span><?= $row["tanggal"] . $row["jam"] ?></span><br>
                <span><?= $row["jam"] ?></span><br>
                <div class="aksi">
                    <a href="hapus.php">Hapus</a>
                    <a href="Edit.php">Edit</a>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</body>

</html>

$labs = [];

foreach ($rows as $row) {
    $id = $row['id_laboratorium'];

    // kalau lab belum ada, buat container
    if (!isset($labs[$id])) {
        $labs[$id] = [
            'id_laboratorium' => $id,
            'nama' => $row['nama'],
            'jam' => []
        ];
    }

    // masukin jam ke array
    $labs[$id]['jam'][] = $row['jam'];
}
[
  1 => [
    "id_laboratorium" => 1,
    "nama" => "Lab Kimia",
    "jam" => ["08:00", "10:00", "13:00"]
  ],
  2 => [
    "id_laboratorium" => 2,
    "nama" => "Lab Fisika",
    "jam" => ["09:00", "11:00"]
  ]
]
foreach ($labs as $lab) {
    echo "<div class='card'>";
    echo "<h3>{$lab['nama']}</h3>";

    foreach ($lab['jam'] as $j) {
        echo "<span class='badge'>$j</span> ";
    }

    echo "</div>";
}