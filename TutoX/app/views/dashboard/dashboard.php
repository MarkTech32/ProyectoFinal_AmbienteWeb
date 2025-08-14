<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Dashboard - TutoX</title>
    <!-- CSS base -->
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/stylesComponentes.css">
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/dashboard.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <?php include __DIR__ . '/../componentes/navbar.php'; ?>

    <div class="dashboard-container">
        <!-- Header de bienvenida -->
        <div class="welcome-header">
            <div class="welcome-content">
                <h1>¡Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?>!</h1>
                <p>¿Qué te gustaría hacer hoy?</p>
            </div>
            <div class="user-avatar">
                <i class="fas fa-user-circle"></i>
            </div>
        </div>

        <!-- Opciones principales -->
        <div class="dashboard-options">
            <div class="option-card" onclick="location.href='?page=tutorias'">
                <div class="card-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="card-content">
                    <h3>Buscar Tutorías</h3>
                    <p>Encuentra el apoyo académico que necesitas</p>
                </div>
                <div class="card-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>

            <div class="option-card" onclick="location.href='?page=servicios'">
                <div class="card-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="card-content">
                    <h3>Buscar Servicios</h3>
                    <p>Explora servicios profesionales disponibles</p>
                </div>
                <div class="card-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>

            <div class="option-card" onclick="location.href='?page=mis-publicaciones'">
                <div class="card-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="card-content">
                    <h3>Ver mis Publicaciones</h3>
                    <p>Gestiona tus servicios y tutorías publicadas</p>
                </div>
                <div class="card-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>


    </div>

    <!-- Footer -->
    <?php include __DIR__ . '/../componentes/footer.php'; ?>

</body>
</html>