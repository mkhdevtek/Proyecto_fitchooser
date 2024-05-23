<?php

session_start();
include 'conexionbd.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ./index.html");
    exit();
}
// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $correo = $_SESSION['usuario'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $edad = $_POST['edad'];
    $pais = $_POST['pais'];
    $estado = $_POST['estado'];
    $localidad = $_POST['localidad'];

    // Preparar consulta SQL para actualizar datos
    $sql = "UPDATE usuario SET nombre=?, apellidos=?, edad=?, pais=?, estado=?, localidad=? WHERE correo=?";
    $stmt = $pdo->prepare($sql);

    // Ejecutar consulta
    if ($stmt->execute([$nombre, $apellidos, $edad, $pais, $estado, $localidad, $correo])) {
        // Datos actualizados correctamente, redireccionar a profile.php
        header("Location: ../profile.php");
        exit();
    } else {
        echo "<p>Error al actualizar los datos.</p>";
    }
}
?>