-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema massiva2019
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `massiva2019` ;

-- -----------------------------------------------------
-- Schema massiva2019
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `massiva2019` DEFAULT CHARACTER SET utf8 ;
USE `massiva2019` ;

-- -----------------------------------------------------
-- Table `massiva2019`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`usuarios` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`usuarios` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NOT NULL,
  `password` CHAR(32) NOT NULL,
  `tipo` TINYINT NOT NULL COMMENT '1.-Admin\n2.-Clientes\n3.-Jefe Contador\n4.-Contadores',
  `email` VARCHAR(255) NOT NULL,
  `telefono` CHAR(10) NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `apellido_paterno` VARCHAR(255) NULL,
  `apellido_materno` VARCHAR(255) NULL,
  `status` TINYINT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`contadores_y_equipos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`contadores_y_equipos` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`contadores_y_equipos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `jefe_id` INT UNSIGNED NOT NULL,
  `contador_id` INT UNSIGNED NOT NULL,
  `status` TINYINT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_contadores_y_equipos_usuarios_idx` (`jefe_id` ASC),
  INDEX `fk_contadores_y_equipos_usuarios1_idx` (`contador_id` ASC),
  CONSTRAINT `fk_contadores_y_equipos_usuarios`
    FOREIGN KEY (`jefe_id`)
    REFERENCES `massiva2019`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contadores_y_equipos_usuarios1`
    FOREIGN KEY (`contador_id`)
    REFERENCES `massiva2019`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`personas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`personas` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`personas` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `rfc` CHAR(13) NOT NULL,
  `razon_social` TINYTEXT NOT NULL,
  `tipo` TINYINT(1) NOT NULL COMMENT '1 fisica\n2 moral',
  `curp` CHAR(18) NOT NULL,
  `actividad` MEDIUMTEXT NOT NULL,
  `cantidad_trabajadores` TINYINT NOT NULL,
  `contabilidad_atrasada` TINYINT NOT NULL,
  `tiene_efirma` TINYINT NOT NULL,
  `efirma` VARCHAR(250) NULL,
  `status` TINYINT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `rfc_UNIQUE` (`rfc` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`personas_contadores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`personas_contadores` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`personas_contadores` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `jefe_id` INT UNSIGNED NOT NULL,
  `contador_id` INT UNSIGNED NOT NULL,
  `persona_id` INT UNSIGNED NOT NULL,
  `status` TINYINT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_clientes_contnadores_usuarios2_idx` (`jefe_id` ASC),
  INDEX `fk_clientes_contnadores_usuarios3_idx` (`contador_id` ASC),
  INDEX `fk_clientes_contnadores_clientes1_idx` (`persona_id` ASC),
  CONSTRAINT `fk_clientes_contnadores_usuarios2`
    FOREIGN KEY (`jefe_id`)
    REFERENCES `massiva2019`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_clientes_contnadores_usuarios3`
    FOREIGN KEY (`contador_id`)
    REFERENCES `massiva2019`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_clientes_contnadores_clientes1`
    FOREIGN KEY (`persona_id`)
    REFERENCES `massiva2019`.`personas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`usuarios_personas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`usuarios_personas` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`usuarios_personas` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `persona_id` INT UNSIGNED NOT NULL,
  `usuario_id` INT UNSIGNED NOT NULL,
  `status` TINYINT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_usuarios_cliente_clientes1_idx` (`persona_id` ASC),
  INDEX `fk_usuarios_cliente_usuarios1_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_usuarios_cliente_clientes1`
    FOREIGN KEY (`persona_id`)
    REFERENCES `massiva2019`.`personas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_cliente_usuarios1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `massiva2019`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`paquetes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`paquetes` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`paquetes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `open_pay_id` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(80) NOT NULL,
  `precio` DECIMAL(10,2) NOT NULL,
  `periodo` TINYINT NOT NULL,
  `descripcion` MEDIUMTEXT NOT NULL,
  `tipo` TINYINT NOT NULL,
  `cfdis_al_mes` INT NOT NULL,
  `status` TINYINT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `idpaquetes_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`compras_paquetes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`compras_paquetes` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`compras_paquetes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `persona_id` INT UNSIGNED NOT NULL,
  `paquete_id` INT UNSIGNED NOT NULL,
  `vigencia` DATE NOT NULL,
  `status` TINYINT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_compras_paquetes_paquetes1_idx` (`paquete_id` ASC),
  INDEX `fk_compras_paquetes_clientes1_idx` (`persona_id` ASC),
  CONSTRAINT `fk_compras_paquetes_paquetes1`
    FOREIGN KEY (`paquete_id`)
    REFERENCES `massiva2019`.`paquetes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_compras_paquetes_clientes1`
    FOREIGN KEY (`persona_id`)
    REFERENCES `massiva2019`.`personas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`paquetes_tickets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`paquetes_tickets` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`paquetes_tickets` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `cantidad` TINYINT NOT NULL,
  `precio` DECIMAL(8,2) NOT NULL,
  `status` TINYINT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`compra_paquetes_tickets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`compra_paquetes_tickets` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`compra_paquetes_tickets` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `persona_id` INT UNSIGNED NOT NULL,
  `paquete_tickets_id` INT UNSIGNED NOT NULL,
  `vigencia` DATE NOT NULL,
  `status` TINYINT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_compra_paquetes_tickets_paquetes_tickets1_idx` (`paquete_tickets_id` ASC),
  INDEX `fk_compra_paquetes_tickets_personas1_idx` (`persona_id` ASC),
  CONSTRAINT `fk_compra_paquetes_tickets_paquetes_tickets1`
    FOREIGN KEY (`paquete_tickets_id`)
    REFERENCES `massiva2019`.`paquetes_tickets` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_compra_paquetes_tickets_personas1`
    FOREIGN KEY (`persona_id`)
    REFERENCES `massiva2019`.`personas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`tickets_para_facturar`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`tickets_para_facturar` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`tickets_para_facturar` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `compra_paquete_tickets_id` INT UNSIGNED NOT NULL,
  `fecha_compra` DATE NOT NULL,
  `vigencia para facturar` DATE NULL,
  `descripcion` MEDIUMTEXT NULL,
  `fecha_facturado` DATE NULL,
  `status` TINYINT NOT NULL COMMENT '1 Listo para facturar\n2 solicitado para facturar\n3 facturado\n4 vencido\n5 error en los datos',
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_tickets_para_facturar_compra_paquetes_tickets1_idx` (`compra_paquete_tickets_id` ASC),
  CONSTRAINT `fk_tickets_para_facturar_compra_paquetes_tickets1`
    FOREIGN KEY (`compra_paquete_tickets_id`)
    REFERENCES `massiva2019`.`compra_paquetes_tickets` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`paises`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`paises` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`paises` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `pais` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`estados`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`estados` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`estados` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `pais_id` INT UNSIGNED NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_estados_paises1_idx` (`pais_id` ASC),
  CONSTRAINT `fk_estados_paises1`
    FOREIGN KEY (`pais_id`)
    REFERENCES `massiva2019`.`paises` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`colonias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`colonias` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`colonias` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `estado_id` INT UNSIGNED NOT NULL,
  `colonia` VARCHAR(200) NOT NULL,
  `alcaldia_municipio` VARCHAR(200) NOT NULL,
  `cp` CHAR(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_colonias_estados1_idx` (`estado_id` ASC),
  CONSTRAINT `fk_colonias_estados1`
    FOREIGN KEY (`estado_id`)
    REFERENCES `massiva2019`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`personas_clientes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`personas_clientes` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`personas_clientes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `colonia_id` INT UNSIGNED NOT NULL,
  `persona_id` INT UNSIGNED NOT NULL,
  `nombre` TINYTEXT NOT NULL,
  `razon_social` MEDIUMTEXT NOT NULL,
  `rfc` VARCHAR(13) NOT NULL,
  `direccion` MEDIUMTEXT NOT NULL,
  `numero_interior` VARCHAR(20) NULL,
  `pais` VARCHAR(45) NULL,
  `numero_exterior` VARCHAR(20) NULL,
  `colonia` VARCHAR(245) NULL,
  `codigo_postal` CHAR(5) NULL,
  `estado` VARCHAR(245) NULL,
  `ciudad` VARCHAR(245) NULL,
  `email` VARCHAR(245) NULL,
  `tiene_logotipo` TINYINT NOT NULL,
  `status` TINYINT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_clientes_clientes_clientes1_idx` (`persona_id` ASC),
  INDEX `fk_clientes_clientes_colonias1_idx` (`colonia_id` ASC),
  CONSTRAINT `fk_clientes_clientes_clientes1`
    FOREIGN KEY (`persona_id`)
    REFERENCES `massiva2019`.`personas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_clientes_clientes_colonias1`
    FOREIGN KEY (`colonia_id`)
    REFERENCES `massiva2019`.`colonias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`personas_clientes_contacto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`personas_clientes_contacto` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`personas_clientes_contacto` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `persona_cliente_id` INT UNSIGNED NOT NULL,
  `nombre` VARCHAR(245) NOT NULL,
  `apellido_paterno` VARCHAR(245) NOT NULL,
  `apellido_materno` VARCHAR(245) NOT NULL,
  `departamento` VARCHAR(245) NULL,
  `puesto` VARCHAR(245) NULL,
  `telefono_1` CHAR(15) NULL,
  `telefono_2` CHAR(15) NULL,
  `celular_1` CHAR(15) NULL,
  `celular_2` CHAR(15) NULL,
  `email_1` VARCHAR(245) NULL,
  `email_2` VARCHAR(245) NULL,
  `status` TINYINT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_clientes_clientes_contacto_clientes_clientes1_idx` (`persona_cliente_id` ASC),
  CONSTRAINT `fk_clientes_clientes_contacto_clientes_clientes1`
    FOREIGN KEY (`persona_cliente_id`)
    REFERENCES `massiva2019`.`personas_clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`logs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`logs` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`logs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` INT UNSIGNED NOT NULL,
  `tabla` VARCHAR(245) NOT NULL,
  `tabla_id` LONGTEXT NOT NULL,
  `data` DATETIME NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_logs_usuarios1_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_logs_usuarios1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `massiva2019`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`soporte_categorias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`soporte_categorias` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`soporte_categorias` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `categoria` VARCHAR(100) NOT NULL,
  `clave` VARCHAR(45) NOT NULL,
  `tipo` TINYINT NOT NULL COMMENT '1.-Contable\n2.-Tecnico\n',
  `status` TINYINT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`soporte_tickets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`soporte_tickets` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`soporte_tickets` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `persona_id` INT UNSIGNED NOT NULL,
  `soporte_categoria_id` INT UNSIGNED NOT NULL,
  `numero_ticket` VARCHAR(20) NOT NULL,
  `descripcion` VARCHAR(250) NOT NULL,
  `status` TINYINT NOT NULL COMMENT '-1 Cancelado\n1.- Abierto (Mientras el problema este abierto).\n2.- Cerrado(El problema se completo).\n3.-pendiente(El problema se bloquea).\n',
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `numero_ticket_UNIQUE` (`numero_ticket` ASC),
  INDEX `fk_tickets_soporte_clientes1_idx` (`persona_id` ASC),
  INDEX `fk_soporte_tickets_soporte_categorias1_idx` (`soporte_categoria_id` ASC),
  CONSTRAINT `fk_tickets_soporte_clientes1`
    FOREIGN KEY (`persona_id`)
    REFERENCES `massiva2019`.`personas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_soporte_tickets_soporte_categorias1`
    FOREIGN KEY (`soporte_categoria_id`)
    REFERENCES `massiva2019`.`soporte_categorias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`soporte_comentarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`soporte_comentarios` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`soporte_comentarios` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `soporte_ticket_id` INT UNSIGNED NOT NULL,
  `usuario_id` INT UNSIGNED NOT NULL,
  `tipo` TINYINT NOT NULL COMMENT '1.- texto.\n2.- archivo.',
  `comentario` TEXT NOT NULL,
  `status` TINYINT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_soporte_comentarios_soporte_tickets1_idx` (`soporte_ticket_id` ASC),
  INDEX `fk_soporte_comentarios_usuarios1_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_soporte_comentarios_soporte_tickets1`
    FOREIGN KEY (`soporte_ticket_id`)
    REFERENCES `massiva2019`.`soporte_tickets` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_soporte_comentarios_usuarios1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `massiva2019`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`soporte_evaluacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`soporte_evaluacion` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`soporte_evaluacion` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `soporte_ticket_id` INT UNSIGNED NOT NULL,
  `evaluacion` TINYINT NOT NULL COMMENT 'va hacer del 1 al 5 por medio de estrellas.',
  `status` TINYINT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_soporte_evaluacion_soporte_tickets1_idx` (`soporte_ticket_id` ASC),
  CONSTRAINT `fk_soporte_evaluacion_soporte_tickets1`
    FOREIGN KEY (`soporte_ticket_id`)
    REFERENCES `massiva2019`.`soporte_tickets` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`documentos_fiscales`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`documentos_fiscales` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`documentos_fiscales` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `persona_id` INT UNSIGNED NOT NULL,
  `nombre` VARCHAR(200) NOT NULL,
  `tipo` TINYINT NOT NULL COMMENT '1.-key\n2.-cer\n3.-identificacion delantera\n4.-identificacion trasera\n5.-comprobante domicilio',
  `extension` CHAR(4) NOT NULL,
  `status` TINYINT(2) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_documentos_fiscales_personas1_idx` (`persona_id` ASC),
  CONSTRAINT `fk_documentos_fiscales_personas1`
    FOREIGN KEY (`persona_id`)
    REFERENCES `massiva2019`.`personas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`dias_credito`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`dias_credito` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`dias_credito` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` TINYINT(2) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`personas_proveedores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`personas_proveedores` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`personas_proveedores` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `persona_id` INT UNSIGNED NOT NULL,
  `colonia_id` INT UNSIGNED NOT NULL,
  `dia_credito_id` INT UNSIGNED NOT NULL,
  `nombre` VARCHAR(200) NOT NULL,
  `rfc` CHAR(13) NOT NULL,
  `telefono` VARCHAR(15) NOT NULL,
  `email` VARCHAR(100) NULL,
  `pagina` VARCHAR(100) NULL,
  `razon social` VARCHAR(200) NOT NULL,
  `tipo` TINYINT NOT NULL COMMENT '1.-mercancias\n2.-servicios\n3.-gastos en general',
  `observaciones` VARCHAR(200) NOT NULL,
  `tiene_logo` TINYINT NOT NULL COMMENT '-1 no lo tiene\n1 lo tiene',
  `status` TINYINT(2) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_clientes_proveedores_colonias1_idx` (`colonia_id` ASC),
  INDEX `fk_clientes_proveedores_clientes1_idx` (`persona_id` ASC),
  INDEX `fk_clientes_proveedores_dias_credito1_idx` (`dia_credito_id` ASC),
  CONSTRAINT `fk_clientes_proveedores_colonias1`
    FOREIGN KEY (`colonia_id`)
    REFERENCES `massiva2019`.`colonias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_clientes_proveedores_clientes1`
    FOREIGN KEY (`persona_id`)
    REFERENCES `massiva2019`.`personas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_clientes_proveedores_dias_credito1`
    FOREIGN KEY (`dia_credito_id`)
    REFERENCES `massiva2019`.`dias_credito` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`personas_productos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`personas_productos` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`personas_productos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `persona_id` INT UNSIGNED NOT NULL,
  `status` TINYINT(2) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_clientes_productos_clientes1_idx` (`persona_id` ASC),
  CONSTRAINT `fk_clientes_productos_clientes1`
    FOREIGN KEY (`persona_id`)
    REFERENCES `massiva2019`.`personas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`personas_servicios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`personas_servicios` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`personas_servicios` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `persona_id` INT UNSIGNED NOT NULL,
  `status` TINYINT(2) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_clientes_servicios_clientes1_idx` (`persona_id` ASC),
  CONSTRAINT `fk_clientes_servicios_clientes1`
    FOREIGN KEY (`persona_id`)
    REFERENCES `massiva2019`.`personas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`categorias_preguntas_frecuentes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`categorias_preguntas_frecuentes` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`categorias_preguntas_frecuentes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `categoria` VARCHAR(245) NOT NULL,
  `status` TINYINT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`preguntas_frecuentes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`preguntas_frecuentes` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`preguntas_frecuentes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `categoria_id` INT UNSIGNED NOT NULL,
  `pregunta` TEXT NOT NULL,
  `respuesta` TEXT NOT NULL,
  `status` TINYINT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_preguntas_frecuentes_categorias_preguntas_frecuentes1_idx` (`categoria_id` ASC),
  CONSTRAINT `fk_preguntas_frecuentes_categorias_preguntas_frecuentes1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `massiva2019`.`categorias_preguntas_frecuentes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`domicilios_fiscales`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`domicilios_fiscales` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`domicilios_fiscales` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `persona_id` INT UNSIGNED NOT NULL,
  `colonia_id` INT UNSIGNED NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `calle` VARCHAR(245) NOT NULL,
  `numero_interior` VARCHAR(20) NULL,
  `numero_exterior` VARCHAR(20) NULL,
  `status` TINYINT(2) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_domicilios_fiscales_colonias1_idx` (`colonia_id` ASC),
  INDEX `fk_domicilios_fiscales_personas1_idx` (`persona_id` ASC),
  CONSTRAINT `fk_domicilios_fiscales_colonias1`
    FOREIGN KEY (`colonia_id`)
    REFERENCES `massiva2019`.`colonias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_domicilios_fiscales_personas1`
    FOREIGN KEY (`persona_id`)
    REFERENCES `massiva2019`.`personas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`blog_entradas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`blog_entradas` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`blog_entradas` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(255) NOT NULL,
  `url` VARCHAR(45) NOT NULL,
  `status` TINYINT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`preregistros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`preregistros` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`preregistros` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `rfc` CHAR(13) NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `telefono` VARCHAR(10) NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `apellido_paterno` VARCHAR(255) NULL,
  `apellido_materno` VARCHAR(255) NULL,
  `status` TINYINT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `rfc_UNIQUE` (`rfc` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`solicitudes_sat_cfdis`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`solicitudes_sat_cfdis` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`solicitudes_sat_cfdis` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `persona_id` INT UNSIGNED NOT NULL,
  `solicitud_sat_id` VARCHAR(100) NOT NULL,
  `status` VARCHAR(45) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_solicitudes_sat_cfdis_personas1_idx` (`persona_id` ASC),
  CONSTRAINT `fk_solicitudes_sat_cfdis_personas1`
    FOREIGN KEY (`persona_id`)
    REFERENCES `massiva2019`.`personas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `massiva2019`.`correos_enviados`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `massiva2019`.`correos_enviados` ;

CREATE TABLE IF NOT EXISTS `massiva2019`.`correos_enviados` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuarios_id` INT UNSIGNED NOT NULL,
  `administrador_id` INT UNSIGNED NOT NULL,
  `asunto` VARCHAR(145) NOT NULL,
  `mensaje` LONGTEXT NOT NULL,
  `status` TINYINT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_correos_enviados_usuarios1_idx` (`usuarios_id` ASC),
  INDEX `fk_correos_enviados_usuarios2_idx` (`administrador_id` ASC),
  CONSTRAINT `fk_correos_enviados_usuarios1`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `massiva2019`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_correos_enviados_usuarios2`
    FOREIGN KEY (`administrador_id`)
    REFERENCES `massiva2019`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `massiva2019`.`usuarios`
-- -----------------------------------------------------
START TRANSACTION;
USE `massiva2019`;
INSERT INTO `massiva2019`.`usuarios` (`id`, `username`, `password`, `tipo`, `email`, `telefono`, `nombre`, `apellido_paterno`, `apellido_materno`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'admin', '202cb962ac59075b964b07152d234b70', 1, 'union@union.com', '5', 'u', 'a', 'a', 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`usuarios` (`id`, `username`, `password`, `tipo`, `email`, `telefono`, `nombre`, `apellido_paterno`, `apellido_materno`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'clientes', '202cb962ac59075b964b07152d234b70', 2, 'clientes@clientes.com', '5', 'c', 'c', 'c', 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`usuarios` (`id`, `username`, `password`, `tipo`, `email`, `telefono`, `nombre`, `apellido_paterno`, `apellido_materno`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'jefe', '202cb962ac59075b964b07152d234b70', 3, 'jefe@jefe.com', '6', 'con', 'con', 'con', 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`usuarios` (`id`, `username`, `password`, `tipo`, `email`, `telefono`, `nombre`, `apellido_paterno`, `apellido_materno`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'contador', '202cb962ac59075b964b07152d234b70', 4, 'contador@contador1.com', '8', 'c', 'c', 'c', 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`usuarios` (`id`, `username`, `password`, `tipo`, `email`, `telefono`, `nombre`, `apellido_paterno`, `apellido_materno`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'jefe1', '202cb962ac59075b964b07152d234b70', 3, 'contador@contador2.com', '3', 'jefe2', 'jefe2', 'jefe2', 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`usuarios` (`id`, `username`, `password`, `tipo`, `email`, `telefono`, `nombre`, `apellido_paterno`, `apellido_materno`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'jefe2', '202cb962ac59075b964b07152d234b70', 3, 'contador@contador3.com', '3', 'jefe3', 'jefe3', 'jefe3', 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`usuarios` (`id`, `username`, `password`, `tipo`, `email`, `telefono`, `nombre`, `apellido_paterno`, `apellido_materno`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'contador2', '202cb962ac59075b964b07152d234b70', 4, 'contador@contador4.com', '5', 'contador2', 'contador2', 'contador2', 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`usuarios` (`id`, `username`, `password`, `tipo`, `email`, `telefono`, `nombre`, `apellido_paterno`, `apellido_materno`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'contador3', '202cb962ac59075b964b07152d234b70', 4, 'a@a.com', '8', 'contador3', 'contador3', 'contador3', 1, '2019-08-15', NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `massiva2019`.`personas`
-- -----------------------------------------------------
START TRANSACTION;
USE `massiva2019`;
INSERT INTO `massiva2019`.`personas` (`id`, `rfc`, `razon_social`, `tipo`, `curp`, `actividad`, `cantidad_trabajadores`, `contabilidad_atrasada`, `tiene_efirma`, `efirma`, `status`, `created_at`, `updated_at`) VALUES (1, 'RFC1', DEFAULT, 1, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, NULL, 1, DEFAULT, NULL);
INSERT INTO `massiva2019`.`personas` (`id`, `rfc`, `razon_social`, `tipo`, `curp`, `actividad`, `cantidad_trabajadores`, `contabilidad_atrasada`, `tiene_efirma`, `efirma`, `status`, `created_at`, `updated_at`) VALUES (2, 'RFC2', DEFAULT, 1, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, NULL, 1, DEFAULT, NULL);
INSERT INTO `massiva2019`.`personas` (`id`, `rfc`, `razon_social`, `tipo`, `curp`, `actividad`, `cantidad_trabajadores`, `contabilidad_atrasada`, `tiene_efirma`, `efirma`, `status`, `created_at`, `updated_at`) VALUES (3, 'RFC3', DEFAULT, 1, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, NULL, 1, DEFAULT, NULL);
INSERT INTO `massiva2019`.`personas` (`id`, `rfc`, `razon_social`, `tipo`, `curp`, `actividad`, `cantidad_trabajadores`, `contabilidad_atrasada`, `tiene_efirma`, `efirma`, `status`, `created_at`, `updated_at`) VALUES (4, 'RFC4', DEFAULT, 1, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, NULL, 1, DEFAULT, NULL);
INSERT INTO `massiva2019`.`personas` (`id`, `rfc`, `razon_social`, `tipo`, `curp`, `actividad`, `cantidad_trabajadores`, `contabilidad_atrasada`, `tiene_efirma`, `efirma`, `status`, `created_at`, `updated_at`) VALUES (5, 'RFC5', DEFAULT, 1, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, NULL, 1, DEFAULT, NULL);
INSERT INTO `massiva2019`.`personas` (`id`, `rfc`, `razon_social`, `tipo`, `curp`, `actividad`, `cantidad_trabajadores`, `contabilidad_atrasada`, `tiene_efirma`, `efirma`, `status`, `created_at`, `updated_at`) VALUES (6, 'RFC6', DEFAULT, 1, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, NULL, 1, DEFAULT, NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `massiva2019`.`paises`
-- -----------------------------------------------------
START TRANSACTION;
USE `massiva2019`;
INSERT INTO `massiva2019`.`paises` (`id`, `pais`) VALUES (DEFAULT, 'México');

COMMIT;


-- -----------------------------------------------------
-- Data for table `massiva2019`.`estados`
-- -----------------------------------------------------
START TRANSACTION;
USE `massiva2019`;
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Aguascalientes');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Baja California');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Baja California Sur');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Campeche');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Chiapas');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Chihuahua');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Ciudad de México');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Coahuila');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Colima');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Durango');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Estado de México');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Guanajuato');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Guerrero');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Hidalgo');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Jalisco');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Michoacán');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Morelos');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Nayarit');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Nuevo León');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Oaxaca');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Puebla');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Querétaro');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Quintana Roo');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'San Luis Potosí');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Sinaloa');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Sonora');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Tabasco');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Tamaulipas');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Tlaxcala');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Veracruz');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Yucatán');
INSERT INTO `massiva2019`.`estados` (`id`, `pais_id`, `estado`) VALUES (DEFAULT, 1, 'Zacatecas');

