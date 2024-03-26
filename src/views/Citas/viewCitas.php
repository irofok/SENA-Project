<?php
// include('../DB/conecction.php');

try {
    $stmt = $conn->prepare("SELECT 
    cit.*, 
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
    auto.carPlacaID,
    agd.formaID,
    agd.formaTipo,
    COALESCE(cit.citMotivo, 'Sin Motivo') AS motivo_visible
FROM tblcita AS cit
INNER JOIN tblautopersona AS autoper ON cit.autperID = autoper.autperID
INNER JOIN tblpersona AS per ON autoper.perID = per.perID
INNER JOIN tbltipodocumento AS doc ON per.docId = doc.docId
INNER JOIN tblautos AS auto ON autoper.carPlacaID = auto.carPlacaID
INNER JOIN tblformagendacion AS agd ON cit.formaID = agd.formaID
ORDER BY cit.citFechaCita,cit.citHoraCita ASC;
");
    
    $stmt->execute();
    $citas = $stmt->fetchAll();
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
    <title>citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Agregar los scripts de Bootstrap y tu script personalizado -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

</head>
<body class="bg-gray-100 p-4">
    
<div class="container mx-auto p-4" >
<h1 class="text-3xl mb-4 font-semibold">Citas</h1>

<table   class="min-w-auto bg-white shadow-md rounded-lg overflow-hidden">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-1 text-sm">Cita N°</th>
            <th class="p-2 text-sm">tipo documento</th>
            <th class="p-2 text-sm">numero documento</th>
            <th class="p-2 text-sm">Nombres</th>
            <th class="p-2 text-sm">Apellidos</th>
            <th class="p-2 text-sm">Placa</th>
            <th class="p-2 text-sm">Kilometraje</th>
            <th class="p-2 text-sm">Fecha de la cita</th>
            <th class="p-2 text-sm">Hora de la cita</th>
            <th class="p-2 text-sm w-[200px]">Motivo</th>
            <th class="p-2 text-sm">Servicio</th>
            <th class="p-2 text-sm">Forma Agendacion</th>
            <!-- <th class="p-2 text-sm">Fecha de registro</th> -->
            <th class="p-2 text-sm text-center">Acción</th>
            
        </tr>
    </thead>
    <tbody>
        <?php foreach ($citas as $citas): ?>
            <tr>
                <td class="p-1 text-sm"><?php echo $citas['citID']; ?></td>
                <td class="p-2 text-sm"><?php echo $citas['docDescripcion']; ?></td>
                <td class="p-2 text-sm"><?php echo $citas['perNumDocumento']; ?></td>
                <td class="p-2 text-sm"><?php echo $citas['perPrimerNombre'] . ' ' . $citas['perSegundoNombre']; ?></td>
                <td class="p-2 text-sm"><?php echo $citas['perPrimerApellido'] . ' ' . $citas['perSegundoApellido']; ?></td>
                <td class="p-2 text-sm"><?php echo $citas['carPlacaID']; ?></td>
                <td class="p-2 text-sm"><?php echo $citas['citKilometraje']; ?></td>
                <td class="p-2 text-sm"><?php echo $citas['citFechaCita']; ?></td>
                <td class="p-2 text-sm"><?php echo $citas['citHoraCita']; ?></td>
                <td class="p-2 text-sm w-[200px]"><?php echo ($citas['motivo_visible'] === "") ? "Sin motivo" : $citas['motivo_visible']; ?></td>
                <td class="p-2 text-sm"><?php echo $citas['citServicio']; ?></td>
                <td class="p-2 text-sm"><?php echo $citas['formaTipo']; ?></td>
                <!-- <td class="p-2 text-sm"><?php //echo $citas['citFechaRegistro']; ?></td> -->
                <td class="py-2 px-4 flex space-x-2">
                    <a href="./views/Citas/editarCitas.php?id=<?php echo $citas['citID']; ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
    


<!-- Botón que abre el modal para registrar Cita -->
<div class="p-4">
<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#registroCitaModal">
    Registrar Cita
</button>
</div>

<div class="modal fade" id="registroCitaModal" tabindex="-1" aria-labelledby="registroCitaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registroCitaModalLabel">Registro de Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registroCitaForm" action="./controllers/Citas/controlRegistroCita.php" method="post">
                    <div class="mb-3">
                        <label for="txtPlaca">Placa:</label>
                        <select name="txtPlaca"  class="form-control" id="txtPlaca"  >
                        <?php

                        $sql = "SELECT carPlacaID, carLinea, marc.marcaId,
                        marc.marcaNombre FROM tblautos AS aut
                        INNER JOIN tblmarca AS marc ON aut.carMarca = marc.marcaId";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();

                        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $txtPlacaID = $fila['carPlacaID'];
                            $txtNombreMarca= $fila['marcaNombre'];
                            $txtLinea = $fila['carLinea'];
                            echo "<option value=\"$txtPlacaID\">$txtPlacaID  $txtNombreMarca $txtLinea </option>";
                        }
                        ?>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="txtNumero">Numero Identificacion:</label>
                        <select name="txtNumero"  class="form-control" id="txtNumero"  >
                        <?php
                        // Obtén las opciones de la tabla "tblformagendacion" desde la base de datos y crea opciones en el menú desplegable
                        $sql = "SELECT perID, perNumDocumento, doc.docId, doc.docDescripcion, perPrimerNombre, perSegundoNombre, perPrimerApellido, perSegundoApellido 
                        FROM tblpersona AS per
                        INNER JOIN tbltipodocumento AS doc  ON per.docId = doc.docId ";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();

                        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $txtPerID = $fila['perID'];
                            $txtTipo = $fila['docDescripcion'];
                            $txtNumero = $fila['perNumDocumento'];  
                            $txtNombres = $fila['perPrimerNombre'] . ' ' . $fila['perSegundoNombre'];
                            $txtApellidos = $fila['perPrimerApellido'] . ' ' . $fila['perSegundoApellido'];
                            echo "<option value=\"$txtPerID\">$txtTipo $txtNumero $txtNombres $txtApellidos</option>";
                        }
                        ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="fecha">Fecha de Cita:</label>
                        <input type="date" name="fecha" required  class="form-control" id="fecha"> 
                    </div>

                        
                    <div class="mb-3">
                        <label for="hora">Hora de Cita:</label>
                        <input type="time" name="hora" required  class="form-control" id="hora" >
                    </div>

                        
                    <div class="mb-3">
                        <label for="nuevoMotivo">Motivo:</label >
                        <textarea  name="nuevoMotivo" rows="4" cols="50" value="<?php echo $cita['citMotivo']; ?>"  class="form-control" id="nuevoMotivo"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="kmAuto">Kilometraje del auto:</label>
                        <input type="number" name="kmAuto" required  class="form-control" id="kmAuto" >
                    </div>

                    <div class="mb-3">
                        <label for="servicios">Servicio:</label>
                        <select name="servicios"  class="form-control" id="servicios"  >
                        <option value="Mantenimiento">Mantenimiento</option>
                        <option value="Mantenimiento Correctivo">Mantenimiento Correctivo</option>
                        <option value="Cambio de respuesto">Cambio de respuesto</option>
                        <option value="Sistema Eléctrico y Electrónico">Sistema Eléctrico y Electrónico</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="formaAgenda">Forma de Agendación:</label>
                        <select name="formaAgenda"  class="form-control" id="formaAgenda" >
                        <?php
                        // Obtén las opciones de la tabla "tblformagendacion" desde la base de datos y crea opciones en el menú desplegable
                        $sql = "SELECT formaID, formaTipo FROM tblformagendacion";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();

                        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $agenda_Id = $fila['formaID'];
                            $formaAgendacion = $fila['formaTipo'];
                            echo "<option value=\"$agenda_Id\">$formaAgendacion</option>";
                        }
                        ?>
                        </select>
                    </div>

                    <input type="hidden" name="accion" value="insert_cita">
                    <button type="submit" class="btn btn-info">Registrar Cita</button>
                </form>
            </div>
        </div>
    </div>
</div>



</body>
</html>
