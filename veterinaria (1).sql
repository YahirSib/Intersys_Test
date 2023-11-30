-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 30-11-2023 a las 05:05:26
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `veterinaria`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `agregar_mascota`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregar_mascota` (IN `nombre` VARCHAR(40) CHARSET utf8mb4, IN `edad` INT, IN `especie` INT, IN `raza` INT, IN `encargado` INT)   INSERT INTO `mascotas`(`nombre`, `edad`, `especie`, `raza`, `encargado`) VALUES (nombre, edad, especie, raza, encargado)$$

DROP PROCEDURE IF EXISTS `editar_mascota`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `editar_mascota` (IN `nombre` VARCHAR(40) CHARSET utf8mb4, IN `edad` INT, IN `especie` INT, IN `raza` INT, IN `encargado` INT, IN `id` INT)   UPDATE `mascotas` SET `nombre`= nombre ,`edad`= edad,
`especie`= especie,`raza`= raza,`encargado`= encargado WHERE `id_mascota` = id$$

DROP PROCEDURE IF EXISTS `ver_mascotas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ver_mascotas` ()   SELECT m.id_mascota, m.nombre, m.edad, e.nombre AS "especie",
r.nombre AS "raza", CONCAT(n.nombre , " ", n.apellido) AS "encargado" FROM
mascotas m INNER JOIN especies e on m.especie = e.id_especie
INNER JOIN razas r on m.raza = r.id_raza
INNER JOIN clientes n on m.encargado = n.id_cliente$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) NOT NULL,
  `apellido` varchar(40) NOT NULL,
  `edad` int NOT NULL,
  `sexo` int NOT NULL,
  `correo` varchar(60) NOT NULL,
  `telefono` int NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellido`, `edad`, `sexo`, `correo`, `telefono`) VALUES
(1, 'Yahir', 'Sibrian', 20, 1, 'yahirstewart16@gmail.com', 73193246);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especies`
--

DROP TABLE IF EXISTS `especies`;
CREATE TABLE IF NOT EXISTS `especies` (
  `id_especie` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id_especie`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `especies`
--

INSERT INTO `especies` (`id_especie`, `nombre`) VALUES
(1, 'perro'),
(2, 'gato'),
(3, 'conejo'),
(4, 'ave');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

DROP TABLE IF EXISTS `mascotas`;
CREATE TABLE IF NOT EXISTS `mascotas` (
  `id_mascota` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `edad` int NOT NULL,
  `especie` int NOT NULL,
  `raza` int NOT NULL,
  `encargado` int NOT NULL,
  PRIMARY KEY (`id_mascota`),
  KEY `encargado` (`encargado`),
  KEY `raza` (`raza`),
  KEY `especie` (`especie`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `mascotas`
--

INSERT INTO `mascotas` (`id_mascota`, `nombre`, `edad`, `especie`, `raza`, `encargado`) VALUES
(1, 'canelita', 2, 2, 3, 1),
(2, 'lola', 1, 1, 2, 1),
(5, 'semilla', 1, 3, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `razas`
--

DROP TABLE IF EXISTS `razas`;
CREATE TABLE IF NOT EXISTS `razas` (
  `id_raza` int NOT NULL AUTO_INCREMENT,
  `especie` int NOT NULL,
  `nombre` varchar(40) NOT NULL,
  PRIMARY KEY (`id_raza`),
  KEY `especie` (`especie`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `razas`
--

INSERT INTO `razas` (`id_raza`, `especie`, `nombre`) VALUES
(1, 1, 'pitbull'),
(2, 1, 'chihuaha'),
(3, 2, 'naranja'),
(4, 2, 'negro'),
(5, 3, 'blanco'),
(6, 3, 'cafe'),
(7, 4, 'loro'),
(8, 4, 'australiano');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD CONSTRAINT `mascotas_ibfk_1` FOREIGN KEY (`encargado`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mascotas_ibfk_2` FOREIGN KEY (`especie`) REFERENCES `especies` (`id_especie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mascotas_ibfk_3` FOREIGN KEY (`raza`) REFERENCES `razas` (`id_raza`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `razas`
--
ALTER TABLE `razas`
  ADD CONSTRAINT `razas_ibfk_1` FOREIGN KEY (`especie`) REFERENCES `especies` (`id_especie`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
