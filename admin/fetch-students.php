<?php
include('includes/config.php');

$year = mysqli_real_escape_string($con, $_GET['year']);

$query = mysqli_query($con, "SELECT student_id, student_name FROM tblstudents WHERE student_year='$year' ORDER BY student_name ASC");

$students = [];
while ($row = mysqli_fetch_assoc($query)) {
    $students[] = $row;
}

echo json_encode($students);
?>
