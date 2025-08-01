<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorías - TutoX</title>
    
    <!-- CSS base (siempre se carga) -->
<link rel="stylesheet" href="css/stylesComponentes.css">
    
    <!-- CSS específico para tutorías -->
<link rel="stylesheet" href="css/tutorias.css">

<script src="../public/js/categorias.js"></script>
<script src="../public/js/tipoServicio.js"></script>





</head>
<body>
    
    <!-- Aqui agregamos el componente del navbar -->
<?php include __DIR__ . '/../componentes/navbar.php'; ?>

    <!-- Sección principal -->
    <section class="seccion-tutorias">
        <div class="contenedor">
            <h1>Agrega Tus Tutorias</h1>
           
    </section>

    <!-- Lista de tutorías -->
<div class="feature-card">
  <form action="guardarReserva.php" method="post">
<input type="number" name="id_usuario" placeholder="ID Usuario" required>

<select name="id_categoria" id="categoriaSelect" required>
    <option value="">Cargando categorías...</option>
</select>

    
    <input type="text" name="titulo" placeholder="Título del Servicio" required>
    <textarea name="descripcion" placeholder="Descripción"></textarea>
    <input type="number" step="0.01" name="precio_por_hora" placeholder="Precio por Hora">

    <select name="modalidad" required>
        <option value="">Selecciona modalidad</option>
        <option value="presencial">Presencial</option>
        <option value="virtual">Virtual</option>
        <option value="ambas">Ambas</option>
    </select>

    
<select name="id_servicio" id="servicioSelect" required>
    <option value="">Cargando Servicios...</option>
</select>
    <button class="boton-mandar"type="submit">Guardar Servicio</button>
  </form>
</div>


                 

    </section>
    
    <!-- Aqui agregamos el componente del footer -->
<?php include __DIR__ . '/../componentes/footer.php'; ?>
</body>
</html>

  