-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-10-2023 a las 18:52:20
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_final_n3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacionmaestros`
--

CREATE TABLE `asignacionmaestros` (
  `id_pm` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  `id_profemate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignacionmaestros`
--

INSERT INTO `asignacionmaestros` (`id_pm`, `id_profesor`, `id_profemate`) VALUES
(8, 24, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `estado`) VALUES
(1, 'ACTIVO'),
(2, 'INACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id_materia` int(11) NOT NULL,
  `materia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id_materia`, `materia`) VALUES
(1, 'Español'),
(2, 'Matematicas'),
(3, 'Ciencias'),
(4, 'Sociales'),
(5, 'Ingles'),
(6, 'Programacion'),
(7, 'Redes'),
(8, 'Estadistica'),
(9, 'Estadistica'),
(10, 'Excel'),
(11, 'Excel'),
(12, 'Word');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registroalumnos`
--

CREATE TABLE `registroalumnos` (
  `id_am` int(11) NOT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `id_alumate` int(11) DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `mensajes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'admin'),
(2, 'maestro'),
(3, 'alumno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `dni` varchar(250) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `contrasena` varchar(250) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `dni`, `email`, `contrasena`, `nombre`, `apellido`, `fecha_nacimiento`, `direccion`, `rol_id`, `estado`) VALUES
(23, NULL, 'admin@admin', '$2y$10$qS2EK811xorMQeFYEIz/8.FgaTK7mdM/nhdf5vadFZM14yOKY5Ibq', 'admin', NULL, NULL, NULL, 1, 1),
(24, '0606199000123', 'maestro@maestro', '$2y$10$QY1hA6n5b3RTyA0lOWx2/OTqzhAjqVjVr4uN.l6XdMIbaOBoN7W1G', 'Jorge', 'Reyes', '2016-12-01', 'Choluteca, Honduras', 2, 1),
(25, '0601200001010', 'alumno@alumno', '$2y$10$bc2DF.trIDBiXbvdXzB/G.Pjsn43QgvGEI4EHAl0Js9.AvW/fpLDq', 'Carlos', 'Bock', '2014-10-01', 'España, Barcelona', 3, 1),
(26, '202019990564', 'maestro2@maestro.com', '$2y$10$rnesTkVVZJS2ZJ5nbYULLOFfZCjI9D0f16RzEp0PzXqo5ew2Xa0x6', 'Vanessa', 'Rodriguez', '2018-11-29', 'Lima, Peru', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignacionmaestros`
--
ALTER TABLE `asignacionmaestros`
  ADD PRIMARY KEY (`id_pm`),
  ADD KEY `profesor_materias_FK_1` (`id_profemate`),
  ADD KEY `profesor_materias_FK_2` (`id_profesor`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id_materia`);

--
-- Indices de la tabla `registroalumnos`
--
ALTER TABLE `registroalumnos`
  ADD PRIMARY KEY (`id_am`),
  ADD KEY `alumnos_materias_FK` (`id_alumno`),
  ADD KEY `alumnos_materias_FK_1` (`id_alumate`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `usuarios_FK` (`rol_id`),
  ADD KEY `estado` (`estado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignacionmaestros`
--
ALTER TABLE `asignacionmaestros`
  MODIFY `id_pm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `registroalumnos`
--
ALTER TABLE `registroalumnos`
  MODIFY `id_am` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignacionmaestros`
--
ALTER TABLE `asignacionmaestros`
  ADD CONSTRAINT `asignacionmaestros_ibfk_3` FOREIGN KEY (`id_profesor`) REFERENCES `usuarios` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asignacionmaestros_ibfk_4` FOREIGN KEY (`id_profemate`) REFERENCES `materias` (`id_materia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `registroalumnos`
--
ALTER TABLE `registroalumnos`
  ADD CONSTRAINT `registroalumnos_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `usuarios` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `registroalumnos_ibfk_2` FOREIGN KEY (`id_alumate`) REFERENCES `materias` (`id_materia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`estado`) REFERENCES `estado` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
