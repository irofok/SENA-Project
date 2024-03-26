function cambiarEstadoCita() {
    var nuevoEstado = $('#nuevo_estado').val();
    var estEstado = $('#estEstado').val();

    $.ajax({
        type: 'POST',
        url: 'editarEstadoCita.php',
        data: { nuevo_estado: nuevoEstado, estEstado: estado},
        success: function(response) {
            // Manejar la respuesta (puede ser un mensaje de éxito o error)
            alert('Cita modificada.');
            alert(response);
        },
        error: function() {
            alert('Error al cambiar el estado de la cita.');
        }
    });
}
