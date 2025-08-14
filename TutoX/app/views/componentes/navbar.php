<nav>
    <div class="contenedor-navegacion">
        <a href="/ProyectoFinal_AmbienteWeb/TutoX/public/" class="logo">TutoX</a>
        <ul class="menu-navegacion">

            <?php if (isset($_SESSION['usuario'])): ?>
                <!-- Usuario logueado -->
               <li><a href="/ProyectoFinal_AmbienteWeb/TutoX/public/?page=dashboard">Dashboard</a></li>
                <li><a href="/ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-publicaciones">Mis Publicaciones</a></li>
                <li><a href="/ProyectoFinal_AmbienteWeb/TutoX/public/?page=mis-citas">Mis Citas</a></li>
                <li><a href="/ProyectoFinal_AmbienteWeb/TutoX/public/?page=perfil">Mi Perfil</a></li>
                <li><a href="/ProyectoFinal_AmbienteWeb/TutoX/public/?page=logout">Cerrar Sesión</a></li>
            <?php else: ?>
                <!-- Usuario no logueado -->
                <li><a href="/ProyectoFinal_AmbienteWeb/TutoX/public/?page=tutorias">Tutorías</a></li>
                <li><a href="/ProyectoFinal_AmbienteWeb/TutoX/public/?page=servicios">Servicios</a></li>
                <li><a href="/ProyectoFinal_AmbienteWeb/TutoX/public/?page=faq">FAQ</a></li>
                <li><a href="/ProyectoFinal_AmbienteWeb/TutoX/public/?page=miperfil">Iniciar Sesión</a></li>
                <li><a href="/ProyectoFinal_AmbienteWeb/TutoX/public/?page=registro">Registrarse</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>