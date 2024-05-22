<?php
session_start(); // Iniciar la sesión al principio del script
include 'conexionbd.php';  // Incluye el archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $edad = $_POST['edad'];
    $pais = $_POST['pais'];
    $estado = $_POST['estado'];
    $localidad = $_POST['localidad'];

    // Recuperar el correo de la sesión, asumiendo que el usuario ya está logueado
    $correo = $_SESSION['usuario'];

    // Preparar la sentencia SQL para actualizar los datos
    try {
        $stmt = $pdo->prepare("UPDATE usuario SET nombre = ?, apellidos = ?, edad = ?, pais = ?, estado = ?, localidad = ? WHERE correo = ?");
        $stmt->execute([$nombre, $apellidos, $edad, $pais, $estado, $localidad, $correo]);

        header("Location: ../dashboard.php");  // Redirige al dashboard
        exit;
    } catch (PDOException $e) {
        die("Error al actualizar los datos del usuario: " . $e->getMessage());
    }
}
?>
