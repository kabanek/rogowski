-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 23 May 2012, 20:11
-- Wersja serwera: 5.5.22
-- Wersja PHP: 5.3.10-1ubuntu3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `zend`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Zrzut danych tabeli `comment`
--

INSERT INTO `comment` (`id`, `email`, `name`, `body`, `date`, `post_id`) VALUES
(1, 'dupa', '', 'lala', '2012-04-27 20:47:41', 1),
(2, 'sfsdafas', '', 'fdsa dsa fsd', '2012-04-27 20:48:00', 1),
(3, 'fas', 'fds', 'fasd', '2012-04-27 20:48:59', 1),
(4, 'fsdfas', '', 'fdsafas', '2012-05-09 21:31:37', 1),
(5, 'fdsafasd', '', 'fdsaf', '2012-05-09 21:32:13', 1),
(6, 'fdsafdasfdsfdsaf', 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2012-05-09 21:33:03', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `group`
--

INSERT INTO `group` (`id`, `name`, `code`) VALUES
(1, 'Użytkownik', 'user'),
(2, 'Administrator', 'admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(512) NOT NULL,
  `short` varchar(1024) NOT NULL,
  `content` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `publish_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `post`
--

INSERT INTO `post` (`id`, `title`, `short`, `content`, `author_id`, `publish_time`) VALUES
(1, 'Tytuł posta', 'krótki wstęp', 'dłuuuga część posta', 1, '2012-04-27 20:35:45');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(32) NOT NULL,
  `name` varchar(64) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `name`, `group_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'kontakt@bkielbasa.pl', 'administrator', 2);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`);

--
-- Ograniczenia dla tabeli `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Ograniczenia dla tabeli `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;