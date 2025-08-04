<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir el controlador de autenticación
require_once __DIR__ . '/../../controllers/AuthController.php';
$auth = new AuthController();

// Procesar logout PRIMERO
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    $auth->logout();
}

$mensaje = '';
$tipo_mensaje = '';

// Procesar formulario de login
if ($_POST) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $resultado = $auth->login($email, $password);
        
        if ($resultado['success']) {
            // Login exitoso - redirigir
            header('Location: index.php?page=miperfil');
            exit();
        } else {
            // Error en login
            $mensaje = $resultado['message'];
            $tipo_mensaje = 'error';
        }
    }
}

// Si ya está logueado, mostrar perfil
if ($auth->estaLogueado()) {
    $usuario = $auth->usuarioActual();
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Mi Perfil - TutoX</title>
        <link rel="stylesheet" href="css/stylesComponentes.css">
        <link rel="stylesheet" href="css/miperfil.css">
    </head>
    <body>
        <?php include __DIR__ . '/../componentes/navbar.php'; ?>
        
        <div style="padding-top: 100px; text-align: center;">
            <h1>¡Bienvenido, <?= htmlspecialchars($usuario['nombre']) ?>!</h1>
            <p>Email: <?= htmlspecialchars($usuario['email']) ?></p>
            <br>
            <a href="index.php?page=miperfil&action=logout" class="boton boton-primario">Cerrar Sesión</a>
        </div>
        
        <?php include __DIR__ . '/../componentes/footer.php'; ?>
    </body>
    </html>
    <?php
    exit();
}

// Procesar logout
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    $auth->logout();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil - TutoX</title>
    <link rel="stylesheet" href="css/stylesComponentes.css">
    <link rel="stylesheet" href="css/miperfil.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

    <?php include __DIR__ . '/../componentes/navbar.php'; ?>

    <div class="contenedor-login">
        <!-- Sección de bienvenida -->
        <div class="seccion-bienvenida">
            <div class="contenido-bienvenida">
                <h1>¡Bienvenido a tutoX!</h1>
                <p>La plataforma donde estudiantes universitarios conectan para compartir conocimiento y crecer juntos.</p>
                <div class="caracteristicas">
                    <div class="caracteristica">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Tutorías personalizadas</span>
                    </div>
                    <div class="caracteristica">
                        <i class="fas fa-users"></i>
                        <span>Comunidad estudiantil</span>
                    </div>
                    <div class="caracteristica">
                        <i class="fas fa-star"></i>
                        <span>Servicios profesionales</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario de login -->
        <div class="seccion-formulario">
            <div class="contenedor-form">
                <div class="header-form">
                    <h2>Iniciar Sesión</h2>
                    <p>Accede a tu cuenta para continuar</p>
                </div>

                <?php if ($mensaje): ?>
                    <div style="padding: 10px; margin-bottom: 15px; border-radius: 5px; <?= $tipo_mensaje == 'error' ? 'background: #ffebee; color: #c62828; border: 1px solid #ef5350;' : 'background: #e8f5e8; color: #2e7d32; border: 1px solid #4caf50;' ?>">
                        <?= htmlspecialchars($mensaje) ?>
                    </div>
                <?php endif; ?>

                <form class="formulario-login" method="POST">
                    <div class="grupo-input">
                        <label for="email">Correo electrónico</label>
                        <div class="input-con-icono">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" placeholder="tucorreo@universidad.com" required>
                        </div>
                    </div>

                    <div class="grupo-input">
                        <label for="password">Contraseña</label>
                        <div class="input-con-icono">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" placeholder="••••••••" required>
                            <button type="button" class="toggle-password" onclick="togglePassword()">
                                <i class="fas fa-eye" id="toggle-icon"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="boton-login">
                        <span>Iniciar Sesión</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <div class="registro-link">
                    <p>¿No tienes una cuenta? <a href="#">Regístrate aquí</a></p>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../componentes/footer.php'; ?>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggle-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>

</body>
</html>