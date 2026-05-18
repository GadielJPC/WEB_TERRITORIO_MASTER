-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-05-2026 a las 10:17:02
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
-- Base de datos: `academia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `modalidad_badge` varchar(50) DEFAULT NULL,
  `modalidad_desc` varchar(100) DEFAULT NULL,
  `creditos` varchar(50) DEFAULT NULL,
  `practicas` varchar(255) DEFAULT NULL,
  `precio` varchar(50) DEFAULT NULL,
  `url_enlace` varchar(255) DEFAULT NULL,
  `duracion` varchar(50) DEFAULT NULL,
  `dirigido_a` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `titulo`, `imagen`, `modalidad_badge`, `modalidad_desc`, `creditos`, `practicas`, `precio`, `url_enlace`, `duracion`, `dirigido_a`) VALUES
(1, 'Master en Fisioterapia Invasiva', 'fisioterapia.png', 'Semipresencial', 'Teórico-Practico', '60 créditos ECTS', 'Centros especializados', '6.999 €', 'fisioterapia.php', '12 meses', 'Profesionales sanitarios'),
(2, 'Master en Medicina Estetica', 'estetica.png', 'Presencial', 'Teórico-Practico', '60 créditos ECTS', 'Centros especializados', '9.999€', 'estetica.php', '12 meses', 'Profesionales sanitarios');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
