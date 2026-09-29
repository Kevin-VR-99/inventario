CREATE DATABASE IF NOT EXISTS inventario
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE inventario;

DROP TABLE IF EXISTS productos;

CREATE TABLE productos (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(60) NOT NULL,
  cantidad INT NOT NULL,
  estado VARCHAR(20) NOT NULL DEFAULT 'auto',
  fecharegistro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO productos (nombre, cantidad, estado) VALUES
('Refresco', 10, 'auto'),
('galletas', 20, 'auto'),
('cereal', 5, 'auto');