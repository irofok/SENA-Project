<?php
error_reporting(0);
ini_set('display_errors', 0);


$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "tjek";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$consulta = "SELECT rolId FROM tblRol WHERE rolId = 1";
$resultado = $conn->query($consulta);

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $valor_a_insertar = $fila["rolId"];

    // Ahora puedes usar $valor_a_insertar en tu consulta de inserción en tblClientes
} else {
    echo "No se encontraron resultados.";
}

// Obtén las opciones seleccionadas del campo de selección múltiple
$opciones_seleccionadas = $_POST['cedula'];

// Verifica que las opciones seleccionadas sean válidas (puedes ajustar esto según tus valores válidos)
$opciones_validas = ['1', '2', '3']; // Valores válidos para la clave foránea

foreach ($opciones_seleccionadas as $opcion) {
    if (!in_array($opcion, $opciones_validas)) {
        die("Error: Opción no válida seleccionada.");
    }
}

$nomb = trim($_POST['nombre']);
$segnombre = trim($_POST['nombre2']);
$apell = trim($_POST['apellidos']);
$segapell = trim($_POST['apellidos2']);
$identi = trim($_POST['Identificacion']);
$correo = trim($_POST['correo']);
$telefo = trim($_POST['telefono']);
$direc = trim($_POST['direccion']);
$barr = trim($_POST['barrio']);
$contr = trim($_POST['contraseña']);
$usu = trim($_POST['usuario']);

// Convierte las opciones seleccionadas en una cadena separada por comas (puedes ajustar esto según tu estructura de base de datos)
$opciones_seleccionadas_str = implode(',', $opciones_seleccionadas);

$fecha_actualizacion = date('Y-m-d H:i:s');
$consulta = "INSERT INTO tblpersona(docId, perNumDocumento, perPrimerNombre, perSegundoNombre, perPrimerApellido, perSegundoApellido, perCorreo, perTelefono, perDireccion, perNuevoRegistro, perActualizacionRegistro, perUsuario, perContraseña, rolId)
VALUES('$opciones_seleccionadas_str', '$identi', '$nomb', '$segnombre', '$apell', '$segapell', '$correo', '$telefo', '$direc', NOW(), '$fecha_actualizacion', '$usu', '$contr', '$valor_a_insertar')";

try {
    $resultado = mysqli_query($conn, $consulta);

    if ($resultado) {
        echo "<script>alert('Tu registro se ha completado');</script>";
    } else {
        echo "<script>alert('Ocurrió un error al registrar.');</script>";
    }
} catch (mysqli_sql_exception $e) {
    // Si se produce un error en la inserción debido a un valor duplicado
    $errorCode = $e->getCode();
    
    if ($errorCode === 1062) { // 1062 es el código de error para "Duplicate entry"
        echo "<script>alert('Error este Usuario ya se encuentra registrado.');</script>";
    } else {
        // Otros errores SQL, manejar según sea necesario
        echo "Error: " . $e->getMessage();
    }
}

// Cerrar la conexión
$conn->close();
?>
