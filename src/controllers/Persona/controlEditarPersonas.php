<?php
include('../../DB/conecction.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === 'actualizar_persona'){
    // Recupera el valor del campo "nombreCompleto" del formulario
    $cliente_id = $_POST['perID'];
    $nombreCompleto = $_POST['nombreCompleto'];

    // Divide el nombre completo en primer y segundo nombre
    $nombres = explode(' ', $nombreCompleto);

    if (count($nombres) >= 2) {
        $primerNombre = $nombres[0];
        $segundoNombre = $nombres[1];
    } else {
        // Si solo se proporciona un nombre, guárdalo en el primer nombre y deja el segundo en blanco
        $primerNombre = $nombreCompleto;
        $segundoNombre = '';
    }

    // Recupera el valor del campo "apellidoCompleto" del formulario
    $apellidoCompleto = $_POST['apellidoCompleto'];

    // Divide el apellido completo en primer y segundo apellido
    $apellidos = explode(' ', $apellidoCompleto);

    if (count($apellidos) >= 2) {
        $primerApellido = $apellidos[0];
        $segundoApellido = $apellidos[1];
    } else {
        // Si solo se proporciona un apellido, guárdalo en el primer apellido y deja el segundo en blanco
        $primerApellido = $apellidoCompleto;
        $segundoApellido = '';
    }


    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
    $fechaActualizacion = $_POST['fecha_actualizacion'];


    // Actualiza los campos correspondientes en la base de datos usando los valores divididos
    $stmt = $conn->prepare("UPDATE tblpersona SET perPrimerNombre = :perPrimerNombre, perSegundoNombre = :perSegundoNombre, perPrimerApellido = :perPrimerApellido, perSegundoApellido = :perSegundoApellido, perCorreo=:perCorreo, perTelefono=:perTelefono, perDireccion=:perDireccion, perActualizacionRegistro=:perActualizacionRegistro  WHERE perID = :perID");
    $stmt->bindParam(':perPrimerNombre', $primerNombre);
    $stmt->bindParam(':perSegundoNombre', $segundoNombre);
    $stmt->bindParam(':perPrimerApellido', $primerApellido);
    $stmt->bindParam(':perSegundoApellido', $segundoApellido);
    $stmt->bindParam(':perCorreo', $correo);
    $stmt->bindParam(':perTelefono', $telefono);
    $stmt->bindParam(':perDireccion', $direccion);
    $stmt->bindParam(':perActualizacionRegistro', $fechaActualizacion);
    $stmt->bindParam(':perID', $cliente_id);



if ($stmt->execute()) {
            echo "Cliente actualizado exitosamente.";
            header('Location: ../../admin_panel.php?id=' . $cliente_id . '&exito=1');
            exit();

        } else {
            echo "Error al actualizar el cliente: " . $stmt->errorCode();
            
        }

    }
}


?>