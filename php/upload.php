<?php
session_start();
include 'conexionbd.php';

// Redireccionar si el usuario no está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: ./index.html");
    exit();
}
// Recibe los datos del formulario
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$temporada = $_POST['temporada'];
$categoria = $_POST['categoria'];
$color = $_POST['color'];
$imagen = $_FILES['file-upload']['tmp_name'];
$imagen_contenido = addslashes(file_get_contents($imagen));

// Prepara la consulta SQL
$sql = "INSERT INTO ropa (nombre, descripcion, color, fotoropa, id_categoria) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql); // Utiliza la conexión establecida en conexion.php
$stmt->bind_param("sssss", $nombre, $descripcion, $color, $imagen_contenido, $categoria);

// Ejecuta la consulta
if ($stmt->execute()) {
    echo "Prenda registrada exitosamente";
} else {
    echo "Error al registrar la prenda: " . $stmt->error;
}

// Cierra la conexión
$stmt->close();
$conn->close();
?>