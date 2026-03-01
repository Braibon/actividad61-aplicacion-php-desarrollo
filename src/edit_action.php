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
    <title>Acción Modificación - NBA CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column" style="min-height: 100vh;">
<div>
    <header class="bg-primary text-white text-center py-3 shadow-sm">
        <h1>APLICACION CRUD PHP 2º ASIR</h1>
    </header>

    <main class="container mt-4 flex-grow-1">

<?php
/*Se comprueba si se ha llegado a esta página PHP a través del formulario de edición.*/



//echo $_POST['modifica'].'<br>';
if(isset($_POST['modifica'])) {
    
    /*Se obtienen los datos del jugador (identificador, nombre, equipo, dorsal y edad) a partir del formulario de edición por el método POST.*/
    
    $identificador = $mysqli->real_escape_string($_POST['identificador']);
    $nombre = $mysqli->real_escape_string($_POST['Nombre']);
    $equipo = $mysqli->real_escape_string($_POST['Equipo']);
    $dorsal = $mysqli->real_escape_string($_POST['Dorsal']);
    $edad = $mysqli->real_escape_string($_POST['Edad']);
    
    /*Con mysqli_real_escape_string protege caracteres especiales en una cadena para ser usada en una sentencia SQL.*/
   

    //Se comprueba si existen campos del formulario vacios
    if(empty($nombre) || empty($equipo) || empty($dorsal) || empty($edad)) 
    {
        echo "<div class='alert alert-danger'>";
        if(empty($nombre)) { echo "<div>Campo Nombre vacío.</div>"; }
        if(empty($equipo)) { echo "<div>Campo Equipo vacío.</div>"; }
        if(empty($dorsal)) { echo "<div>Campo Dorsal vacío.</div>"; }
        if(empty($edad)) { echo "<div>Campo Edad vacío.</div>"; }
        echo "</div>";

        $mysqli->close();
        echo "<a href='javascript:self.history.back();' class='btn btn-secondary'>Volver atras</a>";
    } //fin si
    else //Se realiza la modificación de un registro de la BD.
    {
        //Se actualiza el registro a modificar: update
        //No actualizamos 'cod_jugador' porque es un campo bloqueado (UNIQUE) que no debe cambiar.
        $sql="UPDATE jugadores_NBA SET Nombre = '$nombre', Equipo = '$equipo', Dorsal = '$dorsal', Edad = '$edad' WHERE jugadores_NBA_id = '$identificador'";
        
        //echo 'SQL: ' . $sql . '<br>';
        $result = $mysqli->query($sql);
        
        //Se cierra la conexión
        $mysqli->close();
        
        echo "<div class='alert alert-success'>Jugador editado correctamente en la base de datos.</div>";
        echo "<a href='home.php' class='btn btn-primary'>Ver resultado</a>";
        
        //Se redirige a la página principal: home.php 
        //header("Location: home.php");
    } // fin sino
} //fin si
?>

    </main>
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p>Created by the IES Miguel Herrero team &copy; 2026</p>
    </footer>
</div>
</body>
</html>