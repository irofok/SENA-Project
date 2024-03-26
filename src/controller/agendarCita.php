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

// ...

// ...

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_servicio = $_POST['tipo_servicio'];
    $placa_vehiculo = $_POST['placa_vehiculo'];
    $fecha = $_POST['date'];
    $hora = $_POST['time'];
    $kilome = $_POST['kilometra'];
    $comentario = $_POST['comment'];

    // Obtener el ID del carro basado en la placa
    $sql_placa = "SELECT autperID FROM tblautopersona WHERE carPlacaID = '$placa_vehiculo'";
    $result_placa = $conn->query($sql_placa);

    if ($result_placa && $result_placa->num_rows > 0) {
        $row = $result_placa->fetch_assoc();
        $autoCliente_ID = $row['autperID'];

        // Obtener la fecha y hora actual en tiempo real
        $fecha_registro_actual = date('Y-m-d H:i:s');

        // Insertar la cita en la tabla tblcita con citFechaRegistro actualizada
        $sql = "INSERT INTO tblcita (autperID, citFechaCita, citHoraCita, citMotivo, citServicio, citKilometraje, formaID, citFechaRegistro)
                VALUES ('$autoCliente_ID', '$fecha', '$hora', '$comentario', '$tipo_servicio', '$kilome', 1, now())";

        if ($conn->query($sql) === TRUE) {
            // Obtener el ID de la cita recién insertada
            $citaID = $conn->insert_id;

            // Insertar la información de la cita en la tabla tblestadocita
            $sql_estadocita = "INSERT INTO tblestadocita (citID, estEstado)
                               VALUES ('$citaID', 'Pendiente')";

            if ($conn->query($sql_estadocita) === TRUE) {
                // Mostrar ventana emergente de cita agendada
                echo "<script>
                        alert('Cita Agendada');
                        window.location.href = 'calend.php'; // Redirigir a la página anterior
                      </script>";
            } else {
                echo "Error al insertar en tblestadocita: " . $conn->error;
            }
        } else {
            echo "Error al agendar la cita: " . $conn->error;
        }
    } else {
        echo "No se encontró el carro con la placa proporcionada";
    }

    $conn->close();
}
?>