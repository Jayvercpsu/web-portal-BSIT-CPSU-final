<?php
session_start();
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    $id = intval($_GET['id']); // Get student ID from URL

    // Delete student record
    $query = mysqli_query($con, "DELETE FROM tblstudents WHERE id='$id'");

    if ($query) {
        echo "<script>alert('Student ID deleted successfully!');</script>";
        echo "<script>window.location.href='manage-student-id.php';</script>";
    } else {
        echo "<script>alert('Error deleting student ID.');</script>";
        echo "<script>window.location.href='manage-student-id.php';</script>";
    }
}
?>
