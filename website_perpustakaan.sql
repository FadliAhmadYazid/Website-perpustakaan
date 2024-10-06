-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2024 at 03:57 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website_perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `judul_buku` varchar(23) NOT NULL,
  `penulis` varchar(20) NOT NULL,
  `penerbit` varchar(18) NOT NULL,
  `tahun_terbit` int(4) NOT NULL,
  `file` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul_buku`, `penulis`, `penerbit`, `tahun_terbit`, `file`, `image`, `created_at`) VALUES
(15, 'Koala Kumal', 'Raditya Dika', 'Gagas Media', 2015, 'Raditya Dika - Koala Kumal-(IG@free_book12).pdf', 'faec1be246fa1293edfe1f58a104aded.jpg', '2024-06-12 02:36:07'),
(16, 'Milea, Suara dari Dilan', 'Pidi Baiq', 'Pastel Books', 2016, 'DILAN 3.pdf', 'Pidi-Baiq-Milea-suara-dari-dilan.jpg', '2024-06-12 02:40:47'),
(17, 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, 'Andrea_Hirata_Laskar_Pelangi.pdf', '10dc06814790d2159ade8a25ac61fa24.jpg', '2024-06-12 02:45:57'),
(18, 'Teman Tapi Menikah', 'Ayudia Bing Slamet', 'Elex Media K.', 2016, 'Teman_Tapi_Menikah.pdf', 'ayudia bing slamet teman tapi menikah.jpg', '2024-06-12 02:48:38'),
(19, 'Sword Art Online : UR', 'Reki Kawahara', 'ASCII Media', 2018, 'Sword Art Online_ Unital Ring I, Vol. 21.pdf', 'Sao.jpg', '2024-06-12 03:01:27'),
(20, 'Dua Garis Biru', 'Gina S. Noer', 'Gramedia P. U.', 2018, 'Dua Garis Biru.pdf', '5a7a032effdd28a9b0a0a879ea45a92e.jpg', '2024-06-12 03:06:52'),
(21, 'Solo Levelling II', 'Chu-Gong', 'Kakao Page', 2016, 'Solo Leveling.pdf', '2e2bfd374a630a027ae9dc3f138cf0f5.jpg', '2024-06-12 03:49:05'),
(22, 'Roman Kang Picisan', 'Qolan', 'Pesantrenpedia', 2016, 'Roman Picisan.pdf', '1704378025.jpg', '2024-06-12 03:53:36'),
(23, 'Boboiboy : Krisis P.T.', 'Nizam Razak', 'Animonsta Studios', 2016, 'Boboiboy.pdf', '1704123755.jpg', '2024-06-12 03:57:46');

-- --------------------------------------------------------

--
-- Table structure for table `saved_books`
--

CREATE TABLE `saved_books` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saved_books`
--

INSERT INTO `saved_books` (`id`, `user_id`, `book_id`) VALUES
(84, 18, 9),
(87, 18, 16),
(88, 18, 20),
(89, 18, 18);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `otoritas` enum('MEMBER','ADMIN') NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `otoritas`, `nama_lengkap`, `alamat`, `telepon`, `image`, `created_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', 'ADMIN', 'Administratorr', 'UPN Veteran Jawa Timur', '08970864932', 'Buku.png', '2024-06-05 00:08:10'),
(15, 'Dito', '22082010233@student.upnjatim.ac.id', 'dito1234', 'ADMIN', 'Ardhito Reynata', 'Rungkut Asri', '082139962799', 'Logo.png', '2024-06-05 00:08:10'),
(16, 'Agung', '22082010249@student.upnjatim.ac.id', 'agung2003', 'ADMIN', 'Agung Andhika Saputra', 'Gunung Anyar', '08123456789', '', '2024-06-05 00:08:10'),
(17, 'mbahman', '22082010228@student.upnjatim.ac.id', 'mbahman123', 'ADMIN', 'Alfan Dwi Cahya', 'Tropodo Indah', '08763213256', '', '2024-06-05 00:08:10'),
(18, 'Dyra', 'dytajanuartimarsa@gmail.com', 'dyra123', 'MEMBER', 'Dyta Januarti Marsa', 'Sidosermo Indah', '08768758798', '', '2024-06-05 00:08:10'),
(19, 'Satria', 'satriaramadhan@gmail.com', 'satria123', 'MEMBER', 'Muhammad Satria Ramadhan', 'Lidah Wetan', '08868859985', '', '2024-06-05 00:08:10'),
(20, 'Ariq', 'akhtarariq@gmail.com', 'ariq123', 'MEMBER', 'Akhtar Ariq', 'Pandugo Indah', '08123124521', '', '2024-06-05 00:08:10'),
(21, 'Hangg', 'naufalhanggara@gmail.com', 'hang123', 'MEMBER', 'Naufal Hanggara', 'Lidah Kulon', '089582364982', '', '2024-06-05 00:08:10'),
(27, 'vxsssd', 'hhdiah@gmail.com', 'dadada', 'MEMBER', 'dito reynataz', 'Rungkut', '08970865932', '', '2024-06-05 00:15:24'),
(28, 'saasa', 'ardhito.reynata@yahoo.com', 'assasa', 'ADMIN', 'dito reynataz12', 'amkdjak', '08970865932', '', '2024-06-05 00:21:56'),
(29, 'Yudi', 'yudilapas@gmail.com', 'yudi1234', 'MEMBER', 'Yudi Lapas', 'Banyuwangi', '08970865932', '', '2024-06-05 01:23:37'),
(30, 'Dika', 'dikakuasa@gmail.com', 'dika123', 'MEMBER', 'Dika', 'Gunung Anyar', '08873819619', '', '2024-06-05 20:37:05'),
(32, 'Bismillah', 'bismillah@gmail.com', 'bismillah', 'MEMBER', 'Bismillah', 'dasdas', '089708659325', '', '2024-06-06 00:30:56'),
(33, 'adminn', 'adminnn@gmail.com', 'adminn', 'ADMIN', 'Adminn', 'Rungkut', '08970865932', '', '2024-06-09 17:02:25'),
(34, 'tes', 'tes@gmail.com', 'tes123', 'MEMBER', 'Tess', 'Tes123', '1241412412', '', '2024-06-12 03:13:31'),
(35, 'fadli', 'fadli@gmail.com', 'fadli123', 'MEMBER', 'Fadli', 'Medan', '0812345678', '', '2024-10-05 20:30:37'),
(36, 'azri', 'azri@gmail.com', 'azri123', 'MEMBER', 'Azri', 'Banda Aceh', '0823456789', '', '2024-10-05 20:56:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved_books`
--
ALTER TABLE `saved_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `saved_books`
--
ALTER TABLE `saved_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
