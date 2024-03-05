<?php
session_start(); // Inicia o reanuda una sesión

// Si la variable de sesión 'usuario' no está configurada, redirige a la página de inicio de sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

require_once 'funciones.php'; // Incluye el archivo de funciones

// Inicializa una variable de mensaje
$mensaje = '';

// Verifica si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recupera el tipo de operación (crear, actualizar, eliminar) de los datos del formulario
    $operacion = $_POST['operacion'] ?? '';

    // Recupera los detalles del usuario de los datos del formulario
    $usuario = $_POST['usuario'] ?? '';
    $pwd = $_POST['pwd'] ?? '';
    $email = $_POST['email'] ?? '';
    $id = $_POST['id'] ?? ''; // Usado para operaciones de actualizar y eliminar

    // Maneja la operación basándose en el tipo
    switch ($operacion) {
        case 'alta': // Operación de creación
            altaUsuario($usuario, $pwd, $email);
            $mensaje = "Usuario creado con éxito."; // "Usuario creado exitosamente."
            break;
        case 'modificar': // Operación de actualización
            modificarUsuario($id, $usuario, $pwd, $email);
            $mensaje = "Usuario modificado con éxito."; // "Usuario modificado exitosamente."
            break;
        case 'eliminar': // Operación de eliminación
            eliminarUsuario($id);
            $mensaje = "Usuario eliminado con éxito."; // "Usuario eliminado exitosamente."
            break;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel de Administración</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        form input {
            margin-bottom: 10px;
        }
        .message {
            text-align: center;
            color: green;
            margin-bottom: 20px;
        }
        .error {
            text-align: center;
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Que tal admin <?php echo htmlspecialchars($_SESSION['usuario']); ?>! Un placer verte de nuevo</h1>
        <?php if ($mensaje): ?> <!-- Verifica si hay un mensaje para mostrar -->
            <p class="message"><?php echo htmlspecialchars($mensaje); ?></p> <!-- Muestra el mensaje -->
        <?php endif; ?>

        <!-- Formulario para la creación de usuarios -->
        <h2>Crear usuario</h2>
        <form action="aplicacion.php" method="post">
            <input type="hidden" name="operacion" value="alta">
            User: <input type="text" name="usuario" required><br>
            Password: <input type="password" name="pwd" required><br>
            Email: <input type="email" name="email" required><br>
            <input type="submit" value="Crear usuario">
        </form>

        <!-- Formulario para la modificación de usuarios -->
        <h2>Modificar usuario</h2>
        <form action="aplicacion.php" method="post">
            <input type="hidden" name="operacion" value="modificar">
            User ID: <input type="number" name="id" required><br>
            New User: <input type="text" name="usuario"><br>
            New Password: <input type="password" name="pwd"><br>
            New Email: <input type="email" name="email"><br>
            <input type="submit" value="Modificar usuario">
        </form>

        <!-- Formulario para la eliminación de usuarios -->
        <h2>Eliminar usuario</h2>
        <form action="aplicacion.php" method="post">
            <input type="hidden" name="operacion" value="eliminar">
            User ID: <input type="number" name="id" required><br>
            <input type="submit" value="Eliminar usuario">
        </form>

        <!-- Enlace para cerrar sesión -->
        <p style="text-align: center;"><a href="cerrarsesion.php">Cerrar sesión</a></p>
    </div>
</body>
</html>

