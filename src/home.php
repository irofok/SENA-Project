<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./output.css">
    <link rel="stylesheet" href="./input.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Chivo:ital,wght@0,100;1,300&family=Lexend:wght@100;200;300;400;500;800;900&family=Poppins:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-... (hash)" crossorigin="anonymous">
    <title>TJEK HOME</title>
</head>
<body class="bg-third-400">

    <!-- navbar -->

    <header class=" bg-slate-500">
        <nav class=" px-8 p-4 flex justify-between items-center">
            <div >
                <a href="#home" class="flex items-center">
                    <img src="img/Logo.svg" alt="Logo" class="w-40"> 
                </a>
            </div>
                <div class=" font-bold justify-items-center">
                <ul class="flex items-center space-x-4">
                <!-- <ul class="flex items-center space-x-4"> -->
                    <!-- <li class="text-lg"><a href="inicio"></a>Inicio</li>
                    <li class="text-lg"><a href="nosotros"></a>Nosotros</li>
                    <li class="text-lg"><a href="servicios"></a>Servicios</li>
                    <li class="text-lg"><a href="contacto"></a>Contacto</li>  -->
                    </ul>
                    <script>
                        // Redirige al usuario a la página de inicio de sesión
function redirectToLogin() {
    window.location.href = './Login.php';
}

