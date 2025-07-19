-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-07-2025 a las 20:55:30
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
-- Base de datos: `barber`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barberos`
--

CREATE TABLE `barberos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `especialidad` varchar(100) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `barberos`
--

INSERT INTO `barberos` (`id`, `nombre`, `especialidad`, `estado`) VALUES
(1, 'Luis', 'Fade y corte clásico', 1),
(2, 'Marcos', 'Diseños y barba', 1),
(3, 'Sofi', 'Corte clásico y afeitado premium', 1),
(4, 'kevin', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `descripcion`, `precio`) VALUES
(1, 'Corte Clásico', 'Corte tradicional y profesional', 2500.00),
(2, 'Diseños & Fade', 'Degradados con diseño artístico', 3500.00),
(3, 'Afeitado Premium', 'Afeitado con toalla caliente y productos especiales', 3000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `servicio` int(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `barbero` int(100) DEFAULT NULL,
  `whatsapp` tinyint(1) DEFAULT 0,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('activo','cancelado') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `usuario_id`, `fecha`, `hora`, `servicio`, `descripcion`, `barbero`, `whatsapp`, `creado_en`, `estado`) VALUES
(1, 2, '2025-07-25', '23:42:00', 1, '0', 4, 1, '2025-07-19 03:39:06', 'activo'),
(2, 2, '2025-07-23', '21:42:00', 1, '0', 2, 1, '2025-07-19 03:41:10', 'activo'),
(4, 3, '2025-07-24', '16:41:00', 2, '0', 4, 1, '2025-07-19 22:41:56', 'cancelado'),
(5, 3, '2025-07-22', '20:58:00', 1, '0', 4, 1, '2025-07-19 22:52:44', 'cancelado'),
(6, 3, '2025-07-25', '15:10:00', 2, '0', 1, 1, '2025-07-19 23:10:26', 'cancelado'),
(7, 3, '2025-07-20', '17:55:00', 3, '0', NULL, 1, '2025-07-19 23:23:18', 'cancelado'),
(8, 3, '2025-08-15', '12:55:00', 1, '0', 4, 1, '2025-07-19 23:32:27', 'cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `fecha`, `telefono`, `email`, `pass`, `creado_en`) VALUES
(1, 'alejo', 'perez', '2025-07-06', '2343423423', 'p@gmail.com', 'acosta10', '2025-07-17 21:23:40'),
(2, 'juan', 'pe', '2025-07-11', '45454254', 'h@gmail.com', '$2y$10$rfDbDozSUZn2enPtbmDtWODEHvihm3YvKyQC87xWJNFBljH6K8hzC', '2025-07-17 21:35:33'),
(3, 'pan', 'quesp', '2009-05-05', '2321313123', 'pan@gmail.com', '$2y$10$SrU7fbS8oBjRCqap8rIHRuz9VGry8KZvXApVbSjwFS6ZOMXmY44Mu', '2025-07-19 17:16:42');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `barberos`
--
ALTER TABLE `barberos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `servicio` (`servicio`,`barbero`),
  ADD KEY `barbero` (`barbero`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `barberos`
--
ALTER TABLE `barberos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD CONSTRAINT `turnos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `turnos_ibfk_2` FOREIGN KEY (`barbero`) REFERENCES `barberos` (`id`),
  ADD CONSTRAINT `turnos_ibfk_3` FOREIGN KEY (`servicio`) REFERENCES `servicios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
