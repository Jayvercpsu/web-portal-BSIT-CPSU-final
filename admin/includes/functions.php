<?php
include('config.php');

function saveStudentGrades($student_id, $grades_data)
{
    global $con;

    if (empty($student_id)) {
        return ["status" => "error", "message" => "Please select a student."];
    }

    if (empty($grades_data['course_no'])) {
        return ["status" => "error", "message" => "No grades provided."];
    }

    $courses = $grades_data['course_no'];
    $descriptions = $grades_data['descriptive_title'];
    $grades = $grades_data['grade'];
    $units = $grades_data['unit'];
    $pre_reqs = $grades_data['pre_req'];

    $stmt_insert = $con->prepare("INSERT INTO tblgrades (student_id, course_no, descriptive_title, grade, unit, pre_req) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt_update = $con->prepare("UPDATE tblgrades SET grade=?, descriptive_title=?, unit=?, pre_req=? WHERE student_id=? AND course_no=?");

    foreach ($courses as $index => $course_no) {
        $desc = mysqli_real_escape_string($con, $descriptions[$index]);
        $grade = $grades[$index] !== "" ? mysqli_real_escape_string($con, $grades[$index]) : NULL;
        $unit = mysqli_real_escape_string($con, $units[$index]);
        $pre_req = mysqli_real_escape_string($con, $pre_reqs[$index]);

        $check_query = $con->prepare("SELECT grade FROM tblgrades WHERE student_id=? AND course_no=?");
        $check_query->bind_param("is", $student_id, $course_no);
        $check_query->execute();
        $result = $check_query->get_result();
        $existing_grade = $result->fetch_assoc();

        if ($existing_grade) {
            if ($existing_grade['grade'] != $grade) {
                $stmt_update->bind_param("ssssis", $grade, $desc, $unit, $pre_req, $student_id, $course_no);
                $query = $stmt_update->execute();
            }
        } else {
            $stmt_insert->bind_param("isssis", $student_id, $course_no, $desc, $grade, $unit, $pre_req);
            $query = $stmt_insert->execute();
        }

        if (!$query) {
            return ["status" => "error", "message" => "Failed to save some grades."];
        }
    }

    return ["status" => "success", "message" => "Grades successfully saved!"];
}
?>
