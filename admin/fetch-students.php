<?php
include('includes/config.php');

$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

$query = "SELECT student_id, student_name FROM tblstudents WHERE student_name LIKE '%$searchTerm%' ORDER BY student_name ASC";
$result = mysqli_query($con, $query);

$students = [];
while ($row = mysqli_fetch_assoc($result)) {
    $students[] = [
        "id" => $row['student_id'],
        "text" => $row['student_name']
    ];
}

// ✅ Return JSON response
header('Content-Type: application/json');
echo json_encode($students);
