<?php
// Incluye fichero con parámetros de conexión a la base de datos
require_once("config.php");
session_start();

// Se comprueba si se ha llegado a esta página por el botón del formulario
if (isset($_POST['submit'])) {
    
    $usuario_o_correo = mysqli_real_escape_string($mysqli, $_POST['usuario_o_correo']);
    $password = $_POST['contrasena'];

    // Se comprueba si existen campos del formulario vacios
    if (empty($usuario_o_correo) || empty($password)) {
        $_SESSION['login_error'] = 'Completa el usuario y la contraseña';
        header("Location: login.php");
        exit();
    } else {
        // Se ejecuta una sentencia SQL adaptada a tu tabla 'usuarios'
        $sql = "SELECT usuario_id, nombre_usuario, correo, contrasena FROM usuarios WHERE correo = '$usuario_o_correo' OR nombre_usuario = '$usuario_o_correo'";
        $resultado = $mysqli->query($sql);

        // Si no encuentra el usuario
        if ($resultado->num_rows === 0) {
            $_SESSION['login_error'] = 'Usuario incorrecto';
            header("Location: login.php");
            exit();
        } else {
            // Obtiene el registro del usuario
            $fila = $resultado->fetch_assoc();

            // Comprobación OBLIGATORIA con password_verify (Requisito Tarea 3)
            if (!password_verify($password, $fila['contrasena'])) {
                $_SESSION['login_error'] = 'Contraseña incorrecta';
                header("Location: login.php");
                exit();
            } else {
                // Datos correctos: Se crean las variables de sesión
                $_SESSION['usuario_id'] = $fila['usuario_id'];
                $_SESSION['username'] = $fila['nombre_usuario'];
                $_SESSION['email'] = $fila['correo'];

                // Redirige al panel de control
                header("Location: home.php");
                exit();
            }
        }
    }
    // Se cierra la conexión
    $mysqli->close();
}
?>