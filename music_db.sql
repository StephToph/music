-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2021 at 06:38 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `music_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `mu_album`
--

CREATE TABLE `mu_album` (
  `id` bigint(20) NOT NULL,
  `title` varchar(200) NOT NULL,
  `img_id` varchar(150) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mu_album`
--

INSERT INTO `mu_album` (`id`, `title`, `img_id`, `description`) VALUES
(1, 'Basic 2', 'assets/img/album/1635625714.jpg', 'hfgf jyf  jhg hg hg jhg jhgg hgh vcvcv vc vc vc vc vc nb '),
(2, 'Teacher', 'assets/img/album/1635625894.jpg', 'thdnd dkfh djf djhdf jjh eiue diue iu iueiudiu vd diuf diu fiu diiu dfiu dfiu ');

-- --------------------------------------------------------

--
-- Table structure for table `mu_artist`
--

CREATE TABLE `mu_artist` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `img_id` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mu_artist`
--

INSERT INTO `mu_artist` (`id`, `name`, `description`, `img_id`) VALUES
(1, 'adeagbo oluwatofunmi stephen', 'djfhjhdjhjde', 'assets/img/artist/1635620867.jpg'),
(2, 'Dead drop', 'jf hgh hgh jh jhghh hjhg jhjhdjhe ejrhjer ejer ejhrejhre jrhe r erjh e', 'assets/img/artist/1635621016.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mu_genre`
--

CREATE TABLE `mu_genre` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mu_genre`
--

INSERT INTO `mu_genre` (`id`, `name`) VALUES
(1, 'Gospel'),
(2, 'Hip Hops');

-- --------------------------------------------------------

--
-- Table structure for table `mu_track`
--

CREATE TABLE `mu_track` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `artist` varchar(150) NOT NULL,
  `album_status` varchar(20) NOT NULL DEFAULT '0',
  `album` varchar(100) DEFAULT NULL,
  `track` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `music_qr` text NOT NULL,
  `track_id` varchar(10) DEFAULT NULL,
  `date` datetime NOT NULL,
  `genre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mu_user`
--

CREATE TABLE `mu_user` (
  `id` int(11) NOT NULL,
  `username` varchar(39) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `last_log` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mu_user`
--

INSERT INTO `mu_user` (`id`, `username`, `email`, `password`, `last_log`, `status`) VALUES
(1, 'Admin', 'admin@mail.com', '21232f297a57a5a743894a0e4a801fc3', '2021-11-02 17:48:42', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mu_album`
--
ALTER TABLE `mu_album`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mu_artist`
--
ALTER TABLE `mu_artist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mu_genre`
--
ALTER TABLE `mu_genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mu_track`
--
ALTER TABLE `mu_track`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mu_user`
--
ALTER TABLE `mu_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mu_album`
--
ALTER TABLE `mu_album`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mu_artist`
--
ALTER TABLE `mu_artist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mu_genre`
--
ALTER TABLE `mu_genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mu_track`
--
ALTER TABLE `mu_track`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mu_user`
--
ALTER TABLE `mu_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
