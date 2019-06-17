-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-07-2016 a las 19:58:25
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `recicladora`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE IF NOT EXISTS `administradores` (
  `id_Admin` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY KEY',
  `nombre` varchar(45) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `nickname` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `fecha_Registro` date NOT NULL,
  `url_image` varchar(150) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_Admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Tabla que lamacena a los administradores del sitio' AUTO_INCREMENT=61 ;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id_Admin`, `nombre`, `telefono`, `email`, `nickname`, `password`, `fecha_Registro`, `url_image`, `estado`) VALUES
(60, 'Marcelino Frias Salceda', '452106987', 'mfs@hotmail.com', 'adminMark', '12345678', '2016-05-30', 'http://loopssolutions.com/Images/admin.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `Id_Cliente` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Cliente` varchar(50) NOT NULL,
  `Fecha_registro` date NOT NULL,
  `url_image` varchar(150) DEFAULT NULL,
  `Telefono` varchar(15) NOT NULL,
  `RFC` varchar(15) DEFAULT NULL COMMENT 'Quizas algunas companias no tengan RFC',
  `nickname` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `Id_Tipo` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`Id_Cliente`),
  KEY `Id_Tipo` (`Id_Tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`Id_Cliente`, `Nombre_Cliente`, `Fecha_registro`, `url_image`, `Telefono`, `RFC`, `nickname`, `password`, `email`, `Id_Tipo`, `estado`) VALUES
(1, 'Publico General', '2016-06-11', 'http://goo.gl/S46hJ0', '452101057', 'KJHGF7654', 'ClienteGeneral', '6574123', 'death_note59@hotmail.comsssddd', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE IF NOT EXISTS `contactos` (
  `id_contacto` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `asunto` varchar(30) NOT NULL,
  `Comentarios` varchar(400) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id_contacto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id_contacto`, `email`, `asunto`, `Comentarios`, `fecha`, `estado`) VALUES
(1, 'alexx@gmail.com', 'pregunta epicá??', 'Soy un comentario de caja!!!', '2016-06-08', 0),
(2, 'alexx@gmail.com', 'pregunta epic2á', 'Soy un comentario de caja!!!', '2016-06-08', 1),
(3, 'ricardo@gmail.com', 'LOCCCCCCCCCCCCCCCCCCCCCCCCCCCC', '', '2016-06-08', 1),
(4, 'death_note59@hotmail.com', 'LOCCCCCCCCCCCCCCCCCCCCCCCCCCCC', 'Comentario op', '2016-06-08', 1),
(5, 'ricardo@gmail.com', 'LOCCCCCCCCCCCCCCCCCCCCCCCCCCCC', 'opm commnet', '2016-06-08', 0),
(6, 'gggg@gmail.com', 'LOCCCCCCCCCCCCCCCCCCCCCCCCCCCC', 'ggggg55', '2016-06-08', 0),
(11, 'gggg@gmail.comb', 'gkkgggg55', '2016-06-12', '2016-06-08', 0),
(12, 'gggg@gmail.comb', '2016-06-12', '2016-06-08', '2016-06-08', 0),
(13, 'gggg@gmail.comb', '2lll', '2016-06-08', '2016-06-08', 0),
(14, 'gggg@gmail.comb', '2016-06-08lll', '2016-06-08', '2016-06-08', 0),
(15, 'gggg@gmail.comb', '2016-06-08lll', 'bbb', '2016-06-08', 0),
(16, 'gggg@gmail.comb', '2016-06-08lll', 'bbb', '2016-06-08', 0),
(17, 'gggg@gmail.comb', 'tttt', 'bvvv', '2016-06-08', 0),
(18, 'death_@hotmail.com', 'Mesnaje olii', 'lllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllvvvvvvvvvvvvvvvvvvvvvvvvvv', '2016-06-08', 1),
(25, 'death_note59@hotmail.com', '', '', '2016-06-09', 1),
(26, 'death_note59@hotmail.com', 'POSSS', 'Comentario en caja', '2016-07-07', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fletes_compra`
--

CREATE TABLE IF NOT EXISTS `fletes_compra` (
  `id_flete_compra` int(11) NOT NULL AUTO_INCREMENT,
  `Lugar` varchar(50) NOT NULL,
  `longitud` varchar(15) NOT NULL,
  `latitud` varchar(15) NOT NULL,
  `fecha_flete` date NOT NULL,
  `Tara` double NOT NULL,
  `Destara` double NOT NULL,
  `Total_Kg` double NOT NULL,
  `Precio_Acordado` double NOT NULL,
  `id_orden_compra_flete` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  PRIMARY KEY (`id_flete_compra`),
  KEY `id_orden_compra_flete` (`id_orden_compra_flete`),
  KEY `id_material` (`id_material`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formularios_recoleccion`
--

CREATE TABLE IF NOT EXISTS `formularios_recoleccion` (
  `id_form` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecha_form` date NOT NULL,
  `longitud` varchar(20) NOT NULL,
  `latitud` varchar(20) NOT NULL,
  `comentarios` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `estatus` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id_form`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Volcado de datos para la tabla `formularios_recoleccion`
--

INSERT INTO `formularios_recoleccion` (`id_form`, `id_usuario`, `nombre`, `fecha_form`, `longitud`, `latitud`, `comentarios`, `telefono`, `estatus`, `estado`) VALUES
(51, 1, 'anonimous', '2016-07-07', '-102.052022695716', '19.408381064744464', 'ssssssssssssssssssssssssssss', '4521011057', 0, 1),
(56, 1, 'Jorge Frias', '2016-07-08', '-102.052022695716', '19.408381064744464', 'ttttttttttttt', '452101057', 1, 1),
(57, 1, 'Jorge Frias', '2016-07-08', '-102.052022695716', '19.408381064744464', 'caja comentario op', '452101057', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_compra`
--

CREATE TABLE IF NOT EXISTS `item_compra` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `TotalKg` double NOT NULL,
  `Id_material` int(11) NOT NULL,
  `Precio_kg_compra` double NOT NULL,
  `id_orden` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id_item`),
  KEY `Id_material` (`Id_material`),
  KEY `id_orden` (`id_orden`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_venta`
--

CREATE TABLE IF NOT EXISTS `item_venta` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT,
  `totalkg` int(11) NOT NULL,
  `precio_kg_venta` double NOT NULL,
  `id_material` int(11) NOT NULL,
  `id_orden` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id_venta`),
  KEY `id_orden` (`id_orden`),
  KEY `id_material` (`id_material`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales_desecho`
--

CREATE TABLE IF NOT EXISTS `materiales_desecho` (
  `id_material` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_material` varchar(40) NOT NULL,
  `precio_kg_compra` double NOT NULL,
  `precio_kg_venta` double NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id_material`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales_reciclaje`
--

CREATE TABLE IF NOT EXISTS `materiales_reciclaje` (
  `id_material` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_material` varchar(40) NOT NULL,
  `precio_kg_venta` double NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id_material`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_compra_flete`
--

CREATE TABLE IF NOT EXISTS `ordenes_compra_flete` (
  `Id_orden_compra_flete` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `total_pagar` double NOT NULL,
  PRIMARY KEY (`Id_orden_compra_flete`),
  KEY `id_proveedor` (`id_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_compra_normal`
--

CREATE TABLE IF NOT EXISTS `ordenes_compra_normal` (
  `id_orden` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_orden`),
  KEY `id_proveedor` (`id_proveedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_venta_normal`
--

CREATE TABLE IF NOT EXISTS `ordenes_venta_normal` (
  `id_orden` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id_orden`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procendias_proveedor`
--

CREATE TABLE IF NOT EXISTS `procendias_proveedor` (
  `id_tipo_procedencia` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_procedencia` varchar(20) NOT NULL,
  PRIMARY KEY (`id_tipo_procedencia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `procendias_proveedor`
--

INSERT INTO `procendias_proveedor` (`id_tipo_procedencia`, `tipo_procedencia`) VALUES
(1, 'Local'),
(2, 'Foraneo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_proveedor` varchar(50) NOT NULL,
  `fecha_registro` date NOT NULL,
  `Id_tipo_procedencia` int(11) NOT NULL,
  `RFC` varchar(20) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `nickname` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `url_image` varchar(150) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id_proveedor`),
  KEY `Id_tipo_procedencia` (`Id_tipo_procedencia`),
  KEY `id_tipo` (`id_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre_proveedor`, `fecha_registro`, `Id_tipo_procedencia`, `RFC`, `telefono`, `email`, `direccion`, `id_tipo`, `nickname`, `password`, `url_image`, `estado`) VALUES
(1, 'Publico General', '2016-07-08', 1, 'XAXX010101000', 'Sin numero', 'no@email.com', 'anonimo', 1, 'NickProvvedor', 'KYGFYU543', 'http://goo.gl/S46hJ0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE IF NOT EXISTS `tipos` (
  `Id_Tipo` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`Id_Tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`Id_Tipo`, `Tipo`) VALUES
(1, 'Comercial'),
(2, 'Industrial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE IF NOT EXISTS `trabajadores` (
  `id_Trabajador` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_trabajador` varchar(60) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Telefono` varchar(10) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `domicilio` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id_Trabajador`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=91 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_Usuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY KEY',
  `nombre` varchar(45) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `nickname` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `fecha_Registro` date NOT NULL,
  `url_image` varchar(150) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_Usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Tabla que lamacena a los usaurios del sitio' AUTO_INCREMENT=67 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_Usuario`, `nombre`, `telefono`, `email`, `nickname`, `password`, `fecha_Registro`, `url_image`, `estado`) VALUES
(1, 'anonimo', '00000000', 'anonimo@anonimo.com', 'LKJHGFTGGG', '3622157891', '0000-00-00', NULL, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`Id_Tipo`) REFERENCES `tipos` (`Id_Tipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `fletes_compra`
--
ALTER TABLE `fletes_compra`
  ADD CONSTRAINT `fletes_compra_ibfk_1` FOREIGN KEY (`id_orden_compra_flete`) REFERENCES `ordenes_compra_flete` (`Id_orden_compra_flete`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fletes_compra_ibfk_2` FOREIGN KEY (`id_material`) REFERENCES `materiales_desecho` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `formularios_recoleccion`
--
ALTER TABLE `formularios_recoleccion`
  ADD CONSTRAINT `formularios_recoleccion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `item_compra`
--
ALTER TABLE `item_compra`
  ADD CONSTRAINT `item_compra_ibfk_1` FOREIGN KEY (`Id_material`) REFERENCES `materiales_desecho` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_compra_ibfk_2` FOREIGN KEY (`id_orden`) REFERENCES `ordenes_compra_normal` (`id_orden`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `item_venta`
--
ALTER TABLE `item_venta`
  ADD CONSTRAINT `item_venta_ibfk_2` FOREIGN KEY (`id_material`) REFERENCES `materiales_reciclaje` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_venta_ibfk_1` FOREIGN KEY (`id_orden`) REFERENCES `ordenes_venta_normal` (`id_orden`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ordenes_compra_flete`
--
ALTER TABLE `ordenes_compra_flete`
  ADD CONSTRAINT `ordenes_compra_flete_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ordenes_venta_normal`
--
ALTER TABLE `ordenes_venta_normal`
  ADD CONSTRAINT `ordenes_venta_normal_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`Id_Cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `proveedores_ibfk_1` FOREIGN KEY (`Id_tipo_procedencia`) REFERENCES `procendias_proveedor` (`id_tipo_procedencia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proveedores_ibfk_2` FOREIGN KEY (`id_tipo`) REFERENCES `tipos` (`Id_Tipo`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
