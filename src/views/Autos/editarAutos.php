<?php
include('../../DB/conecction.php');

if (isset($_GET["id"])) {
    $placaID = $_GET["id"];
    echo '<script>$("#myModal").modal("show");</script>';


    try {
        $stmtMarcas = $conn->prepare("SELECT * FROM tblmarca");
        $stmtMarcas->execute();
        $marcas = $stmtMarcas->fetchAll(PDO::FETCH_ASSOC);
    
        $stmtCombustibles = $conn->prepare("SELECT * FROM tbltipocombustible");
        $stmtCombustibles->execute();
        $combustibles = $stmtCombustibles->fetchAll(PDO::FETCH_ASSOC);
    
        $stmtCarrocerias = $conn->prepare("SELECT * FROM tblcarroceria");
        $stmtCarrocerias->execute();
        $carrocerias = $stmtCarrocerias->fetchAll(PDO::FETCH_ASSOC);



        $stmt = $conn->prepare("SELECT * FROM tblautos WHERE carPlacaID = :placaID");
        $stmt->bindParam(":placaID", $placaID);
        $stmt->execute();
        $auto = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$auto) {
            echo "Auto no encontrado.";
            exit;
        }

        
    } catch (PDOException $e) {
        echo "Error al recuperar el auto: " . $e->getMessage();
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Auto</title>
    <!-- Agregar el enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body class="bg-gray-100 p-4">

 <h1 class="text-2xl mb-4 text-center">Actualice los datos</h1>

<form action="../../controllers/Autos/controlEditarAutos.php" method="POST" class="max-w-md mx-auto bg-white p-8 border shadow-lg rounded">
    <div class="mb-4">
        <label for="nuevaPlaca" class="block text-gray-700 font-bold mb-2">Placa:</label>
        <input type="text" name="nuevaPlaca" value="<?php echo $auto['carPlacaID']; ?>" class="w-full px-3 py-2 border rounded">
    </div>

    <div class="mb-4">
        <label for="nuevaMarca" class="block text-gray-700 font-bold mb-2">Marca:</label>
        <select name="nuevaMarca" class="w-full px-3 py-2 border rounded">
            <?php foreach ($marcas as $marca) : ?>
                <option value="<?php echo $marca['marcaId']; ?>" <?php if ($marca['marcaId'] == $auto['carMarca']) echo 'selected'; ?>><?php echo $marca['marcaNombre']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-4">
        <label for="nuevaLinea" class="block text-gray-700 font-bold mb-2">Linea:</label>
        <input type="text" name="nuevaLinea" value="<?php echo $auto['carLinea']; ?>" class="w-full px-3 py-2 border rounded">
    </div>

    <div class="mb-4">
        <label for="nuevoModelo" class="block text-gray-700 font-bold mb-2">Modelo:</label>
        <input type="text" name="nuevoModelo" value="<?php echo $auto['carModeloAño']; ?>" class="w-full px-3 py-2 border rounded">
    </div>

    <div class="mb-4">
        <label for="nuevoCombustible" class="block text-gray-700 font-bold mb-2">Combustible:</label>
        <select name="nuevoCombustible" class="w-full px-3 py-2 border rounded">
            <?php foreach ($combustibles as $combustible) : ?>
                <option value="<?php echo $combustible['combId']; ?>" <?php if ($combustible['combId'] == $auto['carCombustible']) echo 'selected'; ?>><?php echo $combustible['combNombre']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-4">
        <label for="nuevaCarroceria" class="block text-gray-700 font-bold mb-2">Carroceria:</label>
        <select name="nuevaCarroceria" class="w-full px-3 py-2 border rounded">
            <?php foreach ($carrocerias as $carroceria) : ?>
                <option value="<?php echo $carroceria['carroceriaId']; ?>" <?php if ($carroceria['carroceriaId'] == $auto['carCarroceria']) echo 'selected'; ?>><?php echo $carroceria['carroceria']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-4">
        <label for="nuevoVin" class="block text-gray-700 font-bold mb-2">VIN:</label>
        <input type="text" name="nuevoVin" value="<?php echo $auto['carVin']; ?>" class="w-full px-3 py-2 border rounded">
    </div>

    <div class="flex justify-between">
        <input type="hidden" name="accion" value="actualizar_auto">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar Cambios</button>

    
        <button type="button" onclick="redirigir()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Atrás</button>
    </div>
</form>




<script>
    function redirigir() {
        window.location.href = '../../admin_panel.php';
    }
</script>

<!-- 

<script>
    $(document).ready(function() {
        $('form').submit(function(event) {
            event.preventDefault();

            // Envía el formulario usando AJAX
            $.ajax({
                url: './control1.php',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Muestra el modal de registro exitoso
                        $('#registroExitosoModal').modal('show');
                    } else {
                        // Puedes manejar otros casos si es necesario
                    }
                }
            });

            
        });
    });
</script> -->

</body>
</html>
