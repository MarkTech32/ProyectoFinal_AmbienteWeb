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
    
    public function actualizar($id, $titulo, $descripcion, $materia, $precio, $modalidad, $ubicacion) {
        $stmt = $this->pdo->prepare("
            UPDATE tutorias 
            SET titulo = ?, descripcion = ?, materia = ?, precio = ?, modalidad = ?, ubicacion = ?
            WHERE id = ?
        ");
        return $stmt->execute([$titulo, $descripcion, $materia, $precio, $modalidad, $ubicacion, $id]);
    }
    
    public function crearReserva($id_tutoria, $id_cliente, $fecha_solicitada, $hora_solicitada, $mensaje) {
        $stmt = $this->pdo->prepare("
            INSERT INTO reservas_tutorias (id_tutoria, id_cliente, fecha_solicitada, hora_solicitada, mensaje) 
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$id_tutoria, $id_cliente, $fecha_solicitada, $hora_solicitada, $mensaje]);
    }
    
    public function obtenerReservasPorUsuario($usuario_id) {
        $stmt = $this->pdo->prepare("
            SELECT r.*, t.titulo, t.materia, t.precio, t.modalidad, t.ubicacion, 
                   u.nombre as tutor_nombre, u.email as tutor_email, u.telefono as tutor_telefono
            FROM reservas_tutorias r 
            JOIN tutorias t ON r.id_tutoria = t.id 
            JOIN usuarios u ON t.usuario_id = u.id 
            WHERE r.id_cliente = ? 
            ORDER BY r.fecha_solicitud DESC
        ");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function eliminarReserva($id_reserva, $id_cliente) {
        $stmt = $this->pdo->prepare("
            DELETE FROM reservas_tutorias 
            WHERE id = ? AND id_cliente = ?
        ");
        return $stmt->execute([$id_reserva, $id_cliente]);
    }
    
    public function obtenerSolicitudesPorTutor($tutor_id) {
        $stmt = $this->pdo->prepare("
            SELECT r.*, t.titulo, t.materia, t.precio, t.modalidad, t.ubicacion,
                   u.nombre as cliente_nombre, u.email as cliente_email, u.telefono as cliente_telefono
            FROM reservas_tutorias r 
            JOIN tutorias t ON r.id_tutoria = t.id 
            JOIN usuarios u ON r.id_cliente = u.id 
            WHERE t.usuario_id = ? 
            ORDER BY r.fecha_solicitud DESC
        ");
        $stmt->execute([$tutor_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function actualizarEstadoSolicitud($id_reserva, $nuevo_estado, $tutor_id) {
        $stmt = $this->pdo->prepare("
            UPDATE reservas_tutorias r
            JOIN tutorias t ON r.id_tutoria = t.id
            SET r.estado = ?
            WHERE r.id = ? AND t.usuario_id = ?
        ");
        return $stmt->execute([$nuevo_estado, $id_reserva, $tutor_id]);
    }
    
    public function completarReserva($id_reserva, $usuario_id) {
        $stmt = $this->pdo->prepare("
            UPDATE reservas_tutorias r
            LEFT JOIN tutorias t ON r.id_tutoria = t.id
            SET r.estado = 'completada'
            WHERE r.id = ? AND (r.id_cliente = ? OR t.usuario_id = ?)
        ");
        return $stmt->execute([$id_reserva, $usuario_id, $usuario_id]);
    }
    
    public function obtenerReservaPorId($id_reserva, $id_cliente) {
        $stmt = $this->pdo->prepare("
            SELECT r.*, t.titulo, t.materia, 
                   u.nombre as tutor_nombre, u.email as tutor_email
            FROM reservas_tutorias r 
            JOIN tutorias t ON r.id_tutoria = t.id 
            JOIN usuarios u ON t.usuario_id = u.id 
            WHERE r.id = ? AND r.id_cliente = ?
        ");
        $stmt->execute([$id_reserva, $id_cliente]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function obtenerReservaPorIdGeneral($id_reserva) {
        $stmt = $this->pdo->prepare("
            SELECT r.*, t.titulo, t.materia 
            FROM reservas_tutorias r 
            JOIN tutorias t ON r.id_tutoria = t.id 
            WHERE r.id = ?
        ");
        $stmt->execute([$id_reserva]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function crearCalificacion($id_reserva, $puntuacion, $comentario) {
        $stmt = $this->pdo->prepare("
            INSERT INTO calificaciones (id_reserva, puntuacion, comentario) 
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$id_reserva, $puntuacion, $comentario]);
    }
}
?>