<?php 
include('./DB/conecction.php');



?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./output.css">
    <link rel="stylesheet" href="./input.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Chivo:ital,wght@0,100;1,300&family=Lexend:wght@100;200;300;400;500;800;900&family=Poppins:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-... (hash)" crossorigin="anonymous">
    <title>admin</title>
</head>
<body>
    <div>
        <?php include('./navbar.php') ?>
    </div>
    <div class ="flex"> 
        <?php include('./sidebar.php') ?>
            <div id="dashboard-container" class="content-container flex-grow p-4">
            <?php include('./views/Datos/dashboard.php');?>
            </div>

            <div id="personas-container" class="content-container p-4 hidden">
                <?php include('./views/Personas/viewPersonas.php')  ?>
                <?php
                try {
                    $stmt = $conn->prepare("SELECT * FROM tblpersona");
                    $stmt->execute();
                    $clientes = $stmt->fetchAll();
                } catch (PDOException $e) {
                    echo "Error al recuperar clientes: " . $e->getMessage();
                } ?>

                
            </div>
            

            <div id="autos-container" class="content-container p-4 hidden ">
                <?php include('./views/Autos/viewAutos.php')  ?>
                <?php
                
                ?>
            </div>

            <div id="citas-container" class="content-container p-4  hidden">
                <div >
                <?php include('./views/Citas/viewCitas.php')  ?>
                </div>
            </div>

            <div id="estado-citas-container" class="content-container p-4 hidden" >
                <?php include('./views/Citas/viewCitasStatus.php')  ?>
            </div>
    </div>



    <script>
document.addEventListener("DOMContentLoaded", function () {

 

    const enlacesSidebar = document.querySelectorAll(".sidebar-link");

    enlacesSidebar.forEach(function (enlace) {
        enlace.addEventListener("click", function (event) {
            event.preventDefault(); // Evita que el enlace haga una recarga de la página

            const containerId = this.getAttribute("data-container");
            const container = document.getElementById(containerId);

            // Oculta todos los contenedores de contenido
            document.querySelectorAll(".content-container").forEach(function (content) {
                content.style.display = "none";
            });

            // Muestra el contenedor correspondiente
            container.style.display = "block";

        

             Guardar el ID del contenedor activo en el almacenamiento local
             localStorage.setItem('activeContainer', containerId);

             const activeContainerId = localStorage.getItem('activeContainer');
    if (activeContainerId) {
        const activeContainer = document.getElementById(activeContainerId);
        if (activeContainer) {
            activeContainer.style.display = "block";
        }
    }

        });
    });
});
</script>




</body>
</html>