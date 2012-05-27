-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 27 May 2012, 17:28
-- Wersja serwera: 5.5.22
-- Wersja PHP: 5.3.10-1ubuntu3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
-- Struktura tabeli dla  `forum_category`
--

CREATE TABLE IF NOT EXISTS `forum_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `forum_category`
--

INSERT INTO `forum_category` (`id`, `name`, `order`) VALUES
(1, 'Sport', 0),
(2, 'Muzyka', 1),
(3, 'Turystyka', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `forum_post`
--

CREATE TABLE IF NOT EXISTS `forum_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`,`topic_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `forum_post`
--

INSERT INTO `forum_post` (`id`, `author_id`, `topic_id`, `content`, `created_at`) VALUES
(1, 2, 1, 'Ja słucham Hip Hopu!', '2012-05-24 23:17:58'),
(2, 3, 1, 'A ja słucham rocka :P Rock jest spoko! Mówię wam :D', '2012-05-24 23:18:28'),
(3, 1, 1, 'Tak, rock też ma swoje uroki :P ale mimo wszystko DODA rządzi! KOCHAM JĄ!!!!!', '2012-05-25 00:26:17'),
(4, 1, 1, 'fsafd', '2012-05-25 00:28:36');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `forum_topic`
--

CREATE TABLE IF NOT EXISTS `forum_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `forum_topic`
--

INSERT INTO `forum_topic` (`id`, `author_id`, `title`, `content`, `created_at`, `category_id`) VALUES
(1, 1, 'Jaką muzykę słuchacie?', 'Jaką muzykę słuchacie? Bo ja kocham się w muzyce klasycznej :)', '2012-05-24 00:00:00', 2),
(2, 2, 'Gdzie polecacie wybrać się na wakacje?', 'Chcę pojechać gdzieś na wakacje, ale nie mam pojęcia gdzie... Macie jakieś propozycje?', '2012-05-24 23:42:33', 3),
(3, 2, 'Jakie sporty uprawiacie?', 'Jakie sporty uprawiacie? Ja lubię tenis oraz szachy :)', '2012-05-24 23:42:33', 1),
(4, 2, 'Koncert Muzyki klasycznej', 'Wiecie może gdzie jest jakiś koncert muzyki klasycznej?', '2012-05-24 23:42:33', 2);

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
-- Struktura tabeli dla  `post_attachment`
--

CREATE TABLE IF NOT EXISTS `post_attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `post_attachment`
--

INSERT INTO `post_attachment` (`id`, `filename`, `path`, `post_id`) VALUES
(1, 'OWASP Top 10 - 2010.pdf', 'OWASP.pdf', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `name`, `group_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'kontakt@bkielbasa.pl', 'Administrator', 2),
(2, 'johny_brawo', '21232f297a57a5a743894a0e4a801fc3', 'brawo@johny.com', 'Dżony Brawo', 1),
(3, 'tom_cruse', '21232f297a57a5a743894a0e4a801fc3', 'tom@cruse.pl', 'Tom Krus', 1);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`);

--
-- Ograniczenia dla tabeli `forum_post`
--
ALTER TABLE `forum_post`
  ADD CONSTRAINT `forum_post_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `forum_post_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `forum_topic` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `forum_topic`
--
ALTER TABLE `forum_topic`
  ADD CONSTRAINT `forum_topic_ibfk_3` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `forum_topic_ibfk_4` FOREIGN KEY (`category_id`) REFERENCES `forum_category` (`id`);

--
-- Ograniczenia dla tabeli `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Ograniczenia dla tabeli `post_attachment`
--
ALTER TABLE `post_attachment`
  ADD CONSTRAINT `post_attachment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`);

--
-- Ograniczenia dla tabeli `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE SET NULL;
