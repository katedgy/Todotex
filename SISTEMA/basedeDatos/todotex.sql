-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-01-2015 a las 02:56:53
-- Versión del servidor: 5.6.14
-- Versión de PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `todotex`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `idcategoria` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idcategoria`, `nombre`) VALUES
(1, 'Botas'),
(2, 'Telas'),
(3, 'Camisas'),
(4, 'Cintas'),
(5, 'Uniformes'),
(6, 'Jeans'),
(7, 'Paraguas'),
(8, 'Toallas'),
(9, 'Chemises'),
(10, 'Franelas'),
(11, 'Bolsos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `rif` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `direc` varchar(160) COLLATE utf8_spanish_ci NOT NULL,
  `tlf` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nombre`, `rif`, `direc`, `tlf`, `email`) VALUES
(1, 'Clariant,S.A.', 'J-00046078-7', 'Av. Anton phillips, Edif. Clariant, Zona Industrial San Vicente I. Maracat, Edo. Aragua. Aptado. 34.', '(0243) 5503259', NULL),
(2, 'Caprolim,C.A.', 'J-31010422-0', 'Av. Ppal. El Castano, C.C. El Castano, P.B. Local 4. Maracay, Edo-Aragua.', '(0243)9355332', NULL),
(4, 'Lavelaca,C.A.', 'J-30064771-4', 'Av.6ta Edif.La Caridad. Piso 2. Ofic 2. Urb.La Soledad, Maracay, Edo. Aragua.', '(0246) 4157151', NULL),
(5, 'C.A. Laboratorios Asociados', 'J-00040654-5', 'Av.Anton Phillips, Zona Industroal "La Hamaca", Manzana 1, #8. Maracay, Edo. Aragua 2104.', '(0243) 5517078', NULL),
(6, 'Distribuidora de Repuestos Mi Jeep, C.A.', 'J-31569305-4', 'Av.Los Cedros, N°41, frente a Ceramihogar. Maracay, Edo. Aragua.', '(0243) 2470086', NULL),
(7, 'Servicios de Corrugados Maracay, C.A.', 'J-30557376-0', 'Av.Isaías Medina Angarita, Zona Industrial Corinsa Oeste, N°116-08-01, Cagua, Edo. Aragua.', '(0244) 4001300', NULL),
(8, 'Alimentos La Caridad, C.A.', 'J-07538734-1', 'Zona Industrial Los Tanques Parcela 5 y 6, Villa de Cura.', '(0244) 3889751', NULL),
(9, 'Pollos La Caridad', 'J-07527106-8', 'Av.6ta, Edificio La Caridad,Urb.La Soledad, Maracay, Edo. Aragua', '(0243) 3954768', NULL),
(10, 'Edgylin', 'J-22286681-7', 'Hipodromo', '3454256789', NULL),
(13, 'Juan, C.A.', 'J-59865423-8', 'Valencia', '0256-9865236', NULL),
(26, 'Gralaca', 'J-29456458-6', 'Urb. La Soledad Piso 1, ofic. 1.Maracay', '0244400006', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotdetalle`
--

CREATE TABLE IF NOT EXISTS `cotdetalle` (
  `idcotdetalle` int(11) NOT NULL AUTO_INCREMENT,
  `idcotemp` int(11) NOT NULL,
  `idproducto` int(5) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `idtalla` int(10) NOT NULL,
  `totalP` double(10,2) NOT NULL,
  PRIMARY KEY (`idcotdetalle`),
  KEY `idcotemp` (`idcotemp`),
  KEY `idproducto` (`idproducto`),
  KEY `idtalla` (`idtalla`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `cotdetalle`
--

INSERT INTO `cotdetalle` (`idcotdetalle`, `idcotemp`, `idproducto`, `cantidad`, `idtalla`, `totalP`) VALUES
(5, 2, 27, 9, 4, 5220.00),
(6, 2, 27, 12, 5, 6960.00),
(7, 2, 3, 90, 35, 31500.00),
(8, 2, 12, 8, 35, 5600.00),
(10, 3, 16, 6, 4, 3900.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotemp`
--

CREATE TABLE IF NOT EXISTS `cotemp` (
  `idcotemp` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idcotemp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `cotemp`
--

INSERT INTO `cotemp` (`idcotemp`) VALUES
(1),
(2),
(3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE IF NOT EXISTS `cotizacion` (
  `idcot` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) NOT NULL,
  `att` varchar(90) DEFAULT NULL,
  `fecha` date NOT NULL,
  `monto` double(10,2) NOT NULL,
  `iva` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL,
  `iduser` int(11) NOT NULL,
  PRIMARY KEY (`idcot`),
  KEY `idcliente` (`idcliente`),
  KEY `iduser` (`iduser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`idcot`, `idcliente`, `att`, `fecha`, `monto`, `iva`, `total`, `iduser`) VALUES
(2, 1, 'Srta. Veronica', '2015-01-12', 49280.00, 5913.60, 55193.60, 1),
(3, 2, 'Srta. Veronica', '2015-01-16', 3900.00, 468.00, 4368.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factemp`
--

CREATE TABLE IF NOT EXISTS `factemp` (
  `idfactemp` int(11) NOT NULL AUTO_INCREMENT,
  `idtipo` int(3) NOT NULL,
  PRIMARY KEY (`idfactemp`),
  KEY `idtipo` (`idtipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `factemp`
--

INSERT INTO `factemp` (`idfactemp`, `idtipo`) VALUES
(1, 1),
(2, 1),
(3, 1),
(5, 1),
(6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE IF NOT EXISTS `factura` (
  `idfactura` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) NOT NULL,
  `idtipo` int(3) NOT NULL,
  `Norden` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date NOT NULL,
  `idstatus` int(3) NOT NULL,
  `monto` double(10,2) NOT NULL,
  `iva` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL,
  `anulada` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `iduser` int(11) NOT NULL,
  PRIMARY KEY (`idfactura`),
  KEY `idcliente` (`idcliente`),
  KEY `idstatus` (`idstatus`),
  KEY `idtipo` (`idtipo`),
  KEY `iduser` (`iduser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idfactura`, `idcliente`, `idtipo`, `Norden`, `fecha`, `idstatus`, `monto`, `iva`, `total`, `anulada`, `iduser`) VALUES
(1, 2, 1, '123', '2015-01-09', 1, 8420.00, 1010.40, 9430.40, 'no', 1),
(2, 8, 1, '189633', '2015-01-12', 2, 11200.00, 1344.00, 12544.00, 'no', 1),
(3, 7, 1, 'No aplica', '2015-01-13', 1, 4500.00, 540.00, 5040.00, 'no', 1),
(5, 10, 1, 'No aplica', '2015-01-14', 2, 1250.00, 150.00, 1400.00, 'no', 1),
(6, 26, 1, 'No aplica', '2015-01-21', 2, 2100.00, 252.00, 2352.00, 'no', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturadetalle`
--

CREATE TABLE IF NOT EXISTS `facturadetalle` (
  `idfacturadetalle` int(11) NOT NULL AUTO_INCREMENT,
  `idfactemp` int(11) NOT NULL,
  `idproducto` int(5) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `talla` varchar(10) CHARACTER SET utf8 NOT NULL,
  `idtalla` int(10) DEFAULT NULL,
  `totalP` double(10,2) NOT NULL,
  PRIMARY KEY (`idfacturadetalle`),
  KEY `facturadetalle_ibfk_2` (`idproducto`),
  KEY `facturadetalle_ibfk_1` (`idfactemp`),
  KEY `idtalla` (`idtalla`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `facturadetalle`
--

INSERT INTO `facturadetalle` (`idfacturadetalle`, `idfactemp`, `idproducto`, `cantidad`, `talla`, `idtalla`, `totalP`) VALUES
(1, 1, 2, 8, 'No aplica', 35, 960.00),
(2, 1, 17, 2, 'No aplica', 35, 500.00),
(3, 3, 4, 10, 'No aplica', 35, 4500.00),
(5, 2, 12, 7, 'M', 4, 4900.00),
(6, 2, 12, 9, 'L', 5, 6300.00),
(19, 1, 27, 12, 'L', 5, 6960.00),
(21, 5, 1, 1, '40', 28, 1250.00),
(22, 6, 3, 6, 'No aplica', 35, 2100.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedetalle`
--

CREATE TABLE IF NOT EXISTS `pedetalle` (
  `idpedetalle` int(11) NOT NULL AUTO_INCREMENT,
  `idpedtemp` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `idtalla` int(11) NOT NULL,
  `totalP` int(11) NOT NULL,
  PRIMARY KEY (`idpedetalle`),
  KEY `idpedtemp` (`idpedtemp`),
  KEY `idproducto` (`idproducto`),
  KEY `idtalla` (`idtalla`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `pedetalle`
--

INSERT INTO `pedetalle` (`idpedetalle`, `idpedtemp`, `idproducto`, `cantidad`, `idtalla`, `totalP`) VALUES
(1, 1, 1, 8, 28, 10000),
(2, 1, 1, 15, 29, 18750),
(3, 1, 1, 20, 31, 25000),
(4, 2, 3, 9, 35, 3150),
(5, 3, 12, 90, 5, 63000),
(6, 3, 27, 9, 1, 5220),
(7, 3, 27, 90, 5, 52200),
(16, 1, 2, 8, 35, 960);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `idpedido` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) NOT NULL,
  `Norden` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `idstatus` int(3) NOT NULL,
  `monto` double(10,2) NOT NULL,
  `iva` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL,
  `anulada` varchar(10) NOT NULL,
  `iduser` int(11) NOT NULL,
  PRIMARY KEY (`idpedido`),
  KEY `idcliente` (`idcliente`),
  KEY `iduser` (`iduser`),
  KEY `idstatus` (`idstatus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idpedido`, `idcliente`, `Norden`, `fecha`, `idstatus`, `monto`, `iva`, `total`, `anulada`, `iduser`) VALUES
(1, 2, 'No aplica', '2015-01-09', 4, 54710.00, 6565.20, 61275.20, 'no', 1),
(2, 7, '1114', '2015-01-13', 3, 3150.00, 378.00, 3528.00, 'no', 1),
(3, 8, '1118', '2015-01-09', 3, 120420.00, 14450.40, 134870.40, 'si', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedtemp`
--

CREATE TABLE IF NOT EXISTS `pedtemp` (
  `idpedtemp` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idpedtemp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `pedtemp`
--

INSERT INTO `pedtemp` (`idpedtemp`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `idproducto` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `talla` int(10) DEFAULT NULL,
  `precio` varchar(10) NOT NULL,
  `stock` varchar(100) NOT NULL,
  `idcategoria` int(10) DEFAULT NULL,
  `idsubcategoria2` int(10) DEFAULT NULL,
  PRIMARY KEY (`idproducto`),
  KEY `idcategoria` (`idcategoria`),
  KEY `idsubcategoria` (`idsubcategoria2`),
  KEY `talla` (`talla`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproducto`, `nombre`, `talla`, `precio`, `stock`, `idcategoria`, `idsubcategoria2`) VALUES
(1, 'Botas de seguridad', 29, '1250', '4', 1, NULL),
(2, 'Cintas para embalar', 35, '120', '41', 4, NULL),
(3, 'Paraguas', 35, '350', '180', 7, NULL),
(4, 'Toallas', 35, '450', '1177', 8, NULL),
(5, 'Bordados', 35, '123', '54', 5, NULL),
(6, 'Estampados', 35, '50', '20', 5, NULL),
(12, 'Camisa tipo columbia', 3, '700', '2', 3, NULL),
(16, 'Camisa', 4, '650', '1442', 3, NULL),
(17, 'Cinta reflectiva', 35, '250', '4', 4, NULL),
(21, 'Telas', 35, '150', '20', 2, NULL),
(26, 'Bragas color verde', 5, '580', '30', 5, NULL),
(27, 'Blusa blanca', 4, '580', '108', 5, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE IF NOT EXISTS `proveedor` (
  `idproveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(90) NOT NULL,
  `rif` varchar(15) NOT NULL,
  `direc` varchar(150) NOT NULL,
  `tlf` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tipo` varchar(120) DEFAULT NULL,
  `idcategoria` int(10) DEFAULT NULL,
  PRIMARY KEY (`idproveedor`),
  KEY `idcategoria` (`idcategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idproveedor`, `nombre`, `rif`, `direc`, `tlf`, `email`, `tipo`, `idcategoria`) VALUES
(1, 'Bordados Colors,C.A.', 'J-12356789-0', 'Av. Fuerzas Aereas, Maracay, Aragua', '0243-6598978', NULL, 'Camisa tipo columbia', NULL),
(2, 'Grupo Jar, C.A.', 'J-25647896-3', 'Aragua', '0243-9989899', NULL, NULL, NULL),
(5, 'Daniel Estampados', 'J-12345678-9', 'La Coromoto', '(0243) 1234567', NULL, 'Estampados', NULL),
(7, 'Edgy', 'J-22286681-7', 'Hipodromo', '3454256789', NULL, 'Cinta reflectiva', NULL),
(9, 'Tramas', 'J-22286687', 'Valencia, Edo. Carabobo', '5698697', NULL, 'Telas', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `idstatus` int(10) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`idstatus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`idstatus`, `status`) VALUES
(1, 'pagada'),
(2, 'por pagar'),
(3, 'Pendiente'),
(4, 'Entregado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE IF NOT EXISTS `subcategorias` (
  `idsubcategoria` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`idsubcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tallas`
--

CREATE TABLE IF NOT EXISTS `tallas` (
  `idtalla` int(10) NOT NULL AUTO_INCREMENT,
  `talla` varchar(50) NOT NULL,
  PRIMARY KEY (`idtalla`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Volcado de datos para la tabla `tallas`
--

INSERT INTO `tallas` (`idtalla`, `talla`) VALUES
(1, 'SSS'),
(2, 'SS'),
(3, 'S'),
(4, 'M'),
(5, 'L'),
(6, 'XL'),
(7, 'XXL'),
(8, '3XL'),
(9, '4XL'),
(10, '5XL'),
(11, '2'),
(12, '4'),
(13, '6'),
(14, '8'),
(15, '10'),
(16, '12'),
(17, '14'),
(18, '16'),
(19, '28'),
(20, '30'),
(21, '32'),
(22, '34'),
(23, '35'),
(24, '36'),
(25, '37'),
(26, '38'),
(27, '39'),
(28, '40'),
(29, '42'),
(30, '43'),
(31, '44'),
(32, '45'),
(33, '46'),
(34, '47'),
(35, 'No aplica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

CREATE TABLE IF NOT EXISTS `tipodocumento` (
  `idtipo` int(5) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`idtipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tipodocumento`
--

INSERT INTO `tipodocumento` (`idtipo`, `tipo`) VALUES
(1, 'factura'),
(2, 'cotizacion'),
(3, 'orden');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `nivel` int(4) NOT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`iduser`, `nombre`, `clave`, `nivel`) VALUES
(1, 'admin', '123', 1),
(2, 'edgylin', '22286687', 2),
(3, 'orangel', '10457431', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cotdetalle`
--
ALTER TABLE `cotdetalle`
  ADD CONSTRAINT `cotdetalle_ibfk_1` FOREIGN KEY (`idcotemp`) REFERENCES `cotemp` (`idcotemp`),
  ADD CONSTRAINT `cotdetalle_ibfk_2` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`),
  ADD CONSTRAINT `cotdetalle_ibfk_3` FOREIGN KEY (`idtalla`) REFERENCES `tallas` (`idtalla`);

--
-- Filtros para la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD CONSTRAINT `cotizacion_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`),
  ADD CONSTRAINT `cotizacion_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`);

--
-- Filtros para la tabla `factemp`
--
ALTER TABLE `factemp`
  ADD CONSTRAINT `factemp_ibfk_1` FOREIGN KEY (`idtipo`) REFERENCES `tipodocumento` (`idtipo`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`idstatus`) REFERENCES `status` (`idstatus`),
  ADD CONSTRAINT `factura_ibfk_3` FOREIGN KEY (`idtipo`) REFERENCES `tipodocumento` (`idtipo`),
  ADD CONSTRAINT `factura_ibfk_4` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`);

--
-- Filtros para la tabla `facturadetalle`
--
ALTER TABLE `facturadetalle`
  ADD CONSTRAINT `facturadetalle_ibfk_1` FOREIGN KEY (`idfactemp`) REFERENCES `factemp` (`idfactemp`),
  ADD CONSTRAINT `facturadetalle_ibfk_2` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`),
  ADD CONSTRAINT `facturadetalle_ibfk_3` FOREIGN KEY (`idtalla`) REFERENCES `tallas` (`idtalla`);

--
-- Filtros para la tabla `pedetalle`
--
ALTER TABLE `pedetalle`
  ADD CONSTRAINT `pedetalle_ibfk_1` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`),
  ADD CONSTRAINT `pedetalle_ibfk_2` FOREIGN KEY (`idtalla`) REFERENCES `tallas` (`idtalla`),
  ADD CONSTRAINT `pedetalle_ibfk_3` FOREIGN KEY (`idpedtemp`) REFERENCES `pedtemp` (`idpedtemp`),
  ADD CONSTRAINT `pedetalle_ibfk_4` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`),
  ADD CONSTRAINT `pedetalle_ibfk_5` FOREIGN KEY (`idtalla`) REFERENCES `tallas` (`idtalla`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`),
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`),
  ADD CONSTRAINT `pedido_ibfk_4` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`),
  ADD CONSTRAINT `pedido_ibfk_5` FOREIGN KEY (`idstatus`) REFERENCES `status` (`idstatus`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`idcategoria`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`idsubcategoria2`) REFERENCES `subcategorias` (`idsubcategoria`),
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`talla`) REFERENCES `tallas` (`idtalla`);

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`idcategoria`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
