<?php
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect the user to the login page
header('Location: http://localhost/DISHcover/login.php');
exit; // Make sure to exit after header redirection
?>
