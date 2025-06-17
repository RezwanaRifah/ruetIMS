<?php
// Destroy all session variables
$_SESSION = [];

// Destroy the session itself
session_destroy();

// Redirect to the login page or home page
header("Location: login.php");
exit;
?>