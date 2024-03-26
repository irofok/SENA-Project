
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./output.css">
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Chivo:ital,wght@0,100;1,300&family=Lexend:wght@100;200;300;400;500;800;900&family=Poppins:wght@900&display=swap" rel="stylesheet">    
    <link rel="stylesheet" href="estilonvformu.css">
</head>
<body class="bg-third-400">
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
  <!-- BARRA DENAVEGACION -->
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

  <!-- BARRA DE NAVEGACION -->

<div class="container">
    <div class="tittle"> Registro Usuarios</div>
    <form action="#" method="post">
        <div class="user-details">

            <div class="input-box">
                <span calss="details"> Primer Nombre</span>
                <input type="text" name="nombre" placeholder="Ingrese su nombre" required>
            </div>

            <div class="input-box">
                <span calss="details"> Segundo Nombre</span>
                <input type="text" name="nombre2" placeholder="Ingrese su nombre">
            </div>

            <div class="input-box">
                <span calss="details"> Primer Apellido</span>
                <input type="text" name="apellidos" placeholder="Ingrese su apellido" required>
            </div>

            <div class="input-box">
                <span calss="details"> Segundo Apellido </span>
                <input type="text" name="apellidos2" placeholder="Ingrese su apellido" >
            </div>

            <div class="input-box">   
        <select   class="form-select" aria-label="Default select example" name="cedula[]" required>
                <b><option >Seleccione su tipo de documento </option> </b>
                <option value="1"  >Cedula de ciudadania </option>
                <option value="2" >Cedula de extranjeria </option>
                <option value="3">Pasaporte</option>
              </select>
              </div>
              
            <div class="input-box">
                <span calss="details"> Numero de identificacion </span>
                <input type="text" name="Identificacion"  placeholder="Ingrese el numero" required>
            </div>
            <div class="input-box">
                <span calss="details"> Correo</span>
                <input type="email" name="correo" placeholder="Ingrese su correo" required>
            </div>

            <div class="input-box">
                <span calss="details"> Telefono</span>
                <input type="number" name="telefono"  placeholder="Ingrese su numero" required>
            </div>

            <div class="input-box">
                <span calss="details"> Direccion</span>
                <input type="text" name="direccion" placeholder="Ingrese su direccion" required>
            </div>

          
            <div class="input-box">
                <span calss="details"> Nombre de usuario</span>
                <input type="text" name="usuario" placeholder="Ingrese su usuario" required>
            </div>

            <div class="input-box">
                <span calss="details"> Contraseña</span>
                <input type="password" name="contraseña" placeholder="Ingrese su contraseña" required>
            </div>

            
            <div class="input-box">
                <span calss="details"> Confirmar Contraseña</span>
                <input type="password" placeholder="Confirme su contraseña" required>
        
                <input type="submit" value="Registrar" class="forms_submit_siguiente">
             
            </div>
        </div>
    </form>
</div>
</div>
<?php
 include("RegistrarUSU.php");
?> 
</body>
</html>