-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS Eq13Travelworld;
USE Eq13Travelworld;

-- Tabla de contactos
CREATE TABLE IF NOT EXISTS contactos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    asunto VARCHAR(100) NOT NULL,
    tipo_consulta ENUM('informacion', 'reserva', 'reclamo', 'otro') NOT NULL,
    destino_interes VARCHAR(50),
    mensaje TEXT NOT NULL,
    suscripcion TINYINT(1) DEFAULT 0,
    fecha_registro DATETIME NOT NULL
);

-- Tabla de reservas
CREATE TABLE IF NOT EXISTS reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    paquete VARCHAR(50) NOT NULL,
    fecha_viaje DATE NOT NULL,
    num_personas INT NOT NULL,
    servicios VARCHAR(255),
    comentarios TEXT,
    estado ENUM('pendiente', 'confirmada', 'cancelada') DEFAULT 'pendiente',
    fecha_registro DATETIME NOT NULL
);

-- Tabla de destinos
CREATE TABLE IF NOT EXISTS destinos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    pais VARCHAR(50) NOT NULL,
    categoria ENUM('playa', 'ciudad', 'montana') NOT NULL,
    descripcion TEXT NOT NULL,
    clima VARCHAR(50) NOT NULL,
    mejor_epoca VARCHAR(50) NOT NULL,
    duracion_recomendada VARCHAR(50) NOT NULL,
    precio_promedio DECIMAL(10, 2) NOT NULL,
    popularidad ENUM('bajo', 'medio', 'alto') NOT NULL,
    imagen VARCHAR(255) NOT NULL
);

-- Tabla de paquetes
CREATE TABLE IF NOT EXISTS paquetes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    destino_id INT NOT NULL,
    duracion VARCHAR(50) NOT NULL,
    precio_por_persona DECIMAL(10, 2) NOT NULL,
    incluye TEXT NOT NULL,
    no_incluye TEXT,
    destacado TINYINT(1) DEFAULT 0,
    oferta TINYINT(1) DEFAULT 0,
    precio_oferta DECIMAL(10, 2),
    imagen VARCHAR(255) NOT NULL,
    FOREIGN KEY (destino_id) REFERENCES destinos(id)
);

-- Insertar algunos datos de ejemplo en la tabla de destinos
INSERT INTO destinos (nombre, pais, categoria, descripcion, clima, mejor_epoca, duracion_recomendada, precio_promedio, popularidad, imagen) VALUES
('Cancún', 'México', 'playa', 'Disfruta de las playas de arena blanca y aguas cristalinas en el Caribe mexicano.', 'Tropical', 'Diciembre - Abril', '7 días', 1200.00, 'alto', 'img/cancun.jpg'),
('París', 'Francia', 'ciudad', 'La ciudad del amor te espera con su rica historia, arte y gastronomía.', 'Templado', 'Abril - Junio', '5 días', 1500.00, 'alto', 'img/paris.jpg'),
('Tokio', 'Japón', 'ciudad', 'Una mezcla perfecta de tradición y modernidad en la capital japonesa.', 'Templado', 'Marzo - Mayo', '10 días', 2000.00, 'medio', 'img/tokyo.jpg'),
('Alpes Suizos', 'Suiza', 'montana', 'Majestuosas montañas, lagos cristalinos y pueblos pintorescos.', 'Alpino', 'Junio - Agosto', '8 días', 1800.00, 'medio', 'img/alpes.jpg'),
('Bali', 'Indonesia', 'playa', 'Playas paradisíacas, templos ancestrales y una cultura fascinante.', 'Tropical', 'Mayo - Septiembre', '10 días', 1300.00, 'alto', 'img/bali.jpg'),
('Nueva York', 'Estados Unidos', 'ciudad', 'La Gran Manzana, una ciudad que nunca duerme llena de atracciones.', 'Continental', 'Septiembre - Noviembre', '7 días', 1700.00, 'alto', 'img/newyork.jpg');

-- Insertar algunos datos de ejemplo en la tabla de paquetes
INSERT INTO paquetes (nombre, destino_id, duracion, precio_por_persona, incluye, no_incluye, destacado, oferta, precio_oferta, imagen) VALUES
('Aventura en Cancún', 1, '7 días / 6 noches', 1499.00, 'Vuelos ida y vuelta, Hotel 5 estrellas todo incluido, Traslados aeropuerto-hotel, Tour a Chichén Itzá, Excursión a Isla Mujeres', 'Gastos personales, Propinas', 1, 0, NULL, 'img/cancun-package.jpg'),
('Romance en París', 2, '5 días / 4 noches', 1799.00, 'Vuelos ida y vuelta, Hotel 4 estrellas con desayuno, Traslados aeropuerto-hotel, Tour por la ciudad, Cena romántica en crucero por el Sena', 'Almuerzos y cenas (excepto la cena del crucero), Gastos personales', 0, 0, NULL, 'img/paris-package.jpg'),
('Descubriendo Japón', 3, '10 días / 9 noches', 2499.00, 'Vuelos ida y vuelta, Hoteles 4 estrellas con desayuno, Traslados aeropuerto-hotel, Tours en Tokio, Kioto y Osaka, Japan Rail Pass de 7 días', 'Almuerzos y cenas, Gastos personales', 0, 1, 2199.00, 'img/tokyo-package.jpg'),
('Aventura en los Alpes', 4, '8 días / 7 noches', 2099.00, 'Vuelos ida y vuelta, Hoteles 4 estrellas con desayuno, Traslados aeropuerto-hotel, Swiss Travel Pass de 8 días, Excursión al Jungfraujoch', 'Almuerzos y cenas, Gastos personales', 0, 0, NULL, 'img/alpes-package.jpg');