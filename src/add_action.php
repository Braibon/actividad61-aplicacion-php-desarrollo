<?php
//Incluye fichero con parámetros de conexión a la base de datos
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acción Alta - NBA CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column" style="min-height: 100vh;">
<div>
    <header class="bg-primary text-white text-center py-3 shadow-sm">
        <h1>APLICACION CRUD PHP 2º ASIR</h1>
    </header>
    <main class="container mt-4 flex-grow-1">

<?php
/* Se Comprueba si se ha llegado a esta página PHP a través del formulario de altas.*/

//echo $_POST['inserta'].'<br>';
if(isset($_POST['inserta']))
{
    /*Se obtienen los datos del jugador a partir del formulario de alta
    Se envía a través del body del mensaje HTTP Request. No aparecen en la URL como era el caso del otro método de envío de datos: GET */
    
  
    
    $cod_jugador = $mysqli->real_escape_string($_POST['cod_jugador']);
    $nombre = $mysqli->real_escape_string($_POST['Nombre']);
    $equipo = $mysqli->real_escape_string($_POST['Equipo']);
    $dorsal = $mysqli->real_escape_string($_POST['Dorsal']);
    $edad = $mysqli->real_escape_string($_POST['Edad']);

    
   

    //Se comprueba si algunos campos del formulario están vacíos. Es decir no tienen ningún valor útil
    if(empty($cod_jugador) || empty($nombre) || empty($equipo) || empty($dorsal) || empty($edad)) 
    {
        echo "<div class='alert alert-danger'>";
        if(empty($cod_jugador)) { echo "<div>Campo Licencia vacío.</div>"; }
        if(empty($nombre)) { echo "<div>Campo Nombre vacío.</div>"; }
        if(empty($equipo)) { echo "<div>Campo Equipo vacío.</div>"; }
        if(empty($dorsal)) { echo "<div>Campo Dorsal vacío.</div>"; }
        if(empty($edad)) { echo "<div>Campo Edad vacío.</div>"; }
        echo "</div>";

        //Enlace a la página anterior
        //Se cierra la conexión
        $mysqli->close();
        echo "<a href='javascript:self.history.back();' class='btn btn-secondary'>Volver atras</a>";
    } //fin si
    else //Sino existen campos de formulario vacíos se procede al alta del nuevo registro
    {
        
        $check_sql = "SELECT * FROM jugadores_NBA WHERE cod_jugador = '$cod_jugador'";
        $check_result = $mysqli->query($check_sql);

        if ($check_result->num_rows > 0) {
            // Si ya existe la licencia, mostramos error
            echo "<div class='alert alert-danger'>Error: El código de licencia '$cod_jugador' ya está registrado para otro jugador.</div>";
            $mysqli->close();
            echo "<a href='javascript:self.history.back();' class='btn btn-secondary'>Volver atras</a>";
        } else {
            //Se ejecuta una sentencia SQL. Inserta (da de alta) el nuevo registro: insert.
            $sql="INSERT INTO jugadores_NBA (cod_jugador, Nombre, Equipo, Dorsal, Edad) VALUES ('$cod_jugador', '$nombre', '$equipo', '$dorsal', '$edad')";
            
            //echo 'SQL: ' . $sql . '<br>';
            $result = $mysqli->query($sql);
            
            //Se cierra la conexión
            $mysqli->close();
            
            echo "<div class='alert alert-success'>Jugador añadido correctamente a la base de datos.</div>";
            echo "<a href='home.php' class='btn btn-primary'>Ver resultado</a>";
        }
    } //fin sino
}
?>

    </main>
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p>Created by the IES Miguel Herrero team &copy; 2026</p>
    </footer>
</div>
</body>
</html>