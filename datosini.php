<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ./index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Fit Chooser</title>
    <link rel="stylesheet" href="css/datosini.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=IM+Fell+English+SC&family=Imperial+Script&display=swap" rel="stylesheet"/>
</head>
<body>
<header>
    <div class="logo">
        <img src="img/logo.png" alt="Logo" />
        <a href="#" style="text-decoration: none"><h1>Fit Chooser</h1></a>
    </div>
    <h2>Stay Cool</h2>
</header>

<section class="login">
    <form action="php/datosiniPHP.php" method="post">
        <div class="form-row"> <!-- Contenedor para las dos columnas -->
            <div class="PARTE1">
                <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
                <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos" required>
                <input type="text" name="edad" id="edad" placeholder="Edad" required>
            </div>
            <div class="PARTE2">
                <input type="text" name="pais" id="pais" placeholder="País" required>
                <input type="text" name="estado" id="estado" placeholder="Estado" required>
                <input type="text" name="localidad" id="localidad" placeholder="Localidad" required>
            </div>
        </div>
        <div class="form-submit"> <!-- Contenedor para el botón -->
            <input type="submit" value="Aceptar">
        </div>
    </form>
</section>

<footer>
    <p>Todos los derechos reservados | TerraPlanistas ©</p>
</footer>
</body>
</html>

