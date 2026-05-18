<?php
session_start();

$conexion = mysqli_connect("localhost", "root", "", "academia");

if (isset($_POST['entrar'])) {
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $contrasena = mysqli_real_escape_string($conexion, $_POST['contrasena']);

    $query = mysqli_query($conexion, "SELECT * FROM administradores WHERE usuario = '$usuario' AND contrasena = '$contrasena'");

    if (mysqli_num_rows($query) > 0) {
        $_SESSION['admin_logeado'] = $usuario;
        
        header("Location: nuevo.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="card p-4 shadow-sm" style="max-width: 400px; width: 100%;">
        <h3 class="text-center fw-bold mb-4">Identificarse</h3>

        <?php if(isset($error)): ?>
            <div class="alert alert-danger text-center small"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label">Usuario:</label>
                <input type="text" name="usuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña:</label>
                <input type="password" name="contrasena" class="form-control" required>
            </div>
            <button type="submit" name="entrar" class="btn btn-primary w-100 fw-bold">Iniciar Sesión</button>
        </form>
        
        <div class="text-center mt-3">
            <a href="cursos.php" class="text-muted small">Volver a la web</a>
        </div>
    </div>

</body>
</html>