-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2024 at 03:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyek_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `simpan_resep`
--

CREATE TABLE `simpan_resep` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `resep_id` int(11) NOT NULL,
  `tanggal_simpan` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unggah_resep`
--

CREATE TABLE `unggah_resep` (
  `id` int(11) NOT NULL,
  `nama_resep` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `bahan_bahan` text NOT NULL,
  `langkah_langkah` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_approved` tinyint(1) DEFAULT 0,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unggah_resep`
--

INSERT INTO `unggah_resep` (`id`, `nama_resep`, `kategori`, `bahan_bahan`, `langkah_langkah`, `gambar`, `created_at`, `is_approved`, `username`) VALUES
(14, 'Kangkung Enak', 'makanan', '-1 ikat kangkung, bersihkan dan siangi- Udang sedikit\r\n- 1/2 bawang bombai, iris\r\n- 2 siung bawang putih, cincang\r\n- 1/2 buah tomat- Saus tiram secukupnya\r\n- Kaldu jamur secukupnya\r\n- Garam dan gula secukupnya\r\n- Air\r\n', '1 Tumis bawang putih dan bawang bombai sampai harum. Masukkan kangkung dan beri sedikit air. Aduk rata.\r\n2. tambahkan saus tiram, kaldu jamur, gula dan garam secukupnya. Aduk lagi.\r\n3. Masukkan udang dan tomat. Aduk rata. Masak hingga kangkung layu dan matang.\r\n4. Koreksi rasa, angkat dan sajikan.\r\n', 'kangkung.jpg', '2024-06-28 12:37:41', 0, 'Rifdah123');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `foto_profil` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `username`, `email`, `password`, `role`, `created_at`, `foto_profil`) VALUES
(2, 'syifa hadju', 'syifa321', 'syifa@gmail.com', '28837281b2d831d53ddb0db63e3bb9fe', 'admin', '2024-06-23 15:49:11', '22-220182_report-abuse-boss-baby-cute-face.png'),
(12, 'Rifdah Pritama Saputri', 'Rifdah123', 'Rifdah@gmail.com', 'ab2c37187fd7ab0c424a9968d4c868ae', 'user', '2024-06-28 12:36:17', '—Pngtree—karakter perempuan memakai atribut baju_8310523.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `simpan_resep`
--
ALTER TABLE `simpan_resep`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resep_id` (`resep_id`);

--
-- Indexes for table `unggah_resep`
--
ALTER TABLE `unggah_resep`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `simpan_resep`
--
ALTER TABLE `simpan_resep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unggah_resep`
--
ALTER TABLE `unggah_resep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `simpan_resep`
--
ALTER TABLE `simpan_resep`
  ADD CONSTRAINT `fk_resep_id` FOREIGN KEY (`resep_id`) REFERENCES `resep` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `unggah_resep`
--
ALTER TABLE `unggah_resep`
  ADD CONSTRAINT `unggah_resep_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
