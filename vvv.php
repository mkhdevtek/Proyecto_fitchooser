<?php
include 'php/conexionbd.php'; // Incluir el archivo de conexión

// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $id = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $edad = $_POST['edad'];
    $pais = $_POST['pais'];
    $estado = $_POST['estado'];
    $localidad = $_POST['localidad'];

    // Preparar consulta SQL para actualizar datos
    $sql = "UPDATE usuario SET nombre=?, apellidos=?, edad=?, pais=?, estado=?, localidad=? WHERE id=?";
    $stmt = $pdo->prepare($sql);

    // Ejecutar consulta
    if ($stmt->execute([$nombre, $apellidos, $edad, $pais, $estado, $localidad, $id])) {
        echo "<p>Datos actualizados correctamente.</p>";
    } else {
        echo "<p>Error al actualizar los datos.</p>";
    }
}

// Obtener lista de usuarios
$stmt = $pdo->prepare("SELECT id, nombre, apellidos FROM usuario");
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Usuario</title>
</head>
<body>
<h1>Actualizar Usuario</h1>
<form action="" method="post">
    <label for="usuario">Selecciona un usuario:</label>
    <select name="usuario" id="usuario" required>
        <?php foreach ($usuarios as $usuario): ?>
            <option value="<?php echo $usuario['id']; ?>"><?php echo $usuario['nombre'] . ' ' . $usuario['apellidos']; ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>
    <br><br>
    <label for="apellidos">Apellidos:</label>
    <input type="text" id="apellidos" name="apellidos" required>
    <br><br>
    <label for="edad">Edad:</label>
    <input type="text" id="edad" name="edad" required>
    <br><br>
    <label for="pais">País:</label>
    <input type="text" id="pais" name="pais" required>
    <br><br>
    <label for="estado">Estado:</label>
    <input type="text" id="estado" name="estado" required>
    <br><br>
    <label for="localidad">Localidad:</label>
    <input type="text" id="localidad" name="localidad" required>
    <br><br>
    <input type="submit" value="Actualizar Datos">
</form>
</body>
</html>
