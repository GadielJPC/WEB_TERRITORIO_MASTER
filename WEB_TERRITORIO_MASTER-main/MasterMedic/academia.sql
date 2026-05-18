-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2026 a las 14:02:35
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
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `usuario`, `contrasena`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `modalidad_badge` varchar(50) NOT NULL,
  `modalidad_desc` varchar(100) NOT NULL,
  `creditos` varchar(50) NOT NULL,
  `practicas` varchar(100) NOT NULL,
  `precio` varchar(50) NOT NULL,
  `duracion` varchar(50) NOT NULL,
  `dirigido_a` varchar(255) NOT NULL,
  `url_enlace` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `programa_texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `titulo`, `imagen`, `modalidad_badge`, `modalidad_desc`, `creditos`, `practicas`, `precio`, `duracion`, `dirigido_a`, `url_enlace`, `descripcion`, `programa_texto`) VALUES
(4, 'Master en Medicina Estetica', 'estetica.png', 'Online', 'Teórico-Práctico', '60 créditos ECTS', 'Centros especializados', '1.000€', '6 meses', 'Profesionales especializados', 'estetica', 'Este máster proporciona una formación integral en medicina estética, abarcando tratamientos faciales y corporales, incluyendo toxina botulínica, rellenos dérmicos, bioestimuladores y el uso de aparatología avanzada.\r\n\r\nA lo largo del programa, el alumno adquirirá conocimientos teóricos sólidos junto con una formación práctica intensiva, orientada al desarrollo de habilidades clínicas en procedimientos seguros y eficaces.\r\n\r\nEl enfoque combina técnicas innovadoras con una base científica rigurosa para dominar la anatomía facial y el diagnóstico estético personalizado para cada paciente.', 'Módulo 01: Bases anatómicas y fisiológicas en Medicina Estética\r\nMódulo 02: Tratamientos faciales: Toxina botulínica y rellenos dérmicos\r\nMódulo 03: Aparatología médico-estética y tecnología láser\r\nMódulo 04: Práctica Clínica Supervisada en centros concertados');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
