<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil - TutoX</title>
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/stylesComponentes.css">
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/perfil.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <?php include __DIR__ . '/../componentes/navbar.php'; ?>

    <!-- Header -->
    <div class="perfil-header">
        <h1>Mi Perfil</h1>
        <p>Información personal y reseñas recibidas</p>
    </div>

    <!-- Contenido del perfil -->
    <div class="perfil-container">
        
        <div class="perfil-content">
            
            <!-- Información personal -->
            <div class="info-personal">
                <div class="usuario-card">
                    <div class="usuario-avatar">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="usuario-info">
                        <h2><?php echo htmlspecialchars($usuario['nombre']); ?></h2>
                        <p class="usuario-email">
                            <i class="fas fa-envelope"></i>
                            <?php echo htmlspecialchars($usuario['email']); ?>
                        </p>
                        <?php if ($usuario['telefono']): ?>
                            <p class="usuario-telefono">
                                <i class="fas fa-phone"></i>
                                <?php echo htmlspecialchars($usuario['telefono']); ?>
                            </p>
                        <?php endif; ?>
                        <?php if ($usuario['carrera']): ?>
                            <p class="usuario-carrera">
                                <i class="fas fa-graduation-cap"></i>
                                <?php echo htmlspecialchars($usuario['carrera']); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Estadísticas -->
                <div class="estadisticas-card">
                    <h3>Estadísticas</h3>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="stat-info">
                                <span class="stat-number"><?php echo $promedioCalificacion['promedio']; ?>/5</span>
                                <span class="stat-label">Calificación Promedio</span>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-comments"></i>
                            </div>
                            <div class="stat-info">
                                <span class="stat-number"><?php echo $promedioCalificacion['total']; ?></span>
                                <span class="stat-label">Reseñas Recibidas</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reseñas recibidas -->
            <div class="resenas-section">
                <div class="resenas-header">
                    <h3>Reseñas Recibidas</h3>
                    <?php if ($promedioCalificacion['total'] > 0): ?>
                        <div class="promedio-display">
                            <div class="estrellas-promedio">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <?php if ($i <= floor($promedioCalificacion['promedio'])): ?>
                                        <i class="fas fa-star"></i>
                                    <?php elseif ($i <= $promedioCalificacion['promedio']): ?>
                                        <i class="fas fa-star-half-alt"></i>
                                    <?php else: ?>
                                        <i class="far fa-star"></i>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                            <span class="promedio-texto"><?php echo $promedioCalificacion['promedio']; ?> de 5</span>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (!empty($resenas)): ?>
                    <div class="resenas-grid">
                        <?php foreach ($resenas as $resena): ?>
                            <div class="resena-card">
                                
                                <!-- Calificación con estrellas -->
                                <div class="resena-header">
                                    <div class="estrellas-resena">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <?php if ($i <= $resena['puntuacion']): ?>
                                                <i class="fas fa-star"></i>
                                            <?php else: ?>
                                                <i class="far fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="fecha-resena"><?php echo date('d/m/Y', strtotime($resena['fecha'])); ?></span>
                                </div>

                                <!-- Información de la tutoría -->
                                <div class="tutoria-resena">
                                    <div class="materia-tag-small"><?php echo htmlspecialchars($resena['materia']); ?></div>
                                    <h4><?php echo htmlspecialchars($resena['titulo']); ?></h4>
                                    <p class="fecha-tutoria">
                                        <i class="fas fa-calendar-alt"></i>
                                        <?php echo date('d/m/Y', strtotime($resena['fecha_solicitada'])); ?>
                                    </p>
                                </div>

                                <!-- Comentario -->
                                <?php if ($resena['comentario']): ?>
                                    <div class="comentario-resena">
                                        <p>"<?php echo htmlspecialchars($resena['comentario']); ?>"</p>
                                    </div>
                                <?php endif; ?>

                                <!-- Info del estudiante -->
                                <div class="estudiante-resena">
                                    <i class="fas fa-user"></i>
                                    <span><?php echo htmlspecialchars($resena['cliente_nombre']); ?></span>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-resenas">
                        <i class="fas fa-star-o"></i>
                        <h4>No tienes reseñas aún</h4>
                        <p>Cuando completes tus primeras tutorías y recibas reseñas, aparecerán aquí.</p>
                        <a href="?page=crear-tutoria" class="btn-crear-tutoria-perfil">
                            <i class="fas fa-plus"></i>
                            Crear Mi Primera Tutoría
                        </a>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <?php include __DIR__ . '/../componentes/footer.php'; ?>

</body>
</html>