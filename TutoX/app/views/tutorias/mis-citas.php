<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Citas Agendadas - TutoX</title>
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/stylesComponentes.css">
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/mis-citas.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <?php include __DIR__ . '/../componentes/navbar.php'; ?>

    <!-- Header -->
    <div class="tutorias-header">
        <h1>Mis Citas Agendadas</h1>
        <p>Gestiona tus tutorías programadas</p>
        <a href="?page=tutorias" class="btn-crear-tutoria">
            <i class="fas fa-search"></i>
            Buscar Más Tutorías
        </a>
    </div>

    <!-- Lista de citas -->
    <div class="mis-citas-container">
        <?php if (!empty($citas)): ?>
            <div class="citas-grid">
                <?php foreach ($citas as $cita): ?>
                    <div class="cita-card">
                        
                        <!-- Estado de la cita -->
                        <div class="estado-tag estado-<?php echo $cita['estado']; ?>">
                            <?php 
                            switch($cita['estado']) {
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
                                    echo '<i class="fas fa-question"></i> ' . ucfirst($cita['estado']);
                            }
                            ?>
                        </div>

                        <!-- Información de la tutoría -->
                        <div class="cita-info">
                            <div class="materia-tag"><?php echo htmlspecialchars($cita['materia']); ?></div>
                            <h3><?php echo htmlspecialchars($cita['titulo']); ?></h3>
                            
                            <div class="tutor-info">
                                <i class="fas fa-user"></i>
                                <span><?php echo htmlspecialchars($cita['tutor_nombre']); ?></span>
                            </div>

                            <div class="fecha-hora-info">
                                <div class="fecha-info">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span><?php echo date('d/m/Y', strtotime($cita['fecha_solicitada'])); ?></span>
                                </div>
                                <div class="hora-info">
                                    <i class="fas fa-clock"></i>
                                    <span><?php echo date('g:i A', strtotime($cita['hora_solicitada'])); ?></span>
                                </div>
                            </div>

                            <div class="modalidad-info">
                                <?php if ($cita['modalidad'] == 'virtual'): ?>
                                    <i class="fas fa-laptop"></i> Virtual
                                <?php elseif ($cita['modalidad'] == 'presencial'): ?>
                                    <i class="fas fa-map-marker-alt"></i> Presencial
                                <?php else: ?>
                                    <i class="fas fa-globe"></i> Ambas
                                <?php endif; ?>
                                
                                <?php if ($cita['ubicacion']): ?>
                                    <span class="ubicacion">- <?php echo htmlspecialchars($cita['ubicacion']); ?></span>
                                <?php endif; ?>
                            </div>

                            <?php if ($cita['mensaje']): ?>
                                <div class="mensaje-usuario">
                                    <h4>Tu mensaje:</h4>
                                    <p>"<?php echo htmlspecialchars($cita['mensaje']); ?>"</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Footer de la cita -->
                        <div class="cita-footer">
                            <div class="precio-cita">
                                <span class="precio-valor">₡<?php echo number_format($cita['precio'], 0, ',', '.'); ?></span>
                                <span class="precio-texto">por sesión</span>
                            </div>
                            
                            <div class="fecha-solicitud">
                                <small>Agendada el <?php echo date('d/m/Y', strtotime($cita['fecha_solicitud'])); ?></small>
                            </div>
                        </div>

                        <!-- Contacto del tutor -->
                        <?php if ($cita['estado'] == 'confirmada'): ?>
                            <div class="contacto-tutor">
                                <h4>Contacta a tu tutor:</h4>
                                <div class="contacto-info">
                                    <a href="mailto:<?php echo $cita['tutor_email']; ?>" class="contacto-link">
                                        <i class="fas fa-envelope"></i> <?php echo htmlspecialchars($cita['tutor_email']); ?>
                                    </a>
                                    <?php if ($cita['tutor_telefono']): ?>
                                        <a href="tel:<?php echo $cita['tutor_telefono']; ?>" class="contacto-link">
                                            <i class="fas fa-phone"></i> <?php echo htmlspecialchars($cita['tutor_telefono']); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-citas">
                <i class="fas fa-calendar-times"></i>
                <h3>No tienes citas agendadas</h3>
                <p>¡Explora nuestras tutorías y agenda tu primera sesión!</p>
                <a href="?page=tutorias" class="btn-crear-primera">Buscar Tutorías</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <?php include __DIR__ . '/../componentes/footer.php'; ?>

</body>
</html>