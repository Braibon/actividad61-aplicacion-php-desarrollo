<?php
require_once 'config.php';

if (isset($_POST['submit'])) {
    $nombre_usuario = mysqli_real_escape_string($mysqli, $_POST['nombre_usuario']);
    $correo = mysqli_real_escape_string($mysqli, $_POST['correo']);
    $contrasena = $_POST['contrasena'];
    $contrasena2 = $_POST['contrasena2'];

    // 1. Comprobar que las contraseñas coinciden (Requisito del documento)
    if ($contrasena !== $contrasena2) {
        echo "<script>alert('Las contraseñas no coinciden.'); window.location.href='registro.php';</script>";
        exit;
    }

    // 2. Comprobar que el usuario o el correo no existan ya (Requisito del documento)
    $check_query = "SELECT * FROM usuarios WHERE correo='$correo' OR nombre_usuario='$nombre_usuario'";
    $result = mysqli_query($mysqli, $check_query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('El usuario o correo ya existe.'); window.location.href='registro.php';</script>";
        exit;
    }

    // 3. Hashear la contraseña (Requisito de seguridad estricto)
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);

    // 4. Insertar en la BD
    $insert_query = "INSERT INTO usuarios (nombre_usuario, contrasena, correo) VALUES ('$nombre_usuario', '$hash', '$correo')";
    
    if (mysqli_query($mysqli, $insert_query)) {
        echo "<script>alert('Registro exitoso. Ya puedes iniciar sesión.'); window.location.href='login.php';</script>";
    } else {
        echo "Error: " . mysqli_error($mysqli);
    }
}
?>