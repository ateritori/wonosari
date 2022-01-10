-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jan 2022 pada 17.24
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wonosari`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_user`
--

CREATE TABLE `jenis_user` (
  `id` int(11) NOT NULL,
  `jenis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_user`
--

INSERT INTO `jenis_user` (`id`, `jenis`) VALUES
(1, 'Admin Kalurahan'),
(2, 'Admin RT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `olah_usulan`
--

CREATE TABLE `olah_usulan` (
  `id` int(11) NOT NULL,
  `kode_usulan` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `ket` varchar(255) NOT NULL DEFAULT 'Dalam proses Verifikasi oleh Tim Kalurahan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `olah_usulan`
--

INSERT INTO `olah_usulan` (`id`, `kode_usulan`, `status`, `ket`) VALUES
(1, 1, 1, 'Dalam proses Verifikasi oleh Tim Kalurahan'),
(2, 2, 1, 'Dalam proses Verifikasi oleh Tim Kalurahan'),
(4, 3, 1, 'Dalam proses Verifikasi oleh Tim Kalurahan'),
(5, 4, 1, 'Dalam proses Verifikasi oleh Tim Kalurahan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `padukuhan`
--

CREATE TABLE `padukuhan` (
  `id` int(11) NOT NULL,
  `padukuhan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `padukuhan`
--

INSERT INTO `padukuhan` (`id`, `padukuhan`) VALUES
(1, 'Madusari'),
(2, 'Ringinsari'),
(3, 'Purbosari'),
(4, 'Gadungsari'),
(5, 'Pandansari'),
(6, 'Tawarsari'),
(7, 'Jeruksari');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rt`
--

CREATE TABLE `rt` (
  `id` int(11) NOT NULL,
  `rt` varchar(144) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rt`
--

INSERT INTO `rt` (`id`, `rt`) VALUES
(1, '001'),
(2, '002'),
(3, '003'),
(4, '004'),
(5, '005'),
(6, '006'),
(7, '007'),
(8, '008'),
(9, '009'),
(10, '010'),
(11, '011'),
(12, '012'),
(13, '013'),
(14, '014'),
(15, '015');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'default-pp.svg',
  `jenis` int(11) NOT NULL,
  `kode_padukuhan` int(11) NOT NULL,
  `kode_rt` int(11) NOT NULL,
  `aktif` int(2) NOT NULL,
  `dibuat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `foto`, `jenis`, `kode_padukuhan`, `kode_rt`, `aktif`, `dibuat`) VALUES
(1, 'Ubaidilah Aminuddin Thoyieb', 'adminwno1', '$2y$10$qCWtkcZ26WJQK.eywkxuN.YGYJv9V9rrce4k4pDyZ1oLfnHwFNbTK', 'default-pp.svg', 1, 0, 0, 1, 0),
(2, 'Agus Priyono', 'madu001', '$2y$10$qCWtkcZ26WJQK.eywkxuN.YGYJv9V9rrce4k4pDyZ1oLfnHwFNbTK', 'default-pp.svg', 2, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Manajemen'),
(2, 'Data User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `aktif` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `judul`, `url`, `icon`, `aktif`) VALUES
(1, 1, 'Manajemen User', '/admin/m_user', 'fas fa-id-card-alt', 1),
(2, 2, 'Profil', '/user/index', 'fas fa-fw fa-id-card-alt', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `usulan`
--

CREATE TABLE `usulan` (
  `id` int(11) NOT NULL,
  `masalah` varchar(255) NOT NULL,
  `potensi` varchar(255) NOT NULL,
  `usulan` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `panjang` int(11) NOT NULL,
  `lebar` int(11) NOT NULL,
  `tinggi` int(11) NOT NULL,
  `biaya` int(11) NOT NULL,
  `file` varchar(255) NOT NULL DEFAULT 'proposal.doc',
  `user` int(11) NOT NULL,
  `aktif` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `usulan`
--

INSERT INTO `usulan` (`id`, `masalah`, `potensi`, `usulan`, `jumlah`, `panjang`, `lebar`, `tinggi`, `biaya`, `file`, `user`, `aktif`) VALUES
(1, 'Jalan Madusari rusak. Akses terganggu.', 'swadaya tenaga (kerja bakti)', 'Rehabilitasi aspal Jl. Madusari', 1, 300, 2, 1, 250000000, 'proposal.doc', 2, 1),
(2, 'Terjadi genanagan di Kompleks Pasar', 'Swadaya/ Kerja Bakti', 'Pembuatan Selokan RT 1 (Belakang Lapangan Merdeka)', 1, 500, 2, 0, 350000000, 'proposal.doc', 2, 1),
(3, 'Kurang pengetahuan marketing', 'IRT makanan olahan', 'Pelatihan Penjualan Online', 2, 0, 0, 0, 25000000, 'proposal.doc', 2, 1),
(4, 'Ada warga yang kediamannya tidak layak huni', 'kayu, genteng', 'Stimulan RTLH', 1, 0, 0, 0, 30000000, 'proposal.doc', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jenis_user`
--
ALTER TABLE `jenis_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `olah_usulan`
--
ALTER TABLE `olah_usulan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `padukuhan`
--
ALTER TABLE `padukuhan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rt`
--
ALTER TABLE `rt`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `usulan`
--
ALTER TABLE `usulan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jenis_user`
--
ALTER TABLE `jenis_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `olah_usulan`
--
ALTER TABLE `olah_usulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `padukuhan`
--
ALTER TABLE `padukuhan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `rt`
--
ALTER TABLE `rt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `usulan`
--
ALTER TABLE `usulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
