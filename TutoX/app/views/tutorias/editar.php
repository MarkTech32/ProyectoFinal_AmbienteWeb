<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Tutoría - TutoX</title>
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/stylesComponentes.css">
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/tutorias.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <?php include __DIR__ . '/../componentes/navbar.php'; ?>

    <!-- Header -->
    <div class="tutorias-header">
        <h1>Editar Tutoría</h1>
        <p>Actualiza la información de tu tutoría</p>
    </div>

    <!-- Formulario -->
    <div class="crear-container">
        <form method="POST" class="crear-form">
            
            <div class="form-group">
                <label for="titulo">Título de la Tutoría</label>
                <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($tutoria['titulo']); ?>" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4" required><?php echo htmlspecialchars($tutoria['descripcion']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="materia">Materia</label>
                <select id="materia" name="materia" required>
                    <option value="">Selecciona una materia</option>
                    <option value="Programación" <?php echo $tutoria['materia'] == 'Programación' ? 'selected' : ''; ?>>Programación</option>
                    <option value="Matemáticas" <?php echo $tutoria['materia'] == 'Matemáticas' ? 'selected' : ''; ?>>Matemáticas</option>
                    <option value="Inglés" <?php echo $tutoria['materia'] == 'Inglés' ? 'selected' : ''; ?>>Inglés</option>
                    <option value="Administración" <?php echo $tutoria['materia'] == 'Administración' ? 'selected' : ''; ?>>Administración</option>
                    <option value="Ingeniería" <?php echo $tutoria['materia'] == 'Ingeniería' ? 'selected' : ''; ?>>Ingeniería</option>
                    <option value="Contabilidad" <?php echo $tutoria['materia'] == 'Contabilidad' ? 'selected' : ''; ?>>Contabilidad</option>
                    <option value="Marketing" <?php echo $tutoria['materia'] == 'Marketing' ? 'selected' : ''; ?>>Marketing</option>
                    <option value="Español" <?php echo $tutoria['materia'] == 'Español' ? 'selected' : ''; ?>>Español</option>
                    <option value="Estadística" <?php echo $tutoria['materia'] == 'Estadística' ? 'selected' : ''; ?>>Estadística</option>
                    <option value="Bases de Datos" <?php echo $tutoria['materia'] == 'Bases de Datos' ? 'selected' : ''; ?>>Bases de Datos</option>
                </select>
            </div>

            <div class="form-group">
                <label for="precio">Precio por Sesión (₡)</label>
                <input type="number" id="precio" name="precio" min="0" step="500" value="<?php echo $tutoria['precio']; ?>" required>
            </div>

            <div class="form-group">
                <label for="modalidad">Modalidad</label>
                <select id="modalidad" name="modalidad" required>
                    <option value="">Selecciona modalidad</option>
                    <option value="virtual" <?php echo $tutoria['modalidad'] == 'virtual' ? 'selected' : ''; ?>>Virtual</option>
                    <option value="presencial" <?php echo $tutoria['modalidad'] == 'presencial' ? 'selected' : ''; ?>>Presencial</option>
                    <option value="ambas" <?php echo $tutoria['modalidad'] == 'ambas' ? 'selected' : ''; ?>>Ambas</option>
                </select>
            </div>

            <div class="form-group">
                <label for="ubicacion">Ubicación (opcional)</label>
                <input type="text" id="ubicacion" name="ubicacion" value="<?php echo htmlspecialchars($tutoria['ubicacion']); ?>" placeholder="Ej: Campus Universidad, Zoom, etc.">
            </div>

            <div class="form-actions">
                <a href="?page=mis-publicaciones" class="btn-cancelar">Cancelar</a>
                <button type="submit" class="btn-crear">Actualizar Tutoría</button>
            </div>

        </form>
    </div>

    <!-- Footer -->
    <?php include __DIR__ . '/../componentes/footer.php'; ?>

</body>
</html>