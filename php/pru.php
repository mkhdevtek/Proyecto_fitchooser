<?php
include 'conexionbd.php';  // Incluye el archivo de conexión a la base de datos

// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $color = $_POST['color'];
    $id_usuario = $_POST['id_usuario'];
    $id_tipo_ropa = $_POST['id_tipo_ropa'];
    $id_categoria = $_POST['id_categoria'];

    // Procesar la carga de la imagen
    if (isset($_FILES['fotoropa']) && $_FILES['fotoropa']['error'] == 0) {
        $archivoTemp = $_FILES['fotoropa']['tmp_name'];
        $fotoropa = file_get_contents($archivoTemp);
    } else {
        die("Error al cargar la imagen.");
    }

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO ropa (nombre, descripcion, color, id_usuario, id_tipo_ropa, id_categoria, fotoropa) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Preparar y ejecutar la consulta
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $descripcion, $color, $id_usuario, $id_tipo_ropa, $id_categoria, $fotoropa]);

    echo "Ropa registrada correctamente.";
}
?>

