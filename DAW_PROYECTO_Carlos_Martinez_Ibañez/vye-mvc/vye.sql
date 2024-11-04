-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 01-04-2024 a las 20:30:43
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vye`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avatar`
--

CREATE TABLE `avatar` (
  `id_avatar` int NOT NULL,
  `id_usuario` int DEFAULT NULL,
  `ruta_avatar` varchar(255) COLLATE utf8mb3_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `avatar`
--

INSERT INTO `avatar` (`id_avatar`, `id_usuario`, `ruta_avatar`) VALUES
(1, 42, '../otros/imagenes/colombia.png'),
(5, 2, '../otros/imagenes/espana.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colecciones`
--

CREATE TABLE `colecciones` (
  `id_coleccion` int NOT NULL,
  `id_usuario` int NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pais` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ciudad` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `comentario` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rating` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `colecciones`
--

INSERT INTO `colecciones` (`id_coleccion`, `id_usuario`, `nombre`, `pais`, `ciudad`, `comentario`, `rating`) VALUES
(1, 1, 'Primera', 'España', 'burgos', 'La mejor del mundo', 5),
(2, 2, 'Segunda', 'Francia', 'Paris', 'París (en francés: Parisⓘ) es la capital de Francia y su ciudad más poblada. Capital de la región de Isla de Francia (o «Región Parisina»), constituye el único departamento unicomunal del país.  Establecida en el centro de la cuenca de París, en un bucle del Sena, entre las confluencias con el Marne y el Oise. Fue ocupada desde el siglo iii a. C. por el pueblo galo de los Parisii, en el sitio original de Lutecia, del cual toma el nombre de París alrededor del año 310, para irse extendiendo en su', 3),
(4, 1, 'Prueba1', 'Portugal', 'Lisboa', 'Lisboa (pronunciación en portugués: /liʒˈβoɐ/ (escucharⓘ)) es la capital1​ y mayor ciudad de Portugal. Situada en la desembocadura del río Tajo, es la capital del país, capital del distrito de Lisboa, de la región de Lisboa, del Área Metropolitana de Lisboa, y es también el principal centro de la subregión de la Gran Lisboa. La ciudad tiene una población de 547.773 habitantes y su área metropolitana se sitúa en los 2.810.923 en una superficie de 2.921,90 km². Esta área contiene el 26% de la pobl', 4),
(24, 4, 'prueba', 'prueba', 'prueba', 'prueba', 5),
(25, 1, 'prueba', 'prueba', 'prueba', 'prueba', 5),
(92, 2, 'asd', 'asd', 'asd', 'asdfsdfas', 3),
(93, 2, 'asd', 'asd', 'asd', 'asddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasddddddddddddddddasdddddddddddd', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperacion`
--

CREATE TABLE `recuperacion` (
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(32) NOT NULL,
  `expira` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `recuperacion`
--

INSERT INTO `recuperacion` (`email`, `token`, `expira`) VALUES
('carlos@viajayexplora.com', '1f861dc7e1a49a127e1af1cd1128f52a', '2024-04-02 18:34:26'),
('carlos@viajayexplora.com', '6032cd0269ae108c71138730150d1db2', '2024-04-02 18:34:48'),
('carlos@viajayexplora.com', '561367092812bbaec14fe6a7aeb32607', '2024-04-02 18:40:38'),
('carlos@viajayexplora.com', '598517e9783805802f931e1dd9d163ef', '2024-04-02 18:41:20'),
('viajayexploraweb@gmail.com', '9f2bca3d2829b8e6a3a761b52623d8d4', '2024-04-02 18:58:51'),
('viajayexploraweb@gmail.com', '03fcbdd702ca15ba0ec0218b44b4a963', '2024-04-02 18:59:38'),
('viajayexploraweb@gmail.com', '4b7de50bdfc2676a9bb9518e1e725c84', '2024-04-02 19:01:59'),
('viajayexploraweb@gmail.com', 'b05cd9fabf9ab1998697e94ded84d8f2', '2024-04-02 19:02:33'),
('viajayexploraweb@gmail.com', '2c11b5bda8f9a6d8a8892cd5de20c2af', '2024-04-02 19:02:45'),
('viajayexploraweb@gmail.com', '160ac2e7e36cd022177c4ca7576363b0', '2024-04-02 19:09:35'),
('viajayexploraweb@gmail.com', 'd9db6e76936d9e715f79a75d7505c8b0', '2024-04-02 19:14:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usuario` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rol` tinyint(1) NOT NULL,
  `ultimaConexion` datetime DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `sexo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pais` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `usuario`, `email`, `pass`, `rol`, `ultimaConexion`, `fechaNacimiento`, `sexo`, `pais`) VALUES
(1, 'Administrador', 'Web', 'Admin', 'Admin@viajayexplora.com', '$2y$10$ZYIqLc4MOiDgDHanvPOr9etCRYwEoWlWMQzgc3BbiWUff9fEBfrOy', 1, '2024-04-01 05:47:38', '0000-00-00', '', ''),
(2, 'Carlos', 'Martinez Martinez', 'Carlos', 'carlos@viajayexplora.com', '$2y$10$3Z00VQ0wlh1D5V398AoQQOcUVoDa1hIpWVQksSLNELfDR4hDJIPIu', 2, '2024-04-01 18:42:58', '1983-05-18', 'Masculino', 'España'),
(3, 'Violeta', 'Perez Perez', 'Vio', 'violeta@viajayexplora.com', '$2y$10$gBPsWpJ8LYU8TlNCMsWz8uBjLpikne8r.LWS5gkR8A6NnxYvWwfUW', 2, '2024-03-20 19:07:31', '0000-00-00', '', ''),
(4, 'David', 'Martinez Martinez', 'David', 'David@viajayexplora.com', '$2y$10$T5HXvadpzu0UDXiiddAP7OKmLSVtR/pTu93pWLAwEk0kDHvXvDONG', 2, '2024-03-24 07:03:12', '0000-00-00', '', ''),
(42, 'alfredo', 'cebrian', 'alfred', 'alfre@gmail.com', '$2y$10$Cp4CD.mWMPHvfkX6/PXXB.A6Y.7G.Z5o5/mmgbklJaDOiukpvqx5.', 2, '2024-03-24 12:30:11', '0000-00-00', '', ''),
(43, 'Charly', 'Martinez', 'Charly', 'viajayexploraweb@gmail.com', '$2y$10$y6EeiUyjYps3LAn2kwtm9.whkv.uUDCcsnHMnTMfhCWGKIs.45B9y', 2, '2024-04-01 20:29:55', '2015-02-11', 'Otros', 'Andorra');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `avatar`
--
ALTER TABLE `avatar`
  ADD PRIMARY KEY (`id_avatar`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `colecciones`
--
ALTER TABLE `colecciones`
  ADD PRIMARY KEY (`id_coleccion`),
  ADD KEY `id_usuario` (`id_usuario`) USING BTREE;

--
-- Indices de la tabla `recuperacion`
--
ALTER TABLE `recuperacion`
  ADD KEY `email` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_index` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `avatar`
--
ALTER TABLE `avatar`
  MODIFY `id_avatar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `colecciones`
--
ALTER TABLE `colecciones`
  MODIFY `id_coleccion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `avatar`
--
ALTER TABLE `avatar`
  ADD CONSTRAINT `avatar_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `colecciones`
--
ALTER TABLE `colecciones`
  ADD CONSTRAINT `colecciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `recuperacion`
--
ALTER TABLE `recuperacion`
  ADD CONSTRAINT `recuperacion_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuarios` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
