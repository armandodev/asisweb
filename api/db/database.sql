-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2024 a las 21:33:39
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
-- Base de datos: `asisweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `control_number` varchar(14) NOT NULL,
  `status` enum('Presente','Ausente','Retardo','Justificado') NOT NULL,
  `report_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `control_number`, `status`, `report_id`) VALUES
(1, '21316061210279', 'Presente', 3),
(2, '21316061210179', 'Ausente', 3),
(3, '21316061210290', 'Ausente', 3),
(4, '21316061210131', 'Ausente', 3),
(5, '21316061210004', 'Ausente', 3),
(6, '21316061210091', 'Ausente', 3),
(7, '21316061210009', 'Ausente', 3),
(8, '21316061210011', 'Ausente', 3),
(9, '21316061210298', 'Ausente', 3),
(10, '21316061210226', 'Ausente', 3),
(11, '21316061210094', 'Ausente', 3),
(12, '21316061210093', 'Ausente', 3),
(13, '21316061210016', 'Ausente', 3),
(14, '21316061210207', 'Ausente', 3),
(15, '21316061210212', 'Ausente', 3),
(16, '21316061210172', 'Ausente', 3),
(17, '21316061210174', 'Ausente', 3),
(18, '21316061210028', 'Ausente', 3),
(19, '21316061210238', 'Ausente', 3),
(20, '21316061210218', 'Ausente', 3),
(21, '21316061210035', 'Ausente', 3),
(22, '20316061210113', 'Ausente', 3),
(23, '20316061210052', 'Ausente', 3),
(24, '21316061210132', 'Ausente', 3),
(25, '21316061210037', 'Ausente', 3),
(26, '20316061210172', 'Ausente', 3),
(27, '21316061210042', 'Ausente', 3),
(28, '21316061210107', 'Ausente', 3),
(29, '21316061210086', 'Ausente', 3),
(30, '21316061210139', 'Ausente', 3),
(31, '21316061210189', 'Ausente', 3),
(32, '21316061210052', 'Ausente', 3),
(33, '21316061210170', 'Ausente', 3),
(34, '21316061210058', 'Ausente', 3),
(35, '21316061210166', 'Ausente', 3),
(36, '21316061210087', 'Ausente', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `report_id` (`report_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`report_id`) REFERENCES `reports` (`report_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
