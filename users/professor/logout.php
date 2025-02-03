<?php
session_start();
include("includes/config.php");

// Clear all session variables
$_SESSION = [];

// Destroy the session
session_unset();
session_destroy();

// Redirect to login page
header("Location: ../login.php");
exit;
?>
