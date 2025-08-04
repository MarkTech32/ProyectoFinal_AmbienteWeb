
CREATE DATABASE AmbWeb;


USE AmbWeb;


CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telefono VARCHAR(15),
    carrera VARCHAR(100)
);


CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL COMMENT 'Programación, Inglés, Matemáticas'
);


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


CREATE TABLE calificaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_reserva INT NOT NULL,
    puntuacion TINYINT CHECK (puntuacion >= 1 AND puntuacion <= 5) COMMENT '1-5',
    comentario TEXT,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (id_reserva) REFERENCES reservas(id) ON DELETE CASCADE
);




CREATE TABLE tipos_servicio (
    id TINYINT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL COMMENT 'servicio, tutoria'
);

ALTER TABLE servicios
ADD id_tipo TINYINT NOT NULL DEFAULT 1 COMMENT '1 = servicio, 2 = tutoría',
ADD FOREIGN KEY (id_tipo) REFERENCES tipos_servicio(id);

USE AmbWeb;
ALTER TABLE usuarios ADD COLUMN password VARCHAR(255) NOT NULL;

USE AmbWeb;

INSERT INTO usuarios (nombre, email, password, telefono, carrera) 
VALUES (
    'Juan Pérez', 
    'juan@test.com', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    '88888888',
    'Ingeniería en Sistemas'
);
--Credenciales para comprobar el login:
--Usuario: juan@test.com
--Contraseña: password