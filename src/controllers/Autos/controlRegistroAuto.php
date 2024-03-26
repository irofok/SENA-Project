<?PHP
include('../../DB/conecction.php');

    
// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     $placa = strtoupper($_POST["placa"]);
//     $marca_id = $_POST["marca"];
//     $linea = strtoupper($_POST["linea"]);
//     $modelo = $_POST['modeloAño'];
//     $combustible = $_POST['combustible'];
//     $carroceria = $_POST['carroceria'];
//     $vin = $_POST['vin'];
    

//     // Realiza la inserción en la tabla "autos"
//     try {



//         $stmt = $conn->prepare("INSERT INTO tblautos (carPlacaID,carMarca,carLinea,carModeloAño,carCombustible,carCarroceria,carVin) VALUES (:placa,:marca,:linea,:modelo,:comb,:forma,:numChasis)");
//         // :modeloAño,:combustible,:carroceria,:vin)");
//         $stmt->bindParam(":placa", $placa);
//         $stmt->bindParam(":marca", $marca_id);
//         $stmt->bindParam(":linea", $linea);
//         $stmt->bindParam(":modelo", $modelo);
//         $stmt->bindParam(":comb", $combustible);
//         $stmt->bindParam(":forma", $carroceria);
//         $stmt->bindParam(":numChasis", $vin);
//         $stmt->execute();
//         echo "Registro exitoso";
//     } catch (PDOException $e) {
//         echo "Error al registrar el auto: " . $e->getMessage();
//     }

// }

// if (isset($_POST['accion'])) {
//     switch ($_POST['accion']) {
//         case 'insert_auto':
//             $placa = strtoupper($_POST["placa"]);
//             $marca_id = $_POST["marca"];
//             $linea = strtoupper($_POST["linea"]);
//             $modelo = $_POST['modeloAño'];
//             $combustible = $_POST['combustible'];
//             $carroceria = $_POST['carroceria'];
//             $vin = $_POST['vin'];

//             $resultado = registrarAuto($conn, $placa, $marca_id, $linea, $modelo, $combustible, $carroceria, $vin);

//             echo $resultado;
//             break;
//     }
// }

// function registrarAuto($conn, $placa, $marca_id, $linea, $modelo, $combustible, $carroceria, $vin) {
//     try {
//         $stmt = $conn->prepare("INSERT INTO tblautos (carPlacaID,carMarca,carLinea,carModeloAño,carCombustible,carCarroceria,carVin) VALUES (:placa,:marca,:linea,:modelo,:comb,:forma,:numChasis)");
//         $stmt->bindParam(":placa", $placa);
//         $stmt->bindParam(":marca", $marca_id);
//         $stmt->bindParam(":linea", $linea);
//         $stmt->bindParam(":modelo", $modelo);
//         $stmt->bindParam(":comb", $combustible);
//         $stmt->bindParam(":forma", $carroceria);
//         $stmt->bindParam(":numChasis", $vin);
//         $stmt->execute();
//         return "Registro exitoso";
//     } catch (PDOException $e) {
//         return "Error al registrar el auto: " . $e->getMessage();
//     }
// }

function registrarAuto($conn, $placa, $marca_id, $linea, $modelo, $combustible, $carroceria, $vin) {
    try {
        $stmt = $conn->prepare("INSERT INTO tblautos (carPlacaID,carMarca,carLinea,carModeloAño,carCombustible,carCarroceria,carVin) VALUES (:placa,:marca,:linea,:modelo,:comb,:forma,:numChasis)");
        $stmt->bindParam(":placa", $placa);
        $stmt->bindParam(":marca", $marca_id);
        $stmt->bindParam(":linea", $linea);
        $stmt->bindParam(":modelo", $modelo);
        $stmt->bindParam(":comb", $combustible);
        $stmt->bindParam(":forma", $carroceria);
        $stmt->bindParam(":numChasis", $vin);
        $stmt->execute();
        return "Registro exitoso";
    } catch (PDOException $e) {
        return "Error al registrar el auto: " . $e->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $placa = strtoupper($_POST["placa"]);
    $marca_id = $_POST["marca"];
    $linea = strtoupper($_POST["linea"]);
    $modelo = $_POST['modeloAño'];
    $combustible = $_POST['combustible'];
    $carroceria = $_POST['carroceria'];
    $vin = $_POST['vin'];

    $resultado = registrarAuto($conn, $placa, $marca_id, $linea, $modelo, $combustible, $carroceria, $vin);
    header("Location: ../../admin_panel.php");
}


?>

