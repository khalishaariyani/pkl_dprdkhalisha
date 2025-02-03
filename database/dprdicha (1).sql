-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2025 at 12:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dprdicha`
--

-- --------------------------------------------------------

--
-- Table structure for table `arsip`
--

CREATE TABLE `arsip` (
  `id_arsip` int(11) NOT NULL,
  `no_dokumen` varchar(50) NOT NULL,
  `jenis_dokumen` varchar(70) NOT NULL,
  `tgl_arsip` varchar(50) NOT NULL,
  `ket` text NOT NULL,
  `lampiran_dok` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arsip`
--

INSERT INTO `arsip` (`id_arsip`, `no_dokumen`, `jenis_dokumen`, `tgl_arsip`, `ket`, `lampiran_dok`) VALUES
(1, '8913891248', 'Rahasia', '2024-12-18', 'penting', 'SURAT_PERNYATAAN_PKL.pdf'),
(2, '12345', 'RAHASIA II', '2024-04-15', 'PENTING', 'SURAT PKL KHALISHA ARIYANI.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `dinas`
--

CREATE TABLE `dinas` (
  `id_dinas` int(11) NOT NULL,
  `id_karyawan` varchar(100) NOT NULL,
  `nama_dinas` varchar(100) NOT NULL,
  `tujuan_dinas` varchar(100) NOT NULL,
  `nama_rapat` varchar(100) NOT NULL,
  `tempat_rapat` varchar(100) NOT NULL,
  `tanggal_rapat` varchar(100) NOT NULL,
  `nama_pimpinan` varchar(100) NOT NULL,
  `jumlah_peserta` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dinas`
--

INSERT INTO `dinas` (`id_dinas`, `id_karyawan`, `nama_dinas`, `tujuan_dinas`, `nama_rapat`, `tempat_rapat`, `tanggal_rapat`, `nama_pimpinan`, `jumlah_peserta`, `status`) VALUES
(1, '1', 'Dinas Pariwisata', '-', 'Pembahasan Anggaran untuk Sektor Pariwisata', 'Ruangan PARIPURNA Lt.2, DPRD KOTA BANJARMASIN', '2024-08-15', 'H. HARRY WIJAYA, S.H., M.H.', '43', 'MENDESAK'),
(2, '2', 'Dinas Kehutanan', '-', 'Pembahasan Raperda tentang Pengelolaan dan Perlindungan Hutan', 'Ruangan PARIPURNA Lt.2, DPRD KOTA BANJARMASIN', '2024-06-07', 'H. HARRY WIJAYA, S.H., M.H.', '40', 'PENTING');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `nomor_agenda` varchar(255) NOT NULL,
  `judul_paripurna` varchar(150) NOT NULL,
  `tgl_waktu` varchar(150) NOT NULL,
  `tempat` varchar(150) NOT NULL,
  `agenda_paripurna` varchar(150) NOT NULL,
  `peserta` text NOT NULL,
  `status_agenda` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `nomor_agenda`, `judul_paripurna`, `tgl_waktu`, `tempat`, `agenda_paripurna`, `peserta`, `status_agenda`) VALUES
(1, '100.3.2/8/DPRD/IX/20', 'PENYELENGGARAAN TRANSPORTASI', '2024-08-15T22:05', 'RUANGAN PARIPURNA LT.2 , Gedung DPRD KOTA BANJARMASIN', 'Pembacaan dan Pengesahan Notula Rapat Sebelumnya', 'Seluruh Anggota dewan Terkait dan Dinas yang Sudah mengikuti rapat Sebelumnya', 'MENDESAK'),
(2, '100.3.2/8/DPRD/IX/15', 'PENYELENGGARAAN TRANSPORTASI Laut', '2023-11-14T13:20', 'RUANGAN PARIPURNA LT.2 , Gedung DPRD KOTA BANJARMASIN', 'Pembacaan dan Pengesahan Notula Rapat Sebelumnya', 'Seluruh Anggota dewan Terkait dan Dinas yang Sudah mengikuti rapat Sebelumnya', 'PENTING'),
(3, '100.3.2/10/DPRD/IX/2024', 'PENYELENGGARAAN UMKM KAL-SEL', '2024-06-04T12:22', 'RUANGAN PARIPURNA LT.2 , Gedung DPRD KOTA BANJARMASIN', 'Pembacaan dan Pengesahan Notula Rapat Sebelumnya', 'Dewan anggota terkait dan Dinas-dinas terkait', 'MENDESAK');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `departemen` varchar(100) NOT NULL,
  `tanggal_lahir` varchar(100) NOT NULL,
  `tanggal_bergabung` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `jabatan`, `departemen`, `tanggal_lahir`, `tanggal_bergabung`, `status`) VALUES
(1, 'Shopiah', 'Penata Tingkat 1', 'PERUNDANG UNDANGAN', '1995-06-12', '2018-07-17', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran`
--

CREATE TABLE `kehadiran` (
  `id_kehadiran` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_anggota` varchar(70) NOT NULL,
  `status_kehadiran` varchar(50) NOT NULL,
  `tgl_kehadiran` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kehadiran`
--

INSERT INTO `kehadiran` (`id_kehadiran`, `nama`, `no_anggota`, `status_kehadiran`, `tgl_kehadiran`) VALUES
(12, 'Khalisha Ariyani ', '2110010423', 'Hadir', '2024-04-15'),
(13, 'Shopiah', '2110010756', 'Hadir', '2024-04-15'),
(14, 'Amelia', '2110010384', 'Hadir', '2024-04-15'),
(15, 'Rida', '2110010798', 'Sakit', '2024-07-16');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id_profil` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id_profil`, `id`, `gambar`) VALUES
(1, 1, '../Profil/1_1730691037_OIP.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `raperda`
--

CREATE TABLE `raperda` (
  `id_raperda` int(11) NOT NULL,
  `nomor_raperda` varchar(200) NOT NULL,
  `tgl_masuk` varchar(30) NOT NULL,
  `status_raperda` varchar(50) NOT NULL,
  `pengusul` varchar(100) NOT NULL,
  `judul_raperda` varchar(255) NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `raperda`
--

INSERT INTO `raperda` (`id_raperda`, `nomor_raperda`, `tgl_masuk`, `status_raperda`, `pengusul`, `judul_raperda`, `catatan`) VALUES
(3, '100.3.2/8/DPRD/IX/20', '2025-02-12', 'MENDESAK', 'H. Harry Wijaya, S.H., M.H.', 'PENYELENGGARAAN TRANSPORTASI', 'Dirapatkan dengan dinas terkait'),
(6, '100.3.2/9/DPRD/IX/2024', '2024-04-15', 'PENTING', 'khalisha ariyani', 'PENYELENGGARAAN DANA JALAN DEWAN', 'RAPAT INRERNAL SUDAH SELESAI'),
(7, '100.3.2/10/DPRD/IX/2024', '2024-10-15', 'PENTING', 'NOOR AZIIJAH', 'PENYELENGGARAAN UMKM KAL-SEL', 'rapat di lakukan kembali sesuai dengan intruksi'),
(8, '100.3.2/10/DPRD/IX/2024', '2024-10-18', 'PENTING', 'HELMANI', 'PENYELENGGARAAN PERPINDAHAN IBU KOTA KAL-SEL', 'RAPAT SUDAH SELESAI'),
(9, '100.3.2/12/DPRD/IX/2024', '2024-12-12', 'PENTING', 'Amelia ', 'PENYELENGGARAAN DANA PARIWISATA KAL-SEL', 'RAPAT DILAKSANAKAN LAGI BULAN JANUARI 2025');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `email`, `password`, `level`) VALUES
(1, 'icha', 'icha', 'icha@gmail.com', '$2y$10$fbDr8WdClCYxm9BC73xxoOr0CHNsnnPwDRBrw0TiMzq5Y.J/ICiia', 'admin'),
(11, 'Test User', 'testuser', 'testuser@example.com', '$2y$10$RJ39O4jCYZETMJ0/4Il6GeJ.gy3q2S.H0A0G5DFnCuFA8SX4SZ.O.', 'ADMIN'),
(12, 'Test User', 'testuser', 'testuser@example.com', '$2y$10$KWaTAPngPliozKK9OjJjne0rGyS75wIJwqKCScvNkxJImJ2c/avvy', 'ADMIN'),
(13, 'Shopiah', 'piah', 'piah26522@gmail.com', '$2y$10$im8kuRb3oNb8Arq8WBVYMOo5rrKzgu5D73xH56Gqp6kT15ma4yWQK', 'pemohon'),
(15, 'muhammad syauqi', 'syauqi', 'syauqi123@gmail.com', '$2y$10$LOIlrTJs1owr8Exz2iARwO7Sko448tdBrvGaaJpDr.aVejhJIVDjS', 'anggota'),
(16, 'noor azijah', 'azijah', 'noorazijah22@guru.paud.belajar.id', '$2y$10$skcI0r2yYpYanaYseey41e.ZXDDaMoV4I2/fB29Au.K/dQxwHH47m', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`id_arsip`);

--
-- Indexes for table `dinas`
--
ALTER TABLE `dinas`
  ADD PRIMARY KEY (`id_dinas`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indexes for table `raperda`
--
ALTER TABLE `raperda`
  ADD PRIMARY KEY (`id_raperda`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arsip`
--
ALTER TABLE `arsip`
  MODIFY `id_arsip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dinas`
--
ALTER TABLE `dinas`
  MODIFY `id_dinas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kehadiran`
--
ALTER TABLE `kehadiran`
  MODIFY `id_kehadiran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `raperda`
--
ALTER TABLE `raperda`
  MODIFY `id_raperda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
