-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2026 at 04:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_aspirasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `aspirasi`
--

CREATE TABLE `aspirasi` (
  `id_aspirasi` int(5) NOT NULL,
  `status` enum('menunggu','proses','selesai') NOT NULL DEFAULT 'menunggu',
  `id_pelaporan` int(5) NOT NULL,
  `feedback` varchar(100) NOT NULL,
  `tanggal_input` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aspirasi`
--

INSERT INTO `aspirasi` (`id_aspirasi`, `status`, `id_pelaporan`, `feedback`, `tanggal_input`) VALUES
(1, 'selesai', 1, 'Kursi sudah diganti dengan yang baru', '2026-03-22'),
(2, 'proses', 2, 'Sedang dikoordinasikan dengan petugas kebersihan', '2026-03-22'),
(3, 'proses', 3, 'Sedang dilakukan pengecekan bandwidth server', '2026-03-23'),
(4, 'selesai', 4, 'Net baru sudah dipasang kemarin sore', '2026-03-25'),
(5, 'menunggu', 5, 'Laporan akan disampaikan ke pengelola kantin', '2026-03-26'),
(6, 'selesai', 6, 'Obat sudah distok kembali pagi ini', '2026-03-27'),
(7, 'proses', 7, 'Pemasangan lampu dijadwalkan akhir pekan ini', '2026-03-28'),
(8, 'menunggu', 8, 'Daftar buku sedang dalam pengajuan pengadaan', '2026-03-28'),
(9, 'selesai', 9, 'Saluran air sudah dibersihkan total', '2026-03-29'),
(10, 'menunggu', 10, 'Akan ditindaklanjuti oleh tim kesiswaan', '2026-03-30');

-- --------------------------------------------------------

--
-- Table structure for table `input_aspirasi`
--

CREATE TABLE `input_aspirasi` (
  `id_pelaporan` int(5) NOT NULL,
  `nis` int(10) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `ket` varchar(50) NOT NULL,
  `tanggal_input` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `input_aspirasi`
--

INSERT INTO `input_aspirasi` (`id_pelaporan`, `nis`, `id_kategori`, `lokasi`, `ket`, `tanggal_input`) VALUES
(1, 1001, 2, 'Ruang X RPL 1', 'Kursi di barisan belakang patah satu unit', '2026-03-20'),
(2, 1003, 1, 'Taman Depan', 'Banyak sampah daun kering belum disapu', '2026-03-21'),
(3, 2005, 7, 'Lab Komputer 3', 'Koneksi internet lambat saat jam praktik', '2026-03-22'),
(4, 2002, 5, 'Gedung Olahraga', 'Net bulutangkis robek di bagian tengah', '2026-03-23'),
(5, 2004, 6, 'Kantin Sehat', 'Varian menu sayuran kurang banyak', '2026-03-24'),
(6, 2006, 9, 'Ruang UKS', 'Persediaan obat flu sedang kosong', '2026-03-25'),
(7, 2008, 3, 'Parkir Motor', 'Butuh tambahan lampu penerangan malam', '2026-03-26'),
(8, 2010, 8, 'Perpustakaan', 'Buku desain grafis tahun 2025 belum ada', '2026-03-27'),
(9, 2007, 10, 'Halaman Belakang', 'Saluran air tersumbat plastik', '2026-03-28'),
(10, 2009, 4, 'Gerbang Utama', 'Siswa sering bergerombol saat jam masuk', '2026-03-29');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `ket_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `ket_kategori`) VALUES
(1, 'Kebersihan'),
(2, 'Fasilitas Kelas'),
(3, 'Keamanan'),
(4, 'Kedisiplinan'),
(5, 'Sarana Olahraga'),
(6, 'Layanan Kantin'),
(7, 'Teknologi & IT'),
(8, 'Perpustakaan'),
(9, 'Kesehatan/UKS'),
(10, 'Lingkungan Hidup');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` int(10) NOT NULL,
  `kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `kelas`) VALUES
(1001, 'X RPL 1'),
(1002, 'X TKJ 3'),
(1003, 'XI MM 2'),
(1004, 'XI TJA 1'),
(1005, 'XII RPL 3'),
(1006, 'XII TKJ 2'),
(1007, 'X MM 1'),
(1008, 'XI TJA 3'),
(1009, 'XII RPL 1'),
(1010, 'XII MM 2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD PRIMARY KEY (`id_aspirasi`),
  ADD KEY `id_pelaporan` (`id_pelaporan`);

--
-- Indexes for table `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  ADD PRIMARY KEY (`id_pelaporan`),
  ADD KEY `nis` (`nis`,`id_kategori`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12348;

--
-- AUTO_INCREMENT for table `aspirasi`
--
ALTER TABLE `aspirasi`
  MODIFY `id_aspirasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  MODIFY `id_pelaporan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `nis` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1021;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD CONSTRAINT `aspirasi_ibfk_1` FOREIGN KEY (`id_pelaporan`) REFERENCES `input_aspirasi` (`id_pelaporan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
