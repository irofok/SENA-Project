<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "tjek";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["citID"]) && isset($_POST["nuevoEstado"]) && isset($_POST["comentario"]) && isset($_POST["fechaActual"])) {
    $citID = $_POST["citID"];
    $nuevoEstado = $_POST["nuevoEstado"];
    $comentario = $_POST["comentario"];
    $fechaActual = $_POST["fechaActual"]; // La fecha ya está en el formato correcto

    // Actualizar el estado en la tabla tblestadocita
    $sql = "UPDATE tblestadocita SET estEstado = ?, estMotivoCancelacion = ?, estFechaActualizacionEstado = ? WHERE citID = ?";
    
    // Preparar la declaración
    $stmt = $conn->prepare($sql);
    
    // Vincular los parámetros
    $stmt->bind_param("sssi", $nuevoEstado, $comentario, $fechaActual, $citID);

    // Resto del código...
   
    if ($stmt->execute()) {
        echo "Estado actualizado correctamente.";
    } else {
        echo "Error al actualizar el estado: " . $stmt->error;
        // Registrar información adicional para depuración
        error_log("citID: " . $citID);
        error_log("nuevoEstado: " . $nuevoEstado);
        error_log("comentario: " . $comentario);
        error_log("fechaActual: " . $fechaActual);
    }
    
    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
} else {
    echo "Error: Datos faltantes o solicitud incorrecta.";
}

    

error_log("citID: " . $citID);
error_log("nuevoEstado: " . $nuevoEstado);
error_log("comentario: " . $comentario);
error_log("fechaActual: " . $fechaActual);
?>