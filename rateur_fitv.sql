-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-10-2024 a las 05:10:49
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
-- Base de datos: `rateur_fitv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `nombre`, `descripcion`) VALUES
(27, 'Accion', 'Género cinematográfico donde prima la espectacularidad de las imágenes por medio de efectos especiales de estilo \"clásico\".'),
(28, 'Drama', 'Género literario caracterizado por la representación de acciones y situaciones humanas conflictivas, que ha sido concebido para su escenificación, bien sea teatral, bien televisiva o cinematográfica. En este sentido, drama también puede hacer referencia a la obra dramática en sí'),
(30, 'Suspense', 'El suspense o suspenso es la ansiedad, la inquietud, una combinación de emociones intensas que genera el desarrollo de una trama. Es la impaciencia, la tensión que se produce en el espectador por ver qué es lo que viene, por saber cómo se resolverá una situación o la trama misma de toda la obra cinematográfica, teatral, literaria.'),
(31, 'Romance', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shows`
--

CREATE TABLE `shows` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `release_date` date NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `shows`
--

INSERT INTO `shows` (`id`, `title`, `release_date`, `categorie_id`, `image_url`) VALUES
(28, 'Paris,Texas', '1985-02-14', 28, 'https://i.pinimg.com/564x/df/48/3f/df483f17a6862d58b883e6bef3ea1d66.jpg'),
(30, 'Laroy, Texas', '2024-04-17', 30, 'https://a.ltrbxd.com/resized/film-poster/9/0/2/4/7/1/902471-laroy-texas-0-2000-0-3000-crop.jpg?v=7e326b9e39'),
(31, 'Nueve reinas', '2000-08-31', 30, 'https://i.pinimg.com/originals/5a/99/5b/5a995bc5485e8dd316f43b306f813509.jpg'),
(32, 'Eyes Wide Shut', '1999-09-03', 30, 'https://i.pinimg.com/474x/c8/c0/f4/c8c0f4e54f655968da3f563a6a5c840b.jpg'),
(33, 'Never look away', '2018-10-03', 31, 'https://m.media-amazon.com/images/M/MV5BNDQ0MTc0NjctZjA5Mi00MDMwLTkzZTUtYTc3YjFkZDdjMmI3XkEyXkFqcGc@._V1_.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `password`) VALUES
(1, 'webadmin', '$2y$10$TxuJAAEQCm9PiFg1exYrCuGC8QoO2baDyjje.qeJM2pGVgeY9xeO6');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie_id` (`categorie_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `shows`
--
ALTER TABLE `shows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `shows`
--
ALTER TABLE `shows`
  ADD CONSTRAINT `shows_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
