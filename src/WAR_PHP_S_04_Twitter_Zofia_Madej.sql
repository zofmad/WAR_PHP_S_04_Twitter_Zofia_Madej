-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 30 Lip 2016, 17:59
-- Wersja serwera: 5.5.50-0ubuntu0.14.04.1
-- Wersja PHP: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `WAR_PHP_S_04_Twitter_Zofia_Madej`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Comment`
--

CREATE TABLE IF NOT EXISTS `Comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tweet_id` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `tweet_id` (`tweet_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Zrzut danych tabeli `Comment`
--

INSERT INTO `Comment` (`id`, `user_id`, `tweet_id`, `creation_date`, `text`) VALUES
(1, 14, 1, '2016-07-22 10:38:14', 'komentarz'),
(3, 14, 3, '2016-07-22 10:42:03', 'komentarz'),
(8, 14, 1, '2016-07-22 11:27:07', 'komentarz1'),
(11, 14, 1, '2016-07-22 11:30:11', 'komentarz1'),
(12, 14, 1, '2016-07-22 11:34:31', 'komentarz1'),
(13, 14, 1, '2016-07-22 11:35:33', 'komentarz1'),
(14, 14, 1, '2016-07-22 11:35:40', 'komentarz1'),
(15, 14, 1, '2016-07-22 11:36:05', 'komentarz1'),
(16, 14, 1, '2016-07-22 11:37:14', 'komentarz1'),
(17, 14, 1, '2016-07-22 11:38:22', 'komentarz1'),
(18, 14, 1, '2016-07-22 11:48:00', 'komentarz1'),
(19, 14, 1, '2016-07-22 11:48:33', 'komentarz1'),
(20, 14, 1, '2016-07-22 12:10:07', 'komentarz1'),
(22, 14, 12, '2016-07-22 12:12:01', 'komentarz1'),
(23, 14, 12, '2016-07-22 12:14:07', 'komentarz1'),
(24, 14, 12, '2016-07-22 12:14:08', 'komentarz1'),
(25, 14, 12, '2016-07-22 12:14:12', 'komentarz1'),
(26, 14, 12, '2016-07-22 12:19:15', 'komentarz1'),
(27, 14, 12, '2016-07-22 12:19:19', 'komentarz1'),
(28, 14, 12, '2016-07-22 12:19:59', 'komentarz1'),
(29, 14, 12, '2016-07-22 12:20:16', 'komentarz1'),
(30, 14, 12, '2016-07-22 12:20:22', 'komentarz1'),
(31, 14, 12, '2016-07-22 12:21:15', 'komentarz1'),
(32, 14, 12, '2016-07-22 12:39:41', 'komentarz1'),
(33, 14, 1, '2016-07-22 15:06:02', 'KOMENTARZ'),
(41, 14, 1, '2016-07-22 18:13:40', 'komentarz'),
(46, 14, 1, '2016-07-22 18:31:20', 'zosia2'),
(47, 14, 1, '2016-07-22 18:31:32', 'nowy komentarz'),
(48, 14, 1, '2016-07-22 21:24:19', 'komentarz2'),
(49, 14, 1, '2016-07-22 21:24:41', 'new comment'),
(50, 14, 1, '2016-07-22 21:32:38', 'nowy'),
(51, 14, 1, '2016-07-22 21:42:36', '111'),
(52, 14, 1, '2016-07-23 16:55:20', 'nowy'),
(53, 14, 1, '2016-07-25 21:47:55', 'komentarz'),
(54, 25, 28, '2016-07-30 15:29:18', 'Nowy komentarz'),
(55, 25, 28, '2016-07-30 15:41:02', 'Nowy komentarz'),
(56, 25, 28, '2016-07-30 15:46:27', 'Nowy komentarz'),
(57, 25, 28, '2016-07-30 15:51:45', 'Nowy komentarz');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Message`
--

CREATE TABLE IF NOT EXISTS `Message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message_text` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `is_read` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Zrzut danych tabeli `Message`
--

INSERT INTO `Message` (`id`, `sender_id`, `receiver_id`, `message_text`, `creation_date`, `is_read`) VALUES
(1, 13, 14, 'tekst2', '2016-07-23 22:22:49', 1),
(2, 13, 14, 'tekst', '2016-07-23 21:36:37', 1),
(3, 13, 14, 'tekst', '2016-07-23 21:37:20', 1),
(5, 13, 14, 'wiadomosc', '2016-07-24 18:55:13', 1),
(6, 14, 13, 'wiado\\', '2016-07-24 18:57:46', 0),
(7, 14, 13, 'wiad2', '2016-07-24 19:02:43', 0),
(8, 14, 13, 'wiadomosc', '2016-07-24 19:03:15', 0),
(9, 14, 13, 'wiadomosc', '2016-07-24 19:03:27', 0),
(10, 14, 13, 'wiadomosc', '2016-07-24 19:03:48', 1),
(11, 14, 13, 'wiad', '2016-07-24 19:04:10', 0),
(12, 14, 13, 'wiad', '2016-07-24 19:05:25', 0),
(13, 14, 13, 'wiadomosc', '2016-07-24 19:08:40', 1),
(14, 14, 13, 'wiad', '2016-07-24 19:11:44', 0),
(15, 14, 13, 'd', '2016-07-24 19:12:26', 1),
(16, 14, 13, 'wiad', '2016-07-25 21:47:24', 0),
(17, 14, 13, 'wiad', '2016-07-25 21:51:40', 0),
(18, 14, 3, 'wiadomosc', '2016-07-26 16:58:45', 0),
(19, 14, 3, 'wiadomosc', '2016-07-26 17:03:08', 0),
(20, 23, 3, 'tekst wiadomosci', '2016-07-29 23:52:30', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Tweet`
--

