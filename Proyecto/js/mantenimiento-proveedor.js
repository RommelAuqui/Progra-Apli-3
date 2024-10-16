function confirmDelete(id) {
    if (confirm("¿Está seguro de que desea eliminar este proveedor?")) {
        const formData = new FormData();
        formData.append('eliminar', true); 
        formData.append('id_proveedor', id); // Cambiado a id_proveedor

        fetch('../../procesos/mant-proveedores.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Cambiado a JSON para manejar la respuesta
        .then(data => {
            if (data.success) {
                location.reload(); // Recarga la página para ver los cambios
            } else {
                alert("Error al eliminar el proveedor.");
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
