document.addEventListener("DOMContentLoaded", function() {
    // Inicializa el select con funcionalidad de búsqueda
    const selectElement = document.getElementById('tag-select');
    let searchBox = document.createElement('input');
    searchBox.type = 'text';
    searchBox.placeholder = 'Buscar...';
    searchBox.className = 'form-control mb-2';
    selectElement.parentNode.insertBefore(searchBox, selectElement);

    // Función para actualizar el valor del campo de búsqueda con los tags seleccionados
    function updateSelectedTags() {
        const selectedOptions = Array.from(selectElement.selectedOptions).map(option => option.textContent);
        searchBox.value = selectedOptions.join(', ');
    }

    // Filtrar opciones al escribir en la barra de búsqueda
    searchBox.addEventListener('input', function() {
        let searchTerm = this.value.toLowerCase();
        let options = selectElement.querySelectorAll('option');
        options.forEach(option => {
            if (option.textContent.toLowerCase().includes(searchTerm)) {
                option.style.display = '';
            } else {
                option.style.display = 'none';
            }
        });
    });

    // Mantener la selección múltiple
    selectElement.addEventListener('change', function() {
        updateSelectedTags();  // Actualizar el input con las opciones seleccionadas
    });

    // Mejorar el estilo del select
    selectElement.style.height = 'auto';
    selectElement.style.minHeight = '150px';
    selectElement.style.borderRadius = '5px';
    selectElement.style.padding = '10px';
    selectElement.style.backgroundColor = '#f9f9f9';
    selectElement.style.border = '1px solid #ccc';

    // Inicializar con los tags seleccionados previamente
    updateSelectedTags();
});

