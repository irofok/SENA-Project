
<?php

        //  include('./database/conection.php');
        //  include('./controller/controlador_login.php')
        include('./controller/agendarCita.php');
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
  <h1>Agendar Cita</h1>
    <form  class="contenedor" method="POST" >
        <div class="forms_grupo">
            <label for="tipo_servicio" class="forms_label">Tipo de servicio:</label>
            <div class="select-container">
              <select id="tipo_servicio" name="tipo_servicio" required>
                <option value="Mantenimiento"></option>
                <option value="Mantenimiento">Mantenimiento</option>
                <option value="Mantenimiento Correctivo">Mantenimiento Preventivo</option>
                <option value="Cambio de repuestos">Cambio de repuestos</option>
                <option value="Sistema Eléctrico y Electrónico">Sistema eléctrico</option>
              </select>
            </div>
            <div class="forms_grupo">
            <div class="select-container">
    <label for="placa_vehiculo" class="forms_label">Seleccione la placa de su vehículo:</label>
    <select id="placa_vehiculo" name="placa_vehiculo" required>
        <?php
            session_start();
            if (isset($_SESSION['placas']) && count($_SESSION['placas']) > 0) {
                foreach ($_SESSION['placas'] as $placa) {
                    echo "<option value='$placa'>$placa</option>";
                }
            } else {
                echo "<option value=''>No hay placas disponibles</option>";
            }
        ?>
    </select>
</div>
         <div class="forms_grupo">
             <label for="date" class="forms_label">Fecha:</label>
             <input type="date" id="date" name="date" required>
         </div>
         <div class="forms_grupo">
              <label for="time" class="forms_label">Hora:</label>
              <input type="time" id="time" name="time" required>
          </div>
          <div class="forms_grupo">
             <label for="kilometra" class="forms_label">Kilometraje:</label>
             <input type="number" id="kilometra" name="kilometra" required>
         </div>
          <div class="forms_grupo">
            <label for="comentario"> Prediagnostico: </label>
            <textarea id="comment" name="comment" cols="50" rows="6"> </textarea>
          </div>
          <div class="forms_grupo">
            <button class="botton" type="submit" id="mostrarPopup"> Agendar</button>
          </div>
    </form>

</div>

<div class="container">

    <div class="popup-overlay" id="exitoPopup">
        <div class="popup-content">
          <h2>¡Cita agendada exitosamente!</h2>
        </div>
    </div>
      
</div>
</div>
</div>
</body>
</html>
