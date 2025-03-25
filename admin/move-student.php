<?php
session_start();
include('includes/config.php');
error_reporting(0);

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Get current year level
    $query = mysqli_query($con, "SELECT student_year FROM tblstudents WHERE id = '$id'");
    $row = mysqli_fetch_assoc($query);
    $currentYear = $row['student_year'];

    // Define the year progression
    $yearMapping = [
        "1st Year" => "2nd Year",
        "2nd Year" => "3rd Year",
        "3rd Year" => "4th Year",
        "4th Year" => "Graduated"
    ];

    // Check if the student can move to the next year
    if (isset($yearMapping[$currentYear])) {
        $newYear = $yearMapping[$currentYear];

        // Update the student's year level
        $updateQuery = mysqli_query($con, "UPDATE tblstudents SET student_year = '$newYear' WHERE id = '$id'");

        if ($updateQuery) {
            $_SESSION['success'] = "Student successfully moved to $newYear.";
        } else {
            $_SESSION['error'] = "Error updating student year.";
        }
    } else {
        $_SESSION['error'] = "This student is already in the highest year level.";
    }
}

// Redirect back
header("Location: manage-student-id.php");
exit();
?>
