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
// Si la conexión fue exitosa, puedes realizar operaciones en la base de datos

// Ejemplo de consulta
$sql = "SELECT * FROM Usuario";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar los datos de la consulta
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Nombre: " . $row["nombre"] . "<br>";
    }
} else {
    echo "No se encontraron resultados.";
}

// Cerrar la conexión
$conn->close();
?>