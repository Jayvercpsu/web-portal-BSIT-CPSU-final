<?php
session_start();
include('includes/config.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = "Invalid request.";
    header("Location: manage-student-id.php");
    exit();
}

$student_id = intval($_GET['id']);

// Fetch student ID before deletion
$query_student = mysqli_query($con, "SELECT student_id FROM tblstudents WHERE id='$student_id'");
$student = mysqli_fetch_assoc($query_student);

if (!$student) {
    $_SESSION['error'] = "Student not found.";
    header("Location: manage-student-id.php");
    exit();
}

$student_number = $student['student_id']; // Get the student ID (e.g., "20231234")

// Start transaction to ensure atomic operation
mysqli_begin_transaction($con);
try {
    // Delete all related grades
    $delete_grades = mysqli_query($con, "DELETE FROM tblgrades WHERE student_id='$student_number'");

    // Delete student record
    $delete_student = mysqli_query($con, "DELETE FROM tblstudents WHERE id='$student_id'");

    if (!$delete_student) {
        throw new Exception("Error deleting student record.");
    }

    // Commit transaction
    mysqli_commit($con);
    $_SESSION['success'] = "Student ID and all associated grades deleted successfully.";
} catch (Exception $e) {
    // Rollback transaction on error
    mysqli_rollback($con);
    $_SESSION['error'] = "Error deleting student: " . $e->getMessage();
}

header("Location: manage-student-id.php");
exit();
?>
