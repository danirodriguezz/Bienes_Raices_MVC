DROP DATABASE IF EXISTS Bienes_Raices;

CREATE DATABASE Bienes_Raices;

USE Bienes_Raices;

CREATE TABLE usuarios (
    id INT(1) AUTO_INCREMENT NOT NULL PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE vendedores (
    id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nombre VARCHAR(255),
    apellido VARCHAR(255),
    telefono VARCHAR(255)
);

CREATE TABLE propiedades (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    vendedor_id INT UNSIGNED NOT NULL,
    titulo VARCHAR(45),
    precio DECIMAL(10,2),
    imagen VARCHAR(255),
    descripcion LONGTEXT,
    habitaciones INT(1),
    wc INT(1),
    estacionamiento INT(1),
    creado DATE,
    FOREIGN KEY(vendedor_id) REFERENCES vendedores(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

INSERT INTO vendedores(nombre, apellido, telefono) VALUES("Daniel", "Rodriguez Alonso", "648537315");
INSERT INTO vendedores(nombre, apellido, telefono) VALUES("Sara", "Maximo Dominguez", "657737315");
