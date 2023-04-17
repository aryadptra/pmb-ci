-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2020 at 04:18 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app-pmbdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fakultas`
--

CREATE TABLE `tbl_fakultas` (
  `id` int(11) NOT NULL,
  `nama_fakultas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_fakultas`
--

INSERT INTO `tbl_fakultas` (`id`, `nama_fakultas`) VALUES
(21, 'Fakultas Teknik'),
(22, 'Fakultas Kedokteran'),
(23, 'Fakultas Ekonomi Dan Bisnis'),
(24, 'Fakultas Hukum'),
(25, 'Fakultas Farmasi'),
(26, 'Fakultas Psikologi'),
(27, 'Fakultas Ilmu Komputer'),
(28, 'Fakultas Kedokteran Gigi'),
(29, 'Fakultas Ilmu Keperawatan'),
(30, 'Fakultas Kesehatan Masyarakat'),
(31, 'Fakultas Ilmu Pengetahuan Budaya'),
(32, 'Fakultas Ilmu Sosial Dan Politik'),
(33, 'Fakultas Matematika Dan Ilmu Pengetahuan Alam');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_informasi`
--

CREATE TABLE `tbl_informasi` (
  `id` int(11) NOT NULL,
  `tgl_buka` date NOT NULL,
  `tgl_tutup` date NOT NULL,
  `tgl_pengumuman` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_informasi`
--

INSERT INTO `tbl_informasi` (`id`, `tgl_buka`, `tgl_tutup`, `tgl_pengumuman`) VALUES
(1, '2020-09-01', '2020-10-15', '2020-10-17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pendaftaran`
--

CREATE TABLE `tbl_pendaftaran` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fakultas_id` int(11) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `nomor_pendaftaran` int(11) NOT NULL,
  `nama_peserta` varchar(256) NOT NULL,
  `tempat_lahir` varchar(256) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(128) NOT NULL,
  `agama` varchar(128) NOT NULL,
  `no_hp` varchar(128) NOT NULL,
  `alamat_peserta` text NOT NULL,
  `nama_orangtua` varchar(256) NOT NULL,
  `pekerjaan_orangtua` varchar(256) NOT NULL,
  `no_hp_orangtua` varchar(128) NOT NULL,
  `nama_sekolah` varchar(256) NOT NULL,
  `tahun_lulus` int(11) NOT NULL,
  `alamat_sekolah` text NOT NULL,
  `foto` text NOT NULL,
  `berkas` text NOT NULL,
  `tahap_satu` varchar(128) NOT NULL,
  `tahap_dua` varchar(128) NOT NULL,
  `tahap_tiga` varchar(128) NOT NULL,
  `tanggal_pendaftaran` date NOT NULL,
  `status_pendaftaran` varchar(128) NOT NULL,
  `status_verifikasi` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pendaftaran`
--

INSERT INTO `tbl_pendaftaran` (`id`, `user_id`, `fakultas_id`, `prodi_id`, `nomor_pendaftaran`, `nama_peserta`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `no_hp`, `alamat_peserta`, `nama_orangtua`, `pekerjaan_orangtua`, `no_hp_orangtua`, `nama_sekolah`, `tahun_lulus`, `alamat_sekolah`, `foto`, `berkas`, `tahap_satu`, `tahap_dua`, `tahap_tiga`, `tanggal_pendaftaran`, `status_pendaftaran`, `status_verifikasi`, `created_at`, `updated_at`) VALUES
(3, 4, 27, 13, 200817001, 'LELAH MISHQUEN', 'PADANG', '2002-01-01', 'Laki-laki', 'Islam', '081123324556', 'Jl. Yang Dulu Pernah Ada, Sumatera Barat', 'PUDIN OROK', 'Pengusaha', '081287785665', 'SMA N 1 KENANGAN', 2020, 'Jl. Yang Berkelok, Sumatera Barat', '1599551059_3cb499d38d5dfcaaaecd.jpg', '1599551059_a16d8ed5b131efd4b44e.pdf', 'Selesai', 'Selesai', 'Selesai', '2020-09-08', 'Selesai', 'Lulus', '2020-09-04 11:08:52', '2020-09-08 21:40:04'),
(6, 6, 30, 18, 200817002, 'OTEWE KAYA', 'RUMAH DUKUN', '2002-08-14', 'Perempuan', 'Islam', '081334890990', 'Jln. Rusak yang belum diperbaiki. Jakarta', 'KACIMUIH BADARUAK', 'Pengangguran', '085211121314', 'SMA N 46 SENJA', 2020, 'Jln. Lurus yang banyak tikungan tajam, Jakarta', '1599578702_23f1ea711a12875f7988.jpg', '1599578702_1bfd48d5480edffaeec8.pdf', 'Selesai', 'Selesai', 'Selesai', '2020-09-08', 'Selesai', 'Tidak Lulus', '2020-09-08 19:57:30', '2020-09-08 21:39:50'),
(7, 7, 31, 19, 200817003, 'PENIKMAT SENJA', 'SEMESTA', '2002-08-17', 'Laki-laki', 'Islam', '087890904646', 'Jln. Penantiang Sepanjang Harapan Nan Jauh Disana', 'MENTARI PAGI', 'Pengganguran', '089977883465', 'SMA N 01 KENANGAN', 2020, 'Jln. Kenangan Bersamamu', '1602395116_1cf5513e7cbd7a60ef5b.jpg', '1602395116_af14878a4ee1181a2da2.pdf', 'Selesai', 'Selesai', 'Selesai', '2020-10-11', 'Selesai', 'Lulus', '2020-10-11 12:04:37', '2020-10-11 04:03:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prodi`
--

CREATE TABLE `tbl_prodi` (
  `id` int(11) NOT NULL,
  `fakultas_id` int(11) NOT NULL,
  `nama_prodi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_prodi`
--

INSERT INTO `tbl_prodi` (`id`, `fakultas_id`, `nama_prodi`) VALUES
(2, 21, 'Teknik Komputer'),
(3, 21, 'Teknik Mesin'),
(4, 21, 'Teknik Sipil'),
(5, 21, 'Teknik Elektro'),
(6, 22, 'Pendidikan Dokter '),
(7, 23, 'Akuntansi'),
(8, 23, 'Manajemen'),
(9, 24, 'Ilmu Hukum'),
(10, 25, 'Farmasi'),
(11, 26, 'Psikologi'),
(12, 27, 'Ilmu Komputer'),
(13, 27, 'Informatika'),
(14, 27, 'Sistem Informasi'),
(15, 28, 'Pendidikan Dokter Gigi'),
(16, 29, 'Ilmu Keperawatan'),
(17, 30, 'Gizi'),
(18, 30, 'Kesehatan Masyarakat'),
(19, 31, 'Ilmu Filsafat'),
(20, 31, 'Ilmu Perpustakaan'),
(21, 31, 'Ilmu Sejarah'),
(22, 31, 'Sastra Inggris'),
(23, 31, 'Sastra Jepang'),
(24, 32, 'Hubungan Internasional'),
(25, 32, 'Ilmu Komunikasi'),
(26, 32, 'Ilmu Politik'),
(27, 33, 'Matematika'),
(28, 33, 'Fisika'),
(29, 33, 'Biologi'),
(30, 33, 'Kimia'),
(31, 33, 'Geografi'),
(32, 33, 'Statistika'),
(33, 21, 'Teknik Lingkungan'),
(34, 21, 'Teknik Perkapalan'),
(36, 27, 'Menajemen Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `role_id`, `nama`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'BANG AMBO', 'admin-pmb@ba-university.ac.id', 'g3c2qQEPMVvJ3uuuDdtd5YaxV1H+WbD6r1UzcjQqxtf3JqYGdQD8emmBgneScdvFDFHWPNXfpWGKHenH+Or+uOIHC4OgJCbn1uNuf0kHtkum5fBDeV3fuQ==', '2020-09-03 09:04:07', '2020-09-03 09:04:07'),
(4, 2, 'LELAH MISHQUEN', 'lelahmishquen@gmail.com', 'lxIJDfm9wzmE2979+/CswKbxzQiJoJVwQZ5ra/n9MobBbFHVQ4dKK/mU0LGrq5aK3FZNUGKiKx9MdnaxIB1u8YoQBzuKvDidNeE/XKjAFnPEzhHo/c0Z7E0=', '2020-09-04 11:08:52', '2020-09-04 11:08:52'),
(6, 2, 'OTEWE KAYA', 'otewekaya@gmail.com', 'aZ+Isd/lpaTqKgRRDvQhCwLT7U1Fm6uC+gU9jNfFHhjM9Fuv2UH9JUeqtK0XfaoFEzDRZx7wCTQVDza6o21/yeXeGddaLzW0WdwooHlnfIxoeZo1kD6luvM=', '2020-09-08 19:57:30', '2020-09-08 19:57:30'),
(7, 2, 'PENIKMAT SENJA', 'penikmatsenja@gmail.com', 'dDTvCvTCZe7Ck/15l7H/K/hsA2BwMvTw5ISR2MdlL9x0s8IJKHVhkcNF+1QcU/BDwHKp6pGfK8k1o2blNJkVy1oUiRER2uRvW/DT54Ws/7v7MpfCxgM+SE4=', '2020-10-11 12:04:37', '2020-10-11 12:04:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_role`
--

CREATE TABLE `tbl_user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_role`
--

INSERT INTO `tbl_user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_fakultas`
--
ALTER TABLE `tbl_fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_informasi`
--
ALTER TABLE `tbl_informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pendaftaran`
--
ALTER TABLE `tbl_pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_prodi`
--
ALTER TABLE `tbl_prodi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fakultas_id` (`fakultas_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_fakultas`
--
ALTER TABLE `tbl_fakultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_informasi`
--
ALTER TABLE `tbl_informasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_pendaftaran`
--
ALTER TABLE `tbl_pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_prodi`
--
ALTER TABLE `tbl_prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_pendaftaran`
--
ALTER TABLE `tbl_pendaftaran`
  ADD CONSTRAINT `tbl_pendaftaran_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_prodi`
--
ALTER TABLE `tbl_prodi`
  ADD CONSTRAINT `tbl_prodi_ibfk_1` FOREIGN KEY (`fakultas_id`) REFERENCES `tbl_fakultas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tbl_user_role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
