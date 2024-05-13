<?php
session_start();
include 'conexionbd.php';

// Redireccionar si el usuario no está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: ./index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se cargó un archivo
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK && $_FILES['image']['size'] > 0) {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $temporada = $_POST['temporada'];
        $categoria = $_POST['categoria'];
        $color = $_POST['color'];
        $imagePath = $_FILES['image']['tmp_name'];
        $imageContent = addslashes(file_get_contents($imagePath));

        // Obtener el ID del usuario a partir del correo guardado en la sesión
        $sql = "SELECT id FROM usuario WHERE correo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_SESSION['usuario']);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($row = $result->fetch_assoc()) {
            $userId = $row['id'];

            // Insertar la prenda en la base de datos
            $sql = "INSERT INTO ropa (nombre, descripcion, color, id_usuario, temporada, categoria, fotoropa) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssb", $nombre, $descripcion, $color, $userId, $temporada, $categoria, $imageContent);
            $stmt->execute();
            $stmt->close();

            if ($conn->affected_rows > 0) {
                // Redireccionar al dashboard
                header("Location: ../dashboard.php");
            } else {
                echo "Error al guardar la prenda.";
            }
        } else {
            echo "No se encontró el usuario.";
        }
    } else {
        echo "Error al cargar el archivo. Asegúrate de seleccionar un archivo válido.";
    }
}
?>
