-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Hostiteľ: localhost
-- Čas generovania: So 18.Mar 2017, 19:07
-- Verzia serveru: 5.7.17-0ubuntu0.16.04.1
-- Verzia PHP: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `zadanie2`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `action`
--

CREATE TABLE `action` (
  `id` int(11) NOT NULL,
  `login` text COLLATE utf8_unicode_ci NOT NULL,
  `type` text COLLATE utf8_unicode_ci NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `action`
--

INSERT INTO `action` (`id`, `login`, `type`, `date_time`) VALUES
(202, 'xkmotorkai', 'ldapLogin', '2017-03-18 17:54:26'),
(203, 'canbehacked99@gmail.com', 'googleLogin', '2017-03-18 17:54:46'),
(204, 'kmodo', 'myRegister', '2017-03-18 17:55:54'),
(205, 'kmodo', 'myLogin', '2017-03-18 17:56:03');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `user`
--

CREATE TABLE `user` (
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `user`
--

INSERT INTO `user` (`password`, `email`, `first_name`, `last_name`, `login`) VALUES
('$2y$10$BhoI0cAJXny/OsSiB8TeM..8VsorlX/hWqXFibmfEPOdaW7.PCDZK', 'pocitac@internet.sk', 'Ivan', 'Kmotorka', 'kmodo');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `action`
--
ALTER TABLE `action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
