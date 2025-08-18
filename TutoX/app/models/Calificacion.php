<?php
class Calificacion {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function crearCalificacion($id_reserva, $puntuacion, $comentario) {
        $stmt = $this->pdo->prepare("
            INSERT INTO calificaciones (id_reserva, puntuacion, comentario) 
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$id_reserva, $puntuacion, $comentario]);
    }
    
    public function obtenerPromedioCalificacionTutor($tutor_id) {
        $stmt = $this->pdo->prepare("
            SELECT AVG(c.puntuacion) as promedio, COUNT(c.id) as total
            FROM calificaciones c
            JOIN reservas_tutorias r ON c.id_reserva = r.id
            JOIN tutorias t ON r.id_tutoria = t.id
            WHERE t.usuario_id = ?
        ");
        $stmt->execute([$tutor_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return [
            'promedio' => $result['promedio'] ? round($result['promedio'], 1) : 0,
            'total' => $result['total']
        ];
    }
    
   public function obtenerUltimaCalificacionTutor($tutor_id) {
        $stmt = $this->pdo->prepare("
            SELECT c.*, r.fecha_solicitada, r.hora_solicitada,
                   t.titulo, t.materia,
                   u.nombre as cliente_nombre
            FROM calificaciones c
            JOIN reservas_tutorias r ON c.id_reserva = r.id
            JOIN tutorias t ON r.id_tutoria = t.id
            JOIN usuarios u ON r.id_cliente = u.id
            WHERE t.usuario_id = ?
            ORDER BY c.fecha DESC
            LIMIT 1
        ");
        $stmt->execute([$tutor_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerResenasPorTutor($tutor_id) {
        $stmt = $this->pdo->prepare("
            SELECT c.*, r.fecha_solicitada, r.hora_solicitada,
                   t.titulo, t.materia,
                   u.nombre as cliente_nombre
            FROM calificaciones c
            JOIN reservas_tutorias r ON c.id_reserva = r.id
            JOIN tutorias t ON r.id_tutoria = t.id
            JOIN usuarios u ON r.id_cliente = u.id
            WHERE t.usuario_id = ?
            ORDER BY c.fecha DESC
        ");
        $stmt->execute([$tutor_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function obtenerPromedioCalificacion($tutor_id) {
        $stmt = $this->pdo->prepare("
            SELECT AVG(c.puntuacion) as promedio, COUNT(c.id) as total
            FROM calificaciones c
            JOIN reservas_tutorias r ON c.id_reserva = r.id
            JOIN tutorias t ON r.id_tutoria = t.id
            WHERE t.usuario_id = ?
        ");
        $stmt->execute([$tutor_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return [
            'promedio' => $result['promedio'] ? round($result['promedio'], 1) : 0,
            'total' => $result['total']
        ];
    }
}
?>