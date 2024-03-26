<?php
include('../../DB/conecction.php');
// var_dump($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['accion']) && $_POST['accion'] === 'actualizar_auto') {
        $placaID = strtoupper($_POST["nuevaPlaca"]);
        $marca = $_POST["nuevaMarca"];
        $linea = strtoupper($_POST["nuevaLinea"]);
        $modeloAño = $_POST["nuevoModelo"];
        $combustible = $_POST["nuevoCombustible"];
        $carroceria = $_POST["nuevaCarroceria"];
        $vin = strtoupper($_POST["nuevoVin"]);
        
        try {
            $stmt = $conn->prepare("UPDATE tblautos SET carMarca = ?, carLinea = ?, carModeloAño = ?, carCombustible = ?, carCarroceria = ?, carVin = ? WHERE carPlacaID = ?");
            $stmt->execute([$marca, $linea, $modeloAño, $combustible, $carroceria, $vin, $placaID]);



            header('Location: ../../admin_panel.php?id=' . $placaID . '&exito=1');
            exit();
            
        } catch (PDOException $e) {
            // echo "Error al actualizar el auto: " . $e->getMessage();
            header('Location: ../../views/Autos/viewAutos.php?error=1');
            exit();
        }
    }
}




?>
