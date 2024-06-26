<?php
session_start(); // Iniciar la sesión al principio del script

// Incluir el archivo de conexión a la base de datos
include 'conexionbd.php';

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];

    // Consulta para comprobar las credenciales
    $sql = "SELECT * FROM Usuario WHERE correo = ? AND contrasena = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $correo, $contrasena);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Inicio de sesión exitoso
        $_SESSION['usuario'] = $correo; // Guardar el correo en la sesión
        header("Location: ../dashboard.php"); // Redirigir al dashboard
        exit();
    } else {
        // Credenciales incorrectas
        echo "Correo electrónico o contraseña incorrectos.";
    }

    $stmt->close();
}
?>
