<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>serivcios - TutoX</title>
    
    <!-- CSS base (siempre se carga) -->
<link rel="stylesheet" href="css/stylesComponentes.css">
    
    <!-- CSS específico para serivcios -->
<link rel="stylesheet" href="css/servicios.css">
</head>
<body>
    
    <!-- Aqui agregamos el componente del navbar -->
<?php include __DIR__ . '/../componentes/navbar.php'; ?>

    <!-- Sección principal -->
    <section class="seccion-servicios">
        <div class="contenedor">
            <h1>Servicios Disponibles</h1>
            <p>Encuentra el servicio que deseas o publica tu propio servicio </p>
    </section>

    <!-- Lista de Servicios -->
    <section class="lista-servicios">
        <div class="contenedor">
            <div class="cuadricula-servicios">



                <!-- Servicio 1 -->
                <div class="tarjeta-servicios">
                    <div class="categoria-tag">Diseño</div>
                    <h3>Diseño Gráfico</h3>
                    <p>Diseño de presentaciones Profesionales</p>

                    <div class="acciones">
                        <button class="boton boton-primario">Solicitar Servicio</button>
                        <button class="boton boton-secundario">Ver Detalles</button>
                    </div>
                    
               </div>



                 <!-- Servicio 2 -->
                <div class="tarjeta-servicios">
                    <div class="categoria-tag">Marketing</div>
                    <h3>Marketing Digital</h3>
                    <p>Gestión de redes sociales y campañas publicitarias</p>

                    <div class="acciones">
                        <button class="boton boton-primario">Solicitar Servicio</button>
                        <button class="boton boton-secundario">Ver Detalles</button>
                    </div>
                </div>


                <!-- Servicio 3 -->
                <div class="tarjeta-servicios">
                    <div class="categoria-tag">Redaccion</div>
                    <h3>Correcion de Estilo y Ortografia</h3>
                    <p class="descripcion">Edicion de trabajos academicos y ensayos con enfoque en gramatica, coherencia y citacion </p>

                    <div class="acciones">
                        <button class="boton boton-primario">Solicitar Servicio</button>
                        <button class="boton boton-secundario">Ver Detalles</button>
                    </div>
 
                </div>


               <!-- Servicio 4 -->
               <div class="tarjeta-servicios">
                    <div class="categoria-tag">Programación</div>
                    <h3>Desarrollo Web</h3>
                    <p class="descripcion">Creación de sitios web y aplicaciones web</p>

                    <div class="acciones">
                        <button class="boton boton-primario">Solicitar Servicio</button>
                        <button class="boton boton-secundario">Ver Detalles</button>
                    </div>
                </div>


                <!-- Servicio 5 -->
               <div class="tarjeta-servicios">
                    <div class="categoria-tag">Soporte Tecnico</div>
                    <h3>Instalacion de Software Academico</h3>
                    <p class="descripcion">Asistencia remota o precencia para instalar herramientas academicas</p>

                    <div class="acciones">
                        <button class="boton boton-primario">Solicitar Servicio</button>
                        <button class="boton boton-secundario">Ver Detalles</button>
                    </div>
                </div>
                

                <!-- Servicio 6 -->
               <div class="tarjeta-servicios">
                    <div class="categoria-tag">Traduccion</div>
                    <h3>Traduccion de documentos</h3>
                    <p class="descripcion">Traduccion profesional de español a inglés  </p>

                    <div class="acciones">
                        <button class="boton boton-primario">Solicitar Servicio</button>
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