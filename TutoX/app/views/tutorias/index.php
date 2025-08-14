<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tutorías Disponibles - TutoX</title>
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/stylesComponentes.css">
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/tutorias.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <?php include __DIR__ . '/../componentes/navbar.php'; ?>

    <!-- Header -->
    <div class="tutorias-header">
        <h1>Tutorías Disponibles</h1>
        <p>Encuentra el apoyo académico que necesitas</p>
        <?php if (isset($_SESSION['usuario'])): ?>
            <a href="?page=crear-tutoria" class="btn-crear-tutoria">
                <i class="fas fa-plus"></i>
                Ofrecer Tutoría
            </a>
        <?php endif; ?>
    </div>

    <!-- Filtros -->
    <div class="filtros-container">
        <div class="filtros">
            <button class="filtro-btn active" onclick="filtrarPor('todas')">Todas</button>
            <button class="filtro-btn" onclick="filtrarPor('programacion')">Programación</button>
            <button class="filtro-btn" onclick="filtrarPor('matematicas')">Matemáticas</button>
            <button class="filtro-btn" onclick="filtrarPor('ingles')">Inglés</button>
            <button class="filtro-btn" onclick="filtrarPor('virtual')">Virtual</button>
            <button class="filtro-btn" onclick="filtrarPor('presencial')">Presencial</button>
        </div>
    </div>

    <!-- Grid de tutorías -->
    <div class="tutorias-grid">
        <?php foreach ($tutorias as $tutoria): ?>
            <div class="tutoria-card" data-materia="<?php echo strtolower(str_replace(['ó','á','é'], ['o','a','e'], $tutoria['materia'])); ?>" data-modalidad="<?php echo $tutoria['modalidad']; ?>">
                
                <div class="materia-tag"><?php echo htmlspecialchars($tutoria['materia']); ?></div>
                
                <h3><?php echo htmlspecialchars($tutoria['titulo']); ?></h3>
                
                <p class="descripcion"><?php echo htmlspecialchars(substr($tutoria['descripcion'], 0, 120)) . '...'; ?></p>
                
                <div class="tutor-info">
                    <i class="fas fa-user"></i>
                    <span><?php echo htmlspecialchars($tutoria['tutor_nombre']); ?></span>
                </div>

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

                <div class="card-footer">
                    <div class="precio">
                        <span class="precio-valor">₡<?php echo number_format($tutoria['precio'], 0, ',', '.'); ?></span>
                        <span class="precio-texto">por sesión</span>
                    </div>
                    <a href="<?php echo isset($_SESSION['usuario']) ? '?page=tutoria-detalle&id=' . $tutoria['id'] : '?page=miperfil'; ?>" class="btn-ver-mas">
                        <?php echo isset($_SESSION['usuario']) ? 'Ver más' : 'Iniciar sesión'; ?>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (empty($tutorias)): ?>
        <div class="no-tutorias">
            <i class="fas fa-book-open"></i>
            <h3>No hay tutorías disponibles</h3>
            <p>¡Sé el primero en ofrecer una tutoría!</p>
            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="?page=crear-tutoria" class="btn-crear-primera">Crear Tutoría</a>
            <?php else: ?>
                <a href="?page=miperfil" class="btn-crear-primera">Iniciar Sesión para Crear Tutoría</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Footer -->
    <?php include __DIR__ . '/../componentes/footer.php'; ?>

    <script>
        function filtrarPor(categoria) {
            const cards = document.querySelectorAll('.tutoria-card');
            const buttons = document.querySelectorAll('.filtro-btn');
            
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            cards.forEach(card => {
                if (categoria === 'todas') {
                    card.style.display = 'block';
                } else if (categoria === 'virtual' || categoria === 'presencial') {
                    card.style.display = card.dataset.modalidad === categoria ? 'block' : 'none';
                } else {
                    card.style.display = card.dataset.materia.includes(categoria.toLowerCase()) ? 'block' : 'none';
                }
            });
        }
    </script>

</body>
</html>