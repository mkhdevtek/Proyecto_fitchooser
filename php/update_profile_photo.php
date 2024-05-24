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
$sql_usuario = "SELECT id FROM usuario WHERE correo = ?";
$stmt_usuario = $conn->prepare($sql_usuario);
$stmt_usuario->bind_param("s", $correo_usuario);
$stmt_usuario->execute();
$resultado_usuario = $stmt_usuario->get_result();
$fila_usuario = $resultado_usuario->fetch_assoc();
$id_usuario = $fila_usuario['id'];

// Procesar la carga de la imagen de perfil
if (isset($_FILES['new-photo']) && $_FILES['new-photo']['error'] == 0) {
    $archivoTemp = $_FILES['new-photo']['tmp_name'];
    $fotousu = file_get_contents($archivoTemp);
} else {
    die("Error al cargar la imagen.");
}

// Prepara la consulta SQL para actualizar la foto de perfil
$sql = "UPDATE usuario SET fotousu = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("bi", $null, $id_usuario);
$null = NULL; // Esto es necesario para vincular datos BLOB
$stmt->send_long_data(0, $fotousu); // Enviar el contenido binario del archivo

// Ejecuta la consulta
if ($stmt->execute()) {
    echo "Foto de perfil actualizada correctamente.";
} else {
    echo "Error al actualizar la foto de perfil: " . $stmt->error;
}

// Cierra la conexión
$stmt->close();
$stmt_usuario->close();
$conn->close();
?>
