-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 02. Okt 2020 um 15:36
-- Server-Version: 10.4.14-MariaDB
-- PHP-Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `m151_chatattack_db`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `from_user` int(11) DEFAULT NULL,
  `to_user` int(11) DEFAULT NULL,
  `msg` varchar(1023) DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `chat`
--

INSERT INTO `chat` (`id`, `time`, `from_user`, `to_user`, `msg`, `status`) VALUES
(2, '2020-10-01 14:55:25', 7, 2, 'sdsdsd', 1),
(3, '2020-10-01 14:55:27', 7, 2, 'sds', 1),
(4, '2020-10-01 14:55:30', 7, 2, 'sdsdsd', 1),
(5, '2020-10-01 14:55:41', 7, 5, 'dfdf', 1),
(6, '2020-10-01 14:55:58', 5, 6, 'dasdas', 1),
(7, '2020-10-01 14:56:22', 5, 4, 'gg', 0),
(8, '2020-10-01 15:02:16', 4, 5, 'log', 2),
(9, '2020-10-01 15:02:07', 4, 0, 'dsds', 2),
(10, '2020-10-01 15:06:00', 4, 2, 'test', 0),
(11, '2020-10-01 15:06:05', 2, 4, 'test', 1),
(12, '2020-10-01 15:06:12', 2, 4, 'test1', 2),
(13, '2020-10-01 15:06:17', 2, 0, 'test', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `username` varchar(63) NOT NULL,
  `credential` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `credential`, `role`, `last_activity`) VALUES
(2, 'testuser', 'x', 1, '2020-10-02 07:00:15'),
(5, 'vwetts@gmail.com', 'x', 1, '2020-10-01 14:56:12'),
(7, 'group', 'x', 1, '2020-10-01 15:01:24');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
