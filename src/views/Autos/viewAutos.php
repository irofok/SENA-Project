<?php
// include('../../DB/conecction.php');
// include('../../navbar.php');
// include('../../sidebar.php');

try {
    $stmt = $conn->prepare("SELECT
    aut.*,
    marc.marcaId,
    marc.marcaNombre,
    comb.combId,
    comb.combNombre,
    carr.carroceriaId,
    carr.carroceria
    FROM tblautos AS aut
    INNER JOIN tblmarca AS marc ON aut.carMarca = marc.marcaId
    INNER JOIN tbltipocombustible  AS comb  ON aut.carCombustible = comb.combId
    INNER JOIN tblcarroceria  AS carr  ON aut.carCarroceria = carr.carroceriaId;
    ");
    $stmt->execute();
    $auto = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error al recuperar autos: " . $e->getMessage();
}


// if (isset($_GET['exito']) && $_GET['exito'] == 1) {
//     echo '<script>$("#modalExito").modal("show");</script>';
// } elseif (isset($_GET['error']) && $_GET['error'] == 1) {
//     echo '<script>$("#modalError").modal("show");</script>';
// }





?>

<?php if(isset($_SESSION['message'])) : ?>
    <h5 class="alert alert-success"><?= $_SESSION['message']; ?></h5>
<?php 
    unset($_SESSION['message']);
    endif; 
?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Auto</title>
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
<body>

<body class="bg-gray-100 p-4">
<div class="container mx-auto p-4" >
    <h1 class="text-3xl mb-4 font-semibold">Autos Registrados</h1>
    <!-- <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden"> -->
    <table class="w-auto h-[200px] bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-2 px-4">Placa</th>
                <th class="py-2 px-4">Marca</th>
                <th class="py-2 px-4">Linea</th>
                <th class="py-2 px-4">Año del modelo</th>
                <th class="py-2 px-4">Combustible</th>
                <th class="py-2 px-4">Carroceria</th>
                <th class="py-2 px-4 text-center">Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($auto as $auto): ?>
                <tr>
                    <td class="py-2 px-4"><?php echo $auto['carPlacaID']; ?></td>
                    <td class="py-2 px-4"><?php echo $auto['marcaNombre']; ?></td>
                    <td class="py-2 px-4"><?php echo $auto['carLinea']; ?></td>
                    <td class="py-2 px-4"><?php echo $auto['carModeloAño']; ?></td>
                    <td class="py-2 px-4"><?php echo $auto['combNombre']; ?></td>
                    <td class="py-2 px-4"><?php echo $auto['carroceria']; ?></td>
                    <td class="py-3 px-4">
                        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal  ">
                            Editar
                        </button> -->
                        <div class="flex items-center">
                        <a href="./views/Autos/editarAutos.php?id=<?php echo $auto['carPlacaID']; ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                        <a href="#" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 rounded deleteCar" onclick="openConfirmationModal(<?php echo $auto['carPlacaID']; ?>)">Eliminar</a>
                        </div>
                     </td>
                </tr>
            <?php endforeach; ?>
         </tbody>
    </table>
</div>



<div class="p-4">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#registroAutoModal">
        Registrar Auto
    </button>
</div>

 <!-- MODAL REGISTRO AUTOS -->
<div class="modal fade" id="registroAutoModal" tabindex="-1" aria-labelledby="registroAutoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="registroAutoModalLabel">Registro de Auto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registroAutoForm" action="./controllers/Autos/controlRegistroAuto.php" method="post">
                    <div class="mb-3">
                            <label for="placa">Placa (3 letras y 3 números):</label>
                            <input type="text" name="placa"  required class="form-control"id="placa">
                    </div>

                    <div class="mb-3">
                            <label for="marca">Marca:</label>
                            <select name="marca" required class="form-control" id="marca">
                                    <?php
                                    // Obtén las opciones de la tabla "marca" desde la base de datos y crea opciones en el menú desplegable
                                    $sql = "SELECT marcaId, marcaNombre FROM tblmarca";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                            
                                    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $marca_id = $fila['marcaId'];
                                        $nombre_marca = $fila['marcaNombre'];
                                        echo "<option value=\"$marca_id\">$nombre_marca</option>";
                                    }
                                    ?>
                            </select>
                    </div>

                    <div class="mb-3">
                            <label for="linea">Linea del auto:</label>
                            <input type="text" name="linea" required class="form-control" id="linea">
                    </div>

                    <div class="mb-3">
                            <label for="modeloAño">Año del modelo:</label>
                            <input type="number" name="modeloAño" required class="form-control" id="modeloAño">
                    </div>

                    <div class="mb-3">
                            <label for="combustible">Tipo de combustible:</label>
                            <select name="combustible" required class="form-control" id="combustible">
                                <?php
                                // Obtén las opciones de la tabla "marca" desde la base de datos y crea opciones en el menú desplegable
                                $sql = "SELECT combId, combNombre FROM tbltipocombustible";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                        
                                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $combId = $fila['combId'];
                                    $nombreCombustible = $fila['combNombre'];
                                    echo "<option value=\"$combId\">$nombreCombustible</option>";
                                }
                                ?>
                            </select>
                    </div>


                    <div class="mb-3">
                            <label for="carroceria">Tipo de combustible:</label>
                            <select name="carroceria" class="form-control" id="carroceria">
                                <?php
                                // Obtén las opciones de la tabla "marca" desde la base de datos y crea opciones en el menú desplegable
                                $sql = "SELECT carroceriaId, carroceria FROM tblcarroceria";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                        
                                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $carroceriaId = $fila['carroceriaId'];
                                    $nombreCarroceria = $fila['carroceria'];
                                    echo "<option value=\"$carroceriaId\">$nombreCarroceria</option>";
                                }
                                ?>
                            </select>
                    </div>

                    <div class="mb-3">
                            <label for="vin">VIN (opcional):</label>
                            <input type="text" name="vin"  class="form-control" id="vin">     
                    </div>

                    <input type="hidden" name="xd" value="insert_auto">
                    <button type="submit" class="btn btn-success">Registrar Auto</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- 
