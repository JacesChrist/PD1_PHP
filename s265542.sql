-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Set 03, 2019 alle 17:02
-- Versione del server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `s265542`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `user_email` varchar(100) COLLATE utf16_bin NOT NULL,
  `slot` int(2) NOT NULL,
  `timestampB` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dump dei dati per la tabella `booking`
--

INSERT INTO `booking` (`user_email`, `slot`, `timestampB`) VALUES
('a@p.it', 0, '2019-09-03 16:27:32'),
('b@p.it', 10, '2019-09-03 16:28:06'),
('b@p.it', 20, '2019-09-03 16:28:06'),
('a@p.it', 21, '2019-09-03 16:27:32'),
('c@p.it', 32, '2019-09-03 16:28:30'),
('a@p.it', 33, '2019-09-03 16:27:43'),
('c@p.it', 64, '2019-09-03 16:28:39'),
('b@p.it', 73, '2019-09-03 16:28:14'),
('c@p.it', 74, '2019-09-03 16:28:39'),
('a@p.it', 84, '2019-09-03 16:27:52');

-- --------------------------------------------------------

--
-- Struttura della tabella `email_password`
--

DROP TABLE IF EXISTS `email_password`;
CREATE TABLE IF NOT EXISTS `email_password` (
  `user_email` varchar(100) COLLATE utf16_bin NOT NULL,
  `user_password` varchar(100) COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dump dei dati per la tabella `email_password`
--

INSERT INTO `email_password` (`user_email`, `user_password`) VALUES
('a@p.it', 'a04b161ab2e84fd02cec052343c6b2d5'),
('b@p.it', '520de810b803b99a62574cc403871741'),
('c@p.it', '9257a160604e9aff5694770f77a1f921');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
 ADD PRIMARY KEY (`slot`);

--
-- Indexes for table `email_password`
--
ALTER TABLE `email_password`
 ADD PRIMARY KEY (`user_email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
