<?php
session_start();
$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - NBA CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body text-center">
                    <img src="logo.png" alt="Logo NBA" width="100" class="mb-3">
                    <h3 class="card-title mb-4">Iniciar Sesión</h3>
                    
                    <?php if ($error !== ""): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <form action="login_action.php" method="POST">
                        <div class="mb-3">
                            <input type="text" name="usuario_o_correo" class="form-control" placeholder="Usuario o Correo" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="contrasena" class="form-control" placeholder="Contraseña" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success w-100">Entrar</button>
                    </form>
                    <p class="mt-3">¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
                    <p><a href="index.php" class="text-secondary">Volver al Inicio</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>