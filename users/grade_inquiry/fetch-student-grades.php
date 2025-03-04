<?php
include('../../includes/config.php');

header("Content-Type: application/json");

if (!isset($_GET['student_id']) || empty($_GET['student_id'])) {
    echo json_encode(["status" => "error", "message" => "Student ID is required."]);
    exit();
}

$student_id = mysqli_real_escape_string($con, $_GET['student_id']);

// Fetch student name and year
$query = mysqli_query($con, "SELECT student_name, student_year FROM tblstudents WHERE student_id='$student_id'");
$student = mysqli_fetch_assoc($query);

if (!$student) {
    echo json_encode(["status" => "error", "message" => "Student ID not found."]);
    exit();
}

// Fetch grades for 1st Semester
$query_grades_1st = mysqli_query($con, "SELECT * FROM tblgrades WHERE student_id='$student_id' AND semester='1st Sem'");
$grades_1st = [];
while ($row = mysqli_fetch_assoc($query_grades_1st)) {
    $grades_1st[] = $row;
}

// Fetch grades for 2nd Semester
$query_grades_2nd = mysqli_query($con, "SELECT * FROM tblgrades WHERE student_id='$student_id' AND semester='2nd Sem'");
$grades_2nd = [];
while ($row = mysqli_fetch_assoc($query_grades_2nd)) {
    $grades_2nd[] = $row;
}

// Return JSON response
echo json_encode([
    "status" => "success",
    "student_name" => $student['student_name'],
    "student_year" => $student['student_year'],
    "grades_1st" => $grades_1st,
    "grades_2nd" => $grades_2nd
]);
?>
