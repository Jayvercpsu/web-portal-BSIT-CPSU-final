<?php
session_start();
include('includes/config.php');

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $subject_id = mysqli_real_escape_string($con, $_GET['id']);

    // SQL query to delete the subject
    $query = "DELETE FROM subjects WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $subject_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Subject deleted successfully!";
    } else {
        $_SESSION['message'] = "Failed to delete subject.";
    }

    $stmt->close();
    $con->close();

    header("Location: add-subject.php"); // Redirect to the main page
    exit();
}
?>
