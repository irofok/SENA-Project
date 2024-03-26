<?php
error_reporting(0);
ini_set('display_errors', 0);

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

if(isset($_SESSION['username'])){
    $user = $_SESSION['username'];
} else {
    // Si no hay un usuario en la sesión, redirige o muestra un mensaje de error
    header("Location: login.php"); // Cambia login.php por la página de inicio de sesión
    exit();
}

// Función para actualizar los datos del usuario
// Función para actualizar los datos del usuario
function actualizarDatosUsuario($conn, $user) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar_datos'])) {
        // Obtén los datos actualizados del formulario
        $correo_nuevo = $_POST['correo'];
        $telefono_nuevo = $_POST['telefono'];
        $direccion_nueva = $_POST['direccion'];

        // Actualiza los datos del usuario en la base de datos
        $fecha_actualizacion = date('Y-m-d H:i:s'); // Obtiene la fecha y hora actual en el formato de MySQL
        $actualizarDatosSQL = "UPDATE tblpersona SET
            perCorreo = '$correo_nuevo',
            perTelefono = '$telefono_nuevo',
            perDireccion = '$direccion_nueva',
            perActualizacionRegistro = '$fecha_actualizacion'  -- Agrega la fecha de actualización
            WHERE perUsuario = '$user'";

        if ($conn->query($actualizarDatosSQL) === TRUE) {
            // Éxito al actualizar los datos
            echo "<script>alert('Los datos se actualizaron correctamente.');</script>";
        } else {
            // Error al actualizar los datos
            echo "<script>alert('Error al actualizar los datos: " . $conn->error . "');</script>";
        }
    }
}


$sql = "SELECT p.perNumDocumento, p.perPrimerNombre, p.perSegundoNombre, p.perPrimerApellido, p.perSegundoApellido, p.perCorreo, p.perTelefono, p.perDireccion, p.perUsuario, tdoc.docDescripcion
        FROM tblpersona AS p
        INNER JOIN tbltipodocumento AS tdoc ON p.docId = tdoc.docId
        WHERE p.perUsuario = '".$user."'";

$resultado = $conn->query($sql);

while ($data = $resultado->fetch_assoc()) {
    $cedula = $data['perNumDocumento'];
    $nombre1 = $data['perPrimerNombre'];
    $nombre2 = $data['perSegundoNombre'];
    $apell1 = $data['perPrimerApellido'];
    $apell2 = $data['perSegundoApellido'];
    $correo = $data['perCorreo'];
    $telefono = $data['perTelefono'];
    $direc = $data['perDireccion'];
    $usuario = $data['perUsuario'];
    $tipo_documento_nombre = $data['docDescripcion'];
}

$placas = $_SESSION['placas'];

actualizarDatosUsuario($conn, $user);

// Obtener los datos del vehículo seleccionado
$placa_vehiculo = isset($_POST['placa_vehiculo']) ? $_POST['placa_vehiculo'] : '';

