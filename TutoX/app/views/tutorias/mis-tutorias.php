<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Publicaciones - TutoX</title>
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/stylesComponentes.css">
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/tutorias.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <?php include __DIR__ . '/../componentes/navbar.php'; ?>

    <!-- Header -->
    <div class="tutorias-header">
        <h1>Mis Publicaciones</h1>
        <p>Gestiona tus tutorías publicadas</p>
        <a href="?page=crear-tutoria" class="btn-crear-tutoria">
            <i class="fas fa-plus"></i>
            Nueva Tutoría
        </a>
    </div>

    <!-- Grid de mis tutorías -->
    <div class="mis-tutorias-container">
        <?php if (!empty($tutorias)): ?>
            <div class="tutorias-grid">
                <?php foreach ($tutorias as $tutoria): ?>
                    <div class="tutoria-card">
                        
                        <div class="materia-tag"><?php echo htmlspecialchars($tutoria['materia']); ?></div>
                        
                        <h3><?php echo htmlspecialchars($tutoria['titulo']); ?></h3>
                        
                        <p class="descripcion"><?php echo htmlspecialchars(substr($tutoria['descripcion'], 0, 120)) . '...'; ?></p>
                        
                        <div class="modalidad-info">
                            <?php if ($tutoria['modalidad'] == 'virtual'): ?>
                                <i class="fas fa-laptop"></i> Virtual
                            <?php elseif ($tutoria['modalidad'] == 'presencial'): ?>
                                <i class="fas fa-map-marker-alt"></i> Presencial
                            <?php else: ?>
                                <i class="fas fa-globe"></i> Ambas
                            <?php endif; ?>
                        </div>

                        <?php if ($tutoria['ubicacion']): ?>
                            <div class="ubicacion-info">
                                <i class="fas fa-map-pin"></i>
                                <span><?php echo htmlspecialchars($tutoria['ubicacion']); ?></span>
                            </div>
                        <?php endif; ?>

                        <div class="tutoria-stats">
                            <div class="stat-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span><?php echo date('d/m/Y', strtotime($tutoria['fecha_creacion'])); ?></span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-eye"></i>
                                <span><?php echo $tutoria['activa'] ? 'Activa' : 'Inactiva'; ?></span>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="precio">
                                <span class="precio-valor">₡<?php echo number_format($tutoria['precio'], 0, ',', '.'); ?></span>
                                <span class="precio-texto">por sesión</span>
                            </div>
                            <div class="tutoria-actions">
                                <a href="?page=editar-tutoria&id=<?php echo $tutoria['id']; ?>" class="btn-editar">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-tutorias">
                <i class="fas fa-book-open"></i>
                <h3>No has publicado tutorías aún</h3>
                <p>¡Crea tu primera tutoría y comparte tu conocimiento!</p>
                <a href="?page=crear-tutoria" class="btn-crear-primera">Crear Primera Tutoría</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <?php include __DIR__ . '/../componentes/footer.php'; ?>

</body>
</html>