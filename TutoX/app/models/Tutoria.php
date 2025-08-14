<?php
class Tutoria {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function obtenerTodas() {
        $stmt = $this->pdo->prepare("
            SELECT t.*, u.nombre as tutor_nombre, u.email as tutor_email 
            FROM tutorias t 
            JOIN usuarios u ON t.usuario_id = u.id 
            WHERE t.activa = 1
            ORDER BY t.fecha_creacion DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("
            SELECT t.*, u.nombre as tutor_nombre, u.email as tutor_email, u.telefono as tutor_telefono 
            FROM tutorias t 
            JOIN usuarios u ON t.usuario_id = u.id 
            WHERE t.id = ? AND t.activa = 1
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function obtenerPorUsuario($usuario_id) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM tutorias 
            WHERE usuario_id = ? 
            ORDER BY fecha_creacion DESC
        ");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function crear($usuario_id, $titulo, $descripcion, $materia, $precio, $modalidad, $ubicacion) {
        $stmt = $this->pdo->prepare("
            INSERT INTO tutorias (usuario_id, titulo, descripcion, materia, precio, modalidad, ubicacion) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$usuario_id, $titulo, $descripcion, $materia, $precio, $modalidad, $ubicacion]);
    }
}
?>