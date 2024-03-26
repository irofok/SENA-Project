<?php

        //  include('./database/conection.php');
        //  include('./controller/controlador_login.php')
        include('./controller/contollerLogin.php');
?>

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
    <title>Document</title>
</head>
<body>
<script>
    function redirectToHome() {
        window.location.href = './home.php';
    }

    function redirectToLogin() {
    window.location.href = './Login.php';
}

// Redirige al usuario a la página de registro
function redirectToRegistro() {
    window.location.href = './nvformulario.php';
}
</script>

<!-- navbar -->


    
<header class=" bg-slate-500">
        <nav class=" px-8 p-4 flex justify-between items-center">
            <div >
                <a href="./home.php" class="flex items-center">
                    <img src="img/Logo.svg" alt="Logo" class="w-40"> 
                </a>
            </div>
                <div class=" font-bold justify-items-center">
                <ul class="flex items-center space-x-4">
                <!-- <ul class="flex items-center space-x-4"> -->
                    </ul>
            </div>
                <div class="font-bold">
                    <ul class="flex items-center space-x-4">
                    <li  class=""><button onclick="redirectToLogin()" class="bg-primary-200 px-5 py-2 rounded-md font-lexend text-sm  hover:bg-second-600 active:bg-second-500">Iniciar Sesion</button></li>
                    <li><button  onclick="redirectToRegistro()" class="bg-third-500 px-6 py-2 rounded-md font-lexend text-sm hover:bg-second-600 active:bg-second-500">Registrarse</button></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- login -->
<form action="Login.php" method="POST">
    <div class="flex w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800 lg:max-w-4xl">
        <div class="hidden bg-cover lg:block lg:w-1/2" id="mundo">
          <img src="./img/img 1.jpg" alt="">
        </div>
    
        <div class="w-full px-6 py-8 md:px-8 lg:w-1/2 flex items-center justify-center ">
          <div class="items-center justify-center">
            <div class="flex justify-center mx-auto">
                <img class="w-auto h-7 sm:h-8" src="./img/Logo.svg" alt="">
            </div>
    
            <p class="mt-3 text-xl text-center text-gray-600 dark:text-gray-200">
                Bienvenido!
            </p>
    
            <!-- <a href="#" class="flex items-center justify-center mt-4 text-gray-600 transition-colors duration-300 transform border rounded-lg dark:border-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <div class="px-4 py-2">
                    <svg class="w-6 h-6" viewBox="0 0 40 40">
                        <path d="M36.3425 16.7358H35V16.6667H20V23.3333H29.4192C28.045 27.2142 24.3525 30 20 30C14.4775 30 10 25.5225 10 20C10 14.4775 14.4775 9.99999 20 9.99999C22.5492 9.99999 24.8683 10.9617 26.6342 12.5325L31.3483 7.81833C28.3717 5.04416 24.39 3.33333 20 3.33333C10.7958 3.33333 3.33335 10.7958 3.33335 20C3.33335 29.2042 10.7958 36.6667 20 36.6667C29.2042 36.6667 36.6667 29.2042 36.6667 20C36.6667 18.8825 36.5517 17.7917 36.3425 16.7358Z" fill="#FFC107" />
                        <path d="M5.25497 12.2425L10.7308 16.2583C12.2125 12.59 15.8008 9.99999 20 9.99999C22.5491 9.99999 24.8683 10.9617 26.6341 12.5325L31.3483 7.81833C28.3716 5.04416 24.39 3.33333 20 3.33333C13.5983 3.33333 8.04663 6.94749 5.25497 12.2425Z" fill="#FF3D00" />
                        <path d="M20 36.6667C24.305 36.6667 28.2167 35.0192 31.1742 32.34L26.0159 27.975C24.3425 29.2425 22.2625 30 20 30C15.665 30 11.9842 27.2359 10.5975 23.3784L5.16254 27.5659C7.92087 32.9634 13.5225 36.6667 20 36.6667Z" fill="#4CAF50" />
                        <path d="M36.3425 16.7358H35V16.6667H20V23.3333H29.4192C28.7592 25.1975 27.56 26.805 26.0133 27.9758C26.0142 27.975 26.015 27.975 26.0158 27.9742L31.1742 32.3392C30.8092 32.6708 36.6667 28.3333 36.6667 20C36.6667 18.8825 36.5517 17.7917 36.3425 16.7358Z" fill="#1976D2" />
                    </svg>
                </div>
                <span class="w-5/6 px-4 py-3 font-bold text-center">Sign in with Google</span>
            </a>
     -->
            <div class="flex items-center justify-between mt-4">
                <span class="w-1/5 border-b dark:border-gray-600 lg:w-1/4"></span>
    
                <a href="#" class="text-xs text-center text-gray-500 uppercase dark:text-gray-400 hover:underline">Ingresar con usuario</a>
    
                <span class="w-1/5 border-b dark:border-gray-400 lg:w-1/4"></span>
            </div>
    
            <div class="mt-4">
                <label class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200" for="LoggingEmailAddress">Nombre de Usuario</label>
                <input id="LoggingEmailAddress" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300" name="username" type="text" />
            </div>
            <div id="mensajeError" style="color: red;"><?php echo $mensajeError; ?></div>
            <div class="mt-4">
                <div class="flex justify-between">
                    <label class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200" for="loggingPassword">Contraseña</label>
                    <a href="#" class="text-xs text-gray-500 dark:text-gray-300 hover:underline">Olvide contraseña?</a>
                </div>
                <input id="loggingPassword" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300" placeholder="contraseña" name="password" type="password" />
            </div>
    
            <div class="mt-6">
                <button class="w-full px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-gray-800 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-50" name="btningresar">
                    Ingresar
                </button>
            </div>
    
            <div class="flex items-center justify-between mt-4">
                <span class="w-1/5 border-b dark:border-gray-600 md:w-1/4"></span>
    
                <!-- <a href="#" class="text-xs text-gray-500 uppercase dark:text-gray-400 hover:underline">or sign up</a> -->
    
                <span class="w-1/5 border-b dark:border-gray-600 md:w-1/4"></span>
            </div>
          </div>
        </div>
    </div>
</form>
<!--
  Heads up! 👋

  Plugins:
    - @tailwindcss/forms
-->

<script>
        // Esta función muestra el mensaje de error
        function mostrarError() {
            document.getElementById("mensajeError").style.display = "block";
        }

        // Esta función oculta el mensaje de error
        function ocultarError() {
            document.getElementById("mensajeError").style.display = "none";
        }

        // Llama a la función para mostrar u ocultar el mensaje de error según sea necesario
        <?php if (!empty($mensajeError)) : ?>
        mostrarError();
        <?php else : ?>
        ocultarError();
        <?php endif; ?>
    </script>

</body>
</html>