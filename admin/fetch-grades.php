<?php
include('includes/config.php');

$student_id = $_POST['student_id'] ?? '';

$grades = [];

if (!empty($student_id)) {
    // ✅ Fetch all grades for this student, including `year_form`
    $query = $con->prepare("SELECT course_no, descriptive_title, grade, unit, pre_req, year_form 
                            FROM tblgrades WHERE student_id = ?");
    $query->bind_param("s", $student_id);
    $query->execute();
    $result = $query->get_result();

    while ($row = $result->fetch_assoc()) {
        $grades[$row['course_no']] = [
            "grade" => $row['grade'],
            "descriptive_title" => $row['descriptive_title'],
            "unit" => $row['unit'],
            "pre_req" => $row['pre_req'],
            "year_form" => $row['year_form'] // ✅ Include `year_form`
        ];
    }

    $query->close();
}

// ✅ Return JSON Response
header('Content-Type: application/json');
echo json_encode($grades);
?>
