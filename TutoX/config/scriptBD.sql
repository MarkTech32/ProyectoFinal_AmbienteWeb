-- Crear esquema/Base de datos AmbWeb
CREATE DATABASE AmbWeb;

-- Usar esquema/Base de datos AmbWeb
USE AmbWeb;

-- Tabla usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telefono VARCHAR(15),
    carrera VARCHAR(100)
);

-- Tabla categorias
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL COMMENT 'Programación, Inglés, Matemáticas'
);

-- Tabla servicios
CREATE TABLE servicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_categoria INT NOT NULL,
    titulo VARCHAR(100) NOT NULL COMMENT 'Clases de Java',
    descripcion TEXT,
    precio_por_hora DECIMAL(8,2),
    modalidad VARCHAR(20) COMMENT 'presencial, virtual, ambas',
    estado VARCHAR(20) DEFAULT 'activo' COMMENT 'activo, inactivo',
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id) ON DELETE RESTRICT
);

-- Tabla reservas
CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_servicio INT NOT NULL,
    id_cliente INT NOT NULL,
    fecha_solicitada DATE,
    hora_solicitada VARCHAR(10) COMMENT '14:00',
    mensaje TEXT COMMENT 'Lo que necesita el cliente',
    estado VARCHAR(20) DEFAULT 'pendiente' COMMENT 'pendiente, confirmada, rechazada',
    fecha_solicitud DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (id_servicio) REFERENCES servicios(id) ON DELETE CASCADE,
    FOREIGN KEY (id_cliente) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabla calificaciones
CREATE TABLE calificaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_reserva INT NOT NULL,
    puntuacion TINYINT CHECK (puntuacion >= 1 AND puntuacion <= 5) COMMENT '1-5',
    comentario TEXT,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (id_reserva) REFERENCES reservas(id) ON DELETE CASCADE
);