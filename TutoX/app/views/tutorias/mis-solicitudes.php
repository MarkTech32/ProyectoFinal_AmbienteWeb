<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Solicitudes - TutoX</title>
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/stylesComponentes.css">
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/mis-solicitudes.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <?php include __DIR__ . '/../componentes/navbar.php'; ?>

    <!-- Header -->
    <div class="tutorias-header">
        <h1>Mis Solicitudes</h1>
        <p>Gestiona las solicitudes de citas para tus tutorías</p>
    </div>

    <!-- Lista de solicitudes -->
    <div class="solicitudes-container">
        
        <!-- Mensajes de confirmación -->
        <?php if (isset($_GET['mensaje'])): ?>
            <?php if ($_GET['mensaje'] == 'aceptada'): ?>
                <div class="mensaje-confirmacion">
                    <i class="fas fa-check-circle"></i>
                    <span>¡Solicitud aceptada exitosamente! El estudiante será notificado.</span>
                </div>
            <?php elseif ($_GET['mensaje'] == 'rechazada'): ?>
                <div class="mensaje-rechazo">
                    <i class="fas fa-times-circle"></i>
                    <span>Solicitud rechazada. El estudiante será notificado.</span>
                </div>
            <?php elseif ($_GET['mensaje'] == 'completada'): ?>
                <div class="mensaje-completada">
                    <i class="fas fa-check-circle"></i>
                    <span>¡Tutoría completada exitosamente!</span>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="mensaje-error">
                <i class="fas fa-exclamation-triangle"></i>
                <span>Error al procesar la solicitud. Inténtalo nuevamente.</span>
            </div>
        <?php endif; ?>

        <?php if (!empty($solicitudes)): ?>
            <div class="solicitudes-grid">
                <?php foreach ($solicitudes as $solicitud): ?>
                    <div class="solicitud-card">
                        
                        <!-- Estado de la solicitud -->
                        <div class="estado-tag estado-<?php echo $solicitud['estado']; ?>">
                            <?php 
                            switch($solicitud['estado']) {
                                case 'pendiente':
                                    echo '<i class="fas fa-clock"></i> Pendiente';
                                    break;
                                case 'confirmada':
                                    echo '<i class="fas fa-check"></i> Confirmada';
                                    break;
                                case 'rechazada':
                                    echo '<i class="fas fa-times"></i> Rechazada';
                                    break;
                                case 'completada':
                                    echo '<i class="fas fa-check-circle"></i> Completada';
                                    break;
                                default:
                                    echo '<i class="fas fa-question"></i> ' . ucfirst($solicitud['estado']);
                            }
                            ?>
                        </div>

                        <!-- Información de la tutoría solicitada -->
                        <div class="solicitud-info">
                            <div class="materia-tag"><?php echo htmlspecialchars($solicitud['materia']); ?></div>
                            <h3><?php echo htmlspecialchars($solicitud['titulo']); ?></h3>
                            
                            <!-- Info del estudiante -->
                            <div class="estudiante-info">
                                <h4>Solicitado por:</h4>
                                <div class="estudiante-datos">
                                    <div class="estudiante-avatar">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                    <div class="estudiante-detalles">
                                        <p class="nombre"><?php echo htmlspecialchars($solicitud['cliente_nombre']); ?></p>
                                        <p class="email"><?php echo htmlspecialchars($solicitud['cliente_email']); ?></p>
                                        <?php if ($solicitud['cliente_telefono']): ?>
                                            <p class="telefono"><i class="fas fa-phone"></i> <?php echo htmlspecialchars($solicitud['cliente_telefono']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Fecha y hora solicitada -->
                            <div class="fecha-hora-solicitada">
                                <h4>Fecha y hora solicitada:</h4>
                                <div class="fecha-hora-info">
                                    <div class="fecha-info">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span><?php echo date('d/m/Y', strtotime($solicitud['fecha_solicitada'])); ?></span>
                                    </div>
                                    <div class="hora-info">
                                        <i class="fas fa-clock"></i>
                                        <span><?php echo date('g:i A', strtotime($solicitud['hora_solicitada'])); ?></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Modalidad -->
                            <div class="modalidad-info">
                                <?php if ($solicitud['modalidad'] == 'virtual'): ?>
                                    <i class="fas fa-laptop"></i> Virtual
                                <?php elseif ($solicitud['modalidad'] == 'presencial'): ?>
                                    <i class="fas fa-map-marker-alt"></i> Presencial
                                <?php else: ?>
                                    <i class="fas fa-globe"></i> Ambas modalidades
                                <?php endif; ?>
                                
                                <?php if ($solicitud['ubicacion']): ?>
                                    <span class="ubicacion">- <?php echo htmlspecialchars($solicitud['ubicacion']); ?></span>
                                <?php endif; ?>
                            </div>

                            <!-- Mensaje del estudiante -->
                            <?php if ($solicitud['mensaje']): ?>
                                <div class="mensaje-estudiante">
                                    <h4>Mensaje del estudiante:</h4>
                                    <p>"<?php echo htmlspecialchars($solicitud['mensaje']); ?>"</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Footer con precio y fecha de solicitud -->
                        <div class="solicitud-footer">
                            <div class="precio-solicitud">
                                <span class="precio-valor">₡<?php echo number_format($solicitud['precio'], 0, ',', '.'); ?></span>
                                <span class="precio-texto">por sesión</span>
                            </div>
                            <div class="fecha-solicitud">
                                <small>Solicitada el <?php echo date('d/m/Y', strtotime($solicitud['fecha_solicitud'])); ?></small>
                            </div>
                        </div>

                        <!-- Acciones del tutor -->
                        <?php if ($solicitud['estado'] == 'pendiente'): ?>
                            <div class="acciones-tutor">
                                <a href="?page=aceptar-solicitud&id=<?php echo $solicitud['id']; ?>" 
                                   class="btn-aceptar"
                                   onclick="return confirm('¿Confirmas que puedes dar la tutoría en esta fecha y hora?')">
                                    <i class="fas fa-check"></i>
                                    Aceptar
                                </a>
                                <a href="?page=rechazar-solicitud&id=<?php echo $solicitud['id']; ?>" 
                                   class="btn-rechazar"
                                   onclick="return confirm('¿Estás seguro de que quieres rechazar esta solicitud?')">
                                    <i class="fas fa-times"></i>
                                    Rechazar
                                </a>
                            </div>
                        <?php elseif ($solicitud['estado'] == 'confirmada'): ?>
                            <div class="acciones-tutor">
                                <a href="?page=completar-tutoria&id=<?php echo $solicitud['id']; ?>" 
                                   class="btn-completar-tutor"
                                   onclick="return confirm('¿Confirmas que la tutoría fue realizada?')">
                                    <i class="fas fa-check-circle"></i>
                                    Completar Tutoría
                                </a>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-solicitudes">
                <i class="fas fa-inbox"></i>
                <h3>No tienes solicitudes pendientes</h3>
                <p>Cuando los estudiantes soliciten tus tutorías, aparecerán aquí.</p>
                <a href="?page=crear-tutoria" class="btn-crear-primera">Crear Nueva Tutoría</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <?php include __DIR__ . '/../componentes/footer.php'; ?>

</body>
</html>