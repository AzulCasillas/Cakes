function eliminar(id) {
    if (confirm("¿Estas seguro de que quieres eliminar a este empleado?")) {
        $.post('empleados_elimina.php', { id: id })
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