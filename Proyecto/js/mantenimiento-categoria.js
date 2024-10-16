function confirmDelete(id) {
    if (confirm("¿Está seguro de que desea eliminar esta categoría?")) {
        const formData = new FormData();
        formData.append('eliminar', true); 
        formData.append('id_categoria', id); 

        fetch('../../procesos/mant-cat.php', {
            method: 'POST',
            body: formData
        }).then(response => {
            if (response.ok) {
                location.reload(); // Recarga la pg web pa ver los cambios
            } else {
                alert("Error al eliminar la categoría.");
            }
        }).catch(error => console.error('Error:', error));
    }
}

