<?php
// include('../../DB/conecction.php');

try {
    $stmt = $conn->prepare("SELECT * FROM tblpersona");
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
    <title>Personas</title>
    <!-- Agregar el enlace a Bootstrap CSS -->
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
<h1 class="text-3xl mb-4 font-semibold">Personas Registradas</h1>
<!-- <div class="overflow-y-auto"> -->
    
<table class="w-auto h-[800px] bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden">
    <thead class="bg-gray-200">
        <tr>
            <th  class="py-2 px-4">ID</th>
            <th class="py-2 px-4">Nombres</th>
            <th class="py-2 px-4">Apellidos</th>
            <th class="py-2 px-4 text-center">Correo</th>
            <th class="py-2 px-4">Telefono</th>
            <th class="py-2 px-4">Direccion</th>
            <th class="py-2 px-4">Fecha Creacion</th>
            <th class="py-2 px-4 text-center">Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clientes as $clientes): ?>
            <tr>
                <td class="py-2 px-4"><?php echo $clientes['perID']; ?></td>
                <td class="py-2 px-4"><?php echo $clientes['perPrimerNombre'] . ' ' . $clientes['perSegundoNombre']; ?></td>
                <td class="py-2 px-4"><?php echo $clientes['perPrimerApellido'] . ' ' . $clientes['perSegundoApellido']; ?></td>
                <td class="py-2 px-4"><?php echo $clientes['perCorreo']; ?></td>
                <td class="py-2 px-4"><?php echo $clientes['perTelefono']; ?></td>
                <td class="py-2 px-4"><?php echo $clientes['perDireccion']; ?></td>
                <td class="py-2 px-4"><?php echo $clientes['perNuevoRegistro']; ?></td>
                <td class=class="py-3 px-4">
                    <div class="flex items-center">
                    <a href="./views/Personas/editarPersonas.php?id=<?php echo $clientes['perID']; ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                    
                    <a href="#" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 rounded delete" onclick="" >Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!-- </div> -->
</div>

<div class="p-4">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registroPersonaModal">
    Registrar Persona
</button>
</div>

<!-- Modal de Registro de Persona -->
<div class="modal fade" id="registroPersonaModal" tabindex="-1" aria-labelledby="registroPersonaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registroPersonaModalLabel">Registro de Persona</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registroPersonaForm" action="./controllers/Persona/controlRegistroPersona.php" method="post">
                    <div class="mb-3">
                        <label for="tipoDocumento" >Tipo de documento:</label>
                                <select name="tipoDocumento" id="tipoDocumento" class="form-control">
                                <?php
                                    // Obtén las opciones de la tabla "marca" desde la base de datos y crea opciones en el menú desplegable
                                    $sql = "SELECT docId, docDescripcion FROM tbltipodocumento";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                            
                                    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $documentoID = $fila['docId'];
                                        $documentoDescripcion = $fila['docDescripcion'];
                                        echo "<option value=\"$documentoID\">$documentoDescripcion</option>";
                                    }
                                    ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="numeroDocumento">Número de Documento:</label>
                        <input type="text" name="numeroDocumento" required pattern="[0-9]+" title="Ingrese solo números"  class="form-control" id="numeroDocumento"/>
                    </div>

                    <div class="mb-3">
                            <label for="nombre1">Primer Nombre:</label>
                            <input type="text" name="nombre1" required class="form-control" id="nombre1" >
                    </div>

                    <div class="mb-3">
                            <label for="nombre2">Segundo Nombre:</label>
                            <input type="text" name="nombre2"  class="form-control" id="nombre2" >
                    </div>

                    <div class="mb-3">
                            <label for="apellido1">Primer Apellido:</label>
                            <input type="text" name="apellido1" required  class="form-control" id="apellido1">
                    </div>

                    
                    <div class="mb-3">
                            <label for="apellido2">Segundo Apellido:</label>
                            <input type="text" name="apellido2" required  class="form-control" id="apellido2">
                    </div>


                    <div class="mb-3">
                            <label for="correo">correo:</label>
                            <input type="text" name="correo" required  class="form-control" id="correo" >
                    </div>

                    <div class="mb-3">
                            <label for="telefono">telefono:</label>
                            <input type="text" name="telefono" required  class="form-control" id="telefono">
                    </div>

                    <div class="mb-3">
                            <label for="direccion">direccion:</label>
                            <input type="text" name="direccion" required  class="form-control" id="direccion">
                    </div>
                    <input type="hidden" name="accion" value="insert_persona">
                    <button type="submit" class="btn btn-primary">Registrar Persona</button>
                </form>
            </div>
        </div>
    </div>
</div>


  <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
  <div class="modal fade" id="deletePersona" tabindex="-1" role="dialog" aria-labelledby="registroPersonaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registroPersonaModalLabel">Registro de Persona</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="./controllers/Persona/eliminar_persona.php" method="POST">
                    <div class="modal-body">
                    <input type="hidden" name="deletePer" id="deletePer">
                        <h4> ¿Quieres eliminar esta persona? </h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()"> Cancelar </button>
                        <button type="submit" name="deletedataper" class="btn btn-primary"> Confirmar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



    <script>
        $(document).ready(function () {

            $('.delete').on('click', function () {

                $('#deletePersona').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#deletePer').val(data[0]);

            });
        });


        function closeModal() {
    var modal = document.getElementById("deletePersona");
    modal.style.display = "none";
    window.location.href='admin_panel.php'
}
</script>




</body>
</html>
