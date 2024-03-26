<?php
// include('../DB/conecction.php');

try {
    $stmt = $conn->prepare("SELECT 
    stc.*, 
    cit.citID, 
    cit.autperID, 
    cit.citFechaCita, 
    cit.citHoraCita, 
    autoper.autperID,
    autoper.carPlacaID, 
    autoper.perID, 
    per.perID, 
    per.perPrimerNombre,
    per.perSegundoNombre, 
    per.perPrimerApellido, 
    per.perSegundoApellido, 
    per.perNumDocumento, 
    doc.docId, 
    doc.docDescripcion, 
    auto.carPlacaID
FROM 
    tblestadocita AS stc
INNER JOIN 
    tblcita AS cit ON stc.citID = cit.citID
INNER JOIN 
    tblautopersona AS autoper ON cit.autperID = autoper.autperID
INNER JOIN 
    tblpersona AS per ON autoper.perID = per.perID
INNER JOIN 
    tbltipodocumento AS doc ON per.docId = doc.docId
INNER JOIN 
    tblautos AS auto ON autoper.carPlacaID = auto.carPlacaID;");
    
    $stmt->execute();
    $clientes = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error al recuperar clientes: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Estado citas</title>
    <!-- Agregamos Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl mb-4 font-semibold">Editar Estado de la Cita</h1>
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="py-2 px-4">Estado N°</th>
                    <th class="py-2 px-4">Cita N°</th>
                    <th class="py-2 px-4">Tipo de Documento</th>
                    <th class="py-2 px-4">Número de Documento</th>
                    <th class="py-2 px-4">Nombres</th>
                    <th class="py-2 px-4">Apellidos</th>
                    <th class="py-2 px-4">Placa</th>
                    <th class="py-2 px-4">Fecha de la Cita</th>
                    <th class="py-2 px-4">Hora de la Cita</th>
                    <th class="py-2 px-4">Estado de la Cita</th>
                    <th class="py-2 px-4">Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td class="py-2 px-4"><?php echo $cliente['estCitaID']; ?></td>
                        <td class="py-2 px-4"><?php echo $cliente['citID']; ?></td>
                        <td class="py-2 px-4"><?php echo $cliente['docDescripcion']; ?></td>
                        <td class="py-2 px-4"><?php echo $cliente['perNumDocumento']; ?></td>
                        <td class="py-2 px-4"><?php echo $cliente['perPrimerNombre'] . ' ' . $cliente['perSegundoNombre']; ?></td>
                        <td class="py-2 px-4"><?php echo $cliente['perPrimerApellido'] . ' ' . $cliente['perSegundoApellido']; ?></td>
                        <td class="py-2 px-4"><?php echo $cliente['carPlacaID']; ?></td>
                        <td class="py-2 px-4"><?php echo $cliente['citFechaCita']; ?></td>
                        <td class="py-2 px-4"><?php echo $cliente['citHoraCita']; ?></td>
                        <td class="py-2 px-4"><?php echo $cliente['estEstado']; ?></td>
                        <td class="py-2 px-4">
                            <form method="post" action="./controllers/Citas/controlEstadoCita.php" class="flex items-center">
                                <div class="mr-2">
                                    <select name="nuevo_estado" class="py-1 px-2 border rounded-lg">
                                        <option value="CANCELADA">Cancelada</option>
                                        <option value="ATENDIDA">Atendida</option>
                                        <option value="PENDIENTE">Pendiente</option>
                                    </select>
                                </div>
                                <input type="hidden" name="estCitaID" value="<?php echo $cliente['estCitaID']; ?>">
                                <input type="submit" value="Cambiar Estado" onclick="confirmarCambio(this)" class="py-1 px-2 bg-blue-500 text-white rounded-lg">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>



        <script>
    function confirmarCambio(button) {
        // Mostrar un cuadro de diálogo de confirmación
        var confirmacion = confirm("¿Estás seguro de que deseas cambiar el estado de esta cita?");

        if (confirmacion) {
            // Si el usuario confirma, se envía el formulario
            button.closest(".estado-form").submit();
        }
    }
</script>

</body>
</html>
