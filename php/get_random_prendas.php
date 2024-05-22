<?php
session_start();
include 'conexionbd.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    http_response_code(401); // Unauthorized
    exit();
}

$correo_usuario = $_SESSION['usuario'];
$sql_usuario = "SELECT id FROM Usuario WHERE correo = ?";
$stmt_usuario = $conn->prepare($sql_usuario);
$stmt_usuario->bind_param("s", $correo_usuario);
$stmt_usuario->execute();
$resultado_usuario = $stmt_usuario->get_result();
$fila_usuario = $resultado_usuario->fetch_assoc();
$id_usuario = $fila_usuario['id'];

// Obtener una prenda aleatoria de cada tipo para el usuario
function obtenerPrendaAleatoria($conn, $id_usuario, $tipo_prenda) {
    $sql_prendas = "SELECT * FROM ropa WHERE id_usuario = ? AND id_tipo_ropa = ? ORDER BY RAND() LIMIT 1";
    $stmt_prendas = $conn->prepare($sql_prendas);
    $stmt_prendas->bind_param("ii", $id_usuario, $tipo_prenda);
    $stmt_prendas->execute();
    return $stmt_prendas->get_result()->fetch_assoc();
}

// Generar prendas aleatorias
$_SESSION['hoddie'] = obtenerPrendaAleatoria($conn, $id_usuario, 1);
$_SESSION['camisa'] = obtenerPrendaAleatoria($conn, $id_usuario, 2);
$_SESSION['pantalon'] = obtenerPrendaAleatoria($conn, $id_usuario, 3);
$_SESSION['gorra'] = obtenerPrendaAleatoria($conn, $id_usuario, 4);

$stmt_usuario->close();
$conn->close();

// Redirigir de nuevo al dashboard
header("Location: ../dashboard.php");
exit();
?>
