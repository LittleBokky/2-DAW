<?php
session_start(); // Starts a new session or resumes the current session. This is necessary to access the session in order to destroy it.

session_destroy(); // Destroys the session data that is stored in the session storage. This effectively logs the user out by removing all session variables.

header("Location: index.php"); // Sends an HTTP header to the client to redirect the browser to 'index.php'. This is the page the user will be taken to after logging out.

exit(); // Terminates the script execution. This ensures that no further code is executed after the logout process is initiated and the redirection header is sent.
?>
