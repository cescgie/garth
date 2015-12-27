-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 27. Dez 2015 um 01:18
-- Server-Version: 5.6.24
-- PHP-Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `astrid`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) NOT NULL,
  `state` int(1) NOT NULL DEFAULT '0',
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `admin`
--

INSERT INTO `admin` (`id`, `state`, `username`, `email`, `password`, `last_login`) VALUES
(1, 1, 'web5', NULL, 'sha256:1000:Vg1kBIXpYsoRRFYebYfikTSiGL8TuaHl:cl+ta', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `keywords` varchar(2555) COLLATE latin1_general_ci DEFAULT NULL,
  `description` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `kategorie_id` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Daten für Tabelle `albums`
--

INSERT INTO `albums` (`id`, `name`, `keywords`, `description`, `kategorie_id`) VALUES
(1, 'architektur1', NULL, NULL, 1),
(2, 'architektur2', NULL, NULL, 1),
(3, 'weit-weg', NULL, NULL, 2),
(4, 'nah-dran', NULL, NULL, 2),
(5, 'luftbilder1', NULL, NULL, 3),
(6, 'luftbilder2', NULL, NULL, 3),
(7, 'portrait', NULL, NULL, 4),
(8, 'on-location', NULL, NULL, 4),
(9, 'kirchenkonzerte', NULL, NULL, 5),
(10, 'luminate', NULL, NULL, 5),
(11, 'moewenstudie', NULL, NULL, 6),
(12, 'in-concert', NULL, NULL, 6),
(13, 'drinks', NULL, NULL, 7),
(14, 'katalog', NULL, NULL, 7),
(15, 'borneo', NULL, NULL, 8);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(111) NOT NULL,
  `reihenfolge` int(111) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `album` varchar(50) DEFAULT NULL,
  `album_id` int(111) DEFAULT NULL,
  `kategorie` varchar(50) DEFAULT NULL,
  `kategorie_id` int(111) DEFAULT NULL,
  `size` bigint(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategories`
--

CREATE TABLE IF NOT EXISTS `kategories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Daten für Tabelle `kategories`
--

INSERT INTO `kategories` (`id`, `name`) VALUES
(1, 'architektur'),
(2, 'landschaft'),
(3, 'luftbilder'),
(4, 'menschen'),
(5, 'reportage'),
(6, 'specials'),
(7, 'stills'),
(8, 'reise');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `kategories`
--
ALTER TABLE `kategories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT für Tabelle `images`
--
ALTER TABLE `images`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT für Tabelle `kategories`
--
ALTER TABLE `kategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
