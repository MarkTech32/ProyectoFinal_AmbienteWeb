<?php
require_once '../config/database.php';
require_once '../app/models/Tutoria.php';
require_once '../app/models/Reserva.php';     // NUEVO: Agregar modelo Reserva
require_once '../app/models/Calificacion.php'; // NUEVO: Agregar modelo Calificacion

class TutoriaController {
    private $tutoria;
    private $reserva;      // NUEVO: Instancia del modelo Reserva
    private $calificacion; // NUEVO: Instancia del modelo Calificacion

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        global $pdo;
        $this->tutoria = new Tutoria($pdo);
        $this->reserva = new Reserva($pdo);           // NUEVO: Instanciar modelo Reserva
        $this->calificacion = new Calificacion($pdo); // NUEVO: Instanciar modelo Calificacion
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
        
        // CAMBIADO: Obtener calificaciones del tutor usando modelo Calificacion
        $promedio_calificacion = $this->calificacion->obtenerPromedioCalificacionTutor($tutoria['usuario_id']);
        $ultima_calificacion = $this->calificacion->obtenerUltimaCalificacionTutor($tutoria['usuario_id']);
        
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

            // CAMBIADO: Usar modelo Reserva para crear reserva
            if ($this->reserva->crearReserva($id, $_SESSION['usuario']['id'], $fecha_solicitada, $hora_solicitada, $mensaje_usuario)) {
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

        // CAMBIADO: Usar modelo Reserva para obtener reservas por usuario
        $citas = $this->reserva->obtenerReservasPorUsuario($_SESSION['usuario']['id']);
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

        // CAMBIADO: Usar modelo Reserva para eliminar reserva
        if ($this->reserva->eliminarReserva($id, $_SESSION['usuario']['id'])) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-citas&mensaje=cancelada');
            exit;
        } else {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-citas&error=1');
            exit;
        }
    }

    public function crearResena() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=miperfil');
            exit;
        }

        $id_reserva = $_GET['id'] ?? null;
        if (!$id_reserva) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-citas');
            exit;
        }

        // CAMBIADO: Verificar que la reserva existe usando modelo Reserva
        $reserva = $this->reserva->obtenerReservaPorId($id_reserva, $_SESSION['usuario']['id']);
        if (!$reserva || $reserva['estado'] != 'completada') {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-citas');
            exit;
        }

        $error = null;

        if ($_POST) {
            $puntuacion = $_POST['puntuacion'];
            $comentario = $_POST['comentario'] ?? '';

            // CAMBIADO: Usar modelo Calificacion para crear calificación
            if ($this->calificacion->crearCalificacion($id_reserva, $puntuacion, $comentario)) {
                header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-citas&mensaje=resena-creada');
                exit;
            } else {
                $error = "Error al crear la reseña";
            }
        }

        include '../app/views/tutorias/crear-resena.php';
    }

    public function misSolicitudes() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=miperfil');
            exit;
        }

        // CAMBIADO: Usar modelo Reserva para obtener solicitudes por tutor
        $solicitudes = $this->reserva->obtenerSolicitudesPorTutor($_SESSION['usuario']['id']);
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

        // CAMBIADO: Usar modelo Reserva para actualizar estado de solicitud
        if ($this->reserva->actualizarEstadoSolicitud($id, 'confirmada', $_SESSION['usuario']['id'])) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-solicitudes&mensaje=aceptada');
            exit;
        } else {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-solicitudes&error=1');
            exit;
        }
    }

    public function completarTutoria() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=miperfil');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-citas');
            exit;
        }

        // CAMBIADO: Usar modelo Reserva para completar reserva
        if ($this->reserva->completarReserva($id, $_SESSION['usuario']['id'])) {
            // CAMBIADO: Verificar si el usuario es estudiante o tutor usando modelo Reserva
            $reserva = $this->reserva->obtenerReservaPorIdGeneral($id);
            if ($reserva && $reserva['id_cliente'] == $_SESSION['usuario']['id']) {
                // Es el estudiante, redirigir a mis-citas
                header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-citas&mensaje=completada');
            } else {
                // Es el tutor, redirigir a mis-solicitudes
                header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-solicitudes&mensaje=completada');
            }
            exit;
        } else {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-citas&error=1');
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

        // CAMBIADO: Usar modelo Reserva para actualizar estado de solicitud
        if ($this->reserva->actualizarEstadoSolicitud($id, 'rechazada', $_SESSION['usuario']['id'])) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-solicitudes&mensaje=rechazada');
            exit;
        } else {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-solicitudes&error=1');
            exit;
        }
    }
}
?>