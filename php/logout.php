<?php
session_start();
session_destroy(); // Destruir todas las sesiones
header("Location: ../index.html"); // Redirigir a la página de inicio de sesión
exit();
?>
