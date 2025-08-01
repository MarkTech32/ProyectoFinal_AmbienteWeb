document.addEventListener("DOMContentLoaded", () => {
    const selectServicio = document.getElementById('servicioSelect');

    if (!servicioSelect) return; 

    fetch('../app/API/tipoServicio.php')
        .then(response => response.json())
        .then(servicios => {
            selectServicio.innerHTML = '<option value="">Selecciona el tipo de servicio</option>';
            servicios.forEach(cat => {
                const option = document.createElement('option');
                option.value = cat.id;
                option.textContent = cat.nombre;
                selectServicio.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error al cargar servicios:', error);
            selectServicio.innerHTML = '<option value="">Error al cargar</option>';
        });
});
