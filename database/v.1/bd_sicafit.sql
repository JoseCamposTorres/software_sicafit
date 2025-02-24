-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-02-2025 a las 15:58:02
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
-- Base de datos: `bd_sicafit`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_backup`
--

CREATE TABLE `tm_backup` (
  `back_id` int(11) NOT NULL,
  `back_date_new` datetime DEFAULT NULL,
  `back_date_edit` datetime DEFAULT NULL,
  `back_date_delete` datetime DEFAULT NULL,
  `back_name` varchar(255) DEFAULT NULL,
  `back_status` varchar(1) DEFAULT NULL,
  `usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_casos`
--

CREATE TABLE `tm_casos` (
  `caso_id` int(11) NOT NULL,
  `caso_date_and_hour` datetime DEFAULT NULL,
  `caso_place` varchar(255) DEFAULT NULL,
  `caso_state_situational` varchar(85) DEFAULT NULL,
  `caso_protect_victim` varchar(85) DEFAULT NULL,
  `caso_date_new` datetime DEFAULT NULL,
  `caso_date_edit` datetime DEFAULT NULL,
  `caso_date_delete` datetime DEFAULT NULL,
  `caso_status` varchar(1) DEFAULT NULL,
  `usu_id` int(11) NOT NULL,
  `deli_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_categorias_delitos`
--

CREATE TABLE `tm_categorias_delitos` (
  `cate_deli_id` int(11) NOT NULL,
  `cate_deli_name` varchar(255) DEFAULT NULL,
  `cate_deli_date_new` datetime DEFAULT NULL,
  `cate_deli_date_edit` datetime DEFAULT NULL,
  `cate_deli_date_delete` datetime DEFAULT NULL,
  `cate_deli_status` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_delitos`
--

