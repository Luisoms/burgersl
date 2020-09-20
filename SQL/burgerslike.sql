-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-09-2020 a las 05:41:24
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id14839039_burgerslike`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `adm_id` int(222) NOT NULL,
  `nombre` varchar(222) NOT NULL,
  `clave` varchar(222) NOT NULL,
  `correo` varchar(222) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`adm_id`, `nombre`, `clave`, `correo`, `fecha`) VALUES
(9, 'milagros', 'e10adc3949ba59abbe56e057f20f883e', 'milagros@gmail.com', '2020-08-09 10:05:44'),
(10, 'enrique oliveros', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'enrique@gmail.com', '2020-08-18 00:41:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `o_id` int(222) NOT NULL,
  `u_id` int(222) NOT NULL,
  `p_id` int(222) NOT NULL,
  `carrito` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `modalidad` varchar(222) NOT NULL,
  `estatus` varchar(222) NOT NULL DEFAULT 'En proceso',
  `numreferencia` int(50) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`o_id`, `u_id`, `p_id`, `carrito`, `precio`, `modalidad`, `estatus`, `numreferencia`, `fecha`) VALUES
(332, 49, 39, 'W3sidGl0dWxvIjoiSGFtYnVyZ3Vlc2EgZGUgUG9sbG8iLCJwX2lkIjozOCwiY2FudGlkYWQiOiIyIn0seyJ0aXR1bG8iOiJQaXp6YSBmYW1pbGlhciIsInBfaWQiOjM5LCJjYW50aWRhZCI6IjYifV0=', '4000000.00', 'pickup', 'En proceso', 2147483647, '2020-09-11 00:19:31'),
(333, 49, 39, 'W3sidGl0dWxvIjoiUGl6emEgZmFtaWxpYXIiLCJwX2lkIjozOSwiY2FudGlkYWQiOjN9XQ==', '1350000.00', 'delivery', 'En proceso', 123123123, '2020-09-11 00:19:46'),
(334, 49, 38, 'W3sidGl0dWxvIjoiSGFtYnVyZ3Vlc2EgZGUgUG9sbG8iLCJwX2lkIjozOCwiY2FudGlkYWQiOiIxIn1d', '650000.00', 'delivery', 'En proceso', 2147483647, '2020-09-11 00:20:07'),
(335, 49, 39, 'W3sidGl0dWxvIjoiUGl6emEgZmFtaWxpYXIiLCJwX2lkIjozOSwiY2FudGlkYWQiOiIxIn1d', '450000.00', 'pickup', 'En proceso', 2147483647, '2020-09-11 00:20:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `p_id` int(222) NOT NULL,
  `titulo` varchar(222) NOT NULL,
  `descripcion` varchar(222) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `img` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`p_id`, `titulo`, `descripcion`, `precio`, `img`) VALUES
(38, 'Hamburguesa de Pollo', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.', '650000.00', '5f5a6fe08fb63.jpg'),
(39, 'Pizza familiar', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.', '450000.00', '5f5a6ff6732b8.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `u_id` int(222) NOT NULL,
  `u_nombre` varchar(222) NOT NULL,
  `nombre` varchar(222) NOT NULL,
  `apellido` varchar(222) NOT NULL,
  `correo` varchar(222) NOT NULL,
  `telefono` varchar(222) NOT NULL,
  `clave` varchar(222) NOT NULL,
  `direccion` text NOT NULL,
  `estatus` int(222) NOT NULL DEFAULT 1,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`u_id`, `u_nombre`, `nombre`, `apellido`, `correo`, `telefono`, `clave`, `direccion`, `estatus`, `fecha`) VALUES
(49, 'luism', 'luis', 'molina', 'luis@correo.com', '04251234567', 'e10adc3949ba59abbe56e057f20f883e', 'San Félix', 1, '2020-09-10 18:00:32');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `fkuid` (`u_id`),
  ADD KEY `fkpid` (`p_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`p_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `adm_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `o_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=336;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `p_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `u_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD CONSTRAINT `u_id` FOREIGN KEY (`u_id`) REFERENCES `usuarios` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
