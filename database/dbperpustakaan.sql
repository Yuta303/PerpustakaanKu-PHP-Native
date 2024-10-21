-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Okt 2024 pada 14.53
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbperpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_anggota`
--

CREATE TABLE `db_anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `nomor_telepon` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tanggal_daftar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `db_anggota`
--

INSERT INTO `db_anggota` (`id_anggota`, `nama_anggota`, `alamat`, `jenis_kelamin`, `nomor_telepon`, `email`, `tanggal_daftar`) VALUES
(1, 'Yudi Ardiansya', 'Kota Tangerang', 'L', '089810203005', 'yudi22@gmail.com', '2024-08-14 15:25:32'),
(2, 'Zaki', 'Bekasi Barat', 'L', '085870034956', 'zaki899@gmail.com', '2024-08-14 15:24:55'),
(4, 'Yulianti', 'Jakarta Barat', 'P', '08389774023', 'yuli444@gmail.com', '2024-08-14 15:31:24'),
(5, 'Nita', 'Bogor', 'P', '081388881411', 'nita786@gmail.com', '2024-08-14 15:31:24'),
(6, 'Rian Saputra', 'Jakarta Utara', 'L', '082130092000', 'riansaputra35@gmail.com', '2024-08-14 15:31:24'),
(7, 'Agung', 'Bandung', 'L', '083856490655', 'agung333@gmail.com', '2024-08-14 16:10:45'),
(9, 'Vemas', 'Depok', 'L', '083856490655', 'vemas123@gmail.com', '2024-10-13 13:56:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_buku`
--

CREATE TABLE `db_buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(50) NOT NULL,
  `penulis_buku` varchar(20) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `db_buku`
--

INSERT INTO `db_buku` (`id_buku`, `judul_buku`, `penulis_buku`, `penerbit`, `tahun_terbit`, `date`) VALUES
(1, 'Bumi', 'Tere Liye', 'SABAKGRIP', '2014', '2024-08-12 16:44:49'),
(2, 'Bulan', 'Tere Liye', 'SABAKGRIP', '2015', '2024-08-12 16:45:36'),
(3, 'Matahari', 'Tere Liye', 'SABAKGRIP', '2016', '2024-08-12 16:46:20'),
(4, 'Bintang', 'Tere Liye', 'SABAKGRIP', '2017', '2024-08-12 16:46:54'),
(5, 'Ceros dan Batozar', 'Tere Liye', 'SABAKGRIP', '2018', '2024-08-12 16:48:23'),
(6, 'Komet', 'Tere Liye', 'SABAKGRIP', '2018', '2024-08-12 16:48:23'),
(8, 'Rasa ', 'Tere Liye', 'SABAKGRIP', '2022', '2024-08-14 16:40:45'),
(9, 'Laut Bercerita', 'Leila s. chudori', 'KPG', '2017', '2024-08-15 15:16:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_peminjaman`
--

CREATE TABLE `transaksi_peminjaman` (
  `id_transaksi` int(11) NOT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('dipinjam','dikembalikan','terlambat') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_peminjaman`
--

INSERT INTO `transaksi_peminjaman` (`id_transaksi`, `id_buku`, `id_anggota`, `tanggal_pinjam`, `tanggal_kembali`, `status`) VALUES
(1, 1, 7, '2024-08-15', '2024-09-15', 'dipinjam'),
(2, 4, 6, '2024-08-15', '2024-08-31', 'dipinjam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `create_at`) VALUES
(1, 'Fauzan', 'Fauzan343', '2024-08-12 10:30:06');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `db_anggota`
--
ALTER TABLE `db_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `db_buku`
--
ALTER TABLE `db_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `transaksi_peminjaman`
--
ALTER TABLE `transaksi_peminjaman`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `db_anggota`
--
ALTER TABLE `db_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `db_buku`
--
ALTER TABLE `db_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `transaksi_peminjaman`
--
ALTER TABLE `transaksi_peminjaman`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transaksi_peminjaman`
--
ALTER TABLE `transaksi_peminjaman`
  ADD CONSTRAINT `transaksi_peminjaman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `db_anggota` (`id_anggota`),
  ADD CONSTRAINT `transaksi_peminjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `db_buku` (`id_buku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
