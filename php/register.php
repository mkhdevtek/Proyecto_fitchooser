<?php
include 'conexionbd.php';  // Incluye el archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['usuario'];  // Captura el correo del formulario
    $contrasena = $_POST['contrasena'];  // Captura la contraseña del formulario
    $terms = isset($_POST['terms']);  // Verifica si los términos fueron aceptados

    if (!$terms) {
        echo "Debes aceptar los términos y condiciones para registrarte.";
        exit;
    }

    // Encriptar la contraseña antes de guardarla en la base de datos
    $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO usuario (correo, contrasena) VALUES (:correo, :contrasena)");
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $hashed_password);
        $stmt->execute();
        header("Location: success.html");  // Redirige a la página de éxito
        exit;
    } catch (PDOException $e) {
        die("Error al registrar el usuario: " . $e->getMessage());
    }
} else {
    header("Location: register.html");  // Redirige al formulario si no se accede por POST
    exit;
}
?>
