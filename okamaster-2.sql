-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-06-2022 a las 03:13:23
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `okamaster-2`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateOrden` (IN `documento` VARCHAR(20), IN `nombre` VARCHAR(50), IN `telefono` VARCHAR(20), IN `email` VARCHAR(50), IN `imei` VARCHAR(15), IN `imei2` VARCHAR(15), IN `id_marca` INT(11), IN `modelo` VARCHAR(35), IN `observacion` VARCHAR(150), IN `id_estado` INT(11), IN `id_tipo` INT(11), IN `motivo_entrada` VARCHAR(200), IN `contrasena` VARCHAR(100), IN `id_responsable` INT(11), IN `valor` VARCHAR(35), IN `abono` VARCHAR(35))  BEGIN
    DECLARE l_cliente_id INT DEFAULT 0;
    DECLARE l_equipo_id INT DEFAULT 0;
    
    START TRANSACTION;
    -- Insert cliente data
    INSERT INTO clientes(documento, nombre, telefono, email)
    VALUES(documento, nombre, telefono, email);
    
     -- Insert equipo data
    INSERT INTO equipo(imei, imei2, id_marca, modelo, observacion)
    VALUES(imei, imei2, id_marca, modelo, observacion);

    -- get cliente id
    SET l_cliente_id = LAST_INSERT_ID();
    
     -- get cliente id
    SET l_equipo_id = LAST_INSERT_ID();

    -- insert phone for the account
    IF l_cliente_id AND l_equipo_id > 0 THEN
	INSERT INTO orden(id_cliente, id_equipo, id_estado, id_tipo, motivo_entrada, contrasena, id_responsable, valor, abono) 
        VALUES(l_cliente_id, l_equipo_id, id_estado, id_tipo, motivo_entrada, contrasena, id_responsable, valor, abono);
        -- commit
        COMMIT;
     ELSE
	ROLLBACK;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ListarClientes` ()  NO SQL
BEGIN
select '' as detalles,
		id_cliente,
        documento,
        nombre,
        telefono,
        email,
        '' as opciones
        
FROM clientes ORDER BY id_cliente DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ListarEquipos` ()  NO SQL
BEGIN
select '' as detalles,
		e.id_equipo,
        e.imei,
        e.imei2,
        m.nombre,
        e.modelo,
        e.observacion,
        '' as opciones
        
FROM equipo e INNER JOIN marcas m on e.id_marca = m.id order by e.id_equipo DESC;    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ListarMarcas` ()  NO SQL
BEGIN
select '' as detalles,
		id,
        nombre,
        '' as opciones
        
FROM marcas ORDER BY id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ListarOrden` ()  NO SQL
BEGIN
select '' as detalles,
		o.id,
        o.fecha,
        c.documento,
        c.nombre,
        e.imei,
        e.modelo,
        s.nombre,
        t.nombre,
        o.motivo_entrada,
        o.contrasena,
        r.nombre,
        o.valor,
        o.abono,
        '' as opciones
        
FROM orden o 
INNER JOIN clientes c on o.id_cliente= c.id_cliente
INNER JOIN equipo e on o.id_equipo= e.id_equipo
INNER JOIN estado s on o.id_estado= s.id
INNER JOIN tipo t on o.id_tipo= t.id
INNER JOIN responsable r on o.id_responsable= r.id
order by o.id DESC;    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ObtenerDatosDashboard` ()  NO SQL
BEGIN
DECLARE totalOrden int;
DECLARE totalClientes int;
DECLARE totalEquipos int;
DECLARE totalMarcas int;

SET totalOrden = (SELECT COUNT(*) FROM orden o);
SET totalClientes = (SELECT COUNT(*) FROM clientes c);
SET totalEquipos = (SELECT COUNT(*) FROM equipo e);
SET totalMarcas = (SELECT COUNT(*) FROM marcas m);

SELECT IFNULL(totalOrden,0) AS  totalOrden,
	   IFNULL(totalClientes,0) AS totalClientes,
       IFNULL(totalEquipos,0) AS totalEquipos,
       IFNULL(totalMarcas,0) AS totalMarcas;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `documento` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `documento`, `nombre`, `telefono`, `email`) VALUES
