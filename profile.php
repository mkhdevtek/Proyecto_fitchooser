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
    <link rel="stylesheet" href="./css/profile.css">
    <?php
      require_once 'php/conexionbd.php';
      // query para obtener los datos del usuario
      $usr = $_SESSION['usuario'];
      $sql = "SELECT * FROM usuario WHERE correo = '$usr'";
      $result = $conn->query($sql);

      if($result->num_rows > 0){
        $usuario = $result->fetch_assoc();
      }else{
        $usuario = [];
      }

    ?>

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
            <label for="email">Email: <?php 
              // select email from usuario where id = $_SESSION['usuario']
              echo $usuario['correo'];          
            ?> </label>
            <label for="edad">Edad:
            <?php 
              echo $usuario['edad'];
            ?> </label>
        </div>
        <div class="datos">
            <label for="nombre">Nombre:
              <?php 
                echo $usuario['nombre'];
              ?>
               </label>
            <label for="pais">Pais:
              <?php 
                echo $usuario['pais'];
              ?>
            </label>
            <label for="estado">Estado:
              <?php 
                echo $usuario['estado'];
              ?>
            </label>
        </div>
        <div class="datos">
            <label for="localidad">Localidad: 
              <?php 
                echo $usuario['localidad'];
              ?>
            </label>
        </div>
    </div>
    <button id="editar">Editar informacion</button>
    <hr>
    <div class="botones">
      <button id="delete"></a></button>
      <h2>Prendas agregadas</h2>
      <a href="#popup-upload"><button id="add"></button></a>
    </div>
    <div class="prendas">
        <div class="card">
          <img src="./img/Hodie.jpg" alt="imagen" />
          <h3>Hoddie</h3>
        </div>
        <div class="card">
          <img src="./img/tshirt.jpg" alt="imagen" />
          <h3>Camiseta</h3>
        </div>
        <div class="card">
          <img src="./img/Jeans.jpg" alt="imagen" />
          <h3>Pantalon</h3>
        </div>
        <div class="card">
          <img src="./img/gorra.jpg" alt="imagen" />
          <h3>Gorra</h3>
        </div>
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
    <!-- Modal para editar perfil -->
    <div id="edit-profile-modal" class="modal">
      <div class="popup-inner edit-modal-content">
        <a href="#" class="close-button">X</a>
        <h2>Editar Perfil</h2>
        <form id="edit-profile-form">
          <div class="form-container">
            <div class="form-field">
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" required>
            </div>
            <div class="form-field">
              <label for="edad">Edad:</label>
              <input type="number" id="edad" name="edad" required>
            </div>
            <div class="form-field">
              <label for="telefono">Teléfono:</label>
              <input type="tel" id="telefono" name="telefono" required>
            </div>
            <div class="form-field">
              <label for="nombre">Nombre:</label>
              <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-field">
              <label for="pais">País:</label>
              <input type="text" id="pais" name="pais" required>
            </div>
            <div class="form-field">
              <label for="estado">Estado:</label>
              <input type="text" id="estado" name="estado" required>
            </div>
            <div class="form-field">
              <label for="localidad">Localidad:</label>
              <input type="text" id="localidad" name="localidad" required>
            </div>
            <div class="form-buttons">
              <button type="button" class="cancel-button">Cancelar</button>
              <button type="submit" class="submit-button">Guardar</button>
            </div>
          </div>  
        </form>
      </div>
    </div>
    <footer>
        <p>Fit Chooser 2021 ©</p>
    </footer>
    <script src="./js/script-profile.js"></script>
    <script src="./js/script-editar.js"></script>
</body>
</html>
