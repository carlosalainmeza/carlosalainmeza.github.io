CREATE DATABASE usuarios_db;
USE usuarios_db;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(60),
    dni VARCHAR(8),
    telefono VARCHAR(15),
    estudios VARCHAR(100),
    estado_civil VARCHAR(1),
    provincia VARCHAR(50),
    correo VARCHAR(60),
    clave VARCHAR(60),
    color_preferencia VARCHAR(7),
    fecha_nacimiento DATETIME
);
