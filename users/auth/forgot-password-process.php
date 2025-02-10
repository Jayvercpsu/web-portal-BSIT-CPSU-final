<?php
session_start();
include('../../includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($con, $_POST['email']);

    // Check if email exists
    $query = mysqli_prepare($con, "SELECT id FROM users WHERE email=?");
    mysqli_stmt_bind_param($query, "s", $email);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);

    if ($user = mysqli_fetch_assoc($result)) {
        $_SESSION['reset_email'] = $email;
        echo "success"; // Send response to AJAX
    } else {
        echo "error"; // Send error response
    }
}
?>
