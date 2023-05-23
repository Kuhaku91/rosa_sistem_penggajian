-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 23 Bulan Mei 2023 pada 08.20
-- Versi server: 8.0.30
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penggajian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_jabatan`
--

CREATE TABLE `data_jabatan` (
  `id_jabatan` int NOT NULL,
  `nama_jabatan` varchar(120) NOT NULL,
  `gaji_pokok` varchar(50) NOT NULL,
  `tj_transport` varchar(50) NOT NULL,
  `uang_makan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `data_jabatan`
--

INSERT INTO `data_jabatan` (`id_jabatan`, `nama_jabatan`, `gaji_pokok`, `tj_transport`, `uang_makan`) VALUES
(1, 'HRD', '4000000', '600000', '400000'),
(2, 'Staff Marketing', '2500000', '300000', '200000'),
(3, 'Admin', '2200000', '300000', '200000'),
(4, 'Sales', '2500000', '300000', '200000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kehadiran`
--

CREATE TABLE `data_kehadiran` (
  `id_kehadiran` int NOT NULL,
  `bulan` varchar(15) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `hadir` int NOT NULL,
  `sakit` int NOT NULL,
  `alpha` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `data_kehadiran`
--

INSERT INTO `data_kehadiran` (`id_kehadiran`, `bulan`, `nik`, `nama_pegawai`, `jenis_kelamin`, `nama_jabatan`, `hadir`, `sakit`, `alpha`) VALUES
(1, '012021', '0987654321', 'Dodi', 'Laki-Laki', 'Staff Marketing', 24, 0, 0),
(2, '012021', '123456789', 'Fauzi', 'Laki-Laki', 'Admin', 22, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pegawai`
--

CREATE TABLE `data_pegawai` (
  `id_pegawai` int NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(32) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `hak_akses` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `data_pegawai`
--

INSERT INTO `data_pegawai` (`id_pegawai`, `nik`, `nama_pegawai`, `username`, `password`, `jenis_kelamin`, `jabatan`, `tanggal_masuk`, `status`, `photo`, `hak_akses`) VALUES
(1, '123456789', 'Fauzi', 'fauzi', '0bd9897bf12294ce35fdc0e21065c8a7', 'Laki-Laki', 'Admin', '2020-12-26', 'Karyawan Tetap', 'pegawai-210101-a7ca89f5fc.png', 1),
(2, '0987654321', 'Dodi', 'dodi', 'dc82a0e0107a31ba5d137a47ab09a26b', 'Laki-Laki', 'Staff Marketing', '2021-01-02', 'Karyawan Tidak Tetap', 'pegawai-210101-9847084dc8.png', 2),
(3, '35720727080001', 'rosa', 'rosa', '84109ae4b4178430b8174b1dfef9162b', 'Perempuan', 'Admin', '2023-05-18', 'Karyawan Tetap', 'pegawai-230523-fc9c3741e8.jpg', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id` int NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `hak_akses` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `hak_akses`
--

INSERT INTO `hak_akses` (`id`, `keterangan`, `hak_akses`) VALUES
(1, 'admin', 1),
(2, 'pegawai', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `potongan_gaji`
--

CREATE TABLE `potongan_gaji` (
  `id` int NOT NULL,
  `potongan` varchar(120) NOT NULL,
  `jml_potongan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `potongan_gaji`
--

INSERT INTO `potongan_gaji` (`id`, `potongan`, `jml_potongan`) VALUES
(1, 'Alpha', 100000),
(2, 'Sakit', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_jabatan`
--
ALTER TABLE `data_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`);

--
-- Indeks untuk tabel `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `potongan_gaji`
--
ALTER TABLE `potongan_gaji`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_jabatan`
--
ALTER TABLE `data_jabatan`
  MODIFY `id_jabatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  MODIFY `id_kehadiran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `data_pegawai`
--
ALTER TABLE `data_pegawai`
  MODIFY `id_pegawai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `potongan_gaji`
--
ALTER TABLE `potongan_gaji`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
