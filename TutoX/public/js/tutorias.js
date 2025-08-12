document.addEventListener("DOMContentLoaded", () => {
  const contenedorTarjetas = document.getElementById("contenedorTarjetas");



  // Crear el modal de reserva
  const modalReserva = document.createElement('div');
  modalReserva.id = 'modalReserva';
  modalReserva.style.display = 'none';
  modalReserva.innerHTML = `
    <div class="modal-content">
      <span id="cerrarModalReserva" style="float:right;cursor:pointer;font-size:24px">&times;</span>
      <h2>Reservar Tutoría</h2>
      <form id="formReserva">
        <input type="hidden" name="id_tutoria" id="modal_id_tutoria">
        <label>Fecha solicitada:</label>
        <input type="date" name="fecha_solicitada" required><br>
        <label>Hora solicitada:</label>
        <input type="time" name="hora_solicitada" required><br>
        <label>Mensaje:</label>
        <textarea name="mensaje" required></textarea><br>
        <button type="submit" class="boton boton-primario">Confirmar Reserva</button>
      </form>
      <div id="reservaMensaje"></div>
    </div>
    <style>
      #modalReserva { position: fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5); display:flex; align-items:center; justify-content:center; z-index:9999; }
      .modal-content { background:#fff; padding:30px; border-radius:8px; min-width:300px; position:relative; }
    </style>
  `;

  document.body.appendChild(modalReserva);

  document.getElementById('cerrarModalReserva').onclick = () => {
    modalReserva.style.display = 'none';
    document.getElementById('reservaMensaje').innerHTML = '';
  };



  // Abrir modal al hacer click en Reservar

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
              <button class="boton boton-primario" data-id-tutoria="${tutoria.id}">Reservar</button>
              <button class="boton boton-secundario">Ver Detalles</button>
          </div>
        `;
        contenedorTarjetas.appendChild(tarjeta);

        // Agregar evento al botón Reservar
        const btnReservar = tarjeta.querySelector('.boton-primario');
        btnReservar.addEventListener('click', () => {
          document.getElementById('modal_id_tutoria').value = tutoria.id;
          modalReserva.style.display = 'flex';
        });
      });
    })
    .catch(error => {
      console.error('Error al cargar tutorías:', error);
      contenedorTarjetas.innerHTML = '<p>Error al cargar tutorías</p>';
    });



    
  // Enviar reserva al backend
  document.getElementById('formReserva').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('../public/guardarReserva.php', {
      method: 'POST',
      body: formData
    })
    .then(res => res.text())
    .then(msg => {
      document.getElementById('reservaMensaje').innerHTML = msg;
      if (msg.includes('correctamente')) {
        setTimeout(() => { modalReserva.style.display = 'none'; document.getElementById('reservaMensaje').innerHTML = ''; }, 2000);
      }
    })
    .catch(() => {
      document.getElementById('reservaMensaje').innerHTML = 'Error al reservar.';
    });
  });
});
