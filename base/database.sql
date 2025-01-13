#CREATE DATABASE alojamientos_db;

USE alojamientos_db;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('usuario', 'admin') DEFAULT 'usuario'
);


CREATE TABLE alojamientos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    direccion VARCHAR(255),
    precio DECIMAL(10, 2),
    imagen_url VARCHAR(255)
);


CREATE TABLE usuarios_alojamientos (
    usuario_id INT,
    alojamiento_id INT,
    PRIMARY KEY (usuario_id, alojamiento_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (alojamiento_id) REFERENCES alojamientos(id)
);


CREATE TABLE menu(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    url  VARCHAR(255) NOT NULL,
    parent_id INT DEFAULT NULL
);


/* Insertar Navs */

INSERT INTO menu (nombre, url, parent_id) VALUES
('Registrate', '/register.php', NULL),
('Login', '/Login.php', NULL),
('CRUD Alojamientos', '/controllers/AlojamientoController.php', NULL),
('Home', '/', NULL)