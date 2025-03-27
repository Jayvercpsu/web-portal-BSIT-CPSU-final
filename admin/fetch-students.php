<?php
include('includes/config.php');

$search = $_GET['search'] ?? '';

// 🔹 Fix: Search using `student_id` and `student_name`
$query = "SELECT student_id, student_name FROM tblstudents WHERE student_name LIKE ? OR student_id LIKE ?";
$stmt = $con->prepare($query);
$searchTerm = "%$search%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$students = [];
while ($row = $result->fetch_assoc()) {
    $students[] = [
        "id" => $row['student_id'], // 🔹 Fix: Use `student_id` not `id`
        "text" => "{$row['student_id']} - {$row['student_name']}"
    ];
}

$stmt->close();
echo json_encode($students);
?>
