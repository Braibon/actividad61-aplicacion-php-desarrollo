<?php
// Recogemos las credenciales que pasamos a través del Dockerfile y docker-compose.yml

$databaseHost = getenv('DB_HOST') ?: 'db';
$databaseName = getenv('DB_NAME') ?: 'db_NBA'; 
$databaseUsername = getenv('DB_USER') ?: 'usuarioAnDi';
$databasePassword = getenv('DB_PASS') ?: 'AntonioDiaz@2005';

try {
    // Intentamos conectar
    $mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
} catch (Exception $e) {
    // Si falla, en lugar de un Error 500, mostramos el mensaje exacto del fallo
    die("<div style='margin:20px; padding:20px; background:#ffdddd; color:red; border:1px solid red; font-family:sans-serif;'>
            <strong>¡Error de conexión!</strong><br> " . $e->getMessage() . "
         </div>");
}
?>