<?php
class Usuario {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario;
        }
        return false;
    }
    
    public function crear($nombre, $email, $password, $telefono = null, $carrera = null) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nombre, email, password, telefono, carrera) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nombre, $email, $passwordHash, $telefono, $carrera]);
    }
    
    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
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