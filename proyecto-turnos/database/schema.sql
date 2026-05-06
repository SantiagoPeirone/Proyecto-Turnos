CREATE DATABASE turnos_app;
USE turnos_app;

CREATE TABLE servicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    duracion INT -- en minutos
);

CREATE TABLE turnos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_cliente VARCHAR(100),
    servicio_id INT,
    fecha DATE,
    hora TIME,
    estado VARCHAR(20) DEFAULT 'activo',
    FOREIGN KEY (servicio_id) REFERENCES servicios(id)
);

INSERT INTO servicios (nombre, duracion) VALUES ('Corte de pelo', 60);