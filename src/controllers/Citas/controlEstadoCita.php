<?PHP
include('../../DB/conecction.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevoEstado = $_POST['nuevo_estado'];
    $estadoID = $_POST['estCitaID']; // ID de la cita que deseas actualizar

    try {
        // Realiza una consulta SQL para actualizar el estado de la cita
        $stmt = $conn->prepare("UPDATE tblestadocita SET estEstado = :nuevoEstado WHERE estCitaID = :estCita");
        $stmt->bindParam(':nuevoEstado', $nuevoEstado);
        $stmt->bindParam(':estCita', $estadoID);
        $stmt->execute();

        // Redirige de nuevo a la página de la lista de citas o a donde desees
         header("Location: ../../admin_panel.php");
    } catch (PDOException $e) {
        echo "Error al cambiar el estado de la cita: " . $e->getMessage();
    }
}





?>