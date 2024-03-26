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

if (isset($_POST['citID']) && isset($_POST['motivo']) && isset($_POST['eliminar']) && $_POST['eliminar'] == 1) {
    $citID = $_POST['citID'];
    $motivo = $_POST['motivo'];

    // Actualizar el motivo de cancelación en tblestadocita y el estado
    $updateSql = "UPDATE tblestadocita SET estMotivoCancelacion = ? WHERE citID = ?";
    $updateStateSql = "UPDATE tblestadocita SET estEstado = 'CANCELADA' WHERE citID = ?";

    $stmt = $conn->prepare($updateSql);
    if (!$stmt) {
        die("Error de preparación: " . $conn->error);
    }

    // Vincular los parámetros
    $stmt->bind_param("si", $motivo, $citID);

    if ($stmt->execute()) {
        // Éxito al actualizar el motivo de cancelación
        // Ahora actualizamos el estado
        $stmtState = $conn->prepare($updateStateSql);
        if (!$stmtState) {
            die("Error de preparación: " . $conn->error);
        }

        $stmtState->bind_param("i", $citID);

        if ($stmtState->execute()) {
            echo json_encode(array("success" => true, "message" => "Cita cancelada exitosamente."));
        } else {
            echo json_encode(array("success" => false, "message" => "Error al actualizar el estado de la cita: " . $stmtState->error));
        }

        // Cierra la conexión y finaliza el script
        $stmtState->close();
    } else {
        // Error al actualizar el motivo
        echo json_encode(array("success" => false, "message" => "Error al actualizar el motivo de cancelación: " . $stmt->error));
    }

    // Cierra la conexión y finaliza el script
    $stmt->close();
    $conn->close();
    exit();
}