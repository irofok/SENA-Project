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

if (!isset($_SESSION['username'])) {
    // Si no hay un usuario en la sesión, redirige o muestra un mensaje de error
    header("Location: perfil.php"); // Cambia perfil.php por la página de inicio de sesión
    exit();
}

// Obtén el nombre de usuario de la sesión
$username = $_SESSION['username'];

// Obtén el id de la persona basado en el nombre de usuario
$get_id_query = "SELECT perID FROM tblpersona WHERE perUsuario = '$username'";
$id_result = $conn->query($get_id_query);

if ($id_result->num_rows > 0) {
    $row = $id_result->fetch_assoc();
    $perID = $row["perID"];
} else {
    // Si no se encuentra el id de la persona, muestra un mensaje de error
    echo "El nombre de usuario no existe en tblpersona.";
    exit();
}

$placas = array();
$sql_placas = "SELECT carPlacaID FROM tblautopersona WHERE perID = '$perID'";
$result_placas = $conn->query($sql_placas);
while ($row = $result_placas->fetch_assoc()) {
    $placas[] = $row["carPlacaID"];
}
$_SESSION["placas"] = $placas;

$mensajeError = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los datos del formulario
    $placa = trim($_POST['placa']);
    $marca = $_POST['marca'];
    $linea = trim($_POST['linea']);
    $año = trim($_POST['año']);
    $gasolina = $_POST['gasolina'];
    $carroceria = $_POST['carroceria'];
    $vin = trim($_POST['vin']);

    // Verificar que las opciones seleccionadas sean válidas
    $opciones_validas = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'];
    $opciones_validas_gasolina = ['1', '2', '3', '4', '5'];
    $opciones_validas_carroceria = ['1', '2', '4', '5'];

    if (!in_array($marca, $opciones_validas) || 
        !in_array($gasolina, $opciones_validas_gasolina) ||
        !in_array($carroceria, $opciones_validas_carroceria)) {
        $mensajeError = "Error: Opción no válida seleccionada.";
    } else {
        // Intentar insertar los datos en la tabla tblautos
        try {
            $sql_insert = "INSERT INTO tblautos (carPlacaID, carMarca, carLinea, carModeloAño, carCombustible, carCarroceria, carVin)
                           VALUES ('$placa', '$marca', '$linea', '$año', '$gasolina', '$carroceria', '$vin')";
            $conn->query($sql_insert);

            // Insertar en tblautopersona utilizando el $perID obtenido
            $sql_insert_autopersonas = "INSERT INTO tblautopersona (carplacaID, perID) VALUES ('$placa', '$perID')";
            $conn->query($sql_insert_autopersonas);

            // Mostrar un mensaje emergente de éxito
            echo '<script>alert("Tu registro se ha completado");</script>';
        } catch (mysqli_sql_exception $e) {
            // Mostrar un mensaje emergente de error
            echo '<script>alert("Error: Este vehiculo ya se encuentra registrado.");</script>';
        }
    }
}




// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>     
    <!-- Links -->
    <link rel="stylesheet" href="stylos.css">
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
    <style>
    .titulo-2 {
    font-size:  2rem;
    margin-bottom: .5em;
  }
  
  .forms {
    background-color: #fff;
    width: 100%;
    max-width: 500px;
    padding: 2em 4em;
    border-radius: 10px;
    box-shadow: 0 5px 10px -5px;
    text-align: center;
    position: absolute;
    top: 49%;
    left: 47%;
    transform: translate(-50%, -50%);
  }
  
  .contenedor {
    margin-top: 3em;
    display: grid;
    gap: 2.5em;
  }
  
  .forms_grupo {
    position: relative;
    color:#58657a;
  }
  
  .forms_input {
    width: 100%;
    background: none;
    color: black;
    font-size: 1rem;
    padding: .6em .3em;
    border: none;
    outline: none;
    border-bottom: 1px solid ;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
  }
  
  .forms_input:focus + .forms_label,
  .forms_input:not(:placeholder-shown) + .form_label {
    transform: translateY(3px) scale(.9);
    transform-origin: left top;
    color: black;
  }
  
  .forms_label {
    color: var(--color);
    cursor: pointer;
    position: absolute;
    top: -40px;
    left: 0px;
    transform: translateY(20px);
    transition: transform .5s, color .3s;
  }
  


  .forms_submit_siguien {
  width: 150px;
  background-color: #0056b3;
  color: #ffffff;
  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
  font-weight: 300;
  font-size: 1rem;
  padding: .8em 0;
  border: none;
  border-radius: .5em;
}
    </style>
<body>
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

    <div class="home">

    <script src="script.js"></script>

    <form action="#" method="post">
        <div class="forms">
            <h2 class="titulo-2"> Datos del vehiculo </h2>
            <div class="contenedor ">
                <div class="forms_grupo">
                    <input type="text" name="placa" class="forms_input" placeholder=" " required>
                    <label for="name" class="forms_label"> Placa </label>
                    <span class="forms_line"></span>
                </div>

                <select class="form-select" aria-label="Default select example" name="marca">
                    <option > Marca </option>
                    <option value="1"> Hyundai </option>
                    <option value="2" > Chevrolet </option>
                    <option value="3" > Mazda </option>
                    <option value="4" > Kia </option>
                    <option value="5" > Nissan </option>
                    <option value="6" > Renault </option>
                    <option value="7" > Toyota </option>
                    <option value="8" > Suzuki </option>
                    <option value="9" > Volkswagen </option>
                    <option value="10" > Ford </option>
                </select>

                <div class="forms_grupo">
                    <input type="text" name="linea" class="forms_input" placeholder=" " >
                    <label for="name" class="forms_label"> Linea </label>
                    <span class="forms_line"></span>
                </div>

                <div class="forms_grupo">
                    <input type="text" name="año" class="forms_input" placeholder=" " required>
                    <label for="name" class="forms_label"> Año-Modelo </label>
                    <span class="forms_line"></span>
                </div>

                <select class="form-select" aria-label="Default select example" name="gasolina">
                    <option > Combustible </option>
                    <option value="1"> Gasolina </option>
                    <option value="2" > Diesel </option>
                    <option value="3" > Gas vehicular GNV </option>
                    <option value="4" > Electrico </option>
                    <option value="5" > Hibrido </option>
                </select>

                <select class="form-select" aria-label="Default select example" name="carroceria" >
                    <option > Carroceria </option> 
                    <option value="1"> Sedan </option>
                    <option value="2"> Hatchback </option>
                    <option value="4"> Suv </option>
                    <option value="5"> Pick-up </option>
                </select>

                <div class="forms_grupo">
                    <input type="text" name="vin" class="forms_input" placeholder=" " required>
                    <label for="name" class="forms_label"> Vin </label>
                    <span class="forms_line"></span>
                </div>

                <input type="submit" value="Registrar" class="forms_submit_siguien" >

                <div>
                <?php if (!empty($mensajeError)) : ?>
    <div class="error-message">
        <?php echo $mensajeError; ?>
    </div>
    <?php endif; ?>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>

