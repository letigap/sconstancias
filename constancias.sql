-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-12-2021 a las 23:07:19
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `constancias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `IdEvento` smallint(6) NOT NULL,
  `IdTipoEvento` smallint(6) NOT NULL,
  `NombreEvento` varchar(500) COLLATE utf8_bin NOT NULL,
  `ProfesorEvento` varchar(250) COLLATE utf8_bin NOT NULL,
  `ProcedenciaProfeEvento` varchar(300) COLLATE utf8_bin NOT NULL,
  `FechaEvento` date NOT NULL DEFAULT current_timestamp(),
  `CoordinadorEvento` varchar(300) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`IdEvento`, `IdTipoEvento`, `NombreEvento`, `ProfesorEvento`, `ProcedenciaProfeEvento`, `FechaEvento`, `CoordinadorEvento`) VALUES
(1, 2, 'Economía en tiempos de pandemia', 'Carlos Herrera', '', '0000-00-00', ''),
(2, 5, 'Prueba de inserción de evento', 'Thirwall', 'Extranjero', '0000-00-00', 'Hideo hawochi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcionevento`
--

CREATE TABLE `inscripcionevento` (
  `idEvento` smallint(6) NOT NULL,
  `RfcParticipante` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `FechaInscripcion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `inscripcionevento`
--

INSERT INTO `inscripcionevento` (`idEvento`, `RfcParticipante`, `FechaInscripcion`) VALUES
(1, 'GRPL690222C15', '0000-00-00'),
(1, 'GAPL690222C15', '2021-08-27'),
(1, 'GAPF301101F21', '2021-12-02'),
(2, 'GAPF301101F21', '2021-12-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participante`
--

CREATE TABLE `participante` (
  `RfcParticipante` varchar(15) COLLATE utf8_bin NOT NULL,
  `NombreParticipante` varchar(80) COLLATE utf8_bin NOT NULL,
  `ApellidopParticipante` varchar(80) COLLATE utf8_bin NOT NULL,
  `ApellidomParticipante` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  `EmailParticipante` varchar(100) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `participante`
--

INSERT INTO `participante` (`RfcParticipante`, `NombreParticipante`, `ApellidopParticipante`, `ApellidomParticipante`, `EmailParticipante`) VALUES
('GAPF301101F21', 'Fernanda', 'García', 'Pérez', 'garciap.fernanda@gmail.com'),
('GAPL690222C15', 'Leticia', 'Garcés', 'Perea', 'garciap.leticia@gmail.com'),
('GRPL690222C15', 'Leticia', 'García', 'Pérez', 'letiga@unam.mx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoevento`
--

CREATE TABLE `tipoevento` (
  `IdTipoEvento` smallint(6) NOT NULL,
  `NombreTipoEvento` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `elEvento` varchar(35) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipoevento`
--

INSERT INTO `tipoevento` (`IdTipoEvento`, `NombreTipoEvento`, `elEvento`) VALUES
(1, 'Coloquio', 'al Coloquio'),
(2, 'Conferencia', 'a la Conferencia'),
(3, 'Curso', 'al Curso'),
(4, 'Seminario', 'al Seminario'),
(5, 'Seminario Internacional', 'al Seminario Internacional'),
(6, 'Taller', 'al Taller'),
(7, 'Mesa Redonda', 'a la Mesa redonda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(200) COLLATE utf8_bin NOT NULL,
  `emailUsuario` varchar(200) COLLATE utf8_bin NOT NULL,
  `passwordUsuario` char(120) COLLATE utf8_bin NOT NULL,
  `estatusUsuario` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombreUsuario`, `emailUsuario`, `passwordUsuario`, `estatusUsuario`) VALUES
(1, 'Leticia García Pérez', 'letiga@unam.mx', '$2y$10$qLtT.xQHFU/q.GgWap9ZkeNnyvevUVueDVkPtzml0VIKQXGR7ixDq', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`IdEvento`),
  ADD UNIQUE KEY `NombreEvento` (`NombreEvento`),
  ADD KEY `IdTipoEvento` (`IdTipoEvento`);

--
-- Indices de la tabla `inscripcionevento`
--
ALTER TABLE `inscripcionevento`
  ADD KEY `idEvento` (`idEvento`),
  ADD KEY `RfcParticipante` (`RfcParticipante`);

--
-- Indices de la tabla `participante`
--
ALTER TABLE `participante`
  ADD PRIMARY KEY (`RfcParticipante`);

--
-- Indices de la tabla `tipoevento`
--
ALTER TABLE `tipoevento`
  ADD PRIMARY KEY (`IdTipoEvento`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `IdEvento` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipoevento`
--
ALTER TABLE `tipoevento`
  MODIFY `IdTipoEvento` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`IdTipoEvento`) REFERENCES `tipoevento` (`IdTipoEvento`);

--
-- Filtros para la tabla `inscripcionevento`
--
ALTER TABLE `inscripcionevento`
  ADD CONSTRAINT `inscripcionevento_ibfk_1` FOREIGN KEY (`idEvento`) REFERENCES `evento` (`IdEvento`),
  ADD CONSTRAINT `inscripcionevento_ibfk_2` FOREIGN KEY (`RfcParticipante`) REFERENCES `participante` (`RfcParticipante`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
