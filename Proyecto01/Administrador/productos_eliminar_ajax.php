
function eliminar(id) {
    if (confirm("¿Estas seguro de que quieres eliminar este producto?")) {
        $.post('productos_elimina.php', { id: id })
        .done(function(result) {
            if (result === "success") {
                location.reload();
            } else {
                alert("Error al eliminar al empleado.");
            }
        })
        .fail(function(error) {
            console.error('Error en la solicitud:', error);
        });
    }
}
