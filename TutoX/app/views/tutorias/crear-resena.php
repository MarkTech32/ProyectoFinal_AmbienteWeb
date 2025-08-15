<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dejar Reseña - TutoX</title>
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/stylesComponentes.css">
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/crear-resena.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <?php include __DIR__ . '/../componentes/navbar.php'; ?>

    <!-- Header -->
    <div class="tutorias-header">
        <h1>Dejar Reseña</h1>
        <p>Comparte tu experiencia con otros estudiantes</p>
    </div>

    <!-- Contenido -->
    <div class="resena-container">
        
        <div class="resena-content">
            
            <!-- Info de la tutoría completada -->
            <div class="tutoria-info">
                <h3>Tutoría Completada</h3>
                <div class="tutoria-resumen">
                    <div class="materia-tag"><?php echo htmlspecialchars($reserva['materia']); ?></div>
                    <h4><?php echo htmlspecialchars($reserva['titulo']); ?></h4>
                    <p class="tutor-info">
                        <i class="fas fa-user"></i>
                        Tutor: <?php echo htmlspecialchars($reserva['tutor_nombre']); ?>
                    </p>
                    <p class="fecha-info">
                        <i class="fas fa-calendar-alt"></i>
                        <?php echo date('d/m/Y', strtotime($reserva['fecha_solicitada'])); ?> a las <?php echo date('g:i A', strtotime($reserva['hora_solicitada'])); ?>
                    </p>
                </div>
            </div>

            <!-- Formulario de reseña -->
            <div class="formulario-resena">
                <h3>Tu Reseña</h3>
                
                <?php if (isset($error)): ?>
                    <div class="mensaje-error">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span><?php echo htmlspecialchars($error); ?></span>
                    </div>
                <?php endif; ?>

                <form method="POST" class="resena-form">
                    
                    <!-- Calificación con estrellas -->
                    <div class="form-group">
                        <label>Calificación</label>
                        <div class="estrellas-rating">
                            <input type="radio" id="star5" name="puntuacion" value="5" required>
                            <label for="star5" title="5 estrellas"><i class="fas fa-star"></i></label>
                            
                            <input type="radio" id="star4" name="puntuacion" value="4">
                            <label for="star4" title="4 estrellas"><i class="fas fa-star"></i></label>
                            
                            <input type="radio" id="star3" name="puntuacion" value="3">
                            <label for="star3" title="3 estrellas"><i class="fas fa-star"></i></label>
                            
                            <input type="radio" id="star2" name="puntuacion" value="2">
                            <label for="star2" title="2 estrellas"><i class="fas fa-star"></i></label>
                            
                            <input type="radio" id="star1" name="puntuacion" value="1">
                            <label for="star1" title="1 estrella"><i class="fas fa-star"></i></label>
                        </div>
                        <p class="rating-text">Selecciona tu calificación</p>
                    </div>

                    <!-- Comentario -->
                    <div class="form-group">
                        <label for="comentario">Comentario (opcional)</label>
                        <textarea id="comentario" name="comentario" rows="5" placeholder="Cuéntanos sobre tu experiencia con esta tutoría. ¿Qué te gustó? ¿Qué podría mejorar el tutor?"></textarea>
                    </div>

                    <div class="form-actions">
                        <a href="?page=mis-citas" class="btn-cancelar">Cancelar</a>
                        <button type="submit" class="btn-enviar-resena">
                            <i class="fas fa-paper-plane"></i>
                            Enviar Reseña
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <?php include __DIR__ . '/../componentes/footer.php'; ?>

    <script>
        // Interactividad de las estrellas
        const stars = document.querySelectorAll('.estrellas-rating input');
        const labels = document.querySelectorAll('.estrellas-rating label');
        const ratingText = document.querySelector('.rating-text');

        stars.forEach((star, index) => {
            star.addEventListener('change', function() {
                const rating = this.value;
                const messages = {
                    '1': 'Muy malo',
                    '2': 'Malo', 
                    '3': 'Regular',
                    '4': 'Bueno',
                    '5': 'Excelente'
                };
                ratingText.textContent = `${rating} estrellas - ${messages[rating]}`;
            });
        });
    </script>

</body>
</html>