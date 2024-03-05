<?php
session_start(); // Inicia una nueva sesión o reanuda la existente

require_once 'Usuario.php'; // Incluye la clase 'Usuario.php', presumiblemente para manejar operaciones relacionadas con el usuario

// Verifica si ya existe una sesión de usuario, lo que indica que el usuario está conectado
if (isset($_SESSION['usuario'])) {
    header("Location: aplicacion.php"); // Redirige al usuario a la página principal de la aplicación
    exit(); // Detiene la ejecución del script
}

$error = ''; // Inicializa una variable de mensaje de error a una cadena vacía

// Verifica si el formulario se envió usando el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'] ?? ''; // Obtiene el nombre de usuario enviado, con un valor predeterminado de cadena vacía si no está configurado
    $pwd = $_POST['pwd'] ?? ''; // Obtiene la contraseña enviada, con un valor predeterminado de cadena vacía si no está configurada

    $usuarioObj = new Usuario(); // Instancia un nuevo objeto 'Usuario', asumiendo que el constructor maneja la conexión a la base de datos

    // Verifica las credenciales del usuario
    if ($usuarioObj->verificarUsuario($usuario, $pwd)) {
        $_SESSION['usuario'] = $usuario; // Almacena el nombre de usuario en la sesión, marcando al usuario como conectado
        header("Location: aplicacion.php"); // Redirige al usuario conectado a la página principal de la aplicación
        exit(); // Detiene la ejecución del script
    } else {
        $error = 'Usuario o contraseña incorrectos.'; // Establece un mensaje de error si el inicio de sesión falla
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Enlaces a los archivos CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo adicional para centrar el formulario */
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container center-container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title text-center">Login</h5>
            </div>
            <div class="card-body">
                <!-- Formulario de inicio de sesión -->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="usuario">Usuario:</label>
                        <input type="text" class="form-control" id="usuario" name="usuario">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Contraseña:</label>
                        <input type="password" class="form-control" id="pwd" name="pwd">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                </form>
                <!-- Mensaje de error -->
                <?php if ($error): ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Enlaces a los archivos JS de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


