-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-09-2026 a las 17:46:51
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
-- Base de datos: `justificantes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas`
--

CREATE TABLE `salidas` (
  `matricula` varchar(20) NOT NULL,
  `nombre_alumno` varchar(100) NOT NULL,
  `semestre_grupo` varchar(20) NOT NULL,
  `especialidad` varchar(100) NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `hora_salida` time NOT NULL,
  `autorizado1` varchar(100) NOT NULL,
  `autorizado2` varchar(100) DEFAULT NULL,
  `autorizado3` varchar(100) DEFAULT NULL,
  `autorizado4` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salidas`
--

INSERT INTO `salidas` (`matricula`, `nombre_alumno`, `semestre_grupo`, `especialidad`, `motivo`, `fecha`, `hora_salida`, `autorizado1`, `autorizado2`, `autorizado3`, `autorizado4`) VALUES
('1', '1', '1', '1', '1', '2026-09-02', '21:24:00', '1', '1', '1', '1'),
('2', '2', '2', '2', '2', '2026-09-15', '09:47:00', 'xd', 'xd', 'xd', 'xd'),
('954985858t5858585858', 'h r5y6jukyky', 'o68,r', 'im76uy', 'l7ilitulkkhjh', '0005-05-05', '21:23:00', 'j', 'j', 'j', 'j');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD PRIMARY KEY (`matricula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
