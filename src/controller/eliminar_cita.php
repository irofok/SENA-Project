<?php
session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "tjek";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if (isset($_POST['eliminar'])) {
    $citID = $_POST['citID'];

    // Cambiar el estado de la cita a "CANCELADA" en la tabla tblestadocita
    $updateEstadoSQL = "UPDATE tblestadocita SET estEstado = 'CANCELADA' WHERE citID = '$citID'";
    if ($conn->query($updateEstadoSQL) === TRUE) {
        echo "La cita se ha marcado como 'CANCELADA' con éxito.";
    } else {
        echo "Error al cambiar el estado de la cita: " . $conn->error;
    }
}

if (isset($_POST['comentario'])) {
    $comentario = $_POST['comentario'];
    
    // Actualiza el campo estMotivoCancelacion en la tabla tblestadocita
    $updateSQL = "UPDATE tblestadocita SET estMotivoCancelacion = '$comentario' WHERE citID = '$citID'";
    if ($conn->query($updateSQL) === TRUE) {
        // Éxito en la actualización del comentario
    } else {
        // Error en la actualización
    }
}
$conn->close();
?>
