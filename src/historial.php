<?php
session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "tjek";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario de comentario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comentario"])) {
    $comentario = $_POST["comentario"];
    $citID = $_POST["citID"];
    $fechaActualizacion = date("Y-m-d H:i:s");

    // Actualizar la tabla tblestadocita con el comentario y la fecha actualizada
    $sql = "UPDATE tblestadocita SET estMotivoCancelacion = '$comentario', estFechaActualizacionEstado = '$fechaActualizacion' WHERE citID = $citID";
    if ($conn->query($sql) === TRUE) {
        // Éxito en la actualización
        echo "Comentario y fecha actualizados con éxito.";
    } else {
        // Error en la actualización
        echo "Error al actualizar el comentario y la fecha: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita</title>

    <link rel="stylesheet" href="calendstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="stylos.css">
</head>
<body>
<style>
    /* Estilos para el modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 130px;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .modal-content {
        background-color: #fff;
        border-radius: 5px;
        width: 500px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        text-align: center;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover {
        color: #000;
    }

    /* Estilos para el botón "Guardar Comentario" dentro del modal */
    #guardar-comentario-button {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
    }

    #guardar-comentario-button:hover {
        background-color: #0056b3;
    }

    /* Estilos para el historial de citas */
    .forma {
        max-width: 800px;
        margin: 0 auto;
        padding: 30px;
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .forma h1 {
        font-size: 2rem;
        margin-bottom: 20px;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th,
    table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #e1e1e1;
    }

    table th {
        background-color: #f1f1f1;
        font-weight: bold;
        color: #333;
    }

    table td a {
        color: #007bff;
        text-decoration: none;
    }

    table td a:hover {
        text-decoration: underline;
    }

    /* Estilos para los botones */
    button,
    a.button {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover,
    a.button:hover {
        background-color: #0056b3;
    }

    /* Estilos para el enlace con clase "bt1" */
    a.bt1 {
        color: #fff;
        text-decoration: none; /* Elimina el subrayado del enlace */
    }

    #comentario-input {
        height: 150px;
        width: 370px;
    }
</style>

<nav class="sidebar">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="img/Logo.svg" alt="logo">
            </span>

            <div class="text header-text">
                <span class="name">CodingLab</span>
                <span class="profession">Web developer</span>
            </div>
        </div>
        <i class='bx bx-chevron-right toggle'></i>
    </header>

    <div class="menu-bar">
        <div class="menu">
            <li class="search-box">
                <i class='bx bx-search icon'></i>
                <input type="search" placeholder="Search...">
            </li>
            <ul class="menu-links">
                <li class="nav-link">
                    <a href="perfil.php">            
                        <i class='bx bxs-user icon'></i>
                        <span class="text nav-text">Perfil</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="calend.php">
                        <i class='bx bxs-calendar-event icon' ></i>
                        <span class="text nav-text">Agendar Cita</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="Historial.php">
                        <i class='bx bxs-food-menu icon' ></i>
                        <span class="text nav-text">Historias de Citas</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="RegisCar.php">
                        <i class='bx bxs-car-mechanic icon'></i>
                        <span class="text nav-text">Registrar vehiculo</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="bottom-content">
            <li class="">
                <a href="home.php">
                    <i class='bx bx-log-out icon'></i>
                    <span class="text nav-text">Cerrar sesión</span>
                </a>
            </li>
        </div>
    </div>
</nav>

<script src="script.js"></script>

<div class="home">
    <div class="forma">
        <h1>Historial de Citas</h1>

        <?php
        if (isset($_SESSION['id'])) {
            $cliente_id = $_SESSION['id'];

            // Consulta para obtener el historial de citas del cliente con la placa del vehículo
            $sql = "SELECT c.*, ap.carPlacaID 
            FROM tblcita c
            LEFT JOIN tblautopersona ap ON c.autperID = ap.autperID
            LEFT JOIN tblestadocita ec ON c.citID = ec.citID
            WHERE (ap.perID = '$cliente_id' OR c.autperID IS NULL) 
            AND ec.estEstado = 'PENDIENTE'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Placa</th>
                            <th>Servicio</th>
                            <th>Kilometraje</th>
                            <th>Comentario</th>
                            <th>Acciones</th>
                        </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                                <td>" . $row["citFechaCita"] . "</td>
                                <td>" . $row["citHoraCita"] . "</td>";

                    // Comprueba si la clave 'carPlacaID' está definida antes de acceder a ella
                    if (isset($row["carPlacaID"])) {
                        echo "<td>" . $row["carPlacaID"] . "</td>";
                    } else {
                        echo "<td>No disponible</td>";
                    }

                    echo "<td>" . $row["citServicio"] . "</td>
                                <td>" . $row["citKilometraje"] . "</td>
                                <td>" . $row["citMotivo"] . "</td>
                                <td>
                                    <button class='eliminar-button' data-citid='" . $row["citID"] . "'>Cancelar</button>
                                    <div id='comentario-" . $row["citID"] . "' style='display: none;'></div>
                                </td>
                            </tr>";
                }

                echo "</table>";
            } else {
                echo "No se encontraron citas en el historial.";
            }
        } else {
            echo "El usuario no está autenticado o no se proporcionó un ID de cliente.";
        }
        ?>

        <br>
        <button type='button' name='volver' class="bt1" id="volver">
            Volver al Calendario de Citas
        </button>
    </div>