(1, '1053877476', 'fabian gil', '3206620975', 'n/a'),
(2, '1054874843', 'luisa marin', '3117654419', 'n/a'),
(3, '1053987567', 'olga lucia', '3115223684', 'n/a'),
(4, '1053987234', 'edwin lopez', '3143553670', 'N/A'),
(5, '2443773478', 'jorge ruiz', '3128298014', 'n/a'),
(6, '1053789523', 'oscar moneda', '3105132166', 'n/a'),
(7, '1053876349', 'arles', '3209493950', 'n/a'),
(8, '1002635251', 'samuel pineda', '3145784718', 'n/a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id_equipo` int(11) NOT NULL,
  `imei` varchar(15) NOT NULL,
  `imei2` varchar(15) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `modelo` varchar(35) NOT NULL,
  `observacion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id_equipo`, `imei`, `imei2`, `id_marca`, `modelo`, `observacion`) VALUES
(1, '349865274398264', '', 1, 'S20-FE', 'n/a'),
(2, '359859831794673', '', 4, '6s', 'negro'),
(3, '850367280367428', '', 2, 'G6-PLAY', 'sin tapa'),
(4, '358926836749127', '', 1, 'A20S', 'N/A'),
(5, '359834781234349', '', 2, 'Y9-PRIME', 'azul'),
(6, '863478230956437', '', 5, 'Q6', 'Deja sim'),
(7, '369835872534986', '', 3, 'Note6-pro', 'fisurado'),
(8, '365847812894123', '13243422312211', 4, '13-pro', 'fisura en pantalla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `nombre`) VALUES
(1, 'Recibido'),
(2, 'Reparado'),
(3, 'Espera De Repuesto'),
(4, 'Devolucion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`) VALUES
(1, 'Samsung'),
(2, 'Huawei'),
(3, 'Xiaomi'),
(4, 'Iphone'),
(5, 'Lg.'),
(6, 'Ipro'),
(9, 'chino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `idmodulo` bigint(20) NOT NULL,
  `titulo` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idmodulo`, `titulo`, `descripcion`, `status`) VALUES
(1, 'Dashboard', 'Dashboard', 1),
(2, 'Usuarios', 'Usuarios Del Sistema', 1),
(3, 'Clientes', 'Clientes de okamaster', 1),
(4, 'Equipos', 'Equipos de okamaster', 1),
(5, 'Orden', 'Orden', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_cliente` int(11) NOT NULL,
  `id_equipo` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `motivo_entrada` varchar(200) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `id_responsable` int(11) NOT NULL,
  `valor` varchar(35) NOT NULL,
  `abono` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orden`
--

INSERT INTO `orden` (`id`, `fecha`, `id_cliente`, `id_equipo`, `id_estado`, `id_tipo`, `motivo_entrada`, `contrasena`, `id_responsable`, `valor`, `abono`) VALUES
(1, '2022-06-14 19:15:39', 1, 1, 1, 1, 'visor', '', 1, '150000', ''),
(2, '2022-06-14 19:25:11', 2, 2, 1, 1, 'visor + vidrio', '0000', 1, '80000', ''),
(3, '2022-06-17 12:29:53', 3, 3, 2, 1, 'apagado', 'm', 2, '40000', ''),
(4, '2022-06-17 21:20:03', 4, 4, 1, 1, 'visor + vidrio', 'z', 1, '100000', ''),
(5, '2022-06-17 12:30:45', 5, 5, 2, 1, 'camara frontal', 'L', 2, '80000', ''),
(6, '2022-06-17 00:35:14', 6, 6, 1, 2, 'logo', '', 2, '30000', ''),
(7, '2022-06-17 14:18:38', 7, 7, 1, 1, 'bateria', '4040', 2, '50000', '20000'),
(8, '2022-06-17 14:36:59', 8, 8, 1, 1, 'visor+vidrio', '123456', 1, '200000', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idpermiso` bigint(20) NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `moduloid` bigint(20) NOT NULL,
  `r` int(11) NOT NULL DEFAULT 0,
  `w` int(11) NOT NULL DEFAULT 0,
  `u` int(11) NOT NULL DEFAULT 0,
  `d` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idpermiso`, `rolid`, `moduloid`, `r`, `w`, `u`, `d`) VALUES
(212, 1, 1, 1, 1, 1, 1),
(213, 1, 2, 1, 1, 1, 1),
(214, 1, 3, 1, 1, 1, 1),
(215, 1, 4, 1, 1, 1, 1),
(216, 1, 5, 1, 1, 1, 1),
(222, 3, 1, 1, 0, 0, 0),
(223, 3, 2, 0, 0, 0, 0),
(224, 3, 3, 1, 1, 0, 0),
(225, 3, 4, 1, 1, 0, 0),
(226, 3, 5, 1, 1, 0, 0),
(247, 2, 1, 1, 1, 1, 1),
(248, 2, 2, 1, 1, 0, 0),
(249, 2, 3, 1, 1, 1, 1),
(250, 2, 4, 1, 1, 1, 1),
(251, 2, 5, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` bigint(20) NOT NULL,
  `identificacion` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nombres` varchar(80) COLLATE utf8mb4_swedish_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `email_user` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `password` varchar(75) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nit` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nombrefiscal` varchar(80) COLLATE utf8mb4_swedish_ci NOT NULL,
  `direccionfiscal` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `identificacion`, `nombres`, `apellidos`, `telefono`, `email_user`, `password`, `nit`, `nombrefiscal`, `direccionfiscal`, `token`, `rolid`, `datecreated`, `status`) VALUES
(1, '1053853490', 'Emanuel', 'Pineda', 3114372573, 'Emanuelpineda961030@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', '', '', '', 1, '2022-06-21 16:49:38', 1),
(2, '1002635251', 'Samuel', 'pineda', 3145784718, 'samuel@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', '', '', '', 2, '2022-06-21 19:08:58', 1),
(3, '1053987456', 'Juan', 'Arango', 3232762041, 'juan@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', '', '', '', 3, '2022-06-21 19:10:56', 1),
(4, '1053984612', 'Jose', 'Fernando', 3136348957, 'jose@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', '', '', '', 5, '2022-06-21 19:54:53', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsable`
--

CREATE TABLE `responsable` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `responsable`
--

INSERT INTO `responsable` (`id`, `nombre`) VALUES
(1, 'Emanuel'),
(2, 'Samuel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL,
  `nombrerol` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `nombrerol`, `descripcion`, `status`) VALUES
(1, 'Administrador', 'Acceso a todo el sistema', 1),
(2, 'Supervisor', 'Supervisor de tienda', 1),
(3, 'Servicio al cliente.', 'Servicio al cliente sistema.', 1),
(4, 'Cliente', 'Clientes tienda', 1),
(5, 'Bodega', 'Bodega', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `nombre`) VALUES
(1, 'Servicio Tecnico'),
(2, 'Software'),
(3, 'Garantia');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id_equipo`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`idmodulo`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_equipo` (`id_equipo`),
  ADD KEY `id_estado_idx` (`id_estado`),
  ADD KEY `id_tipo_idx` (`id_tipo`),
  ADD KEY `id_motivo_entrada _idx` (`motivo_entrada`),
  ADD KEY `id_responsable _idx` (`id_responsable`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idpermiso`),
  ADD KEY `rolid` (`rolid`),
  ADD KEY `moduloid` (`moduloid`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`),
  ADD KEY `rolid` (`rolid`);

--
-- Indices de la tabla `responsable`
--
ALTER TABLE `responsable`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `idmodulo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idpermiso` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de la tabla `responsable`
--
ALTER TABLE `responsable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `equipo_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden`
--
ALTER TABLE `orden`
  ADD CONSTRAINT `id_estado` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_responsable` FOREIGN KEY (`id_responsable`) REFERENCES `responsable` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_tipo` FOREIGN KEY (`id_tipo`) REFERENCES `tipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orden_ibfk_3` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `orden_ibfk_4` FOREIGN KEY (`id_equipo`) REFERENCES `equipo` (`id_equipo`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`moduloid`) REFERENCES `modulo` (`idmodulo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
