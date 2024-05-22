-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2024 a las 15:18:28
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
                             `id` bigint(20) UNSIGNED NOT NULL,
                             `nombre` varchar(50) NOT NULL,
                             `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`) VALUES
                                                            (1, 'Casual', 'Ropa diseñada para el confort y la practicidad, adecuada para el uso diario. Incluye jeans, camisetas, sudaderas y zapatillas deportivas. Es versátil y relajada, ideal para actividades informales y encuentros casuales.'),
                                                            (2, 'Formal', 'Atuendos elegantes y sofisticados usados en eventos importantes como bodas, cenas de gala o reuniones de negocios. Incluye trajes, vestidos largos, camisas de vestir y zapatos formales. Se caracteriza por su corte fino y materiales de alta calidad.\r\n\r\n'),
                                                            (3, 'Deportiva', 'Ropa creada específicamente para practicar deportes y actividades físicas. Incluye leggings, shorts deportivos, camisetas transpirables y calzado especializado. Esta categoría se enfoca en la funcionalidad y el soporte, utilizando materiales que permiten una mejor movilidad y gestión de la humedad.'),
                                                            (4, 'Business casual', 'Un término medio entre casual y formal. Adecuado para ambientes de trabajo que no requieren un código de vestimenta estrictamente formal. Incluye pantalones de vestir, blusas, blazers y zapatos cerrados. Permite cierta flexibilidad mientras mantiene una apariencia profesional.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conjunto`
--

CREATE TABLE `conjunto` (
                            `id` bigint(20) UNSIGNED NOT NULL,
                            `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creacion_conjunto`
--

CREATE TABLE `creacion_conjunto` (
                                     `id_conjunto` bigint(20) UNSIGNED DEFAULT NULL,
                                     `id_ropa` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ropa`
--

CREATE TABLE `ropa` (
                        `id` bigint(20) UNSIGNED NOT NULL,
                        `nombre` varchar(50) NOT NULL,
                        `descripcion` text DEFAULT NULL,
                        `color` varchar(20) DEFAULT NULL,
                        `id_usuario` bigint(20) UNSIGNED DEFAULT NULL,
                        `id_tipo_ropa` bigint(20) UNSIGNED DEFAULT NULL,
                        `id_categoria` bigint(20) UNSIGNED DEFAULT NULL,
                        `fotoropa` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_ropa`
--

CREATE TABLE `tipo_ropa` (
                             `id` bigint(20) UNSIGNED NOT NULL,
                             `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_ropa`
--

INSERT INTO `tipo_ropa` (`id`, `nombre`) VALUES
                                             (1, 'Hoddies'),
                                             (2, 'Camisa'),
                                             (3, 'Pantalon'),
                                             (4, 'Gorra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
                           `id` bigint(20) UNSIGNED NOT NULL,
                           `nombre` varchar(50) NOT NULL,
                           `apellidos` varchar(50) DEFAULT NULL,
                           `edad` varchar(10) DEFAULT NULL,
                           `correo` varchar(50) NOT NULL,
                           `contrasena` varchar(50) NOT NULL,
                           `token` varchar(100) DEFAULT NULL,
                           `fotousu` longblob DEFAULT NULL,
                           `pais` varchar(50) DEFAULT NULL,
                           `estado` varchar(50) DEFAULT NULL,
                           `localidad` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellidos`, `edad`, `correo`, `contrasena`, `token`, `fotousu`, `pais`, `estado`, `localidad`) VALUES
    (1, 'Fer', 'Cazares', '21', 'cagada@gmail.com', '12345', NULL, NULL, 'Mexico', 'Michoacan', 'Morelia ');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
    ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `conjunto`
--
ALTER TABLE `conjunto`
    ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `creacion_conjunto`
--
ALTER TABLE `creacion_conjunto`
    ADD KEY `FK_creacion_conjunto_conjunto` (`id_conjunto`),
  ADD KEY `FK_creacion_conjunto_ropa` (`id_ropa`);

--
-- Indices de la tabla `ropa`
--
ALTER TABLE `ropa`
    ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ropa_usuario` (`id_usuario`),
  ADD KEY `FK_ropa_tipo_ropa` (`id_tipo_ropa`),
  ADD KEY `FK_ropa_categoria` (`id_categoria`);

--
-- Indices de la tabla `tipo_ropa`
--
ALTER TABLE `tipo_ropa`
    ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `conjunto`
--
ALTER TABLE `conjunto`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ropa`
--
ALTER TABLE `ropa`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_ropa`
--
ALTER TABLE `tipo_ropa`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
