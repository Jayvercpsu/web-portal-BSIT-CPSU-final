<?php
include('includes/config.php');

if (isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    // Include the 1st-year and 2nd-year forms
    include 'forms/1st-year-form.php';
    include 'forms/2nd-year-form.php';
    include 'forms/3rd-year-form.php';
    include 'forms/4th-year-form.php';

} else {
    echo "<p class='text-danger text-center'>No student selected.</p>";
}
?>
