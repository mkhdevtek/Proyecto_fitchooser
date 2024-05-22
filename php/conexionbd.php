<?php
// Configuración de la conexión
$servername = "localhost";
$username = "bigboss"; // Nombre de usuario de la base de datos
$password = "^9KPknWbBqdR4iSd*v"; // Contraseña de la base de datos
$database = "fitchooser"; // Nombre de la base de datos

// Intentar crear la conexión usando PDO
 try {
     $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //  echo "Conexión PDO exitosa.";
 } catch (PDOException $e) {
    die("Error de conexión PDO: " . $e->getMessage());
 }

// Intentar crear la conexión usando MySQLi
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión MySQLi
if ($conn->connect_error) {
   die("Error en la conexión MySQLi: " . $conn->connect_error);
} else {
    // echo "Conexión MySQLi exitosa.";
}
?>
