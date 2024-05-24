<?php
session_start();
include 'php/conexionbd.php';
if (!isset($_SESSION['usuario'])) {
    header("Location: ./index.html");
    exit();
}
// Consulta para obtener los datos del usuario usando consultas preparadas
$usr = $_SESSION['usuario'];
$stmt = $conn->prepare("SELECT * FROM usuario WHERE correo = ?");
$stmt->bind_param("s", $usr);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
} else {
    $usuario = [];
}
$stmt->close();

// Consulta para obtener las prendas del usuario
$prendas_stmt = $conn->prepare("SELECT * FROM ropa WHERE id_usuario = ?");
$prendas_stmt->bind_param("i", $usuario['id']);
$prendas_stmt->execute();
$prendas_result = $prendas_stmt->get_result();

$prendas = [];
while ($row = $prendas_result->fetch_assoc()) {
    $prendas[] = $row;
}
$prendas_stmt->close();
$sql = "SELECT nombre, correo, edad, pais, estado, localidad, fotousu FROM usuario WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo_usuario);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

// Cierra el statement
$stmt->close();

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
      require_once './php/conexionbd.php';
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
        <div class="datos">

            <div class="foto">
                <?php
                if (empty($usuario['fotousu'])) {
                    // No hay foto de perfil guardada, muestra imagen predeterminada
                    echo '<img src="img/user_black.png" alt="Profile" />';
                } else {
                    // Hay foto de perfil, mostrarla
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($usuario['fotousu']) . '" alt="Profile" />';
                }
                ?>
                <a href="#change-photo-popup"><button id="edit"></button></a>
            </div>
            <div class="info">
              <label for="email">Email: <?php
                echo $usuario['correo'];
              ?> </label>

              <label for="edad">Edad:
              <?php
                echo $usuario['edad'];
              ?> </label>
              
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
              
              <label for="localidad">Localidad: 
                <?php 
                  echo $usuario['localidad'];
                ?>
              </label>
            </div>
        </div>
        
        <div class="edit-info">
          <button id="editar">Editar informacion</button>
        </div>
      </div>

    
    <div class="botones">
      <button id="delete"></a></button>
      <h2>Prendas agregadas</h2>
      <a href="#popup-upload"><button id="add"></button></a>
    </div>
    <div class="prendas">
        <?php
        $counter = 0;
        foreach ($prendas as $prenda) {
            if ($counter % 4 == 0 && $counter != 0) {
                echo '</div><div class="prendas">'; // Cierra el div anterior y abre uno nuevo
            }
            echo '<div class="card">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($prenda['fotoropa']) . '" alt="imagen" />';
            echo '<h3>' . htmlspecialchars($prenda['nombre']) . '</h3>';
            echo '</div>';
            $counter++;
        }
        ?>
    </div>
    <!-- Popup para cambiar foto de perfil -->
    <div id="change-photo-popup" class="modal">
        <div class="popup-inner">
            <a href="#" class="close-button">X</a>
            <h2>Cambiar foto de perfil</h2>
            <form method="POST" action="php/update_profile_photo.php" enctype="multipart/form-data">
                <div class="form-field">
                    <input type="file" id="new-photo" name="new-photo" accept="image/*">
                </div>
                <div class="form-buttons">
                    <a href="profile.php" class="cancel-button3">Cancelar</a>
                    <button type="submit" class="submit-button3">Guardar cambios</button>
                </div>
            </form>
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
              <!-- Menú desplegable para temporada -->
              <select id="temporada" name="temporada">
                  <option value="1">Hoddie</option>
                  <option value="2">Camisa</option>
                  <option value="3">Pantalon</option>
                  <option value="4">Gorra</option>
              </select>
              <!-- Menú desplegable para categoría -->
              <select id="categoria" name="categoria">
                  <option value="1">Casual</option>
                  <option value="2">Formal</option>
                  <option value="3">Deportiva</option>
                  <option value="4">Business casual</option>
              </select>
              <!-- Menú desplegable para colores -->
              <select id="color" name="color">
                  <option value="azul_marino">Azul marino</option>
                  <option value="gris">Gris</option>
                  <option value="negro">Negro</option>
                  <option value="beige">Beige</option>
                  <option value="caqui">Caqui</option>
                  <option value="blanco">Blanco</option>
                  <option value="azul_celeste">Azul celeste</option>
                  <option value="verde_oliva">Verde oliva</option>
                  <option value="burdeos">Burdeos</option>
                  <option value="marron">Marrón</option>
                  <option value="rojo">Rojo</option>
                  <option value="morado">Morado</option>
              </select>
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
        <p>ha sido agregada con éxito.</p>
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
          <form action="php/updateUsu.php" method="post">
          <div class="form-container">
            <div class="form-field">
              <label for="edad">Edad:</label>
              <input type="number" id="edad" name="edad" value="<?= isset($usuario['edad']) ? $usuario['edad'] : '' ?>" required>
            </div>
            <div class="form-field">
              <label for="nombre">Nombre:</label>
              <input type="text" id="nombre" name="nombre" value="<?= isset($usuario['nombre']) ? $usuario['nombre'] : '' ?>" required>
            </div>
              <div class="form-field">
                  <label for="apellidos">Apellidos:</label>
                  <input type="text" id="apellidos" name="apellidos" value="<?= isset($usuario['apellidos']) ? $usuario['apellidos'] : '' ?>" required>
              </div>
            <div class="form-field">
              <label for="pais">País:</label>
              <input type="text" id="pais" name="pais" value="<?= isset($usuario['pais']) ? $usuario['pais'] : '' ?>" required>
            </div>
            <div class="form-field">
              <label for="estado">Estado:</label>
              <input type="text" id="estado" name="estado" value="<?= isset($usuario['estado']) ? $usuario['estado'] : '' ?>" required>
            </div>
            <div class="form-field">
              <label for="localidad">Localidad:</label>
              <input type="text" id="localidad" name="localidad" value="<?= isset($usuario['localidad']) ? $usuario['localidad'] : '' ?>" required>
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
    <script src="./js/scriptPRO.js"></script>
</body>
</html>