// Redirige al usuario a la página de registro
function redirectToRegistro() {
    window.location.href = './nvformulario.php';
}

                    </script>
            </div>
                <div class="font-bold">
                    <ul class="flex items-center space-x-4">
                    <li  class=""><button onclick="redirectToLogin()" class="bg-primary-200 px-5 py-2 rounded-md font-lexend text-sm  hover:bg-second-600 active:bg-second-500">Iniciar Sesion</button></li>
                    <li><button  onclick="redirectToRegistro()" class="bg-third-500 px-6 py-2 rounded-md font-lexend text-sm hover:bg-second-600 active:bg-second-500">Registrarse</button></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- home section -->

    <main class="bg-primary-700" id="hero">
        <section id="inicio" class="relative">
          
            <div class="container mx-auto p-6 py-20">
                <div class="flex flex-col items-center z-20 md:flex-row">
                    <div class="text-center mb-12 md:text-left md:w-1/2 md:pr-10">
                        <h1 class="text-3xl md:text-4xl font-bold leading-snug mb-4 text-white">Potencia la Longevidad de tu Vehículo</h1>
                        <p class="leading-relaxed mb-10 text-white">Cuida de tu inversión y maximiza la durabilidad de tu automóvil. En nuestro taller mecánico, ofrecemos servicios de calidad que mantendrán tu vehículo en óptimas condiciones, desde mantenimientos preventivos hasta reparaciones especializadas.</p>
                        <a href="Login.php"><button  class="btn font-bold" id="citaButton">Agendar cita</button></a>
                    </div>
                        <div id="image" class=" opacity-80 overflow-hidden blur-none hover:blur-sm rounded-md shadow-2xl shadow-third-600" >
                            <img src="./img/img 2.jpg" alt="" width="1000" height="">
                        </div>
                </div>
            </div>
        </section>
    </main>
    
    

    <!-- nosotros -->
    
    <main>
        <section id="nosotros"  class="bg-slate-400">
            <div class="container mx-auto p-6 py-20">
                <div class="text-center m-auto mb-20 md:w-1/2">
                    <h4 class="font-chivo text-2xl text-black mb-4">Nuestra familia</h4>
                    <h1 class="tittle">Tu Vehículo, Nuestra Responsabilidad</h1>
                </div>
                <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-12 lg:gap-8 px-4 sm:px-6 lg:px-8">
                    <!-- card no 1 -->
                    <div class="border-2 border-solid border-third-900 text-center py-20 px-5 rounded-2xl cursor-pointer hover:bg-black ease-in duration-200  hover:text-white">
                        <div class="bg-orange-600 inline-block rounded-2xl py-5 px-6">
                            <i class="fa-solid fa-calendar-days text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-bold py-4">Agenda de Citas en Línea</h3>
                        <p class="leading-relaxed">Simplificamos el proceso de programar tus visitas al taller con nuestra plataforma de citas en línea. Ahorra tiempo y planifica con facilidad.</p>
                    </div>
                    <!-- card no 2 -->
                    <div class="border-2 border-solid border-third-900 text-center py-20 px-5 rounded-2xl cursor-pointer hover:bg-black ease-in duration-200  hover:text-white">
                        <div class="bg-orange-600 inline-block rounded-2xl py-5 px-6">
                            <i class="fa-solid fa-chart-column text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-bold py-4">Rendimiento del Taller</h3>
                        <p class="leading-relaxed">Nuestra plataforma de análisis de rendimiento está diseñada para potenciar la eficiencia operativa del taller.</p>
                    </div>
                    <!-- card no 3 -->
                    <div class="border-2 border-solid border-third-900 text-center py-20 px-5 rounded-2xl cursor-pointer hover:bg-black ease-in duration-200 hover:text-white">
                        <div class="bg-orange-600 inline-block rounded-2xl py-5 px-6">
                            <i class="fa-solid fa-phone text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-bold py-4">Mantenimiento Preventivo</h3>
                        <p class="leading-relaxed">Mantenemos tu vehículo en su mejor estado a través de inspecciones regulares, cambios de aceite, ajustes de frenos y más.</p>
                    </div>
                </div>
            </div>
        </section>
    </main> 

    <main>
        <section id="servicios" class="bg-gray-200 py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-8">Quiénes Somos</h2>
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 md:pr-8 mb-6 md:mb-0">
                        <img src="./img/nosotros-image.jpg" alt="Nosotros" class="w-full rounded-lg shadow-md">
                    </div>
                    <div class="md:w-1/2">
                        <p class="text-gray-700 mb-4">Somos un equipo apasionado por la excelencia en el servicio automotriz. Con años de experiencia en la industria, nos enorgullece brindar soluciones confiables para el mantenimiento y la reparación de vehículos.</p>
                        <p class="text-gray-700 mb-4">Nuestra misión es asegurarnos de que tu vehículo reciba la atención que se merece. Trabajamos con tecnología de vanguardia y un equipo altamente capacitado para brindarte un servicio excepcional en cada visita.</p>
                        <p class="text-gray-700">Confía en nosotros para mantener tu vehículo en óptimas condiciones y disfrutar de un servicio que supera tus expectativas.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white py-16">
        <section id="contacto">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Información de Contacto -->
                <div class="mb-8 md:mb-0">
                    <h3 class="text-xl font-semibold mb-4">Contacto</h3>
                    <p class="mb-2"><i class="fa-regular fa-envelope"></i> info@example.com</p>
                    <p><i class="fa-regular fa-phone"></i> +123 456 7890</p>
                </div>
    
                <!-- Horario de Atención -->
                <div class="mb-8 md:mb-0">
                    <h3 class="text-xl font-semibold mb-4">Horario</h3>
                    <p class="mb-2">Lunes - Viernes: 8:00 AM - 6:00 PM</p>
                    <p>Sábado: 9:00 AM - 1:00 PM</p>
                </div>
    
                <!-- Redes Sociales -->
                <div class="mb-8 md:mb-0">
                    <h3 class="text-xl font-semibold mb-4">Síguenos</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-white hover:text-primary-500 transition duration-300"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="text-white hover:text-primary-500 transition duration-300"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="text-white hover:text-primary-500 transition duration-300"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
    
                <!-- Formulario de Contacto -->
                <div>
                    <h3 class="text-xl font-semibold mb-4">Escríbenos</h3>
                    <form action="#" method="post">
                        <input type="text" placeholder="Nombre" class="bg-gray-600 text-gray-100 px-4 py-2 rounded-lg mb-2 w-full">
                        <input type="email" placeholder="Correo Electrónico" class="bg-gray-600 text-gray-100 px-4 py-2 rounded-lg mb-2 w-full">
                        <textarea placeholder="Mensaje" class="bg-gray-600 text-gray-100 px-4 py-2 rounded-lg mb-2 w-full"></textarea>
                        <button type="submit" class="bg-primary-500 text-white px-6 py-2 rounded-md hover:bg-primary-600 transition duration-300">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    </footer>
    
</body>
</html>