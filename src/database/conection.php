<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "tjek";

// crear una conexion

$conn = mysqli_connect($servername, $username, $password, $dbname);

//verificar conexion

if ($conn->connect_error) {
    die("Error de conexion: " . $conn->connect_error);
};
