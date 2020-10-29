-- phpMyAdmin SQL Dump
-- version 4.9.6
-- https://www.phpmyadmin.net/
--
-- Host: mysql27j16.db.hostpoint.internal
-- Erstellungszeit: 29. Okt 2020 um 15:40
-- Server-Version: 10.3.25-MariaDB-log
-- PHP-Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `xucatoni_chatattack`
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
(54, '2020-10-15 08:53:06', 2, 7, 'hi', 1),
(55, '2020-10-15 08:55:57', 2, 0, 'dasd', 1),
(56, '2020-10-15 09:01:58', 5, 0, 'hi', 1),
(57, '2020-10-15 09:16:00', 2, 5, 'dsd', 1),
(58, '2020-10-15 09:16:10', 2, 5, 'sad', 1);

--
-- Trigger `chat`
--
DELIMITER $$
CREATE TRIGGER `trigger_chat_log` AFTER INSERT ON `chat` FOR EACH ROW INSERT INTO `log` (`time`, `from_user_name`, `to_user_name`, `msg`) 
SELECT * FROM
   (SELECT chat.time as time
FROM chat
ORDER BY chat.time DESC 
LIMIT 1) as time_select
,
    (SELECT user.username AS from_user
FROM chat 
INNER JOIN user 
ON chat.from_user=user.id 
ORDER BY chat.time DESC 
LIMIT 1) as from_user_select
    ,
    (SELECT user.username as to_user
FROM chat 
INNER JOIN user 
ON chat.to_user=user.id 
ORDER BY chat.time DESC 
LIMIT 1) as to_user_select
	,
   (SELECT chat.msg as msg
FROM chat
ORDER BY chat.time DESC 
LIMIT 1) as msg_select
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `from_user_name` varchar(63) COLLATE utf8mb4_bin NOT NULL,
  `to_user_name` varchar(63) COLLATE utf8mb4_bin NOT NULL,
  `msg` varchar(1023) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Daten für Tabelle `log`
--

INSERT INTO `log` (`id`, `time`, `from_user_name`, `to_user_name`, `msg`) VALUES
(12, '2020-10-15 08:53:06', 'testuser', 'group', 'hi'),
(13, '2020-10-15 08:55:57', 'testuser', 'group', 'dasd'),
(14, '2020-10-15 09:01:58', 'vwetts@gmail.com', 'group', 'hi'),
(15, '2020-10-15 09:16:00', 'testuser', 'vwetts@gmail.com', 'dsd'),
(16, '2020-10-15 09:16:10', 'testuser', 'vwetts@gmail.com', 'sad');

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
(0, 'group', 'x', 1, '2020-10-15 08:55:45'),
(2, 'testuser', 'x', 1, '2020-10-19 06:55:42'),
(5, 'vwetts@gmail.com', 'x', 1, '2020-10-29 10:31:19'),
(8, 'testuser02', 'x', 0, '2020-10-15 09:06:01');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `log`
--
ALTER TABLE `log`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT für Tabelle `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
