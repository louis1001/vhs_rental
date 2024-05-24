CREATE TABLE IF NOT EXISTS `clientes` (
  `id` integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15),
  `apellido` varchar(15),
  `telefono` varchar(15),
  `correo` varchar(55)
);

CREATE TABLE IF NOT EXISTS `peliculas` (
  `id` integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `titulo` varchar(80),
  `topico_id` integer,
  `anio` integer,
  `resumen` text,
  `disponible` integer
);

CREATE TABLE IF NOT EXISTS `topicos` (
  `id` integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20)
);

-- noinspection SqlNoDataSourceInspection
CREATE TABLE IF NOT EXISTS `prestamos` (
  `pelicula_prestada_id` integer,
  `cliente_prestando_id` integer,
  `fecha_prestamo` datetime,
  `fecha_devolucion` datetime
);

ALTER TABLE `peliculas` ADD FOREIGN KEY (`topico_id`) REFERENCES `topicos` (`id`);

ALTER TABLE `prestamos` ADD FOREIGN KEY (`cliente_prestando_id`) REFERENCES `clientes` (`id`);

ALTER TABLE `prestamos` ADD FOREIGN KEY (`pelicula_prestada_id`) REFERENCES `peliculas` (`id`);
