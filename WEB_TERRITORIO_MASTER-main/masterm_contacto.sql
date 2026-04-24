-- masterm_contacto.sql
CREATE DATABASE IF NOT EXISTS masterm_contacto;
USE masterm_contacto;

CREATE TABLE IF NOT EXISTS contactos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(100) NOT NULL,
    fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);