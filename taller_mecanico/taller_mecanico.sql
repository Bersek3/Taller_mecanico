-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2024 a las 05:21:11
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
-- Base de datos: `taller_mecanico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `base`
--

CREATE TABLE `base` (
  `idb` int(11) NOT NULL,
  `base` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `base`
--

INSERT INTO `base` (`idb`, `base`) VALUES
(1, 'citas_medicas.sql');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `idpa` int(11) NOT NULL,
  `idodc` int(11) NOT NULL,
  `idlab` int(11) NOT NULL,
  `color` char(14) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `state` char(1) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `chec` char(1) NOT NULL,
  `fere` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idpa` int(11) NOT NULL,
  `numhs` char(8) NOT NULL,
  `nompa` varchar(30) NOT NULL,
  `apepa` varchar(30) NOT NULL,
  `direc` varchar(150) NOT NULL,
  `ciu` varchar(15) NOT NULL,
  `grup` varchar(15) NOT NULL,
  `phon` char(13) NOT NULL,
  `cump` date NOT NULL,
  `corr` varchar(35) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` char(1) NOT NULL,
  `state` char(1) NOT NULL,
  `fere` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idpa`, `numhs`, `nompa`, `apepa`, `direc`, `ciu`, `grup`, `phon`, `cump`, `corr`, `username`, `password`, `rol`, `state`, `fere`) VALUES
