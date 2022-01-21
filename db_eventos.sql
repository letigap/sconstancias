-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-03-2021 a las 22:59:01
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_eventos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campo_conocimiento`
--

CREATE TABLE `campo_conocimiento` (
  `id_cconocimiento` smallint(6) NOT NULL,
  `nombre_cconocimiento` varchar(70) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `campo_conocimiento`
--

INSERT INTO `campo_conocimiento` (`id_cconocimiento`, `nombre_cconocimiento`) VALUES
(1, 'Desarrollo económico'),
(2, 'Economía de la Tecnología'),
(3, 'Economía de los Recursos Naturales y Desarrollo Sustentable'),
(4, 'Economía Financiera'),
(5, 'Economía Internacional'),
(6, 'Economía Política'),
(7, 'Economía Pública'),
(8, 'Economía Urbana y Regional'),
(9, 'Historia Económica'),
(10, 'Teoría y Método de la Economía'),
(11, 'Desarrollo económico'),
(12, 'Ninguno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id_evento` smallint(6) NOT NULL,
  `id_tevento` smallint(6) NOT NULL,
  `img_evento` varchar(160) COLLATE utf8_bin NOT NULL,
  `nombre_evento` varchar(500) COLLATE utf8_bin NOT NULL,
  `descripcion_evento` varchar(900) COLLATE utf8_bin DEFAULT NULL,
  `fecha_evento` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `cartel_evento` varchar(160) COLLATE utf8_bin NOT NULL,
  `organizador_evento` varchar(250) COLLATE utf8_bin NOT NULL,
  `sede_evento` varchar(250) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id_evento`, `id_tevento`, `img_evento`, `nombre_evento`, `descripcion_evento`, `fecha_evento`, `cartel_evento`, `organizador_evento`, `sede_evento`) VALUES
(1, 13, '', 'Disertación: Tipo de cambio real, demanda efectiva, crecimiento económico y distribución del ingreso: Teoría y evidencia empírica para los países desarrollados y en desarrollo, 1960-2010', 'NULL', 'miércoles 7 de febrero de 2018, 18:00 hrs.', '', 'Academia Mexicana de Economía Política A.C.', 'Aula Magna Jesús Silva Herzog, Edificio B de la Facultad de Economía-UNAM, Circuito Interior, s/n, Ciudad Universitaria.'),
(2, 11, '', 'Cambio de época. América Latina frente a la Hora de la Igualdad: avances, retrocesos y desafíos', 'El programa está conformado por dos conferencias inagurales y cuatro mesas redondas.', 'Lunes 12 y martes 13 de febrero de 2018', '', 'La Universidad Nacional Autónoma de México (UNAM), a través del Programa Universitario de Estudios del Desarrollo (PUED), y la Comisión Económica para América Latina y el Caribe (CEPAL)', 'Auditorio Mtro. Jesús Silva Herzog del Posgrado de la Facultad de Economía Circuito Mario de la Cueva s/n, Ciudad Universitaria, CDMX (a un costado de Zona Cultural'),
(3, 6, '', 'Premio Young Scholar for Better Statistics', 'En el marco de la XXVI edición de la Conferencia de IAOS-OECD, la Asociación Internacional de Estadísticas Oficiales (IAOS, por sus siglas en inglés) y la Organización para la Cooperación y el Desarrollo Económicos (OCDE), instauran el premio Young Scholar for Better Statistics, para el trabajo de tesis, de maestría y doctorado, que muestre una contribución clara para una mejor comprensión de las estadísticas oficiales, su utilidad y desafíos, y las opciones para mejorar su producción en un determinado campo de estudio.', '3 de marzo de 2018', '', 'NULL', 'NULL'),
(4, 4, '', 'VIII Concurso de tesis de posgrado sobre América Latina o el Caribe', 'NULL', '13 de abril de 2018 a las 14:00 hrs.', '', 'Centro de Investigaciones sobre América Latina y el Caribe (CIALC) de la UNAM', 'NULL');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organizador`
--