if ($placa_vehiculo != '') {
    $sql_vehiculo = "SELECT carMarca, carLinea, carModeloAño, carCombustible, carCarroceria, carVin FROM tblautos WHERE carPlacaID = '".$placa_vehiculo."'";
    $resultado_vehiculo = $conn->query($sql_vehiculo);

    if ($resultado_vehiculo->num_rows > 0) {
        $data_vehiculo = $resultado_vehiculo->fetch_assoc();
        $marca = $data_vehiculo['carMarca'];
        $modelo = $data_vehiculo['carLinea'];
        $Año = $data_vehiculo['carModeloAño'];
        $combustible = $data_vehiculo['carCombustible'];
        $vin = $data_vehiculo['carVin'];

        // Consulta para obtener el nombre de la marca
        $sql_marca = "SELECT marcaNombre FROM tblmarca WHERE marcaID = '".$marca."'";
        $resultado_marca = $conn->query($sql_marca);

        // Consulta para obtener el nombre del combustible
        $sql_combustible = "SELECT combNombre FROM tbltipocombustible WHERE combID = '".$combustible."'";
        $resultado_combustible = $conn->query($sql_combustible);

        // Verifica si se encontraron resultados y obtén los nombres
        $nombre_marca = "";
        $nombre_combustible = "";

        if ($resultado_marca->num_rows > 0) {
            $data_marca = $resultado_marca->fetch_assoc();
            $nombre_marca = $data_marca['marcaNombre'];
        }

        if ($resultado_combustible->num_rows > 0) {
            $data_combustible = $resultado_combustible->fetch_assoc();
            $nombre_combustible = $data_combustible['combNombre'];
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apock web design</title>
    <link rel="stylesheet" type="text/css" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="stylos.css">
 
</head>

<body>
<style>
    /* Estilos generales */
html {
    -webkit-text-size-adjust: 100%;
    -ms-text-size-adjust: 100%;
    text-size-adjust: 100%;
    line-height: 1.4;
}

body {
    color: #404040;
    font-family: "Arial", Segoe UI, Tahoma, sans-serifl, Helvetica Neue, Helvetica;
}

/* Estilos de la sección de perfil del usuario */
.seccion-perfil-usuario {
    display: flex;
    flex-wrap: wrap;
    flex-direction: column;
    align-items: center;
}

.seccion-perfil-usuario .perfil-usuario-portada {
    position: absolute;
    top: 1rem;
    right: 1rem;
    border: 0;
    border-radius: 8px;
    padding: 12px 25px;

    color: #fff;
    cursor: pointer;
}

.seccion-perfil-usuario .perfil-usuario-body {
    width: 70%;
    max-width: 750px;
    margin: 0 auto;
    padding: 20px;
    box-sizing: border-box;
    text-align: center;
    border-radius: 10px;
    margin-bottom: 20px;
}

.seccion-perfil-usuario .perfil-usuario-body h1 {
    font-size: 1.75em;
    margin-bottom: 0.5rem;
}

.seccion-perfil-usuario .perfil-usuario-footer,
.seccion-perfil-usuario .perfil-usuario-foo {
    display: flex;
    flex-wrap: wrap;
    padding: 2.5rem 3rem;
    box-shadow: none;
    background-color: #fff;
    border-radius: 15px;
    width: 100%;
    text-align: left;
    border: none;
}

.seccion-perfil-usuario .perfil-usuario-footer {
    margin-bottom: 20px;
}

.seccion-perfil-usuario .lista-datos {
    width: 50%;
    list-style: none;
}

.seccion-perfil-usuario .lista-datos li {
    padding: 5px 0;
}

.seccion-perfil-usuario .lista-datos li > .icono {
    margin-right: 1rem;
    font-size: 1.2rem;
    vertical-align: middle;
}

.seccion-perfil-usuario .redes-sociales {
    position: absolute;
    right: calc(0px - 50px - 1rem);
    top: 0;
    display: flex;
    flex-direction: column;
}

.seccion-perfil-usuario .redes-sociales .boton-redes {
    border: 0;
    background-color: #fff;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    color: #fff;
    box-shadow: 0 0 12px rgba(0, 0, 0, .2);
    font-size: 1.3rem;
}

.actualizar {
    position: relative;
top: -50px;
left: 100px;
}

/* Estilos responsivos para dispositivos móviles */
@media (max-width: 750px) {
    .seccion-perfil-usuario .perfil-usuario-body {
        width: 95%;
    }

    .seccion-perfil-usuario .perfil-usuario-footer,
    .seccion-perfil-usuario .perfil-usuario-foo {
        width: 100%;
    }
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
    <form action="#" method="post">
    <section class="seccion-perfil-usuario">
        <!-- ... -->

        
        <!-- ... -->
    </section>
</form> 
    <form action="#" method="post">
    <section class="seccion-perfil-usuario">
        <div class="perfil-usuario-header">
            <div class="perfil-usuario-portada">
                <!-- Contenido de la portada -->
            </div>
        </div>
        <div class="perfil-usuario-body">
            <h1>Datos del Usuario</h1>
            <div class="perfil-usuario-footer">
                <form action="#" method="post">
                    <ul class="lista-datos">
                        <li><i class="icono fas fa-id-card"></i> <strong> Tipo de documento:</strong> <?php echo $tipo_documento_nombre; ?></li>
                        <!-- Agrega campos de entrada para los datos del usuario -->
                        <li><i class="icono fas fa-signature"></i> <strong>Primer Nombre:</strong> <?php echo $nombre1; ?></li>
                        <li><i class="icono fas fa-signature"></i> <strong>Primer Apellido:</strong> <?php echo $apell1; ?></li>
                        <li><i class="icono fas fa-envelope"></i> <strong>Correo:</strong> <input type="email" name="correo" value="<?php echo $correo; ?>"></li>
                        <li><i class="icono fas fa-solid fa-road"></i> <strong>Direccion:</strong> <input type="text" name="direccion" value="<?php echo $direc; ?>"></li>
                        <li>
                        <div class="select-container">
                            <label for="placa_vehiculo" class="forms_label">Seleccione la placa de su vehículo:</label>
                            <select id="placa_vehiculo" name="placa_vehiculo" onchange="this.form.submit()">
                                <?php
                                // Verifica si $placa_vehiculo está definida antes de usarla
                                if (isset($placa_vehiculo)) {
                                    echo "<option value='' selected>Elija una placa</option>"; // Opción predeterminada
                                } else {
                                    echo "<option value='' selected disabled hidden>Elija una placa</option>"; // Opción predeterminada oculta
                                }

                                // Aquí generas las opciones del select con las placas disponibles
                                if (isset($_SESSION['placas']) && count($_SESSION['placas']) > 0) {
                                    foreach ($_SESSION['placas'] as $placa) {
                                        echo "<option value='$placa' " . ($placa == $placa_vehiculo ? "selected" : "") . ">$placa</option>";
                                    }
                                } else {
                                    echo "<option value=''>No hay placas disponibles</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" name="actualizar_datos" class="actualizar">Actualizar Datos</button>
                    </li>
                </ul> 
                    <ul class="lista-datos">
                        <li><i class="icono fas  fa-id-card"></i> <strong>Numero:</strong> <?php echo $cedula; ?></li>
                        <!-- Agrega campos de entrada para los datos del usuario -->
                        <li><i class="icono fas fa-signature"></i> <strong>Segundo Nombre:</strong> <?php echo $nombre2; ?></li>
                        <li><i class="icono fas fa-signature"></i> <strong>Segundo Apellido:</strong> <?php echo $apell2; ?></li>
                        <li><i class="icono fas fa-solid fa-phone-volume"></i> <strong>Telefono:</strong> <input type="tel" name="telefono" value="<?php echo $telefono; ?>"></li>
                        <li><i class="icono fas fa-solid fa-user"></i> <strong>Usuario:</strong> <?php echo $usuario; ?></li>
                    </ul>
                   
                </form>
            </div>
        </div>

       
           

        <div class="perfil-usuario-body">
            <h1>Datos del Vehículo</h1>
            <div class="perfil-usuario-foo" id="datosUsuario">
                <ul class="lista-datos">
                    <li><i class="icono fas fa-sharp fa-solid fa-address-card"></i> <strong>Placa:</strong> <span id="placa"><?php echo $placa_vehiculo; ?></span></li>
                    <li><i class="icono fas fa-sharp fa-solid fa-car-side"></i> <strong>Modelo:</strong> <span id="modelo"><?php echo $modelo; ?></span></li>
                    <li><i class="icono fas fa-solid fa-gas-pump"></i><strong>Combustible:</strong> <span id="combustible"><?php echo  $nombre_combustible; ?></span></li>
                </ul>
                <ul class="lista-datos">
                    <li><i class="icono fas fa-sharp fa-solid fa-car-side"></i><strong>Marca:</strong> <span id="marca"><?php echo  $nombre_marca; ?></span></li>
                    <li><i class="icono fas fa-solid fa-calendar"></i><strong>Año:</strong> <span id="Anio"><?php echo $Año; ?></span></li>
                    <li><i class="icono fas fa-solid fa-hashtag"></i> <strong>Vin:</strong> <span id="vin"><?php echo $vin; ?></span></li>
                </ul>
            </div>
        </div>
    </section>
</form>

    <script src="script.js"></script>
</div>
</body>

</html>