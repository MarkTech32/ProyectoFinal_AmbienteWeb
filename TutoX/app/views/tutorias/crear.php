<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Tutoría - TutoX</title>
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/stylesComponentes.css">
    <link rel="stylesheet" href="/ProyectoFinal_AmbienteWeb/TutoX/public/css/tutorias.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <?php include __DIR__ . '/../componentes/navbar.php'; ?>

    <!-- Header -->
    <div class="tutorias-header">
        <h1>Crear Nueva Tutoría</h1>
        <p>Comparte tu conocimiento y ayuda a otros estudiantes</p>
    </div>

    <!-- Formulario -->
    <div class="crear-container">
        <form method="POST" class="crear-form">
            
            <div class="form-group">
                <label for="titulo">Título de la Tutoría</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="materia">Materia</label>
                <select id="materia" name="materia" required>
                    <option value="">Selecciona una materia</option>
                    <option value="Programación">Programación</option>
                    <option value="Matemáticas">Matemáticas</option>
                    <option value="Inglés">Inglés</option>
                    <option value="Administración">Administración</option>
                    <option value="Ingeniería">Ingeniería</option>
                    <option value="Contabilidad">Contabilidad</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Español">Español</option>
                    <option value="Estadística">Estadística</option>
                    <option value="Bases de Datos">Bases de Datos</option>
                </select>
            </div>

            <div class="form-group">
                <label for="precio">Precio por Sesión (₡)</label>
                <input type="number" id="precio" name="precio" min="0" step="500" required>
            </div>

            <div class="form-group">
                <label for="modalidad">Modalidad</label>
                <select id="modalidad" name="modalidad" required>
                    <option value="">Selecciona modalidad</option>
                    <option value="virtual">Virtual</option>
                    <option value="presencial">Presencial</option>
                    <option value="ambas">Ambas</option>
                </select>
            </div>

            <div class="form-group">
                <label for="ubicacion">Ubicación (opcional)</label>
                <input type="text" id="ubicacion" name="ubicacion" placeholder="Ej: Campus Universidad, Zoom, etc.">
            </div>

            <div class="form-actions">
                <a href="?page=tutorias" class="btn-cancelar">Cancelar</a>
                <button type="submit" class="btn-crear">Crear Tutoría</button>
            </div>

        </form>
    </div>

    <!-- Footer -->
    <?php include __DIR__ . '/../componentes/footer.php'; ?>

</body>
</html>