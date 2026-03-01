<?php
// Incluye parámetros de conexión a la base de datos
include_once("config.php");
session_start();

// Si el usuario ya ha iniciado sesión se le redirige a la página home
if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio - Gestión NBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Fondo con imagen a pantalla completa */
        body {
            background-image: url('Fondo.png') !important;
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
<body class="d-flex flex-column" style="min-height: 100vh;">
    
    <header class="text-white text-center py-3 shadow-sm" style="background-color: rgba(13, 110, 253, 0.75);">
        <h1 class="mb-0">Gestión NBA - Antonio Díaz</h1>
    </header>

    <main class="flex-grow-1 d-flex align-items-center justify-content-center">
        <div class="text-center glass-panel">
            <img src="logo.png" alt="Logo NBA" width="150" class="mb-4">
            <h2 class="display-5 fw-bold text-dark">Administración de jugadores NBA</h2>
            <p class="lead text-muted">Gestión de licencias y estadísticas</p>
            <div class="mt-4">
                <a href="login.php" class="btn btn-primary btn-lg mx-2 fw-bold shadow-sm">Iniciar sesión (Sign in)</a>
                <a href="registro.php" class="btn btn-outline-dark btn-lg mx-2 fw-bold shadow-sm">Registrarse (Sign up)</a>
            </div>
        </div>
    </main>

    <footer class="text-white text-center py-3 mt-auto" style="background-color: rgba(0, 0, 0, 0.5);">
        <p class="mb-0">Creado por Antonio Díaz González | IES MIGUEL HERRERO | 2026</p>
    </footer>
</body>
</html>