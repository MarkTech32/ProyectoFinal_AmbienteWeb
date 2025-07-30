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
    </section>

    <!-- Lista de tutorías -->
    <section class="lista-tutorias">
        <div class="contenedor">
            <div class="cuadricula-tutorias">
                
                <!-- Tutoría 1 -->
                <div class="tarjeta-tutoria">
                    <div class="categoria-tag">Matemáticas</div>
                    <h3>Matemáticas Básicas</h3>
                    <p class="descripcion">Álgebra, geometría y cálculo básico para estudiantes universitarios</p>
                    
                    <div class="acciones">
                        <button class="boton boton-primario">Reservar</button>
                        <button class="boton boton-secundario">Ver Detalles</button>
                    </div>
                </div>

                <!-- Tutoría 2 -->
                <div class="tarjeta-tutoria">
                    <div class="categoria-tag">Programación</div>
                    <h3>Programación en Java</h3>
                    <p class="descripcion">Fundamentos de Java y programación orientada a objetos</p>
                    
                    <div class="acciones">
                        <button class="boton boton-primario">Reservar</button>
                        <button class="boton boton-secundario">Ver Detalles</button>
                    </div>
                </div>

                <!-- Tutoría 3 -->
                <div class="tarjeta-tutoria">
                    <div class="categoria-tag">Contabilidad</div>
                    <h3>Contabilidad Financiera</h3>
                    <p class="descripcion">Estados financieros y análisis contable para principiantes</p>
                    
                    <div class="acciones">
                        <button class="boton boton-primario">Reservar</button>
                        <button class="boton boton-secundario">Ver Detalles</button>
                    </div>
                </div>

                <!-- Tutoría 4 -->
                <div class="tarjeta-tutoria">
                    <div class="categoria-tag">Diseño</div>
                    <h3>Diseño Gráfico</h3>
                    <p class="descripcion">Photoshop, Illustrator y principios básicos de diseño</p>
                    
                    <div class="acciones">
                        <button class="boton boton-primario">Reservar</button>
                        <button class="boton boton-secundario">Ver Detalles</button>
                    </div>
                </div>

                <!-- Tutoría 5 -->
                <div class="tarjeta-tutoria">
                    <div class="categoria-tag">Programación</div>
                    <h3>Desarrollo Web</h3>
                    <p class="descripcion">HTML, CSS, JavaScript y frameworks modernos</p>
                    
                    <div class="acciones">
                        <button class="boton boton-primario">Reservar</button>
                        <button class="boton boton-secundario">Ver Detalles</button>
                    </div>
                </div>

                <!-- Tutoría 6 -->
                <div class="tarjeta-tutoria">
                    <div class="categoria-tag">Matemáticas</div>
                    <h3>Cálculo Diferencial</h3>
                    <p class="descripcion">Límites, derivadas y aplicaciones del cálculo diferencial</p>
                    
                    <div class="acciones">
                        <button class="boton boton-primario">Reservar</button>
                        <button class="boton boton-secundario">Ver Detalles</button>
                    </div>
                </div>

            </div>
        </div>
    </section>
    
    <!-- Aqui agregamos el componente del footer -->
<?php include __DIR__ . '/-componentes/footer.php'; ?>
</body>
</html>