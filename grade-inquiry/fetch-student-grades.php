<?php
session_start();
require_once "../includes/config.php"; // Ensure this file has your database connection

header("Content-Type: application/json");

if (!isset($_GET['student_id']) || empty($_GET['student_id'])) {
    echo json_encode(["status" => "error", "message" => "Student ID is required."]);
    exit();
}

$student_id = $_GET['student_id']; 

// Fetch student details from tblstudents
$sqlStudent = "SELECT student_name, student_year FROM tblstudents WHERE student_id = ?";
$stmtStudent = $con->prepare($sqlStudent);
$stmtStudent->bind_param("s", $student_id);
$stmtStudent->execute();
$resultStudent = $stmtStudent->get_result();
$student = $resultStudent->fetch_assoc();
$stmtStudent->close();

if (!$student) {
    echo json_encode(["status" => "error", "message" => "Student ID not found."]);
    exit();
}

$student_name = $student["student_name"];
$student_year = $student["student_year"];

// Initialize grades array
$grades = [
    "1st Year" => ["1st Sem" => [], "2nd Sem" => []],
    "2nd Year" => ["1st Sem" => [], "2nd Sem" => []],
    "3rd Year" => ["1st Sem" => [], "2nd Sem" => []],
    "4th Year" => ["1st Sem" => [], "2nd Sem" => []]
];

// Fetch grades from tblgrades where student_id matches
$sqlGrades = "SELECT student_year, semester, course_no, descriptive_title, grade, unit, pre_req 
              FROM tblgrades WHERE student_id = ? 
              ORDER BY FIELD(student_year, '1st Year', '2nd Year', '3rd Year', '4th Year'), 
                       FIELD(semester, '1st Sem', '2nd Sem')";
$stmtGrades = $con->prepare($sqlGrades);
$stmtGrades->bind_param("s", $student_id);
$stmtGrades->execute();
$resultGrades = $stmtGrades->get_result();

while ($row = $resultGrades->fetch_assoc()) {
    $year = $row["student_year"];
    $semester = $row["semester"];

    if (isset($grades[$year][$semester])) {
        $grades[$year][$semester][] = [
            "course_no" => $row["course_no"],
            "descriptive_title" => $row["descriptive_title"],
            "grade" => $row["grade"],
            "unit" => $row["unit"],
            "pre_req" => $row["pre_req"]
        ];
    }
}

$stmtGrades->close();

// Send JSON response
echo json_encode([
    "status" => "success",
    "student_name" => $student_name,
    "student_year" => $student_year,
    "grades" => $grades
]);
?>