<div id="myModal" class="modal" id="modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-white dark:bg-gray-900 p-6 rounded-md shadow-md max-w-md w-full mx-auto">
        <div class="flex flex-col max-w-md gap-2 p-6 rounded-md shadow-md dark:bg-gray-900 dark:text-gray-100">
                <h2 class="text-xl font-semibold leadi tracki">Eliminar</h2>
                <p class="flex-1 dark:text-gray-400">¿Estás seguro de que quieres eliminar este registro?</p>
                <div class="flex flex-col justify-center gap-3 mt-6 sm:flex-row">
                <button id="cancel-button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" onclick="closeModal()">Cancelar</button>
            <form action="./eliminar_auto.php" method="post">
            <input type="hidden" name="delete_auto_id" id="delete_auto_id">
            <button type="submit" name="delate_auto" id="delate_auto" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Confirmar</button>
            </form>
                </div>
            </div> 
        </div>
    </div>
</div> -->


    <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="deleteAuto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Registro de Auto </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                        <!-- <span aria-hidden="true">&times;</span> -->
                    </button>
                </div>

                <form action="./controllers/Autos/eliminar_auto.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="deleteCar" id="deleteCar">

                        <h4> ¿Quieres eliminar este auto?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModalCar()"> Cancelar </button>
                        <button type="submit" name="deletedatacar" class="btn btn-primary"> Confirmar </button>
                    </div>
                </form>

            </div>
        </div>
    </div>



<script>
        $(document).ready(function () {

            $('.deleteCar').on('click', function () {

                $('#deleteAuto').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#deleteCar').val(data[0]);

            });
        });


        function closeModalCar() {
    var modal = document.getElementById("deleteAuto");
    modal.style.display = "none";
    window.location.href='admin_panel.php'
}

    </script>






<!-- 

    <script>
        // Función para abrir el modal
        function openModal() {
            document.getElementById("myModal").style.display = "block";
        }

        // Función para cerrar el modal
        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }

        // Evento para confirmar la eliminación
        document.getElementById("confirm-button").addEventListener("click", function() {
            // Coloca aquí tu código para eliminar el registro, por ejemplo, redirigir a un script PHP de eliminación.
            // window.location.href = "eliminar_registro.php?id=" + registro_id;
            
            // Cierra el modal
            closeModal();

        
        });
    </script> -->





<!-- Modal de Éxito -->
<!-- <div class="modal fade" id="modalExito" tabindex="-1" role="dialog" aria-labelledby="modalExitoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalExitoLabel">Registro Exitoso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¡El registro se ha actualizado exitosamente!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div> -->


</body>
</html>
