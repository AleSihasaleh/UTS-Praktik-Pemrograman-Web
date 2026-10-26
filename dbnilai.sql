-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Okt 2026 pada 16.35
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
-- Database: `dbnilai`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `nim` char(10) NOT NULL,
  `nm_lengkap` varchar(100) NOT NULL,
  `nilai_akhir` decimal(5,2) NOT NULL,
  `nilai_huruf` char(1) NOT NULL,
  `predikat` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`nim`, `nm_lengkap`, `nilai_akhir`, `nilai_huruf`, `predikat`, `created_date`, `modified_date`, `file_path`) VALUES
('', '', 0.00, '', '', '2026-10-13 05:55:56', '2026-10-13 05:55:56', NULL),
('3202416001', 'A', 80.00, 'A', 'Sangat Memuaskan', '2026-10-15 07:26:26', '2026-10-15 07:28:44', NULL),
('3202416002', 'B', 70.00, 'B', 'Memuaskan', '2026-10-15 07:28:10', '2026-10-15 07:28:18', NULL),
('3202416003', 'C', 60.00, 'C', 'Cukup Memuaskan', '2026-10-15 07:28:38', '2026-10-15 07:28:38', NULL),
('3202416004', 'D', 50.00, 'D', 'Kurang Memuaskan', '2026-10-15 07:32:02', '2026-10-15 07:32:02', NULL),
('3202416005', 'Aa', 85.00, 'A', 'Sangat Memuaskan', '2026-10-26 15:31:28', '2026-10-26 15:31:28', NULL),
('3202416006', 'Bb', 75.00, 'B', 'Memuaskan', '2026-10-26 15:31:44', '2026-10-26 15:31:44', NULL),
('3202416007', 'Cc', 65.00, 'C', 'Cukup Memuaskan', '2026-10-26 15:32:02', '2026-10-26 15:32:02', NULL),
('3202416008', 'Dd', 55.00, 'D', 'Kurang Memuaskan', '2026-10-26 15:33:08', '2026-10-26 15:33:08', NULL),
('3202416009', 'Kosong', 0.00, 'E', 'Tidak Lulus', '2026-10-26 15:33:33', '2026-10-26 15:33:33', NULL),
('3202416115', 'Muhammad Ale Sihasaleh', 88.00, 'A', 'Sangat Memuaskan', '2026-10-13 08:26:31', '2026-10-26 15:23:29', 'img/046cfa27d9d71625e3d9fc6a4ad1f641.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_photo`
--

CREATE TABLE `nilai_photo` (
  `nim` char(10) NOT NULL,
  `photo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai_photo`
--

INSERT INTO `nilai_photo` (`nim`, `photo_id`) VALUES
('3202416115', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `path_file` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `photo`
--

INSERT INTO `photo` (`id`, `nama_file`, `path_file`, `uploaded_at`) VALUES
(1, 'denah_lantai1_2_cetak_A4_later.png', 'img/046cfa27d9d71625e3d9fc6a4ad1f641.png', '2026-10-20 06:48:26'),
(2, 'RobloxScreenShot20260411_110244631.png', 'img/28d9a93d482c47130332655dac225b41.png', '2026-10-26 15:18:51'),
(3, 'RobloxScreenShot20260411_110312895.png', 'img/e3ecbe5b9e2c7e3253b9d27aa0615ebd.png', '2026-10-26 15:19:16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `nilai_photo`
--
ALTER TABLE `nilai_photo`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
