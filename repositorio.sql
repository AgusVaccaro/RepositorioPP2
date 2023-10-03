-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 03-10-2023 a las 02:08:40
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `repositorio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id_alumno` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `id_carrera` int(11) DEFAULT NULL,
  `carrera` varchar(255) DEFAULT NULL,
  `anio_cursado` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `nombre`, `apellido`, `id_carrera`, `carrera`, `anio_cursado`) VALUES
(1, 'Agustín', 'Vaccaro', 2, 'DS', '3'),
(2, 'Axel', 'Menegozzi', 2, 'DS', '3'),
(3, 'Omar', 'Lopez', 1, 'AF', '3'),
(4, 'Lucas', 'Rodriguez', 3, 'ITI', '2'),
(5, 'Carlos', 'López', 3, 'ITI', '2'),
(6, 'Ana', 'Rodríguez', 2, 'DS', '2'),
(7, 'Pedro', 'Martínez', 1, 'AF', '2'),
(8, 'Laura', 'Fernández', 2, 'DS', '1'),
(9, 'Diego', 'Luna', 1, 'AF', '1'),
(10, 'Elena', 'Sánchez', 3, 'ITI', '1'),
(11, 'Santiago', 'Pardo', 2, 'DS', '1'),
(12, 'Valentina', 'Romero', 1, 'AF', '3'),
(13, 'Javier', 'Hernández', 3, 'ITI', '2'),
(14, 'Isabella', 'Díaz', 2, 'DS', '1'),
(15, 'Mateo', 'Torres', 1, 'AF', '3'),
(16, 'Juan', 'Pérez', 2, 'DS', '3'),
(17, 'María', 'González', 1, 'AF', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id_carrera` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `abreviatura` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id_carrera`, `nombre`, `abreviatura`) VALUES
(1, 'Analisis Funcional de Sistemas', 'AF'),
(2, 'Desarrollo de Software', 'DS'),
(3, 'Infraestructura de Tecnología de la Información', 'ITI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `autor` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `fecha_de_carga` date NOT NULL,
  `archivo` varchar(255) NOT NULL,
  `carrera` varchar(255) DEFAULT NULL,
  `materia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id`, `titulo`, `usuario_id`, `autor`, `categoria`, `fecha_de_carga`, `archivo`, `carrera`, `materia`) VALUES
(34, 'TP FINAL ', NULL, 'Agustín Vaccaro', 'FINAL', '2023-09-27', 'Menegozzi-Vaccaro. Tematica y Alcances.pdf', 'DS', 'Bases de Datos'),
(36, 'Redes LAN', NULL, 'Axel Menegozzi', 'Trabajo Práctico', '2023-09-28', 'Menegozzi-Vaccaro. Tematica y Alcances.pdf', 'DS', 'Redes y Comunicacion'),
(37, 'TP', NULL, 'Agustín Vaccaro', 'TP FINAL', '2023-09-28', 'Menegozzi-Vaccaro. Tematica y Alcances.pdf', 'DS', 'Adminstración'),
(38, 'FINAL', NULL, 'Axel Menegozzi', 'TP FINAL', '2023-09-28', '49_Estructura_Curricular_hs_formato.pdf', 'ITI', 'Infraestructura de Redes 2'),
(39, 'RIJJU', NULL, 'Agustín Vaccaro', 'Desarrollo de Sitio Web', '2023-09-29', '49_Estructura_Curricular_hs_formato.pdf', 'DS', 'Práctica Profesionalizante II'),
(40, 'TP FINAL BBDD', NULL, 'Axel Menegozzi', 'TP FINAL', '2023-10-02', 'Axel Menegozzi - Agustín Vaccaro. Entorno gráfico.pdf', 'ITI', 'Bases de Datos'),
(41, 'TP ESTADÍSTICA', NULL, 'Axel Menegozzi', 'Trabajo Práctico', '2023-10-02', 'Axel Menegozzi - Agustín Vaccaro. Entorno gráfico.pdf', 'AF', 'Estadística'),
(42, 'TP FINAL BBDD', NULL, 'Lucas Rodriguez', 'TP FINAL', '2023-10-02', 'Axel Menegozzi - Agustín Vaccaro. Entorno gráfico.pdf', 'ITI', 'Bases de Datos'),
(43, 'Noticiapp', NULL, 'Agustín Vaccaro', 'Desarrollo de App', '2023-10-02', 'Axel Menegozzi - Agustín Vaccaro. Entorno gráfico.pdf', 'DS', 'Programación II'),
(45, 'TP Programacion', NULL, 'Lucas Rodriguez, Facundo Ferreyra', 'TP FINAL', '2023-10-02', 'Axel Menegozzi - Agustín Vaccaro. Entorno gráfico.pdf', 'ITI', 'Lógica y Programación'),
(47, 'Alertapp', NULL, 'Agustín Vaccaro, Axel Menegozzi', 'Desarrollo de App', '2023-10-02', 'Axel Menegozzi - Agustín Vaccaro. Entorno gráfico.pdf', 'DS', 'Práctica Profesionalizante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `user_id` int(11) NOT NULL,
  `nombre_de_usuario` varchar(20) NOT NULL,
  `contrasena` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user_id`, `nombre_de_usuario`, `contrasena`) VALUES
(1, 'admin', 'Urquiza49');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `id_carrera` (`id_carrera`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id_carrera`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`);

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
