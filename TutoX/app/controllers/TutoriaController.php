<?php
require_once '../config/database.php';
require_once '../app/models/Tutoria.php';

class TutoriaController {
    private $tutoria;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        global $pdo;
        $this->tutoria = new Tutoria($pdo);
    }

    public function index() {
        $tutorias = $this->tutoria->obtenerTodas();
        include '../app/views/tutorias/index.php';
    }

    public function detalle() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=tutorias');
            exit;
        }
        
        $tutoria = $this->tutoria->obtenerPorId($id);
        if (!$tutoria) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=tutorias');
            exit;
        }
        
        include '../app/views/tutorias/detalle.php';
    }

    public function crear() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=miperfil');
            exit;
        }

        $error = null;

        if ($_POST) {
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $materia = $_POST['materia'];
            $precio = $_POST['precio'];
            $modalidad = $_POST['modalidad'];
            $ubicacion = $_POST['ubicacion'] ?? '';

            if ($this->tutoria->crear($_SESSION['usuario']['id'], $titulo, $descripcion, $materia, $precio, $modalidad, $ubicacion)) {
                header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=tutorias');
                exit;
            } else {
                $error = "Error al crear la tutoría";
            }
        }

        include '../app/views/tutorias/crear.php';
    }

    public function misTutorias() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=miperfil');
            exit;
        }

        $tutorias = $this->tutoria->obtenerPorUsuario($_SESSION['usuario']['id']);
        include '../app/views/tutorias/mis-tutorias.php';
    }
}
?>