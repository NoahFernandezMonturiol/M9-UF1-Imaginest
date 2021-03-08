-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-03-2021 a las 12:20:24
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
CREATE DATABASE IF NOT EXISTS `imaginest` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `imaginest`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
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


--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;


--
-- Metadatos
--
USE `phpmyadmin`;

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
