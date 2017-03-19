-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Hostiteľ: localhost
-- Čas generovania: Št 02.Mar 2017, 16:16
-- Verzia serveru: 5.7.17-0ubuntu0.16.04.1
-- Verzia PHP: 7.0.15-0ubuntu0.16.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `cviko2`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tabulka`
--

CREATE TABLE `tabulka` (
  `riadok` int(11) NOT NULL,
  `stlpec` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `tabulka`
--

INSERT INTO `tabulka` (`riadok`, `stlpec`) VALUES
(0, 0),
(2, 3),
(2, 7),
(2, 8),
(2, 10),
(3, 12),
(4, 2),
(4, 4),
(5, 6),
(5, 7),
(5, 9),
(6, 9),
(7, 12),
(7, 13),
(9, 1),
(9, 4),
(9, 6);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `tabulka`
--
ALTER TABLE `tabulka`
  ADD UNIQUE KEY `riadok` (`riadok`,`stlpec`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