CREATE TABLE `organizador` (
  `id_participante` smallint(6) NOT NULL,
  `id_evento` smallint(6) NOT NULL,
  `id_cconocimiento` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `organizador`
--

INSERT INTO `organizador` (`id_participante`, `id_evento`, `id_cconocimiento`) VALUES
(1, 1, 5),
(2, 2, 12),
(6, 2, 12),
(3, 2, 12),
(8, 2, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participante`
--

CREATE TABLE `participante` (
  `id_participante` smallint(6) NOT NULL,
  `id_rol` smallint(6) DEFAULT NULL,
  `nombre_participante` varchar(200) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `participante`
--

INSERT INTO `participante` (`id_participante`, `id_rol`, `nombre_participante`) VALUES
(1, 5, 'Carolina Perea Lins'),
(2, 1, 'Citlali Ponce Basaldua'),
(3, 2, 'Seyka Cabrera Sandoval '),
(4, 9, 'Paty Montiel Martínez'),
(6, 7, 'Manuel Pérez García'),
(7, 2, 'Antonio Ibarra Romero'),
(8, 7, 'Francisco Martínez Hernández');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_participante`
--

CREATE TABLE `rol_participante` (
  `id_rol` smallint(6) NOT NULL,
  `nombre_rol` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `rol_participante`
--

INSERT INTO `rol_participante` (`id_rol`, `nombre_rol`) VALUES
(1, 'Autor'),
(2, 'Comentarista'),
(3, 'Coordinador'),
(4, 'Moderador'),
(5, 'Organizador'),
(6, 'Participante'),
(7, 'Ponente'),
(8, 'Profesor'),
(9, 'Traductor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_evento`
--

CREATE TABLE `tipo_evento` (
  `id_tevento` smallint(6) NOT NULL,
  `nombre_tevento` varchar(15) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tipo_evento`
--

INSERT INTO `tipo_evento` (`id_tevento`, `nombre_tevento`) VALUES
(1, 'Coloquio'),
(2, 'Conferencia'),
(3, 'Congreso'),
(4, 'Curso'),
(5, 'Diplomado'),
(6, 'Foro'),
(7, 'Mesa de debate'),
(8, 'Mesa de trabajo'),
(9, 'Ponencia'),
(10, 'Presentación de'),
(11, 'Taller'),
(12, 'Seminario'),
(13, 'Simposio');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `campo_conocimiento`
--
ALTER TABLE `campo_conocimiento`
  ADD PRIMARY KEY (`id_cconocimiento`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `id_tevento` (`id_tevento`);

--
-- Indices de la tabla `organizador`
--
ALTER TABLE `organizador`
  ADD KEY `id_participante` (`id_participante`),
  ADD KEY `id_evento` (`id_evento`),
  ADD KEY `id_cconocimiento` (`id_cconocimiento`);

--
-- Indices de la tabla `participante`
--
ALTER TABLE `participante`
  ADD PRIMARY KEY (`id_participante`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `rol_participante`
--
ALTER TABLE `rol_participante`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tipo_evento`
--
ALTER TABLE `tipo_evento`
  ADD PRIMARY KEY (`id_tevento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `campo_conocimiento`
--
ALTER TABLE `campo_conocimiento`
  MODIFY `id_cconocimiento` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id_evento` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `participante`
--
ALTER TABLE `participante`
  MODIFY `id_participante` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `rol_participante`
--
ALTER TABLE `rol_participante`
  MODIFY `id_rol` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `tipo_evento`
--
ALTER TABLE `tipo_evento`
  MODIFY `id_tevento` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`id_tevento`) REFERENCES `tipo_evento` (`id_tevento`);

--
-- Filtros para la tabla `organizador`
--
ALTER TABLE `organizador`
  ADD CONSTRAINT `organizador_ibfk_1` FOREIGN KEY (`id_participante`) REFERENCES `participante` (`id_participante`),
  ADD CONSTRAINT `organizador_ibfk_2` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id_evento`),
  ADD CONSTRAINT `organizador_ibfk_3` FOREIGN KEY (`id_cconocimiento`) REFERENCES `campo_conocimiento` (`id_cconocimiento`);

--
-- Filtros para la tabla `participante`
--
ALTER TABLE `participante`
  ADD CONSTRAINT `participante_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol_participante` (`id_rol`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
