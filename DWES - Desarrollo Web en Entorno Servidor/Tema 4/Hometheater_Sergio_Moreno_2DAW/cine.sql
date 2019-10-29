-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2019 a las 20:25:13
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cine`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `description` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `genres`
--

INSERT INTO `genres` (`id`, `description`) VALUES
(104807, 'FicciÃ³n'),
(174678, 'FantasÃ­a'),
(287414, 'Suspense'),
(399530, 'Documental'),
(459720, 'Thriller'),
(607319, 'AnimaciÃ³n'),
(681196, 'AcciÃ³n'),
(722750, 'Detectives'),
(760263, 'Terror'),
(860842, 'BÃ©lico'),
(889438, 'Aventuras'),
(906440, 'Drama'),
(930574, 'PolicÃ­aca'),
(952536, 'Musical'),
(961046, 'Comedia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genres_movies`
--

CREATE TABLE `genres_movies` (
  `id_genre` int(11) NOT NULL,
  `id_movie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `genres_movies`
--

INSERT INTO `genres_movies` (`id_genre`, `id_movie`) VALUES
(104807, 264485),
(174678, 365325),
(287414, 781751),
(459720, 615334),
(459720, 792802),
(607319, 781751),
(607319, 792802),
(681196, 768325),
(722750, 264485),
(722750, 914115),
(760263, 615334),
(860842, 768325),
(889438, 781751),
(952536, 914115),
(961046, 781760);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `year` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `rating` float NOT NULL,
  `cover` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `filepath` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `filename` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `external_url` varchar(500) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `movies`
--

INSERT INTO `movies` (`id`, `title`, `year`, `duration`, `rating`, `cover`, `filepath`, `filename`, `external_url`) VALUES
(264485, 'El Este del EdÃ©n', 1955, 115, 7, 'ElEstedelEden.png', 'movies', 'El_Este_del_Eden.mp4', 'https://www.filmaffinity.com/es/film464305.html'),
(365325, 'El niÃ±o con el pijama de rayas', 2008, 94, 6.9, 'NinoRayas.png', 'movies', 'NiÃ±oRayas.mp4', 'https://www.filmaffinity.com/es/film728544.html'),
(615334, 'La lista de Schindler', 1993, 195, 8, 'LalistadeSchindler.png', 'movies', 'La_lista_de_Schindler.mp4', 'https://www.filmaffinity.com/es/film656153.html'),
(768325, 'Un burka por amor', 2009, 73, 5.1, 'BurkaAmor.png', 'movies', 'BurkaAmor.mp4', 'https://www.filmaffinity.com/es/film778779.html'),
(781751, 'Shrek', 2001, 87, 7, 'Shrek.png', 'movies', 'Shrek.mp4', 'https://www.filmaffinity.com/es/film494558.html'),
(781760, 'Shrek 2', 2004, 93, 7.3, 'Shrek2.png', 'movies', 'Shrek2.mp4', 'https://www.filmaffinity.com/es/film333949.html'),
(792802, 'Shrek 3', 2007, 92, 5.9, 'Shrek3.png', 'movies', 'Shrek3.mp4', 'https://www.filmaffinity.com/es/film416894.html'),
(914115, 'Shrek felices para siempre', 2010, 93, 5.9, 'Shrek4.png', 'movies', 'Shrek4.mp4', 'https://www.filmaffinity.com/es/film948443.html');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `photo` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `external_url` varchar(500) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `people`
--

INSERT INTO `people` (`id`, `name`, `photo`, `external_url`) VALUES
(237463, 'Zac Efron', 'FotoProfesional.png', 'http://www.sensacine.com/actores/actor-117465/'),
(273529, 'BelÃ©n Rueda', 'FotoProfesional.png', 'http://www.sensacine.com/actores/actor-96325/'),
(274899, 'Biel Montoro', 'FotoProfesional.png', 'http://www.sensacine.com/actores/actor-702843/'),
(383511, 'Johnny Depp', 'FotoProfesional.png', 'http://www.sensacine.com/actores/actor-12839/'),
(404716, 'Can Yaman', 'FotoProfesional.png', 'http://www.sensacine.com/actores/actor-736984/'),
(414093, 'Jason Statham', 'FotoProfesional.png', 'http://www.sensacine.com/actores/actor-28586/'),
(455521, 'Enric Auquer', 'FotoProfesional.png', 'http://www.sensacine.com/actores/actor-449731/'),
(558105, 'Celia Freijeiro', 'FotoProfesional.png', 'http://www.sensacine.com/actores/actor-245364/'),
(613891, 'Claudia Salas', 'FotoProfesional.png', 'http://www.sensacine.com/actores/actor-862741/'),
(652948, 'Aixa Villagran', 'FotoProfesional.png', 'http://www.sensacine.com/actores/actor-408530/'),
(765222, 'Brad Pitt', 'FotoProfesional.png', 'http://www.sensacine.com/actores/actor-12302/'),
(774243, 'Will Smith', 'FotoProfesional.png', 'http://www.sensacine.com/actores/actor-19358/'),
(910890, 'Angelina Jolie', 'FotoProfesional.png', 'http://www.sensacine.com/actores/actor-27613/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `people_act_movies`
--

CREATE TABLE `people_act_movies` (
  `id_person` int(11) NOT NULL,
  `id_movie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `people_act_movies`
--

INSERT INTO `people_act_movies` (`id_person`, `id_movie`) VALUES
(237463, 615334),
(237463, 781751),
(273529, 615334),
(273529, 768325),
(273529, 781751),
(274899, 264485),
(274899, 365325),
(383511, 264485),
(383511, 768325),
(404716, 781751),
(404716, 781760),
(414093, 781760),
(414093, 792802),
(455521, 365325),
(455521, 615334),
(558105, 615334),
(558105, 768325),
(613891, 264485),
(613891, 365325),
(652948, 264485),
(652948, 615334),
(765222, 792802),
(765222, 914115),
(774243, 615334),
(774243, 914115),
(910890, 365325),
(910890, 781760),
(910890, 792802),
(910890, 914115);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `people_direct_movies`
--

CREATE TABLE `people_direct_movies` (
  `id_person` int(11) NOT NULL,
  `id_movie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `people_direct_movies`
--

INSERT INTO `people_direct_movies` (`id_person`, `id_movie`) VALUES
(237463, 615334),
(274899, 768325),
(404716, 914115),
(414093, 792802),
(652948, 365325),
(765222, 781751),
(774243, 781751),
(910890, 264485),
(910890, 781760);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nick` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nick`, `email`, `password`, `type`) VALUES
(207370, 's', 's', 's', 0),
(268550, 'a', 'a', 'a', 0),
(471967, 'admin', 'admin@gmail.com', 'admin', 0),
(552423, 'd', 'd', 'd', 0),
(656311, 'z', 'z', 'z', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `genres_movies`
--
ALTER TABLE `genres_movies`
  ADD PRIMARY KEY (`id_genre`,`id_movie`),
  ADD KEY `id_movie` (`id_movie`);

--
-- Indices de la tabla `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `people_act_movies`
--
ALTER TABLE `people_act_movies`
  ADD PRIMARY KEY (`id_person`,`id_movie`),
  ADD KEY `id_movie` (`id_movie`);

--
-- Indices de la tabla `people_direct_movies`
--
ALTER TABLE `people_direct_movies`
  ADD PRIMARY KEY (`id_person`,`id_movie`),
  ADD KEY `id_movie` (`id_movie`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `genres_movies`
--
ALTER TABLE `genres_movies`
  ADD CONSTRAINT `genres_movies_ibfk_1` FOREIGN KEY (`id_movie`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `genres_movies_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `people_act_movies`
--
ALTER TABLE `people_act_movies`
  ADD CONSTRAINT `people_act_movies_ibfk_1` FOREIGN KEY (`id_movie`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `people_act_movies_ibfk_2` FOREIGN KEY (`id_person`) REFERENCES `people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `people_direct_movies`
--
ALTER TABLE `people_direct_movies`
  ADD CONSTRAINT `people_direct_movies_ibfk_1` FOREIGN KEY (`id_movie`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `people_direct_movies_ibfk_2` FOREIGN KEY (`id_person`) REFERENCES `people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
