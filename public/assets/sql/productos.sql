CREATE DATABASE productos;
USE productos;

productoCREATE TABLE categoria(
id INT PRIMARY KEY AUTO_INCREMENT,
nombre VARCHAR(50)
);


CREATE TABLE producto(
id INT PRIMARY KEY AUTO_INCREMENT,
nombre VARCHAR(50),
descripcion VARCHAR(50),
ruta_imagen VARCHAR(500),
stock BOOLEAN DEFAULT TRUE,
id_categoria INT,
FOREIGN KEY (id_categoria) REFERENCES categoria(id)
);


CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    pass VARCHAR(255) NOT NULL
);

