<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agendar Tutoría - TutoX</title>
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/stylesComponentes.css">
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/agendar.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <?php include __DIR__ . '/../componentes/navbar.php'; ?>

    <!-- Header -->
    <div class="tutorias-header">
        <h1>Agendar Tutoría</h1>
        <p>Solicita una sesión con tu tutor</p>
    </div>

    <!-- Contenido -->
    <div class="agendar-container">
        
        <!-- Mensaje de confirmación -->
        <?php if (isset($mensaje)): ?>
            <div class="mensaje-confirmacion">
                <i class="fas fa-check-circle"></i>
                <span><?php echo htmlspecialchars($mensaje); ?></span>
            </div>
        <?php endif; ?>

        <div class="agendar-content">
            
            <!-- Info de la tutoría -->
            <div class="tutoria-info">
                <h3>Información de la Tutoría</h3>
                <div class="tutoria-resumen">
                    <div class="materia-tag"><?php echo htmlspecialchars($tutoria['materia']); ?></div>
                    <h4><?php echo htmlspecialchars($tutoria['titulo']); ?></h4>
                    <p class="tutor-info">
                        <i class="fas fa-user"></i>
                        <?php echo htmlspecialchars($tutoria['tutor_nombre']); ?>
                    </p>
                    <p class="precio-info">
                        <i class="fas fa-money-bill-wave"></i>
                        ₡<?php echo number_format($tutoria['precio'], 0, ',', '.'); ?> por sesión
                    </p>
                    <p class="modalidad-info">
                        <?php if ($tutoria['modalidad'] == 'virtual'): ?>
                            <i class="fas fa-laptop"></i> Virtual
                        <?php elseif ($tutoria['modalidad'] == 'presencial'): ?>
                            <i class="fas fa-map-marker-alt"></i> Presencial
                        <?php else: ?>
                            <i class="fas fa-globe"></i> Ambas modalidades
                        <?php endif; ?>
                    </p>
                </div>
            </div>

            <!-- Formulario de agendar -->
            <div class="formulario-agendar">
                <h3>Detalles de la Cita</h3>
                <form method="POST" class="agendar-form">
                    
                    <div class="form-group">
                        <label for="fecha_solicitada">Fecha preferida</label>
                        <input type="date" id="fecha_solicitada" name="fecha_solicitada" required>
                    </div>

                    <div class="form-group">
                        <label for="hora_solicitada">Hora preferida</label>
                        <select id="hora_solicitada" name="hora_solicitada" required>
                            <option value="">Selecciona una hora</option>
                            <option value="08:00">8:00 AM</option>
                            <option value="09:00">9:00 AM</option>
                            <option value="10:00">10:00 AM</option>
                            <option value="11:00">11:00 AM</option>
                            <option value="12:00">12:00 PM</option>
                            <option value="13:00">1:00 PM</option>
                            <option value="14:00">2:00 PM</option>
                            <option value="15:00">3:00 PM</option>
                            <option value="16:00">4:00 PM</option>
                            <option value="17:00">5:00 PM</option>
                            <option value="18:00">6:00 PM</option>
                            <option value="19:00">7:00 PM</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="mensaje">Mensaje para el tutor (opcional)</label>
                        <textarea id="mensaje" name="mensaje" rows="4" placeholder="Cuéntale al tutor qué temas específicos necesitas repasar o cualquier información relevante..."></textarea>
                    </div>

                    <div class="form-actions">
                        <a href="?page=tutoria-detalle&id=<?php echo $tutoria['id']; ?>" class="btn-cancelar">Cancelar</a>
                        <button type="submit" class="btn-agendar-form">
                            <i class="fas fa-calendar-check"></i>
                            Confirmar Cita
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <?php include __DIR__ . '/../componentes/footer.php'; ?>

</body>
</html>