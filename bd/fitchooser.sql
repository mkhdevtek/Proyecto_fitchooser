-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2024 a las 07:55:13
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
-- Base de datos: `fitchooser`
--
CREATE DATABASE IF NOT EXISTS `fitchooser` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fitchooser`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conjunto`
--

DROP TABLE IF EXISTS `conjunto`;
CREATE TABLE IF NOT EXISTS `conjunto` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creacion_conjunto`
--

DROP TABLE IF EXISTS `creacion_conjunto`;
CREATE TABLE IF NOT EXISTS `creacion_conjunto` (
  `id_conjunto` bigint(20) UNSIGNED DEFAULT NULL,
  `id_ropa` bigint(20) UNSIGNED DEFAULT NULL,
  KEY `FK_creacion_conjunto_conjunto` (`id_conjunto`),
  KEY `FK_creacion_conjunto_ropa` (`id_ropa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ropa`
--

DROP TABLE IF EXISTS `ropa`;
CREATE TABLE IF NOT EXISTS `ropa` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `id_usuario` bigint(20) UNSIGNED DEFAULT NULL,
  `id_tipo_ropa` bigint(20) UNSIGNED DEFAULT NULL,
  `id_categoria` bigint(20) UNSIGNED DEFAULT NULL,
  `fotoropa` longblob DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ropa_usuario` (`id_usuario`),
  KEY `FK_ropa_tipo_ropa` (`id_tipo_ropa`),
  KEY `FK_ropa_categoria` (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_ropa`
--

DROP TABLE IF EXISTS `tipo_ropa`;
CREATE TABLE IF NOT EXISTS `tipo_ropa` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `edad` varchar(10) DEFAULT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `fotousu` longblob DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `localidad` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellidos`, `edad`, `correo`, `contrasena`, `token`, `fotousu`, `pais`, `estado`, `localidad`) VALUES
(1, 'Fer', 'Cazares', '21', 'cagada@gmail.com', '12345', NULL, NULL, 'Mexico', 'Michoacan', 'Morelia ');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `creacion_conjunto`
--
ALTER TABLE `creacion_conjunto`
  ADD CONSTRAINT `FK_creacion_conjunto_conjunto` FOREIGN KEY (`id_conjunto`) REFERENCES `conjunto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_creacion_conjunto_ropa` FOREIGN KEY (`id_ropa`) REFERENCES `ropa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ropa`
--
ALTER TABLE `ropa`
  ADD CONSTRAINT `FK_ropa_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ropa_tipo_ropa` FOREIGN KEY (`id_tipo_ropa`) REFERENCES `tipo_ropa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ropa_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
