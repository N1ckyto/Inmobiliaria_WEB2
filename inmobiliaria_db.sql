-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
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

-- Base de datos: `inmobiliaria_db`
CREATE DATABASE IF NOT EXISTS `inmobiliaria_db`;
USE `inmobiliaria_db`;

-- --------------------------------------------------------

-- Tabla: `categorias`
CREATE TABLE IF NOT EXISTS `categorias` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(50) NOT NULL,
    `tipo` ENUM('propietario', 'propiedad') NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Datos para la tabla `categorias`
INSERT INTO `categorias` (`id`, `nombre`, `tipo`) VALUES
(1, 'Inversionista', 'propietario'),
(2, 'Particular', 'propietario'),
(3, 'Comercial', 'propiedad'),
(4, 'Residencial', 'propiedad');

-- --------------------------------------------------------

-- Tabla: `propiedades`
CREATE TABLE IF NOT EXISTS `propiedades` (
  `id` INT(50) NOT NULL AUTO_INCREMENT,
  `ubicacion` VARCHAR(30) NOT NULL,
  `m2` INT(5) NOT NULL,
  `modalidad` VARCHAR(30) NOT NULL,
  `categoria_id` INT(11) NOT NULL,
  `id_propietario` INT(50) NOT NULL,
  `precio_inicial` INT(30) NOT NULL,
  `precio_flex` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_propietario` (`id_propietario`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Datos para la tabla `propiedades`
INSERT INTO `propiedades` (`id`, `ubicacion`, `m2`, `modalidad`, `categoria_id`, `id_propietario`, `precio_inicial`, `precio_flex`) VALUES
(1, 'Calle Mayor 45', 90, 'venta', 4, 1, 150000, 1),
(2, 'Avenida Sol 123', 110, 'alquiler', 3, 2, 125000, 1),
(3, 'Calle Luna 78', 85, 'venta', 4, 3, 135000, 0),
(4, 'Calle Estrella 89', 75, 'alquiler', 3, 4, 128000, 0),
(5, 'Avenida Río 56', 100, 'venta', 4, 5, 160000, 0),
(6, 'Calle Jardines 33', 65, 'alquiler', 3, 6, 120000, 1),
(7, 'Calle Pinos 12', 105, 'venta', 4, 1, 170000, 1),
(8, 'Avenida Mar 99', 120, 'alquiler', 3, 2, 140000, 0),
(9, 'Calle Robles 34', 95, 'venta', 4, 3, 145000, 1),
(10, 'Avenida Olivos 25', 80, 'alquiler', 3, 4, 130000, 1);

-- --------------------------------------------------------

-- Tabla: `propietarios`
CREATE TABLE IF NOT EXISTS `propietarios` (
  `id` INT(50) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(30) NOT NULL,
  `apellido` VARCHAR(30) NOT NULL,
  `categoria_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Datos para la tabla `propietarios`
INSERT INTO `propietarios` (`id`, `nombre`, `apellido`, `categoria_id`) VALUES
(1, 'Franco', 'Espinoza', 1),
(2, 'Lucas', 'Losano', 1),
(3, 'Soledad', 'Moracho', 1),
(4, 'Joaquín', 'Sanchez', 2),
(5, 'Santiago', 'Gomez', 2),
(6, 'Tomas', 'Echeverría', 2);

-- --------------------------------------------------------

-- Índices y restricciones

-- Índices para la tabla `propiedades`
ALTER TABLE `propiedades`
  ADD CONSTRAINT `propiedades_ibfk_1` FOREIGN KEY (`id_propietario`) REFERENCES `propietarios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `propiedades_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON UPDATE CASCADE;

-- Índices para la tabla `propietarios`
ALTER TABLE `propietarios`
  ADD CONSTRAINT `propietarios_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON UPDATE CASCADE;

-- AUTO_INCREMENT para las tablas
ALTER TABLE `propiedades`
  MODIFY `id` INT(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `propietarios`
  MODIFY `id` INT(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
