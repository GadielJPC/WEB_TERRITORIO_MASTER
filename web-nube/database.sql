CREATE DATABASE mastermedic;

USE mastermedic;

CREATE TABLE contactos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(255) NOT NULL,
    correo_electronico VARCHAR(255),
    telefono VARCHAR(50),
    programa_interes VARCHAR(255),
    mensaje TEXT,
    acepta_privacidad TINYINT(1) DEFAULT 1,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);