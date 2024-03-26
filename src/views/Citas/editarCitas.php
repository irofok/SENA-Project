<?php
include('../../DB/conecction.php');

if (isset($_GET["id"])) {
    $citID = $_GET["id"];

    try {
        $stmt = $conn->prepare("SELECT * FROM tblcita WHERE citID = :citID");
        $stmt->bindParam(":citID", $citID);
        $stmt->execute();
        $cita = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$cita) {
            echo "Cita no encontrada.";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error al recuperar la cita: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cita</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body class="bg-gray-100 p-4">
<h1 class="text-2xl mb-4 text-center">Actualizar Datos de la Cita</h1>
    <form action="../../controllers/Citas/controlEditarCita.php" method="POST" class="max-w-md mx-auto bg-white p-8 border shadow-lg rounded">
        <input type="hidden" name="citID" value="<?php echo $cita['citID']; ?>" class="w-full px-3 py-2 border rounded">
        <div class="mb-4">
        <label for="nuevoMotivo"  class="block text-gray-700 font-bold mb-2">Motivo:</label>
        <textarea id="motivo" name="nuevoMotivo" rows="4" cols="50" value="<?php echo $cita['citMotivo']; ?>"class="w-full px-3 py-2 border rounded"></textarea><br>
        </div>


        <div class="mb-4">
        <label for="nuevaFecha"  class="block text-gray-700 font-bold mb-2">Fecha:</label>
        <input type="date" name="nuevaFecha" value="<?php echo $citas['citFechaCita']; ?>" class="w-full px-3 py-2 border rounded"><br>
        </div>


        <div class="mb-4">
        <label for="nuevaHora"  class="block text-gray-700 font-bold mb-2">Hora:</label>
        <input type="time" name="nuevaHora" value="<?php echo $citas['citHoraCita']; ?>" class="w-full px-3 py-2 border rounded"><br>
        </div>


        <div class="mb-4">
        <label for="servicios"  class="block text-gray-700 font-bold mb-2">Servicio:</label>
        <select name="servicios" class="w-full px-3 py-2 border rounded">
            <option value="Mantenimiento" <?php if ($cita['citServicio'] === 'Mantenimiento') echo 'selected'; ?>>Mantenimiento</option>
            <option value="Mantenimiento Correctivo" <?php if ($cita['citServicio'] === 'Mantenimiento Correctivo') echo 'selected'; ?>>Mantenimiento Correctivo</option>
            <option value="Cambio de respuesto" <?php if ($cita['citServicio'] === 'Cambio de respuesto') echo 'selected'; ?>>Cambio de respuesto</option>
            <option value="Sistema Eléctrico y Electrónico" <?php if ($cita['citServicio'] === 'Sistema Eléctrico y Electrónico') echo 'selected'; ?>>Sistema Eléctrico y Electrónico</option>
        </select>
        </div>
        

        <div class="mb-4">
        <label for="formaAgenda"  class="block text-gray-700 font-bold mb-2">Forma Agendacion:</label>
        <select name="formaAgenda" class="w-full px-3 py-2 border rounded">
            <option value="1" <?php if ($cita['formaID'] === '1') echo 'selected'; ?>>VIRTUAL</option>
            <option value="2" <?php if ($cita['formaID'] === '2') echo 'selected'; ?> selected >PRESENCIAL</option>
        </select>
        </div>


        <div class="flex justify-between">
        <input type="hidden" name="accion" value="actualizar_cita">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar Cambios</button>

    
        <button type="button" onclick="redirigir()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Atrás</button>
    </div>
    </form>



    <script>
    function redirigir() {
        window.location.href = '../../admin_panel.php';
    }
</script>

</body>
</html>
