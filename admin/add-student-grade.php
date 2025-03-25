<?php
session_start();
include('includes/config.php');
error_reporting(0);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit_grades'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id'] ?? '');

    if (empty($student_id)) {
        echo json_encode(["status" => "error", "message" => "Please select a student."]);
        exit();
    }

    if (!isset($_POST['course_no']) || !isset($_POST['descriptive_title']) || !isset($_POST['grade']) || !isset($_POST['unit']) || !isset($_POST['pre_req'])) {
        echo json_encode(["status" => "error", "message" => "Missing form data. Ensure all fields are filled."]);
        exit();
    }

    $courses = $_POST['course_no'];
    $descriptions = $_POST['descriptive_title'];
    $grades = $_POST['grade'];
    $units = $_POST['unit'];
    $pre_reqs = $_POST['pre_req'];

    $allProcessed = true;

    $stmt_insert = $con->prepare("INSERT INTO tblgrades (student_id, course_no, descriptive_title, grade, unit, pre_req) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt_update = $con->prepare("UPDATE tblgrades SET grade=? WHERE student_id=? AND course_no=?");

    foreach ($courses as $index => $course_no) {
        $desc = mysqli_real_escape_string($con, $descriptions[$index]);
        $grade = !empty($grades[$index]) ? mysqli_real_escape_string($con, $grades[$index]) : NULL;
        $unit = mysqli_real_escape_string($con, $units[$index]);
        $pre_req = mysqli_real_escape_string($con, $pre_reqs[$index]);

        // ✅ Check if grade already exists
        $check_query = mysqli_query($con, "SELECT * FROM tblgrades WHERE student_id='$student_id' AND course_no='$course_no'");
        if (mysqli_num_rows($check_query) > 0) {
            // ✅ Update existing grade
            $stmt_update->bind_param("sis", $grade, $student_id, $course_no);
            $query = $stmt_update->execute();
        } else {
            // ✅ Insert new grade
            $stmt_insert->bind_param("isssis", $student_id, $course_no, $desc, $grade, $unit, $pre_req);
            $query = $stmt_insert->execute();
        }

        if (!$query) {
            $allProcessed = false;
        }
    }

    $stmt_insert->close();
    $stmt_update->close();

    if ($allProcessed) {
        echo json_encode(["status" => "success", "message" => "Grades successfully saved!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error saving some grades."]);
    }
}
?>



<?php include('includes/topheader.php'); ?>
<?php include('includes/leftsidebar.php'); ?>

<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Grade Entry</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-lg border-0 rounded">
                        <div class="card-body p-4">
                            <h5 class="text-center font-weight-bold mb-3">Select Student</h5>
                            <hr>

                            <!-- ✅ Success & Error Messages -->
                            <?php if (!empty($msg)) { ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo htmlentities($msg); ?>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                            <?php } ?>
                            <?php if (!empty($error)) { ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo htmlentities($error); ?>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                            <?php } ?>

                            <!-- ✅ Include Select2 CSS -->
                            <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

                            <!-- Student Selection -->
                            <form method="post" id="gradeForm">
                                <div class="form-group">
                                    <label class="font-weight-bold">Select Student</label>
                                    <select class="form-control form-control-lg" name="student_id" id="student_id" required>
                                        <option value="">Search and select a student...</option>
                                    </select>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- ✅ Forms for 1st Year to 4th Year will be displayed here -->
            <div id="grade-form-container"></div>

        </div>
    </div>
</div>

<!-- ✅ Include jQuery & Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $("#student_id").select2({
        placeholder: "Search and select a student...",
        allowClear: true,
        ajax: {
            url: "fetch-students.php",
            type: "GET",
            dataType: "json",
            delay: 250,
            data: function(params) {
                return { search: params.term };
            },
            processResults: function(data) {
                return { results: data };
            },
            cache: true
        }
    });

    $('#student_id').on('change', function () {
        let studentId = $(this).val();
        let studentName = $("#student_id option:selected").text();

        if (studentId) {
            $("#grade-form-container").html('<p class="text-center text-primary">Loading forms...</p>');

            $.ajax({
                url: "load-forms.php",
                type: "POST",
                data: { student_id: studentId, student_name: studentName },
                success: function (response) {
                    $("#grade-form-container").html(response);
                    loadSavedGrades(studentId);
                },
                error: function () {
                    $("#grade-form-container").html('<p class="text-center text-danger">Error loading forms.</p>');
                }
            });
        } else {
            $("#grade-form-container").html('<p class="text-center text-muted">Please select a student.</p>');
        }
    });

});
</script>
