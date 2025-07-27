<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FAQ - TutoX</title>

    <!-- CSS base -->
    <link rel="stylesheet" href="css/stylesComponentes.css">
    <link rel="stylesheet" href="css/faq.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <?php include __DIR__ . '/../app/views/componentes/navbar.php'; ?>

    <!-- Sección principal -->
    <section class="seccion-faq">
        <div class="contenedor">
            <h1>Preguntas Frecuentes</h1>
            <p>Encuentra respuestas a las dudas más comunes sobre tutoX</p>
        </div>
    </section>

    <!-- Lista de preguntas -->
    <section class="lista-faq">
        <div class="contenedor">
            <div class="cuadricula-faq">

                <!-- Pregunta 1 -->
                <div class="tarjeta-faq">
                    <div class="categoria-tag">Tutorías</div>
                    <div class="pregunta-header" onclick="toggleFAQ(this)">
                        <h3>¿Cómo puedo encontrar un tutor para mi materia?</h3>
                        <i class="fas fa-chevron-down icono-toggle"></i>
                    </div>
                    <div class="respuesta">
                        <p>Navega a la sección "Tutorías" donde podrás filtrar por materia, carrera y calificaciones.</p>
                    </div>
                </div>

                <!-- Pregunta 2 -->
                <div class="tarjeta-faq">
                    <div class="categoria-tag">Registro</div>
                    <div class="pregunta-header" onclick="toggleFAQ(this)">
                        <h3>¿Cómo me registro como tutor en la plataforma?</h3>
                        <i class="fas fa-chevron-down icono-toggle"></i>
                    </div>
                    <div class="respuesta">
                        <p>Ve a "Mi Perfil", crea tu cuenta con tu correo universitario, completa tu perfil académico y ya puedes buscar tutorías o publicar tus servicios</p>
                    </div>
                </div>

                <!-- Pregunta 3 -->
                <div class="tarjeta-faq">
                    <div class="categoria-tag">Servicios</div>
                    <div class="pregunta-header" onclick="toggleFAQ(this)">
                        <h3>¿Qué tipo de servicios profesionales puedo ofrecer?</h3>
                        <i class="fas fa-chevron-down icono-toggle"></i>
                    </div>
                    <div class="respuesta">
                        <p>Puedes ofrecer servicios como diseño gráfico, programación, traducción, redacción académica, consultoría, y cualquier habilidad profesional que tengas desarrollada por tus estudios universitarios</p>
                    </div>
                </div>

                <!-- Pregunta 4 -->
                <div class="tarjeta-faq">
                    <div class="categoria-tag">Tutorías</div>
                    <div class="pregunta-header" onclick="toggleFAQ(this)">
                        <h3>¿Las tutorías pueden ser virtuales o solo presenciales?</h3>
                        <i class="fas fa-chevron-down icono-toggle"></i>
                    </div>
                    <div class="respuesta">
                        <p>Ofrecemos ambas modalidades. Cada tutor especifica si ofrece sesiones presenciales, virtuales o ambas. Las sesiones virtuales se realizan mediante videollamadas.</p>
                    </div>
                </div>

                <!-- Pregunta 5 -->
                <div class="tarjeta-faq">
                    <div class="categoria-tag">Calificaciones</div>
                    <div class="pregunta-header" onclick="toggleFAQ(this)">
                        <h3>¿Cómo funciona el sistema de calificaciones?</h3>
                        <i class="fas fa-chevron-down icono-toggle"></i>
                    </div>
                    <div class="respuesta">
                        <p>Después de cada sesión, tanto el estudiante como el tutor pueden calificarse mutuamente del 1 al 5 estrellas y dejar comentarios. Esto ayuda a mantener la calidad del servicio.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include __DIR__ . '/../app/views/componentes/footer.php'; ?>

    <script>
        function toggleFAQ(element) {
            const tarjeta = element.parentElement;
            const respuesta = tarjeta.querySelector('.respuesta');
            const icono = element.querySelector('.icono-toggle');
            
            // Toggle active class
            tarjeta.classList.toggle('activa');
            
            // Rotate icon
            icono.style.transform = tarjeta.classList.contains('activa') ? 'rotate(180deg)' : 'rotate(0deg)';
            
            // Close other FAQs
            const todasLasTarjetas = document.querySelectorAll('.tarjeta-faq');
            todasLasTarjetas.forEach(otraTarjeta => {
                if (otraTarjeta !== tarjeta && otraTarjeta.classList.contains('activa')) {
                    otraTarjeta.classList.remove('activa');
                    const otroIcono = otraTarjeta.querySelector('.icono-toggle');
                    otroIcono.style.transform = 'rotate(0deg)';
                }
            });
        }
    </script>

</body>
</html>