<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - TutoX</title>

    <!-- CSS base -->
    <link rel="stylesheet" href="css/stylesComponentes.css">

    <!-- CSS específico para Mi Perfil -->
    <link rel="stylesheet" href="css/miperfil.css">
</head>
<body>
    <!-- Navbar -->
    <?php include '../app/views/componentes/navbar.php'; ?>

    <!-- Sección principal -->
    <section class="seccion-perfil">
        <div class="contenedor">
            <h1>Mi Perfil</h1>
            <p>Visualiza y gestiona tu información personal, servicios y configuración</p>
        </div>
    </section>

    <!-- Lista de elementos del perfil -->
    <section class="lista-perfil">
        <div class="contenedor">
            <div class="cuadricula-perfil">

                <!-- Caja 1 -->
                <div class="tarjeta-perfil">
                    <div class="categoria-tag">Información Personal</div>
                    <h3>Datos Básicos</h3>
                    <p class="descripcion">Nombre, carrera, universidad y correo del usuario.</p>
                </div>

                <!-- Caja 2 -->
                <div class="tarjeta-perfil">
                    <div class="categoria-tag">Áreas de Dominio</div>
                    <h3>Especialidades</h3>
                    <p class="descripcion">Lista de conocimientos, habilidades o temas dominados por el usuario.</p>
                </div>

                <!-- Caja 3 -->
                <div class="tarjeta-perfil">
                    <div class="categoria-tag">Servicios</div>
                    <h3>Servicios Activos</h3>
                    <p class="descripcion">Servicios publicados por el usuario disponibles para otros.</p>
                </div>

                <!-- Caja 4 -->
                <div class="tarjeta-perfil">
                    <div class="categoria-tag">Solicitudes</div>
                    <h3>Historial de Solicitudes</h3>
                    <p class="descripcion">Registros de servicios que se han solicitado o reservado.</p>
                </div>

                <!-- Caja 5 -->
                <div class="tarjeta-perfil">
                    <div class="categoria-tag">Valoraciones</div>
                    <h3>Comentarios y Puntuaciones</h3>
                    <p class="descripcion">Opiniones de otros usuarios sobre los servicios ofrecidos.</p>
                </div>

                <!-- Caja 6 -->
                <div class="tarjeta-perfil">
                    <div class="categoria-tag">Configuración</div>
                    <h3>Editar Perfil</h3>
                    <p class="descripcion">Opciones para modificar tu información o cerrar sesión.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../app/views/componentes/footer.php'; ?>
</body>
</html>