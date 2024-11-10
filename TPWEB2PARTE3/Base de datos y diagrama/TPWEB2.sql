-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-10-2024 a las 02:02:04
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
-- Base de datos: `serie`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id_genero` int(45) NOT NULL,
  `genero` varchar(45) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id_genero`, `genero`, `descripcion`) VALUES
(11, 'Romance', 'El cine romántico es un género cinematográfico que se caracteriza por retratar argumentos construidos de eventos y personajes relacionados con la expresión del amor y las relaciones románticas.'),
(12, 'Terror', 'El terror es una sensación de miedo muy intensa. El miedo se define como una perturbación angustiosa del ánimo por un riesgo real o imaginario; cuando éste supera los controles cerebrales y el sujeto no puede pensar de forma racional, aparece el terror.'),
(13, 'Accion', 'Generalmente son series que aportan un toque de adrenalina. Incluyen acrobacias físicas, persecuciones rescates y batallas, lo que las caracteriza principalmente.'),
(14, 'Ciencia Ficcion', 'La ciencia ficción es un género narrativo que sitúa la acción en unas coordenadas espacio-temporales imaginarias y diferentes a las nuestras, y que especula racionalmente sobre posibles avances científicos o sociales y su impacto en la sociedad.'),
(15, 'Fantasia', 'es fantastico xd'),
(16, 'Drama', 'El género de drama en televisión se caracteriza por su enfoque en el desarrollo emocional y psicológico de los personajes, así como en la exploración de conflictos humanos profundos y realistas. Estas series a menudo abordan temas complejos y provocativos, como las relaciones interpersonales, la moralidad, la lucha por el poder, la identidad y la condición humana.'),
(17, 'Comedia', 'La comedia es un género narrativo que busca provocar la risa y el entretenimiento a través de situaciones humorísticas, personajes peculiares y diálogos ingeniosos. A menudo, se centra en los aspectos cómicos de la vida cotidiana, explorando las relaciones humanas, los malentendidos y las ironías de la existencia.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `serie`
--

CREATE TABLE `serie` (
  `id` int(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `temporadas` int(45) NOT NULL,
  `protagonistas` varchar(250) NOT NULL,
  `director` varchar(45) NOT NULL,
  `CalificacionPorEdad` varchar(5) NOT NULL,
  `resumen` text NOT NULL,
  `id_genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `serie`
--

INSERT INTO `serie` (`id`, `nombre`, `temporadas`, `protagonistas`, `director`, `CalificacionPorEdad`, `resumen`, `id_genero`) VALUES
(7, 'Outer Banks', 3, 'Madelyn Cline , Rudy Pankow, Chase Stokes, Jo', 'Jonas Pate', '16', 'Outer Banks sigue a un grupo de adolescentes en los Bancos Externos de Carolina del Norte llamados a sí mismos «Pogues» y están decididos a averiguar qué le sucedió al padre desaparecido del cabecilla del grupo, John B. (Chase Stokes). En el camino, descubren un tesoro legendario relacionado con el padre de John B.6​\\r\\n\\r\\nPerseguidos por la ley y un grupo rico y superior llamado los «Kook» de Figure Eight, los Pogues buscan superar obstáculos como las drogas, el amor, la lucha, la amistad, el dinero y cómo los ricos siguen ganando para completar el objetivo del padre de John B. en el que había estado trabajando durante 20 años.', 14),
(8, 'El hipnotizador ', 2, 'Leonardo Sbaraglia, Chico Díaz, César Troncoso, Marilú Marini, Juliana Didone, Bianca Comparato, Chino Darín, Christiana Ubach y Delfi Galbiati', 'Alex Gabasi y José Eduardo Belmonte', '16', 'Un hipnotizador condenado a un insomnio eterno que se dedica a adormecer a la gente y desenterrar sus recuerdos perdidos.', 13),
(13, 'The Last of Us', 1, 'Pedro Pascal , Bella Ramsey', 'Jesse Peretz, Jeff Chan, Erica Dunton', '16', 'The Last of Us es una serie de televisión estadounidense postapocalíptica que se estrenó el 15 de enero de 2023 a través de HBO. Basada en el videojuego de 2013 del mismo nombre desarrollado por Naughty Dog. La serie sigue a Joel (Pedro Pascal), un contrabandista encargado de escoltar a la adolescente Ellie (Bella Ramsey) a través de un Estados Unidos postapocalíptico. También cuenta con Tommy (Gabriel Luna), el hermano menor de Joel y exsoldado.', 14),
(16, 'El verano en que me enamore', 2, 'Lola Tung, Jackie Chung, Rachel Blanchard, Christopher Briney, Gavin Casalegno, Sean Kaufman, Alfredo Narciso, Minnie Mills, Colin Ferguson, Tom Everett Scott, Rain Spencer, JP Lambert, Summer Madison, David Iacono, Sarah Hudson, Rea DeRosa, Al Vicen', 'Jesse Peretz, Jeff Chan, Erica Dunton', '18', 'Belly Conklin está por cumplir 16 años y va a su lugar favorito en el mundo, la playa de Cousins, para pasar el verano con su familia y los Fisher. Belly ha crecido mucho durante el último año y siente que este verano será diferente a los anteriores. El verano en que me enamoré está basado en el libro de Jenny Han, quien es la creadora y productora ejecutiva.', 11),
(21, 'xdxdx', 2, 'adada', 'dadad', 'adada', 'adadada', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL ,
  `user` varchar(250) NOT NULL,
  `password` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `user`, `password`) VALUES
(6, 'webadmin', '$2y$10$Et51bjvH6ClrWQj7dPNjTeKAB7GtQHNS5OXYJuS.9nluLQ3/7XOJ.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indices de la tabla `serie`
--
ALTER TABLE `serie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_genero` (`id_genero`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id_genero` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `serie`
--
ALTER TABLE `serie`
  MODIFY `id` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `serie`
--
ALTER TABLE `serie`
  ADD CONSTRAINT `serie_ibfk_1` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id_genero`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
