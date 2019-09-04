-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Set 04, 2019 alle 16:01
-- Versione del server: 10.4.6-MariaDB
-- Versione PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `s265542`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE `booking` (
  `user_email` varchar(100) NOT NULL,
  `slot` int(2) NOT NULL,
  `timestampB` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `booking`
--

INSERT INTO `booking` (`user_email`, `slot`, `timestampB`) VALUES
('a@p.it', 0, '2019-09-04 15:58:03'),
('a@p.it', 21, '2019-09-04 15:58:03'),
('a@p.it', 33, '2019-09-04 15:58:12'),
('a@p.it', 84, '2019-09-04 15:58:19'),
('b@p.it', 10, '2019-09-04 15:58:38'),
('b@p.it', 20, '2019-09-04 15:58:38'),
('b@p.it', 73, '2019-09-04 15:58:44'),
('c@p.it', 32, '2019-09-04 15:59:13'),
('c@p.it', 64, '2019-09-04 15:59:13'),
('c@p.it', 74, '2019-09-04 15:59:13');

-- --------------------------------------------------------

--
-- Struttura della tabella `email_password`
--

DROP TABLE IF EXISTS `email_password`;
CREATE TABLE `email_password` (
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `email_password`
--

INSERT INTO `email_password` (`user_email`, `user_password`) VALUES
('a@p.it', 'a04b161ab2e84fd02cec052343c6b2d5'),
('b@p.it', '520de810b803b99a62574cc403871741'),
('c@p.it', '9257a160604e9aff5694770f77a1f921');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
