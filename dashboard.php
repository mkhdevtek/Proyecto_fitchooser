<?php
session_start();
// Incluir el archivo de conexión a la base de datos
include 'php/conexionbd.php';

// Redireccionar si el usuario no está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: ./index.html");
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

// Obtener las prendas del usuario por tipo de ropa
$sql_prendas = "SELECT * FROM ropa WHERE id_usuario = ? AND id_tipo_ropa = ?";

// Hoddies
$stmt_prendas = $conn->prepare($sql_prendas);
$tipo_hoddie = 1;
$stmt_prendas->bind_param("ii", $id_usuario, $tipo_hoddie);
$stmt_prendas->execute();
$resultado_prendas = $stmt_prendas->get_result();
$hoddies = $resultado_prendas->fetch_all(MYSQLI_ASSOC);

// Camisas
$tipo_camisas = 2;
$stmt_prendas->bind_param("ii", $id_usuario, $tipo_camisas);
$stmt_prendas->execute();
$resultado_prendas = $stmt_prendas->get_result();
$camisas = $resultado_prendas->fetch_all(MYSQLI_ASSOC);

// Pantalones
$tipo_pantalones = 3;
$stmt_prendas->bind_param("ii", $id_usuario, $tipo_pantalones);
$stmt_prendas->execute();
$resultado_prendas = $stmt_prendas->get_result();
$pantalones = $resultado_prendas->fetch_all(MYSQLI_ASSOC);

// Gorras
$tipo_gorras = 4;
$stmt_prendas->bind_param("ii", $id_usuario, $tipo_gorras);
$stmt_prendas->execute();
$resultado_prendas = $stmt_prendas->get_result();
$gorras = $resultado_prendas->fetch_all(MYSQLI_ASSOC);

$stmt_prendas->close();
$stmt_usuario->close();
$conn->close();
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
      <div>
        <a href="php/logout.php" style="text-decoration: none; color: white; background-color: red; padding: 10px 20px; border-radius: 5px; font-size: 16px;">Cerrar Sesión</a>
      </div>
    </header>

    <div class="filter">
      <a href="#popup-filter" style="text-decoration: none"><h3>Filtra</h3> </a>
    </div>

    <div id="popup-filter" class="modal">
      <div class="popup-inner">
        <div class="popup-form">
          <h2>Selecciona tu estilo</h2>
          <form action="dashboard.php">
            <input type="checkbox" name="hoddies" id="hoddies" />
            <label for="hoddies">Modo Guerra</label>
            <input type="checkbox" name="camisas" id="camisas" />
            <label for="camisas">Modo Setso</label>
            <input type="checkbox" name="pantalon" id="pantalon" />
            <label for="pantalon">Modo Agresivo</label>
            <input type="checkbox" name="gorra" id="gorra" />
            <label for="gorra">Modo Muerte</label>
            <input
              type="submit"
              name="filter-button"
              id="filter-button"
              value="Filtrar"
            />
          </form>
        </div>
        <a href="#" class="close">X</a>
      </div>
    </div>

    <section>
      <nav>
        <ul>
          <li>
            <a href="#" class="icon gen" ></a>
          </li>
          <li><a href="#popup-upload" class="icon add"></a></li>
          <li>
            <a href="profile.php" class="icon user"></a>
          </li>
        </ul>
      </nav>
        <article>
            <div class="card hoddies">
                <?php if (!empty($hoddies)): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($hoddies[0]['fotoropa']); ?>" alt="Hoddie" />
                    <h3><?php echo $hoddies[0]['nombre']; ?></h3>
                <?php else: ?>
                    <p>No hay hoddies registradas</p>
                <?php endif; ?>
            </div>
            <div class="card camisas">
                <?php if (!empty($camisas)): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($camisas[0]['fotoropa']); ?>" alt="Camisa" />
                    <h3><?php echo $camisas[0]['nombre']; ?></h3>
                <?php else: ?>
                    <p>No hay camisas registradas</p>
                <?php endif; ?>
            </div>
            <div class="card pantalon">
                <?php if (!empty($pantalones)): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($pantalones[0]['fotoropa']); ?>" alt="Pantalón" />
                    <h3><?php echo $pantalones[0]['nombre']; ?></h3>
                <?php else: ?>
                    <p>No hay pantalones registrados</p>
                <?php endif; ?>
            </div>
            <div class="card gorra">
                <?php if (!empty($gorras)): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($gorras[0]['fotoropa']); ?>" alt="Gorra" />
                    <h3><?php echo $gorras[0]['nombre']; ?></h3>
                <?php else: ?>
                    <p>No hay gorras registradas</p>
                <?php endif; ?>
            </div>
        </article>
    </section>
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
                    <input type="file" name="file-upload" id="file-upload" accept="image/*" multiple class="upload-input">
                    <div class="upload-instructions">
                        <p>Arrastra la foto a este recuadro</p>
                    </div>
                    <label for="file-upload" class="upload-button">Subir Foto</label>
            </div>
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
                    <input type="text" id="descripcion" name="descripcion" placeholder="Descripción de la prenda">
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
    <script src="./js/prendaAlt.js"></script>
  </body>
</html>
