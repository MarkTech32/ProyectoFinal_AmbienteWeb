<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comunidad - TutoX</title>

    <!-- CSS base -->
    <link rel="stylesheet" href="css/stylesComponentes.css">
    <link rel="stylesheet" href="css/comunidad.css">
</head>
<body>

    <!-- Navbar -->
    <?php include __DIR__ . '/../app/views/componentes/navbar.php'; ?>

    <!-- Sección principal -->
    <section class="seccion-comunidad">
        <div class="contenedor">
            <h1>Comunidad</h1>
            <p>Publicaciones, solicitudes y colaboraciones entre estudiantes</p>
        </div>
    </section>

    <!-- Lista de publicaciones -->
    <section class="lista-comunidad">
        <div class="contenedor">
            <div class="cuadricula-comunidad">

                <div class="tarjeta-comunidad">
                    <div class="categoria-tag">Solicitud</div>
                    <h3>¿Alguien domina Cálculo II?</h3>
                    <p class="descripcion">Busco ayuda para resolver ejercicios de integrales y series para el examen final.</p>
                    <p class="autor-fecha">Publicado por: Juan Pérez — 10 de Julio, 2025</p>
                    <button class="boton boton-primario">Contactar</button>
                </div>

                <div class="tarjeta-comunidad">
                    <div class="categoria-tag">Colaboración</div>
                    <h3>Proyecto de Redes</h3>
                    <p class="descripcion">Formando grupo para proyecto final de Redes de Computadoras. Se busca programador y diseñador.</p>
                    <p class="autor-fecha">Publicado por: Laura Martínez — 9 de Julio, 2025</p>
                    <button class="boton boton-primario">Unirme</button>
                </div>

                <div class="tarjeta-comunidad">
                    <div class="categoria-tag">Oferta</div>
                    <h3>Clases de Programación en Python</h3>
                    <p class="descripcion">Ofrezco sesiones grupales para aprender Python desde cero. Horarios flexibles.</p>
                    <p class="autor-fecha">Publicado por: Carlos Ramírez — 8 de Julio, 2025</p>
                    <button class="boton boton-primario">Ver más</button>
                </div>

                <div class="tarjeta-comunidad">
                    <div class="categoria-tag">Debate</div>
                    <h3>Recomendaciones para entrevistas técnicas</h3>
                    <p class="descripcion">Abrí este espacio para compartir consejos, preguntas y simulaciones de entrevistas técnicas.</p>
                    <p class="autor-fecha">Publicado por: Ana Solís — 7 de Julio, 2025</p>
                    <button class="boton boton-primario">Participar</button>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include __DIR__ . '/../app/views/componentes/footer.php'; ?>

</body>
</html>