<?php
session_start();
// Destruimos todas las variables de sesión
session_destroy();
// Redirigimos a la página de inicio
header("Location: index.php");
exit;
?>