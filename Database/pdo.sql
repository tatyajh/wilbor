CREATE DATABASE IF NOT EXISTS inventario;
USE inventario;

CREATE TABLE `categoria` (
  `categoria_id` int(7) NOT NULL AUTO_INCREMENT,
  `categoria_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `categoria_ubicacion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE `usuario` (
  `usuario_id` int(10) NOT NULL AUTO_INCREMENT,
  `usuario_nombre` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_apellido` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_usuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_clave` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_email` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_telefono` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE `producto` (
  `producto_id` int(20) NOT NULL AUTO_INCREMENT,
  `producto_codigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_nombre` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_precio` decimal(30,2) NOT NULL,
  `producto_stock` int(25) NOT NULL,
  `producto_foto` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `categoria_id` int(7) NOT NULL,
  `usuario_id` int(10) NOT NULL,
  PRIMARY KEY (`producto_id`),
  KEY `categoria_id_fk` (`categoria_id`),
  KEY `usuario_id_fk` (`usuario_id`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`),
  CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE `contactos` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nombreApellido` VARCHAR(255) NOT NULL,
    `correoElectronico` VARCHAR(255) NOT NULL,
    `telefono` VARCHAR(20) NOT NULL,
    `mensaje` TEXT NOT NULL,
    `contacto` VARCHAR(50),
    `horario` VARCHAR(50),
    `deseaRecibirNovedades` BOOLEAN,
    `fechaRegistro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_usuario`, `usuario_clave`, `usuario_email`, `usuario_telefono`) VALUES
(1, 'Administrador', 'Administrador', 'Administrador', 'administradir', '', '');




