
-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2021 a las 18:25:05
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
-- Estructura de tabla para la tabla `tipoevento`
--

CREATE TABLE `tipoevento` (
  `IdTipoEvento` smallint(6) NOT NULL AUTO_INCREMENT,
  `NombreTipoEvento` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `elEvento` varchar(35) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`IdTipoEvento`)
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
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `IdEvento` smallint(6) NOT NULL AUTO_INCREMENT,
  `IdTipoEvento` smallint(6) NOT NULL,
  `NombreEvento` varchar(500) COLLATE utf8_bin NOT NULL,
  `ProfesorEvento` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `ProcedenciaProfeEvento` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `FechaEvento` varchar(200) COLLATE utf8_bin NOT NULL,
  `CoordinadorEvento` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`IdEvento`),
  FOREIGN KEY (`IdTipoEvento`) REFERENCES `tipoevento` (`IdTipoEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participante`
--

CREATE TABLE `participante` (
  `RfcParticipante` varchar(15) COLLATE utf8_bin NOT NULL,
  `NombreParticipante` varchar(80) COLLATE utf8_bin NOT NULL,
  `ApellidopParticipante` varchar(80) COLLATE utf8_bin NOT NULL,
  `ApellidomParticipante` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  `EmailParticipante` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`RfcParticipante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcionevento`
--

CREATE TABLE `inscripcionevento` (
  `IdEvento` smallint(6) NOT NULL,
  `RfcParticipante` varchar(30) COLLATE utf8_bin NOT NULL,
  `FechaInscripcion` date NOT NULL,
  FOREIGN KEY (`IdEvento`) REFERENCES `evento` (`IdEvento`),
  FOREIGN KEY (`RfcParticipante`) REFERENCES `participante` (`RfcParticipante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombreUsuario` varchar(200) COLLATE utf8_bin NOT NULL,
  `emailUsuario` varchar(200) COLLATE utf8_bin NOT NULL,
  `passwordUsuario` char(120) COLLATE utf8_bin NOT NULL,
  `estatusUsuario` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombreUsuario`, `emailUsuario`, `passwordUsuario`, `estatusUsuario`) VALUES
(1, 'Leticia García Pérez', 'letiga@unam.mx', '$2y$10$qLtT.xQHFU/q.GgWap9ZkeNnyvevUVueDVkPtzml0VIKQXGR7ixDq', 1);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

A
A
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
