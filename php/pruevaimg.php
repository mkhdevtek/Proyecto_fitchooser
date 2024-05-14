<!DOCTYPE html>
<html>
<head>
    <title>Detalle de Prenda</title>
</head>
<body>
<?php
// Conexión a la base de datos
include 'conexionbd.php';

// Consulta SQL para obtener un registro de la tabla `ropa`
$sql = "SELECT * FROM ropa LIMIT 1";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    // Obtener los datos de la prenda
    $fila = $resultado->fetch_assoc();
    $id = $fila['id'];
    $nombre = $fila['nombre'];
    $descripcion = $fila['descripcion'];
    $color = $fila['color'];
    $id_usuario = $fila['id_usuario'];
    $id_tipo_ropa = $fila['id_tipo_ropa'];
    $id_categoria = $fila['id_categoria'];
    $fotoropa = $fila['fotoropa'];
    ?>
    <h2>Detalle de Prenda</h2>
    <p>ID: <?php echo $id; ?></p>
    <p>Nombre: <?php echo $nombre; ?></p>
    <p>Descripción: <?php echo $descripcion; ?></p>
    <p>Color: <?php echo $color; ?></p>
    <p>ID Usuario: <?php echo $id_usuario; ?></p>
    <p>ID Tipo de Ropa: <?php echo $id_tipo_ropa; ?></p>
    <p>ID Categoría: <?php echo $id_categoria; ?></p>
    <p>Imagen:</p>
    <img src="data:image/jpeg;base64,<?php echo base64_encode($fotoropa); ?>" alt="Imagen de la Prenda">
    <?php
} else {
    echo "No se encontraron registros en la tabla.";
}

// Cerrar la conexión
$conn->close();
?>
</body>
</html>