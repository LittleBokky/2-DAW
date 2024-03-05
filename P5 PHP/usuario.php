<?php

class Usuario {
    private $db; // A private property to hold the database connection object.

    public function __construct() {
        // Database connection parameters
        $servername = '127.0.0.1';
        $dbname = 'tarea4';
        $username = 'root';
        $password = '';

        // Constructing the DSN (Data Source Name) string which includes the type of the database (mysql), the host (servername), and the database name (dbname).
        $dsn = "mysql:host=$servername;dbname=$dbname";

        try {
            // Attempting to create a new PDO (PHP Data Object) instance using the DSN, username, and password. The PDO object allows for a secure connection to the database.
            $this->db = new PDO($dsn, $username, $password);
            // Setting the PDO error mode to exception. This means that if an error occurs, it will be thrown as an exception which can be caught and handled.
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // If connecting to the database fails, the script dies (stops executing) and shows an error message.
            die('Conexión fallida: ' . $e->getMessage());
        }
    }

    public function verificarUsuario($usuario, $pwd) {
        try {
            // Prepares an SQL statement to select the password for a user with a specific username. This is a secure way to handle user input and avoid SQL injection.
            $sql = "SELECT pwd FROM usuarios WHERE usuario = :usuario";
            $stmt = $this->db->prepare($sql);
            // Binds the parameter :usuario with the provided username.
            $stmt->bindParam(':usuario', $usuario);
            // Executes the prepared statement.
            $stmt->execute();
            // Fetches the result row from the statement.
            $row = $stmt->fetch();

            // If a row is found, it means the user exists, and then it checks if the provided password matches the hashed password stored in the database.
            if ($row) {
                return password_verify($pwd, $row['pwd']);
            }

            // If no row is found or the password doesn't match, it returns false, indicating the user verification failed.
            return false;
        } catch (PDOException $e) {
            // If an error occurs during the database operation, it is caught here and an error message is displayed.
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
