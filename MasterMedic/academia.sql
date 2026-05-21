CREATE DATABASE IF NOT EXISTS `academia`
DEFAULT CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE `academia`;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `contactos`;
DROP TABLE IF EXISTS `usuarios`;
DROP TABLE IF EXISTS `administradores`;
DROP TABLE IF EXISTS `cursos`;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE `administradores` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(50) NOT NULL,
  `contrasena` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_unique` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `administradores` (`id`, `usuario`, `contrasena`) VALUES
(1, 'admin', 'admin123');


CREATE TABLE `usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `fecha_registro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_unique` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `contactos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre_completo` VARCHAR(255) NOT NULL,
  `correo_electronico` VARCHAR(255) NULL,
  `telefono` VARCHAR(50) NULL,
  `programa_interes` VARCHAR(255) NULL,
  `mensaje` TEXT NULL,
  `acepta_privacidad` TINYINT(1) DEFAULT 1,
  `fecha_registro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_programa_interes` (`programa_interes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `cursos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(255) NOT NULL,
  `imagen` VARCHAR(100) NOT NULL,
  `modalidad_badge` VARCHAR(50) NOT NULL,
  `modalidad_desc` VARCHAR(100) NOT NULL,
  `creditos` VARCHAR(50) NOT NULL,
  `practicas` VARCHAR(100) NOT NULL,
  `precio` VARCHAR(50) NOT NULL,
  `duracion` VARCHAR(50) NOT NULL,
  `dirigido_a` VARCHAR(255) NOT NULL,
  `url_enlace` VARCHAR(100) NOT NULL,
  `descripcion` TEXT NOT NULL,
  `programa_texto` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url_enlace_unique` (`url_enlace`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `cursos` (
  `id`,
  `titulo`,
  `imagen`,
  `modalidad_badge`,
  `modalidad_desc`,
  `creditos`,
  `practicas`,
  `precio`,
  `duracion`,
  `dirigido_a`,
  `url_enlace`,
  `descripcion`,
  `programa_texto`
) VALUES (
  4,
  'Master en Medicina Estetica',
  'estetica.png',
  'Online',
  'Teórico-Práctico',
  '60 créditos ECTS',
  'Centros especializados',
  '1.000€',
  '6 meses',
  'Profesionales especializados',
  'estetica',
  'Este máster proporciona una formación integral en medicina estética, abarcando tratamientos faciales y corporales, incluyendo toxina botulínica, rellenos dérmicos, bioestimuladores y el uso de aparatología avanzada.

A lo largo del programa, el alumno adquirirá conocimientos teóricos sólidos junto con una formación práctica intensiva, orientada al desarrollo de habilidades clínicas en procedimientos seguros y eficaces.

El enfoque combina técnicas innovadoras con una base científica rigurosa para dominar la anatomía facial y el diagnóstico estético personalizado para cada paciente.',
  'Módulo 01: Bases anatómicas y fisiológicas en Medicina Estética
Módulo 02: Tratamientos faciales: Toxina botulínica y rellenos dérmicos
Módulo 03: Aparatología médico-estética y tecnología láser
Módulo 04: Práctica Clínica Supervisada en centros concertados'
);

ALTER TABLE `administradores` AUTO_INCREMENT = 2;
ALTER TABLE `usuarios` AUTO_INCREMENT = 1;
ALTER TABLE `contactos` AUTO_INCREMENT = 1;
ALTER TABLE `cursos` AUTO_INCREMENT = 5;