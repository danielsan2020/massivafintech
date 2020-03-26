-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2019 a las 06:08:57
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `massiva2019`
--
DROP DATABASE IF EXISTS `massiva2019`;
CREATE DATABASE IF NOT EXISTS `massiva2019` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `massiva2019`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activos`
--

DROP TABLE IF EXISTS `activos`;
CREATE TABLE `activos` (
  `id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `fecha_compra` date NOT NULL,
  `monto_compra_sin_impuestos` decimal(10,0) NOT NULL,
  `tipo` tinyint(4) NOT NULL COMMENT '1.-Terreno\n2.-Edificio\n3.-Mobiliario\n4.-Equipo de computo\n5.-Equipo de produccion',
  `descripcion` varchar(500) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1.- Activo',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `activos`:
--   `persona_id`
--       `personas` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blog_entradas`
--

DROP TABLE IF EXISTS `blog_entradas`;
CREATE TABLE `blog_entradas` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `url` varchar(45) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `blog_entradas`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_preguntas_frecuentes`
--

DROP TABLE IF EXISTS `categorias_preguntas_frecuentes`;
CREATE TABLE `categorias_preguntas_frecuentes` (
  `id` int(10) UNSIGNED NOT NULL,
  `categoria` varchar(245) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `categorias_preguntas_frecuentes`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cfdis`
--

DROP TABLE IF EXISTS `cfdis`;
CREATE TABLE `cfdis` (
  `id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `receptor_rfc` varchar(15) NOT NULL,
  `receptor_razon_social` varchar(255) NOT NULL,
  `emisor_rfc` varchar(15) NOT NULL,
  `emisor_razon_social` varchar(255) NOT NULL,
  `emitida_recibida` tinyint(4) NOT NULL COMMENT '1. emitida',
  `fecha_emision` datetime NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `cfdis`:
--   `persona_id`
--       `personas` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colonias`
--

DROP TABLE IF EXISTS `colonias`;
CREATE TABLE `colonias` (
  `id` int(10) UNSIGNED NOT NULL,
  `estado_id` int(10) UNSIGNED NOT NULL,
  `colonia` varchar(200) NOT NULL,
  `alcaldia_municipio` varchar(200) NOT NULL,
  `cp` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `colonias`:
--   `estado_id`
--       `estados` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_paquetes`
--

DROP TABLE IF EXISTS `compras_paquetes`;
CREATE TABLE `compras_paquetes` (
  `id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `paquete_id` int(10) UNSIGNED NOT NULL,
  `tipo_de_pago` tinyint(4) DEFAULT NULL COMMENT '1 tarjeta bancaria\n2 transferencia bancaria',
  `vigencia_inicio` date DEFAULT NULL,
  `vigencia_termino` date DEFAULT NULL,
  `openpay_pago_id` varchar(45) DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1 pagado\n2 en espera a ser pagado',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `compras_paquetes`:
--   `persona_id`
--       `personas` -> `id`
--   `paquete_id`
--       `paquetes` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_paquetes_tickets`
--

DROP TABLE IF EXISTS `compra_paquetes_tickets`;
CREATE TABLE `compra_paquetes_tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `paquete_tickets_id` int(10) UNSIGNED NOT NULL,
  `vigencia_inicio` date DEFAULT NULL,
  `vigencia_termino` date DEFAULT NULL,
  `openpay_pago_id` varchar(45) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `compra_paquetes_tickets`:
--   `paquete_tickets_id`
--       `paquetes_tickets` -> `id`
--   `persona_id`
--       `personas` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `declaraciones_mensuales`
--

DROP TABLE IF EXISTS `declaraciones_mensuales`;
CREATE TABLE `declaraciones_mensuales` (
  `id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `anio_correspondiente` smallint(5) UNSIGNED NOT NULL,
  `mes_correspondiente` tinyint(3) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '-1 - rechazada\n1 - requerida\n2 - vista\n3 - aceptada\n4 - realizada\n5 - requiere actualizacion',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `declaraciones_mensuales`:
--   `persona_id`
--       `personas` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `declaraciones_mensuales_atrasadas`
--

DROP TABLE IF EXISTS `declaraciones_mensuales_atrasadas`;
CREATE TABLE `declaraciones_mensuales_atrasadas` (
  `id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `mes_correspondiente` tinyint(3) UNSIGNED NOT NULL,
  `anio_correspondiente` smallint(5) UNSIGNED NOT NULL,
  `total` decimal(12,2) UNSIGNED NOT NULL,
  `a_favor_o_en_contra` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '-1 - rechazada\n1 - requerida\n2 - vista\n3 - aceptada\n4 - realizada\n5 - requiere actualizacion',
  `created_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `declaraciones_mensuales_atrasadas`:
--   `persona_id`
--       `personas` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias_credito`
--

DROP TABLE IF EXISTS `dias_credito`;
CREATE TABLE `dias_credito` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `dias_credito`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `divisiones_sat`
--

DROP TABLE IF EXISTS `divisiones_sat`;
CREATE TABLE `divisiones_sat` (
  `id` int(10) UNSIGNED NOT NULL,
  `clave` char(3) NOT NULL,
  `tipo` tinyint(4) NOT NULL COMMENT '1.- productos',
  `descripcion` varchar(500) NOT NULL,
  `iva` decimal(5,4) NOT NULL,
  `iva_retenido` decimal(5,4) NOT NULL,
  `isr_retenido` decimal(5,4) NOT NULL,
  `iva_texto` char(3) NOT NULL,
  `iva_retenido_texto` char(3) NOT NULL,
  `isr_retenido_texto` char(3) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1.-Activo\n-1 Inactivo\n',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `divisiones_sat`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_fiscales`
--

DROP TABLE IF EXISTS `documentos_fiscales`;
CREATE TABLE `documentos_fiscales` (
  `id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `tipo` tinyint(4) NOT NULL COMMENT '1.-key\n2.-cer\n3.-identificacion delantera\n4.-identificacion trasera',
  `extension` char(4) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `documentos_fiscales`:
--   `persona_id`
--       `personas` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilios_fiscales`
--

DROP TABLE IF EXISTS `domicilios_fiscales`;
CREATE TABLE `domicilios_fiscales` (
  `id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `colonia_id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `calle` varchar(245) NOT NULL,
  `numero_interior` varchar(20) DEFAULT NULL,
  `numero_exterior` varchar(20) DEFAULT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `domicilios_fiscales`:
--   `colonia_id`
--       `colonias` -> `id`
--   `persona_id`
--       `personas` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE `estados` (
  `id` int(10) UNSIGNED NOT NULL,
  `pais_id` int(10) UNSIGNED NOT NULL,
  `estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `estados`:
--   `pais_id`
--       `paises` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

DROP TABLE IF EXISTS `facturas`;
CREATE TABLE `facturas` (
  `id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `persona_cliente_id` int(10) UNSIGNED NOT NULL,
  `tipo_factura` char(1) NOT NULL COMMENT '(E) Egreso\n(I)Ingreso\n(N)Nómina\n(P)Pag',
  `uso_factura` char(3) NOT NULL COMMENT '(P01) Por definir\n(G01) adquisicion de mercancias\n(G02)Devoluciones, descuentos o bonificaciones\n(G03)Gastos en general\n(I01)Construcciones\n(I02)Mobiliario y equipo de oficina por inversiones\n(I03)Equipo de transporte\n(I04)Equipo de computo y accesorios \n',
  `forma_pago` char(2) NOT NULL COMMENT '01.-Efectivo\n02.-Cheque Nominativo\n03.-Transferencia electronica de fondos(incluye spei).\n04.-Tarjeta de credito\n05.-Monedero electronico.\n06.-Dinero electronico.\n12.-Donacion en pago\n13.-Pago por subrogación\n14.-Pago consignación\n15.-Codonacion\n17.-Com',
  `metodo_pago` char(3) NOT NULL COMMENT 'PPD Pago en parcialidades o diferido',
  `moneda` char(3) NOT NULL,
  `tipo_cambio` varchar(250) DEFAULT NULL,
  `serie` varchar(250) DEFAULT NULL,
  `folio` varchar(250) DEFAULT NULL,
  `condiciones_pago` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `facturas`:
--   `persona_id`
--       `personas` -> `id`
--   `persona_cliente_id`
--       `personas_clientes` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_productos`
--

DROP TABLE IF EXISTS `facturas_productos`;
CREATE TABLE `facturas_productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `factura_id` int(10) UNSIGNED NOT NULL,
  `persona_producto_id` int(10) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(12,4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `facturas_productos`:
--   `factura_id`
--       `facturas` -> `id`
--   `persona_producto_id`
--       `personas_productos` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_sat`
--

DROP TABLE IF EXISTS `grupos_sat`;
CREATE TABLE `grupos_sat` (
  `id` int(10) UNSIGNED NOT NULL,
  `division_sat_id` int(10) UNSIGNED NOT NULL,
  `clave` char(3) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `grupos_sat`:
--   `division_sat_id`
--       `divisiones_sat` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `tabla` varchar(245) NOT NULL,
  `tabla_id` longtext NOT NULL,
  `data` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `logs`:
--   `usuario_id`
--       `usuarios` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
CREATE TABLE `notificaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(3) NOT NULL,
  `texto` varchar(45) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `notificaciones`:
--   `usuario_id`
--       `usuarios` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

DROP TABLE IF EXISTS `paises`;
CREATE TABLE `paises` (
  `id` int(10) UNSIGNED NOT NULL,
  `pais` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `paises`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes`
--

DROP TABLE IF EXISTS `paquetes`;
CREATE TABLE `paquetes` (
  `id` int(10) UNSIGNED NOT NULL,
  `open_pay_id` varchar(45) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `periodo` tinyint(4) NOT NULL,
  `mostrar_en_principal` tinyint(4) NOT NULL COMMENT '1. S?',
  `descripcion` mediumtext NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `cfdis_al_mes` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `paquetes`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes_regimenes`
--

DROP TABLE IF EXISTS `paquetes_regimenes`;
CREATE TABLE `paquetes_regimenes` (
  `id` int(10) UNSIGNED NOT NULL,
  `regimen_fiscal_id` int(10) UNSIGNED NOT NULL,
  `paquete_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `paquetes_regimenes`:
--   `paquete_id`
--       `paquetes` -> `id`
--   `regimen_fiscal_id`
--       `regimenes_fiscales` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes_tickets`
--

DROP TABLE IF EXISTS `paquetes_tickets`;
CREATE TABLE `paquetes_tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `cantidad` tinyint(4) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `paquetes_tickets`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

DROP TABLE IF EXISTS `personas`;
CREATE TABLE `personas` (
  `id` int(10) UNSIGNED NOT NULL,
  `rfc` char(13) NOT NULL,
  `razon_social` tinytext NOT NULL,
  `tipo` tinyint(1) NOT NULL COMMENT '1 fisica',
  `curp` char(18) NOT NULL,
  `actividad` mediumtext NOT NULL,
  `cantidad_trabajadores` tinyint(4) NOT NULL,
  `contabilidad_atrasada` tinyint(4) NOT NULL,
  `tiene_efirma_vigente` tinyint(4) NOT NULL,
  `openpay_id` varchar(45) DEFAULT NULL,
  `efirma` varchar(250) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `personas`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_clientes`
--

DROP TABLE IF EXISTS `personas_clientes`;
CREATE TABLE `personas_clientes` (
  `id` int(10) UNSIGNED NOT NULL,
  `colonia_id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `nombre` tinytext NOT NULL,
  `razon_social` mediumtext NOT NULL,
  `rfc` varchar(13) NOT NULL,
  `calle` mediumtext NOT NULL,
  `numero_interior` varchar(20) DEFAULT NULL,
  `numero_exterior` varchar(20) DEFAULT NULL,
  `pais` varchar(45) DEFAULT NULL,
  `email` varchar(245) DEFAULT NULL,
  `tiene_logotipo` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `personas_clientes`:
--   `persona_id`
--       `personas` -> `id`
--   `colonia_id`
--       `colonias` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_clientes_contacto`
--

DROP TABLE IF EXISTS `personas_clientes_contacto`;
CREATE TABLE `personas_clientes_contacto` (
  `id` int(10) UNSIGNED NOT NULL,
  `persona_cliente_id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(245) DEFAULT NULL,
  `apellido_paterno` varchar(245) DEFAULT NULL,
  `apellido_materno` varchar(245) DEFAULT NULL,
  `departamento` varchar(245) DEFAULT NULL,
  `puesto` varchar(245) DEFAULT NULL,
  `telefono_1` char(15) DEFAULT NULL,
  `telefono_2` char(15) DEFAULT NULL,
  `celular_1` char(15) DEFAULT NULL,
  `celular_2` char(15) DEFAULT NULL,
  `email_1` varchar(245) DEFAULT NULL,
  `email_2` varchar(245) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `colonias_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `personas_clientes_contacto`:
--   `persona_cliente_id`
--       `personas_clientes` -> `id`
--   `colonias_id`
--       `colonias` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_contadores`
--

DROP TABLE IF EXISTS `personas_contadores`;
CREATE TABLE `personas_contadores` (
  `id` int(10) UNSIGNED NOT NULL,
  `contador_id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `personas_contadores`:
--   `persona_id`
--       `personas` -> `id`
--   `contador_id`
--       `usuarios` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_productos`
--

DROP TABLE IF EXISTS `personas_productos`;
CREATE TABLE `personas_productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `producto_sat_id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `unidad_medida_id` int(11) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `tipo` tinyint(2) NOT NULL COMMENT '1. producto terminado',
  `producto` varchar(250) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_compra` decimal(12,4) NOT NULL,
  `precio_venta` decimal(12,4) NOT NULL,
  `proveedor` varchar(250) NOT NULL,
  `tiene_foto_producto` tinyint(4) NOT NULL,
  `comentario` longtext DEFAULT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `personas_productos`:
--   `persona_id`
--       `personas` -> `id`
--   `producto_sat_id`
--       `productos_sat` -> `id`
--   `unidad_medida_id`
--       `unidades_medidas` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_proveedores`
--

DROP TABLE IF EXISTS `personas_proveedores`;
CREATE TABLE `personas_proveedores` (
  `id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `colonia_id` int(10) UNSIGNED NOT NULL,
  `dia_credito_id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `rfc` char(13) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pagina` varchar(100) DEFAULT NULL,
  `razon social` varchar(200) NOT NULL,
  `tipo` tinyint(4) NOT NULL COMMENT '1.-mercancias\n2.-servicios',
  `observaciones` varchar(200) NOT NULL,
  `tiene_logo` tinyint(4) NOT NULL COMMENT '-1 no lo tiene',
  `status` tinyint(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `personas_proveedores`:
--   `persona_id`
--       `personas` -> `id`
--   `colonia_id`
--       `colonias` -> `id`
--   `dia_credito_id`
--       `dias_credito` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_regimenes`
--

DROP TABLE IF EXISTS `personas_regimenes`;
CREATE TABLE `personas_regimenes` (
  `id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `regimen_fiscal_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `personas_regimenes`:
--   `persona_id`
--       `personas` -> `id`
--   `regimen_fiscal_id`
--       `regimenes_fiscales` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_servicios`
--

DROP TABLE IF EXISTS `personas_servicios`;
CREATE TABLE `personas_servicios` (
  `id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `personas_servicios`:
--   `persona_id`
--       `personas` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_frecuentes`
--

DROP TABLE IF EXISTS `preguntas_frecuentes`;
CREATE TABLE `preguntas_frecuentes` (
  `id` int(10) UNSIGNED NOT NULL,
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `pregunta` text NOT NULL,
  `respuesta` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `preguntas_frecuentes`:
--   `categoria_id`
--       `categorias_preguntas_frecuentes` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preregistros`
--

DROP TABLE IF EXISTS `preregistros`;
CREATE TABLE `preregistros` (
  `id` int(10) UNSIGNED NOT NULL,
  `rfc` char(13) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido_paterno` varchar(255) DEFAULT NULL,
  `apellido_materno` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `preregistros`:
--

--
-- Volcado de datos para la tabla `preregistros`
--

INSERT INTO `preregistros` (`id`, `rfc`, `username`, `email`, `telefono`, `nombre`, `apellido_paterno`, `apellido_materno`, `status`, `created_at`, `updated_at`) VALUES
(8, 'SATD780601K12', 'danielsanchez@gmail.com', 'danielsanchez@gmail.com', '', 'DANIEL', 'SANHE', '', 1, '2019-11-04 20:06:59', NULL),
(9, 'SATD780601K13', 'danielsancheztaza@gmail.com', 'danielsancheztaza@gmail.com', '5520890217', 'DANIEL', '', '', 1, '2019-11-04 22:06:24', NULL),
(10, 'SATD780601K14', 'prueba@prueba.com', 'prueba@prueba.com', '', 'PRUEBA', '', '', 1, '2019-11-04 22:07:35', NULL),
(11, 'SATD780601K15', 'qq@f.com', 'qq@f.com', '', 'D', '', '', 1, '2019-11-04 22:08:40', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_sat`
--

DROP TABLE IF EXISTS `productos_sat`;
CREATE TABLE `productos_sat` (
  `id` int(10) UNSIGNED NOT NULL,
  `grupo_sat_id` int(10) UNSIGNED NOT NULL,
  `clave` varchar(10) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `busquedas_similares` varchar(500) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `productos_sat`:
--   `grupo_sat_id`
--       `grupos_sat` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regimenes_fiscales`
--

DROP TABLE IF EXISTS `regimenes_fiscales`;
CREATE TABLE `regimenes_fiscales` (
  `id` int(10) UNSIGNED NOT NULL,
  `regimen` varchar(45) NOT NULL,
  `descripcion` text NOT NULL,
  `clave` char(3) NOT NULL,
  `tipo` tinyint(4) NOT NULL COMMENT '1.- Físic',
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `regimenes_fiscales`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_sat_cfdis`
--

DROP TABLE IF EXISTS `solicitudes_sat_cfdis`;
CREATE TABLE `solicitudes_sat_cfdis` (
  `id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `solicitud_sat_id` varchar(100) NOT NULL,
  `status` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `solicitudes_sat_cfdis`:
--   `persona_id`
--       `personas` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soporte_categorias`
--

DROP TABLE IF EXISTS `soporte_categorias`;
CREATE TABLE `soporte_categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `clave` varchar(45) NOT NULL,
  `tipo` tinyint(4) NOT NULL COMMENT '1.-Contable\n2.-Tecnico',
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `soporte_categorias`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soporte_comentarios`
--

DROP TABLE IF EXISTS `soporte_comentarios`;
CREATE TABLE `soporte_comentarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `soporte_ticket_id` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `tipo` tinyint(4) NOT NULL COMMENT '1.- texto.',
  `comentario` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `soporte_comentarios`:
--   `soporte_ticket_id`
--       `soporte_tickets` -> `id`
--   `usuario_id`
--       `usuarios` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soporte_evaluacion`
--

DROP TABLE IF EXISTS `soporte_evaluacion`;
CREATE TABLE `soporte_evaluacion` (
  `id` int(10) UNSIGNED NOT NULL,
  `soporte_ticket_id` int(10) UNSIGNED NOT NULL,
  `evaluacion` tinyint(4) NOT NULL COMMENT 'va hacer del 1 al 5 por medio de estrellas.',
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `soporte_evaluacion`:
--   `soporte_ticket_id`
--       `soporte_tickets` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soporte_tickets`
--

DROP TABLE IF EXISTS `soporte_tickets`;
CREATE TABLE `soporte_tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `soporte_categoria_id` int(10) UNSIGNED NOT NULL,
  `numero_ticket` varchar(20) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '-1 Cancelado\n1.- Abierto (Mientras el problema este abierto).\n2.- Cerrado(El problema se completo).\n3.-pendiente(El problema se bloquea).',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `soporte_tickets`:
--   `soporte_categoria_id`
--       `soporte_categorias` -> `id`
--   `persona_id`
--       `personas` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets_para_facturar`
--

DROP TABLE IF EXISTS `tickets_para_facturar`;
CREATE TABLE `tickets_para_facturar` (
  `id` int(10) UNSIGNED NOT NULL,
  `compra_paquete_tickets_id` int(10) UNSIGNED NOT NULL,
  `fecha_compra` date NOT NULL,
  `vigencia para facturar` date DEFAULT NULL,
  `descripcion` mediumtext DEFAULT NULL,
  `fecha_facturado` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1 Listo para facturar\n2 solicitado para facturar\n3 facturado\n4 vencido',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `tickets_para_facturar`:
--   `compra_paquete_tickets_id`
--       `compra_paquetes_tickets` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades_medidas`
--

DROP TABLE IF EXISTS `unidades_medidas`;
CREATE TABLE `unidades_medidas` (
  `id` int(11) NOT NULL,
  `unidad` varchar(60) NOT NULL,
  `clave_sat` char(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `unidades_medidas`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` char(32) NOT NULL,
  `tipo` tinyint(4) NOT NULL COMMENT '1.-Admin\n2.-Clientes',
  `email` varchar(255) NOT NULL,
  `telefono` char(10) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido_paterno` varchar(255) DEFAULT NULL,
  `apellido_materno` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `usuarios`:
--

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `tipo`, `email`, `telefono`, `nombre`, `apellido_paterno`, `apellido_materno`, `status`, `created_at`, `updated_at`) VALUES
(1, 'VETE940528V58', '202cb962ac59075b964b07152d234b70', 2, 'as', '12', 'asas', 'as', 'as', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_personas`
--

DROP TABLE IF EXISTS `usuarios_personas`;
CREATE TABLE `usuarios_personas` (
  `id` int(10) UNSIGNED NOT NULL,
  `persona_id` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `usuarios_personas`:
--   `persona_id`
--       `personas` -> `id`
--   `usuario_id`
--       `usuarios` -> `id`
--

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activos`
--
ALTER TABLE `activos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_activos_personas1_idx` (`persona_id`);

--
-- Indices de la tabla `blog_entradas`
--
ALTER TABLE `blog_entradas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indices de la tabla `categorias_preguntas_frecuentes`
--
ALTER TABLE `categorias_preguntas_frecuentes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indices de la tabla `cfdis`
--
ALTER TABLE `cfdis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_cfdis_personas1_idx` (`persona_id`);

--
-- Indices de la tabla `colonias`
--
ALTER TABLE `colonias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_colonias_estados1_idx` (`estado_id`);

--
-- Indices de la tabla `compras_paquetes`
--
ALTER TABLE `compras_paquetes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_compras_paquetes_paquetes1_idx` (`paquete_id`),
  ADD KEY `fk_compras_paquetes_clientes1_idx` (`persona_id`);

--
-- Indices de la tabla `compra_paquetes_tickets`
--
ALTER TABLE `compra_paquetes_tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_compra_paquetes_tickets_paquetes_tickets1_idx` (`paquete_tickets_id`),
  ADD KEY `fk_compra_paquetes_tickets_personas1_idx` (`persona_id`);

--
-- Indices de la tabla `declaraciones_mensuales`
--
ALTER TABLE `declaraciones_mensuales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_declaraciones_mensuales_personas1_idx` (`persona_id`);

--
-- Indices de la tabla `declaraciones_mensuales_atrasadas`
--
ALTER TABLE `declaraciones_mensuales_atrasadas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_declaraciones_mensuales_atrasadas_personas1_idx` (`persona_id`);

--
-- Indices de la tabla `dias_credito`
--
ALTER TABLE `dias_credito`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indices de la tabla `divisiones_sat`
--
ALTER TABLE `divisiones_sat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `division_UNIQUE` (`clave`);

--
-- Indices de la tabla `documentos_fiscales`
--
ALTER TABLE `documentos_fiscales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_documentos_fiscales_personas1_idx` (`persona_id`);

--
-- Indices de la tabla `domicilios_fiscales`
--
ALTER TABLE `domicilios_fiscales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_domicilios_fiscales_colonias1_idx` (`colonia_id`),
  ADD KEY `fk_domicilios_fiscales_personas1_idx` (`persona_id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_estados_paises1_idx` (`pais_id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_facturas_personas1_idx` (`persona_id`),
  ADD KEY `fk_facturas_personas_clientes1_idx` (`persona_cliente_id`);

--
-- Indices de la tabla `facturas_productos`
--
ALTER TABLE `facturas_productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_facturas_productos_facturas1_idx` (`factura_id`),
  ADD KEY `fk_facturas_productos_personas_productos1_idx` (`persona_producto_id`);

--
-- Indices de la tabla `grupos_sat`
--
ALTER TABLE `grupos_sat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_grupos_sat_divisiones_sat1_idx` (`division_sat_id`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_logs_usuarios1_idx` (`usuario_id`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notificaciones_usuarios1_idx` (`usuario_id`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indices de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idpaquetes_UNIQUE` (`id`);

--
-- Indices de la tabla `paquetes_regimenes`
--
ALTER TABLE `paquetes_regimenes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_paquetes_regimenes_regimenes_fiscales1_idx` (`regimen_fiscal_id`),
  ADD KEY `fk_paquetes_regimenes_paquetes1_idx` (`paquete_id`);

--
-- Indices de la tabla `paquetes_tickets`
--
ALTER TABLE `paquetes_tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `rfc_UNIQUE` (`rfc`);

--
-- Indices de la tabla `personas_clientes`
--
ALTER TABLE `personas_clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_clientes_clientes_clientes1_idx` (`persona_id`),
  ADD KEY `fk_clientes_clientes_colonias1_idx` (`colonia_id`);

--
-- Indices de la tabla `personas_clientes_contacto`
--
ALTER TABLE `personas_clientes_contacto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_clientes_clientes_contacto_clientes_clientes1_idx` (`persona_cliente_id`),
  ADD KEY `fk_personas_clientes_contacto_colonias1_idx` (`colonias_id`);

--
-- Indices de la tabla `personas_contadores`
--
ALTER TABLE `personas_contadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_clientes_contnadores_usuarios3_idx` (`contador_id`),
  ADD KEY `fk_clientes_contnadores_clientes1_idx` (`persona_id`);

--
-- Indices de la tabla `personas_productos`
--
ALTER TABLE `personas_productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `clave_UNIQUE` (`clave`),
  ADD KEY `fk_clientes_productos_clientes1_idx` (`persona_id`),
  ADD KEY `fk_personas_productos_productos_sat1_idx` (`producto_sat_id`),
  ADD KEY `fk_personas_productos_unidades_de_medida1_idx` (`unidad_medida_id`);

--
-- Indices de la tabla `personas_proveedores`
--
ALTER TABLE `personas_proveedores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_clientes_proveedores_colonias1_idx` (`colonia_id`),
  ADD KEY `fk_clientes_proveedores_clientes1_idx` (`persona_id`),
  ADD KEY `fk_clientes_proveedores_dias_credito1_idx` (`dia_credito_id`);

--
-- Indices de la tabla `personas_regimenes`
--
ALTER TABLE `personas_regimenes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_personas_regimenes_personas1_idx` (`persona_id`),
  ADD KEY `fk_personas_regimenes_regimenes_fiscales1_idx` (`regimen_fiscal_id`);

--
-- Indices de la tabla `personas_servicios`
--
ALTER TABLE `personas_servicios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_clientes_servicios_clientes1_idx` (`persona_id`);

--
-- Indices de la tabla `preguntas_frecuentes`
--
ALTER TABLE `preguntas_frecuentes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_preguntas_frecuentes_categorias_preguntas_frecuentes1_idx` (`categoria_id`);

--
-- Indices de la tabla `preregistros`
--
ALTER TABLE `preregistros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `rfc_UNIQUE` (`rfc`);

--
-- Indices de la tabla `productos_sat`
--
ALTER TABLE `productos_sat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `clave_UNIQUE` (`clave`),
  ADD KEY `fk_productos_sat_grupos_sat1_idx` (`grupo_sat_id`);

--
-- Indices de la tabla `regimenes_fiscales`
--
ALTER TABLE `regimenes_fiscales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `regimen_UNIQUE` (`regimen`);

--
-- Indices de la tabla `solicitudes_sat_cfdis`
--
ALTER TABLE `solicitudes_sat_cfdis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_solicitudes_sat_cfdis_personas1_idx` (`persona_id`);

--
-- Indices de la tabla `soporte_categorias`
--
ALTER TABLE `soporte_categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indices de la tabla `soporte_comentarios`
--
ALTER TABLE `soporte_comentarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_soporte_comentarios_soporte_tickets1_idx` (`soporte_ticket_id`),
  ADD KEY `fk_soporte_comentarios_usuarios1_idx` (`usuario_id`);

--
-- Indices de la tabla `soporte_evaluacion`
--
ALTER TABLE `soporte_evaluacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_soporte_evaluacion_soporte_tickets1_idx` (`soporte_ticket_id`);

--
-- Indices de la tabla `soporte_tickets`
--
ALTER TABLE `soporte_tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `numero_ticket_UNIQUE` (`numero_ticket`),
  ADD KEY `fk_tickets_soporte_clientes1_idx` (`persona_id`),
  ADD KEY `fk_soporte_tickets_soporte_categorias1_idx` (`soporte_categoria_id`);

--
-- Indices de la tabla `tickets_para_facturar`
--
ALTER TABLE `tickets_para_facturar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_tickets_para_facturar_compra_paquetes_tickets1_idx` (`compra_paquete_tickets_id`);

--
-- Indices de la tabla `unidades_medidas`
--
ALTER TABLE `unidades_medidas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `clave_sat_UNIQUE` (`clave_sat`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indices de la tabla `usuarios_personas`
--
ALTER TABLE `usuarios_personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_usuarios_cliente_clientes1_idx` (`persona_id`),
  ADD KEY `fk_usuarios_cliente_usuarios1_idx` (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activos`
--
ALTER TABLE `activos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `blog_entradas`
--
ALTER TABLE `blog_entradas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias_preguntas_frecuentes`
--
ALTER TABLE `categorias_preguntas_frecuentes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cfdis`
--
ALTER TABLE `cfdis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `colonias`
--
ALTER TABLE `colonias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compras_paquetes`
--
ALTER TABLE `compras_paquetes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra_paquetes_tickets`
--
ALTER TABLE `compra_paquetes_tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `declaraciones_mensuales`
--
ALTER TABLE `declaraciones_mensuales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `declaraciones_mensuales_atrasadas`
--
ALTER TABLE `declaraciones_mensuales_atrasadas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dias_credito`
--
ALTER TABLE `dias_credito`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `divisiones_sat`
--
ALTER TABLE `divisiones_sat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentos_fiscales`
--
ALTER TABLE `documentos_fiscales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `domicilios_fiscales`
--
ALTER TABLE `domicilios_fiscales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facturas_productos`
--
ALTER TABLE `facturas_productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupos_sat`
--
ALTER TABLE `grupos_sat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paquetes_regimenes`
--
ALTER TABLE `paquetes_regimenes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paquetes_tickets`
--
ALTER TABLE `paquetes_tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas_clientes`
--
ALTER TABLE `personas_clientes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas_clientes_contacto`
--
ALTER TABLE `personas_clientes_contacto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas_contadores`
--
ALTER TABLE `personas_contadores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas_productos`
--
ALTER TABLE `personas_productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas_proveedores`
--
ALTER TABLE `personas_proveedores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas_regimenes`
--
ALTER TABLE `personas_regimenes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas_servicios`
--
ALTER TABLE `personas_servicios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `preguntas_frecuentes`
--
ALTER TABLE `preguntas_frecuentes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `preregistros`
--
ALTER TABLE `preregistros`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `productos_sat`
--
ALTER TABLE `productos_sat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `regimenes_fiscales`
--
ALTER TABLE `regimenes_fiscales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitudes_sat_cfdis`
--
ALTER TABLE `solicitudes_sat_cfdis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `soporte_categorias`
--
ALTER TABLE `soporte_categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `soporte_comentarios`
--
ALTER TABLE `soporte_comentarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `soporte_evaluacion`
--
ALTER TABLE `soporte_evaluacion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `soporte_tickets`
--
ALTER TABLE `soporte_tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tickets_para_facturar`
--
ALTER TABLE `tickets_para_facturar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `unidades_medidas`
--
ALTER TABLE `unidades_medidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios_personas`
--
ALTER TABLE `usuarios_personas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activos`
--
ALTER TABLE `activos`
  ADD CONSTRAINT `fk_activos_personas1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cfdis`
--
ALTER TABLE `cfdis`
  ADD CONSTRAINT `fk_cfdis_personas1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `colonias`
--
ALTER TABLE `colonias`
  ADD CONSTRAINT `fk_colonias_estados1` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compras_paquetes`
--
ALTER TABLE `compras_paquetes`
  ADD CONSTRAINT `fk_compras_paquetes_clientes1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compras_paquetes_paquetes1` FOREIGN KEY (`paquete_id`) REFERENCES `paquetes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compra_paquetes_tickets`
--
ALTER TABLE `compra_paquetes_tickets`
  ADD CONSTRAINT `fk_compra_paquetes_tickets_paquetes_tickets1` FOREIGN KEY (`paquete_tickets_id`) REFERENCES `paquetes_tickets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compra_paquetes_tickets_personas1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `declaraciones_mensuales`
--
ALTER TABLE `declaraciones_mensuales`
  ADD CONSTRAINT `fk_declaraciones_mensuales_personas1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `declaraciones_mensuales_atrasadas`
--
ALTER TABLE `declaraciones_mensuales_atrasadas`
  ADD CONSTRAINT `fk_declaraciones_mensuales_atrasadas_personas1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `documentos_fiscales`
--
ALTER TABLE `documentos_fiscales`
  ADD CONSTRAINT `fk_documentos_fiscales_personas1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `domicilios_fiscales`
--
ALTER TABLE `domicilios_fiscales`
  ADD CONSTRAINT `fk_domicilios_fiscales_colonias1` FOREIGN KEY (`colonia_id`) REFERENCES `colonias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_domicilios_fiscales_personas1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `estados`
--
ALTER TABLE `estados`
  ADD CONSTRAINT `fk_estados_paises1` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `fk_facturas_personas1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_facturas_personas_clientes1` FOREIGN KEY (`persona_cliente_id`) REFERENCES `personas_clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `facturas_productos`
--
ALTER TABLE `facturas_productos`
  ADD CONSTRAINT `fk_facturas_productos_facturas1` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_facturas_productos_personas_productos1` FOREIGN KEY (`persona_producto_id`) REFERENCES `personas_productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grupos_sat`
--
ALTER TABLE `grupos_sat`
  ADD CONSTRAINT `fk_grupos_sat_divisiones_sat1` FOREIGN KEY (`division_sat_id`) REFERENCES `divisiones_sat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `fk_logs_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `fk_notificaciones_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `paquetes_regimenes`
--
ALTER TABLE `paquetes_regimenes`
  ADD CONSTRAINT `fk_paquetes_regimenes_paquetes1` FOREIGN KEY (`paquete_id`) REFERENCES `paquetes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_paquetes_regimenes_regimenes_fiscales1` FOREIGN KEY (`regimen_fiscal_id`) REFERENCES `regimenes_fiscales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `personas_clientes`
--
ALTER TABLE `personas_clientes`
  ADD CONSTRAINT `fk_clientes_clientes_clientes1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_clientes_clientes_colonias1` FOREIGN KEY (`colonia_id`) REFERENCES `colonias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `personas_clientes_contacto`
--
ALTER TABLE `personas_clientes_contacto`
  ADD CONSTRAINT `fk_clientes_clientes_contacto_clientes_clientes1` FOREIGN KEY (`persona_cliente_id`) REFERENCES `personas_clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personas_clientes_contacto_colonias1` FOREIGN KEY (`colonias_id`) REFERENCES `colonias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `personas_contadores`
--
ALTER TABLE `personas_contadores`
  ADD CONSTRAINT `fk_clientes_contnadores_clientes1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_clientes_contnadores_usuarios3` FOREIGN KEY (`contador_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `personas_productos`
--
ALTER TABLE `personas_productos`
  ADD CONSTRAINT `fk_clientes_productos_clientes1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personas_productos_productos_sat1` FOREIGN KEY (`producto_sat_id`) REFERENCES `productos_sat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personas_productos_unidades_de_medida1` FOREIGN KEY (`unidad_medida_id`) REFERENCES `unidades_medidas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `personas_proveedores`
--
ALTER TABLE `personas_proveedores`
  ADD CONSTRAINT `fk_clientes_proveedores_clientes1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_clientes_proveedores_colonias1` FOREIGN KEY (`colonia_id`) REFERENCES `colonias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_clientes_proveedores_dias_credito1` FOREIGN KEY (`dia_credito_id`) REFERENCES `dias_credito` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `personas_regimenes`
--
ALTER TABLE `personas_regimenes`
  ADD CONSTRAINT `fk_personas_regimenes_personas1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personas_regimenes_regimenes_fiscales1` FOREIGN KEY (`regimen_fiscal_id`) REFERENCES `regimenes_fiscales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `personas_servicios`
--
ALTER TABLE `personas_servicios`
  ADD CONSTRAINT `fk_clientes_servicios_clientes1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `preguntas_frecuentes`
--
ALTER TABLE `preguntas_frecuentes`
  ADD CONSTRAINT `fk_preguntas_frecuentes_categorias_preguntas_frecuentes1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias_preguntas_frecuentes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos_sat`
--
ALTER TABLE `productos_sat`
  ADD CONSTRAINT `fk_productos_sat_grupos_sat1` FOREIGN KEY (`grupo_sat_id`) REFERENCES `grupos_sat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `solicitudes_sat_cfdis`
--
ALTER TABLE `solicitudes_sat_cfdis`
  ADD CONSTRAINT `fk_solicitudes_sat_cfdis_personas1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `soporte_comentarios`
--
ALTER TABLE `soporte_comentarios`
  ADD CONSTRAINT `fk_soporte_comentarios_soporte_tickets1` FOREIGN KEY (`soporte_ticket_id`) REFERENCES `soporte_tickets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_soporte_comentarios_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `soporte_evaluacion`
--
ALTER TABLE `soporte_evaluacion`
  ADD CONSTRAINT `fk_soporte_evaluacion_soporte_tickets1` FOREIGN KEY (`soporte_ticket_id`) REFERENCES `soporte_tickets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `soporte_tickets`
--
ALTER TABLE `soporte_tickets`
  ADD CONSTRAINT `fk_soporte_tickets_soporte_categorias1` FOREIGN KEY (`soporte_categoria_id`) REFERENCES `soporte_categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tickets_soporte_clientes1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tickets_para_facturar`
--
ALTER TABLE `tickets_para_facturar`
  ADD CONSTRAINT `fk_tickets_para_facturar_compra_paquetes_tickets1` FOREIGN KEY (`compra_paquete_tickets_id`) REFERENCES `compra_paquetes_tickets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios_personas`
--
ALTER TABLE `usuarios_personas`
  ADD CONSTRAINT `fk_usuarios_cliente_clientes1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_cliente_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