COMMIT;


-- -----------------------------------------------------
-- Data for table `massiva2019`.`colonias`
-- -----------------------------------------------------
START TRANSACTION;
USE `massiva2019`;
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1, 1, 'Zona Centro', 'Aguascalientes', '20000');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (2, 1, 'Ramon Romo Franco', 'Aguascalientes', '20010');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (3, 1, 'Colinas del Rio', 'Aguascalientes', '20010');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (4, 1, 'Las Brisas', 'Aguascalientes', '20010');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (5, 1, 'San Cayetano', 'Aguascalientes', '20010');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (6, 1, 'Olivares Santana', 'Aguascalientes', '20010');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (7, 1, 'La Fundición', 'Aguascalientes', '20016');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (8, 1, 'Los Sauces', 'Aguascalientes', '20016');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (9, 1, 'Fundici�n II', 'Aguascalientes', '20016');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (10, 1, 'Colinas de San Ignacio', 'Aguascalientes', '20016');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (11, 1, 'L�nea de Fuego', 'Aguascalientes', '20018');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (12, 1, 'Buenos Aires', 'Aguascalientes', '20020');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (13, 1, 'Las Arboledas', 'Aguascalientes', '20020');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (14, 1, 'Villas de San Francisco', 'Aguascalientes', '20020');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (15, 1, 'Circunvalaci�n Norte', 'Aguascalientes', '20020');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (16, 1, 'Villas de La Universidad', 'Aguascalientes', '20029');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (17, 1, 'El Sol', 'Aguascalientes', '20030');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (18, 1, 'Industrial', 'Aguascalientes', '20030');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (19, 1, 'Gremial', 'Aguascalientes', '20030');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (20, 1, 'Curtidores', 'Aguascalientes', '20040');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (21, 1, 'Altavista', 'Aguascalientes', '20040');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (22, 1, 'La Concordia', 'Aguascalientes', '20040');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (23, 1, 'Miravalle', 'Aguascalientes', '20040');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (24, 1, 'Panorama', 'Aguascalientes', '20040');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (25, 1, 'Colinas del Poniente', 'Aguascalientes', '20049');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (26, 1, 'La Fe', 'Aguascalientes', '20050');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (27, 1, 'M�xico', 'Aguascalientes', '20050');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (28, 1, 'Bugambilias', 'Aguascalientes', '20050');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (29, 1, 'San Pablo', 'Aguascalientes', '20050');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (30, 1, 'Del Carmen', 'Aguascalientes', '20050');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (31, 1, 'Primavera', 'Aguascalientes', '20050');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (32, 1, 'Guadalupe', 'Aguascalientes', '20059');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (33, 1, 'Heliodoro Garcia', 'Aguascalientes', '20059');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (34, 1, 'G�mez', 'Aguascalientes', '20060');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (35, 1, 'Moderno', 'Aguascalientes', '20060');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (36, 1, 'Valle del Rio San Pedro', 'Aguascalientes', '20064');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (37, 1, 'San Marcos', 'Aguascalientes', '20070');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (38, 1, 'San Marcos', 'Aguascalientes', '20070');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (39, 1, 'Guadalupe Posada', 'Aguascalientes', '20070');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (40, 1, 'San Marcos', 'Aguascalientes', '20078');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (41, 1, 'Modelo', 'Aguascalientes', '20080');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (42, 1, 'Residencial del Valle I', 'Aguascalientes', '20080');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (43, 1, 'Residencial del Valle II', 'Aguascalientes', '20089');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (44, 1, 'Los Vergeles', 'Aguascalientes', '20100');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (45, 1, 'La Herradura', 'Aguascalientes', '20100');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (46, 1, 'Campestre', 'Aguascalientes', '20100');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (47, 1, 'Rancho San Antonio', 'Aguascalientes', '20100');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (48, 1, 'Jardines del Campestre', 'Aguascalientes', '20100');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (49, 1, 'Club Campestre', 'Aguascalientes', '20100');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (50, 1, 'Valle del Campestre', 'Aguascalientes', '20110');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (51, 1, 'Las Cavas', 'Aguascalientes', '20110');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (52, 1, 'Granjas del Campestre', 'Aguascalientes', '20110');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (53, 1, 'La Enramada', 'Aguascalientes', '20110');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (54, 1, 'Puerto las Hadas', 'Aguascalientes', '20110');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (55, 1, 'Talamantes Ponce', 'Aguascalientes', '20110');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (56, 1, 'Villas de Montenegro', 'Aguascalientes', '20110');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (57, 1, 'Villa de las Trojes', 'Aguascalientes', '20115');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (58, 1, 'Trojes de Oriente', 'Aguascalientes', '20115');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (59, 1, 'Valle de Santa Teresa', 'Aguascalientes', '20115');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (60, 1, 'Valle de las Trojes', 'Aguascalientes', '20115');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (61, 1, 'San Telmo', 'Aguascalientes', '20115');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (62, 1, 'La Paloma', 'Aguascalientes', '20115');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (63, 1, 'Barrio de Santiago', 'Aguascalientes', '20115');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (64, 1, 'Villas de San Nicol�s', 'Aguascalientes', '20115');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (65, 1, 'La Troje', 'Aguascalientes', '20116');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (66, 1, 'Trojes de Alonso', 'Aguascalientes', '20116');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (67, 1, 'Santa Fe', 'Aguascalientes', '20116');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (68, 1, 'San Telmo Residencial', 'Aguascalientes', '20116');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (69, 1, 'Aguascalientes 2000', 'Aguascalientes', '20117');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (70, 1, 'Trojes del Sol', 'Aguascalientes', '20118');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (71, 1, 'Misi�n de Santiago', 'Aguascalientes', '20118');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (72, 1, 'Los Jarales', 'Aguascalientes', '20118');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (73, 1, 'Cerrada de la Mezquitera', 'Aguascalientes', '20118');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (74, 1, 'Valle del Campanario', 'Aguascalientes', '20118');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (75, 1, 'Las Misiones', 'Aguascalientes', '20118');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (76, 1, 'Cerrada El Molino', 'Aguascalientes', '20118');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (77, 1, 'Las Trojes', 'Aguascalientes', '20118');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (78, 1, 'Trojes de Cristal', 'Aguascalientes', '20118');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (79, 1, 'Cerrada de La Misi�n', 'Aguascalientes', '20118');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (80, 1, 'Valle Real', 'Aguascalientes', '20118');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (81, 1, 'Terzetto', 'Aguascalientes', '20118');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (82, 1, 'Misi�n del Campanario', 'Aguascalientes', '20118');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (83, 1, 'Cerrada del Valle', 'Aguascalientes', '20118');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (84, 1, 'Residencial Santa Clara', 'Aguascalientes', '20118');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (85, 1, 'Lomas del Campestre 2a Secci�n', 'Aguascalientes', '20119');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (86, 1, 'Villas del Campestre', 'Aguascalientes', '20119');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (87, 1, 'Los Calicantos', 'Aguascalientes', '20119');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (88, 1, 'Jardines de la Concepci�n', 'Aguascalientes', '20120');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (89, 1, 'Rinconada los Bosques', 'Aguascalientes', '20120');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (90, 1, 'Los Bosques', 'Aguascalientes', '20120');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (91, 1, 'Arroyo El Molino', 'Aguascalientes', '20123');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (92, 1, 'Residencial Altaria', 'Aguascalientes', '20124');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (93, 1, 'Galer�as', 'Aguascalientes', '20124');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (94, 1, 'Constituci�n', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (95, 1, 'Pozo Bravo Norte', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (96, 1, 'Villa de Nuestra Se�ora de La Asunci�n Sector Guadalupe', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (97, 1, 'Villa de Nuestra Se�ora de La Asunci�n Sector San Marcos', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (98, 1, 'Privada Guadalupe', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (99, 1, 'Rinconada del Puertecito', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (100, 1, 'Libertad', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (101, 1, 'El Puertecito', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (102, 1, 'Natura', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (103, 1, 'Rinconada Pozo Bravo', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (104, 1, 'Pozo Bravo Sur', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (105, 1, 'La Soledad', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (106, 1, 'Villa Teresa', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (107, 1, 'Villas del R�o', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (108, 1, 'Los Naranjos', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (109, 1, 'Cartagena 1947', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (110, 1, 'Jardines de Montebello', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (111, 1, 'Soberana Convenci�n Revolucionaria', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (112, 1, 'Villas de Don Antonio', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (113, 1, 'Los �ngeles', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (114, 1, 'El Rosedal', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (115, 1, 'Villa Loma Dorada', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (116, 1, 'Villa de Nuestra Se�ora de La Asunci�n Sector Estaci�n', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (117, 1, 'Residencial las Plazas', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (118, 1, 'Montebello Della Stanza', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (119, 1, 'Villa Monta�a', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (120, 1, 'Villas de La Convenci�n', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (121, 1, 'Lomas de La Asunci�n', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (122, 1, 'Villa de Nuestra Se�ora de La Asunci�n Sector Encino', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (123, 1, 'Villa de Nuestra Se�ora de La Asunci�n Sector Alameda', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (124, 1, 'San Jos� de Pozo Bravo', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (125, 1, 'Villa Notre Dame', 'Aguascalientes', '20126');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (126, 1, 'Bosques del Prado Norte', 'Aguascalientes', '20127');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (127, 1, 'Lomas del Campestre 1a Secci�n', 'Aguascalientes', '20129');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (128, 1, 'Residencial Campestre Club de Golf Norte', 'Aguascalientes', '20130');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (129, 1, 'Residencial Campestre Club de Golf Sur', 'Aguascalientes', '20130');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (130, 1, 'Palma Real', 'Aguascalientes', '20130');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (131, 1, 'Bosques del Prado Sur', 'Aguascalientes', '20130');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (132, 1, 'F�tima', 'Aguascalientes', '20130');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (133, 1, 'Primo Verdad', 'Aguascalientes', '20130');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (134, 1, 'Unidad Ganadera', 'Aguascalientes', '20130');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (135, 1, 'Independencia de M�xico', 'Aguascalientes', '20130');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (136, 1, 'Nueva Rinconada', 'Aguascalientes', '20130');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (137, 1, 'Puerta Navarra', 'Aguascalientes', '20130');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (138, 1, 'Palmas del Pedregal', 'Aguascalientes', '20130');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (139, 1, 'El Roble', 'Aguascalientes', '20130');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (140, 1, 'San Jos� del Arenal', 'Aguascalientes', '20130');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (141, 1, 'Centro Distribuidor de B�sicos', 'Aguascalientes', '20135');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (142, 1, 'Agropecuario', 'Aguascalientes', '20135');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (143, 1, 'La Rinconada', 'Aguascalientes', '20136');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (144, 1, 'El Plateado', 'Aguascalientes', '20137');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (145, 1, 'Villas del Vergel', 'Aguascalientes', '20138');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (146, 1, 'Residencial Pulgas Pandas Norte', 'Aguascalientes', '20138');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (147, 1, 'Cerrada San Miguel', 'Aguascalientes', '20138');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (148, 1, 'Residencial Pulgas Pandas Sur', 'Aguascalientes', '20138');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (149, 1, 'Andrea', 'Aguascalientes', '20140');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (150, 1, 'Morelos', 'Aguascalientes', '20140');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (151, 1, 'Las Hadas', 'Aguascalientes', '20140');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (152, 1, 'Los Arcos', 'Aguascalientes', '20146');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (153, 1, 'Industrial', 'Aguascalientes', '20149');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (154, 1, 'Lomas del Cobano', 'Aguascalientes', '20150');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (155, 1, 'Macias Arellano', 'Aguascalientes', '20150');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (156, 1, 'La Estrella', 'Aguascalientes', '20150');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (157, 1, 'Buenavista', 'Aguascalientes', '20150');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (158, 1, 'C.T.M.', 'Aguascalientes', '20150');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (159, 1, 'La Higuerilla', 'Aguascalientes', '20157');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (160, 1, 'Parras', 'Aguascalientes', '20157');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (161, 1, 'Trojes del Cobano', 'Aguascalientes', '20158');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (162, 1, 'El Cobano', 'Aguascalientes', '20158');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (163, 1, 'Villas del Cobano', 'Aguascalientes', '20158');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (164, 1, 'Hacienda el Cobano', 'Aguascalientes', '20158');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (165, 1, 'Alianza Ferrocarrilera', 'Aguascalientes', '20159');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (166, 1, 'Bosques del Prado Oriente', 'Aguascalientes', '20159');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (167, 1, 'Francisco Guel Jimenez', 'Aguascalientes', '20160');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (168, 1, 'Las Vi�as INFONAVIT', 'Aguascalientes', '20160');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (169, 1, 'Santa Anita 4a Secci�n', 'Aguascalientes', '20164');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (170, 1, 'Santa Anita 2a Secci�n', 'Aguascalientes', '20169');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (171, 1, 'Santa Anita', 'Aguascalientes', '20169');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (172, 1, 'S.T.E.M.A.', 'Aguascalientes', '20170');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (173, 1, 'El Maguey', 'Aguascalientes', '20170');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (174, 1, 'Las Cumbres', 'Aguascalientes', '20170');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (175, 1, 'Rodolfo Landeros Gallegos', 'Aguascalientes', '20170');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (176, 1, 'Zona Militar', 'Aguascalientes', '20170');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (177, 1, 'Lic Benito Ju�rez', 'Aguascalientes', '20170');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (178, 1, 'Villa Bonita', 'Aguascalientes', '20170');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (179, 1, 'Nazario Ortiz Garza', 'Aguascalientes', '20170');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (180, 1, 'Cumbres III', 'Aguascalientes', '20172');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (181, 1, 'Claustros Loma Dorada', 'Aguascalientes', '20172');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (182, 1, 'Lic Benito Palomino Dena', 'Aguascalientes', '20172');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (183, 1, 'Lomas de Bellavista', 'Aguascalientes', '20174');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (184, 1, 'Villas de la Loma', 'Aguascalientes', '20174');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (185, 1, 'Miradores de Santa Elena', 'Aguascalientes', '20174');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (186, 1, 'Vista de las Cumbres', 'Aguascalientes', '20174');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (187, 1, 'Paseos del Sol', 'Aguascalientes', '20174');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (188, 1, 'Villas de las Fuentes', 'Aguascalientes', '20174');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (189, 1, 'Los Laureles', 'Aguascalientes', '20174');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (190, 1, 'Colinas de Oriente', 'Aguascalientes', '20174');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (191, 1, 'Mirador de las Culturas', 'Aguascalientes', '20174');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (192, 1, 'Los Pericos', 'Aguascalientes', '20174');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (193, 1, 'J Refugio Esparza Reyes', 'Aguascalientes', '20175');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (194, 1, 'Lomas de Oriente 2da. Secci�n', 'Aguascalientes', '20175');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (195, 1, 'Lomas de Oriente 3ra. Secci�n', 'Aguascalientes', '20175');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (196, 1, 'Lomas de Oriente 1a Secci�n', 'Aguascalientes', '20175');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (197, 1, 'La Hojarasca', 'Aguascalientes', '20175');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (198, 1, 'Ejido las Cumbres', 'Aguascalientes', '20175');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (199, 1, 'C.N.O.P. Oriente', 'Aguascalientes', '20177');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (200, 1, 'Pensadores Mexicanos', 'Aguascalientes', '20179');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (201, 1, 'Las Cumbres', 'Aguascalientes', '20179');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (202, 1, 'Pintores Mexicanos', 'Aguascalientes', '20179');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (203, 1, 'Luis Ortega Douglas', 'Aguascalientes', '20179');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (204, 1, 'Las Cumbres II', 'Aguascalientes', '20179');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (205, 1, 'Santa Margarita', 'Aguascalientes', '20179');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (206, 1, 'Progreso', 'Aguascalientes', '20179');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (207, 1, 'Cerro Alto', 'Aguascalientes', '20179');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (208, 1, 'Nueva Alameda', 'Aguascalientes', '20180');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (209, 1, 'Ferronales', 'Aguascalientes', '20180');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (210, 1, 'Rinconada de La Alameda', 'Aguascalientes', '20180');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (211, 1, 'Bosques de La Alameda', 'Aguascalientes', '20180');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (212, 1, 'Luis G�mez Zepeda (ferronales)', 'Aguascalientes', '20180');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (213, 1, 'Del Trabajo', 'Aguascalientes', '20180');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (214, 1, 'Lomas de Santa Anita', 'Aguascalientes', '20180');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (215, 1, 'H�roes', 'Aguascalientes', '20190');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (216, 1, 'La Mancha', 'Aguascalientes', '20190');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (217, 1, 'La Hacienda', 'Aguascalientes', '20190');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (218, 1, 'Haciendas de Aguascalientes', 'Aguascalientes', '20196');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (219, 1, 'Colinas de San Patricio', 'Aguascalientes', '20196');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (220, 1, 'El Rocio', 'Aguascalientes', '20196');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (221, 1, 'Valle del Bicentenario', 'Aguascalientes', '20196');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (222, 1, 'Paseo de los Cactus', 'Aguascalientes', '20196');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (223, 1, 'Jos� Guadalupe Peralta G�mez', 'Aguascalientes', '20196');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (224, 1, 'Terra Nova', 'Aguascalientes', '20196');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (225, 1, 'Real del Sol', 'Aguascalientes', '20196');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (226, 1, 'Sol Naciente', 'Aguascalientes', '20196');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (227, 1, 'Ojocaliente', 'Aguascalientes', '20196');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (228, 1, 'Ojocaliente INEGI', 'Aguascalientes', '20196');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (229, 1, 'Viller�as', 'Aguascalientes', '20196');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (230, 1, 'Jos� Guadalupe Posada', 'Aguascalientes', '20196');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (231, 1, 'Solidaridad 1a Secci�n', 'Aguascalientes', '20196');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (232, 1, 'Villa de las Norias', 'Aguascalientes', '20196');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (233, 1, 'Vistas de Oriente', 'Aguascalientes', '20196');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (234, 1, 'Real de Haciendas', 'Aguascalientes', '20196');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (235, 1, 'Valle de los Cactus', 'Aguascalientes', '20196');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (236, 1, 'Balcones de Oriente', 'Aguascalientes', '20196');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (237, 1, 'Balcones del Valle', 'Aguascalientes', '20196');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (238, 1, 'Ex Hacienda Ojocaliente', 'Aguascalientes', '20198');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (239, 1, 'Misi�n Alameda', 'Aguascalientes', '20198');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (240, 1, 'Ejido Ojocaliente', 'Aguascalientes', '20198');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (241, 1, 'El Riego', 'Aguascalientes', '20199');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (242, 1, 'Fidel Vel�zquez', 'Aguascalientes', '20199');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (243, 1, 'Municipio Libre', 'Aguascalientes', '20199');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (244, 1, 'Jos� Vasconcelos Calder�n', 'Aguascalientes', '20200');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (245, 1, 'Villas del Mediterr�neo', 'Aguascalientes', '20200');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (246, 1, 'Veteranos de La Revoluci�n', 'Aguascalientes', '20200');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (247, 1, 'Bellavista', 'Aguascalientes', '20200');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (248, 1, 'Porta Canteras', 'Aguascalientes', '20200');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (249, 1, 'El Quelite', 'Aguascalientes', '20200');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (250, 1, 'Ex Hacienda La Cantera', 'Aguascalientes', '20200');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (251, 1, 'Loma Bonita', 'Aguascalientes', '20200');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (252, 1, 'Villas de La Cantera', 'Aguascalientes', '20200');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (253, 1, 'Residencial San Nicol�s', 'Aguascalientes', '20200');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (254, 1, 'Fuentes del Lago', 'Aguascalientes', '20200');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (255, 1, 'Lic Manuel G�mez Morin', 'Aguascalientes', '20200');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (256, 1, 'Olinda', 'Aguascalientes', '20200');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (257, 1, 'Educaci�n �lamos', 'Aguascalientes', '20205');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (258, 1, 'Nueva Espa�a', 'Aguascalientes', '20205');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (259, 1, 'La Barranquilla', 'Aguascalientes', '20206');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (260, 1, 'Lic. Jos� L�pez Portillo', 'Aguascalientes', '20206');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (261, 1, 'Barandales de San Jos�', 'Aguascalientes', '20206');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (262, 1, 'Rinconada San Jos�', 'Aguascalientes', '20207');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (263, 1, 'Canteras de San Javier', 'Aguascalientes', '20207');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (264, 1, 'Capital City', 'Aguascalientes', '20207');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (265, 1, 'Canteras de San Jos�', 'Aguascalientes', '20208');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (266, 1, 'Espa�a', 'Aguascalientes', '20210');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (267, 1, 'Pirules INFONAVIT', 'Aguascalientes', '20210');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (268, 1, 'La Barranca de Guadalupe', 'Aguascalientes', '20210');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (269, 1, 'Circunvalaci�n Poniente', 'Aguascalientes', '20210');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (270, 1, 'Jardines de los Pirules', 'Aguascalientes', '20216');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (271, 1, 'Residencial los Pirules', 'Aguascalientes', '20217');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (272, 1, 'Jardines del Lago', 'Aguascalientes', '20218');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (273, 1, 'San Agust�n', 'Aguascalientes', '20218');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (274, 1, 'Canteras de Santa Imelda', 'Aguascalientes', '20218');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (275, 1, 'Francisco Villa', 'Aguascalientes', '20218');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (276, 1, 'Canteras de San Agustin', 'Aguascalientes', '20218');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (277, 1, 'Los Eucaliptos', 'Aguascalientes', '20218');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (278, 1, 'Santa Imelda', 'Aguascalientes', '20218');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (279, 1, 'Los Eucaliptos 2a. Secci�n', 'Aguascalientes', '20218');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (280, 1, 'San Martin de La Cantera', 'Aguascalientes', '20218');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (281, 1, 'Parque Industrial el Vergel', 'Aguascalientes', '20219');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (282, 1, 'El Ed�n', 'Aguascalientes', '20219');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (283, 1, 'Misi�n Juan Pablo II', 'Aguascalientes', '20219');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (284, 1, 'Las Flores', 'Aguascalientes', '20220');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (285, 1, 'Vivienda Popular', 'Aguascalientes', '20220');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (286, 1, 'Las Torres', 'Aguascalientes', '20229');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (287, 1, 'Santa Elena', 'Aguascalientes', '20230');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (288, 1, 'Las Am�ricas', 'Aguascalientes', '20230');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (289, 1, 'Obraje', 'Aguascalientes', '20230');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (290, 1, 'Agricultura', 'Aguascalientes', '20234');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (291, 1, 'Mesonero', 'Aguascalientes', '20234');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (292, 1, 'Valle Dorado', 'Aguascalientes', '20235');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (293, 1, 'Villa Jard�n', 'Aguascalientes', '20235');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (294, 1, 'El Dorado 2a Secci�n', 'Aguascalientes', '20235');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (295, 1, 'El Dorado 1a Secci�n', 'Aguascalientes', '20235');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (296, 1, 'Jardines de Santa Elena', 'Aguascalientes', '20236');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (297, 1, 'Montebello', 'Aguascalientes', '20237');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (298, 1, 'Hermanos Carre�n', 'Aguascalientes', '20237');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (299, 1, 'Santa Elena 2a Secci�n', 'Aguascalientes', '20238');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (300, 1, 'La Fuente', 'Aguascalientes', '20239');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (301, 1, 'Los Virreyes', 'Aguascalientes', '20240');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (302, 1, 'El Llanito', 'Aguascalientes', '20240');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (303, 1, 'Residencial Cos�o', 'Aguascalientes', '20240');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (304, 1, 'La Luna', 'Aguascalientes', '20240');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (305, 1, 'El Laurel', 'Aguascalientes', '20240');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (306, 1, 'La Salud', 'Aguascalientes', '20240');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (307, 1, 'Residencial el Encino', 'Aguascalientes', '20240');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (308, 1, 'El Encino', 'Aguascalientes', '20240');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (309, 1, 'Triana', 'Aguascalientes', '20240');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (310, 1, 'Triana', 'Aguascalientes', '20240');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (311, 1, 'San Fernando INFONAVIT', 'Aguascalientes', '20247');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (312, 1, 'Jardines de Triana', 'Aguascalientes', '20248');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (313, 1, 'G�mez', 'Aguascalientes', '20249');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (314, 1, 'Jardines de La Cruz', 'Aguascalientes', '20250');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (315, 1, 'Villas de Kristal', 'Aguascalientes', '20250');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (316, 1, 'Jes�s G�mez Portugal', 'Aguascalientes', '20250');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (317, 1, 'La Huerta', 'Aguascalientes', '20250');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (318, 1, 'San Luis', 'Aguascalientes', '20250');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (319, 1, 'H�roes de Aguascalientes', 'Aguascalientes', '20250');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (320, 1, 'Bona Gens', 'Aguascalientes', '20255');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (321, 1, 'INFONAVIT Los Volcanes', 'Aguascalientes', '20255');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (322, 1, 'FOVISSSTE Ojocaliente I', 'Aguascalientes', '20256');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (323, 1, 'Ojocaliente las Torres', 'Aguascalientes', '20256');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (324, 1, 'Parque y Presa del Cedazo', 'Aguascalientes', '20256');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (325, 1, 'Ojocaliente FOVISSSTE II', 'Aguascalientes', '20256');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (326, 1, 'Rinconada de La Cruz', 'Aguascalientes', '20256');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (327, 1, 'Villas de Ojocaliente', 'Aguascalientes', '20256');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (328, 1, 'L�zaro C�rdenas', 'Aguascalientes', '20257');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (329, 1, 'La Estaci�n', 'Aguascalientes', '20259');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (330, 1, 'La Pur�sima', 'Aguascalientes', '20259');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (331, 1, 'Jes�s Ter�n Peredo', 'Aguascalientes', '20260');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (332, 1, 'Rinconada El Cedazo', 'Aguascalientes', '20260');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (333, 1, 'Sidusa', 'Aguascalientes', '20260');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (334, 1, 'Ojo de Agua', 'Aguascalientes', '20260');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (335, 1, 'IV Centenario', 'Aguascalientes', '20260');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (336, 1, 'Vivienda Militar', 'Aguascalientes', '20260');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (337, 1, 'Ojo de Agua de Palmitas', 'Aguascalientes', '20263');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (338, 1, 'Salto de Ojocaliente', 'Aguascalientes', '20263');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (339, 1, 'Cima del Chapul�n', 'Aguascalientes', '20263');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (340, 1, 'San �ngel', 'Aguascalientes', '20263');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (341, 1, 'Cielo Claro', 'Aguascalientes', '20263');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (342, 1, 'La Lomita', 'Aguascalientes', '20263');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (343, 1, 'Agua Clara', 'Aguascalientes', '20263');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (344, 1, 'Balcones de Ojocaliente', 'Aguascalientes', '20263');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (345, 1, 'Villa las Palmas', 'Aguascalientes', '20263');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (346, 1, 'Baj�o de las Palmas', 'Aguascalientes', '20263');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (347, 1, 'Lomas del Gachup�n', 'Aguascalientes', '20263');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (348, 1, 'San Jorge', 'Aguascalientes', '20263');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (349, 1, 'Solidaridad 2a Secci�n', 'Aguascalientes', '20263');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (350, 1, 'Lomas del Chapul�n', 'Aguascalientes', '20263');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (351, 1, 'Solidaridad 3a Secci�n', 'Aguascalientes', '20263');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (352, 1, 'Tierra Buena', 'Aguascalientes', '20263');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (353, 1, 'Cobano de Palmitas', 'Aguascalientes', '20263');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (354, 1, 'Villa Taurina', 'Aguascalientes', '20263');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (355, 1, 'El Cedazo', 'Aguascalientes', '20263');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (356, 1, 'Vista del Sol 3a Secci�n', 'Aguascalientes', '20264');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (357, 1, 'Morelos INFONAVIT', 'Aguascalientes', '20264');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (358, 1, 'Vista del Sol 2a Secci�n', 'Aguascalientes', '20264');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (359, 1, 'Ojo de Agua INFONAVIT', 'Aguascalientes', '20265');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (360, 1, 'La Cruz', 'Aguascalientes', '20266');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (361, 1, 'Misi�n de Santa Fe', 'Aguascalientes', '20266');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (362, 1, 'Jardines del Sol', 'Aguascalientes', '20266');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (363, 1, 'Vista del Sol 1a Secci�n', 'Aguascalientes', '20266');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (364, 1, 'Jardines de La Convenci�n', 'Aguascalientes', '20267');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (365, 1, 'Lic Primo Verdad INEGI', 'Aguascalientes', '20267');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (366, 1, 'Ojo de Agua FOVISSSTE 1a Secci�n', 'Aguascalientes', '20267');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (367, 1, 'S.T.E.M.A.', 'Aguascalientes', '20267');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (368, 1, 'Fuentes de La Asunci�n', 'Aguascalientes', '20268');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (369, 1, 'Jardines de La Luz', 'Aguascalientes', '20269');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (370, 1, 'Jardines de La Asunci�n', 'Aguascalientes', '20270');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (371, 1, 'Bulevar', 'Aguascalientes', '20270');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (372, 1, 'Jardines de Aguascalientes', 'Aguascalientes', '20270');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (373, 1, 'Lindavista', 'Aguascalientes', '20270');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (374, 1, 'Los Cedros', 'Aguascalientes', '20270');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (375, 1, 'M�xico', 'Aguascalientes', '20270');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (376, 1, 'El Caminero', 'Aguascalientes', '20270');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (377, 1, 'Las Canoas', 'Aguascalientes', '20270');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (378, 1, 'Jardines de las Bugambilias', 'Aguascalientes', '20276');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (379, 1, 'Jardines del Parque', 'Aguascalientes', '20276');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (380, 1, 'Pir�mides', 'Aguascalientes', '20277');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (381, 1, 'Rinconada del Parque', 'Aguascalientes', '20277');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (382, 1, 'Residencial del Parque', 'Aguascalientes', '20277');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (383, 1, 'Jardines de las Fuentes', 'Aguascalientes', '20278');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (384, 1, 'Diana', 'Aguascalientes', '20278');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (385, 1, 'Jardines del Sur', 'Aguascalientes', '20280');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (386, 1, 'Casasolida', 'Aguascalientes', '20280');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (387, 1, 'San Francisco del Arenal', 'Aguascalientes', '20280');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (388, 1, 'San Pedro', 'Aguascalientes', '20280');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (389, 1, 'Australis', 'Aguascalientes', '20280');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (390, 1, 'Prados de Villasunci�n', 'Aguascalientes', '20280');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (391, 1, 'Martinez Dominguez', 'Aguascalientes', '20280');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (392, 1, 'Torres de San Francisco', 'Aguascalientes', '20280');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (393, 1, 'Central de Abastos', 'Aguascalientes', '20280');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (394, 1, 'Prados del Sur', 'Aguascalientes', '20280');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (395, 1, 'Trojes del Sur', 'Aguascalientes', '20280');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (396, 1, 'Parque Industrial Siglo XXI', 'Aguascalientes', '20283');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (397, 1, 'Parque Industrial Siglo XXI (Ampliaci�n)', 'Aguascalientes', '20283');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (398, 1, 'Villas del Oeste', 'Aguascalientes', '20284');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (399, 1, 'Villas de Santa Rosa', 'Aguascalientes', '20284');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (400, 1, 'La Estancia', 'Aguascalientes', '20284');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (401, 1, 'INFONAVIT Potreros del Oeste', 'Aguascalientes', '20284');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (402, 1, 'La Casita', 'Aguascalientes', '20284');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (403, 1, 'Vistas del Sur', 'Aguascalientes', '20284');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (404, 1, 'Versalles 1a Secci�n', 'Aguascalientes', '20285');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (405, 1, 'Versalles 2a Secci�n', 'Aguascalientes', '20285');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (406, 1, 'Villas del Pilar 1a Secci�n', 'Aguascalientes', '20286');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (407, 1, 'Bosque Real', 'Aguascalientes', '20286');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (408, 1, 'Villa Capri', 'Aguascalientes', '20286');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (409, 1, 'Paseos de Santa M�nica', 'Aguascalientes', '20286');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (410, 1, 'Barlovento', 'Aguascalientes', '20286');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (411, 1, 'Vicente Guerrero', 'Aguascalientes', '20286');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (412, 1, 'Villas San Antonio', 'Aguascalientes', '20286');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (413, 1, 'Rancho Santa M�nica', 'Aguascalientes', '20286');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (414, 1, 'Providencia', 'Aguascalientes', '20286');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (415, 1, 'Rinconada Santa M�nica', 'Aguascalientes', '20286');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (416, 1, 'Insurgentes', 'Aguascalientes', '20287');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (417, 1, 'Bulevares 2a. Secci�n', 'Aguascalientes', '20288');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (418, 1, 'Bulevares 1a. Secci�n', 'Aguascalientes', '20288');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (419, 1, 'Pilar Blanco INFONAVIT', 'Aguascalientes', '20289');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (420, 1, 'Parque Industrial ALTEC', 'Aguascalientes', '20290');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (421, 1, 'Plaza Vestir', 'Aguascalientes', '20290');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (422, 1, 'Ciudad Industrial', 'Aguascalientes', '20290');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (423, 1, 'Vista Alegre', 'Aguascalientes', '20290');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (424, 1, 'Centro SCT Aguascalientes', 'Aguascalientes', '20291');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (425, 1, 'Villas de Bonaterra', 'Aguascalientes', '20296');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (426, 1, 'Residencial San Javier', 'Aguascalientes', '20296');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (427, 1, 'Villa Sur', 'Aguascalientes', '20296');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (428, 1, 'R�sticos Calpulli', 'Aguascalientes', '20296');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (429, 1, 'San Francisco de los Arteaga', 'Aguascalientes', '20296');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (430, 1, 'Casa Blanca', 'Aguascalientes', '20297');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (431, 1, 'Jardines de Casanueva', 'Aguascalientes', '20297');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (432, 1, 'Jardines de Casablanca', 'Aguascalientes', '20297');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (433, 1, 'Morelos I', 'Aguascalientes', '20298');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (434, 1, 'Morelos 2a Secci�n', 'Aguascalientes', '20298');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (435, 1, 'Lomas del Sur', 'Aguascalientes', '20298');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (436, 1, 'Laureles del Sur', 'Aguascalientes', '20298');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (437, 1, 'Condominio La terraza', 'Aguascalientes', '20298');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (438, 1, 'San Sebasti�n', 'Aguascalientes', '20298');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (439, 1, 'Lomas del Mirador', 'Aguascalientes', '20298');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (440, 1, 'Valle del Cedazo', 'Aguascalientes', '20298');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (441, 1, 'Lomas de Vistabella 2a. Secci�n', 'Aguascalientes', '20298');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (442, 1, 'Solidaridad 4a Secci�n', 'Aguascalientes', '20298');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (443, 1, 'Hacienda San Marcos', 'Aguascalientes', '20298');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (444, 1, 'Villas de Ajedrez', 'Aguascalientes', '20298');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (445, 1, 'Misi�n de Santa Luc�a', 'Aguascalientes', '20298');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (446, 1, 'Emiliano Zapata', 'Aguascalientes', '20298');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (447, 1, 'Lotes de Arellano', 'Aguascalientes', '20298');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (448, 1, 'Lomas de Vistabella', 'Aguascalientes', '20298');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (449, 1, 'Lomas de Nueva York', 'Aguascalientes', '20298');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (450, 1, 'Paseos de San Antonio', 'Aguascalientes', '20298');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (451, 1, 'Mujeres Ilustres', 'Aguascalientes', '20299');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (452, 1, 'Periodistas', 'Aguascalientes', '20299');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (453, 1, 'Villalta', 'Aguascalientes', '20299');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (454, 1, 'Lomas de San Jorge', 'Aguascalientes', '20299');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (455, 1, 'Reencuentro', 'Aguascalientes', '20299');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (456, 1, 'Lomas Altas', 'Aguascalientes', '20299');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (457, 1, 'Fundadores', 'Aguascalientes', '20299');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (458, 1, 'Lomas del Ajedrez', 'Aguascalientes', '20299');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (459, 1, 'San Francisco de los Romos Centro', 'San Francisco de los Romo', '20300');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (460, 1, 'Campestre San Carlos', 'San Francisco de los Romo', '20300');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (461, 1, 'Panamericano', 'San Francisco de los Romo', '20300');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (462, 1, 'El Tir�n (El Progreso)', 'San Francisco de los Romo', '20303');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (463, 1, 'La Perla', 'San Francisco de los Romo', '20303');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (464, 1, 'Los Cedros', 'San Francisco de los Romo', '20303');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (465, 1, 'Mar�a', 'San Francisco de los Romo', '20303');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (466, 1, 'Hidalgo', 'San Francisco de los Romo', '20303');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (467, 1, 'San Juan Bautista', 'San Francisco de los Romo', '20303');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (468, 1, 'San Pablo', 'San Francisco de los Romo', '20303');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (469, 1, 'Santa Isabel', 'San Francisco de los Romo', '20303');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (470, 1, 'La Guadalupana', 'San Francisco de los Romo', '20303');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (471, 1, 'Revoluci�n', 'San Francisco de los Romo', '20303');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (472, 1, 'San Jos� Buenavista', 'San Francisco de los Romo', '20303');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (473, 1, 'La Aurora', 'San Francisco de los Romo', '20303');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (474, 1, 'La Sociedad San Juan', 'San Francisco de los Romo', '20303');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (475, 1, 'Cerrada San Francisco', 'San Francisco de los Romo', '20303');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (476, 1, 'La Margarita', 'San Francisco de los Romo', '20303');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (477, 1, 'San Francisco', 'San Francisco de los Romo', '20303');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (478, 1, 'Fracci�n de la Trinidad II', 'San Francisco de los Romo', '20304');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (479, 1, 'El Chamizal', 'San Francisco de los Romo', '20304');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (480, 1, 'San Juan', 'San Francisco de los Romo', '20304');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (481, 1, 'Villa de Guadalupe', 'San Francisco de los Romo', '20304');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (482, 1, 'Mary', 'San Francisco de los Romo', '20304');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (483, 1, 'Monserrat', 'San Francisco de los Romo', '20304');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (484, 1, '28 de Abril', 'San Francisco de los Romo', '20304');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (485, 1, 'San Jos� del Barranco', 'San Francisco de los Romo', '20304');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (486, 1, 'El Cardonal', 'San Francisco de los Romo', '20304');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (487, 1, 'La Escondida (El Salero)', 'San Francisco de los Romo', '20304');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (488, 1, 'Santa B�rbara', 'San Francisco de los Romo', '20304');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (489, 1, 'Santa Fe', 'San Francisco de los Romo', '20304');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (490, 1, 'El Refugio', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (491, 1, 'La Gloria', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (492, 1, 'La Providencia', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (493, 1, 'Los Sabinos', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (494, 1, 'San Crist�bal', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (495, 1, 'Zacatenco', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (496, 1, 'El Barranco', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (497, 1, 'El Esp�ritu', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (498, 1, 'El Gigante', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (499, 1, 'La Trinidad', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (500, 1, 'Los Gonzalez', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (501, 1, 'Alfredo Soriano L�pez', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (502, 1, 'El Cortijo', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (503, 1, 'La Paz', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (504, 1, 'La Uni�n', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (505, 1, 'San Pedro Victoria de Arriba', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (506, 1, 'Las Carmelitas', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (507, 1, 'San �ngel', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (508, 1, 'San Pedro Victoria (San Pedro Victoria de Abajo)', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (509, 1, 'Vi�edos Xoconoxtle', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (510, 1, 'Santa Elena (Elena)', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (511, 1, 'Los Lirios', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (512, 1, 'Santa Anita', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (513, 1, 'Santa Elena', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (514, 1, 'Vi�edos los Zapata', 'San Francisco de los Romo', '20305');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (515, 1, 'La Loma de los Negritos', 'Aguascalientes', '20310');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (516, 1, 'San Felipe [Vi�edos]', 'Aguascalientes', '20310');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (517, 1, 'Los Negritos', 'Aguascalientes', '20310');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (518, 1, 'Sandovales', 'Aguascalientes', '20311');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (519, 1, 'Trojes de Alonso', 'Aguascalientes', '20311');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (520, 1, 'Coyotes Norte', 'Aguascalientes', '20311');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (521, 1, 'Cuauht�moc (Las Palomas)', 'Aguascalientes', '20313');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (522, 1, 'Hacienda Nueva', 'Aguascalientes', '20313');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (523, 1, 'El Cari��n', 'Aguascalientes', '20314');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (524, 1, 'Vi�edos Valle Redondo', 'Aguascalientes', '20315');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (525, 1, 'Lomas del Picacho', 'Aguascalientes', '20316');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (526, 1, 'Santa Cruz de la Presa', 'Aguascalientes', '20317');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (527, 1, 'CERESO (Para Varones y Mujeres)', 'Aguascalientes', '20319');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (528, 1, 'Gral. Jos� Mar�a Morelos y Pav�n', 'Aguascalientes', '20320');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (529, 1, 'Estaci�n Ca�ada Honda', 'Aguascalientes', '20320');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (530, 1, 'Las Ca�adas', 'Aguascalientes', '20320');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (531, 1, 'El Cortijo', 'Aguascalientes', '20321');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (532, 1, 'La Rinconada (La Escondida)', 'Aguascalientes', '20321');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (533, 1, 'La Presa', 'Aguascalientes', '20322');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (534, 1, 'Santa Mar�a de Gallardo', 'Aguascalientes', '20323');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (535, 1, 'Jaltomate', 'Aguascalientes', '20324');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (536, 1, 'Ex-Hacienda de San Ignacio', 'Aguascalientes', '20326');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (537, 1, 'Loretta', 'Aguascalientes', '20326');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (538, 1, 'San Ignacio', 'Aguascalientes', '20326');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (539, 1, 'La Soledad', 'Aguascalientes', '20326');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (540, 1, 'San Ignacio 3', 'Aguascalientes', '20326');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (541, 1, 'San Ignacio II', 'Aguascalientes', '20326');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (542, 1, 'Rinconada San Ignacio', 'Aguascalientes', '20326');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (543, 1, 'Parque Industrial Tecnopolo Pocitos ll', 'Aguascalientes', '20326');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (544, 1, 'Puesta del Sol', 'Aguascalientes', '20326');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (545, 1, 'La Aurora', 'Aguascalientes', '20326');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (546, 1, 'La Rioja', 'Aguascalientes', '20326');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (547, 1, 'San Ignacio III', 'Aguascalientes', '20326');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (548, 1, 'La Perla', 'Aguascalientes', '20326');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (549, 1, 'Parque Industrial Tecnopolo Pocitos', 'Aguascalientes', '20328');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (550, 1, 'Los Pocitos', 'Aguascalientes', '20328');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (551, 1, 'Sandovales de Arriba', 'Aguascalientes', '20328');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (552, 1, 'Torres Residencial Campestre Santamar�a', 'Aguascalientes', '20329');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (553, 1, 'Puerta del Sol', 'Aguascalientes', '20329');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (554, 1, 'Privanza Andaluz', 'Aguascalientes', '20329');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (555, 1, 'La Punta Campestre', 'Aguascalientes', '20329');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (556, 1, 'La Querencia', 'Aguascalientes', '20329');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (557, 1, 'Rinc�n Andaluz', 'Aguascalientes', '20329');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (558, 1, 'La Plazuela', 'Aguascalientes', '20329');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (559, 1, 'Residencial Las Quintas', 'Aguascalientes', '20329');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (560, 1, 'Contadero', 'Aguascalientes', '20329');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (561, 1, 'La Joya', 'Aguascalientes', '20329');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (562, 1, 'R�o Viejo', 'Aguascalientes', '20329');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (563, 1, 'Palo Alto', 'El Llano', '20330');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (564, 1, 'Palo Alto Centro', 'El Llano', '20330');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (565, 1, 'El Saucito', 'El Llano', '20330');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (566, 1, 'De Afuera', 'El Llano', '20330');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (567, 1, 'El Salto', 'El Llano', '20330');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (568, 1, 'Pobre', 'El Llano', '20330');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (569, 1, 'De Abajo', 'El Llano', '20330');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (570, 1, 'De Triana', 'El Llano', '20330');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (571, 1, 'El Progreso', 'El Llano', '20330');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (572, 1, 'San Jos� (San Antonio de Montoya)', 'El Llano', '20333');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (573, 1, 'El Cot�n', 'El Llano', '20333');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (574, 1, 'El Mocho', 'El Llano', '20333');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (575, 1, 'Licenciado Jes�s Ter�n (El Muerto)', 'El Llano', '20333');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (576, 1, 'San Francisco de los Pedroza', 'El Llano', '20333');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (577, 1, 'Sandovales (San Miguel de los Sandovales)', 'El Llano', '20333');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (578, 1, 'Las Flores (El Cot�n)', 'El Llano', '20333');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (579, 1, 'San Francisco de los Viveros', 'El Llano', '20333');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (580, 1, 'El Barreno (Ampliaci�n San Francisco)', 'El Llano', '20333');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (581, 1, 'San Ger�nimo', 'El Llano', '20333');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (582, 1, 'El Milagro', 'El Llano', '20333');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (583, 1, 'El Vaciero', 'El Llano', '20333');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (584, 1, 'Las Laminas', 'El Llano', '20333');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (585, 1, 'El Colorin', 'El Llano', '20334');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (586, 1, 'El Novillo', 'El Llano', '20334');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (587, 1, 'La Luz', 'El Llano', '20334');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (588, 1, 'Ojo de Agua de Crucitas', 'El Llano', '20335');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (589, 1, 'El Puertecito', 'El Llano', '20335');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (590, 1, 'Ojo de Agua de Placitas', 'El Llano', '20335');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (591, 1, 'Francisco Sarabia (La Reforma)', 'El Llano', '20336');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (592, 1, 'Santa Rosa (El Huizache)', 'El Llano', '20336');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (593, 1, 'Los Conos', 'El Llano', '20336');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (594, 1, 'Montoya', 'El Llano', '20336');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (595, 1, 'El Terremoto', 'El Llano', '20336');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (596, 1, 'La Tinaja', 'El Llano', '20337');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (597, 1, 'El Reto�o', 'El Llano', '20337');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (598, 1, 'San Jer�nimo', 'El Llano', '20337');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (599, 1, 'El Rosario', 'El Llano', '20337');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (600, 1, 'El Copetillo (El Moquete)', 'El Llano', '20338');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (601, 1, 'El Tild�o', 'El Llano', '20338');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (602, 1, 'La Uni�n (La Paz)', 'El Llano', '20338');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (603, 1, 'Tanque el Coyote (El Coyote)', 'El Llano', '20338');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (604, 1, 'Mirasoles', 'El Llano', '20338');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (605, 1, 'Rancho Nuevo', 'El Llano', '20338');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (606, 1, 'El Chonguillo (El Chonguito)', 'El Llano', '20338');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (607, 1, 'El Copetillo', 'El Llano', '20338');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (608, 1, 'Granja Temixco', 'El Llano', '20339');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (609, 1, 'La Primavera', 'El Llano', '20339');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (610, 1, 'La Calavera (Quinta de Alonso)', 'El Llano', '20339');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (611, 1, 'San Ram�n', 'El Llano', '20339');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (612, 1, 'Santa Rita Uno (Santa Rita)', 'El Llano', '20339');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (613, 1, 'La Lucita', 'El Llano', '20339');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (614, 1, 'San Jos� (San Jos� de los Rodr�guez)', 'El Llano', '20339');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (615, 1, 'Lomas del Refugio (La Loma)', 'El Llano', '20339');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (616, 1, 'Santa Elena', 'El Llano', '20339');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (617, 1, 'Santa Clara (Las Mieleras)', 'El Llano', '20339');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (618, 1, 'San Antonio de la Rosa', 'El Llano', '20339');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (619, 1, 'El Llano [CERESO]', 'El Llano', '20339');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (620, 1, 'El Para�so (Santa Rita)', 'El Llano', '20339');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (621, 1, 'San Lorenzo', 'El Llano', '20339');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (622, 1, 'San Agust�n de los D�az', 'El Llano', '20339');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (623, 1, 'Parque Industrial Log�stica Automotriz', 'Aguascalientes', '20340');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (624, 1, 'Arellano', 'Aguascalientes', '20340');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (625, 1, 'Buenavista de Pe�uelas', 'Aguascalientes', '20340');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (626, 1, 'Cieneguilla (La Lumbrera)', 'Aguascalientes', '20340');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (627, 1, 'Pe�uelas (El Cienegal)', 'Aguascalientes', '20340');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (628, 1, 'La Huerta (La Cruz)', 'Aguascalientes', '20341');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (629, 1, 'El Salto de Ojocaliente', 'Aguascalientes', '20341');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (630, 1, 'El Salto de los Salado', 'Aguascalientes', '20341');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (631, 1, 'San Francisco', 'Aguascalientes', '20342');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (632, 1, 'San Gerardo', 'Aguascalientes', '20342');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (633, 1, 'Villa Licenciado Jes�s Ter�n (Calvillito)', 'Aguascalientes', '20344');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (634, 1, 'Montoro (Mesa del Salto)', 'Aguascalientes', '20345');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (635, 1, 'Los Ca�os', 'Aguascalientes', '20346');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (636, 1, 'San Antonio de Pe�uelas', 'Aguascalientes', '20348');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (637, 1, 'Aguascalientes (Lic. Jes�s Ter�n Peredo)', 'Aguascalientes', '20349');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (638, 1, 'Loretito (Charco del Toro)', 'San Francisco de los Romo', '20350');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (639, 1, 'Macario J G�mez', 'San Francisco de los Romo', '20350');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (640, 1, 'Rancho Seco', 'San Francisco de los Romo', '20350');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (641, 1, 'Medio Kilo', 'San Francisco de los Romo', '20350');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (642, 1, 'Los Capricornios (La Biznaga)', 'San Francisco de los Romo', '20350');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (643, 1, 'La Providencia 1', 'San Francisco de los Romo', '20353');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (644, 1, 'San Ram�n', 'San Francisco de los Romo', '20355');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (645, 1, 'Vi�edos River', 'San Francisco de los Romo', '20355');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (646, 1, 'Parque Industrial San Francisco de los Romo', 'San Francisco de los Romo', '20355');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (647, 1, 'La Concepci�n', 'San Francisco de los Romo', '20355');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (648, 1, 'La Guayana', 'San Francisco de los Romo', '20355');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (649, 1, 'Urbi Villa del Vergel', 'San Francisco de los Romo', '20355');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (650, 1, 'Paseos de la Providencia', 'San Francisco de los Romo', '20355');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (651, 1, 'Ram�n Romo', 'San Francisco de los Romo', '20356');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (652, 1, 'Estaci�n Chicalote', 'San Francisco de los Romo', '20356');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (653, 1, 'Borrotes', 'San Francisco de los Romo', '20356');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (654, 1, 'Rancho Nuevo', 'San Francisco de los Romo', '20357');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (655, 1, 'Ojo de Agua del Mezquite', 'San Francisco de los Romo', '20357');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (656, 1, 'El Tepetate', 'San Francisco de los Romo', '20357');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (657, 1, 'Amapolas del R�o', 'San Francisco de los Romo', '20357');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (658, 1, 'Rancho Nuevo 2', 'San Francisco de los Romo', '20357');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (659, 1, 'Parque Industrial Valle de Aguascalientes', 'San Francisco de los Romo', '20358');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (660, 1, 'La Casita', 'San Francisco de los Romo', '20358');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (661, 1, 'Villas de San Felipe', 'San Francisco de los Romo', '20358');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (662, 1, 'La Ribera', 'San Francisco de los Romo', '20358');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (663, 1, 'Ex Vi�edos de Guadalupe', 'San Francisco de los Romo', '20358');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (664, 1, 'Puertecito de la Virgen', 'San Francisco de los Romo', '20358');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (665, 1, 'Sendero de los Quetzales', 'San Francisco de los Romo', '20358');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (666, 1, 'San Jos� de la Orde�a', 'Aguascalientes', '20363');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (667, 1, 'San Antonio de los Pedroza', 'Aguascalientes', '20363');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (668, 1, 'San Nicol�s de Arriba', 'Aguascalientes', '20364');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (669, 1, 'San Nicol�s de en Medio', 'Aguascalientes', '20364');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (670, 1, 'El Colorado (El Soyatal)', 'Aguascalientes', '20366');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (671, 1, 'La Herrada', 'Aguascalientes', '20366');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (672, 1, 'El Conejal', 'Aguascalientes', '20366');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (673, 1, 'Tanque el Trigo', 'Aguascalientes', '20367');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (674, 1, 'El Roc�o', 'Aguascalientes', '20367');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (675, 1, 'Norias del Ojocaliente', 'Aguascalientes', '20367');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (676, 1, 'El Malacate', 'Aguascalientes', '20369');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (677, 1, 'Dolores', 'Aguascalientes', '20369');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (678, 1, 'Puerto de Nieto', 'Aguascalientes', '20370');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (679, 1, 'El Puerto', 'Aguascalientes', '20370');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (680, 1, 'Ciudad de los Ni�os', 'Aguascalientes', '20371');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (681, 1, 'La Cotorra', 'Aguascalientes', '20371');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (682, 1, 'El Ni�gara', 'Aguascalientes', '20372');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (683, 1, 'Cabecita 3 Mar�as', 'Aguascalientes', '20372');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (684, 1, 'Granjas F�tima', 'Aguascalientes', '20372');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (685, 1, 'El Salitre', 'Aguascalientes', '20373');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (686, 1, 'El Ocote', 'Aguascalientes', '20373');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (687, 1, 'El Tanque de los Jim�nez', 'Aguascalientes', '20375');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (688, 1, 'El Cedazo (Cedazo de San Antonio)', 'Aguascalientes', '20375');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (689, 1, 'Campestre Bosques de Las Lomas', 'Aguascalientes', '20375');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (690, 1, 'Centro de Arriba (El Taray)', 'Aguascalientes', '20376');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (691, 1, 'San Pedro Cieneguilla', 'Aguascalientes', '20377');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (692, 1, 'Cieneguilla', 'Aguascalientes', '20377');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (693, 1, 'Los Dolores', 'Aguascalientes', '20379');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (694, 1, 'Norias del Paso Hondo', 'Aguascalientes', '20384');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (695, 1, 'Norias del Paso Hondo', 'Aguascalientes', '20384');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (696, 1, 'El Hotelito', 'Aguascalientes', '20384');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (697, 1, 'Paso Hondo', 'Aguascalientes', '20384');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (698, 1, 'Santa Gertrudis', 'Aguascalientes', '20385');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (699, 1, 'El Duraznillo', 'Aguascalientes', '20386');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (700, 1, 'Tanque de Guadalupe', 'Aguascalientes', '20386');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (701, 1, 'Los Dur�n', 'Aguascalientes', '20389');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (702, 1, 'Soledad de Abajo', 'Aguascalientes', '20389');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (703, 1, 'Matamoros', 'Aguascalientes', '20389');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (704, 1, 'Villa Campestre San Jos� del Monte', 'Aguascalientes', '20390');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (705, 1, 'San Jos�', 'Aguascalientes', '20390');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (706, 1, 'Ex-Hacienda de Agostaderito', 'Aguascalientes', '20391');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (707, 1, 'Parque Industrial Gigante de los Arellano', 'Aguascalientes', '20392');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (708, 1, 'Montoro', 'Aguascalientes', '20392');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (709, 1, 'Universidad Aut�noma de Aguascalientes  Campus Sur', 'Aguascalientes', '20392');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (710, 1, 'Campestre el Potrerillo', 'Aguascalientes', '20392');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (711, 1, 'Parque Industrial FINSA Aguascalientes', 'Aguascalientes', '20393');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (712, 1, 'Coyotes Sur', 'Aguascalientes', '20394');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (713, 1, 'Ca�ada Grande de Cotorina', 'Aguascalientes', '20394');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (714, 1, 'Los Cuervos (Los Ojos de Agua)', 'Aguascalientes', '20395');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (715, 1, 'San Bartolo', 'Aguascalientes', '20395');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (716, 1, 'El Refugio de Pe�uelas', 'Aguascalientes', '20396');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (717, 1, 'Ex-Hacienda de Pe�uelas', 'Aguascalientes', '20396');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (718, 1, 'El Turicate', 'Aguascalientes', '20399');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (719, 1, 'Rinc�n de Romos Centro', 'Rinc�n de Romos', '20400');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (720, 1, 'Norte', 'Rinc�n de Romos', '20403');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (721, 1, 'Santa Elena', 'Rinc�n de Romos', '20403');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (722, 1, 'Desarrollo Especial La Pedrera', 'Rinc�n de Romos', '20403');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (723, 1, 'Subdivisi�n La Piedrera', 'Rinc�n de Romos', '20403');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (724, 1, 'Villa Seguridad', 'Rinc�n de Romos', '20403');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (725, 1, 'Jos� Luis Macias', 'Rinc�n de Romos', '20404');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (726, 1, 'Embajadores', 'Rinc�n de Romos', '20404');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (727, 1, 'Estancia de Chora', 'Rinc�n de Romos', '20404');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (728, 1, 'Emperadores', 'Rinc�n de Romos', '20404');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (729, 1, 'La Paz', 'Rinc�n de Romos', '20405');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (730, 1, 'De Guadalupe', 'Rinc�n de Romos', '20405');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (731, 1, 'El Chave�o', 'Rinc�n de Romos', '20405');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (732, 1, 'De Chora', 'Rinc�n de Romos', '20406');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (733, 1, 'Rinconada de las Piedras', 'Rinc�n de Romos', '20406');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (734, 1, 'Santa Cruz', 'Rinc�n de Romos', '20406');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (735, 1, 'Rinconada Alameda', 'Rinc�n de Romos', '20406');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (736, 1, 'Fraternidad', 'Rinc�n de Romos', '20406');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (737, 1, 'L�zaro C�rdenas', 'Rinc�n de Romos', '20406');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (738, 1, 'Cerro del Gato', 'Rinc�n de Romos', '20406');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (739, 1, 'La Mezquitera', 'Rinc�n de Romos', '20410');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (740, 1, 'Santa Anita', 'Rinc�n de Romos', '20410');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (741, 1, 'El Potrero', 'Rinc�n de Romos', '20410');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (742, 1, 'Magisterial II', 'Rinc�n de Romos', '20410');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (743, 1, 'Magisterial', 'Rinc�n de Romos', '20410');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (744, 1, 'Independencia', 'Rinc�n de Romos', '20410');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (745, 1, 'Villas de Jes�s', 'Rinc�n de Romos', '20414');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (746, 1, 'Desarrollo Especial', 'Rinc�n de Romos', '20414');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (747, 1, 'San Jos�', 'Rinc�n de Romos', '20415');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (748, 1, 'Presidentes de M�xico', 'Rinc�n de Romos', '20416');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (749, 1, 'Solidaridad', 'Rinc�n de Romos', '20416');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (750, 1, 'Miguel Hidalgo', 'Rinc�n de Romos', '20417');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (751, 1, 'Popular', 'Rinc�n de Romos', '20417');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (752, 1, 'La Presa', 'Rinc�n de Romos', '20420');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (753, 1, 'El Saucillo', 'Rinc�n de Romos', '20420');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (754, 1, 'El Panal', 'Rinc�n de Romos', '20420');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (755, 1, 'Potrero El Tarasco', 'Rinc�n de Romos', '20420');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (756, 1, 'Mar Negro', 'Rinc�n de Romos', '20420');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (757, 1, 'El Baj�o', 'Rinc�n de Romos', '20420');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (758, 1, 'Escaleras', 'Rinc�n de Romos', '20420');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (759, 1, 'Santa Fe', 'Rinc�n de Romos', '20423');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (760, 1, 'Candelaria', 'Rinc�n de Romos', '20423');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (761, 1, 'Tanque Blanco', 'Rinc�n de Romos', '20424');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (762, 1, 'California', 'Rinc�n de Romos', '20424');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (763, 1, 'Puerta del Muerto (El 15)', 'Rinc�n de Romos', '20424');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (764, 1, 'Yerbanis', 'Rinc�n de Romos', '20424');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (765, 1, 'San Jacinto', 'Rinc�n de Romos', '20425');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (766, 1, 'San Juan de la Natura', 'Rinc�n de Romos', '20426');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (767, 1, 'El Valle de las Delicias', 'Rinc�n de Romos', '20427');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (768, 1, 'Los Morales', 'Rinc�n de Romos', '20427');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (769, 1, '16 de Septiembre', 'Rinc�n de Romos', '20427');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (770, 1, 'San Isidro el Labrador', 'Rinc�n de Romos', '20427');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (771, 1, 'La Misi�n', 'Rinc�n de Romos', '20430');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (772, 1, '18 de Marzo', 'Rinc�n de Romos', '20434');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (773, 1, 'Lupita', 'Rinc�n de Romos', '20434');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (774, 1, 'El Barz�n', 'Rinc�n de Romos', '20435');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (775, 1, 'El Salitrillo', 'Rinc�n de Romos', '20435');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (776, 1, 'Las Norias', 'Rinc�n de Romos', '20435');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (777, 1, 'El Milagro', 'Rinc�n de Romos', '20436');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (778, 1, 'Constituci�n', 'Rinc�n de Romos', '20437');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (779, 1, 'H�ctor Hugo Olivares', 'Rinc�n de Romos', '20437');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (780, 1, 'Pabell�n de Hidalgo', 'Rinc�n de Romos', '20437');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (781, 1, 'Lindavista', 'Rinc�n de Romos', '20437');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (782, 1, 'El Canal', 'Rinc�n de Romos', '20437');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (783, 1, 'Estancia de Mosqueira', 'Rinc�n de Romos', '20437');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (784, 1, 'Morelos', 'Rinc�n de Romos', '20440');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (785, 1, 'El Potrerillo', 'Rinc�n de Romos', '20444');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (786, 1, 'T�nel de Potrerillo', 'Rinc�n de Romos', '20444');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (787, 1, 'Pe�a Blanca', 'Rinc�n de Romos', '20445');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (788, 1, 'Las Camas', 'Rinc�n de Romos', '20445');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (789, 1, 'Los Negritos', 'Rinc�n de Romos', '20446');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (790, 1, 'La Boquilla Grande', 'Rinc�n de Romos', '20446');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (791, 1, 'Rancho La Laguna de Piedra', 'Rinc�n de Romos', '20447');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (792, 1, 'Mirasoles', 'Rinc�n de Romos', '20447');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (793, 1, 'La Boquilla', 'Rinc�n de Romos', '20450');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (794, 1, 'Fresnillo', 'Rinc�n de Romos', '20450');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (795, 1, 'El Ajiladero', 'Rinc�n de Romos', '20454');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (796, 1, 'Las Rosas', 'Rinc�n de Romos', '20456');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (797, 1, 'Mesa el Conejo', 'Rinc�n de Romos', '20457');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (798, 1, 'Cos�o Centro', 'Cos�o', '20460');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (799, 1, 'Luis Donaldo Colosio', 'Cos�o', '20462');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (800, 1, 'Villas del Potrerito', 'Cos�o', '20466');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (801, 1, 'Rancho El Potrerito', 'Cos�o', '20466');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (802, 1, 'Popular', 'Cos�o', '20467');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (803, 1, 'Santa Cruz', 'Cos�o', '20468');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (804, 1, 'Mexiquito', 'Cos�o', '20469');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (805, 1, 'Coplamar', 'Cos�o', '20469');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (806, 1, 'Vista Hermosa', 'Cos�o', '20469');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (807, 1, 'Soledad de Arriba', 'Cos�o', '20470');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (808, 1, 'Zacatequillas', 'Cos�o', '20470');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (809, 1, 'Soledad de Abajo [Estaci�n de Adames]', 'Cos�o', '20470');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (810, 1, 'La Esperanza (El Salerito)', 'Cos�o', '20472');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (811, 1, 'El Durazno', 'Cos�o', '20472');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (812, 1, 'El Durazno', 'Cos�o', '20472');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (813, 1, 'La Punta', 'Cos�o', '20472');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (814, 1, 'Los Nava', 'Cos�o', '20472');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (815, 1, 'Guadalupito', 'Cos�o', '20476');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (816, 1, 'El Salero', 'Cos�o', '20476');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (817, 1, 'El Refugio de Agua Zarca', 'Cos�o', '20478');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (818, 1, 'El Refugio de Providencia (Providencia)', 'Cos�o', '20478');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (819, 1, 'Santa Mar�a de la Paz', 'Cos�o', '20478');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (820, 1, 'San Jos� de Gracia', 'San Jos� de Gracia', '20500');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (821, 1, 'El Jocoqui', 'San Jos� de Gracia', '20501');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (822, 1, 'Cieneguita', 'San Jos� de Gracia', '20502');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (823, 1, 'El Toril', 'San Jos� de Gracia', '20503');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (824, 1, 'Santa Elena de la Cruz (Capadero)', 'San Jos� de Gracia', '20504');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (825, 1, 'Las Amarillas', 'San Jos� de Gracia', '20506');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (826, 1, 'Tortugas', 'San Jos� de Gracia', '20508');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (827, 1, 'Potrerillo', 'San Jos� de Gracia', '20508');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (828, 1, 'Ci�nega de Alcorcha', 'San Jos� de Gracia', '20510');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (829, 1, 'Boca del T�nel de Potrerillo', 'San Jos� de Gracia', '20516');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (830, 1, 'La Congoja', 'San Jos� de Gracia', '20520');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (831, 1, 'La Campana', 'San Jos� de Gracia', '20525');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (832, 1, 'Baj�o de La Tienda', 'San Jos� de Gracia', '20530');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (833, 1, 'El Cepo', 'San Jos� de Gracia', '20534');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (834, 1, 'Antrialgo', 'San Jos� de Gracia', '20538');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (835, 1, 'Sierra Hermosa (Los Alamitos)', 'San Jos� de Gracia', '20538');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (836, 1, 'Paredes', 'San Jos� de Gracia', '20540');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (837, 1, 'San Antonio de los R�os', 'San Jos� de Gracia', '20545');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (838, 1, 'Santa Rosa de Lima', 'San Jos� de Gracia', '20550');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (839, 1, 'Presa del S�uz', 'San Jos� de Gracia', '20560');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (840, 1, 'Rancho Viejo', 'San Jos� de Gracia', '20564');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (841, 1, 'Potrero de los L�pez', 'San Jos� de Gracia', '20567');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (842, 1, 'El Tecongo', 'San Jos� de Gracia', '20570');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (843, 1, 'Estancia de San Marcos', 'San Jos� de Gracia', '20574');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (844, 1, 'San Jos� [Club N�utico]', 'San Jos� de Gracia', '20576');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (845, 1, 'Paso del Sauz', 'San Jos� de Gracia', '20578');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (846, 1, 'Guajolotes (Huijolotes)', 'San Jos� de Gracia', '20580');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (847, 1, 'Santa Rosa', 'San Jos� de Gracia', '20584');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (848, 1, 'El Taray', 'San Jos� de Gracia', '20590');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (849, 1, 'Tepezala Centro', 'Tepezal�', '20600');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (850, 1, 'Cholula 2a Secci�n', 'Tepezal�', '20602');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (851, 1, 'Comunidad San Rafael', 'Tepezal�', '20603');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (852, 1, 'Los Arcos', 'Tepezal�', '20603');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (853, 1, 'Del Socorro', 'Tepezal�', '20603');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (854, 1, 'Felipe Gonzalez Gonz�lez 1a Secci�n', 'Tepezal�', '20604');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (855, 1, 'Felipe Gonzalez Gonz�lez 2a Secci�n', 'Tepezal�', '20604');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (856, 1, 'La Ca�ada', 'Tepezal�', '20605');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (857, 1, 'Luis Ortega Douglas', 'Tepezal�', '20607');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (858, 1, 'Cholula 1a Secci�n', 'Tepezal�', '20608');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (859, 1, 'El Chayote', 'Tepezal�', '20610');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (860, 1, 'El Barranco', 'Tepezal�', '20610');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (861, 1, 'Las Pilas', 'Tepezal�', '20612');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (862, 1, 'San Rafael', 'Tepezal�', '20613');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (863, 1, 'Luz de San Antonio (La Luz)', 'Tepezal�', '20614');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (864, 1, 'Los Alamitos', 'Tepezal�', '20614');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (865, 1, 'Ampliaci�n los Hornos (el Lagunazo)', 'Tepezal�', '20614');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (866, 1, 'El Progreso (La Tira)', 'Tepezal�', '20615');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (867, 1, 'El Carmen', 'Tepezal�', '20615');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (868, 1, 'El Porvenir', 'Tepezal�', '20615');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (869, 1, 'San Antonio', 'Tepezal�', '20616');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (870, 1, 'Mesillas', 'Tepezal�', '20620');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (871, 1, 'Ojo de Agua de los Montes', 'Tepezal�', '20622');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (872, 1, 'La Victoria', 'Tepezal�', '20634');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (873, 1, 'El �guila', 'Tepezal�', '20637');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (874, 1, 'El Gigante', 'Tepezal�', '20637');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (875, 1, 'Reyes', 'Tepezal�', '20645');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (876, 1, 'El Zorrillo', 'Tepezal�', '20645');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (877, 1, 'Puerto de la Concepci�n', 'Tepezal�', '20650');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (878, 1, 'Los Hornos', 'Tepezal�', '20654');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (879, 1, 'El Refugio', 'Tepezal�', '20656');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (880, 1, 'Carboneras', 'Tepezal�', '20656');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (881, 1, 'Arroyo Hondo', 'Tepezal�', '20657');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (882, 1, 'El Tepoz�n', 'Tepezal�', '20658');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (883, 1, 'Caldera', 'Tepezal�', '20659');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (884, 1, 'El Refugio', 'Pabell�n de Arteaga', '20663');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (885, 1, 'El Gigante', 'Pabell�n de Arteaga', '20663');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (886, 1, 'Los Corrales (Los Corrales Blancos)', 'Pabell�n de Arteaga', '20664');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (887, 1, 'Nueva', 'Pabell�n de Arteaga', '20664');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (888, 1, 'El Pilar', 'Pabell�n de Arteaga', '20665');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (889, 1, 'Los Contreras', 'Pabell�n de Arteaga', '20665');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (890, 1, 'San Agust�n de los Puentes', 'Pabell�n de Arteaga', '20665');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (891, 1, 'Emiliano Zapata', 'Pabell�n de Arteaga', '20665');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (892, 1, 'El Pedernal Segundo', 'Pabell�n de Arteaga', '20665');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (893, 1, 'Campestre San Carlos', 'Pabell�n de Arteaga', '20666');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (894, 1, 'El Garabato', 'Pabell�n de Arteaga', '20666');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (895, 1, 'Estancia de Mosqueira', 'Pabell�n de Arteaga', '20667');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (896, 1, 'El Canal', 'Pabell�n de Arteaga', '20667');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (897, 1, 'Santiago', 'Pabell�n de Arteaga', '20667');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (898, 1, 'Canal Grande', 'Pabell�n de Arteaga', '20667');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (899, 1, 'Ampliaci�n Ejido Garabato', 'Pabell�n de Arteaga', '20668');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (900, 1, 'Miguel Alem�n [Secadora]', 'Pabell�n de Arteaga', '20668');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (901, 1, 'El Milagro', 'Pabell�n de Arteaga', '20668');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (902, 1, 'Puerta del Milagro', 'Pabell�n de Arteaga', '20668');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (903, 1, 'El Pedregal', 'Pabell�n de Arteaga', '20668');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (904, 1, 'San Luis de Letras', 'Pabell�n de Arteaga', '20668');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (905, 1, 'Zona Centro', 'Pabell�n de Arteaga', '20670');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (906, 1, 'Jardines de Pabell�n', 'Pabell�n de Arteaga', '20673');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (907, 1, 'FOVISSSTE', 'Pabell�n de Arteaga', '20673');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (908, 1, 'Barrio Industrial', 'Pabell�n de Arteaga', '20673');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (909, 1, 'Subdivisi�n Haciendas de Pabell�n', 'Pabell�n de Arteaga', '20673');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (910, 1, 'Francisco Villa', 'Pabell�n de Arteaga', '20674');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (911, 1, 'Villas de Pabell�n', 'Pabell�n de Arteaga', '20674');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (912, 1, 'Trojes de San Pedro', 'Pabell�n de Arteaga', '20674');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (913, 1, 'Carboneras', 'Pabell�n de Arteaga', '20675');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (914, 1, 'Palo Alto', 'Pabell�n de Arteaga', '20675');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (915, 1, 'Popular', 'Pabell�n de Arteaga', '20676');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (916, 1, 'Cosmos', 'Pabell�n de Arteaga', '20676');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (917, 1, '5 de Mayo', 'Pabell�n de Arteaga', '20676');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (918, 1, 'Plutarco El�as Calles', 'Pabell�n de Arteaga', '20677');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (919, 1, 'Progreso Sur', 'Pabell�n de Arteaga', '20677');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (920, 1, 'La Queser�a de Los Serna', 'Pabell�n de Arteaga', '20678');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (921, 1, 'Valle del Vivero', 'Pabell�n de Arteaga', '20678');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (922, 1, 'Subdivisi�n Villa de Guadalupe', 'Pabell�n de Arteaga', '20678');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (923, 1, 'Valle del Vivero II', 'Pabell�n de Arteaga', '20678');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (924, 1, 'Progreso Norte', 'Pabell�n de Arteaga', '20678');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (925, 1, 'Vergel del Valle', 'Pabell�n de Arteaga', '20678');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (926, 1, 'Las �nimas', 'Pabell�n de Arteaga', '20680');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (927, 1, 'Las �nimas', 'Pabell�n de Arteaga', '20680');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (928, 1, 'Santa Isabel', 'Pabell�n de Arteaga', '20680');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (929, 1, 'Estaci�n Garabato', 'Pabell�n de Arteaga', '20680');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (930, 1, 'El Mezquite (Ojo de Agua del Mezquite)', 'Pabell�n de Arteaga', '20683');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (931, 1, 'Los Lira', 'Pabell�n de Arteaga', '20683');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (932, 1, 'El Mezquite', 'Pabell�n de Arteaga', '20683');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (933, 1, 'El Mezquite', 'Pabell�n de Arteaga', '20683');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (934, 1, 'Ojo Zarco', 'Pabell�n de Arteaga', '20684');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (935, 1, 'Ojo Zarco (La Loma)', 'Pabell�n de Arteaga', '20684');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (936, 1, 'Ojo Zarco', 'Pabell�n de Arteaga', '20684');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (937, 1, 'El Rayo', 'Pabell�n de Arteaga', '20684');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (938, 1, 'G�mez Orozco (Puerta de Carboneras)', 'Pabell�n de Arteaga', '20686');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (939, 1, 'San Pedro', 'Pabell�n de Arteaga', '20686');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (940, 1, 'El Cerrito', 'Pabell�n de Arteaga', '20687');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (941, 1, 'Guadalupe', 'Asientos', '20700');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (942, 1, 'El Rasc�n (La Loma)', 'Asientos', '20700');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (943, 1, 'Villa Ju�rez', 'Asientos', '20700');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (944, 1, 'La Loma (Tanque de Las Palmitas)', 'Asientos', '20700');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (945, 1, 'Loma Bonita', 'Asientos', '20700');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (946, 1, '�lamos', 'Asientos', '20700');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (947, 1, 'El Tule', 'Asientos', '20700');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (948, 1, 'La Esperanza', 'Asientos', '20700');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (949, 1, 'Aguanueva', 'Asientos', '20700');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (950, 1, 'La Sierra', 'Asientos', '20700');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (951, 1, 'Viudas de Poniente', 'Asientos', '20704');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (952, 1, 'Charco Azul', 'Asientos', '20705');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (953, 1, 'Amarillas de Esparza', 'Asientos', '20708');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (954, 1, 'La Dichosa', 'Asientos', '20709');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (955, 1, 'Jilotepec', 'Asientos', '20709');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (956, 1, 'Asientos Centro', 'Asientos', '20710');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (957, 1, 'Santa Cruz', 'Asientos', '20710');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (958, 1, 'De Pe�itas 1a Secci�n', 'Asientos', '20712');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (959, 1, 'Los Tepetates', 'Asientos', '20713');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (960, 1, 'Del CECYTE', 'Asientos', '20713');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (961, 1, 'De Guadalupe', 'Asientos', '20714');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (962, 1, 'Del Tepoz�n', 'Asientos', '20715');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (963, 1, 'INFONAVIT', 'Asientos', '20715');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (964, 1, 'Juventud', 'Asientos', '20715');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (965, 1, 'De Pe�itas 2a Secci�n', 'Asientos', '20716');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (966, 1, 'Real Minero', 'Asientos', '20717');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (967, 1, 'Sector de Producci�n N�mero 2', 'Asientos', '20720');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (968, 1, 'Bimbaletes Atlas (Tanque de la Vieja)', 'Asientos', '20720');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (969, 1, 'Alvarado', 'Asientos', '20720');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (970, 1, 'Sector de Producci�n N�mero 3', 'Asientos', '20720');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (971, 1, 'Sociedad los Posada', 'Asientos', '20720');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (972, 1, 'Guadalupe de Atlas', 'Asientos', '20720');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (973, 1, 'Bimbaletes Aguascalientes (El �lamo)', 'Asientos', '20720');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (974, 1, 'Licenciado Adolfo L�pez Mateos', 'Asientos', '20720');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (975, 1, 'Cris�stomos', 'Asientos', '20720');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (976, 1, 'La Divina Providencia', 'Asientos', '20720');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (977, 1, 'San Gil', 'Asientos', '20720');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (978, 1, 'Plutarco El�as Calles', 'Asientos', '20721');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (979, 1, 'Ci�nega Grande', 'Asientos', '20722');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (980, 1, 'Noria del Borrego (Norias)', 'Asientos', '20723');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (981, 1, 'Jarillas', 'Asientos', '20723');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (982, 1, 'G�mez Portugal', 'Asientos', '20724');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (983, 1, 'Pino Su�rez (Rancho Viejo)', 'Asientos', '20727');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (984, 1, 'Berrendos', 'Asientos', '20728');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (985, 1, 'Clavellinas', 'Asientos', '20729');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (986, 1, 'Molinos', 'Asientos', '20730');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (987, 1, 'Los Encinos', 'Asientos', '20732');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (988, 1, 'L�zaro C�rdenas', 'Asientos', '20734');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (989, 1, 'La Gloria', 'Asientos', '20736');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (990, 1, 'La Soledad', 'Asientos', '20738');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (991, 1, 'San Pedro', 'Asientos', '20739');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (992, 1, 'El Polvo', 'Asientos', '20740');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (993, 1, 'Caldera', 'Asientos', '20741');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (994, 1, 'Santuario del Tepoz�n', 'Asientos', '20741');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (995, 1, 'El F�nix', 'Asientos', '20742');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (996, 1, 'Licenciado Adolfo L�pez Mateos', 'Asientos', '20742');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (997, 1, 'Charco Prieto (El Palomar)', 'Asientos', '20742');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (998, 1, 'San Antonio de los Mart�nez', 'Asientos', '20744');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (999, 1, 'Gorriones', 'Asientos', '20746');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1000, 1, 'Ojo de Agua de Rosales', 'Asientos', '20748');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1001, 1, 'Tepetatillo', 'Asientos', '20749');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1002, 1, 'San Jos� del R�o', 'Asientos', '20750');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1003, 1, 'El Llavero', 'Asientos', '20760');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1004, 1, 'San Vicente', 'Asientos', '20765');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1005, 1, 'El �guila [Rancho]', 'Asientos', '20768');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1006, 1, 'Emancipaci�n (Borunda)', 'Asientos', '20770');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1007, 1, 'Tanque Viejo', 'Asientos', '20771');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1008, 1, 'Las Adjuntas', 'Asientos', '20773');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1009, 1, 'La Tinajuela', 'Asientos', '20773');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1010, 1, 'Tanque de Guadalupe', 'Asientos', '20775');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1011, 1, 'Las Joyas', 'Asientos', '20777');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1012, 1, 'Ojo de Agua de los Sauces', 'Asientos', '20779');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1013, 1, 'San Jos� del Tulillo', 'Asientos', '20780');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1014, 1, 'San Rafael de Ocampo', 'Asientos', '20780');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1015, 1, 'San Isidro', 'Asientos', '20782');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1016, 1, 'El Chonguillo', 'Asientos', '20785');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1017, 1, 'Francisco Villa', 'Asientos', '20790');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1018, 1, 'El Epazote', 'Asientos', '20792');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1019, 1, 'Las Fraguas', 'Asientos', '20794');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1020, 1, 'Pilotos', 'Asientos', '20795');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1021, 1, 'El Salitre', 'Asientos', '20796');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1022, 1, 'El Baj�o de los Campos', 'Asientos', '20796');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1023, 1, 'Baj�o del Salitre', 'Asientos', '20797');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1024, 1, 'Las Negritas', 'Asientos', '20799');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1025, 1, 'Calvillo Centro', 'Calvillo', '20800');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1026, 1, 'Vista Hermosa', 'Calvillo', '20802');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1027, 1, 'Secci�n Loma de Fundadores', 'Calvillo', '20802');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1028, 1, 'Vista Hermosa 2a. Secci�n', 'Calvillo', '20802');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1029, 1, 'El Mirador', 'Calvillo', '20802');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1030, 1, 'Lopez Mateos', 'Calvillo', '20802');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1031, 1, 'Secci�n Benito Ju�rez', 'Calvillo', '20802');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1032, 1, 'Zona Militar XIV', 'Calvillo', '20802');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1033, 1, 'Las Paseras', 'Calvillo', '20802');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1034, 1, 'Independencia', 'Calvillo', '20802');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1035, 1, 'Secci�n Cerritos', 'Calvillo', '20802');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1036, 1, 'Lomas de Huej�car', 'Calvillo', '20803');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1037, 1, 'San Rafael', 'Calvillo', '20803');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1038, 1, 'Rinc�n de Baltazares', 'Calvillo', '20803');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1039, 1, 'San Nicol�s', 'Calvillo', '20803');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1040, 1, 'Jos� Landeros', 'Calvillo', '20803');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1041, 1, 'Magisterial', 'Calvillo', '20804');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1042, 1, 'Liberal', 'Calvillo', '20804');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1043, 1, 'Rinc�n de Baltazares', 'Calvillo', '20804');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1044, 1, 'La Fortuna', 'Calvillo', '20804');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1045, 1, 'Morelos', 'Calvillo', '20804');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1046, 1, 'Los Arcos', 'Calvillo', '20804');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1047, 1, 'Arroyo de Los Caballos', 'Calvillo', '20804');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1048, 1, 'Valle de Santiago', 'Calvillo', '20804');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1049, 1, 'Del Carmen', 'Calvillo', '20804');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1050, 1, 'Azteca', 'Calvillo', '20804');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1051, 1, 'Ejidal', 'Calvillo', '20804');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1052, 1, 'Los Angeles', 'Calvillo', '20805');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1053, 1, 'Cerrito Alto', 'Calvillo', '20805');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1054, 1, 'Chicago', 'Calvillo', '20805');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1055, 1, 'Martinez', 'Calvillo', '20805');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1056, 1, 'Las Flores', 'Calvillo', '20805');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1057, 1, 'Valle de Huej�car', 'Calvillo', '20805');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1058, 1, 'Emiliano Zapata', 'Calvillo', '20805');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1059, 1, 'Palo Alto', 'Calvillo', '20810');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1060, 1, 'El Terrero de la Labor', 'Calvillo', '20810');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1061, 1, 'Terrero de S�uz', 'Calvillo', '20814');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1062, 1, 'Las Cuevas de la Labor', 'Calvillo', '20816');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1063, 1, 'El Zapote de la Labor', 'Calvillo', '20816');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1064, 1, 'El Sauz de la Labor', 'Calvillo', '20816');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1065, 1, 'Piedras Chinas', 'Calvillo', '20816');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1066, 1, 'Las Rubias', 'Calvillo', '20816');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1067, 1, 'El Molino', 'Calvillo', '20816');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1068, 1, 'El Jag�ey', 'Calvillo', '20820');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1069, 1, 'Las Duraznillas', 'Calvillo', '20820');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1070, 1, 'Jardines de San Isidro (Colonia Lim�n)', 'Calvillo', '20820');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1071, 1, 'San Tadeo', 'Calvillo', '20820');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1072, 1, 'El Mirador', 'Calvillo', '20820');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1073, 1, 'Solidaridad', 'Calvillo', '20820');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1074, 1, 'El Capul�n', 'Calvillo', '20824');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1075, 1, 'Los Lazos', 'Calvillo', '20824');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1076, 1, 'Los Mu�oz', 'Calvillo', '20824');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1077, 1, 'Montoro', 'Calvillo', '20824');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1078, 1, 'Villas del Laurel', 'Calvillo', '20830');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1079, 1, 'Colomos', 'Calvillo', '20830');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1080, 1, 'Chiquihuitero (San Isidro)', 'Calvillo', '20830');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1081, 1, 'La Panadera', 'Calvillo', '20830');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1082, 1, 'Las V�boras (Viborillas)', 'Calvillo', '20830');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1083, 1, 'El Llano (El Llano de San Rafael)', 'Calvillo', '20830');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1084, 1, 'R�o de Gil de Arriba', 'Calvillo', '20832');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1085, 1, 'El Maguey', 'Calvillo', '20832');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1086, 1, 'El Sauz', 'Calvillo', '20832');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1087, 1, 'San Jos� del R�o', 'Calvillo', '20834');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1088, 1, 'El Cuervero', 'Calvillo', '20834');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1089, 1, 'Catana', 'Calvillo', '20834');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1090, 1, 'Junta de los R�os', 'Calvillo', '20834');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1091, 1, 'Potrero de los Lopez', 'Calvillo', '20834');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1092, 1, 'R�o de Gil de Abajo', 'Calvillo', '20834');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1093, 1, 'Ojocaliente', 'Calvillo', '20834');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1094, 1, 'Malpaso', 'Calvillo', '20834');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1095, 1, 'El Potrerito', 'Calvillo', '20840');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1096, 1, 'Los Mirasoles', 'Calvillo', '20840');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1097, 1, 'Las Joyas', 'Calvillo', '20842');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1098, 1, 'Los Lobos', 'Calvillo', '20842');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1099, 1, 'El Mirasol', 'Calvillo', '20842');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1100, 1, 'El Laurel', 'Calvillo', '20844');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1101, 1, 'Chinantitl�n', 'Calvillo', '20844');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1102, 1, 'Mesa de los Pozos (La Laguna)', 'Calvillo', '20844');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1103, 1, 'Crucero las Pilas', 'Calvillo', '20850');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1104, 1, 'Las Moras', 'Calvillo', '20850');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1105, 1, 'La Calixtina', 'Calvillo', '20850');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1106, 1, 'Mesa Grande', 'Calvillo', '20850');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1107, 1, 'El Refugio (Las Praderas)', 'Calvillo', '20850');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1108, 1, 'Tepezalilla de Abajo', 'Calvillo', '20850');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1109, 1, 'Pozo de los Artistas', 'Calvillo', '20850');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1110, 1, 'Los Adobes', 'Calvillo', '20852');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1111, 1, 'Arroyo Ojocalientillo', 'Calvillo', '20852');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1112, 1, 'Parque Industrial Calvillo', 'Calvillo', '20854');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1113, 1, 'El Taray', 'Calvillo', '20854');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1114, 1, 'Ojo de Agua', 'Calvillo', '20854');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1115, 1, 'El Tepetate de Abajo', 'Calvillo', '20854');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1116, 1, 'Los Alisos', 'Calvillo', '20854');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1117, 1, 'El Garru�o', 'Calvillo', '20854');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1118, 1, 'El G�encho', 'Calvillo', '20856');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1119, 1, 'Mesa del Roble', 'Calvillo', '20856');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1120, 1, 'Barranca del Roble', 'Calvillo', '20856');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1121, 1, 'Jaltiche de Arriba', 'Calvillo', '20856');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1122, 1, 'Michoacanejo', 'Calvillo', '20860');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1123, 1, 'Las Pilas', 'Calvillo', '20860');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1124, 1, 'Cerro Blanco', 'Calvillo', '20860');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1125, 1, 'El Salitre', 'Calvillo', '20860');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1126, 1, 'Las �nimas', 'Calvillo', '20860');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1127, 1, 'La Media Luna', 'Calvillo', '20862');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1128, 1, 'Salitrillo', 'Calvillo', '20862');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1129, 1, 'La Fragua', 'Calvillo', '20862');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1130, 1, 'Las Tinajas', 'Calvillo', '20862');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1131, 1, 'Jaltiche de Abajo', 'Calvillo', '20862');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1132, 1, 'La Rinconada', 'Calvillo', '20862');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1133, 1, 'El Terrero del Refugio', 'Calvillo', '20864');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1134, 1, 'Presa de los Serna', 'Calvillo', '20864');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1135, 1, 'El Caracol', 'Calvillo', '20864');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1136, 1, 'Mezquitillos', 'Calvillo', '20870');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1137, 1, 'El Papant�n', 'Calvillo', '20870');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1138, 1, 'Vaquer�as', 'Calvillo', '20870');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1139, 1, 'La Teresa', 'Calvillo', '20870');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1140, 1, 'El Guayabo', 'Calvillo', '20870');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1141, 1, 'San Jos�', 'Calvillo', '20870');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1142, 1, 'Santos', 'Calvillo', '20870');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1143, 1, 'El Rodeo', 'Calvillo', '20870');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1144, 1, 'Los Patos', 'Calvillo', '20870');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1145, 1, 'Pe�a Blanca', 'Calvillo', '20870');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1146, 1, 'Barranca de Portales', 'Calvillo', '20872');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1147, 1, 'El Tigre', 'Calvillo', '20872');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1148, 1, 'Miguel Hidalgo (El Huarache)', 'Calvillo', '20872');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1149, 1, 'El Tepalcate', 'Calvillo', '20874');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1150, 1, 'El Ocote [Banco de Tierra]', 'Calvillo', '20874');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1151, 1, 'La Joya', 'Calvillo', '20874');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1152, 1, 'Las Trojes', 'Calvillo', '20874');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1153, 1, 'Tanque de los Serna', 'Calvillo', '20874');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1154, 1, 'Temazcal', 'Calvillo', '20880');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1155, 1, 'Ventanillas', 'Calvillo', '20880');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1156, 1, 'La Primavera', 'Calvillo', '20880');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1157, 1, 'El Salitrillo', 'Calvillo', '20880');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1158, 1, 'La Labor', 'Calvillo', '20880');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1159, 1, 'Presa Orde�a Vieja', 'Calvillo', '20880');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1160, 1, 'La Hiedra', 'Calvillo', '20880');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1161, 1, 'Paredes', 'Calvillo', '20880');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1162, 1, 'El Jaralito', 'Calvillo', '20882');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1163, 1, 'El Tepoz�n', 'Calvillo', '20882');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1164, 1, 'Manguillas', 'Calvillo', '20882');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1165, 1, 'La Pedrera', 'Calvillo', '20882');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1166, 1, 'Presa de los Baj�os', 'Calvillo', '20884');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1167, 1, 'La Ci�nega', 'Calvillo', '20884');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1168, 1, 'Puerta de Fragua (Presa la Codorniz)', 'Calvillo', '20890');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1169, 1, 'La Boquilla', 'Calvillo', '20892');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1170, 1, 'Santo Domingo', 'Jes�s Mar�a', '20900');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1171, 1, 'Puerta Norte', 'Jes�s Mar�a', '20900');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1172, 1, 'Corral de Barrancos', 'Jes�s Mar�a', '20900');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1173, 1, 'Trojes del Norte II', 'Jes�s Mar�a', '20900');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1174, 1, 'Valle Escondido', 'Jes�s Mar�a', '20900');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1175, 1, 'Las P�rgolas', 'Jes�s Mar�a', '20900');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1176, 1, 'Residencial Misi�n de San Jos�', 'Jes�s Mar�a', '20900');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1177, 1, 'Residencial Campestre Ingles', 'Jes�s Mar�a', '20900');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1178, 1, 'Maravillas', 'Jes�s Mar�a', '20900');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1179, 1, 'Rinconada Maravillas', 'Jes�s Mar�a', '20900');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1180, 1, 'Trojes del Norte', 'Jes�s Mar�a', '20900');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1181, 1, 'Los Olivos', 'Jes�s Mar�a', '20900');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1182, 1, 'La Nogalera', 'Jes�s Mar�a', '20900');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1183, 1, 'Residencial Villa Campestre', 'Jes�s Mar�a', '20900');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1184, 1, 'El Maguey', 'Jes�s Mar�a', '20901');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1185, 1, 'Las Jaulas', 'Jes�s Mar�a', '20901');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1186, 1, 'La Loma de Valladolid', 'Jes�s Mar�a', '20901');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1187, 1, 'La Chave�a', 'Jes�s Mar�a', '20901');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1188, 1, 'La Loma', 'Jes�s Mar�a', '20902');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1189, 1, 'La Florida', 'Jes�s Mar�a', '20903');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1190, 1, 'Villas de Montecassino', 'Jes�s Mar�a', '20903');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1191, 1, 'Margaritas', 'Jes�s Mar�a', '20903');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1192, 1, 'Los Ram�rez', 'Jes�s Mar�a', '20904');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1193, 1, 'Los V�zquez', 'Jes�s Mar�a', '20904');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1194, 1, 'Miravalle', 'Jes�s Mar�a', '20905');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1195, 1, 'Paso Blanco', 'Jes�s Mar�a', '20905');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1196, 1, 'Los Sauces', 'Jes�s Mar�a', '20905');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1197, 1, 'Los Arenales', 'Jes�s Mar�a', '20905');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1198, 1, 'La Lomita de Paso Blanco (Las Canoas)', 'Jes�s Mar�a', '20905');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1199, 1, 'Vi�edos Frutilandia', 'Jes�s Mar�a', '20907');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1200, 1, 'Vi�edos R�os (Granja Chispiritos)', 'Jes�s Mar�a', '20907');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1201, 1, 'Santa Elena', 'Jes�s Mar�a', '20907');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1202, 1, 'Arboledas de Paso Blanco', 'Jes�s Mar�a', '20907');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1203, 1, 'Centro Distribuidor de B�sicos Vi�edos San Marcos', 'Jes�s Mar�a', '20907');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1204, 1, 'San Miguelito', 'Jes�s Mar�a', '20907');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1205, 1, 'Paseos del Country', 'Jes�s Mar�a', '20907');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1206, 1, 'Jardines de Campo Real', 'Jes�s Mar�a', '20907');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1207, 1, 'Paseos de Aguascalientes', 'Jes�s Mar�a', '20907');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1208, 1, 'Residencial Campo Real', 'Jes�s Mar�a', '20907');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1209, 1, 'Reserva San Crist�bal', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1210, 1, 'Residencial Marcellana', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1211, 1, 'Rinconada Cuauht�moc', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1212, 1, 'Punta Norte', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1213, 1, 'Los Gavilanes', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1214, 1, 'Vi�a Antigua', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1215, 1, 'Rancho San Miguel', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1216, 1, 'Alc�zar Residencial', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1217, 1, 'La Arborada', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1218, 1, 'Granja Lizzy', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1219, 1, 'Nura', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1220, 1, 'Andares', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1221, 1, 'Tepetates', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1222, 1, 'Villas del Molino', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1223, 1, 'Residencial Cedros', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1224, 1, 'Catania Spazio', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1225, 1, 'Porta Real', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1226, 1, 'Belmondo', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1227, 1, 'Mayorazgo San Crist�bal', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1228, 1, 'Trojes de San Crist�bal', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1229, 1, 'Quintas de Monticello', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1230, 1, 'Privanza de Gratamira', 'Jes�s Mar�a', '20908');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1231, 1, 'Paso de Argenta', 'Jes�s Mar�a', '20909');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1232, 1, 'Valle de Margaritas', 'Jes�s Mar�a', '20909');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1233, 1, 'Los V�zquez', 'Jes�s Mar�a', '20909');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1234, 1, 'El Zapato', 'Jes�s Mar�a', '20909');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1235, 1, 'Saturnino Herran', 'Jes�s Mar�a', '20909');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1236, 1, 'Paseos G�mez Portugal', 'Jes�s Mar�a', '20909');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1237, 1, 'La Guayana (Rancho Seco)', 'Jes�s Mar�a', '20909');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1238, 1, 'Villas del Sol', 'Jes�s Mar�a', '20909');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1239, 1, 'Jes�s G�mez Portugal (Margaritas)', 'Jes�s Mar�a', '20909');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1240, 1, 'INFONAVIT Margaritas', 'Jes�s Mar�a', '20909');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1241, 1, 'San Antonio de los Horcones', 'Jes�s Mar�a', '20910');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1242, 1, 'Brownsville', 'Jes�s Mar�a', '20910');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1243, 1, 'El Aurero', 'Jes�s Mar�a', '20913');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1244, 1, 'El Refugio', 'Jes�s Mar�a', '20913');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1245, 1, 'El Cenizo', 'Jes�s Mar�a', '20913');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1246, 1, 'Valladolid', 'Jes�s Mar�a', '20913');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1247, 1, 'Villas de Guadalupe (La Malobra)', 'Jes�s Mar�a', '20913');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1248, 1, 'La Granjita (Los Palillos)', 'Jes�s Mar�a', '20914');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1249, 1, 'Cartuja', 'Jes�s Mar�a', '20916');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1250, 1, 'Paseos de las Haciendas', 'Jes�s Mar�a', '20916');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1251, 1, 'Parque Industrial Chichimeco', 'Jes�s Mar�a', '20916');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1252, 1, 'El Chichimeco', 'Jes�s Mar�a', '20916');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1253, 1, 'Pedernal Segundo', 'Jes�s Mar�a', '20917');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1254, 1, 'Jes�s Mar�a Centro', 'Jes�s Mar�a', '20920');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1255, 1, 'El Calvario', 'Jes�s Mar�a', '20922');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1256, 1, 'La Escalera', 'Jes�s Mar�a', '20922');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1257, 1, 'Bellavista', 'Jes�s Mar�a', '20922');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1258, 1, 'La Troje', 'Jes�s Mar�a', '20922');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1259, 1, 'Los �lamos', 'Jes�s Mar�a', '20923');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1260, 1, 'Real Campestre', 'Jes�s Mar�a', '20923');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1261, 1, 'La Villa Residencial', 'Jes�s Mar�a', '20923');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1262, 1, 'Flores Mag�n', 'Jes�s Mar�a', '20923');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1263, 1, 'La Cardona', 'Jes�s Mar�a', '20923');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1264, 1, 'San Miguelito', 'Jes�s Mar�a', '20923');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1265, 1, 'Las Culebras', 'Jes�s Mar�a', '20923');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1266, 1, 'Ruise�ores', 'Jes�s Mar�a', '20923');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1267, 1, 'Los Arroyitos', 'Jes�s Mar�a', '20923');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1268, 1, 'Rinconada Jes�s Mar�a', 'Jes�s Mar�a', '20923');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1269, 1, 'La Cuesta', 'Jes�s Mar�a', '20923');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1270, 1, 'Residencial Jes�s Mar�a', 'Jes�s Mar�a', '20923');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1271, 1, 'Los Manantiales', 'Jes�s Mar�a', '20924');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1272, 1, 'Rancho San Pedro', 'Jes�s Mar�a', '20924');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1273, 1, 'Cielo Claro', 'Jes�s Mar�a', '20924');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1274, 1, 'Deportiva', 'Jes�s Mar�a', '20924');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1275, 1, 'San Miguelito', 'Jes�s Mar�a', '20924');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1276, 1, 'Agua Clara', 'Jes�s Mar�a', '20924');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1277, 1, 'Jacarandas', 'Jes�s Mar�a', '20924');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1278, 1, 'Palma Dorada', 'Jes�s Mar�a', '20924');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1279, 1, 'Lomas de Jes�s Mar�a', 'Jes�s Mar�a', '20925');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1280, 1, 'Benigno Ch�vez', 'Jes�s Mar�a', '20925');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1281, 1, 'Puerta Grande', 'Jes�s Mar�a', '20925');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1282, 1, 'Agua Zarca', 'Jes�s Mar�a', '20925');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1283, 1, 'Vistas del S�uz', 'Jes�s Mar�a', '20925');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1284, 1, 'Mart�nez Andrade', 'Jes�s Mar�a', '20926');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1285, 1, 'Manantiales del Pinar', 'Jes�s Mar�a', '20926');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1286, 1, 'Loma de La Ca�ada', 'Jes�s Mar�a', '20926');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1287, 1, 'Residencial Lomas de Vergeles', 'Jes�s Mar�a', '20926');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1288, 1, 'Mirabrujas', 'Jes�s Mar�a', '20926');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1289, 1, 'Solidaridad', 'Jes�s Mar�a', '20926');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1290, 1, 'Rinconada Bugambilias', 'Jes�s Mar�a', '20926');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1291, 1, 'La Loma', 'Jes�s Mar�a', '20926');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1292, 1, 'Chicahuales', 'Jes�s Mar�a', '20926');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1293, 1, 'La Loma', 'Jes�s Mar�a', '20926');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1294, 1, 'Residencial Tres Arroyos', 'Jes�s Mar�a', '20926');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1295, 1, 'Rinc�n del Pilar', 'Jes�s Mar�a', '20926');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1296, 1, 'Arboledas', 'Jes�s Mar�a', '20926');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1297, 1, 'Lomas del Valle', 'Jes�s Mar�a', '20926');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1298, 1, 'Vista Hermosa', 'Jes�s Mar�a', '20926');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1299, 1, 'Misi�n de Santa Mar�a', 'Jes�s Mar�a', '20926');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1300, 1, 'Yalta Campestre', 'Jes�s Mar�a', '20926');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1301, 1, 'La Palma', 'Jes�s Mar�a', '20926');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1302, 1, 'La Piedra', 'Jes�s Mar�a', '20926');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1303, 1, 'Tulipanes Residencial', 'Jes�s Mar�a', '20926');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1304, 1, 'Ampliaci�n La Ca�ada', 'Jes�s Mar�a', '20927');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1305, 1, 'Ayuntamiento', 'Jes�s Mar�a', '20927');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1306, 1, 'La Ca�ada', 'Jes�s Mar�a', '20927');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1307, 1, 'Ojos de Agua', 'Jes�s Mar�a', '20927');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1308, 1, 'Ejidal', 'Jes�s Mar�a', '20928');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1309, 1, 'El Torito', 'Jes�s Mar�a', '20928');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1310, 1, 'Solar de Jonacatique', 'Jes�s Mar�a', '20928');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1311, 1, 'Luis Donaldo Colosio', 'Jes�s Mar�a', '20928');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1312, 1, 'El Mezquital', 'Jes�s Mar�a', '20928');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1313, 1, 'Las Palmas', 'Jes�s Mar�a', '20928');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1314, 1, 'Plan Benito Ju�rez', 'Jes�s Mar�a', '20928');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1315, 1, 'Buenavista', 'Jes�s Mar�a', '20928');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1316, 1, 'El Chave�o', 'Jes�s Mar�a', '20928');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1317, 1, 'Uni�n de Ladrilleros', 'Jes�s Mar�a', '20933');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1318, 1, 'San Lorenzo', 'Jes�s Mar�a', '20934');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1319, 1, 'Milpillas de Abajo', 'Jes�s Mar�a', '20943');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1320, 1, 'Los Mu�oz', 'Jes�s Mar�a', '20943');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1321, 1, 'Milpilla de Arriba', 'Jes�s Mar�a', '20945');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1322, 1, 'El Zapote', 'Jes�s Mar�a', '20947');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1323, 1, 'Gracias a Dios', 'Jes�s Mar�a', '20947');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1324, 1, 'Ca�ada de Rodeo', 'Jes�s Mar�a', '20953');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1325, 1, 'La Mesa del Contadero (El Contadero)', 'Jes�s Mar�a', '20955');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1326, 1, 'San Rafael', 'Jes�s Mar�a', '20955');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1327, 1, 'Piedras Negras', 'Jes�s Mar�a', '20956');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1328, 1, 'San Isidro', 'Jes�s Mar�a', '20957');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1329, 1, 'Pedernal Primero', 'Jes�s Mar�a', '20957');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1330, 1, 'El Rinc�n de la Virgen (El Rinc�n)', 'Jes�s Mar�a', '20957');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1331, 1, 'El Pensamiento', 'Jes�s Mar�a', '20964');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1332, 1, 'Puente de Villalpando (El Puente)', 'Jes�s Mar�a', '20970');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1333, 1, 'Tapias Viejas', 'Jes�s Mar�a', '20970');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1334, 1, 'Puentes Cuates', 'Jes�s Mar�a', '20974');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1335, 1, 'Trojes del Pedregal', 'Jes�s Mar�a', '20983');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1336, 1, 'La Troje II', 'Jes�s Mar�a', '20983');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1337, 1, 'Real del Molino', 'Jes�s Mar�a', '20983');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1338, 1, 'Residencial Antiguo Country', 'Jes�s Mar�a', '20983');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1339, 1, 'El Llano', 'Jes�s Mar�a', '20983');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1340, 1, 'Providencia', 'Jes�s Mar�a', '20984');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1341, 1, 'El Conejo (Puerta del Llano)', 'Jes�s Mar�a', '20986');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1342, 1, 'Buenavista', 'Jes�s Mar�a', '20990');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1343, 1, 'General Ignacio Zaragoza (Venadero)', 'Jes�s Mar�a', '20990');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1344, 1, 'La Estancia', 'Jes�s Mar�a', '20994');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1345, 1, 'La Tomatina', 'Jes�s Mar�a', '20994');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1346, 1, 'Cieneguitas', 'Jes�s Mar�a', '20994');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1347, 1, 'Agua Zarca', 'Jes�s Mar�a', '20995');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1348, 1, 'Los Arquitos', 'Jes�s Mar�a', '20996');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1349, 1, 'La Primavera', 'Jes�s Mar�a', '20996');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1350, 1, 'Ruscello', 'Jes�s Mar�a', '20997');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1351, 1, 'Q Campestre Residencial', 'Jes�s Mar�a', '20997');
INSERT INTO `massiva2019`.`colonias` (`id`, `estado_id`, `colonia`, `alcaldia_municipio`, `cp`) VALUES (1352, 1, 'El Chacho', 'Jes�s Mar�a', '20997');

