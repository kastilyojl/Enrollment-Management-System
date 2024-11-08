<?php
// Start session
session_start();

// Unset all session variables
unset($_SESSION['fname']);
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or any other desired page
header("Location: index.php");
exit;
?>
