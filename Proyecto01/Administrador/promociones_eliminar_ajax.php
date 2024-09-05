function eliminarPromociones(id) {
    if (confirm("¿Estas seguro de que quieres eliminar esta promocion?")) {
        $.post('promociones_elimina.php', { id: id })
        .done(function(result) {
            if (result === "success") {
                location.reload();
            } else {
                alert("Error al eliminar la promocion.");
            }
        })
        .fail(function(error) {
            console.error('Error en la solicitud:', error);
        });
    }
}