</div>
<input type="hidden" id="fechaActual" name="fechaActual" value="">
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Motivo de cancelacion de cita</h2>
        <input type="comment" id="comentario-input" placeholder="Ingresa el motivo del porque desea cancelar su cita">
        <button id="guardar-comentario-button">Guardar Comentario</button>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.eliminar-button').click(function () {
            var citID = $(this).data('citid');
            $('#myModal').show();
            $('#myModal').data('citid', citID); // Almacenar el citID en el modal
        });

        $('#guardar-comentario-button').click(function () {
            var citID = $('#myModal').data('citid');
            var comentario = $('#comentario-input').val();

            $.ajax({
                type: 'POST',
                url: './controller/eliminar_cita.php',
                data: { citID: citID, eliminar: 1, comentario: comentario },
                success: function (response) {
                    // Actualiza la tabla con los datos recibidos
                    cargarTabla();
                    $('#myModal').hide();
                    location.reload(); // Recarga la página para mostrar los cambios
                }
            });
        });

        // Cerrar el modal al hacer clic en la "X"
        $('.close').click(function () {
            $('#myModal').hide();
        });

        // Función para cargar la tabla actualizada
        function cargarTabla() {
            $.ajax({
                type: 'GET',
                url: 'actualizar_tabla.php', // Crea un archivo actualizar_tabla.php para obtener los datos actualizados
                success: function (data) {
                    // Actualiza la tabla con los datos recibidos
                    $('table').html(data);
                }
            });
        }
    });
    $(document).ready(function () {
    // ... Tu código existente ...

    $('#volver').click(function () {
        window.location.href = 'calend.php'; // Redirigir a la página "calend.php"
    });

    // ... Resto de tu código existente ...
});
    $('#guardar-comentario-button').click(function () {
    var citID = $('#myModal').data('citid');
    var comentario = $('#comentario-input').val();

    // Obtener la fecha actual en JavaScript
    var fechaActual = new Date();
    var fechaFormatted = fechaActual.toISOString().slice(0, 19).replace('T', ' ');

    // Establecer el valor del campo oculto con la fecha actual
    $('#fechaActual').val(fechaFormatted);

    $.ajax({
        type: 'POST',
        url: './controller/cambiar_estado.php',
        data: {
            citID: citID,
            nuevoEstado: 'CANCELADA',
            comentario: comentario,
            fechaActual: $('#fechaActual').val(),
            // Resto de los datos...
        },
        success: function (response) {
            cargarTabla();
            $('#myModal').hide();
            location.reload();
        }
    });
});

</script>
</body>
</html>
