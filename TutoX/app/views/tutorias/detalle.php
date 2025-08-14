<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($tutoria['titulo']); ?> - TutoX</title>
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/stylesComponentes.css">
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/detalle.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <?php include __DIR__ . '/../componentes/navbar.php'; ?>

    <!-- Header -->
    <div class="tutorias-header">
        <h1><?php echo htmlspecialchars($tutoria['titulo']); ?></h1>
        <p>Información completa de la tutoría</p>
    </div>

    <!-- Detalle de la tutoría -->
    <div class="detalle-container">
        <div class="detalle-content">
            
            <!-- Información principal -->
            <div class="detalle-main">
                <div class="materia-tag-large"><?php echo htmlspecialchars($tutoria['materia']); ?></div>
                
                <div class="descripcion-completa">
                    <h3>Descripción</h3>
                    <p><?php echo nl2br(htmlspecialchars($tutoria['descripcion'])); ?></p>
                </div>

                <div class="modalidad-detalle">
                    <h3>Modalidad</h3>
                    <div class="modalidad-info-large">
                        <?php if ($tutoria['modalidad'] == 'virtual'): ?>
                            <i class="fas fa-laptop"></i> Virtual
                        <?php elseif ($tutoria['modalidad'] == 'presencial'): ?>
                            <i class="fas fa-map-marker-alt"></i> Presencial
                        <?php else: ?>
                            <i class="fas fa-globe"></i> Ambas modalidades
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ($tutoria['ubicacion']): ?>
                    <div class="ubicacion-detalle">
                        <h3>Ubicación</h3>
                        <div class="ubicacion-info-large">
                            <i class="fas fa-map-pin"></i>
                            <span><?php echo htmlspecialchars($tutoria['ubicacion']); ?></span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar con info del tutor y acciones -->
            <div class="detalle-sidebar">
                
                <!-- Info del tutor -->
                <div class="tutor-card">
                    <h3>Tu Tutor</h3>
                    <div class="tutor-info-detalle">
                        <div class="tutor-avatar">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div class="tutor-datos">
                            <h4><?php echo htmlspecialchars($tutoria['tutor_nombre']); ?></h4>
                            <p><?php echo htmlspecialchars($tutoria['tutor_email']); ?></p>
                            <?php if (isset($tutoria['tutor_telefono']) && $tutoria['tutor_telefono']): ?>
                                <p><i class="fas fa-phone"></i> <?php echo htmlspecialchars($tutoria['tutor_telefono']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Precio y acciones -->
                <div class="precio-card">
                    <div class="precio-grande">
                        <span class="precio-valor-grande">₡<?php echo number_format($tutoria['precio'], 0, ',', '.'); ?></span>
                        <span class="precio-texto-grande">por sesión</span>
                    </div>
                    
                    <div class="acciones-detalle">
                        <a href="?page=agendar-tutoria&id=<?php echo $tutoria['id']; ?>" class="btn-agendar">
                            <i class="fas fa-calendar-plus"></i>
                            Agendar Cita
                        </a>
                        <a href="?page=tutorias" class="btn-volver">
                            <i class="fas fa-arrow-left"></i>
                            Volver a Tutorías
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include __DIR__ . '/../componentes/footer.php'; ?>

</body>
</html>