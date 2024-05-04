<?php
// Configuración de la conexión
$servername = "localhost"; // Nombre del servidor (generalmente localhost)
$username = "bigboss"; // Nombre de usuario de la base de datos
$password = "^9KPknWbBqdR4iSd*v"; // Contraseña de la base de datos
$database = "fitchooser"; // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

?>