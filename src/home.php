<?php
/*Incluye parámetros de conexión a la base de datos*/
include_once("config.php");

session_start();

// Si el usuario NO ha iniciado sesión, se le redirige a la página de login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Variables para mostrar el saludo (adaptado a los datos que guardamos en nuestra sesión)
$username = $_SESSION['username'] ?? '';
$email = $_SESSION['email'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD PHP - Panel Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Fondo con imagen a pantalla completa */
        body {
            background-image: url('lebronj.jpg') !important;
            background-size: cover !important; 
            background-position: center center !important; 
            background-repeat: no-repeat !important; 
            background-attachment: fixed !important; 
        }
        
        /* Efecto de cristal para que el texto se lea perfectamente sobre la foto */
        .glass-panel {
            background: rgba(255, 255, 255, 0.85); /* Fondo blanco semitransparente */
            backdrop-filter: blur(12px); /* Desenfoca la foto justo detrás del panel */
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3); /* Sombra para que resalte */
        }
    </style>
</head>
<body class="bg-light d-flex flex-column" style="min-height: 100vh;">
<div>
    <header class="text-white text-center py-3 shadow-sm" style="background-color: rgba(13, 110, 253, 0.75);">
        <h1 class="mb-0">Gestión NBA - Antonio Díaz</h1>
    </header>

    <main class="container mt-4 flex-grow-1">
        <div class="d-flex align-items-center mb-3">
            <img src="logo.png" alt="Logo NBA" width="60" class="me-3">
            <div>
                <strong>Bienvenido, <?php echo htmlspecialchars($username); ?></strong><br>
                <span class="text-muted">Email: <?php echo htmlspecialchars($email); ?></span>
            </div>
        </div>

        <p><a href="add.php" class="btn btn-success fw-bold">Alta (Añadir Jugador)</a></p>

        <div class="table-responsive shadow-sm">
            <table class="table table-striped table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Licencia</th>
                        <th>Nombre</th>
                        <th>Equipo</th>
                        <th>Dorsal</th> <th>Edad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
<?php

$sql = "SELECT * FROM jugadores_NBA ORDER BY Nombre";
$resultado = $mysqli->query($sql);

$mysqli->close();

if ($resultado->num_rows > 0) {
    while($fila = $resultado->fetch_array()) {
        echo "<tr>\n";
        echo "<td>" . htmlspecialchars($fila['cod_jugador']) . "</td>\n";
        echo "<td>" . htmlspecialchars($fila['Nombre']) . "</td>\n";
        echo "<td>" . htmlspecialchars($fila['Equipo']) . "</td>\n";
        echo "<td>" . htmlspecialchars($fila['Dorsal']) . "</td>\n";
        echo "<td>" . htmlspecialchars($fila['Edad']) . "</td>\n";
        

        $id_jugador = $fila['jugadores_NBA_id']; 
        
        echo "<td>\n";
        echo "<a href=\"edit.php?identificador=" . $id_jugador . "\" class=\"btn btn-sm btn-warning\">Edición</a> \n";
        echo "<a href=\"delete.php?identificador=" . $id_jugador . "\" onClick=\"return confirm('¿Está segur@ que desea eliminar el jugador/a?');\" class=\"btn btn-sm btn-danger\">Baja</a>\n";
        echo "</td>\n";
        echo "</tr>\n";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>No hay jugadores registrados.</td></tr>\n";
}
?>
                </tbody>
            </table>
        </div>

    <footer class="text-white text-center py-3 mt-auto" style="background-color: rgba(0, 0, 0, 0.5);">
        <p><a href="logout.php" class="text-info text-decoration-none">Cerrar sesión (Sign out) <?php echo htmlspecialchars($username); ?></a></p>
        <p class="mb-0">Creado por Antonio Díaz González | IES MIGUEL HERRERO | 2026</p>
    </footer>
</div>
</body>
</html>