-- Crear base de datos y usarla
CREATE DATABASE IF NOT EXISTS AmbWeb;
USE AmbWeb;

-- Tabla usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
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

-- 5. Tabla tutorias
CREATE TABLE tutorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    materia VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    modalidad ENUM('presencial', 'virtual', 'ambas') NOT NULL,
    ubicacion VARCHAR(255),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    activa BOOLEAN DEFAULT TRUE,
    
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Tabla reservas_servicios
CREATE TABLE reservas_servicios (
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

-- Tabla reservas_tutorias
CREATE TABLE reservas_tutorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_tutoria INT NOT NULL,
    id_cliente INT NOT NULL,
    fecha_solicitada DATE,
    hora_solicitada VARCHAR(10) COMMENT '14:00',
    mensaje TEXT COMMENT 'Lo que necesita el estudiante',
    estado VARCHAR(20) DEFAULT 'pendiente' COMMENT 'pendiente, confirmada, rechazada, completada',
    fecha_solicitud DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (id_tutoria) REFERENCES tutorias(id) ON DELETE CASCADE,
    FOREIGN KEY (id_cliente) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabla calificaciones
CREATE TABLE calificaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_reserva INT NOT NULL,
    puntuacion TINYINT NOT NULL,
    comentario TEXT,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (id_reserva) REFERENCES reservas_servicios(id) ON DELETE CASCADE,
    CHECK (puntuacion >= 1 AND puntuacion <= 5)
);

-- Insertar usuarios de prueba con contraseñas hasheadas
-- CONTRASEÑA PARA TODOS: "123456" 
('María González', 'maria@universidad.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8888-1111', 'Ingeniería en Sistemas'),
('Carlos Rodríguez', 'carlos@universidad.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8888-2222', 'Matemáticas'),
('Ana Fernández', 'ana@universidad.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8888-3333', 'Ingeniería Industrial'),
('José Morales', 'jose@universidad.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8888-4444', 'Administración'),
('Laura Jiménez', 'laura@universidad.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8888-5555', 'Psicología'),
('Diego Vargas', 'diego@universidad.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8888-6666', 'Ingeniería Civil');

-- Insertar categorías
INSERT INTO categorias (nombre) VALUES
('Programación'), ('Matemáticas'), ('Inglés'), ('Administración'), ('Ingeniería');

-- Insertar tutorías de prueba
INSERT INTO tutorias (usuario_id, titulo, descripcion, materia, precio, modalidad, ubicacion) VALUES
(1, 'Programación en Java - Nivel Básico', 'Aprende los fundamentos de Java desde cero. Cubrimos variables, estructuras de control, POO y más.', 'Programación', 15000, 'virtual', 'Zoom/Google Meet'),
(1, 'Estructuras de Datos con Python', 'Domina listas, pilas, colas, árboles y grafos. Perfecto para estudiantes de algoritmos.', 'Programación', 18000, 'ambas', 'Campus Universidad / Online'),
(2, 'Cálculo Diferencial e Integral', 'Refuerzo en matemáticas universitarias. Límites, derivadas, integrales y aplicaciones.', 'Matemáticas', 12000, 'presencial', 'Biblioteca Central UCR'),
(2, 'Álgebra Lineal Aplicada', 'Matrices, vectores, sistemas de ecuaciones y transformaciones lineales.', 'Matemáticas', 14000, 'virtual', 'Microsoft Teams'),
(3, 'Gestión de Proyectos con MS Project', 'Aprende a planificar y gestionar proyectos usando herramientas profesionales.', 'Administración', 20000, 'presencial', 'Aula de Computación'),
(4, 'Contabilidad Básica para Estudiantes', 'Estados financieros, partida doble, balance general y más.', 'Contabilidad', 10000, 'virtual', 'Skype'),
(4, 'Marketing Digital y Redes Sociales', 'Estrategias de marketing online, gestión de redes sociales y analíticas.', 'Marketing', 16000, 'ambas', 'Oficina / Online'),
(5, 'Preparación para Exámenes de Inglés', 'TOEFL, TOEIC, Cambridge. Mejora tu nivel de inglés académico.', 'Inglés', 13000, 'virtual', 'Zoom'),
(5, 'Redacción Académica en Español', 'Técnicas de escritura, ensayos, tesis y documentos formales.', 'Español', 11000, 'presencial', 'Café Central Campus'),
(6, 'AutoCAD para Ingeniería Civil', 'Diseño técnico, planos arquitectónicos y modelado 2D/3D.', 'Ingeniería', 22000, 'presencial', 'Laboratorio de Diseño'),
(1, 'Bases de Datos con MySQL', 'Diseño de BD, consultas SQL, normalización y optimización.', 'Bases de Datos', 17000, 'virtual', 'Discord'),
(3, 'Estadística para Investigación', 'SPSS, análisis de datos, pruebas de hipótesis y regresión.', 'Estadística', 15500, 'ambas', 'Laboratorio / Online');

-- Insertar reservas de tutorías
INSERT INTO reservas_tutorias (id_tutoria, id_cliente, fecha_solicitada, hora_solicitada, mensaje, estado) VALUES
(1, 3, '2025-08-20', '14:00', 'Necesito ayuda con conceptos básicos de Java para mi proyecto final', 'pendiente'),
(2, 4, '2025-08-22', '10:00', 'Quiero entender mejor las estructuras de datos para el examen', 'confirmada'),
(3, 1, '2025-08-25', '16:00', 'Tengo dificultades con integrales por partes', 'pendiente'),
(5, 6, '2025-08-21', '09:00', 'Necesito aprender MS Project para mi trabajo', 'confirmada'),
(8, 2, '2025-08-23', '15:30', 'Preparación para el TOEFL, nivel intermedio', 'pendiente');
