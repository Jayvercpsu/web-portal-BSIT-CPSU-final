<?php
session_start();
include("includes/config.php");

// Clear all session variables
$_SESSION = [];

// Destroy the session
session_unset();
session_destroy();

// Redirect to login page
echo '<script language="javascript">document.location = "../login.php";</script>';
exit; // Ensure no further script execution
