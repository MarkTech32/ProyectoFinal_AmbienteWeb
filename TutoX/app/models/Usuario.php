<?php

class Usuario {
    private $conn;
    
    public function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "AmbWeb";
        $port = 3306;
        
        $this->conn = new mysqli($servername, $username, $password, $database, $port);
        
        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
        
        $this->conn->set_charset("utf8");
    }
    
    // Buscar usuario por email
    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    // Crear nuevo usuario
    public function crear($nombre, $email, $password, $telefono = null, $carrera = null) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nombre, email, password, telefono, carrera) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $nombre, $email, $password_hash, $telefono, $carrera);
        return $stmt->execute();
    }
    
    // Verificar contraseña
    public function verificarPassword($password, $password_hash) {
        return password_verify($password, $password_hash);
    }
    
    // Obtener usuario por ID
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>