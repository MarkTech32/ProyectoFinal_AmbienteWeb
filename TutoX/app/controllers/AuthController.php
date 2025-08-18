<?php
require_once '../config/database.php';
require_once '../app/models/Usuario.php';
require_once '../app/models/Calificacion.php';  

class AuthController {
    private $usuario;
    private $calificacion;  

    public function __construct() {
        // Iniciar sesión si no está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        global $pdo;
        $this->usuario = new Usuario($pdo);
        $this->calificacion = new Calificacion($pdo);  
    }

    public function login() {
        $error = null;
        
        if ($_POST) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $user = $this->usuario->login($email, $password);
            
            if ($user) {
                $_SESSION['usuario'] = $user;
                header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=dashboard');
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
    
    public function perfil() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=miperfil');
            exit;
        }

        // Obtener información del usuario
        $usuario = $this->usuario->obtenerPorId($_SESSION['usuario']['id']);
        
        //Obtener reseñas del usuario usando modelo Calificacion
        $resenas = $this->calificacion->obtenerResenasPorTutor($_SESSION['usuario']['id']);
        
        //Calcular promedio de calificaciones usando modelo Calificacion
        $promedioCalificacion = $this->calificacion->obtenerPromedioCalificacion($_SESSION['usuario']['id']);
        
        include '../app/views/miperfil/perfil.php';
    }
}
?>