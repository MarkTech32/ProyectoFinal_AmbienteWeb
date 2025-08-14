<?php
// Iniciar sesión
session_start();

// Obtener la página solicitada
$page = $_GET['page'] ?? 'home';

// Definir rutas
switch ($page) {
    case 'home':
        include '../app/views/home/index.php';
        break;
        
    case 'tutorias':
        require_once '../app/controllers/TutoriaController.php';
        $controller = new TutoriaController();
        $controller->index();
        break;
        
    case 'crear-tutoria':
        require_once '../app/controllers/TutoriaController.php';
        $controller = new TutoriaController();
        $controller->crear();
        break;
        
    case 'mis-publicaciones':
        require_once '../app/controllers/TutoriaController.php';
        $controller = new TutoriaController();
        $controller->misTutorias();
        break;
        
    case 'editar-tutoria':
        require_once '../app/controllers/TutoriaController.php';
        $controller = new TutoriaController();
        $controller->editar();
        break;
        
    case 'tutoria-detalle':
        require_once '../app/controllers/TutoriaController.php';
        $controller = new TutoriaController();
        $controller->detalle();
        break;
        
    case 'agendar-tutoria':
        require_once '../app/controllers/TutoriaController.php';
        $controller = new TutoriaController();
        $controller->agendar();
        break;
        
    case 'mis-citas':
        require_once '../app/controllers/TutoriaController.php';
        $controller = new TutoriaController();
        $controller->misCitas();
        break;
        
    case 'cancelar-cita':
        require_once '../app/controllers/TutoriaController.php';
        $controller = new TutoriaController();
        $controller->cancelarCita();
        break;
        
    case 'servicios':
        include '../app/views/servicios/index.php';
        break;
        
    case 'miperfil':
        require_once '../app/controllers/AuthController.php';
        $auth = new AuthController();
        $auth->login();
        break;
    
    case 'dashboard':
        // Verificar que el usuario esté logueado
        if (!isset($_SESSION['usuario'])) {
            header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=miperfil');
            exit;
        }
        include '../app/views/dashboard/dashboard.php';
        break;
        
    case 'logout':
        // Destruir sesión y redirigir
        session_destroy();
        header('Location: /ProyectoFinal_AmbienteWeb/TutoX/public/?page=home');
        exit;
        
    case 'registro':
        require_once '../app/controllers/AuthController.php';
        $auth = new AuthController();
        $auth->registro();
        break;
        
    case 'faq':
        include '../app/views/faq/index.php';
        break;
        
    default:
        // Página 404
        http_response_code(404);
        echo "<h1>404 - Página no encontrada</h1>";
        break;
}
?>