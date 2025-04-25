-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2025 a las 16:41:54
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
-- Base de datos: `tienda_procesa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `documento` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `contra` varchar(250) NOT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `id_empresa` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`documento`, `id_rol`, `nombre`, `email`, `telefono`, `contra`, `direccion`, `id_empresa`) VALUES
(0, 2, '', NULL, NULL, '', NULL, NULL),
(93367768, 3, 'hector', 'gordo@gmail.com', '3102362969', '$2y$10$2LCZNAszHnWb4UbyfK5lJ.IstRsOh/FsAytvtsd8ApqVnzU1Xflt2', 'Carrera 2 Sur #3113', NULL),
(987654321, 1, 'nasmille', 'nasmille90@gmail.com', '3123080789', '$2y$10$beGT2JKZMzQlaKZk9GN7UOCiL9DBJB70XIrPyaNAuiVtE7ji20ULa', 'Carrera 45 Sur #1255', 987654321),
(1107978508, 2, 'brian', 'brianrocha@gmail.com', '3134463451', '$2y$10$kMIMWU/H//ttbycBPoEDL.mm2aq8hq/EXfQrheV4eJoEbkDq8RtL2', 'Carrera 2 Sur #3113', NULL),
(1234641699, 1, 'ivan rocha', 'ivanrocha@gmail.com', '31323332321', '$2y$10$sFuVGZE9F0Tq5.Z5f5vRMum0CEknXxJVPJIGERuP47.4tvhhbuKnu', 'Carrera 2 Sur #3113', 7654321);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_venta`
--

CREATE TABLE `detalles_venta` (
  `id_deta_ven_pro` int(11) NOT NULL,
  `id_venta` int(11) DEFAULT NULL,
  `id_procesadores` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles_venta`
--

INSERT INTO `detalles_venta` (`id_deta_ven_pro`, `id_venta`, `id_procesadores`, `cantidad`) VALUES
(2, 33, 3, 2),
(3, 34, 1, 2),
(4, 35, 1, 2),
(5, 36, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id_empresa` int(11) NOT NULL,
  `nombre_empresa` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id_empresa`, `nombre_empresa`) VALUES
(1234567, 'procesadores brian'),
(7654321, 'ivan  procesa'),
(123456789, 'brian'),
(987654321, 'gordo procesadores'),
(1107978507, 'procesadores brian rocha'),
(1234567865, 'procesa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `estado`) VALUES
(1, 'activo'),
(2, 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencias`
--

CREATE TABLE `licencias` (
  `id_licencia` varchar(10) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_tip_lice` int(11) NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_expira` date NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `licencias`
--

INSERT INTO `licencias` (`id_licencia`, `id_empresa`, `id_tip_lice`, `fecha_ini`, `fecha_expira`, `id_estado`) VALUES
('2YNhe5yh9c', 1234567, 1, '2025-04-24', '2025-04-27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesadores`
--

CREATE TABLE `procesadores` (
  `id_procesadores` int(11) NOT NULL,
  `codigo_barras` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `nucleos` int(11) DEFAULT NULL,
  `hilos` int(11) DEFAULT NULL,
  `frecuencia_base` decimal(4,2) DEFAULT NULL,
  `precio_uni` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `procesadores`
--

INSERT INTO `procesadores` (`id_procesadores`, `codigo_barras`, `marca`, `modelo`, `nucleos`, `hilos`, `frecuencia_base`, `precio_uni`) VALUES
(1, '1234567890123', 'Intel', 'Core i9-13900K', 24, 32, 3.00, 1800000.00),
(3, '9876543210987', 'Intel', 'Core i9-13900K', 24, 32, 3.00, 1.80),
(4, '1234567890', 'wdc', 'intel core 7', 24, 32, 3.00, 1800000.00),
(5, 'PROC-680abfb960977', '1234', 'v rtrtegr', 123, 12, 3.00, 18000000.00),
(6, '174555370911', '123456', 'intel core 5', 24, 12, 3.00, 180000.00),
(7, '17455540365', 'erecs', 'v rtrtegrdxawed', 24, 32, 3.00, 2000000.00),
(8, '17455543764', 'ryzem', 'intel core 6', 24, 32, 3.00, 1800000.00),
(12, '174555468610', 'juan', 'intel selerion', 32, 24, 3.80, 3000000.00),
(13, '7706616024937', '7706616024937', '7706616024937', 2147483647, 2147483647, 99.99, 99999999.99),
(14, '12345', 'wq23cds', 'intel core 7', 24, 32, 3.00, 1800000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'admin'),
(2, 'super_adm'),
(3, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_licencia`
--

CREATE TABLE `tipo_licencia` (
  `id_tip_lice` int(11) NOT NULL,
  `tipo_licencia` varchar(40) NOT NULL,
  `duracion` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_licencia`
--

INSERT INTO `tipo_licencia` (`id_tip_lice`, `tipo_licencia`, `duracion`, `precio`) VALUES
(1, 'demo', 3, 180000.00),
(2, 'basica', 180, 300000.00),
(3, 'mediana', 365, 400000.00),
(4, 'premium', 730, 500000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `documento` int(11) NOT NULL,
  `fecha` date DEFAULT curdate(),
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `documento`, `fecha`, `total`) VALUES
(25, 0, '2025-04-25', 3600000.00),
(26, 0, '2025-04-25', 3600000.00),
(27, 0, '2025-04-25', 3600000.00),
(28, 0, '2025-04-25', 3600000.00),
(29, 0, '2025-04-25', 3600000.00),
(30, 0, '2025-04-25', 3600000.00),
(31, 0, '2025-04-25', 3.60),
(32, 0, '2025-04-25', 3.60),
(33, 0, '2025-04-25', 3.60),
(34, 0, '2025-04-25', 3600000.00),
(35, 0, '2025-04-25', 3600000.00),
(36, 0, '2025-04-25', 3600000.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`documento`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_empresa` (`id_empresa`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  ADD PRIMARY KEY (`id_deta_ven_pro`),
  ADD KEY `venta_id` (`id_venta`),
  ADD KEY `procesador_id` (`id_procesadores`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `licencias`
--
ALTER TABLE `licencias`
  ADD PRIMARY KEY (`id_licencia`),
  ADD KEY `id_empresa` (`id_empresa`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_tip_lice` (`id_tip_lice`);

--
-- Indices de la tabla `procesadores`
--
ALTER TABLE `procesadores`
  ADD PRIMARY KEY (`id_procesadores`),
  ADD UNIQUE KEY `codigo_barras` (`codigo_barras`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tipo_licencia`
--
ALTER TABLE `tipo_licencia`
  ADD PRIMARY KEY (`id_tip_lice`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `cliente_id` (`documento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  MODIFY `id_deta_ven_pro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `procesadores`
--
ALTER TABLE `procesadores`
  MODIFY `id_procesadores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_licencia`
--
ALTER TABLE `tipo_licencia`
  MODIFY `id_tip_lice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clientes_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  ADD CONSTRAINT `detalles_venta_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalles_venta_ibfk_2` FOREIGN KEY (`id_procesadores`) REFERENCES `procesadores` (`id_procesadores`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `licencias`
--
ALTER TABLE `licencias`
  ADD CONSTRAINT `licencias_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `licencias_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `licencias_ibfk_3` FOREIGN KEY (`id_tip_lice`) REFERENCES `tipo_licencia` (`id_tip_lice`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`documento`) REFERENCES `clientes` (`documento`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
