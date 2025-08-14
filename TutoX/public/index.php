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
        break;
}
?>