document.addEventListener("DOMContentLoaded", () => {
  const contenedorTarjetas = document.getElementById("contenedorTarjetas");

  fetch('../app/API/tutoriasMostrar.php')
    .then(response => response.json())
    .then(tutorias => {
      contenedorTarjetas.innerHTML = ''; // limpiar contenido

      if (tutorias.length === 0) {
        contenedorTarjetas.innerHTML = '<p>No hay tutorías disponibles.</p>';
        return;
      }

      tutorias.forEach(tutoria => {
        const tarjeta = document.createElement('div');
        tarjeta.classList.add('tarjeta-tutoria');

        tarjeta.innerHTML = `
         <div class="categoria-tag">${tutoria.categoria_nombre ?? 'Sin categoría'}</div>


          <h3>${tutoria.titulo}</h3>
          <p class="descripcion">${tutoria.descripcion}</p>
          <h1>Precio</h1>
          <p class="precio">₡${tutoria.precio_por_hora}</p>
          <h1>Modalidad</h1>
          <p class="modalidad">${tutoria.modalidad}</p>
          <br />
          <div class="acciones">
              <button class="boton boton-primario">Reservar</button>
              <button class="boton boton-secundario">Ver Detalles</button>
          </div>
        `;

        contenedorTarjetas.appendChild(tarjeta);
      });
    })
    .catch(error => {
      console.error('Error al cargar tutorías:', error);
      contenedorTarjetas.innerHTML = '<p>Error al cargar tutorías</p>';
    });
});
