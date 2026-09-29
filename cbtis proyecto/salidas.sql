-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-09-2026 a las 20:22:22
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

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
  `turno` text NOT NULL,
  `autorizado1` varchar(100) NOT NULL,
  `autorizado2` varchar(100) DEFAULT NULL,
  `autorizado3` varchar(100) DEFAULT NULL,
  `autorizado4` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salidas`
--

INSERT INTO `salidas` (`matricula`, `nombre_alumno`, `semestre_grupo`, `especialidad`, `turno`, `autorizado1`, `autorizado2`, `autorizado3`, `autorizado4`) VALUES
('1', '1', '1', '1', '', '1', '1', '1', '1'),
('12345678', 'Pepe Botellas', '5B', 'Programacion', '', 'Lol', '', '', ''),
('2', '2', '2', '2', '', 'xd', 'xd', 'xd', 'xd'),
('24313052580016333333', 'Gael', '34', 'Programacion', '', 'Donald', '', '', ''),
('3215656546', 'Gustavo Ceratti', '3B', 'Contaduria', '', 'lolo', '', '', ''),
('32156565467', 'Gustavo Ceratti', '3B', 'Contaduria', '', 'lolo', '', '', ''),
('321565654678', 'Gustavo Ceratti', '3B', 'Contaduria', '', 'lolo', '', '', ''),
('3215656546789', 'Gustavo Ceratti', '3B', 'Contaduria', '', 'lolo', '', '', ''),
('32156565467891', 'Gustavo Ceratti', '3B', 'Contaduria', '', 'lolo', '', '', ''),
('321565654678912', 'Gustavo Ceratti', '3B', 'Contaduria', '', 'lolo', '', '', ''),
('3215656546789123', 'Gustavo Ceratti', '3B', 'Contaduria', '', 'lolo', '', '', ''),
('7418529', 'Charlie Kirk', '5B', 'Hospedaje', '', 'Lol a', '', '', ''),
('785693479', 'Abner', '6A', 'Programacion', 'Matutino', 'lolol', '', '', ''),
('7856934794', 'Abner Eli', '6A', 'Programacion', 'Matutino', 'lolol', '', '', ''),
('87654321', 'Botellas Pepe', '5B', 'Alimentos', '', 'Lol a', '', '', ''),
('954985858t5858585858', 'h r5y6jukyky', 'o68,r', 'im76uy', '', 'j', 'j', 'j', 'j'),
('963258', 'Jeffrey Tempstein', '5B', 'Tocar niños', '', 'Donald', '', '', ''),
('987123654', 'PacMan', '5B', 'Hospedaje', '', 'cloud', '', '', '');

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
