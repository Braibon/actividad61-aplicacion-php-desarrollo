<?php
//Incluye fichero con parámetros de conexión a la base de datos
include("config.php");

session_start();
// Si el usuario no ha iniciado sesión, se le redirige al login (Seguridad añadida)
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bajas - NBA CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column" style="min-height: 100vh;">
<div>
    <header class="bg-primary text-white text-center py-3 shadow-sm">
        <h1>APLICACION CRUD PHP 2º ASIR</h1>
    </header>

    <main class="container mt-4 flex-grow-1">
        <div class="d-flex align-items-center mb-4">
            <img src="logo.png" alt="Logo NBA" width="50" class="me-3">
            <h2>Baja de Jugador</h2>
        </div>

<?php


//Recoge el id del jugador a eliminar a través de la clave identificador del array asociativo $_GET y lo almacena en la variable identificador
$identificador = $_GET['identificador'] ?? '';

if (!empty($identificador)) {
    //Con mysqli_real_escape_string protege caracteres especiales en una cadena para ser usada en una sentencia SQL.
    $identificador = $mysqli->real_escape_string($identificador);

    //Se realiza el borrado del registro: delete.
    $sql="DELETE FROM jugadores_NBA WHERE jugadores_NBA_id = '$identificador'";
    //echo 'SQL: ' . $sql . '<br>';
    $result = $mysqli->query($sql);

    //Se cierra la conexión de base de datos previamente abierta
    $mysqli->close();

    echo "<div class='alert alert-success fw-bold shadow-sm'>Jugador/a borrado correctamente...</div>";
    echo "<a href='home.php' class='btn btn-primary'>Ver resultado</a>";

    //Se redirige a la página principal: home.php
    //header("Location: home.php");
} else {
    // Si alguien intenta acceder sin un ID válido
    echo "<div class='alert alert-danger'>Error: No se ha especificado ningún jugador para eliminar.</div>";
    echo "<a href='home.php' class='btn btn-secondary'>Volver</a>";
}
?>

    </main>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p>Created by the IES Miguel Herrero team &copy; 2026</p>
    </footer>
</div>
</body>
</html>