-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Bulan Mei 2026 pada 14.00
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemesanan_tiket`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `genre` varchar(200) NOT NULL,
  `durasi` int(11) NOT NULL,
  `jam_tayang` varchar(10) NOT NULL,
  `deskripsi` varchar(200) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `film`
--

INSERT INTO `film` (`id`, `judul`, `genre`, `durasi`, `jam_tayang`, `deskripsi`, `harga`, `cover`) VALUES
(1, 'Goat', 'Animasi, Komedi, Keluarga, Olahraga', 100, '14:30 WIB', 'Will, kambing muda bertubuh kecil, bermimpi menjadi bintang Roarball di dunia yang didominasi hewan besar. Ia berjuang membuktikan diri dan mematahkan stereotip.', 80000, 'coverFilm/goat.jpg'),
(2, 'Jumbo', 'Animasi, Keluarga, Petualangan', 102, '11:00 WIB', 'Don, anak bertubuh besar yang sering diremehkan, membuktikan kemampuannya melalui pertunjukan bakat. Kisah hangat tentang kepercayaan diri dan persahabatan.', 60000, 'coverFilm/jumbo.jpg'),
(3, 'Rangga & Cinta', 'Romantis, Musikal, Remaja', 119, '15:45 WIB', 'Kisah cinta remaja SMA yang penuh puisi dan konflik perasaan, dikemas dengan sentuhan musikal modern. Nostalgia klasik dengan nuansa yang lebih segar.', 70000, 'coverFilm/rangga.png'),
(4, 'Five Nights at Freddys 2', 'Horor, Thriller', 110, '21:00 WIB', 'Teror animatronik kembali menghantui penjaga malam dengan misteri yang lebih gelap dan mencekam. Ketegangan meningkat saat rahasia lama perlahan terungkap.', 70000, 'coverFilm/five.png'),
(5, 'Sore: Istri dari Masa Depan', 'Romantis, Drama, Fantasi', 105, '19:00 WIB', 'Seorang wanita misterius dari masa depan datang sebagai istri seorang pria dan berusaha mengubah takdir hidupnya. Kisah romansa penuh emosi tentang pilihan, waktu, dan kesempatan kedua.', 65000, 'coverFilm/sore.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `film` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kursi` varchar(100) NOT NULL,
  `pembayaran` varchar(20) NOT NULL,
  `harga_tiket` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `nama`, `email`, `film`, `jumlah`, `kursi`, `pembayaran`, `harga_tiket`, `total_bayar`) VALUES
(31, 'musdalifah za', 'musdalifah@gmail.com', '2', 3, '2a', 'Cash', 60000, 180000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(15, 'musdalifah', 'musdalifah@gmail.com', '135');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