CREATE TABLE IF NOT EXISTS `Tweet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `text` varchar(140) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Zrzut danych tabeli `Tweet`
--

INSERT INTO `Tweet` (`id`, `user_id`, `text`) VALUES
(1, 14, 'tweet1'),
(2, 14, 'ok'),
(3, 14, 'tweet2'),
(4, 14, 'tweet'),
(5, 14, 'tweet'),
(6, 14, 'tweet'),
(7, 14, 'tweet'),
(8, 14, 'tweet'),
(9, 14, 'tweet'),
(10, 14, 'tweet'),
(11, 14, 'tweet'),
(12, 14, 'tweet'),
(14, 14, 'tweet'),
(15, 14, 'tweet'),
(16, 14, 'nowy tweet'),
(17, 14, 's'),
(18, 14, 's'),
(19, 14, 'w'),
(20, 14, 'ww'),
(21, 19, 'Nowy tweet'),
(23, 19, 'tweet 2'),
(24, 19, 'tweet 3\r\n'),
(25, 19, 'ok'),
(26, 14, 'wpis'),
(27, 14, 'Nowy wpis\r\n'),
(28, 25, 'Nowy wpis'),
(29, 25, 'Nowy wpis');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullName` varchar(100) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Zrzut danych tabeli `User`
--

INSERT INTO `User` (`id`, `email`, `password`, `fullName`, `active`) VALUES
(3, 'mad.zof@wp.pl', '$2y$10$zbkGTz.KrHyRnLsDFR5Do.eOO4F3Vf408d/iBD/kZCNpG4dVQIWeC', 'Zofia Madej', 1),
(7, 'z@wp.pl', '$2y$10$3Vu1BQoEpEZMFUCpOjnXluyB15J.O/Kq.0ezmJ.C/Rmg93OGQikgm', 'zosia', 1),
(8, 'zz@wp.pl', '$2y$10$UrV5ulpbl8DXh4DbhIckvuLA2NBx1HvI24MlFxcwcvr8fvkSRu/Cq', 'zzz', 1),
(13, 'mail', 'password', 'pelne imie', 1),
(14, 'email@wp.pl', '$2y$10$C5d1gFu7WAwZu2JHRRT5N.PhJdXtb/1f148i/abv/IGMfWarIZepe', 'Imie Nazwisko', 1),
(15, 'zofmad@wp.pl', '$2y$10$jkh3Ncl7/ENE7CK/.0WG2.bt686uskg.cL8HG/Et0YhDn/TR4xpby', '', 1),
(16, 'user', '$2y$10$JETsFGNNzcr33FtZW6WF6e.cPYZcnNw2VQgiwicv4XrK.2NgoEUK6', '', 1),
(17, 'user2000', '$2y$10$sLXxi5Rpqm0SvsH3Gyfk2uUp1JKEX3KKV6IZDKTwq1dOFweN5cO/2', '', 1),
(18, 'user@wp.pl', '$2y$10$YHVjq.2wj.TyhCW1M1DKhu4EjEjHR81jhcOdul4xm30Cd8d0O8sg6', '', 1),
(19, 'user2@wp.pl', '$2y$10$z8UZ7Oz092PNHcf2ZpU2iuwQUtVf3pusqO4qp/AaBkT95QaUQpEVi', '', 1),
(20, 'user3@wp.pl', '$2y$10$tk2FmMs24fdr1hnuseL9l.bZ6TGqRZAig8WpJ1KgY.7fXsL7aLVIq', '', 1),
(21, 'mail@wp.pl', '$2y$10$i4UY3D593Dgabs9r0p04IOwaB7Pij4mKQWPng5W8IhLnwrj.Mr6X2', '', 1),
(22, 'dysonans2@interia.pl', '$2y$10$0PcHGmkcVPlOBNWBwapiX.WTXsngVCD4j4oQsUhCrqRQyJ1uXnU7m', 'Zofia Madej', 1),
(23, 'mail2@mail.pl', '$2y$10$Z2AqzmI4f4U1xX2A8SdsZ.QzjezMmd67XxmZdVCJ1YYYid33RAVsC', '-', 1),
(24, 'mail2@wp.pl', '$2y$10$B7ES6d2f91VzBw7pk4td8.Cjw6G6QxxbuOgpD/zkHBVapk308zr0W', 'Full name', 1),
(25, 'm@wp.pl', '$2y$10$Byr5phK4cnp/4DnGcztZ2uzgm6eF6fSfBkMZOS84MvT5Ojj7matfe', 'IN', 1);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `Comment_ibfk_2` FOREIGN KEY (`tweet_id`) REFERENCES `Tweet` (`id`);

--
-- Ograniczenia dla tabeli `Message`
--
ALTER TABLE `Message`
  ADD CONSTRAINT `Message_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `Message_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `User` (`id`);

--
-- Ograniczenia dla tabeli `Tweet`
--
ALTER TABLE `Tweet`
  ADD CONSTRAINT `Tweet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
