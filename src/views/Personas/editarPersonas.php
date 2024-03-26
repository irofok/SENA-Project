<?php
include('../../DB/conecction.php');

// Verifica si se proporcionó un ID válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $cliente_id = $_GET['id'];

    try {

        // Consulta para obtener los datos del cliente
        $stmt = $conn->prepare("SELECT * FROM tblpersona WHERE perID = :perID");
        $stmt->bindParam(':perID', $cliente_id);
        $stmt->execute();
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$cliente) {
            echo "Cliente no encontrado.";
        }
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }
} else {
    echo "ID de cliente no válido.";
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body class="bg-gray-100 p-4">
    <h1 class="text-2xl mb-4 text-center">Actualizar Datos de la Persona</h1>
    <form method="POST" action="../../controllers/Persona/controlEditarPersonas.php" class="max-w-md mx-auto bg-white p-8 border shadow-lg rounded">

    <!--  CAMPO ID -->
    <input type="hidden" name="perID" value="<?php echo $cliente['perID']; ?>">



    <!-- PRIMER CAMPO -->
    <div class="mb-4"> 
        <label for="nombreCompleto"  class="block text-gray-700 font-bold mb-2">Nombres:</label>
        <input type="text" name="nombreCompleto" id="nombreCompleto" placeholder="Actualice los nombres de <?php echo $cliente['perPrimerNombre'] . ' ' . $cliente['perSegundoNombre']; ?>" class="w-full px-3 py-2 border rounded"><br>
        <div id="mensaje" style="color: red;"></div>
    </div>
        <!-- SCRIPT MENSAJE DE ADVERTENCIA POR CAMPO VACIO -->
    <script>
        // Obtén el campo de nombre completo y el elemento de mensaje
        const nombreCompletoInput = document.getElementById('nombreCompleto');
        const mensaje = document.getElementById('mensaje');

        // Agrega un evento para verificar cuando se envía el formulario
        nombreCompletoInput.addEventListener('blur', function() {
            // Verifica si el campo está vacío
            if (!this.value.trim()) {
                // Si está vacío, muestra el mensaje de advertencia
                mensaje.textContent = 'Por favor, actualice los nombres.';
            } else {
                // Si no está vacío, borra el mensaje de advertencia
                mensaje.textContent = '';
            }
        });
    </script>

    <div class="mb-4">
    <!-- CAMPO APELLIDOS -->
        <label for="apellidoCompleto" class="block text-gray-700 font-bold mb-2">Apellidos:</label>
        <input type="text" name="apellidoCompleto" id="apellidoCompleto" value="<?php echo $cliente['perPrimerApellido'] . ' ' . $cliente['perSegundoApellido']; ?>" class="w-full px-3 py-2 border rounded"><br>
 </div>

    <!-- CAMPO CORREO -->
    <div class="mb-4">
    <label for="correo" class="block text-gray-700 font-bold mb-2">Correo:</label>
    <input type="text" name="correo" id="correo" value="<?php echo $cliente['perCorreo']; ?>" class="w-full px-3 py-2 border rounded"><br>
 </div>

    <!-- CAMPO TELEFONO  -->
    <div class="mb-4">
    <label for="telefono" class="block text-gray-700 font-bold mb-2">Telefono:</label>
    <input type="text" name="telefono" id="telefono" value="<?php echo $cliente['perTelefono'] ; ?>" class="w-full px-3 py-2 border rounded"><br>
 </div>

    <!-- CAMPO DIRECCION -->
    <div class="mb-4">
    <label for="direccion" class="block text-gray-700 font-bold mb-2">Direccion:</label>
    <input type="text" name="direccion" id="direccion" value="<?php echo $cliente['perDireccion']; ?>" class="w-full px-3 py-2 border rounded"><br>
 </div>

    <!-- CAMPO FECHA ACTUALIZACION REGISTRO -->
    <div class="mb-4">
    <label for="fecha_actualizacion" class="block text-gray-700 font-bold mb-2">Fecha Actualizacion</label>
    <input type="datetime-local" name="fecha_actualizacion" value="<?php echo date('perActualizacionRegistro'); ?>" class="w-full px-3 py-2 border rounded">
 </div>

        <div class="flex justify-between">
        <input type="hidden" name="accion" value="actualizar_persona">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar Cambios</button>
            <button  type="button" onclick="redirigir()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" data-dismiss="modal"  >Cerrar</button>
        </div>
    </form>
    <script>
    function redirigir() {
        window.location.href = '../../admin_panel.php';
    }
</script>

</body>
</html>