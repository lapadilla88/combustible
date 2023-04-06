-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-03-2023 a las 22:36:06
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `basededatos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combustible`
--

CREATE TABLE `combustible` (
  `idcombustible` int(11) NOT NULL,
  `token` tinytext DEFAULT NULL,
  `nombrecombustible` varchar(30) DEFAULT NULL,
  `codcombustible` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `combustible`
--

INSERT INTO `combustible` (`idcombustible`, `token`, `nombrecombustible`, `codcombustible`) VALUES
(124924689, 'c5b2e1223ee05d78ae2681a8bf1b3895', 'GAS NATURAL', 'demo0001'),
(634686161, 'd546ac4376c7f7d670ac24c7afe5716e', 'DIESEL', 'demo0001'),
(930947558, 'b63928c35236bfff7d68423ad44b5ee1', 'GASOLINA 84', 'demo0001'),
(964080359, '66fdbc499b5c9e4f23b8881e19c6fae3', 'GASOLINA 95', 'demo0001'),
(1608403730, 'f15a0c339a0cb60c433a4f4db298eda2', 'GASOLINA 97', 'demo0001'),
(1733173510, '9712754b9ee8fca1e408608c4d167e60', 'GASOLINA 90', 'demo0001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductor`
--

CREATE TABLE `conductor` (
  `idconductor` int(11) NOT NULL,
  `token` tinytext DEFAULT NULL,
  `nombreconductor` varchar(80) DEFAULT NULL,
  `dni` varchar(10) DEFAULT NULL,
  `licencia` varchar(12) DEFAULT NULL,
  `categoria` varchar(45) DEFAULT NULL,
  `telefonoconductor` varchar(45) DEFAULT NULL,
  `codcombustible` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `conductor`
--

INSERT INTO `conductor` (`idconductor`, `token`, `nombreconductor`, `dni`, `licencia`, `categoria`, `telefonoconductor`, `codcombustible`) VALUES
(618314987, '5db710293a18449e7479eb8c8239bf4f', 'ALFREDO CASTRO CENTELLAS', '3752845', '3752845', 'A', '77068253', 'demo0001'),
(730644307, '541468735bb973cec86d69869fbdd9a4', 'OMAR COIMBRA AGUIRRE', '6243108', '6243108', 'A', '70972223', 'demo0001'),
(854894611, 'd4a668217febe357ac744835603f89ab', 'MARCELO MATIAS BEJARANO SEVERICHE', '8195942', '8195942', 'A', '78167010', 'demo0001'),
(1323120204, '252c82b2db9ebb16da0d118e4f8b4f05', 'DARWIN GABRIEL SALAZAR SOLIZ', '9022391', '9022391', 'M', '63458338', 'demo0001'),
(1361084911, 'ee74e8e34544efe2a7b172352ca3d18f', 'DAINER BARBA ZEBALLOS', '31254258', '6358733', 'A', '79918299', 'demo0001'),
(1707911844, '61e2df29ff89ded7cf04900d97d1b625', 'ERICK NOEL CASTRO LOPEZ', '9814645', '9814645', 'A', '65867056', 'demo0001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `idevento` int(11) NOT NULL,
  `modulo` varchar(45) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `evento` varchar(45) DEFAULT NULL,
  `documento` varchar(45) DEFAULT NULL,
  `codcombustible` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`idevento`, `modulo`, `usuario`, `fecha`, `evento`, `documento`, `codcombustible`) VALUES
(35, 'Usuarios', 'admin', '2021-09-06 18:02:03', 'Registro', 'Oscar', 'demo0001'),
(36, 'Usuarios', 'admin', '2021-09-06 18:02:21', 'Modificar', 'Oscar4', 'demo0001'),
(37, 'Usuarios', 'admin', '2021-09-06 18:02:46', 'Modificar', 'Oscar4', 'demo0001'),
(38, 'Usuarios', 'admin', '2021-09-06 18:03:00', 'Eliminar', 'Oscar4', 'demo0001'),
(39, 'Usuarios', 'admin', '2021-09-06 18:31:22', 'Modificar', 'admin', 'demo0001'),
(40, 'Usuarios', 'admin', '2021-09-06 18:31:29', 'Modificar', 'admin', 'demo0001'),
(41, 'Usuarios', 'admin', '2021-09-06 18:31:45', 'Modificar', 'prueba', 'demo0001'),
(42, 'Usuarios', 'admin', '2021-09-06 18:32:43', 'Modificar', 'prueba', 'demo0001'),
(43, 'Grifo', 'admin', '2021-09-06 18:56:17', 'Registro', '530236599855', 'demo0001'),
(44, 'Grifo', 'admin', '2021-09-06 19:05:30', 'Modificar', '5302365998551', 'demo0001'),
(45, 'Grifo', 'admin', '2021-09-06 19:06:09', 'Modificar', '530236599855', 'demo0001'),
(46, 'Grifo', 'admin', '2021-09-06 19:10:51', 'Registro', '5', 'demo0001'),
(47, 'Grifo', 'admin', '2021-09-06 19:10:57', 'Eliminar', '5', 'demo0001'),
(48, 'Combustible', 'admin', '2021-09-07 14:09:44', 'Registro', 'OTRO COMBUSTIBLE', 'demo0001'),
(49, 'combustible', 'admin', '2021-09-07 14:13:23', 'Modificar', 'OTRO COMBUSTIBLE02', 'demo0001'),
(50, 'Usuarios', 'admin', '2021-09-07 15:36:28', 'Modificar', 'prueba', 'demo0001'),
(51, 'Combustible', 'admin', '2021-09-07 15:42:00', 'Eliminar', 'OTRO COMBUSTIBLE02', 'demo0001'),
(52, 'Tipo de Mantenimiento', 'admin', '2021-09-07 16:31:09', 'Registro', 'CAMBIO DE ACEITE', 'demo0001'),
(53, 'Tipo de Mantenimiento', 'admin', '2021-09-07 16:31:27', 'Modificar', 'CAMBIO DE ACEITE02', 'demo0001'),
(54, 'Tipo de Mantenimiento', 'admin', '2021-09-07 16:33:46', 'Registro', 'CAMBIO DE ACEITE', 'demo0001'),
(55, 'Tipo de Mantenimiento', 'admin', '2021-09-07 16:34:36', 'Registro', 'CAMBIO DE ACEITE', 'demo0001'),
(56, 'Tipo de Mantenimiento', 'admin', '2021-09-07 16:34:40', 'Eliminar', 'CAMBIO DE ACEITE', 'demo0001'),
(57, 'Combustible', 'admin', '2021-09-07 16:38:46', 'Registro', 'OTRO COMBUSTIBLE', 'demo0001'),
(58, 'Combustible', 'admin', '2021-09-07 16:38:54', 'Modificar', 'OTRO COMBUSTIBLE01', 'demo0001'),
(59, 'Combustible', 'admin', '2021-09-07 16:38:58', 'Eliminar', 'OTRO COMBUSTIBLE01', 'demo0001'),
(60, 'Conductor', 'admin', '2021-09-07 16:41:23', 'Registro', '00000000', 'demo0001'),
(61, 'Conductor', 'admin', '2021-09-07 16:41:38', 'Modificar', '00000000', 'demo0001'),
(62, 'Conductor', 'admin', '2021-09-07 16:41:43', 'Eliminar', '00000000', 'demo0001'),
(63, 'Grifo', 'admin', '2021-09-08 11:04:34', 'Registro', '59658', 'demo0001'),
(64, 'Grifo', 'admin', '2021-09-08 11:05:17', 'Modificar', '59658', 'demo0001'),
(65, 'Grifo', 'admin', '2021-09-08 11:06:28', 'Eliminar', '59658', 'demo0001'),
(66, 'Tipo de Mantenimiento', 'admin', '2021-09-08 11:09:05', 'Registro', 'CAMBIO DE ACEITE', 'demo0001'),
(67, 'Tipo de Mantenimiento', 'admin', '2021-09-08 11:09:15', 'Modificar', 'CAMBIO DE ACEITE02', 'demo0001'),
(68, 'Tipo de Mantenimiento', 'admin', '2021-09-08 11:09:19', 'Eliminar', 'CAMBIO DE ACEITE02', 'demo0001'),
(69, 'Usuarios', 'admin', '2021-09-08 11:19:55', 'Registro', '1', 'demo0001'),
(70, 'Usuarios', 'admin', '2021-09-08 11:21:05', 'Modificar', '12', 'demo0001'),
(71, 'Usuarios', 'admin', '2021-09-08 11:21:46', 'Cambiar Usuario', '', 'demo0001'),
(72, 'Usuarios', 'admin', '2021-09-08 11:22:59', 'Cambiar Usuario', '', 'demo0001'),
(73, 'Usuarios', 'admin', '2021-09-08 11:24:12', 'Cambiar Usuario', 'admin', 'demo0001'),
(74, 'Usuarios', 'admin', '2021-09-08 11:24:58', 'Eliminar', '12', 'demo0001'),
(75, 'Usuarios', 'prueba', '2021-09-08 13:34:10', 'Modificar', 'admin', 'demo0001'),
(76, 'Usuarios', 'prueba', '2021-09-08 13:34:18', 'Modificar', 'admin', 'demo0001'),
(77, 'Vehiculo', 'admin', '2021-09-08 13:35:12', 'Registro', 'A1N045', 'demo0001'),
(78, 'Vehiculo', 'admin', '2021-09-08 13:35:57', 'Modificar', 'A10215', 'demo0001'),
(79, 'Vehiculo', 'admin', '2021-09-08 13:36:37', 'Eliminar', 'A10215', 'demo0001'),
(80, 'Vehiculo', 'admin', '2021-09-08 22:16:45', 'Registro', 'A1N090', 'demo0001'),
(81, 'Vehiculo', 'admin', '2021-09-08 22:17:04', 'Eliminar', 'A1N090', 'demo0001'),
(82, 'Vales', 'admin', '2021-09-11 11:30:28', 'Registro', '123456', 'demo0001'),
(83, 'Vales', 'admin', '2021-09-11 14:21:53', 'Registro', '123459', 'demo0001'),
(84, 'Vales', 'admin', '2021-09-11 14:28:23', 'Registro', '123400', 'demo0001'),
(85, 'Vehiculo', 'admin', '2021-09-11 14:46:10', 'Modificar', 'F54-95L', 'demo0001'),
(86, 'Vales', 'admin', '2021-09-11 14:51:49', 'Registro', '021525', 'demo0001'),
(87, 'Vehiculo', 'admin', '2021-09-11 14:52:43', 'Modificar', 'F54-95L', 'demo0001'),
(88, 'Vehiculo', 'admin', '2021-09-11 14:53:46', 'Registro', 'DF8-L54', 'demo0001'),
(89, 'Conductor', 'admin', '2021-09-12 19:58:55', 'Registro', '62036987', 'demo0001'),
(90, 'Conductor', 'admin', '2021-09-12 19:59:07', 'Modificar', '44290775', 'demo0001'),
(91, 'Grifo', 'admin', '2021-09-12 20:00:01', 'Registro', '65321578952', 'demo0001'),
(92, 'Vales', 'admin', '2021-09-12 20:07:39', 'Modificar', '123456', 'demo0001'),
(93, 'Vales', 'admin', '2021-09-12 20:08:58', 'Modificar', '123456', 'demo0001'),
(94, 'Vales', 'admin', '2021-09-12 20:11:33', 'Modificar', '123456', 'demo0001'),
(95, 'Vales', 'admin', '2021-09-12 20:11:47', 'Modificar', '123456', 'demo0001'),
(96, 'Vales', 'admin', '2021-09-12 20:12:03', 'Modificar', '123456', 'demo0001'),
(97, 'Vales', 'admin', '2021-09-12 20:12:18', 'Modificar', '123456N', 'demo0001'),
(98, 'Vales', 'admin', '2021-09-12 20:13:03', 'Modificar', '123459', 'demo0001'),
(99, 'Vales', 'admin', '2021-09-12 20:13:12', 'Modificar', '123400', 'demo0001'),
(100, 'Vales', 'admin', '2021-09-12 20:13:26', 'Modificar', '123400', 'demo0001'),
(101, 'Vales', 'admin', '2021-09-12 20:13:38', 'Modificar', '123400', 'demo0001'),
(102, 'Vales', 'admin', '2021-09-12 20:15:51', 'Modificar', '021525', 'demo0001'),
(103, 'Vales', 'admin', '2021-09-12 20:17:14', 'Modificar', '123456N', 'demo0001'),
(104, 'Vales', 'admin', '2021-09-12 20:17:24', 'Modificar', '123456N', 'demo0001'),
(105, 'Vales', 'admin', '2021-09-12 20:28:55', 'Modificar', '123459', 'demo0001'),
(106, 'Vales', 'admin', '2021-09-12 20:29:44', 'Modificar', '123400', 'demo0001'),
(107, 'Vales', 'admin', '2021-09-12 20:29:53', 'Modificar', '123456N', 'demo0001'),
(108, 'Vales', 'admin', '2021-09-12 20:30:08', 'Modificar', '021525', 'demo0001'),
(109, 'Vales', 'admin', '2021-09-12 20:30:23', 'Modificar', '021525', 'demo0001'),
(110, 'Vales', 'admin', '2021-09-12 20:31:13', 'Modificar', '123456N', 'demo0001'),
(111, 'Vales', 'admin', '2021-09-12 20:31:21', 'Modificar', '123400', 'demo0001'),
(112, 'Vales', 'admin', '2021-09-12 20:33:14', 'Modificar', '123459', 'demo0001'),
(113, 'Vales', 'admin', '2021-09-12 20:33:37', 'Modificar', '123459', 'demo0001'),
(114, 'Vales', 'admin', '2021-09-12 20:40:52', 'Registro', '5555', 'demo0001'),
(115, 'Vales', 'admin', '2021-09-12 20:41:03', 'Eliminar', '5555', 'demo0001'),
(116, 'Tipo de Mantenimiento', 'admin', '2021-09-12 21:04:25', 'Registro', 'CAMBIO DE ACEITE', 'demo0001'),
(117, 'Mantenimento', 'admin', '2021-09-13 16:25:29', 'Registro', '44545', 'demo0001'),
(118, 'Mantenimento', 'admin', '2021-09-13 16:26:59', 'Registro', '44545', 'demo0001'),
(119, 'Mantenimento', 'admin', '2021-09-13 18:47:42', 'Modificar', '44545', 'demo0001'),
(120, 'Mantenimento', 'admin', '2021-09-13 18:48:07', 'Modificar', '44545N', 'demo0001'),
(121, 'Mantenimento', 'admin', '2021-09-13 18:48:15', 'Modificar', '44545N', 'demo0001'),
(122, 'Mantenimento', 'admin', '2021-09-13 18:48:26', 'Modificar', '44545N', 'demo0001'),
(123, 'Mantenimento', 'admin', '2021-09-13 18:48:36', 'Modificar', '44545N', 'demo0001'),
(124, 'Mantenimento', 'admin', '2021-09-13 18:48:48', 'Modificar', '44545N', 'demo0001'),
(125, 'Mantenimento', 'admin', '2021-09-13 18:49:00', 'Modificar', '44545N', 'demo0001'),
(126, 'Mantenimento', 'admin', '2021-09-13 18:54:52', 'Registro', '1', 'demo0001'),
(127, 'Mantenimiento', 'admin', '2021-09-13 18:55:08', 'Eliminar', '1', 'demo0001'),
(128, 'Usuarios', 'admin', '2021-09-14 18:53:03', 'Modificar', 'admin', 'demo0001'),
(129, 'Usuarios', 'admin', '2021-09-14 18:58:49', 'Modificar', 'admin', 'demo0001'),
(130, 'Usuarios', 'admin', '2021-09-14 18:59:03', 'Modificar', 'admin', 'demo0001'),
(131, 'Usuarios', 'admin', '2021-09-14 18:59:19', 'Modificar', 'admin', 'demo0001'),
(132, 'Usuarios', 'admin', '2021-09-14 18:59:52', 'Registro', '1', 'demo0001'),
(133, 'Usuarios', 'admin', '2021-09-14 19:02:04', 'Registro', '1', 'demo0001'),
(134, 'Usuarios', 'admin', '2021-09-14 19:04:34', 'Registro', '1', 'demo0001'),
(135, 'Usuarios', 'admin', '2021-09-14 19:05:14', 'Modificar', '1', 'demo0001'),
(136, 'Usuarios', 'admin', '2021-09-14 19:05:46', 'Modificar', '1', 'demo0001'),
(137, 'Usuarios', 'admin', '2021-09-14 19:06:21', 'Eliminar', '1', 'demo0001'),
(138, 'Usuarios', 'admin', '2021-09-14 19:23:24', 'Modificar', 'admin', 'demo0001'),
(139, 'Vehiculo', 'admin', '2021-09-15 14:10:16', 'Eliminar', 'DF8-L54', 'demo0001'),
(140, 'Grifo', 'admin', '2021-09-15 15:38:59', 'Registro', '5635', 'demo0001'),
(141, 'Combustible', 'admin', '2021-09-16 16:54:59', 'Registro', '<', 'demo0001'),
(142, 'Combustible', 'admin', '2021-09-16 17:06:20', 'Registro', 'FFF', 'demo0001'),
(143, 'Combustible', 'admin', '2021-09-16 17:09:56', 'Eliminar', '<', 'demo0001'),
(144, 'Combustible', 'admin', '2021-09-16 17:10:00', 'Eliminar', 'FFF', 'demo0001'),
(145, 'Combustible', 'admin', '2021-09-16 17:10:08', 'Registro', '<', 'demo0001'),
(146, 'Combustible', 'admin', '2021-09-16 17:10:17', 'Eliminar', '<', 'demo0001'),
(147, 'Combustible', 'admin', '2021-09-16 17:12:12', 'Registro', '<', 'demo0001'),
(148, 'Combustible', 'admin', '2021-09-16 17:12:18', 'Registro', 'D', 'demo0001'),
(149, 'Combustible', 'admin', '2021-09-16 17:12:22', 'Registro', 'F', 'demo0001'),
(150, 'Combustible', 'admin', '2021-09-16 17:12:48', 'Eliminar', 'F', 'demo0001'),
(151, 'Combustible', 'admin', '2021-09-16 17:12:51', 'Eliminar', 'D', 'demo0001'),
(152, 'Combustible', 'admin', '2021-09-16 17:12:58', 'Eliminar', '<', 'demo0001'),
(153, 'Combustible', 'admin', '2021-09-16 17:16:44', 'Registro', '5', 'demo0001'),
(154, 'Combustible', 'admin', '2021-09-16 17:19:53', 'Eliminar', '5', 'demo0001'),
(155, 'Combustible', 'admin', '2021-09-16 17:20:24', 'Registro', '<', 'demo0001'),
(156, 'Combustible', 'admin', '2021-09-16 17:21:53', 'Registro', '>', 'demo0001'),
(157, 'Combustible', 'admin', '2021-09-16 17:22:48', 'Eliminar', '<', 'demo0001'),
(158, 'Combustible', 'admin', '2021-09-16 17:22:50', 'Eliminar', '>', 'demo0001'),
(159, 'Combustible', 'admin', '2021-09-16 17:23:56', 'Registro', 'JKKK', 'demo0001'),
(160, 'Combustible', 'admin', '2021-09-16 17:24:03', 'Eliminar', 'JKKK', 'demo0001'),
(161, 'Combustible', 'admin', '2021-09-16 17:26:02', 'Registro', '/', 'demo0001'),
(162, 'Combustible', 'admin', '2021-09-16 17:26:08', 'Registro', '*', 'demo0001'),
(163, 'Combustible', 'admin', '2021-09-16 17:27:05', 'Registro', '\"', 'demo0001'),
(164, 'Combustible', 'admin', '2021-09-16 17:57:38', 'Eliminar', '/', 'demo0001'),
(165, 'Combustible', 'admin', '2021-09-16 17:57:46', 'Eliminar', '*', 'demo0001'),
(166, 'Combustible', 'admin', '2021-09-16 17:57:49', 'Eliminar', '', 'demo0001'),
(167, 'Combustible', 'admin', '2021-09-16 18:03:56', 'Registro', 'K', 'demo0001'),
(168, 'Combustible', 'admin', '2021-09-16 18:24:34', 'Registro', '.', 'demo0001'),
(169, 'Combustible', 'admin', '2021-09-16 18:25:03', 'Registro', '<', 'demo0001'),
(170, 'Combustible', 'admin', '2021-09-16 18:25:22', 'Registro', '[', 'demo0001'),
(171, 'Combustible', 'admin', '2021-09-16 18:27:01', 'Registro', '[', 'demo0001'),
(172, 'Combustible', 'admin', '2021-09-16 18:27:24', 'Registro', '<', 'demo0001'),
(173, 'Combustible', 'admin', '2021-09-16 18:29:57', 'Registro', '[', 'demo0001'),
(174, 'Combustible', 'admin', '2021-09-16 18:30:05', 'Registro', ']', 'demo0001'),
(175, 'Combustible', 'admin', '2021-09-16 18:30:21', 'Registro', '>', 'demo0001'),
(176, 'Combustible', 'admin', '2021-09-16 18:32:30', 'Registro', 'Â¿', 'demo0001'),
(177, 'Combustible', 'admin', '2021-09-16 18:38:01', 'Registro', 'OLOO', 'demo0001'),
(178, 'Vales', 'admin', '2021-09-16 19:58:27', 'Eliminar', '021525', 'demo0001'),
(179, 'Vales', 'admin', '2021-09-16 19:58:32', 'Eliminar', '123400', 'demo0001'),
(180, 'Vales', 'admin', '2021-09-16 19:58:38', 'Eliminar', '123456N', 'demo0001'),
(181, 'Vales', 'admin', '2021-09-16 19:58:42', 'Eliminar', '123459', 'demo0001'),
(182, 'Mantenimiento', 'admin', '2021-09-16 19:58:46', 'Eliminar', '44545N', 'demo0001'),
(183, 'Combustible', 'admin', '2021-09-16 21:45:09', 'Registro', '', 'demo0001'),
(184, 'Combustible', 'admin', '2021-09-16 21:47:03', 'Registro', '', 'demo0001'),
(185, 'Combustible', 'admin', '2021-09-17 16:33:28', 'Registro', '', 'demo0001'),
(186, 'Combustible', 'admin', '2021-09-17 16:35:20', 'Registro', '', 'demo0001'),
(187, 'Combustible', 'admin', '2021-09-17 16:36:17', 'Registro', '', 'demo0001'),
(188, 'Combustible', 'admin', '2021-09-17 16:38:25', 'Registro', '', 'demo0001'),
(189, 'Combustible', 'admin', '2021-09-17 16:41:48', 'Registro', 'GASOLINA 90', 'demo0001'),
(190, 'Combustible', 'admin', '2021-09-17 16:44:13', 'Registro', 'GASOLINA 84', 'demo0001'),
(191, 'Combustible', 'admin', '2021-09-17 16:44:21', 'Registro', 'GASOLINA 95', 'demo0001'),
(192, 'Combustible', 'admin', '2021-09-17 16:44:27', 'Registro', 'GASOLINA 97', 'demo0001'),
(193, 'Combustible', 'admin', '2021-09-17 16:44:36', 'Registro', 'PETROLEO', 'demo0001'),
(194, 'Combustible', 'admin', '2021-09-17 16:45:12', 'Registro', 'DELETE FROM COMBUSTIBLE', 'demo0001'),
(195, 'Combustible', 'admin', '2021-09-17 16:45:42', 'Registro', 'GLP', 'demo0001'),
(196, 'Combustible', 'admin', '2021-09-20 16:28:38', 'Registro', 'KLKLKLK', 'demo0001'),
(197, 'Combustible', 'admin', '2021-09-20 16:28:49', 'Registro', 'DELETE', 'demo0001'),
(198, 'Combustible', 'admin', '2021-09-20 16:30:00', 'Registro', 'DROP', 'demo0001'),
(199, 'Combustible', 'admin', '2021-09-20 16:33:19', 'Registro', 'DELETE', 'demo0001'),
(200, 'Combustible', 'admin', '2021-09-20 16:34:39', 'Registro', 'DELETE', 'demo0001'),
(201, 'Combustible', 'admin', '2021-09-20 16:36:55', 'Registro', 'DELETE', 'demo0001'),
(202, 'Combustible', 'admin', '2021-09-20 16:40:24', 'Registro', 'DELETE FROM USUARIO', 'demo0001'),
(203, 'Combustible', 'admin', '2021-09-20 17:37:12', 'Registro', 'DELETE', 'demo0001'),
(204, 'Combustible', 'admin', '2021-09-20 17:48:16', 'Registro', 'OSCAR', 'demo0001'),
(205, 'Combustible', 'admin', '2021-09-20 18:19:06', 'Modificar', 'GLP2', 'demo0001'),
(206, 'Combustible', 'admin', '2021-09-20 18:20:17', 'Modificar', 'GLP2', 'demo0001'),
(207, 'Combustible', 'admin', '2021-09-20 18:20:25', 'Modificar', 'GLP', 'demo0001'),
(208, 'Combustible', 'admin', '2021-09-20 18:25:12', 'Registro', 'PRUEBA', 'demo0001'),
(209, 'Combustible', 'admin', '2021-09-20 18:25:29', 'Modificar', 'PRUEBA2', 'demo0001'),
(210, 'Combustible', 'admin', '2021-09-20 18:25:48', 'Eliminar', 'PRUEBA2', 'demo0001'),
(211, 'Vehiculo', 'admin', '2021-09-21 19:33:23', 'Registro', 'A1N079', 'demo0001'),
(212, 'Combustible', 'admin', '2021-09-21 19:34:04', 'Eliminar', 'OSCAR', 'demo0001'),
(213, 'Vehiculo', 'admin', '2021-09-22 12:23:33', 'Registro', 'A1N079', 'demo0001'),
(214, 'Vehiculo', 'admin', '2021-09-22 12:24:45', 'Registro', 'A1N456', 'demo0001'),
(215, 'Vehiculo', 'admin', '2021-09-22 12:25:10', 'Registro', 'A1N456', 'demo0001'),
(216, 'Vehiculo', 'admin', '2021-09-22 12:25:41', 'Registro', 'A1N456', 'demo0001'),
(217, 'Vehiculo', 'admin', '2021-09-22 12:26:42', 'Registro', 'A1N079', 'demo0001'),
(218, 'Vehiculo', 'admin', '2021-09-22 12:27:29', 'Registro', 'A1N079', 'demo0001'),
(219, 'Vehiculo', 'admin', '2021-09-22 12:28:43', 'Registro', 'A1N079', 'demo0001'),
(220, 'Vehiculo', 'admin', '2021-09-22 12:29:30', 'Registro', 'A1N456', 'demo0001'),
(221, 'Vehiculo', 'admin', '2021-09-22 13:36:24', 'Modificar', 'A1N456', 'demo0001'),
(222, 'Vehiculo', 'admin', '2021-09-22 13:37:14', 'Modificar', 'A1N456', 'demo0001'),
(223, 'Vehiculo', 'admin', '2021-09-22 13:38:43', 'Modificar', 'A1N079', 'demo0001'),
(224, 'Vehiculo', 'admin', '2021-09-22 13:40:15', 'Modificar', 'A1N079', 'demo0001'),
(225, 'Vehiculo', 'admin', '2021-09-22 13:41:06', 'Modificar', 'A1N079', 'demo0001'),
(226, 'Vehiculo', 'admin', '2021-09-22 13:42:50', 'Modificar', 'A1N079', 'demo0001'),
(227, 'Vehiculo', 'admin', '2021-09-22 13:43:02', 'Modificar', 'A1N079', 'demo0001'),
(228, 'Vehiculo', 'admin', '2021-09-22 13:44:57', 'Modificar', 'A1N456', 'demo0001'),
(229, 'Vehiculo', 'admin', '2021-09-22 13:45:05', 'Modificar', 'A1N456', 'demo0001'),
(230, 'Vehiculo', 'admin', '2021-09-22 13:45:14', 'Modificar', 'A1N456', 'demo0001'),
(231, 'Vehiculo', 'admin', '2021-09-22 13:45:29', 'Modificar', 'A1N456', 'demo0001'),
(232, 'Vehiculo', 'admin', '2021-09-22 13:45:49', 'Modificar', 'A1N012', 'demo0001'),
(233, 'Vehiculo', 'admin', '2021-09-22 14:20:53', 'Registro', 'A1N0794', 'demo0001'),
(234, 'Vehiculo', 'admin', '2021-09-22 14:21:16', 'Eliminar', 'A1N0794', 'demo0001'),
(235, 'Conductor', 'admin', '2021-09-22 18:02:51', 'Registro', '56232025', 'demo0001'),
(236, 'Conductor', 'admin', '2021-09-22 18:06:02', 'Registro', '31663065', 'demo0001'),
(237, 'Conductor', 'admin', '2021-09-22 18:06:50', 'Registro', '96301236', 'demo0001'),
(238, 'Conductor', 'admin', '2021-09-22 18:18:40', 'Modificar', '963012366', 'demo0001'),
(239, 'Conductor', 'admin', '2021-09-22 18:19:02', 'Modificar', '96301236', 'demo0001'),
(240, 'Conductor', 'admin', '2021-09-22 18:25:25', 'Registro', '555655', 'demo0001'),
(241, 'Conductor', 'admin', '2021-09-22 18:25:44', 'Eliminar', '555655', 'demo0001'),
(242, 'Tipo de Mantenimiento', 'admin', '2021-09-22 18:58:46', 'Registro', 'CAMBIO DE ACEITE02', 'demo0001'),
(243, 'Tipo de Mantenimiento', 'admin', '2021-09-22 19:00:11', 'Registro', 'CAMBIO DE PASTILLAS', 'demo0001'),
(244, 'Tipo de Mantenimiento', 'admin', '2021-09-22 19:06:50', 'Modificar', 'CAMBIO DE ACEITE', 'demo0001'),
(245, 'Tipo de Mantenimiento', 'admin', '2021-09-22 19:07:02', 'Modificar', 'CAMBIO DE ACEITE', 'demo0001'),
(246, 'Tipo de Mantenimiento', 'admin', '2021-09-22 19:07:17', 'Modificar', 'CAMBIO DE PASTILLAS', 'demo0001'),
(247, 'Tipo de Mantenimiento', 'admin', '2021-09-22 19:12:29', 'Registro', 'PRUEBA', 'demo0001'),
(248, 'Tipo de Mantenimiento', 'admin', '2021-09-22 19:12:39', 'Eliminar', 'PRUEBA', 'demo0001'),
(249, 'Tipo de Mantenimiento', 'admin', '2021-09-22 19:12:43', 'Eliminar', 'PRUEBA', 'demo0001'),
(250, 'Tipo de Mantenimiento', 'admin', '2021-09-22 19:13:32', 'Eliminar', 'PRUEBA', 'demo0001'),
(251, 'Grifo', 'admin', '2021-09-23 10:59:58', 'Registro', '3444', 'demo0001'),
(252, 'Grifo', 'admin', '2021-09-23 11:01:17', 'Registro', '89201245932', 'demo0001'),
(253, 'Grifo', 'admin', '2021-09-23 11:04:03', 'Registro', '96320325487', 'demo0001'),
(254, 'Grifo', 'admin', '2021-09-23 11:14:00', 'Modificar', '34445', 'demo0001'),
(255, 'Grifo', 'admin', '2021-09-23 11:14:42', 'Modificar', '3444', 'demo0001'),
(256, 'Grifo', 'admin', '2021-09-23 11:17:42', 'Eliminar', '3444', 'demo0001'),
(257, 'Conductor', 'admin', '2021-09-23 11:23:21', 'Modificar', '96301236', 'demo0001'),
(258, 'Conductor', 'admin', '2021-09-23 11:24:50', 'Modificar', '10356302', 'demo0001'),
(259, 'Usuarios', 'admin', '2021-09-23 12:41:24', 'Modificar', 'prueba', 'demo0001'),
(260, 'Usuarios', 'prueba', '2021-09-23 12:41:50', 'Cambiar Usuario', 'prueba', 'demo0001'),
(261, 'Usuarios', 'prueba', '2021-09-23 12:42:14', 'Cambiar Usuario', 'prueba', 'demo0001'),
(262, 'Usuarios', 'admin', '2021-09-23 12:46:13', 'Modificar', 'prueba', 'demo0001'),
(263, 'Usuarios', 'prueba', '2021-09-23 12:46:36', 'Cambiar Usuario', 'prueba', 'demo0001'),
(264, 'Usuarios', 'admin', '2021-09-23 12:48:01', 'Modificar', 'prueba', 'demo0001'),
(265, 'Usuarios', 'prueba', '2021-09-23 12:48:36', 'Cambiar Usuario', 'prueba', 'demo0001'),
(266, 'Usuarios', 'admin', '2021-09-23 12:50:36', 'Modificar', 'prueba', 'demo0001'),
(267, 'Usuarios', 'prueba', '2021-09-23 12:51:08', 'Cambiar Usuario', 'prueba', 'demo0001'),
(268, 'Usuarios', 'prueba', '2021-09-23 12:59:57', 'Cambiar Usuario', 'prueba', 'demo0001'),
(269, 'Usuarios', 'prueba', '2021-09-23 13:35:45', 'Registro', 'os', 'demo0001'),
(270, 'Usuarios', 'prueba', '2021-09-23 13:37:47', 'Registro', 'os', 'demo0001'),
(271, 'Usuarios', 'prueba', '2021-09-23 13:40:18', 'Registro', 'os', 'demo0001'),
(272, 'Usuarios', 'prueba', '2021-09-23 13:41:54', 'Registro', 'prueba', 'demo0001'),
(273, 'Usuarios', 'prueba', '2021-09-23 13:42:26', 'Registro', 'dd', 'demo0001'),
(274, 'Usuarios', 'prueba', '2021-09-23 13:51:51', 'Registro', 'p', 'demo0001'),
(275, 'Usuarios', 'prueba', '2021-09-23 13:52:29', 'Modificar', 'p1', 'demo0001'),
(276, 'Usuarios', 'prueba', '2021-09-23 13:53:35', 'Modificar', 'p1', 'demo0001'),
(277, 'Usuarios', 'prueba', '2021-09-23 13:53:41', 'Modificar', 'p1', 'demo0001'),
(278, 'Usuarios', 'prueba', '2021-09-23 13:54:34', 'Modificar', 'p1', 'demo0001'),
(279, 'Usuarios', 'prueba', '2021-09-23 13:58:21', 'Eliminar', 'p1', 'demo0001'),
(280, 'Usuarios', 'prueba', '2021-09-23 13:58:46', 'Cambiar Usuario', 'prueba', 'demo0001'),
(281, 'Usuarios', 'prueba', '2021-09-23 13:59:34', 'Cambiar Usuario', 'prueba', 'demo0001'),
(282, 'Usuarios', 'prueba', '2021-09-23 14:00:53', 'Modificar', 'admin', 'demo0001'),
(283, 'Usuarios', 'prueba', '2021-09-23 14:01:37', 'Cambiar Usuario', 'prueba', 'demo0001'),
(284, 'Usuarios', 'prueba', '2021-09-23 14:01:57', 'Cambiar Usuario', 'prueba', 'demo0001'),
(285, 'Vales', 'admin', '2021-09-23 19:25:00', 'Registro', '123456', 'demo0001'),
(286, 'Vales', 'admin', '2021-09-23 19:26:20', 'Registro', '123456', 'demo0001'),
(287, 'Vales', 'admin', '2021-09-23 19:30:56', 'Registro', '123456', 'demo0001'),
(288, 'Vales', 'admin', '2021-09-23 19:37:05', 'Registro', 'DELETE', 'demo0001'),
(289, 'Vales', 'admin', '2021-09-23 19:46:26', 'Modificar', '1234567', 'demo0001'),
(290, 'Vales', 'admin', '2021-09-23 19:46:39', 'Modificar', '1234567', 'demo0001'),
(291, 'Vales', 'admin', '2021-09-23 19:46:47', 'Modificar', '1234567', 'demo0001'),
(292, 'Vales', 'admin', '2021-09-23 19:46:57', 'Modificar', '1234567', 'demo0001'),
(293, 'Vales', 'admin', '2021-09-23 19:47:04', 'Modificar', '1234567', 'demo0001'),
(294, 'Vales', 'admin', '2021-09-23 19:47:24', 'Modificar', '1234567', 'demo0001'),
(295, 'Vales', 'admin', '2021-09-23 19:47:48', 'Modificar', '1234567', 'demo0001'),
(296, 'Vales', 'admin', '2021-09-23 19:51:43', 'Eliminar', '1234567', 'demo0001'),
(297, 'Vales', 'admin', '2021-09-23 20:27:52', 'Registro', '123456', 'demo0001'),
(298, 'Vales', 'admin', '2021-09-23 20:32:47', 'Registro', '8955L', 'demo0001'),
(299, 'Mantenimento', 'admin', '2021-09-23 20:57:43', 'Registro', '44545N', 'demo0001'),
(300, 'Mantenimento', 'admin', '2021-09-23 21:05:26', 'Registro', '44545PO', 'demo0001'),
(301, 'Mantenimento', 'admin', '2021-09-23 21:16:18', 'Modificar', '44545PO7', 'demo0001'),
(302, 'Mantenimento', 'admin', '2021-09-23 21:16:51', 'Modificar', '44545PO7', 'demo0001'),
(303, 'Mantenimiento', 'admin', '2021-09-23 21:21:20', 'Eliminar', '44545PO7', 'demo0001'),
(304, 'Usuarios', 'admin', '2021-09-24 13:55:30', 'Modificar', 'prueba', 'demo0001'),
(305, 'Usuarios', 'admin', '2021-09-27 21:29:40', 'Modificar', 'admin', 'demo0001'),
(306, 'Usuarios', 'admin', '2021-09-27 21:45:47', 'Modificar', 'admin', 'demo0001'),
(307, 'Vehiculo', 'admin', '2021-09-29 12:03:24', 'Modificar', 'A1S012', 'demo0001'),
(308, 'Vehiculo', 'admin', '2021-09-29 12:03:58', 'Modificar', 'A1N017', 'demo0001'),
(309, 'Vehiculo', 'admin', '2021-09-29 12:05:32', 'Registro', 'AFR-526', 'demo0001'),
(310, 'Vehiculo', 'admin', '2021-09-29 12:05:50', 'Modificar', 'A1S-012', 'demo0001'),
(311, 'Vehiculo', 'admin', '2021-09-29 12:05:57', 'Modificar', 'A1N-017', 'demo0001'),
(312, 'Vehiculo', 'admin', '2021-09-29 12:07:00', 'Registro', 'OPL-985', 'demo0001'),
(313, 'Vehiculo', 'admin', '2021-09-29 12:08:12', 'Modificar', 'B1N-017', 'demo0001'),
(314, 'Vehiculo', 'admin', '2021-09-29 12:09:19', 'Registro', 'HAL-895', 'demo0001'),
(315, 'Vehiculo', 'admin', '2021-09-29 12:10:20', 'Registro', 'PIU-965', 'demo0001'),
(316, 'Vales', 'admin', '2021-09-29 12:14:24', 'Modificar', 'V00025', 'demo0001'),
(317, 'Vales', 'admin', '2021-09-29 12:14:38', 'Modificar', 'V00026', 'demo0001'),
(318, 'Conductor', 'admin', '2021-09-29 12:15:14', 'Modificar', '56232025', 'demo0001'),
(319, 'Conductor', 'admin', '2021-09-29 12:15:52', 'Modificar', '96301236', 'demo0001'),
(320, 'Conductor', 'admin', '2021-09-29 12:16:18', 'Modificar', '40356302', 'demo0001'),
(321, 'Conductor', 'admin', '2021-09-29 12:16:57', 'Registro', '42368952', 'demo0001'),
(322, 'Vales', 'admin', '2021-09-29 12:18:04', 'Modificar', 'V00025', 'demo0001'),
(323, 'Vales', 'admin', '2021-09-29 12:18:38', 'Modificar', 'V00026', 'demo0001'),
(324, 'Vales', 'admin', '2021-09-29 12:19:34', 'Registro', 'V00027', 'demo0001'),
(325, 'Vales', 'admin', '2021-09-29 12:20:23', 'Registro', 'V00028', 'demo0001'),
(326, 'Vales', 'admin', '2021-09-29 12:22:01', 'Registro', 'V00029', 'demo0001'),
(327, 'Vales', 'admin', '2021-09-29 12:24:10', 'Registro', 'V00030', 'demo0001'),
(328, 'Vales', 'admin', '2021-09-29 14:08:32', 'Modificar', 'V00028', 'demo0001'),
(329, 'Vales', 'admin', '2021-09-29 14:08:41', 'Modificar', 'V00027', 'demo0001'),
(330, 'Vales', 'admin', '2021-09-29 14:13:50', 'Registro', 'V00031', 'demo0001'),
(331, 'Vales', 'admin', '2021-09-29 14:33:41', 'Registro', 'V00032', 'demo0001'),
(332, 'Vales', 'admin', '2021-09-29 14:35:03', 'Registro', 'V00033', 'demo0001'),
(333, 'Usuarios', 'prueba', '2021-09-29 16:33:55', 'Registro', 'usuario', 'demo0001'),
(334, 'Usuarios', 'prueba', '2021-09-29 16:35:10', 'Modificar', 'prueba', 'demo0001'),
(335, 'Usuarios', 'prueba', '2021-09-29 16:35:18', 'Modificar', 'usuario', 'demo0001'),
(336, 'Tipo de Mantenimiento', 'usuario', '2021-09-29 16:36:06', 'Registro', 'AFINAMIENTO', 'demo0001'),
(337, 'Tipo de Mantenimiento', 'usuario', '2021-09-29 16:36:20', 'Registro', 'REVICION DE FRENOS', 'demo0001'),
(338, 'Tipo de Mantenimiento', 'usuario', '2021-09-29 16:36:41', 'Modificar', 'REVISION DE FRENOS', 'demo0001'),
(339, 'Tipo de Mantenimiento', 'usuario', '2021-09-29 16:38:52', 'Registro', 'ALINEACION DE LOS NEUMATICOS', 'demo0001'),
(340, 'Tipo de Mantenimiento', 'usuario', '2021-09-29 16:39:47', 'Registro', 'CAMBIO DE AMORTIGUADORES', 'demo0001'),
(341, 'Tipo de Mantenimiento', 'usuario', '2021-09-29 16:40:11', 'Registro', 'CAMBIO DE BATERIA', 'demo0001'),
(342, 'Mantenimento', 'usuario', '2021-09-29 16:41:41', 'Modificar', 'M15469', 'demo0001'),
(343, 'Mantenimento', 'usuario', '2021-09-29 16:43:08', 'Registro', 'M52369', 'demo0001'),
(344, 'Mantenimento', 'usuario', '2021-09-29 16:43:49', 'Modificar', 'M52369', 'demo0001'),
(345, 'Mantenimento', 'usuario', '2021-09-29 16:44:36', 'Registro', 'M52360', 'demo0001'),
(346, 'Mantenimento', 'usuario', '2021-09-29 16:45:27', 'Registro', 'M53601', 'demo0001'),
(347, 'Mantenimento', 'usuario', '2021-09-29 16:46:56', 'Registro', 'M53698', 'demo0001'),
(348, 'Mantenimento', 'usuario', '2021-09-29 16:50:27', 'Registro', '44545', 'demo0001'),
(349, 'Mantenimento', 'usuario', '2021-09-29 16:52:25', 'Registro', '44545', 'demo0001'),
(350, 'Mantenimento', 'usuario', '2021-09-29 16:52:46', 'Modificar', '44545', 'demo0001'),
(351, 'Mantenimento', 'usuario', '2021-09-29 16:52:54', 'Modificar', '44545', 'demo0001'),
(352, 'Mantenimento', 'usuario', '2021-09-29 16:53:17', 'Modificar', '44545', 'demo0001'),
(353, 'Mantenimento', 'usuario', '2021-09-29 16:53:24', 'Modificar', '44545', 'demo0001'),
(354, 'Mantenimento', 'usuario', '2021-09-29 16:53:38', 'Modificar', '44545', 'demo0001'),
(355, 'Mantenimento', 'usuario', '2021-09-29 16:53:48', 'Modificar', '44545', 'demo0001'),
(356, 'Mantenimento', 'usuario', '2021-09-29 16:53:54', 'Modificar', '44545', 'demo0001'),
(357, 'Mantenimento', 'usuario', '2021-09-29 16:54:04', 'Modificar', '44545', 'demo0001'),
(358, 'Mantenimento', 'usuario', '2021-09-29 16:54:37', 'Modificar', '44545', 'demo0001'),
(359, 'Mantenimento', 'admin', '2021-09-29 17:54:10', 'Registro', '44545N', 'demo0001'),
(360, 'Mantenimiento', 'admin', '2021-09-29 17:56:09', 'Eliminar', '44545N', 'demo0001'),
(361, 'Mantenimiento', 'admin', '2021-09-29 17:56:13', 'Eliminar', '44545', 'demo0001'),
(362, 'Usuarios', 'admin', '2021-09-29 17:56:36', 'Modificar', 'usuario', 'demo0001'),
(363, 'Mantenimento', 'admin', '2021-09-29 18:03:41', 'Registro', '44545', 'demo0001'),
(364, 'Mantenimento', 'admin', '2021-09-29 18:05:40', 'Modificar', '44545', 'demo0001'),
(365, 'Mantenimento', 'admin', '2021-09-29 18:05:51', 'Modificar', '44545', 'demo0001'),
(366, 'Mantenimiento', 'admin', '2021-09-29 18:05:57', 'Eliminar', '44545', 'demo0001'),
(367, 'Vales', 'admin', '2021-09-29 18:10:48', 'Registro', 'V', 'demo0001'),
(368, 'Vales', 'admin', '2021-09-29 18:12:17', 'Modificar', 'V', 'demo0001'),
(369, 'Vales', 'admin', '2021-09-29 18:12:54', 'Eliminar', 'V', 'demo0001'),
(370, 'Usuarios', 'admin', '2021-09-29 18:13:04', 'Modificar', 'usuario', 'demo0001'),
(371, 'Mantenimento', 'admin', '2021-09-29 18:14:33', 'Registro', 'M62032', 'demo0001'),
(372, 'Mantenimento', 'admin', '2021-09-29 18:15:44', 'Registro', 'M78541', 'demo0001'),
(373, 'Mantenimento', 'admin', '2021-09-29 18:16:07', 'Modificar', 'M62032', 'demo0001'),
(374, 'Mantenimento', 'admin', '2021-09-29 18:16:54', 'Modificar', 'M53601', 'demo0001'),
(375, 'Mantenimento', 'admin', '2021-09-29 18:17:02', 'Modificar', 'M52360', 'demo0001'),
(376, 'Mantenimento', 'admin', '2021-09-29 18:17:15', 'Modificar', 'M52369', 'demo0001'),
(377, 'Mantenimento', 'admin', '2021-09-29 18:17:30', 'Modificar', 'M15469', 'demo0001'),
(378, 'Mantenimento', 'admin', '2021-09-29 18:17:41', 'Modificar', 'M15469', 'demo0001'),
(379, 'Mantenimento', 'admin', '2021-09-29 18:18:15', 'Registro', 'M41025', 'demo0001'),
(380, 'Mantenimento', 'admin', '2021-09-29 18:20:06', 'Registro', 'M45128', 'demo0001'),
(381, 'Vehiculo', 'usuario', '2021-09-30 13:26:41', 'Registro', 'GHU-965', 'demo0001'),
(382, 'Vehiculo', 'usuario', '2021-09-30 13:27:05', 'Modificar', 'GHU-965', 'demo0001'),
(383, 'Vehiculo', 'usuario', '2021-09-30 13:27:16', 'Eliminar', 'GHU-965', 'demo0001'),
(384, 'Combustible', 'usuario', '2021-09-30 13:28:50', 'Registro', 'GASOLINA90', 'demo0001'),
(385, 'Combustible', 'usuario', '2021-09-30 13:29:09', 'Modificar', 'GASOLINA 90', 'demo0001'),
(386, 'Vales', 'usuario', '2021-09-30 13:32:00', 'Registro', 'V00300', 'demo0001'),
(387, 'Vehiculo', 'usuario', '2021-09-30 16:31:07', 'Registro', 'HJU-985', 'demo0001'),
(388, 'Vehiculo', 'usuario', '2021-09-30 16:31:35', 'Eliminar', 'HJU-985', 'demo0001'),
(389, 'Vehiculo', 'usuario', '2021-09-30 16:35:04', 'Registro', 'HJU-569', 'demo0001'),
(390, 'Vehiculo', 'usuario', '2021-09-30 16:36:14', 'Eliminar', 'HJU-569', 'demo0001'),
(391, 'Vehiculo', 'usuario', '2021-09-30 16:37:14', 'Registro', 'HUO-963', 'demo0001'),
(392, 'Vehiculo', 'usuario', '2021-09-30 16:37:32', 'Modificar', 'HUO-963', 'demo0001'),
(393, 'Vehiculo', 'usuario', '2021-09-30 16:37:40', 'Eliminar', 'HUO-963', 'demo0001'),
(394, 'Vales', 'usuario', '2021-09-30 16:46:15', 'Registro', 'V00400', 'demo0001'),
(395, 'Vales', 'admin', '2021-09-30 19:12:55', 'Eliminar', 'V00300', 'demo0001'),
(396, 'Vales', 'admin', '2021-09-30 19:12:59', 'Eliminar', 'V00400', 'demo0001'),
(397, 'Vehiculo', 'usuario', '2021-10-01 11:53:52', 'Registro', 'JHN-986', 'demo0001'),
(398, 'Vehiculo', 'usuario', '2021-10-01 11:54:18', 'Modificar', 'JHN-986', 'demo0001'),
(399, 'Vehiculo', 'usuario', '2021-10-01 11:54:37', 'Eliminar', 'JHN-986', 'demo0001'),
(400, 'Vehiculo', 'usuario', '2021-10-01 12:16:58', 'Registro', 'JKU-653', 'demo0001'),
(401, 'Vehiculo', 'usuario', '2021-10-01 12:17:23', 'Modificar', 'JKU-653', 'demo0001'),
(402, 'Vehiculo', 'usuario', '2021-10-01 12:17:37', 'Eliminar', 'JKU-653', 'demo0001'),
(403, 'Vehiculo', 'usuario', '2021-10-01 12:27:57', 'Registro', 'LOI-965', 'demo0001'),
(404, 'Vehiculo', 'usuario', '2021-10-01 12:28:24', 'Modificar', 'LOI-965', 'demo0001'),
(405, 'Vehiculo', 'usuario', '2021-10-01 12:28:29', 'Eliminar', 'LOI-965', 'demo0001'),
(406, 'Vehiculo', 'usuario', '2021-10-01 12:35:44', 'Registro', 'ILO-965', 'demo0001'),
(407, 'Vehiculo', 'usuario', '2021-10-01 12:36:08', 'Modificar', 'ILO-965', 'demo0001'),
(408, 'Vehiculo', 'usuario', '2021-10-01 12:36:23', 'Eliminar', 'ILO-965', 'demo0001'),
(409, 'Vehiculo', 'usuario', '2021-10-01 12:38:39', 'Registro', 'OPI-965', 'demo0001'),
(410, 'Vehiculo', 'usuario', '2021-10-01 12:39:01', 'Modificar', 'OPI-965', 'demo0001'),
(411, 'Vehiculo', 'usuario', '2021-10-01 12:39:17', 'Eliminar', 'OPI-965', 'demo0001'),
(412, 'Vales', 'usuario', '2021-10-01 12:42:47', 'Registro', 'V00034', 'demo0001'),
(413, 'Mantenimento', 'usuario', '2021-10-01 12:43:37', 'Registro', 'M10256', 'demo0001'),
(414, 'Vales', 'usuario', '2021-10-01 12:46:11', 'Registro', 'V00035', 'demo0001'),
(415, 'Mantenimento', 'usuario', '2021-10-01 12:47:43', 'Registro', 'M52659', 'demo0001'),
(416, 'Usuarios', 'admin', '2021-10-21 13:27:23', 'Modificar', 'usuario', 'demo0001'),
(417, 'Vehiculo', 'prueba', '2021-10-23 12:51:47', 'Registro', 'V3S879', 'demo0001'),
(418, 'Conductor', 'prueba', '2021-10-23 12:53:24', 'Registro', '42614539', 'demo0001'),
(419, 'Grifo', 'prueba', '2021-10-23 12:54:06', 'Registro', '20559318796', 'demo0001'),
(420, 'Vales', 'prueba', '2021-10-23 13:04:51', 'Registro', '2222', 'demo0001'),
(421, 'Vehiculo', 'prueba', '2021-10-28 18:22:20', 'Registro', 'PLACA01', 'demo0001'),
(422, 'Tipo de Mantenimiento', 'prueba', '2021-10-28 18:23:29', 'Modificar', 'AFINAMIENTO', 'demo0001'),
(423, 'Usuarios', 'admin', '2021-11-03 14:30:44', 'Cambiar Usuario', 'admin', 'demo0001'),
(424, 'Usuarios', 'admin', '2021-11-03 14:31:23', 'Eliminar', 'prueba', 'demo0001'),
(425, 'Usuarios', 'admin', '2021-11-03 14:32:24', 'Registro', 'prueba', 'demo0001'),
(426, 'Vales', 'prueba', '2022-01-12 14:44:35', 'Registro', '2640', 'demo0001'),
(427, 'Vales', 'prueba', '2022-04-17 14:54:06', 'Registro', 'BV02-107', 'demo0001'),
(428, 'Vales', 'prueba', '2022-05-04 11:47:45', 'Registro', '23', 'demo0001'),
(429, 'Vehiculo', 'prueba', '2022-05-04 11:58:59', 'Modificar', 'V3S879', 'demo0001'),
(430, 'Vehiculo', 'prueba', '2022-05-05 10:30:27', 'Modificar', 'V3S879', 'demo0001'),
(431, 'Vehiculo', 'prueba', '2022-05-05 10:31:43', 'Modificar', '936', 'demo0001'),
(432, 'Vehiculo', 'prueba', '2022-05-05 10:33:27', 'Modificar', 'AFW719', 'demo0001'),
(433, 'Grifo', 'prueba', '2022-05-05 10:40:40', 'Registro', '20568499043', 'demo0001'),
(434, 'Conductor', 'prueba', '2022-05-05 10:45:12', 'Registro', '31254258', 'demo0001'),
(435, 'Vales', 'prueba', '2022-05-05 10:46:32', 'Registro', '525', 'demo0001'),
(436, 'Vales', 'prueba', '2022-05-05 11:13:41', 'Registro', '55', 'demo0001'),
(437, 'Vales', 'prueba', '2022-05-05 11:22:43', 'Modificar', 'BV02-107', 'demo0001'),
(438, 'Vales', 'prueba', '2022-05-05 11:23:50', 'Modificar', 'V00030', 'demo0001'),
(439, 'Tipo de Mantenimiento', 'prueba', '2022-05-05 11:25:32', 'Registro', 'LAVADO Y ENGRASE', 'demo0001'),
(440, 'Mantenimento', 'prueba', '2022-05-05 11:26:59', 'Registro', '321', 'demo0001'),
(441, 'Vehiculo', 'prueba', '2022-05-09 15:19:52', 'Modificar', '936', 'demo0001'),
(442, 'Tipo de Mantenimiento', 'prueba', '2022-05-09 15:21:07', 'Modificar', 'AFINAMIENTO', 'demo0001'),
(443, 'Tipo de Mantenimiento', 'prueba', '2022-05-11 11:11:43', 'Registro', 'CAMBIO DE MUELLE', 'demo0001'),
(444, 'Mantenimento', 'prueba', '2022-05-11 11:13:01', 'Registro', '0002', 'demo0001'),
(445, 'Vehiculo', 'prueba', '2022-08-08 17:51:45', 'Registro', '1', 'demo0001'),
(446, 'Usuarios', 'admin', '2022-08-08 18:07:52', 'Eliminar', 'usuario', 'demo0001'),
(447, 'Usuarios', 'admin', '2022-08-08 18:09:11', 'Registro', 'Vendedor', 'demo0001'),
(448, 'Usuarios', 'admin', '2022-08-08 18:09:17', 'Eliminar', 'Vendedor', 'demo0001'),
(449, 'Usuarios', 'admin', '2022-08-08 18:11:46', 'Eliminar', 'prueba', 'demo0001'),
(450, 'Usuarios', 'admin', '2022-08-08 18:13:12', 'Registro', 'prueba', 'demo0001'),
(451, 'Usuarios', 'admin', '2022-08-08 18:13:24', 'Registro', 'yo', 'demo0001'),
(452, 'Usuarios', 'admin', '2022-08-08 18:13:34', 'Modificar', 'yo', 'demo0001'),
(453, 'Usuarios', 'admin', '2022-08-08 18:13:37', 'Eliminar', 'yo', 'demo0001'),
(454, 'Vales', 'prueba', '2022-08-08 21:09:39', 'Registro', '31', 'demo0001'),
(455, 'Vehiculo', 'admin', '2022-08-09 09:35:51', 'Eliminar', '1', 'demo0001'),
(456, 'Combustible', 'prueba', '2022-08-23 14:48:22', 'Modificar', 'PETROLEO', 'demo0001'),
(457, 'Grifo', 'prueba', '2022-08-24 10:01:53', 'Registro', '20606099577', 'demo0001'),
(458, 'Mantenimento', 'admin', '2023-03-23 08:56:29', 'Registro', '01', 'demo0001'),
(459, 'Vales', 'admin', '2023-03-23 09:03:47', 'Registro', '02', 'demo0001'),
(460, 'Usuarios', 'admin', '2023-03-23 11:01:12', 'Registro', 'lapadilla', 'demo0001'),
(461, 'Combustible', 'Luis Alfredo Padilla', '2023-03-23 12:45:20', 'Modificar', 'GAS NATURAL', 'demo0001'),
(462, 'Combustible', 'Luis Alfredo Padilla', '2023-03-23 12:45:24', 'Eliminar', 'PETROLEO', 'demo0001'),
(463, 'Combustible', 'Luis Alfredo Padilla', '2023-03-23 12:45:42', 'Modificar', 'DIESEL', 'demo0001'),
(464, 'Vehiculo', 'admin', '2023-03-27 08:11:05', 'Modificar', '1008NHR', 'demo0001'),
(465, 'Vehiculo', 'admin', '2023-03-27 08:14:28', 'Modificar', '1008NIU', 'demo0001'),
(466, 'Vehiculo', 'admin', '2023-03-27 08:16:13', 'Modificar', '2310-LLD', 'demo0001'),
(467, 'Vehiculo', 'admin', '2023-03-27 08:17:37', 'Eliminar', 'AFW719', 'demo0001'),
(468, 'Vehiculo', 'admin', '2023-03-27 08:17:44', 'Eliminar', 'AFW719', 'demo0001'),
(469, 'Vehiculo', 'admin', '2023-03-27 08:19:13', 'Modificar', '2379BKR', 'demo0001'),
(470, 'Vehiculo', 'admin', '2023-03-27 08:24:20', 'Eliminar', 'B1N-017', 'demo0001'),
(471, 'Vehiculo', 'admin', '2023-03-27 08:24:28', 'Eliminar', 'PLACA01', 'demo0001'),
(472, 'Vehiculo', 'admin', '2023-03-27 08:24:30', 'Eliminar', 'AFR-526', 'demo0001'),
(473, 'Vehiculo', 'admin', '2023-03-27 08:25:23', 'Modificar', '2519ZFK', 'demo0001'),
(474, 'Vehiculo', 'admin', '2023-03-27 08:26:36', 'Modificar', '4541EFF', 'demo0001'),
(475, 'Vehiculo', 'admin', '2023-03-27 08:27:39', 'Modificar', '2520NCS', 'demo0001'),
(476, 'Vehiculo', 'admin', '2023-03-27 08:28:37', 'Modificar', '2520NDX', 'demo0001'),
(477, 'Conductor', 'admin', '2023-03-27 08:44:48', 'Modificar', '6243108', 'demo0001'),
(478, 'Conductor', 'admin', '2023-03-27 08:45:59', 'Modificar', '9814645', 'demo0001'),
(479, 'Conductor', 'admin', '2023-03-27 08:46:36', 'Modificar', '9814645', 'demo0001'),
(480, 'Conductor', 'admin', '2023-03-27 08:46:46', 'Modificar', '6243108', 'demo0001'),
(481, 'Conductor', 'admin', '2023-03-27 08:48:08', 'Modificar', '31254258', 'demo0001'),
(482, 'Conductor', 'admin', '2023-03-27 08:49:32', 'Modificar', '3752845', 'demo0001'),
(483, 'Conductor', 'admin', '2023-03-27 08:49:56', 'Eliminar', '40356302', 'demo0001'),
(484, 'Conductor', 'admin', '2023-03-27 09:54:37', 'Modificar', '8195942', 'demo0001'),
(485, 'Conductor', 'admin', '2023-03-27 09:57:29', 'Modificar', '9022391', 'demo0001'),
(486, 'Vales', 'admin', '2023-03-27 10:06:54', 'Eliminar', 'V00025', 'demo0001'),
(487, 'Vales', 'admin', '2023-03-27 10:06:56', 'Eliminar', 'V00026', 'demo0001'),
(488, 'Vales', 'admin', '2023-03-27 10:07:00', 'Eliminar', 'V00029', 'demo0001'),
(489, 'Vales', 'admin', '2023-03-27 10:07:06', 'Eliminar', 'V00027', 'demo0001'),
(490, 'Vales', 'admin', '2023-03-27 10:07:09', 'Eliminar', 'V00031', 'demo0001'),
(491, 'Vales', 'admin', '2023-03-27 10:07:11', 'Eliminar', 'V00028', 'demo0001'),
(492, 'Vales', 'admin', '2023-03-27 10:07:13', 'Eliminar', 'V00032', 'demo0001'),
(493, 'Vales', 'admin', '2023-03-27 10:07:16', 'Eliminar', 'V00030', 'demo0001'),
(494, 'Vales', 'admin', '2023-03-27 10:07:18', 'Eliminar', 'V00033', 'demo0001'),
(495, 'Vales', 'admin', '2023-03-27 10:26:53', 'Registro', '03', 'demo0001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grifo`
--

CREATE TABLE `grifo` (
  `idgrifo` int(11) NOT NULL,
  `token` tinytext DEFAULT NULL,
  `nombregrifo` varchar(45) DEFAULT NULL,
  `rucgrifo` varchar(15) DEFAULT NULL,
  `direcciongrifo` varchar(150) DEFAULT NULL,
  `telefonogrifo` varchar(45) DEFAULT NULL,
  `codcombustible` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grifo`
--

INSERT INTO `grifo` (`idgrifo`, `token`, `nombregrifo`, `rucgrifo`, `direcciongrifo`, `telefonogrifo`, `codcombustible`) VALUES
(247751778, '592db76589719f6b4500a1e45056eb11', 'SINSAJO', '20606099577', 'JR PRIMAVERA', '996857145', 'demo0001'),
(1284992215, '45e2e326611cc2026109bd2c74ec646b', 'GRIFO SAN FERNANDO', '89201245932', 'AV PROLONGACION N631', '325652694', 'demo0001'),
(1345049716, 'f19de6c41e6904c2daeb75004a1519f7', 'SURTIDORES SAN MIGUEL EIRL', '20568499043', 'AV ANTONIO RAYMONDI NORTE NRO 314  ', '999583462', 'demo0001'),
(1659323368, '921a3fa8de662d105fe60936073cda6d', 'COESTI', '20559318796', 'AQP', '943879244', 'demo0001'),
(1899662528, '7665d2b1ef17e207262e63fb68463394', 'GRIFO TODA UNA VIDA', '96320325487', 'AV TASAHUAYO 654', '5632560440', 'demo0001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento`
--

CREATE TABLE `mantenimiento` (
  `idmantenimiento` int(11) NOT NULL,
  `token` tinytext DEFAULT NULL,
  `numeromantenimiento` varchar(25) DEFAULT NULL,
  `idvehiculo` int(11) DEFAULT NULL,
  `idtipomantenimiento` int(11) DEFAULT NULL,
  `fechamantenimiento` date DEFAULT NULL,
  `fechapmantenimiento` date DEFAULT NULL,
  `descripcion` longtext DEFAULT NULL,
  `kilometraje` varchar(45) DEFAULT NULL,
  `costo` double DEFAULT NULL,
  `codcombustible` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mantenimiento`
--

INSERT INTO `mantenimiento` (`idmantenimiento`, `token`, `numeromantenimiento`, `idvehiculo`, `idtipomantenimiento`, `fechamantenimiento`, `fechapmantenimiento`, `descripcion`, `kilometraje`, `costo`, `codcombustible`) VALUES
(158072320, '47bcab3d98c4ae64ba32e5b5e1e3e333', 'M41025', 1426849087, 1445488198, '2021-07-12', '0000-00-00', '', '58952', 310, 'demo0001'),
(322494632, '2834238393d814ac5eafb4d72b591e84', 'M52659', 1598692173, 1545221155, '2021-10-01', '0000-00-00', '', '58632', 450, 'demo0001'),
(391865253, 'a16b201b80372a6f370647c4c86ab47a', 'M45128', 1986267162, 1796665711, '2021-08-24', '0000-00-00', '', '54210', 360, 'demo0001'),
(827829555, 'c3aedc994574f0d9ae9e278374a8513c', 'M78541', 1986267162, 1274261169, '2021-06-26', '0000-00-00', '', '45210', 250, 'demo0001'),
(917388214, '5a1b29bb61ba1383a1a51d136d6ef094', 'M10256', 1598692173, 1445488198, '2021-09-22', '0000-00-00', '', '56236', 280, 'demo0001'),
(1156990030, '16761d3496e86e1ee085d4a2ef55aaea', 'M62032', 183708319, 53622094, '2021-05-21', '0000-00-00', '', '52021', 300, 'demo0001'),
(1273255909, 'a390d80ac2afe73a4abe3d745eebb167', '0002', 183708319, 1919784855, '2022-05-09', '0000-00-00', '', '0', 450, 'demo0001'),
(1315880506, 'ad44a91dc9d8b8a38f238cafcbbf95f7', 'M15469', 1346225791, 53622094, '2021-01-23', '0000-00-00', 'DESCRIPCION', '56320', 100, 'demo0001'),
(1513286067, '6bc179712041ae71a1c14fb10dbd97dd', '01', 54046970, 440248267, '2023-03-23', '2023-04-23', 'LAVADO DEL MES DE MARZO', '23032023', 20, 'demo0001'),
(1583454202, '0064d0ebf66cc331ba8d00ab353439f5', 'M52360', 183708319, 1545221155, '2021-03-15', '0000-00-00', '', '56302', 260, 'demo0001'),
(1609406954, '50ee6e18aec2053ff563b537a89115e5', 'M52369', 1346225791, 1274261169, '2021-02-03', '0000-00-00', 'DESCRIPCION', '56985', 150, 'demo0001'),
(1722598189, '304c154955ded6fe893dc857e7955961', '321', 183708319, 440248267, '2022-05-01', '0000-00-00', '', '0', 100, 'demo0001'),
(1872562432, '1bd28ae5e84057b9ecb25cf7edf05ce6', 'M53601', 1986267162, 53622094, '2021-04-17', '0000-00-00', '', '56231', 300, 'demo0001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipomantenimiento`
--

CREATE TABLE `tipomantenimiento` (
  `idtipomantenimiento` int(11) NOT NULL,
  `token` tinytext DEFAULT NULL,
  `nombretipomantenimiento` varchar(100) DEFAULT NULL,
  `codcombustible` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipomantenimiento`
--

INSERT INTO `tipomantenimiento` (`idtipomantenimiento`, `token`, `nombretipomantenimiento`, `codcombustible`) VALUES
(53622094, '4199c91eacbc6b330ce262ca580c88d3', 'CAMBIO DE PASTILLAS', 'demo0001'),
(440248267, '8f3230e39c6d32176b96b3dfa4fc953d', 'LAVADO Y ENGRASE', 'demo0001'),
(1037090523, '80de6233a310ef3c5b9cb0b8dc3f07ef', 'ALINEACION DE LOS NEUMATICOS', 'demo0001'),
(1274261169, 'daa211b7ef152cec8703b1fe215623c1', 'CAMBIO DE ACEITE', 'demo0001'),
(1445488198, '547f4addf6db6496d303f63f49d0e13f', 'CAMBIO DE BATERIA', 'demo0001'),
(1545221155, 'e7371749fdeae34401df5d8e23dea4f7', 'CAMBIO DE AMORTIGUADORES', 'demo0001'),
(1774685085, 'fa210b912fbd4857bb01d8cef78429cb', 'REVISION DE FRENOS', 'demo0001'),
(1796665711, '4b3090466e963cf2f3a9192c49ae185d', 'AFINAMIENTO', 'demo0001'),
(1919784855, 'bcc9be4d55f4e02897da571f37e5011f', 'CAMBIO DE MUELLE', 'demo0001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `token` tinytext DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `clave` varchar(50) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `ingusuario` varchar(2) DEFAULT NULL,
  `ingcontrasena` varchar(45) DEFAULT NULL,
  `ingregistro` varchar(2) DEFAULT NULL,
  `ingvehiculo` varchar(2) DEFAULT NULL,
  `ingconductor` varchar(2) DEFAULT NULL,
  `inggrifo` varchar(2) DEFAULT NULL,
  `ingcombustible` varchar(2) DEFAULT NULL,
  `ingtipomantenimiento` varchar(2) DEFAULT NULL,
  `ingvalescombustible` varchar(2) DEFAULT NULL,
  `ingmantenimientos` varchar(2) DEFAULT NULL,
  `repvales` varchar(2) DEFAULT NULL,
  `repvalesvehiculo` varchar(2) DEFAULT NULL,
  `repmantenimiento` varchar(2) DEFAULT NULL,
  `repmantenimientovehiculo` varchar(2) DEFAULT NULL,
  `codcombustible` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `token`, `nombre`, `usuario`, `clave`, `tipo`, `ingusuario`, `ingcontrasena`, `ingregistro`, `ingvehiculo`, `ingconductor`, `inggrifo`, `ingcombustible`, `ingtipomantenimiento`, `ingvalescombustible`, `ingmantenimientos`, `repvales`, `repvalesvehiculo`, `repmantenimiento`, `repmantenimientovehiculo`, `codcombustible`) VALUES
(211550583, '6ab3b3fef1282a837b7a9a71509742f8', 'Luis Alfredo Padilla', 'lapadilla', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'demo0001'),
(787189270, '9ed7b6ad4aea1f20987a6cb046295d37', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'demo0001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vale`
--

CREATE TABLE `vale` (
  `idvale` int(11) NOT NULL,
  `token` tinytext DEFAULT NULL,
  `numerovale` varchar(15) DEFAULT NULL,
  `idvehiculo` int(11) DEFAULT NULL,
  `idgrifo` int(11) DEFAULT NULL,
  `idconductor` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `kilometraje` double DEFAULT NULL,
  `galonaje` double DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `codcombustible` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vale`
--

INSERT INTO `vale` (`idvale`, `token`, `numerovale`, `idvehiculo`, `idgrifo`, `idconductor`, `fecha`, `kilometraje`, `galonaje`, `precio`, `codcombustible`) VALUES
(52222846, '18371a5ceae3e2aba99e124b7950247b', 'V00035', 1598692173, 1899662528, 730644307, '2021-10-01', 52698, 10, 14.6, 'demo0001'),
(97716270, '8b831332aa1bc2b44b2fb1b269e80384', '525', 183708319, 1345049716, 1361084911, '2022-05-02', 0, 80, 14.9, 'demo0001'),
(162282337, '70df9f6bfee6dfced88004868f15e6d3', '02', 54046970, 1284992215, 618314987, '2023-03-23', 2303, 30, 3.7, 'demo0001'),
(581754886, '2a32bf86afcb81277b006112a8825bea', 'V00034', 1426849087, 1899662528, 1323120204, '2021-09-23', 25635, 8, 14.6, 'demo0001'),
(797814879, '6ccce5fdb311d5b52b562f9534a94bbb', '03', 183708319, 247751778, 618314987, '2023-03-28', 2803, 20, 3.7, 'demo0001'),
(833554137, 'abd6805a3c6523d2b81f346096fa5f0a', '2222', 54046970, 1659323368, 618314987, '2021-10-23', 768432, 50, 15.27, 'demo0001'),
(958948161, '8e85b994f01eddcd2d7b2f8798032a17', 'BV02-107', 54046970, 1899662528, 618314987, '2022-04-17', 142124, 11.08, 14.44, 'demo0001'),
(1123286538, '66020cac5cb7ce4b6369837c28c8e1ea', '23', 1336862028, 1284992215, 730644307, '2022-05-04', 0, 80, 14.6, 'demo0001'),
(1207507761, '167f4afb1e4b7345f7ee412457439ea3', '55', 54046970, 1345049716, 1361084911, '2022-05-03', 0, 80, 15, 'demo0001'),
(1295645903, '05b97f59ad76656f6aeff09653294208', '2640', 54046970, 1284992215, 618314987, '2022-01-12', 0, 20, 14, 'demo0001'),
(1929811678, 'd556be3739f794379c63a400a1c27f83', '31', 1705921386, 1899662528, 618314987, '2022-08-08', 0, 10, 23, 'demo0001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `idvehiculo` int(11) NOT NULL,
  `token` tinytext DEFAULT NULL,
  `idcombustible` int(11) DEFAULT NULL,
  `placa` varchar(15) DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `anofabricacion` double DEFAULT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `codcombustible` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`idvehiculo`, `token`, `idcombustible`, `placa`, `tipo`, `anofabricacion`, `marca`, `codcombustible`) VALUES
(54046970, '304d5d3846f6c3a797a6fb94ef01fcc1', 124924689, '1008NHR', 'VAGONETA', 1990, 'TOYOTA', 'demo0001'),
(183708319, 'd35daa09119452c45939db784f2058e8', 930947558, '2520NDX', 'VAGONETA', 2006, 'HONDA', 'demo0001'),
(1336862028, '14d3fa22f6e78656e00a0dce72227d82', 930947558, '4541EFF', 'CAMIONETA', 2010, 'MAZDA', 'demo0001'),
(1346225791, '3cb0b80b738c9e71a3121dd31fef27a0', 930947558, '2379BKR', 'CAMIONETA', 2005, 'MITSUBISHI', 'demo0001'),
(1426849087, '3d1147c02f61572d52c2b01543bf314b', 964080359, '2519ZFK', 'CAMIONETA', 2005, 'TOYOTA', 'demo0001'),
(1598692173, '08898a524463debc9287c62c118cae05', 124924689, '1008NIU', 'VAGONETA', 1990, 'TOYOTA', 'demo0001'),
(1705921386, '4325a154abc43c8e8bc83795932f595f', 124924689, '2520NCS', 'VAGONETA', 2060, 'HONDA', 'demo0001'),
(1986267162, '67a5c1f2f154e52dd46ed3cde2231052', 930947558, '2310-LLD', 'GRAND VITARA', 2005, 'SUZUKI', 'demo0001');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `combustible`
--
ALTER TABLE `combustible`
  ADD PRIMARY KEY (`idcombustible`);

--
-- Indices de la tabla `conductor`
--
ALTER TABLE `conductor`
  ADD PRIMARY KEY (`idconductor`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`idevento`);

--
-- Indices de la tabla `grifo`
--
ALTER TABLE `grifo`
  ADD PRIMARY KEY (`idgrifo`);

--
-- Indices de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD PRIMARY KEY (`idmantenimiento`),
  ADD KEY `fk_matenimiento_vehiculo1_idx` (`idvehiculo`),
  ADD KEY `fk_matenimiento_tipomantenimiento1_idx` (`idtipomantenimiento`);

--
-- Indices de la tabla `tipomantenimiento`
--
ALTER TABLE `tipomantenimiento`
  ADD PRIMARY KEY (`idtipomantenimiento`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- Indices de la tabla `vale`
--
ALTER TABLE `vale`
  ADD PRIMARY KEY (`idvale`),
  ADD KEY `fk_vale_vehiculo1_idx` (`idvehiculo`),
  ADD KEY `fk_vale_grifo1_idx` (`idgrifo`),
  ADD KEY `fk_vale_conductor1_idx` (`idconductor`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`idvehiculo`),
  ADD KEY `fk_vehiculo_combustible1_idx` (`idcombustible`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `idevento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=496;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD CONSTRAINT `fk_matenimiento_tipomantenimiento1` FOREIGN KEY (`idtipomantenimiento`) REFERENCES `tipomantenimiento` (`idtipomantenimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matenimiento_vehiculo1` FOREIGN KEY (`idvehiculo`) REFERENCES `vehiculo` (`idvehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `vale`
--
ALTER TABLE `vale`
  ADD CONSTRAINT `fk_vale_conductor1` FOREIGN KEY (`idconductor`) REFERENCES `conductor` (`idconductor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vale_grifo1` FOREIGN KEY (`idgrifo`) REFERENCES `grifo` (`idgrifo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vale_vehiculo1` FOREIGN KEY (`idvehiculo`) REFERENCES `vehiculo` (`idvehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `fk_vehiculo_combustible1` FOREIGN KEY (`idcombustible`) REFERENCES `combustible` (`idcombustible`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
