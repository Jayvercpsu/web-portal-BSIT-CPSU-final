<?php
include('../includes/config.php');

header("Content-Type: application/json");

if (!isset($_GET['student_id']) || empty($_GET['student_id'])) {
    echo json_encode(["status" => "error", "message" => "Student ID is required."]);
    exit();
}

$student_id = mysqli_real_escape_string($con, $_GET['student_id']);

// Fetch student info
$query = mysqli_query($con, "SELECT student_name, student_year FROM tblstudents WHERE student_id='$student_id'");
$student = mysqli_fetch_assoc($query);

if (!$student) {
    echo json_encode(["status" => "error", "message" => "Student ID not found."]);
    exit();
}

// Fetch all grades for the student (latest year first, 1st Sem before 2nd Sem)
$query_grades = mysqli_query($con, "
    SELECT * FROM tblgrades 
    WHERE student_id='$student_id' 
    ORDER BY student_year DESC, FIELD(semester, '1st Sem', '2nd Sem')
");

$allGrades = [];
while ($row = mysqli_fetch_assoc($query_grades)) {
    $year = $row['student_year'];
    $semester = $row['semester'];

    if (!isset($allGrades[$year])) {
        $allGrades[$year] = ["1st Sem" => [], "2nd Sem" => []];
    }

    $allGrades[$year][$semester][] = $row;
}

// Return JSON response
echo json_encode([
    "status" => "success",
    "student_name" => $student['student_name'],
    "student_year" => $student['student_year'],
    "grades" => $allGrades
]);
?>
