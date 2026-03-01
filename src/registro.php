<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro-NBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body text-center">
                    <img src="logo.png" alt="Logo NBA" width="100" class="mb-3">
                    <h3 class="card-title mb-4">Registro de Usuario</h3>
                    
                    <form action="registro_action.php" method="POST">
                        <div class="mb-3">
                            <input type="text" name="nombre_usuario" class="form-control" placeholder="Nombre de usuario" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="correo" class="form-control" placeholder="Correo electrónico" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="contrasena" class="form-control" placeholder="Contraseña" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="contrasena2" class="form-control" placeholder="Repite la contraseña" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary w-100">Registrarse</button>
                    </form>
                    <p class="mt-3">¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>