<?php
session_start();
include 'conexionbd.php';

// Redireccionar si el usuario no está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: ./index.html");
    exit();
}

// Obtener el id del usuario a partir del correo almacenado en la sesión
$correo_usuario = $_SESSION['usuario'];
$sql_usuario = "SELECT id FROM Usuario WHERE correo = ?";
$stmt_usuario = $conn->prepare($sql_usuario);
$stmt_usuario->bind_param("s", $correo_usuario);
$stmt_usuario->execute();
$resultado_usuario = $stmt_usuario->get_result();
$fila_usuario = $resultado_usuario->fetch_assoc();
$id_usuario = $fila_usuario['id'];

// Recibe los datos del formulario
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$temporada = $_POST['temporada'];
$categoria = $_POST['categoria'];
$color = $_POST['color'];

// Procesar la carga de la imagen
if (isset($_FILES['file-upload']) && $_FILES['file-upload']['error'] == 0) {
    $archivoTemp = $_FILES['file-upload']['tmp_name'];
    $fotoropa = file_get_contents($archivoTemp);
} else {
    die("Error al cargar la imagen.");
}

// Prepara la consulta SQL para insertar la prenda
$sql = "INSERT INTO ropa (nombre, descripcion, color, fotoropa, id_categoria, id_tipo_ropa, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $nombre, $descripcion, $color, $fotoropa, $categoria, $temporada, $id_usuario);

// Ejecuta la consulta
if ($stmt->execute()) {
    echo "Prenda registrada exitosamente";
} else {
    echo "Error al registrar la prenda: " . $stmt->error;
}

// Cierra la conexión
$stmt->close();
$stmt_usuario->close();
$conn->close();
?>