(6, '12312312', 'Bersek', 'Hola', 'VINA DEL MAR 1106', 'Masculino', 'Pto Montt', '987876565', '2000-01-01', '', '', '', '', '1', '2024-12-03 02:55:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consult`
--

CREATE TABLE `consult` (
  `idconslt` int(11) NOT NULL,
  `mtcl` text NOT NULL,
  `idpa` int(11) NOT NULL,
  `nompa` varchar(35) NOT NULL,
  `state` char(1) NOT NULL,
  `fere` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `idlab` int(11) NOT NULL,
  `nomlab` varchar(150) NOT NULL,
  `state` char(1) NOT NULL,
  `fere` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`idlab`, `nomlab`, `state`, `fere`) VALUES
(14, 'Electricidad', '1', '2024-12-03 03:56:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mecanicos`
--

CREATE TABLE `mecanicos` (
  `idodc` int(11) NOT NULL,
  `ceddoc` varchar(15) NOT NULL,
  `nodoc` varchar(35) NOT NULL,
  `apdoc` varchar(35) NOT NULL,
  `nomesp` varchar(100) NOT NULL,
  `direcd` varchar(150) NOT NULL,
  `sexd` varchar(15) NOT NULL,
  `phd` char(13) NOT NULL,
  `nacd` date NOT NULL,
  `corr` varchar(30) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` char(1) NOT NULL,
  `state` char(1) NOT NULL,
  `fere` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mecanicos`
--

INSERT INTO `mecanicos` (`idodc`, `ceddoc`, `nodoc`, `apdoc`, `nomesp`, `direcd`, `sexd`, `phd`, `nacd`, `corr`, `username`, `password`, `rol`, `state`, `fere`) VALUES
(13, '12312312', 'francisco', 'munoz', 'electrico', 'VINA DEL MAR', 'Masculino', '642345456', '2000-01-01', '', '', '', '', '1', '2024-12-03 02:54:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nurse`
--

CREATE TABLE `nurse` (
  `idnur` int(11) NOT NULL,
  `numide` char(14) NOT NULL,
  `nomnur` varchar(35) NOT NULL,
  `apenur` varchar(35) NOT NULL,
  `nacinur` date NOT NULL,
  `sexnur` varchar(15) NOT NULL,
  `state` char(1) NOT NULL,
  `fere` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `nurse`
--

INSERT INTO `nurse` (`idnur`, `numide`, `nomnur`, `apenur`, `nacinur`, `sexnur`, `state`, `fere`) VALUES
(5, '09453534534534', 'MANUEL LUCAS', 'PERES JARAMILLO', '1996-03-01', 'Femenino', '1', '2022-10-25 06:11:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `idprcd` int(11) NOT NULL,
  `codpro` char(14) NOT NULL,
  `nompro` text NOT NULL,
  `idcat` int(11) NOT NULL,
  `preprd` decimal(10,2) NOT NULL,
  `stock` char(3) NOT NULL,
  `state` char(1) NOT NULL,
  `fere` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`idprcd`, `codpro`, `nompro`, `idcat`, `preprd`, `stock`, `state`, `fere`) VALUES
(1, 'AMF774FFBFBDBF', 'MANTIXA 2.5 MG X 30 COMPRIMIDOS', 5, 153.60, '90', '1', '2022-10-25 18:40:09'),
(2, 'SKU: 09434', 'Pomada Antiinflamatoria Lymphdiaral x 40 gr', 7, 45.00, '50', '1', '2022-10-25 18:58:17'),
(3, '09898978978978', 'cvcvcv', 3, 33.90, '99', '1', '2022-10-26 19:58:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repuestos`
--

CREATE TABLE `repuestos` (
  `idcat` int(11) NOT NULL,
  `nomcat` varchar(150) NOT NULL,
  `state` char(1) NOT NULL,
  `fere` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `repuestos`
--

INSERT INTO `repuestos` (`idcat`, `nomcat`, `state`, `fere`) VALUES
(2, 'Excipientes', '1', '2022-10-25 07:19:44'),
(3, 'Analgésicos', '1', '2022-10-25 07:28:01'),
(4, 'Antiinflamatorios', '1', '2022-10-25 07:19:58'),
(5, 'Antipiréticos', '1', '2022-10-25 07:20:04'),
(6, 'Laxantes', '1', '2022-10-25 07:27:56'),
(7, 'Antiinfecciosos', '1', '2022-10-25 07:20:18'),
(8, 'Antitusivos', '1', '2022-10-25 07:20:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` char(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `name`, `email`, `password`, `rol`, `created_at`) VALUES
(1, 'admin', 'Administrador', 'adrianlujam91@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', '1', '2022-10-28 07:12:48');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `base`
--
ALTER TABLE `base`
  ADD PRIMARY KEY (`idb`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idpa` (`idpa`),
  ADD KEY `idodc` (`idodc`),
  ADD KEY `idlab` (`idlab`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idpa`);

--
-- Indices de la tabla `consult`
--
ALTER TABLE `consult`
  ADD PRIMARY KEY (`idconslt`);

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`idlab`);

--
-- Indices de la tabla `mecanicos`
--
ALTER TABLE `mecanicos`
  ADD PRIMARY KEY (`idodc`);

--
-- Indices de la tabla `nurse`
--
ALTER TABLE `nurse`
  ADD PRIMARY KEY (`idnur`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idprcd`),
  ADD KEY `idcat` (`idcat`);

--
-- Indices de la tabla `repuestos`
--
ALTER TABLE `repuestos`
  ADD PRIMARY KEY (`idcat`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `base`
--
ALTER TABLE `base`
  MODIFY `idb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idpa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `consult`
--
ALTER TABLE `consult`
  MODIFY `idconslt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `idlab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `mecanicos`
--
ALTER TABLE `mecanicos`
  MODIFY `idodc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `nurse`
--
ALTER TABLE `nurse`
  MODIFY `idnur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `idprcd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `repuestos`
--
ALTER TABLE `repuestos`
  MODIFY `idcat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`idpa`) REFERENCES `clientes` (`idpa`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`idodc`) REFERENCES `mecanicos` (`idodc`),
  ADD CONSTRAINT `citas_ibfk_3` FOREIGN KEY (`idlab`) REFERENCES `especialidades` (`idlab`);

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`idcat`) REFERENCES `repuestos` (`idcat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
