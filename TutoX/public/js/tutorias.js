document.addEventListener("DOMContentLoaded", () => {
  const contenedorTarjetas = document.getElementById("contenedorTarjetas");

  function getKeywordFromUrl() {
    const params = new URLSearchParams(window.location.search);
    return params.get('keyword') || '';
  }

  const keyword = getKeywordFromUrl();

  let url = '../app/API/tutoriasMostrar.php';
  if (keyword) {
    url += '?keyword=' + encodeURIComponent(keyword);
  }

  fetch(url)
    .then(response => response.json())
    .then(tutorias => {
      contenedorTarjetas.innerHTML = ''; 


      if (!tutorias || tutorias.length === 0) {
        contenedorTarjetas.innerHTML += '<p>No se encontraron tutorías.</p>';
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
