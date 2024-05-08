<?php
session_start();
include 'conexionbd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['usuario'])) {
    // Verifica si se cargó un archivo
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK && $_FILES['image']['size'] > 0) {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $temporada = $_POST['temporada'];
        $color = $_POST['color'];
        $imagePath = $_FILES['image']['tmp_name'];
        $imageContent = addslashes(file_get_contents($imagePath));

        // Obtener el ID del usuario a partir del correo guardado en la sesión
        $sql = "SELECT id FROM usuario WHERE correo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_SESSION['usuario']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $userId = $row['id'];

            // Insertar la prenda en la base de datos
            $sql = "INSERT INTO ropa (nombre, descripcion, color, id_usuario, temporada, fotoropa) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssb", $nombre, $descripcion, $color, $userId, $temporada, $imageContent);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                header("Location: ../dashboard.php"); // Redireccionar al dashboard
            } else {
                echo "Error al guardar la prenda.";
            }
            $stmt->close();
        } else {
            echo "No se encontró el usuario.";
        }
    } else {
        echo "Error al cargar el archivo. Asegúrate de seleccionar un archivo válido.";
    }
} else {
    header("Location: login.php"); // Si no hay sesión, redirige al login
}
?>