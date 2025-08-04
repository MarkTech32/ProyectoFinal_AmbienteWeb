<?php
// app/controllers/AuthController.php

class AuthController {
    private $usuarioModel;
    
    public function __construct() {
        require_once __DIR__ . '/../models/Usuario.php';
        $this->usuarioModel = new Usuario();
        
        // Iniciar sesión si no está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    // Procesar login
    public function login($email, $password) {
        // Buscar usuario por email
        $usuario = $this->usuarioModel->buscarPorEmail($email);
        
        if (!$usuario) {
            return ['success' => false, 'message' => 'Usuario no encontrado'];
        }
        
        // Verificar contraseña
        if (!$this->usuarioModel->verificarPassword($password, $usuario['password'])) {
            return ['success' => false, 'message' => 'Contraseña incorrecta'];
        }
        
        // Login exitoso - guardar en sesión
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];
        $_SESSION['usuario_email'] = $usuario['email'];
        $_SESSION['logueado'] = true;
        
        return ['success' => true, 'message' => 'Login exitoso'];
    }
    
    // Cerrar sesión
    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?page=home');
        exit();
    }
    
    // Verificar si está logueado
    public function estaLogueado() {
        return isset($_SESSION['logueado']) && $_SESSION['logueado'] === true;
    }
    
    // Obtener datos del usuario actual
    public function usuarioActual() {
        if ($this->estaLogueado()) {
            return [
                'id' => $_SESSION['usuario_id'],
                'nombre' => $_SESSION['usuario_nombre'],
                'email' => $_SESSION['usuario_email']
            ];
        }
        return null;
    }
}
?>