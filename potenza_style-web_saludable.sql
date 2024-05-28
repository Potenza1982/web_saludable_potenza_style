-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2024 a las 10:54:09
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `potenza_style`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `imagen`) VALUES
(3, 'SomoSal 1 Flex', 30.15, '1716884293_somosal_1_flex.jpeg'),
(4, 'SomoSal 2 Artri', 30.15, '1716884685_somosal_2_artri.jpeg'),
(5, 'SomoSal 3 Ferrum', 30.15, '1716884722_somosal_3_ferrum.jpeg'),
(6, 'SomoSal 4 Pul', 30.15, '1716884743_SomoSal_4_Pul.jpeg'),
(7, 'SomoSal 5 Calm', 30.15, '1716884761_SomoSal_5_Calm.jpeg'),
(8, 'SomoSal 6 Derm', 30.15, '1716884789_SomoSal_6_Derm.jpeg'),
(9, 'SomoSal 7 Equi', 30.15, '1716884804_somosal_7_equi.jpeg'),
(10, 'SomoSal 8 Intestin', 30.15, '1716884822_SomoSal_9_Colest.jpeg'),
(11, 'SomoSal 9 Colest', 30.15, '1716884843_SomoSal_9_Colest.jpeg'),
(12, 'SomoSal 10 Hepa', 30.15, '1716884869_SomoSal_10_Hepa.jpeg'),
(13, 'SomoSal 11 Dren', 30.15, '1716884945_SomoSal_11_Dren.jpeg'),
(14, 'SomoSal 12 Supur', 30.15, '1716884965_SomoSal_12_Supur.jpeg'),
(15, 'SomoSal 13 Complex', 30.15, '1716884986_SomoSal_13_Complex.jpeg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
