<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ./index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitChooser</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=IM+Fell+English+SC&family=Imperial+Script&display=swap"
      rel="stylesheet"/>
    <link rel="stylesheet" href="/css/profile.css">
</head>
<body>
    <header>
        <div class="logo">
          <img src="img/logo.png" alt="Logo" />
          <a href="./dashboard.php" style="text-decoration: none"
            ><h1>Fit Chooser</h1></a
          >
        </div>
        <h2>Stay Cool</h2>
    </header>
    <div class="perfil">
        <div class="foto">
            <img src="img/user_black.png" alt="Profile" />
        </div>
        <div class="datos">
            <label for="email">Email: </label>
            <label for="edad">Edad:</label>
            <label for="telefono">Telefono:</label>
        </div>
        <div class="datos">
            <label for="nombre">Nombre: </label>
            <label for="pais">Pais:</label>
            <label for="estado">Estado:</label>
        </div>
        <div class="datos">
            <label for="localidad">Localidad: </label>
        </div>
    </div>
    <button id="editar">Editar informacion</button>
    <hr>
    <div class="botones">
      <button id="delete"></button>
      <h2>Prendas agregadas</h2>
      <button id="add"></button>
    </div>
    <div class="prendas">
        <div class="card">
          <img src="img/Hodie.jpg" alt="imagen" />
          <h3>Hoddie</h3>
        </div>
        <div class="card">
          <img src="img/tshirt.jpg" alt="imagen" />
          <h3>Camiseta</h3>
        </div>
        <div class="card">
          <img src="img/Jeans.jpg" alt="imagen" />
          <h3>Pantalon</h3>
        </div>
        <div class="card">
          <img src="img/gorra.jpg" alt="imagen" />
          <h3>Gorra</h3>
        </div>
    </div>
    <footer>
        <p>Fit Chooser 2021 ©</p>
    </footer>
</body>
</html>
