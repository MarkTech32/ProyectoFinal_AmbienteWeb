<?php
<<<<<<< HEAD
// Iniciar sesión
session_start();
=======
// Router simple de TutoX
// Funciona con URLs como: index.php?page=servicios
>>>>>>> f1756379b0eb9d4ed1f48399cff16827df07f107

// Obtener la página solicitada
$page = $_GET['page'] ?? 'home';

<<<<<<< HEAD
// Definir rutas
switch ($page) {
    case 'home':
        include '../app/views/home/index.php';
        break;
        
    case 'tutorias':
        include '../app/views/tutorias/index.php';
        break;
        
    case 'servicios':
        include '../app/views/servicios/index.php';
        break;
        
    case 'miperfil':
        include '../app/views/miperfil/login.php';
        break;
        
    case 'faq':
        include '../app/views/faq/index.php';
        break;
        
    default:
        // Página 404
        http_response_code(404);
        echo "<h1>404 - Página no encontrada</h1>";
=======
// Definir las páginas disponibles
switch ($page) {
    case 'home':
    case 'inicio':
        include '../app/views/pages/index.php';
        break;
        
    case 'miperfil':
    case 'perfil':
    case 'login':
        include '../app/views/pages/miperfil.php';
        break;
        
    case 'registroUsuario':
    case 'registro':
        include '../app/views/pages/registroUsuario.php';
        break;
        
    case 'servicios':
        include '../app/views/pages/servicios.php';
        break;
        
    case 'tutorias':
        include '../app/views/pages/tutorias.php';
        break;

    case 'agregarTuto':
        include '../app/views/pages/agregarTuto.php';
        break;
        
    case 'faq':
    case 'preguntas':
        include '../app/views/pages/faq.php';
        break;

    default:
        // Si la página no existe, mostrar inicio
        include '../app/views/pages/index.php';
>>>>>>> f1756379b0eb9d4ed1f48399cff16827df07f107
        break;
}
?>