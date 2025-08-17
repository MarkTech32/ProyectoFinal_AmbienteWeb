<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TutoX - Conectando Estudiantes</title>

    <link rel="stylesheet" href="css/stylesComponentes.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    
<?php include __DIR__ . '/../componentes/navbar.php'; ?>

    <!-- Sección principal -->
    <section class="seccion-principal">
        <div class="contenido-principal">
            <h1>Bienvenido a TutoX</h1>
            <p>La plataforma que conecta estudiantes universitarios para intercambiar conocimientos, habilidades y servicios académicos</p>
        </div>
    </section>

    <!-- Sección de características -->
    <section class="caracteristicas">
        <div class="contenedor">
            <h2>¿Qué puedes hacer en TutoX?</h2>
            <div class="cuadricula-caracteristicas">
                <div class="tarjeta-caracteristica">
                    <div class="icono-caracteristica">📚</div>
                    <h3>Tutorías Académicas</h3>
                    <p>Encuentra tutores especializados en materias específicas o comparte tu conocimiento ayudando a otros estudiantes.</p>
                </div>
                <div class="tarjeta-caracteristica">
                    <div class="icono-caracteristica">💻</div>
                    <h3>Servicios de Programación</h3>
                    <p>Solicita ayuda con proyectos de programación o ofrece tus habilidades técnicas a compañeros que lo necesiten.</p>
                </div>
                <div class="tarjeta-caracteristica">
                    <div class="icono-caracteristica">🎨</div>
                    <h3>Diseño y Creatividad</h3>
                    <p>Consigue ayuda con diseño gráfico, presentaciones o proyectos creativos de otros estudiantes talentosos.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Cómo funciona -->
    <section class="como-funciona">
        <div class="contenedor">
            <h2>¿Cómo funciona TutoX?</h2>
            <div class="pasos">
                <div class="paso">
                    <div class="numero-paso">1</div>
                    <h3>Regístrate</h3>
                    <p>Crea tu perfil como estudiante y especifica tus habilidades o necesidades académicas.</p>
                </div>
                <div class="paso">
                    <div class="numero-paso">2</div>
                    <h3>Busca o Publica</h3>
                    <p>Busca el servicio que necesitas o publica el servicio que puedes ofrecer.</p>
                </div>
                <div class="paso">
                    <div class="numero-paso">3</div>
                    <h3>Conecta</h3>
                    <p>Conéctate con otros estudiantes y coordina sesiones de ayuda mutuamente beneficiosas.</p>
                </div>
                <div class="paso">
                    <div class="numero-paso">4</div>
                    <h3>Aprende y Enseña</h3>
                    <p>Intercambia conocimientos, gana experiencia y construye tu red de contactos universitarios.</p>
                </div>
            </div>
        </div>
    </section>

<?php include __DIR__ . '/../componentes/footer.php'; ?>

</body>
</html>