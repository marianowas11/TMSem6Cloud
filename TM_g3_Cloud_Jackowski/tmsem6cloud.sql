-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql01.marianowas11.beep.pl:3306
-- Czas generowania: 12 Cze 2022, 23:39
-- Wersja serwera: 5.7.31-34-log
-- Wersja PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `tmsem6cloud`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `blokady`
--

CREATE TABLE `blokady` (
  `idb` int(11) NOT NULL,
  `datagodzina` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `adres_ip` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `blokady`
--

INSERT INTO `blokady` (`idb`, `datagodzina`, `adres_ip`) VALUES
(9, '2022-05-30 20:47:07', '37.30.100.103'),
(10, '2022-05-30 20:47:39', '37.30.100.103'),
(11, '2022-05-30 20:52:07', '37.30.100.103'),
(12, '2022-05-30 20:52:39', '37.30.100.103'),
(13, '2022-05-30 20:54:57', '37.30.100.103'),
(14, '2022-05-30 20:57:48', '37.30.100.103'),
(15, '2022-05-30 21:29:25', '37.30.100.103'),
(16, '2022-05-30 21:31:43', '37.30.100.103'),
(17, '2022-05-30 21:31:55', '37.30.100.103'),
(18, '2022-05-30 21:31:58', '37.30.100.103'),
(19, '2022-05-30 21:32:20', '37.30.100.103'),
(22, '2022-05-30 21:49:13', '37.30.100.103');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `files`
--

CREATE TABLE `files` (
  `idf` int(11) NOT NULL,
  `username` text COLLATE utf8_polish_ci NOT NULL,
  `filepath` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `files`
--

INSERT INTO `files` (`idf`, `username`, `filepath`) VALUES
(2, 'q', '/home/virtualki/215154/z9/users/q/pdf.png'),
(3, 'q', '/home/virtualki/215154/z9/users/q/hmmm/39220.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logi`
--

CREATE TABLE `logi` (
  `idl` int(11) NOT NULL,
  `datagodzina` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `adres_ip` text COLLATE utf8_polish_ci NOT NULL,
  `ogloszono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `logi`
--

INSERT INTO `logi` (`idl`, `datagodzina`, `adres_ip`, `ogloszono`) VALUES
(115, '2022-06-02 22:47:04', '89.64.3.225', 0),
(116, '2022-06-02 22:47:14', '89.64.3.225', 0),
(130, '2022-06-07 22:21:12', '77.111.246.40', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `share`
--

CREATE TABLE `share` (
  `ids` int(11) NOT NULL,
  `owner` text COLLATE utf8_polish_ci NOT NULL,
  `borrow` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(3, 'q', 'q'),
(4, 'cos', 'cos'),
(5, 'c', 'c'),
(6, '', '');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `blokady`
--
ALTER TABLE `blokady`
  ADD PRIMARY KEY (`idb`);

--
-- Indeksy dla tabeli `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`idf`);

--
-- Indeksy dla tabeli `logi`
--
ALTER TABLE `logi`
  ADD PRIMARY KEY (`idl`);

--
-- Indeksy dla tabeli `share`
--
ALTER TABLE `share`
  ADD PRIMARY KEY (`ids`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `blokady`
--
ALTER TABLE `blokady`
  MODIFY `idb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT dla tabeli `files`
--
ALTER TABLE `files`
  MODIFY `idf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `logi`
--
ALTER TABLE `logi`
  MODIFY `idl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT dla tabeli `share`
--
ALTER TABLE `share`
  MODIFY `ids` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
