<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorías - TutoX</title>
    
<!-- CSS base (siempre se carga) -->
<link rel="stylesheet" href="css/stylesComponentes.css">

<!-- CSS específico para tutorias -->
<link rel="stylesheet" href="css/tutorias.css">

</head>





<body>
    
    <!-- Aqui agregamos el componente del navbar -->
<?php include __DIR__ . '/../componentes/navbar.php'; ?>

    <!-- Sección principal -->
    <section class="seccion-tutorias">
        <div class="contenedor">
            <h1>Agrega Tus Tutorias</h1>
           
    </section>



    <!-- Lista de tutorias -->

<div class="feature-card">

<form action="guardarReserva.php" method="post">

<input type="number" name="id_usuario" placeholder="ID Usuario" required>


<!-- Cargar categorias desde la API -->
<select name="id_categoria" id="categoriaSelect" required>

    <option value="">Cargando categorias...</option>

</select>


    <!-- campo para ingresa el titulo del servicio-->
    <input type="text" name="titulo" placeholder="Título del Servicio" required>

    <!-- campo para ingresa la descripcion del servicio-->
    <textarea name="descripcion" placeholder="Descripción"></textarea>

    <!-- campo para ingresa el precio del servicio-->
    <input type="number" step="0.01" name="precio_por_hora" placeholder="Precio por Hora">

    <!-- campo para ingresa la modalidad del servicio-->
    <select name="modalidad" required>
        <option value="">Selecciona modalidad</option>
        <option value="presencial">Presencial</option>
        <option value="virtual">Virtual</option>
        <option value="ambas">Ambas</option>
    </select>

    <!-- Cargar servicios desde la API-->   
<select name="id_servicio" id="servicioSelect" required>

    <option value="">Cargando Servicios...</option>

</select>

    <!-- boton para mandar la tutoria -->
    <button class="boton-mandar"type="submit">Guardar tutoria</button>

  </form>
  
</div>


                 
</section>
    
    <!-- Aqui agregamos el componente del footer -->
<?php include __DIR__ . '/../componentes/footer.php'; ?>



 <!-- JS especifico para categorias -->
<script src="../public/js/categorias.js"></script>

<!-- JS especifico para tipo de servicios -->
<script src="../public/js/tipoServicio.js"></script>
</body>
</html>

  