<?php
session_start();
include 'conexionbd.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    http_response_code(401); // Unauthorized
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

// Obtener una prenda aleatoria de cada tipo para el usuario
$sql_prendas = "SELECT * FROM ropa WHERE id_usuario = ? AND id_tipo_ropa = ? ORDER BY RAND() LIMIT 1";

// Hoddie
$stmt_prendas = $conn->prepare($sql_prendas);
$tipo_hoddie = 1;
$stmt_prendas->bind_param("ii", $id_usuario, $tipo_hoddie);
$stmt_prendas->execute();
$resultado_prendas = $stmt_prendas->get_result();
$hoddie = $resultado_prendas->fetch_assoc();

// Camisa
$tipo_camisas = 2;
$stmt_prendas->bind_param("ii", $id_usuario, $tipo_camisas);
$stmt_prendas->execute();
$resultado_prendas = $stmt_prendas->get_result();
$camisa = $resultado_prendas->fetch_assoc();

// Pantalón
$tipo_pantalones = 3;
$stmt_prendas->bind_param("ii", $id_usuario, $tipo_pantalones);
$stmt_prendas->execute();
$resultado_prendas = $stmt_prendas->get_result();
$pantalon = $resultado_prendas->fetch_assoc();

// Gorra
$tipo_gorras = 4;
$stmt_prendas->bind_param("ii", $id_usuario, $tipo_gorras);
$stmt_prendas->execute();
$resultado_prendas = $stmt_prendas->get_result();
$gorra = $resultado_prendas->fetch_assoc();

$stmt_prendas->close();
$stmt_usuario->close();
$conn->close();

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode(array(
    'hoddie' => $hoddie,
    'camisa' => $camisa,
    'pantalon' => $pantalon,
    'gorra' => $gorra
));