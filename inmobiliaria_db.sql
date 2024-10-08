-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-10-2024 a las 18:46:18
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
-- Base de datos: `inmobiliaria_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `id` int(50) NOT NULL,
  `ubicacion` varchar(30) NOT NULL,
  `m2` int(5) NOT NULL,
  `modalidad` varchar(30) NOT NULL,
  `id_propietario` int(50) NOT NULL,
  `precio_inicial` int(30) NOT NULL,
  `precio_flex` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`id`, `ubicacion`, `m2`, `modalidad`, `id_propietario`, `precio_inicial`, `precio_flex`) VALUES
(1, 'Calle Mayor 45', 90, 'venta', 1, 150000, 1),
(2, 'Avenida Sol 123', 110, 'alquiler', 2, 125000, 1),
(3, 'Calle Luna 78', 85, 'venta', 3, 135000, 0),
(4, 'Calle Estrella 89', 75, 'alquiler', 4, 128000, 0),
(5, 'Avenida Río 56', 100, 'venta', 5, 160000, 0),
(6, 'Calle Jardines 33', 65, 'alquiler', 6, 120000, 1),
(7, 'Calle Pinos 12', 105, 'venta', 1, 170000, 1),
(8, 'Avenida Mar 99', 120, 'alquiler', 2, 140000, 0),
(9, 'Calle Robles 34', 95, 'venta', 3, 145000, 1),
(10, 'Avenida Olivos 25', 80, 'alquiler', 4, 130000, 1),
(11, 'Calle Cipreses 67', 90, 'venta', 5, 155000, 0),
(12, 'Avenida Norte 112', 130, 'alquiler', 6, 125000, 0),
(13, 'Calle Sur 44', 110, 'venta', 1, 175000, 1),
(14, 'Avenida Palmeras 21', 85, 'alquiler', 2, 130000, 0),
(15, 'Calle Flores 59', 100, 'venta', 3, 160000, 0),
(16, 'Calle Acacias 11', 115, 'alquiler', 4, 120000, 1),
(17, 'Avenida Cedros 91', 105, 'venta', 5, 145000, 0),
(18, 'Calle Lavanda 23', 75, 'alquiler', 6, 120000, 0),
(19, 'Avenida Girasoles 53', 130, 'venta', 1, 190000, 1),
(20, 'Calle Olmo 85', 90, 'alquiler', 2, 140000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietarios`
--

CREATE TABLE `propietarios` (
  `id` int(50) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `propietarios`
--

INSERT INTO `propietarios` (`id`, `nombre`, `apellido`) VALUES
(1, 'Franco', 'Espinoza'),
(2, 'Lucas', 'Losano'),
(3, 'Soledad', 'Moracho'),
(4, 'Joaquín', 'Sanchez'),
(5, 'Santiago', 'Gomez'),
(6, 'Tomas', 'Echeverría');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_propietario` (`id_propietario`);

--
-- Indices de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD CONSTRAINT `propiedades_ibfk_1` FOREIGN KEY (`id_propietario`) REFERENCES `propietarios` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
