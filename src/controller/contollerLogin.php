<?php
session_start();

$mensajeError = "";

if (isset($_POST["btningresar"])) {
    // Aquí puedes agregar la conexión a la base de datos si no la has definido previamente
    $conexion = new mysqli("127.0.0.1", "root", "", "tjek");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $_SESSION['username'] = $username;

    $sql = "SELECT * FROM tblpersona WHERE perUsuario ='$username' AND perContraseña ='$password'";
    $result = $conexion->query($sql);

    if ($result && $result->num_rows > 0) {
        $datos = $result->fetch_object();
        if ($datos->rolId == "1") {
            $_SESSION["id"] = $datos->perID;
            $_SESSION["PrimerNombre"] = $datos->perPrimerNombre;
            $_SESSION["SegundoNombre"] = $datos->perSegundoNombre;
            $_SESSION["PrimerApellido"] = $datos->perPrimerApellido;
            $_SESSION["SegundoApellido"] = $datos->perSegundoApellido;
            $_SESSION["placa"] = $datos->carPlacaID; // Almacena la placa en la sesión

            // Recuperar las placas asociadas al cliente y almacenarlas en un array
            $placas = array();
            $sql_placas = "SELECT carPlacaID FROM tblautopersona WHERE perID = '{$_SESSION["id"]}'";
            $result_placas = $conexion->query($sql_placas);
            while ($row = $result_placas->fetch_assoc()) {
                $placas[] = $row["carPlacaID"];
            }
            $_SESSION["placas"] = $placas;

            header("location: menuResponsive.php");
            exit();
        } elseif ($datos->rolId == "2") {
            $_SESSION["id"] = $datos->perID;
            $_SESSION["PrimerNombre"] = $datos->perPrimerNombre;
            $_SESSION["SegundoNombre"] = $datos->perSegundoNombre;
            $_SESSION["PrimerApellido"] = $datos->perPrimerApellido;
            $_SESSION["SegundoApellido"] = $datos->perSegundoApellido;
            $_SESSION["placa"] = $datos->carPlaca_ID;
            header("location: admin_panel.php");
            exit();
        }
    } else {
        // Usuario no encontrado o contraseña incorrecta
        $mensajeError = "Usuario no encontrado";
    }
}
?>