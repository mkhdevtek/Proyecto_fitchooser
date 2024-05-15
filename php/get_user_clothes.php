<?php
session_start();
include 'conexionbd.php';

// Verifica si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    http_response_code(401); // Unauthorized
    exit();
}

// Obtener el correo del usuario desde la sesión
$userEmail = $_SESSION['usuario'];

// Conexión a la base de datos
include 'conexionbd.php';

// Consulta SQL para obtener las prendas del usuario
$sql = "SELECT r.id, r.fotoropa, tr.id AS tipo_ropa
        FROM ropa r
        JOIN usuario u ON r.id_usuario = u.id
        JOIN tipo_ropa tr ON r.id_tipo_ropa = tr.id
        WHERE u.correo = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$resultado = $stmt->get_result();

// Crear un arreglo con los datos de las prendas
$clothes = array();
while ($fila = $resultado->fetch_assoc()) {
    $clothes[] = array(
        'tipo_ropa' => $fila['tipo_ropa'],
        'imagen' => 'data:image/jpeg;base64,' . base64_encode($fila['fotoropa'])
    );
}

// Enviar los datos como una respuesta JSON
header('Content-Type: application/json');
echo json_encode($clothes);

// Cerrar la conexión a la base de datos
$stmt->close();
$conn->close();
?>