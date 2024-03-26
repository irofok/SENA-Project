<?php
include('../../DB/conecction.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['accion']) && $_POST['accion'] === 'actualizar_cita'){
    // Procesar el formulario de edición aquí
    $citID = $_POST["citID"];
    $nuevoMotivo = $_POST["nuevoMotivo"];
    $nuevaFecha = $_POST["nuevaFecha"];
    $nuevaHora = $_POST["nuevaHora"];
    $nuevoServicio = $_POST["servicios"]; // Nombre del campo del formulario
    $nuevaFormaAgenda = isset($_POST["formaAgenda"]) ? $_POST["formaAgenda"] : 2; // Establece presencial (formaID = 2) por defecto si no se selecciona nada
    $fechaActual = time();


    try {
        $stmt = $conn->prepare("UPDATE tblcita SET citMotivo = :nuevoMotivo, citFechaCita = :nuevaFecha, citHoraCita = :nuevaHora, citServicio = :nuevoServicio, formaID = :nuevaFormaAgenda,  citFechaRegistro = FROM_UNIXTIME(:fechaActual) WHERE citID = :citID");
        $stmt->bindParam(":citID", $citID);
        $stmt->bindParam(":nuevoMotivo", $nuevoMotivo);
        $stmt->bindParam(":nuevaFecha", $nuevaFecha);
        $stmt->bindParam(":nuevaHora", $nuevaHora);
        $stmt->bindParam(":nuevoServicio", $nuevoServicio);
        $stmt->bindParam(":nuevaFormaAgenda", $nuevaFormaAgenda);
        $stmt->bindParam(":fechaActual", $fechaActual);

        if($stmt->execute()){
            header("Location: ../../admin_panel.php");
            echo '<script>window.location.href = "../../admin_panel.php";</script>';
            exit();
        }
        else{
            echo "Cita actualizada con éxito.";
        }
       
       



    } catch (PDOException $e) {
        echo "Error al actualizar la cita: " . $e->getMessage();
    }
}
}

?>