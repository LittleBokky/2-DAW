<?php
require_once 'Usuario.php'; // Includes the 'Usuario' class, assuming it's defined to manage user data.

// Function to establish a connection to the MySQL database
function conectar()
{
    $servername = '127.0.0.1'; // Database server address
    $dbname = 'tarea4'; // Database name
    $username = 'root'; // Database username
    $password = ''; // Database password

    try {
        // Create a new PDO (PHP Data Object) connection to the MySQL database
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn; // Return the established connection
    } catch (PDOException $e) {
        // If connecting to the database fails, throw an exception with the error message
        throw new Exception("Conexión fallida: " . $e->getMessage());
    }
}

// Function to add a new user to the database
function altaUsuario($usuario, $pwd, $email)
{
    try {
        $conn = conectar(); // Establish database connection
        $pwdHash = password_hash($pwd, PASSWORD_DEFAULT); // Hash the password for security

        // Prepare a SQL statement for inserting user data
        $stmt = $conn->prepare("INSERT INTO usuarios (usuario, pwd, email) VALUES (?, ?, ?)");
        $stmt->execute([$usuario, $pwdHash, $email]); // Execute the statement with the provided parameters

        echo "Nuevo registro creado con éxito"; // "New record created successfully"
    } catch (Exception $e) {
        // If an error occurs during database operation, catch the exception and display the error message
        echo "Error: " . $e->getMessage();
    }
}

// Function to update an existing user's data in the database
function modificarUsuario($id, $usuario, $pwd, $email)
{
    try {
        $conn = conectar(); // Establish database connection
        $pwdHash = password_hash($pwd, PASSWORD_DEFAULT); // Hash the new password

        // Prepare a SQL statement for updating user data
        $stmt = $conn->prepare("UPDATE usuarios SET usuario=?, pwd=?, email=? WHERE id=?");
        $stmt->execute([$usuario, $pwdHash, $email, $id]); // Execute the statement with the provided parameters

        echo "Registro actualizado con éxito"; // "Record updated successfully"
    } catch (Exception $e) {
        // If an error occurs during database operation, catch the exception and display the error message
        echo "Error: " . $e->getMessage();
    }
}

// Function to delete a user from the database
function eliminarUsuario($id)
{
    try {
        $conn = conectar(); // Establish database connection

        // Prepare a SQL statement for deleting a user
        $stmt = $conn->prepare("DELETE FROM usuarios WHERE id=?");
        $stmt->execute([$id]); // Execute the statement with the provided user ID

        echo "Registro eliminado con éxito"; // "Record deleted successfully"
    } catch (Exception $e) {
        // If an error occurs during database operation, catch the exception and display the error message
        echo "Error: " . $e->getMessage();
    }
}
?>
