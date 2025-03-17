CREATE DATABASE productos;
USE productos;

producto CREATE TABLE categoria(
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

INSERT INTO usuarios(usuario,pass) values("adminDOB","$2y$10$XXMTc24FJS97NYpGibKTa.YtvFTLvMs7kz5vatVXYM3xuO6SvFeDK");

INSERT INTO categoria (nombre) VALUES 
('Miel'), 
('Frutos Secos'), 
('Legumbres'), 
('Fruta'), 
('Plantas'), 
('Pimientos');

-- Miel
INSERT INTO producto (nombre, descripcion, ruta_imagen, stock, id_categoria) 
VALUES ('Miel de brezo', 'Miel 100% natural con un intenso aroma floral y un sabor ligeramente amargo, rica en antioxidantes y beneficiosa para la salud.', '/imagenes/miel_brezo.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Miel'));

-- Frutos Secos
INSERT INTO producto (nombre, descripcion, ruta_imagen, stock, id_categoria) VALUES 
('Almendras con cáscara', 'Almendras naturales con cáscara, ricas en proteínas, fibra y grasas saludables. Perfectas para un snack nutritivo.', '/imagenes/almendras.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Frutos Secos')),
('Avellanas naturales y tostadas', 'Avellanas en su forma natural o tostadas para realzar su sabor. Ideales para repostería y consumo diario.', '/imagenes/avellanas.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Frutos Secos')),
('Castañas', 'Castañas frescas de temporada, con un sabor dulce y una textura cremosa al cocinarlas. Ricas en fibra y bajas en grasas.', '/imagenes/castanas.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Frutos Secos')),
('Castañas secas', 'Castañas deshidratadas, ideales para guisos y postres. Aportan un toque dulce y una gran cantidad de energía natural.', '/imagenes/castanas_secas.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Frutos Secos')),
('Nueces', 'Nueces frescas con alto contenido en ácidos grasos Omega-3, perfectas para cuidar el corazón y la salud cerebral.', '/imagenes/nueces.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Frutos Secos')),
('Higos secos', 'Higos secos naturales, dulces y jugosos, ideales para un snack energético y ricos en fibra, hierro y calcio.', '/imagenes/higos_secos.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Frutos Secos'));

-- Legumbres
INSERT INTO producto (nombre, descripcion, ruta_imagen, stock, id_categoria) VALUES 
('Judión del Barco de Ávila', 'Alubia grande, cremosa y de piel fina, perfecta para guisos y potajes. Destaca por su suavidad y gran sabor.', '/imagenes/judion.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Legumbres'));

-- Fruta
INSERT INTO producto (nombre, descripcion, ruta_imagen, stock, id_categoria) VALUES 
('Manzana roja', 'Manzana de pulpa crujiente y sabor dulce, ideal para comer fresca o en ensaladas.', '/imagenes/manzana_roja.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Fruta')),
('Manzana verde', 'Manzana ácida y refrescante, rica en fibra y antioxidantes. Ideal para zumos y postres.', '/imagenes/manzana_verde.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Fruta')),
('Manzana reineta', 'Manzana de sabor intenso, perfecta para cocinar y preparar compotas y postres.', '/imagenes/manzana_reineta.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Fruta')),
('Melocotón rojo', 'Melocotón jugoso y dulce con un ligero toque ácido. Rico en vitamina C y antioxidantes.', '/imagenes/melocoton_rojo.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Fruta')),
('Melocotón blanco', 'Melocotón de pulpa blanca, más suave y dulce que otras variedades.', '/imagenes/melocoton_blanco.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Fruta')),
('Nectarina', 'Fruta similar al melocotón pero de piel lisa y sabor más intenso.', '/imagenes/nectarina.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Fruta')),
('Pera conferencia', 'Pera jugosa y dulce, con una piel fina y gran cantidad de fibra.', '/imagenes/pera_conferencia.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Fruta')),
('Kiwi', 'Fruta exótica con alto contenido en vitamina C, perfecta para fortalecer el sistema inmune.', '/imagenes/kiwi.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Fruta')),
('Cereza', 'Pequeñas frutas rojas con un sabor dulce y refrescante. Fuente natural de antioxidantes.', '/imagenes/cereza.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Fruta')),
('Mandarina', 'Fruta cítrica dulce y fácil de pelar, ideal para consumir como snack saludable.', '/imagenes/mandarina.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Fruta')),
('Uva verde', 'Uvas dulces y refrescantes, ricas en antioxidantes y perfectas para postres.', '/imagenes/uva_verde.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Fruta')),
('Uva negra', 'Variedad de uva con mayor contenido en antioxidantes y un sabor más intenso.', '/imagenes/uva_negra.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Fruta')),
('Membrillo', 'Fruta con alto contenido en pectina, perfecta para hacer dulce de membrillo.', '/imagenes/membrillo.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Fruta')),
('Tomate', 'Fruta versátil con un equilibrio perfecto entre dulzura y acidez. Ideal para ensaladas, salsas y guisos.', '/imagenes/tomate.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Fruta'));

-- Plantas
INSERT INTO producto (nombre, descripcion, ruta_imagen, stock, id_categoria) VALUES 
('Cebolla para plantar', 'Variedad de cebolla de rápido crecimiento, ideal para huertos.', '/imagenes/cebolla.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Plantas')),
('Lechuga', 'Hortaliza de hoja verde, crujiente y refrescante, perfecta para ensaladas.', '/imagenes/lechuga.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Plantas')),
('Berenjena', 'Hortaliza de piel morada y textura suave, ideal para asar o guisar.', '/imagenes/berenjena.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Plantas'));

-- Pimientos
INSERT INTO producto (nombre, descripcion, ruta_imagen, stock, id_categoria) VALUES 
('Pimiento rojo de asar', 'Pimiento grande y carnoso con un sabor dulce, ideal para asar o rellenar.', '/imagenes/pimiento_rojo.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Pimientos')),
('Pimiento verde de freír', 'Pimiento alargado y fino, perfecto para freír con un toque de sal.', '/imagenes/pimiento_verde.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Pimientos')),
('Pimiento de Padrón', 'Pequeños pimientos verdes, famosos por su sabor suave, aunque algunos pueden picar.', '/imagenes/pimiento_padron.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Pimientos')),
('Pimiento picante de Ponferrada', 'Variedad de pimiento pequeño pero intenso en picor, ideal para darle un toque especial a los platos.', '/imagenes/pimiento_picante.jpg', TRUE, 
    (SELECT id FROM categoria WHERE nombre = 'Pimientos'));
