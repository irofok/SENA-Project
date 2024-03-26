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
                        <a href="historial.php">
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
</body>
</html>