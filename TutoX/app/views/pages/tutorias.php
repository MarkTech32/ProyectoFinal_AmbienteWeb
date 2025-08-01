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


</head>
<body>
    
    <!-- Aqui agregamos el componente del navbar -->
<?php include __DIR__ . '/../componentes/navbar.php'; ?>

    <!-- Sección principal -->
    <section class="seccion-tutorias">


        <div class="contenedor">
            <h1>Tutorías Disponibles</h1>
            <p>Encuentra la tutoría perfecta para mejorar tus habilidades académicas</p>

            <div style="margin-top: 20px;">
<a href="index.php?page=agregarTuto" class="boton boton-primario">Agregar Nueva Tutoría</a>


        </div>

     </div>
     
 </section>

 <!-- Lista de tutorías -->
 <section class="lista-tutorias">
    <div class="contenedor">
        <div class="cuadricula-tutorias" id="contenedorTarjetas"></div>
    </div>
</section>


    <!-- Aqui agregamos el componente del footer -->
<?php include __DIR__ . '/../componentes/footer.php'; ?>

 <script src="../public/js/tutorias.js"></script>
</body>
</html>