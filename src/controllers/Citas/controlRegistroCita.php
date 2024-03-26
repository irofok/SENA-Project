<?PHP
include('../../DB/conecction.php');
// var_dump($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'insert_cita':
                 // Recupera los valores del formulario
                $personaID = $_POST["txtNumero"];
                $autoID = $_POST["txtPlaca"];
                $fechaCita = $_POST["fecha"];
                $horaCita = $_POST["hora"];
                $motivo = $_POST["nuevoMotivo"];
                $servicio = $_POST["servicios"];
                $kilometraje = $_POST["kmAuto"];
                $formaAgenda = $_POST["formaAgenda"];
                registrarCita($conn,$personaID, $autoID, $fechaCita, $horaCita, $motivo, $servicio,$kilometraje ,$formaAgenda);
                header("Location: ../../views/viewCitas.php");
                break;
        }
    }
}

function registrarCita($conn,$personaID, $autoID, $fechaCita, $horaCita, $motivo, $servicio,$kilometraje, $formaAgenda) {
    $fechaNuevaCita = time();

    // Realiza la inserción en la tabla "tblcita"
    try {
        $stmtAutoPersona = $conn->prepare("INSERT INTO tblautopersona ( carPlacaID, perID) VALUES (:autoID, :personaID)"); 
        $stmtAutoPersona->bindParam(":autoID", $autoID);
        $stmtAutoPersona->bindParam(":personaID", $personaID);
        $stmtAutoPersona->execute();
        
        $autperID = $conn->lastInsertId();


        $stmt = $conn->prepare("INSERT INTO tblcita (autperID, citFechaCita, citHoraCita, citMotivo, citServicio, citKilometraje, formaID, citFechaRegistro) VALUES (:autperID, :fechaCita, :horaCita, :motivo, :servicio,:kilometraje, :formaAgenda, FROM_UNIXTIME(:fechaNueva))");
        $stmt->bindParam(":autperID", $autperID);
        $stmt->bindParam(":fechaCita", $fechaCita);
        $stmt->bindParam(":horaCita", $horaCita);
        $stmt->bindParam(":motivo", $motivo);
        $stmt->bindParam(":servicio", $servicio);
        $stmt->bindParam(":kilometraje", $kilometraje);
        $stmt->bindParam(":formaAgenda", $formaAgenda);
        $stmt->bindParam(":fechaNueva", $fechaNuevaCita);

        $stmt->execute();

        $citID = $conn->lastInsertId();
        $estadoPredeterminado = 'PENDIENTE';

        $stmtEstado = $conn->prepare("INSERT INTO tblestadocita (citID, estEstado) VALUES (:cita,:estado)");
        $stmtEstado->bindParam(":cita", $citID);
        $stmtEstado->bindParam(":estado", $estadoPredeterminado);
        $stmtEstado->execute();

        // Redireccionar a la página anterior
        header("Location: {$_SERVER['HTTP_REFERER']}?exito=Cita registrada con éxito.");
        exit();
    } catch (PDOException $e) {
        echo "Error al registrar la cita: " . $e->getMessage();
    }
}




?>




