<?php
include('includes/config.php');

$student_id = $_POST['student_id'] ?? '';
$course_no = $_POST['course_no'] ?? '';

if (!empty($student_id) && !empty($course_no)) {
    $query = $con->prepare("DELETE FROM tblgrades WHERE student_id = ? AND course_no = ?");
    $query->bind_param("is", $student_id, $course_no);

    if ($query->execute()) {
        echo json_encode(["status" => "success", "message" => "Grade deleted successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete grade."]);
    }
    $query->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
