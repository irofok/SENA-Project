


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <style>
        /* Agrega estilos para la clase "active" */
        .active {
            background-color: #FF8129; /* Cambia el color de fondo al seleccionar un enlace */
            color: white; /* Cambia el color del texto al seleccionar un enlace */
        }
          /* Agrega estilos para la clase "active" cuando se usa la clase "bg-gray-100" */
          .active.bg-gray-100 {
            background-color: #E5E7EB; /* Cambia el color de fondo al seleccionar un enlace con la clase "bg-gray-100" */
        }
    </style>
</head>
<body>
      
    
   <aside class="bg-gray-800 text-white w-64 min-h-screen flex flex-col p-4">
    
        <div class="flex flex-col items-center mt-6 -mx-2">
            <img class="object-cover w-24 h-24 mx-2 rounded-full" src="./img/admin.png" alt="avatar">
            <h4 class="mx-2 mt-2 font-medium text-white dark:text-gray-200">Administrador        </h4>
            <p class="mx-2 mt-1 text-sm font-medium text-white dark:text-gray-400">john@example.com</p>
        </div>
    
        <div class="flex flex-col justify-between flex-1 mt-6">
            <nav>
                <a class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700" href="#dashboard"  data-container="dashboard-container">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 11H5M19 11C20.1046 11 21 11.8954 21 13V19C21 20.1046 20.1046 21 19 21H5C3.89543 21 3 20.1046 3 19V13C3 11.8954 3.89543 11 5 11M19 11V9C19 7.89543 18.1046 7 17 7M5 11V9C5 7.89543 5.89543 7 7 7M7 7V5C7 3.89543 7.89543 3 9 3H15C16.1046 3 17 3.89543 17 5V7M7 7H17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
    
                    <span class="mx-4 font-medium">Dashboard</span>
                </a>
    
                <a class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700" href="admin_panel.php?container=personas-container" data-container="personas-container">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
    
                    <span class="mx-4 font-medium">Personas</span>
                </a>

                <a class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700" href="#" data-container="autos-container">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="m20.772 10.155-1.368-4.104A2.995 2.995 0 0 0 16.559 4H7.441a2.995 2.995 0 0 0-2.845 2.051l-1.368 4.104A2 2 0 0 0 2 12v5c0 .738.404 1.376 1 1.723V21a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-2h12v2a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-2.277A1.99 1.99 0 0 0 22 17v-5a2 2 0 0 0-1.228-1.845zM7.441 6h9.117c.431 0 .813.274.949.684L18.613 10H5.387l1.105-3.316A1 1 0 0 1 7.441 6zM5.5 16a1.5 1.5 0 1 1 .001-3.001A1.5 1.5 0 0 1 5.5 16zm13 0a1.5 1.5 0 1 1 .001-3.001A1.5 1.5 0 0 1 18.5 16z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
    
                    <span class="mx-4 font-medium">Autos</span>
                </a>
    
    
                <a class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700" href="#" data-container="citas-container">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z            " stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
    
                    <span class="mx-4 font-medium">Citas</span>
                </a>
    
                <a class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700 " href="#"  data-container="estado-citas-container">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
    
                    <span class="mx-4 font-medium">Estado Cita</span>
                </a>

            
            </nav>
        </div>
    </aside>
    <script>
        // // Agrega un evento de clic a todos los enlaces del sidebar
        // const sidebarLinks = document.querySelectorAll('a[data-container]');
        // sidebarLinks.forEach(link => {
        //     link.addEventListener('click', function (e) {
        //         e.preventDefault(); // Evitar que se cargue la página
        //         const containerId = this.getAttribute('data-container');
        //         const containers = document.querySelectorAll('.content-container');
        //         containers.forEach(container => {
        //             container.style.display = 'none'; // Ocultar todos los contenedores
        //         });
        //         const targetContainer = document.getElementById(containerId);
        //         if (targetContainer) {
        //             targetContainer.style.display = 'block'; // Mostrar el contenedor objetivo
         // Agrega un evento de clic a todos los enlaces del sidebar
     // Agrega un evento de clic a todos los enlaces del sidebar
     const sidebarLinks = document.querySelectorAll('a[data-container]');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault(); // Evitar que se cargue la página

                // Elimina la clase "active" de todos los enlaces
                sidebarLinks.forEach(otherLink => {
                    otherLink.classList.remove('active', 'bg-gray-100'); // Elimina ambas clases
                });

                // Agrega la clase "active" al enlace actual
                this.classList.add('active');

                // Verifica si el enlace actual tiene la clase "bg-gray-100"
                if (this.classList.contains('bg-gray-100')) {
                    this.classList.add('bg-gray-100'); // Agrega la clase "bg-gray-100"
                }

                const containerId = this.getAttribute('data-container');
                const containers = document.querySelectorAll('.content-container');
                containers.forEach(container => {
                    container.style.display = 'none'; // Ocultar todos los contenedores
                });
                const targetContainer = document.getElementById(containerId);
                if (targetContainer) {
                    targetContainer.style.display = 'block'; // Mostrar el contenedor objetivo
                }
            });
        });

              // Activa el enlace "Dashboard" por defecto al cargar la página
              const dashboardLink = document.querySelector('a[data-container="dashboard-container"]');
        if (dashboardLink) {
            dashboardLink.click();
        }
    </script>
</body>
</html>