<?php
session_start();
require_once "../includes/config.php";

header("Content-Type: application/json");

if (!isset($_GET['student_id']) || empty($_GET['student_id'])) {
    echo json_encode(["status" => "error", "message" => "Student ID is required."]);
    exit();
}

$student_id = $_GET['student_id'];

// Fetch student details
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
$student_year = trim($student["student_year"]); // Fetch directly from the database

$year_map = [
    "1" => "1st Year",
    "2" => "2nd Year",
    "3" => "3rd Year",
    "4" => "4th Year",
    "1st Year" => "1st Year",
    "2nd Year" => "2nd Year",
    "3rd Year" => "3rd Year",
    "4th Year" => "4th Year"
];

$student_year_label = $year_map[$student_year] ?? $student_year;



// Fetch grades grouped by year_form and semester
$sqlGrades = "SELECT year_form, semester, course_no, descriptive_title, grade, re, unit, pre_req
              FROM tblgrades 
              WHERE student_id = ? 
              ORDER BY year_form ASC, FIELD(semester, '1st Sem', '2nd Sem')";

$stmtGrades = $con->prepare($sqlGrades);
$stmtGrades->bind_param("s", $student_id);
$stmtGrades->execute();
$resultGrades = $stmtGrades->get_result();

$grade_structure = [];

// Initialize grade structure with empty semesters for all year levels
$grade_structure = [
    "1st Year" => ["1st Sem" => [], "2nd Sem" => []],
    "2nd Year" => ["1st Sem" => [], "2nd Sem" => []],
    "3rd Year" => ["1st Sem" => [], "2nd Sem" => []],
    "4th Year" => ["1st Sem" => [], "2nd Sem" => []]
];

// Process grades if available
while ($row = $resultGrades->fetch_assoc()) {
    $year_forms = json_decode($row["year_form"], true);
    $year_form = is_array($year_forms) && !empty($year_forms) ? $year_forms[0] : "1";
    $semester = trim($row["semester"]) ?: "1st Sem";
    $year_display = $year_map[$year_form] ?? "1st Year";

    $grade_structure[$year_display][$semester][] = [
        "course_no" => $row["course_no"] ?? "N/A",
        "descriptive_title" => $row["descriptive_title"] ?? "N/A",
        "grade" => $row["grade"] ?? "0",
        "re" => $row["re"] ?? "",
        "unit" => $row["unit"] ?? "0",
        "pre_req" => $row["pre_req"] ?? "None"
    ];
}


$stmtGrades->close();

// Return JSON response with organized grade data
echo json_encode([
    "status" => "success",
    "student_name" => $student_name,
    "student_year" => $student_year,
    "student_year_label" => $student_year_label,
    "grades" => $grade_structure
], JSON_PRETTY_PRINT);
