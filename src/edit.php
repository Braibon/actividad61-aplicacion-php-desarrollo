<?php
// Incluye parámetros de conexión a la base de datos
include_once("config.php");
session_start();

// Si el usuario no ha iniciado sesión, se le redirige al login
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
    <title>Modificaciones - NBA CRUD</title>
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
            <img src="logo.png" alt="Logo NBA" width="50" class="me-3">
            <h2>Modificación</h2>
        </div>

        <?php
        /*Obtiene el id del registro del jugador a modificar, identificador, a partir de su URL. Este tipo de datos se accede utilizando el método: GET*/

        //Recoge el id del jugador a modificar a través de la clave identificador del array asociativo $_GET y lo almacena en la variable identificador
        $identificador = $_GET['identificador'] ?? '';

        if (empty($identificador)) {
            header("Location: home.php");
            exit();
        }

        //Con mysqli_real_escape_string protege caracteres especiales en una cadena para ser usada en una sentencia SQL.
        $identificador = $mysqli->real_escape_string($identificador);

        //Se selecciona el registro a modificar: select
        $sql = "SELECT * FROM jugadores_NBA WHERE jugadores_NBA_id = '$identificador'";
        //echo 'SQL: ' . $sql . '<br>';
        $resultado = $mysqli->query($sql);

        if ($resultado->num_rows == 0) {
            header("Location: home.php");
            exit();
        }

        //Se extrae el registro y lo guarda en el array $fila
        //Nota: También se puede utilizar el método fetch_assoc de la siguiente manera: $fila = $resultado->fetch_assoc();
        $fila = $resultado->fetch_array();

        // Guardamos el equipo actual para marcarlo en el desplegable
        $equipo_actual = $fila['Equipo'];

        //Se cierra la conexión de base de datos (Igual que hace el profesor)
        $mysqli->close();
        ?>

        <div class="card shadow-sm col-md-8 mx-auto mb-4">
            <div class="card-body">
                <form action="edit_action.php" method="post">
                    
                    <div class="mb-3">
                        <label for="cod_jugador" class="form-label">Licencia / Código</label>
                        <input type="text" name="cod_jugador" id="cod_jugador" class="form-control bg-light" value="<?php echo htmlspecialchars($fila['cod_jugador']); ?>" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="Nombre" class="form-label">Nombre del Jugador</label>
                        <input type="text" name="Nombre" id="Nombre" class="form-control" value="<?php echo htmlspecialchars($fila['Nombre']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="Equipo" class="form-label">Equipo</label>
                        <select name="Equipo" id="Equipo" class="form-select" required>
                            <option value="" disabled selected>Seleccione un equipo</option>
                            <option value="Los Angeles Lakers">Los Angeles Lakers</option>
                            <option value="Golden State Warriors">Golden State Warriors</option>
                            <option value="Boston Celtics">Boston Celtics</option>
                            <option value="Miami Heat">Miami Heat</option>
                            <option value="Chicago Bulls">Chicago Bulls</option>
                            <option value="Dallas Mavericks">Dallas Mavericks</option>
							<option value="Brooklyn Nets">Brooklyn Nets</option>
							<option value="Philadelphia 76ers">Philadelphia 76ers</option>
							<option value="Phoenix Suns">Phoenix Suns</option>
							<option value="Denver Nuggets">Denver Nuggets</option>
							<option value="Milwaukee Bucks">Milwaukee Bucks</option>
							<option value="Atlanta Hawks">Atlanta Hawks</option>
							<option value="Toronto Raptors">Toronto Raptors</option>
							<option value="Portland Trail Blazers">Portland Trail Blazers</option>
							<option value="Utah Jazz">Utah Jazz</option>
							<option value="Cleveland Cavaliers">Cleveland Cavaliers</option>
							<option value="New Orleans Pelicans">New Orleans Pelicans</option>
							<option value="Orlando Magic">Orlando Magic</option>
							<option value="Sacramento Kings">Sacramento Kings</option>
							<option value="Memphis Grizzlies">Memphis Grizzlies</option>
							<option value="Indiana Pacers">Indiana Pacers</option>
							<option value="Washington Wizards">Washington Wizards</option>
							<option value="Charlotte Hornets">Charlotte Hornets</option>
							<option value="Minnesota Timberwolves">Minnesota Timberwolves</option>
							<option value="Oklahoma City Thunder">Oklahoma City Thunder</option>
							<option value="Detroit Pistons">Detroit Pistons</option>
							<option value="New York Knicks">New York Knicks</option>
							<option value="San Antonio Spurs">San Antonio Spurs</option>
							<option value="Los Angeles Clippers">Los Angeles Clippers</option>	
							<option value="Houston Rockets">Houston Rockets</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="Dorsal" class="form-label">Dorsal</label>
                        <input type="number" name="Dorsal" id="Dorsal" class="form-control" value="<?php echo htmlspecialchars($fila['Dorsal']); ?>" min="0" max="99" required>
                    </div>

                    <div class="mb-3">
                        <label for="Edad" class="form-label">Edad</label>
                        <input type="number" name="Edad" id="Edad" class="form-control" value="<?php echo htmlspecialchars($fila['Edad']); ?>" min="18" max="50" required>
                    </div>

                    <div class="mt-4">
                        <input type="hidden" name="identificador" value="<?php echo htmlspecialchars($identificador); ?>">
                        <button type="submit" name="modifica" value="si" class="btn btn-warning fw-bold">Aceptar</button>
                        <button type="button" class="btn btn-secondary" onclick="location.href='home.php'">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer class="text-white text-center py-3 mt-auto" style="background-color: rgba(0, 0, 0, 0.5);">
        <p><a href="home.php" class="text-info text-decoration-none">Volver</a></p>
        <p><a href="logout.php" class="text-info text-decoration-none">Cerrar sesión (Sign out) <?php echo htmlspecialchars($_SESSION['username']); ?></a></p>
        <p class="mb-0">Creado por Antonio Díaz González | IES MIGUEL HERRERO | 2026</p>
    </footer>
</div>
</body>
</html>