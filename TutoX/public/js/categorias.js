document.addEventListener("DOMContentLoaded", () => {
    const selectCategoria = document.getElementById('categoriaSelect');

    if (!selectCategoria) return; 

    fetch('../app/API/categoriasAPI.php')
        .then(response => response.json())
        .then(categorias => {
            selectCategoria.innerHTML = '<option value="">Selecciona una categoría</option>';
            categorias.forEach(cat => {
                const option = document.createElement('option');
                option.value = cat.id;
                option.textContent = cat.nombre;
                selectCategoria.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error al cargar categorías:', error);
            selectCategoria.innerHTML = '<option value="">Error al cargar</option>';
        });
});