COMMIT;


-- -----------------------------------------------------
-- Data for table `massiva2019`.`soporte_categorias`
-- -----------------------------------------------------
START TRANSACTION;
USE `massiva2019`;
INSERT INTO `massiva2019`.`soporte_categorias` (`id`, `categoria`, `clave`, `tipo`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'Generación de facturación', 'C01', 1, 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`soporte_categorias` (`id`, `categoria`, `clave`, `tipo`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'Trámites', 'C02', 1, 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`soporte_categorias` (`id`, `categoria`, `clave`, `tipo`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'Comprobantes', 'C03', 1, 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`soporte_categorias` (`id`, `categoria`, `clave`, `tipo`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'Declaraciones', 'C04', 1, 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`soporte_categorias` (`id`, `categoria`, `clave`, `tipo`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'Inventario', 'C05', 1, 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`soporte_categorias` (`id`, `categoria`, `clave`, `tipo`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'Productos y servicios', 'C06', 1, 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`soporte_categorias` (`id`, `categoria`, `clave`, `tipo`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'Realización de pagos', 'C07', 1, 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`soporte_categorias` (`id`, `categoria`, `clave`, `tipo`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'Tickets', 'C08', 1, 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`soporte_categorias` (`id`, `categoria`, `clave`, `tipo`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'Cotizaciones', 'C09', 1, 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`soporte_categorias` (`id`, `categoria`, `clave`, `tipo`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'Otros', 'C10', 1, 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`soporte_categorias` (`id`, `categoria`, `clave`, `tipo`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'Declaración complementaria', 'C11', 1, 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`soporte_categorias` (`id`, `categoria`, `clave`, `tipo`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'Generación de facturación', 'T02', 2, 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`soporte_categorias` (`id`, `categoria`, `clave`, `tipo`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'Acceso', 'T03', 2, 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`soporte_categorias` (`id`, `categoria`, `clave`, `tipo`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'Permisos', 'T04', 2, 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`soporte_categorias` (`id`, `categoria`, `clave`, `tipo`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'Carga de archivos', 'T05', 2, 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`soporte_categorias` (`id`, `categoria`, `clave`, `tipo`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'Tiempo de respuesta', 'T06', 2, 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`soporte_categorias` (`id`, `categoria`, `clave`, `tipo`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'Navegación', 'T07', 2, 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`soporte_categorias` (`id`, `categoria`, `clave`, `tipo`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'Realización de pagos', 'T08', 2, 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`soporte_categorias` (`id`, `categoria`, `clave`, `tipo`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'Visualización de imágenes', 'T09', 2, 1, '2019-08-15', NULL);
INSERT INTO `massiva2019`.`soporte_categorias` (`id`, `categoria`, `clave`, `tipo`, `status`, `created_at`, `updated_at`) VALUES (DEFAULT, 'Cobros', 'T10', 2, 1, '2019-08-15', NULL);

COMMIT;

