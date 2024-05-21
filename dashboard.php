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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=IM+Fell+English+SC&family=Imperial+Script&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="css/dashboard.css" />
    <title>Dashboard</title>
  </head>
  <body>
    <header>
      <div class="logo">
        <img src="img/logo.png" alt="Logo" />
        <a href="./dashboard.php" style="text-decoration: none"
          ><h1>Fit Chooser</h1></a>
      </div>
      <h2>Stay Cool</h2>
    </header>
<!--
    <div class="filter">
      <a href="php/logout.php" style="text-decoration: none"><img src="../img/cerrar-sesion.png" alt="cerrar sesion"></a>
    </div> -->



    <section>
      <nav>
        <ul>
          <li>
            <a href="#" class="icon gen"></a>
          </li>
          <li><a href="#popup-upload" class="icon add"></a></li>
          <li>
            <a href="profile.php" class="icon user"></a>
          </li>
        </ul>
      </nav>
      <article>
        <div class="card hoddies">
          <img src="img/Hodie.jpg" alt="imagen" />
          <h3>Hoddies</h3>
        </div>
        <div class="card camisas">
          <img src="img/tshirt.jpg" alt="imagen" />
          <h3>Camisas</h3>
        </div>
        <div class="card pantalon">
          <img src="img/Jeans.jpg" alt="imagen" />
          <h3>Pantalon</h3>
        </div>
        <div class="card gorra">
          <img src="img/gorra.jpg" alt="imagen" />
          <h3>Gorra</h3>
        </div>
      </article>
    </section>
    <div class="cerrar-sesion">
      <a href="php/logout.php"><button></button></a>
    </div>
    <!-- Popup Upload Modal -->
    <div id="popup-upload" class="modal">
      <div class="popup-inner upload-modal-content">
        <a href="#" class="close-button">X</a>
        <div class="upload-icon">
          <img src="./img/logo.png" alt="Upload Icon" />
        </div>
        <!-- Recuadro punteado para arrastrar las imágenes -->
        <div class="upload-area">
          <img id="image-preview" style="display:none;" alt="Vista previa de la imagen" />
          <input type="file" name="files" id="file-upload" accept="image/*" multiple class="upload-input">
          <div class="upload-instructions">
            <p>Arrastra la foto a este recuadro</p>
          </div>
        </div>
        <label for="file-upload" class="upload-button">Subir Foto</label> <!-- Movido fuera de upload-area -->
      </div>
    </div>
    <!-- Modal para los detalles de la prenda subida -->
    <div id="details-modal" class="modal">
      <div class="popup-inner details-modal-content">
        <h2>Detalles de la prenda</h2>
        <div class="form-field">
          <div class="imagen-form">
          <img id="detail-image-preview" alt="Vista previa de la prenda" />
          </div>
          <div class="form-detalles">
          <input type="text" id="nombre" name="nombre" placeholder="Nombre de la prenda">
            <input type="text" id="descripcion" name="descripcion" placeholder="Descripcion de la prenda">
          <input type="text" id="temporada" name="temporada" placeholder="Temporada">
          <input type="text" id="color" name="color" placeholder="Color">
          </div>
        </div>
        <div class="form-buttons">
          <button class="cancel-button">Cancelar</button>
          <button class="submit-button">Agregar</button>
        </div>
      </div>
    </div>
    <!-- Modal para confirmación de registro completado -->
    <div id="confirmation-modal" class="modal">
      <div class="popup-inner details-modal-content">
        <h2>Registro completado</h2>
        <p>Tu prenda ha sido agregada con éxito.</p>
        <div class="checkmark-circle">
          <div class="checkmark"></div>
        </div>
        <div class="form-buttons2">
          <button class="close-button2">Cerrar</button>
        </div>
      </div>
    </div>
    <footer>
      <p>Fit Chooser 2021 ©</p>
    </footer>
    <script src="./js/script.js"></script>
  </body>
</html>
