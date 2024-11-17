<?php
session_start(); // Start the session to access session variables

// Destroy the session to log out the user
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Redirect to login page after logout
header("Location: ../login.php");
exit();
