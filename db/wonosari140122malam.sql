-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2022 at 05:20 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

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
-- Table structure for table `jenis_user`
--

CREATE TABLE `jenis_user` (
  `id` int(11) NOT NULL,
  `jenis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_user`
--

INSERT INTO `jenis_user` (`id`, `jenis`) VALUES
(1, 'Admin Kalurahan'),
(2, 'Admin RT');

-- --------------------------------------------------------

--
-- Table structure for table `olah_usulan`
--

CREATE TABLE `olah_usulan` (
  `id` int(11) NOT NULL,
  `kode_usulan` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `ket` varchar(255) NOT NULL DEFAULT 'Dalam proses Verifikasi oleh Tim Kalurahan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `olah_usulan`
--

INSERT INTO `olah_usulan` (`id`, `kode_usulan`, `status`, `ket`) VALUES
(1, 1, 4, 'Obyek yang diusulkan bukan Kewenangan Pemerintah Kalurahan Wonosari'),
(2, 2, 2, 'Usulan Diterima'),
(3, 3, 2, 'Usulan Diterima'),
(4, 4, 2, 'usulan diterima'),
(5, 5, 2, 'Usulan DIterima'),
(6, 6, 2, 'Usulah Diterima'),
(7, 7, 3, 'perjelas jenis buku bacaanya di proposal'),
(8, 8, 3, 'perbaiki proposal'),
(9, 9, 4, 'danane mbahmu!');

-- --------------------------------------------------------

--
-- Table structure for table `padukuhan`
--

CREATE TABLE `padukuhan` (
  `id` int(11) NOT NULL,
  `padukuhan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `padukuhan`
--

INSERT INTO `padukuhan` (`id`, `padukuhan`) VALUES
(1, 'Madusari'),
(2, 'Ringinsari'),
(3, 'Purbosari'),
(4, 'Gadungsari'),
(5, 'Pandansari'),
(6, 'Tawarsari'),
(7, 'Jeruksari'),
(8, 'Wonosari');

-- --------------------------------------------------------

--
-- Table structure for table `rt`
--

CREATE TABLE `rt` (
  `id` int(11) NOT NULL,
  `rt` varchar(144) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rt`
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
(15, '015'),
(16, '-');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `jenis` int(11) NOT NULL,
  `kode_padukuhan` int(11) NOT NULL,
  `kode_rt` int(11) NOT NULL,
  `aktif` int(2) NOT NULL,
  `dibuat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `foto`, `jenis`, `kode_padukuhan`, `kode_rt`, `aktif`, `dibuat`) VALUES
(1, 'Ubaidilah Aminuddin Thoyieb', 'ateritori', '$2y$10$hSQMvqqgna9M5YkwmTzmjuTAfrxU/w4Uah9Yqdrm8OzmywMdkSrQ2', 'ate1.jpg', 1, 8, 16, 1, '14-01-2022 23:17:10'),
(2, 'Agus Priyono', 'madu001', '$2y$10$qCWtkcZ26WJQK.eywkxuN.YGYJv9V9rrce4k4pDyZ1oLfnHwFNbTK', 'cowo2.png', 2, 1, 1, 1, '14-01-2022 22:23:55'),
(3, 'Muhammad Ikhwan Dwi Santoso', 'ringin001', '$2y$10$mFX8JaUNYwW4cuL4/KAHsunyjmBdtAtf./0JKdFyJTojutHUuD3Nm', 'cowo1.png', 2, 2, 1, 1, '10/10/2021'),
(4, 'Luhut Binsar Pandjaitan', 'purbo001', '$2y$10$i4ynMXsWapmOSLa80OTiGeRGDoX3ngfCrmLX9BhIu5zXv15b2DdqC', 'luhut.jpg', 2, 3, 1, 1, '10/10/2021'),
(5, 'Kunti', 'gadung001', '$2y$10$OfpPTXuD8Tn8qe6aCqkPLuSPSwwAbIxhNixhHDso0uE7x3ZdVO/bW', 'cewe.png', 2, 4, 1, 1, '10/10/2021'),
(6, 'Wildan Maheswara', 'wildan123', '$2y$10$GAUlgmUU3FED1iXiLDczSe5M1MgiYZvlxoCb9uwsxIwuep8JedS7.', 'luhut1.jpg', 1, 6, 15, 1, '14-01-2022 14:45:44'),
(7, 'Intan Normawati', 'intan', '$2y$10$ugKfo1odPYbVdZipdEcVqebpqa4axmPITheyCtzqgHEj.vy9IUjVy', 'cewe1.png', 2, 6, 15, 1, '14-01-2022 20:50:51');

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(3, 1, 1),
(4, 1, 2),
(5, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
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
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `judul`, `url`, `icon`, `aktif`) VALUES
(1, 1, 'Proses Usulan', 'admin/index', 'fas fa-database', 1),
(2, 1, 'Manajemen User', 'admin/user', 'fas fa-user-plus', 1),
(3, 2, 'Input Usulan', 'user/index', 'fas fa-calendar-plus', 1),
(4, 2, 'Profil User', 'user/profil', 'fas fa-user-plus', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usulan`
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
  `aktif` int(11) DEFAULT 1,
  `status_verifikasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usulan`
--

INSERT INTO `usulan` (`id`, `masalah`, `potensi`, `usulan`, `jumlah`, `panjang`, `lebar`, `tinggi`, `biaya`, `file`, `user`, `aktif`, `status_verifikasi`) VALUES
(1, 'Terjadi genangan di Barat Pasar Argosari', 'Pasir & Semen', 'Pembuatan Selokan RT 1 (Belakang Lapangan Merdeka)', 1, 500, 2, 0, 500000000, 'pengantar_cetak_ulang_spt_pbb.docx', 2, 1, 0),
(2, 'Kurang pengetahuan marketing', 'IRT makanan olahan/UMKM', 'Pelatihan Pemasaran Online', 2, 0, 0, 0, 14500000, 'BERITA_ACARA_SIDANG_APBKAL_2022.docx', 2, 1, 0),
(3, 'Murid PAUD sedikit', 'Guru Berkelas', 'Sosialisasi Momong Bareng', 2, 0, 0, 0, 12500000, 'BERITA_ACARA_Muskal_RKP-Kalurahan_Wonosari_Tahun_2022.docx', 2, 1, 0),
(4, 'Ada warga yang kediamannya tidak layak huni', 'Swadaya/ Kerja Bakti', 'Stimulan Rehab Rumah Tidak Layak Huni', 1, 0, 0, 0, 100000000, 'CATATAN_MUSRENBANGKAL_2022.docx', 2, 1, 0),
(5, 'Banyak KK tidak punya Askes', 'pelayanan umum bagus', 'Fasilitasi Askes', 10, 0, 0, 0, 15000000, 'surat_pemulasaran_pemakaman_covid_rsud.docx', 2, 1, 0),
(6, 'Operasional Sanggar Seni belum maksimal', 'sanggar seni berjalan', 'Stimulan Operasional Sanggar Seni', 1, 0, 0, 0, 5000000, 'Rancangan_APBKal_2022__VERSI_1_WithPerpres104.pdf', 2, 1, 0),
(7, ' Kurangnya bahan bacaan di Pos Ronda ', 'Pos Ronda berjalan baik', 'Pengadaan Bahan Bacaan', 1, 10, 0, 0, 2500000, 'undangan_rasul_2021.docx', 2, 1, 0),
(8, 'insentif RT terlalu kecil', 'personil yang berdedikasi', 'Tambah insentif RT', 1, 0, 0, 0, 150000, 'Real_s_d_29_Des_21.pdf', 2, 1, 0),
(9, ' THR Pamong tidak dianggarkan', 'Pamong to the Best', 'Tambahan ADD Kabupaten', 1, 0, 0, 0, 200000000, 'CATATAN_MUSRENBANGKAL_20221.docx', 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_user`
--
ALTER TABLE `jenis_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `olah_usulan`
--
ALTER TABLE `olah_usulan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `padukuhan`
--
ALTER TABLE `padukuhan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rt`
--
ALTER TABLE `rt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usulan`
--
ALTER TABLE `usulan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_user`
--
ALTER TABLE `jenis_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `olah_usulan`
--
ALTER TABLE `olah_usulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `padukuhan`
--
ALTER TABLE `padukuhan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rt`
--
ALTER TABLE `rt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usulan`
--
ALTER TABLE `usulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
