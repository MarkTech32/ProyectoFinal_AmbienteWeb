<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir el controlador de autenticación
require_once __DIR__ . '/../../controllers/AuthController.php';
require_once __DIR__ . '/../../models/Usuario.php';

$auth = new AuthController();
$usuarioModel = new Usuario();

// Si ya está logueado, mostrar mensaje de bienvenida
if ($auth->estaLogueado()) {
    $usuario = $auth->usuarioActual();
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Registro Exitoso - TutoX</title>
        <link rel="stylesheet" href="css/stylesComponentes.css">
        <link rel="stylesheet" href="css/miperfil.css">
    </head>
    <body>
        <?php include __DIR__ . '/../componentes/navbar.php'; ?>
        
        <div style="padding-top: 100px; text-align: center;">
            <h1>¡Registro exitoso!</h1>
            <h2>¡Bienvenido, <?= htmlspecialchars($usuario['nombre']) ?>!</h2>
            <p>Email: <?= htmlspecialchars($usuario['email']) ?></p>
            <p>Tu cuenta ha sido creada correctamente.</p>
            <br>
            <a href="index.php?page=registroUsuario&action=logout" class="boton boton-primario">Cerrar Sesión</a>
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

$mensaje = '';
$tipo_mensaje = '';

// Procesar formulario de registro
if ($_POST) {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $carrera = $_POST['carrera'] ?? '';
    
    // Validaciones básicas
    if (empty($nombre) || empty($email) || empty($password)) {
        $mensaje = 'Por favor completa todos los campos obligatorios';
        $tipo_mensaje = 'error';
    } else {
        // Verificar si el email ya existe
        $usuarioExistente = $usuarioModel->buscarPorEmail($email);
        
        if ($usuarioExistente) {
            $mensaje = 'Este email ya está registrado';
            $tipo_mensaje = 'error';
        } else {
            // Crear el usuario
            $resultado = $usuarioModel->crear($nombre, $email, $password, $telefono, $carrera);
            
            if ($resultado) {
                // Registro exitoso - hacer login automático
                $loginResultado = $auth->login($email, $password);
                
                if ($loginResultado['success']) {
                    header('Location: index.php?page=registroUsuario');
                    exit();
                } else {
                    $mensaje = 'Usuario creado, pero hubo un error al iniciar sesión';
                    $tipo_mensaje = 'error';
                }
            } else {
                $mensaje = 'Error al crear el usuario';
                $tipo_mensaje = 'error';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - TutoX</title>
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
                <h1>¡Únete a tutoX!</h1>
                <p>Crea tu cuenta y comienza a formar parte de nuestra comunidad estudiantil.</p>
                <div class="caracteristicas">
                    <div class="caracteristica">
                        <i class="fas fa-user-plus"></i>
                        <span>Registro gratuito</span>
                    </div>
                    <div class="caracteristica">
                        <i class="fas fa-handshake"></i>
                        <span>Conecta con estudiantes</span>
                    </div>
                    <div class="caracteristica">
                        <i class="fas fa-rocket"></i>
                        <span>Comienza de inmediato</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario de registro -->
        <div class="seccion-formulario">
            <div class="contenedor-form">
                <div class="header-form">
                    <h2>Crear Cuenta</h2>
                    <p>Completa tus datos para registrarte</p>
                </div>

                <?php if ($mensaje): ?>
                    <div style="padding: 10px; margin-bottom: 15px; border-radius: 5px; <?= $tipo_mensaje == 'error' ? 'background: #ffebee; color: #c62828; border: 1px solid #ef5350;' : 'background: #e8f5e8; color: #2e7d32; border: 1px solid #4caf50;' ?>">
                        <?= htmlspecialchars($mensaje) ?>
                    </div>
                <?php endif; ?>

                <form class="formulario-login" method="POST">
                    <div class="grupo-input">
                        <label for="nombre">Nombre completo *</label>
                        <div class="input-con-icono">
                            <i class="fas fa-user"></i>
                            <input type="text" id="nombre" name="nombre" placeholder="Tu nombre completo" required value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="grupo-input">
                        <label for="email">Correo electrónico *</label>
                        <div class="input-con-icono">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" placeholder="tucorreo@universidad.com" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="grupo-input">
                        <label for="password">Contraseña *</label>
                        <div class="input-con-icono">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" placeholder="••••••••" required>
                            <button type="button" class="toggle-password" onclick="togglePassword()">
                                <i class="fas fa-eye" id="toggle-icon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="grupo-input">
                        <label for="telefono">Teléfono</label>
                        <div class="input-con-icono">
                            <i class="fas fa-phone"></i>
                            <input type="tel" id="telefono" name="telefono" placeholder="88888888" value="<?= htmlspecialchars($_POST['telefono'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="grupo-input">
                        <label for="carrera">Carrera</label>
                        <div class="input-con-icono">
                            <i class="fas fa-graduation-cap"></i>
                            <input type="text" id="carrera" name="carrera" placeholder="Ingeniería en Sistemas" value="<?= htmlspecialchars($_POST['carrera'] ?? '') ?>">
                        </div>
                    </div>

                    <button type="submit" class="boton-login">
                        <span>Crear Cuenta</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <div class="registro-link">
                    <p>¿Ya tienes una cuenta? <a href="index.php?page=miperfil">Inicia sesión aquí</a></p>
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