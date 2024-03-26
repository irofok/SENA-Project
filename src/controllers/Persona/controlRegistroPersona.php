<?PHP

include('../../DB/conecction.php');
// var_dump($_POST);



if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
        case 'insert_persona':
            // Obtener los valores del formulario
            $tipoDocumento = $_POST["tipoDocumento"];
            $numeroDocumento = $_POST["numeroDocumento"];
            $primerNombre = $_POST["nombre1"];
            $segundoNombre = $_POST["nombre2"];
            $primerApellido = $_POST["apellido1"];
            $segundoApellido = $_POST["apellido2"];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
            
            // Llamar a la función registrarPersona
            $resultado = registrarPersona($conn, $tipoDocumento, $numeroDocumento, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $correo, $telefono, $direccion);

            // Imprimir el resultado
            echo $resultado;
            header("Location: ../../admin_panel.php");
            break;  

            
    }
}

function registrarPersona($conn, $tipoDocumento, $numeroDocumento, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $correo, $telefono, $direccion) {
    $fechaNueva = time();

    try {
        $stmt = $conn->prepare("INSERT INTO tblpersona (docId, perNumDocumento, perPrimerNombre, perSegundoNombre, perPrimerApellido, perSegundoApellido, perCorreo, perTelefono, perDireccion, perNuevoRegistro) 
        VALUES (:docId, :numDocumento, :primerNombre, :segundoNombre, :primerApellido, :segundoApellido, :correo, :telefono, :direccion, FROM_UNIXTIME(:fechaNueva))");
        $stmt->bindParam(':docId', $tipoDocumento);
        $stmt->bindParam(':numDocumento', $numeroDocumento);
        $stmt->bindParam(':primerNombre', $primerNombre);
        $stmt->bindParam(':segundoNombre', $segundoNombre);
        $stmt->bindParam(':primerApellido', $primerApellido);
        $stmt->bindParam(':segundoApellido', $segundoApellido);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':fechaNueva', $fechaNueva);
        $stmt->execute();

        return "Persona registrada con éxito.";

        

        
    } catch (PDOException $e) {
        return "Error al registrar persona: " . $e->getMessage();
    }
    
}



?>



