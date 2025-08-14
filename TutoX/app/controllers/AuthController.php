<?php
require_once '../config/database.php';
require_once '../app/models/Usuario.php';  // ESTA ERA LA LÍNEA QUE FALTABA EL /app/

class AuthController {
    private $usuario;

    public function __construct() {
        // Iniciar sesión si no está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        global $pdo;
        $this->usuario = new Usuario($pdo);
    }

    public function login() {
        $error = null;
        
        if ($_POST) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $user = $this->usuario->login($email, $password);
            
            if ($user) {
                $_SESSION['usuario'] = $user;
                header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=home');
                exit;
            } else {
                $error = "Credenciales incorrectas";
            }
        }
        
        include '../app/views/miperfil/login.php';
    }

    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=home');
        exit;
    }

    public function registro() {
        $error = null;
        
        if ($_POST) {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $telefono = $_POST['telefono'] ?? null;
            $carrera = $_POST['carrera'] ?? null;
            
            if ($this->usuario->crear($nombre, $email, $password, $telefono, $carrera)) {
                header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=miperfil');
                exit;
            } else {
                $error = "Error al crear usuario";
            }
        }
        
        include '../app/views/miperfil/registro.php';
    }
}
?>