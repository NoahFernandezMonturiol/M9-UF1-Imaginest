-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-03-2021 a las 08:39:19
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `imaginest`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imatges`
--

CREATE TABLE `imatges` (
  `idImatge` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dataPujada` datetime NOT NULL,
  `estat` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `imatges`
--

INSERT INTO `imatges` (`idImatge`, `filename`, `dataPujada`, `estat`) VALUES
(1, 'noah.fnndz_2020_05_27_13_14_07.jpg', '2021-03-12 09:41:34', '1'),
(2, '1366_1.jpg', '2021-03-12 09:54:31', '1'),
(3, '1366_1.jpg', '2021-03-12 10:17:36', '1'),
(4, 'asus.png', '2021-03-12 12:06:40', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `iduser` int(11) NOT NULL,
  `mail` varchar(40) COLLATE utf8mb4_bin DEFAULT NULL,
  `username` varchar(16) COLLATE utf8mb4_bin DEFAULT NULL,
  `passHash` varchar(60) COLLATE utf8mb4_bin DEFAULT NULL,
  `userFirstName` varchar(60) COLLATE utf8mb4_bin DEFAULT NULL,
  `userLastName` varchar(120) COLLATE utf8mb4_bin DEFAULT NULL,
  `creationDate` datetime DEFAULT current_timestamp(),
  `lastSignIn` datetime DEFAULT NULL,
  `removeDate` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT 0,
  `activationDate` datetime DEFAULT NULL,
  `activationCode` char(64) COLLATE utf8mb4_bin NOT NULL,
  `resetPass` tinyint(1) NOT NULL,
  `resetPassExpiry` datetime DEFAULT NULL,
  `resetPassCode` char(64) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`iduser`, `mail`, `username`, `passHash`, `userFirstName`, `userLastName`, `creationDate`, `lastSignIn`, `removeDate`, `active`, `activationDate`, `activationCode`, `resetPass`, `resetPassExpiry`, `resetPassCode`) VALUES
(64, 'slastic11@gmail.com', 'noah', '$2y$10$SW.zBqwnrULWrd5NQVf8LeBpcGEEqLCuf1QAwQ6KgFhHVnaLytnG.', 'Noah', 'Fernández', '2021-03-12 10:47:18', '2021-03-12 10:47:58', NULL, 1, NULL, 'da07e2d0f18aee69b6f9c3195d19b970bac5b2c9e525977c24a1c22508f10fde', 1, '2021-03-16 19:29:26', '8bf79da2dbf9cfc40d9d4e03e4d94d00bc6e99ba954feffcbe90b74eba8a0a23'),
(66, 'noah.fernndez@gmail.com', 'martinet', '$2y$10$WrQccPZmvXpmp2zoHDqsCeJZ0joODrgPvmhPoKpJVk2bQyfT763EK', 'Marti', 'Espinar', '2021-03-19 08:29:44', '2021-03-19 08:30:07', NULL, 1, NULL, '6b9752440ad18015362acde0b48907c8a389b066e310893f7a47488d33c434c7', 1, '2021-03-19 10:00:18', 'd5eb28217d54565078dc2774843bcd9a9698e5780c7c13f9f04ea16b30a7163b');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `imatges`
--
ALTER TABLE `imatges`
  ADD PRIMARY KEY (`idImatge`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `imatges`
--
ALTER TABLE `imatges`
  MODIFY `idImatge` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;


--
-- Metadatos
--
USE `phpmyadmin`;

--
-- Metadatos para la tabla imatges
--

--
-- Metadatos para la tabla users
--

--
-- Metadatos para la base de datos imaginest
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
