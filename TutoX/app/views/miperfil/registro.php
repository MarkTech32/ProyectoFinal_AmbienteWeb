<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - TutoX</title>
    <!-- CSS base con rutas corregidas -->
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/stylesComponentes.css">
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/miperfil.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <?php include __DIR__ . '/../componentes/navbar.php'; ?>

    <div class="contenedor-login">
        <!-- Sección de bienvenida -->
        <div class="seccion-bienvenida">
            <div class="contenido-bienvenida">
                <h1>¡Únete a tutoX!</h1>
                <p>Crea tu cuenta y comienza a formar parte de la comunidad estudiantil más grande.</p>
                <div class="caracteristicas">
                    <div class="caracteristica">
                        <i class="fas fa-user-plus"></i>
                        <span>Registro rápido y fácil</span>
                    </div>
                    <div class="caracteristica">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Acceso a tutorías</span>
                    </div>
                    <div class="caracteristica">
                        <i class="fas fa-handshake"></i>
                        <span>Ofrece tus servicios</span>
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

                <?php if (isset($error)): ?>
                    <div class="error-mensaje" style="color: red; text-align: center; margin-bottom: 15px;">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <form class="formulario-login" action="?page=registro" method="POST">
                    <div class="grupo-input">
                        <label for="nombre">Nombre completo</label>
                        <div class="input-con-icono">
                            <i class="fas fa-user"></i>
                            <input type="text" id="nombre" name="nombre" placeholder="Tu nombre completo" required>
                        </div>
                    </div>

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

                    <div class="grupo-input">
                        <label for="telefono">Teléfono (opcional)</label>
                        <div class="input-con-icono">
                            <i class="fas fa-phone"></i>
                            <input type="tel" id="telefono" name="telefono" placeholder="Tu número de teléfono">
                        </div>
                    </div>

                    <div class="grupo-input">
                        <label for="carrera">Carrera (opcional)</label>
                        <div class="input-con-icono">
                            <i class="fas fa-graduation-cap"></i>
                            <input type="text" id="carrera" name="carrera" placeholder="Tu carrera universitaria">
                        </div>
                    </div>

                    <button type="submit" class="boton-login">
                        <span>Crear Cuenta</span>
                        <i class="fas fa-user-plus"></i>
                    </button>
                </form>

                <div class="registro-link">
                    <p>¿Ya tienes una cuenta? <a href="?page=miperfil">Inicia sesión aquí</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
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