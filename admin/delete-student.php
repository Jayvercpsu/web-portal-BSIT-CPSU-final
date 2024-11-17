<?php
session_start();
include('includes/config.php');
error_reporting(0);

// Handle student deletion
if (isset($_GET['email'])) {
    $email = mysqli_real_escape_string($con, $_GET['email']);

    // Start a transaction to ensure both deletions are successful
    mysqli_begin_transaction($con);

    try {
        // Step 1: Find the student to make sure they exist
        $query = "SELECT * FROM users WHERE email = '$email' AND role = 'student'";
        $result = mysqli_query($con, $query);
        $student = mysqli_fetch_assoc($result);

        if ($student) {
            // Step 2: Delete the student from the respective year table
            // We check which year table the student belongs to by verifying the email
            $year_table = null;

            if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM first_year WHERE email = '$email'"))) {
                $year_table = 'first_year';
            } elseif (mysqli_num_rows(mysqli_query($con, "SELECT * FROM second_year WHERE email = '$email'"))) {
                $year_table = 'second_year';
            } elseif (mysqli_num_rows(mysqli_query($con, "SELECT * FROM third_year WHERE email = '$email'"))) {
                $year_table = 'third_year';
            } elseif (mysqli_num_rows(mysqli_query($con, "SELECT * FROM fourth_year WHERE email = '$email'"))) {
                $year_table = 'fourth_year';
            }

            // Step 3: If a year table is found, delete the student from that table
            if ($year_table) {
                $deleteFromYearTableQuery = "DELETE FROM $year_table WHERE email = '$email'";
                if (!mysqli_query($con, $deleteFromYearTableQuery)) {
                    throw new Exception("Error deleting student from the $year_table table.");
                }
            } else {
                throw new Exception("Student year data not found.");
            }

            // Step 4: Delete the student from the users table
            $deleteFromUsersQuery = "DELETE FROM users WHERE email = '$email'";
            if (!mysqli_query($con, $deleteFromUsersQuery)) {
                throw new Exception("Error deleting student from the users table.");
            }

            // Commit the transaction if everything goes well
            mysqli_commit($con);

            echo "<script>alert('Student deleted successfully');</script>";
            echo "<script>window.location.href = 'all-students.php';</script>";
        } else {
            throw new Exception("Student not found.");
        }

    } catch (Exception $e) {
        // Rollback the transaction if something goes wrong
        mysqli_roll_back($con);
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>
