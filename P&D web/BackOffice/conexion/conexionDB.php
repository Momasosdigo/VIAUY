<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "viauy";


// Crear una nueva conexión a la base de datos
$conexion= new mysqli($servername, $username, $password, $dbname);
$conexion->set_charset('utf8');

// Verificar si hay errores de conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>