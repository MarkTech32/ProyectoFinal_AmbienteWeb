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

    public function editar() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=miperfil');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-publicaciones');
            exit;
        }

        $tutoria = $this->tutoria->obtenerPorId($id);
        if (!$tutoria || $tutoria['usuario_id'] != $_SESSION['usuario']['id']) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-publicaciones');
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

            if ($this->tutoria->actualizar($id, $titulo, $descripcion, $materia, $precio, $modalidad, $ubicacion)) {
                header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-publicaciones');
                exit;
            } else {
                $error = "Error al actualizar la tutoría";
            }
        }

        include '../app/views/tutorias/editar.php';
    }

    public function misTutorias() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=miperfil');
            exit;
        }

        $tutorias = $this->tutoria->obtenerPorUsuario($_SESSION['usuario']['id']);
        include '../app/views/tutorias/mis-tutorias.php';
    }

    public function agendar() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=miperfil');
            exit;
        }

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

        $mensaje = null;

        if ($_POST) {
            $fecha_solicitada = $_POST['fecha_solicitada'];
            $hora_solicitada = $_POST['hora_solicitada'];
            $mensaje_usuario = $_POST['mensaje'] ?? '';

            if ($this->tutoria->crearReserva($id, $_SESSION['usuario']['id'], $fecha_solicitada, $hora_solicitada, $mensaje_usuario)) {
                $mensaje = "¡La tutoría se agendó correctamente!";
            } else {
                $mensaje = "Error al agendar la tutoría";
            }
        }

        include '../app/views/tutorias/agendar.php';
    }

    public function misCitas() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=miperfil');
            exit;
        }

        $citas = $this->tutoria->obtenerReservasPorUsuario($_SESSION['usuario']['id']);
        include '../app/views/tutorias/mis-citas.php';
    }

    public function cancelarCita() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=miperfil');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-citas');
            exit;
        }

        if ($this->tutoria->eliminarReserva($id, $_SESSION['usuario']['id'])) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-citas&mensaje=cancelada');
            exit;
        } else {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-citas&error=1');
            exit;
        }
    }

    public function misSolicitudes() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=miperfil');
            exit;
        }

        $solicitudes = $this->tutoria->obtenerSolicitudesPorTutor($_SESSION['usuario']['id']);
        include '../app/views/tutorias/mis-solicitudes.php';
    }

    public function aceptarSolicitud() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=miperfil');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-solicitudes');
            exit;
        }

        if ($this->tutoria->actualizarEstadoSolicitud($id, 'confirmada', $_SESSION['usuario']['id'])) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-solicitudes&mensaje=aceptada');
            exit;
        } else {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-solicitudes&error=1');
            exit;
        }
    }

    public function rechazarSolicitud() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=miperfil');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-solicitudes');
            exit;
        }

        if ($this->tutoria->actualizarEstadoSolicitud($id, 'rechazada', $_SESSION['usuario']['id'])) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-solicitudes&mensaje=rechazada');
            exit;
        } else {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-solicitudes&error=1');
            exit;
        }
    }
}
?>