CREATE TABLE `tm_delitos` (
  `deli_id` int(11) NOT NULL,
  `deli_name` varchar(255) DEFAULT NULL,
  `deli_description` varchar(255) DEFAULT NULL,
  `deli_date_new` datetime DEFAULT NULL,
  `deli_date_edit` datetime DEFAULT NULL,
  `deli_date_delete` datetime DEFAULT NULL,
  `deli_status` varchar(1) DEFAULT NULL,
  `usu_id` int(11) NOT NULL,
  `cate_deli_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_dependencias`
--

CREATE TABLE `tm_dependencias` (
  `depen_id` int(11) NOT NULL,
  `depen_name` varchar(255) DEFAULT NULL,
  `depen_description` varchar(255) DEFAULT NULL,
  `depen_date_new` datetime DEFAULT NULL,
  `depen_date_edit` datetime DEFAULT NULL,
  `depen_date_delete` datetime DEFAULT NULL,
  `depen_status` varchar(1) DEFAULT NULL,
  `sede_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_detenidos`
--

CREATE TABLE `tm_detenidos` (
  `dete_id` int(11) NOT NULL,
  `dete_name` varchar(80) DEFAULT NULL,
  `dete_last_name` varchar(80) DEFAULT NULL,
  `dete_age` varchar(100) DEFAULT NULL,
  `dete_dni` char(8) DEFAULT NULL,
  `dete_date_new` datetime DEFAULT NULL,
  `dete_date_edit` datetime DEFAULT NULL,
  `dete_date_delete` datetime DEFAULT NULL,
  `dete_status` varchar(1) DEFAULT NULL,
  `caso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_locales`
--

CREATE TABLE `tm_locales` (
  `loca_id` int(11) NOT NULL,
  `loca_name` varchar(255) DEFAULT NULL,
  `loca_address` varchar(255) DEFAULT NULL,
  `loca_date_new` datetime DEFAULT NULL,
  `loca_date_edit` datetime DEFAULT NULL,
  `loca_date_delete` datetime DEFAULT NULL,
  `loca_status` varchar(1) DEFAULT NULL,
  `usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_sedes`
--

CREATE TABLE `tm_sedes` (
  `sede_id` int(11) NOT NULL,
  `sede_name` varchar(255) DEFAULT NULL,
  `sede_date_new` datetime DEFAULT NULL,
  `sede_date_edit` datetime DEFAULT NULL,
  `sede_date_delete` datetime DEFAULT NULL,
  `sede_status` varchar(1) DEFAULT NULL,
  `usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tm_sedes`
--

INSERT INTO `tm_sedes` (`sede_id`, `sede_name`, `sede_date_new`, `sede_date_edit`, `sede_date_delete`, `sede_status`, `usu_id`) VALUES
(1, 'San Vicente', '2025-02-24 09:31:34', '2025-02-24 09:32:27', '2025-02-24 09:33:52', '1', 1),
(2, 'Mala', '2025-02-24 09:31:52', NULL, NULL, '1', 1),
(3, 'Yauyos', '2025-02-24 09:32:10', NULL, NULL, '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_ubigeo`
--

CREATE TABLE `tm_ubigeo` (
  `ubi_id` int(11) NOT NULL,
  `ubi_departament` varchar(200) DEFAULT NULL,
  `ubi_province` varchar(200) DEFAULT NULL,
  `ubi_district` varchar(200) DEFAULT NULL,
  `ubi_date_new` datetime DEFAULT NULL,
  `ubi_date_edit` datetime DEFAULT NULL,
  `ubi_date_delete` datetime DEFAULT NULL,
  `ubi_status` varchar(1) DEFAULT NULL,
  `usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tm_ubigeo`
--

INSERT INTO `tm_ubigeo` (`ubi_id`, `ubi_departament`, `ubi_province`, `ubi_district`, `ubi_date_new`, `ubi_date_edit`, `ubi_date_delete`, `ubi_status`, `usu_id`) VALUES
(1, 'Lima', 'Cañete', 'Asia', '2025-02-21 12:02:43', NULL, '2025-02-24 08:23:06', '1', 1),
(2, 'Lima', 'Cañete', 'Calango', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(3, 'Lima', 'Cañete', 'Cerro Azul', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(4, 'Lima', 'Cañete', 'Chilca', '2025-02-21 12:02:43', NULL, '2025-02-24 08:27:52', '1', 1),
(5, 'Lima', 'Cañete', 'Coayllo', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(6, 'Lima', 'Cañete', 'Imperial', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(7, 'Lima', 'Cañete', 'Lunahuana', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(8, 'Lima', 'Cañete', 'Mala', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(9, 'Lima', 'Cañete', 'Nuevo Imperial', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(10, 'Lima', 'Cañete', 'Pacaran', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(11, 'Lima', 'Cañete', 'Quilmana', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(12, 'Lima', 'Cañete', 'San Antonio', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(13, 'Lima', 'Cañete', 'San Luis', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(14, 'Lima', 'Cañete', 'Santa Cruz de Flores', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(15, 'Lima', 'Cañete', 'Zúñiga', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(16, 'Lima', 'Yauyos', 'Alis', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(17, 'Lima', 'Yauyos', 'Ayauca', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(18, 'Lima', 'Yauyos', 'Ayaviri', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(19, 'Lima', 'Yauyos', 'Azángaro', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(20, 'Lima', 'Yauyos', 'Cacra', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(21, 'Lima', 'Yauyos', 'Carania', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(22, 'Lima', 'Yauyos', 'Catahuasi', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(23, 'Lima', 'Yauyos', 'Chocos', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(24, 'Lima', 'Yauyos', 'Cochas', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(25, 'Lima', 'Yauyos', 'Colonia', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(26, 'Lima', 'Yauyos', 'Hongos', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(27, 'Lima', 'Yauyos', 'Huampara', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(28, 'Lima', 'Yauyos', 'Huancaya', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(29, 'Lima', 'Yauyos', 'Huangascar', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(30, 'Lima', 'Yauyos', 'Huantan', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(31, 'Lima', 'Yauyos', 'Huañec', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(32, 'Lima', 'Yauyos', 'Laraos', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(33, 'Lima', 'Yauyos', 'Lincha', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(34, 'Lima', 'Yauyos', 'Madean', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(35, 'Lima', 'Yauyos', 'Miraflores', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(36, 'Lima', 'Yauyos', 'Omas', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(37, 'Lima', 'Yauyos', 'Putinza', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(38, 'Lima', 'Yauyos', 'Quinches', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(39, 'Lima', 'Yauyos', 'Quinocay', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(40, 'Lima', 'Yauyos', 'San Joaquín', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(41, 'Lima', 'Yauyos', 'San Pedro de Pilas', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(42, 'Lima', 'Yauyos', 'Tanta', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(43, 'Lima', 'Yauyos', 'Tauripampa', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(44, 'Lima', 'Yauyos', 'Tomas', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(45, 'Lima', 'Yauyos', 'Tupe', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(46, 'Lima', 'Yauyos', 'Viñac', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(47, 'Lima', 'Yauyos', 'Vitis', '2025-02-21 12:02:43', NULL, NULL, '1', 1),
(48, 'Lima', 'Yauyos', 'Yauyos', '2025-02-21 12:02:43', NULL, NULL, '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_usuarios`
--

CREATE TABLE `tm_usuarios` (
  `usu_id` int(11) NOT NULL,
  `usu_name` varchar(80) DEFAULT NULL,
  `usu_lastname` varchar(85) DEFAULT NULL,
  `usu_dni` char(8) DEFAULT NULL,
  `usu_rol` varchar(40) DEFAULT NULL,
  `usu_password` varchar(80) DEFAULT NULL,
  `usu_date_new` datetime DEFAULT NULL,
  `usu_date_edit` datetime DEFAULT NULL,
  `usu_date_delete` datetime DEFAULT NULL,
  `usu_status` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tm_usuarios`
--

INSERT INTO `tm_usuarios` (`usu_id`, `usu_name`, `usu_lastname`, `usu_dni`, `usu_rol`, `usu_password`, `usu_date_new`, `usu_date_edit`, `usu_date_delete`, `usu_status`) VALUES
(1, 'Jose Luis', 'Campos Torres', '74757759', '1', 'demo123', NULL, NULL, NULL, '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tm_backup`
--
ALTER TABLE `tm_backup`
  ADD PRIMARY KEY (`back_id`),
  ADD KEY `FK_TM_USU_ID_BACKUP_TM` (`usu_id`);

--
-- Indices de la tabla `tm_casos`
--
ALTER TABLE `tm_casos`
  ADD PRIMARY KEY (`caso_id`),
  ADD KEY `FK_TM_DETE_CASOS` (`usu_id`),
  ADD KEY `FK_TM_DELI_CASOS` (`deli_id`);

--
-- Indices de la tabla `tm_categorias_delitos`
--
ALTER TABLE `tm_categorias_delitos`
  ADD PRIMARY KEY (`cate_deli_id`);

--
-- Indices de la tabla `tm_delitos`
--
ALTER TABLE `tm_delitos`
  ADD PRIMARY KEY (`deli_id`),
  ADD KEY `FK_USU_ID_DELITOS` (`usu_id`),
  ADD KEY `FK_CATE_DELI_ID` (`cate_deli_id`);

--
-- Indices de la tabla `tm_dependencias`
--
ALTER TABLE `tm_dependencias`
  ADD PRIMARY KEY (`depen_id`),
  ADD KEY `FK_SEDE_ID_DEPENDENCIA` (`sede_id`),
  ADD KEY `FK_USU_ID_DEPENDENCIA` (`usu_id`);

--
-- Indices de la tabla `tm_detenidos`
--
ALTER TABLE `tm_detenidos`
  ADD PRIMARY KEY (`dete_id`),
  ADD KEY `FK_CASO_ID_DETENIDOS` (`caso_id`);

--
-- Indices de la tabla `tm_locales`
--
ALTER TABLE `tm_locales`
  ADD PRIMARY KEY (`loca_id`),
  ADD KEY `FK_USU_ID_LOCAL` (`usu_id`);

--
-- Indices de la tabla `tm_sedes`
--
ALTER TABLE `tm_sedes`
  ADD PRIMARY KEY (`sede_id`),
  ADD KEY `FK_USU_ID_SEDE` (`usu_id`);

--
-- Indices de la tabla `tm_ubigeo`
--
ALTER TABLE `tm_ubigeo`
  ADD PRIMARY KEY (`ubi_id`),
  ADD KEY `FK_USU_ID_UBIGEO` (`usu_id`);

--
-- Indices de la tabla `tm_usuarios`
--
ALTER TABLE `tm_usuarios`
  ADD PRIMARY KEY (`usu_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tm_backup`
--
ALTER TABLE `tm_backup`
  MODIFY `back_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tm_casos`
--
ALTER TABLE `tm_casos`
  MODIFY `caso_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tm_categorias_delitos`
--
ALTER TABLE `tm_categorias_delitos`
  MODIFY `cate_deli_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tm_delitos`
--
ALTER TABLE `tm_delitos`
  MODIFY `deli_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tm_dependencias`
--
ALTER TABLE `tm_dependencias`
  MODIFY `depen_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tm_detenidos`
--
ALTER TABLE `tm_detenidos`
  MODIFY `dete_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tm_locales`
--
ALTER TABLE `tm_locales`
  MODIFY `loca_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tm_sedes`
--
ALTER TABLE `tm_sedes`
  MODIFY `sede_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tm_ubigeo`
--
ALTER TABLE `tm_ubigeo`
  MODIFY `ubi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tm_backup`
--
ALTER TABLE `tm_backup`
  ADD CONSTRAINT `FK_TM_USU_ID_BACKUP_TM` FOREIGN KEY (`usu_id`) REFERENCES `tm_usuarios` (`usu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tm_casos`
--
ALTER TABLE `tm_casos`
  ADD CONSTRAINT `FK_TM_DELI_CASOS` FOREIGN KEY (`deli_id`) REFERENCES `tm_delitos` (`deli_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_TM_DETE_CASOS` FOREIGN KEY (`usu_id`) REFERENCES `tm_usuarios` (`usu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tm_delitos`
--
ALTER TABLE `tm_delitos`
  ADD CONSTRAINT `FK_CATE_DELI_ID` FOREIGN KEY (`cate_deli_id`) REFERENCES `tm_categorias_delitos` (`cate_deli_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_USU_ID_DELITOS` FOREIGN KEY (`usu_id`) REFERENCES `tm_usuarios` (`usu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tm_dependencias`
--
ALTER TABLE `tm_dependencias`
  ADD CONSTRAINT `FK_SEDE_ID_DEPENDENCIA` FOREIGN KEY (`sede_id`) REFERENCES `tm_sedes` (`sede_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_USU_ID_DEPENDENCIA` FOREIGN KEY (`usu_id`) REFERENCES `tm_usuarios` (`usu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tm_detenidos`
--
ALTER TABLE `tm_detenidos`
  ADD CONSTRAINT `FK_CASO_ID_DETENIDOS` FOREIGN KEY (`caso_id`) REFERENCES `tm_casos` (`caso_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tm_locales`
--
ALTER TABLE `tm_locales`
  ADD CONSTRAINT `FK_USU_ID_LOCAL` FOREIGN KEY (`usu_id`) REFERENCES `tm_usuarios` (`usu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tm_sedes`
--
ALTER TABLE `tm_sedes`
  ADD CONSTRAINT `FK_USU_ID_SEDE` FOREIGN KEY (`usu_id`) REFERENCES `tm_usuarios` (`usu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tm_ubigeo`
--
ALTER TABLE `tm_ubigeo`
  ADD CONSTRAINT `FK_USU_ID_UBIGEO` FOREIGN KEY (`usu_id`) REFERENCES `tm_usuarios` (`usu_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
