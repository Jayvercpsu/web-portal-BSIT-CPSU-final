<?php
session_start();
include('includes/config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit_grades'])) {
    $student_id = $_POST['student_id'] ?? '';

    // ✅ Validate student ID
    if (empty($student_id)) {
        echo json_encode(["status" => "error", "message" => "Student ID is required."]);
        exit();
    }

    // ✅ Check if student exists
    $stmt_check_student = $con->prepare("SELECT student_id FROM tblstudents WHERE student_id = ?");
    $stmt_check_student->bind_param("s", $student_id);
    $stmt_check_student->execute();
    $result = $stmt_check_student->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(["status" => "error", "message" => "Student not found."]);
        exit();
    }
    $stmt_check_student->close();

    // ✅ Validate required fields
    if (!isset($_POST['course_no'], $_POST['descriptive_title'], $_POST['grade'], $_POST['unit'], $_POST['pre_req'], $_POST['year_form'], $_POST['semester'])) {
        echo json_encode(["status" => "error", "message" => "Missing form data. Ensure all fields are filled."]);
        exit();
    }

    // ✅ Prepare SQL queries
    $stmt_insert = $con->prepare("INSERT INTO tblgrades (student_id, course_no, descriptive_title, grade, unit, pre_req, year_form, semester) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt_update = $con->prepare("UPDATE tblgrades SET grade = ?, year_form = ?, semester = ? WHERE student_id = ? AND course_no = ?");

    $allProcessed = true;

    foreach ($_POST['course_no'] as $index => $course_no) {
        $desc = $_POST['descriptive_title'][$index];
        $grade = !empty($_POST['grade'][$index]) ? $_POST['grade'][$index] : NULL;
        $unit = $_POST['unit'][$index];
        $pre_req = $_POST['pre_req'][$index];
        $year_form_json = json_encode($_POST['year_form']);
        $semester = $_POST['semester'][$index] ?? '1st Sem'; // Default to 1st Sem if missing

        // ✅ Check if the grade already exists for this semester
        $stmt_check_grade = $con->prepare("SELECT id FROM tblgrades WHERE student_id = ? AND course_no = ? AND semester = ?");
        $stmt_check_grade->bind_param("sss", $student_id, $course_no, $semester);
        $stmt_check_grade->execute();
        $result = $stmt_check_grade->get_result();

        if ($result->num_rows > 0) {
            // ✅ Update grade if it exists
            $stmt_update->bind_param("sssss", $grade, $year_form_json, $semester, $student_id, $course_no);
            $query = $stmt_update->execute();
        } else {
            // ✅ Insert new grade
            $stmt_insert->bind_param("ssssssss", $student_id, $course_no, $desc, $grade, $unit, $pre_req, $year_form_json, $semester);
            $query = $stmt_insert->execute();
        }

        if (!$query) {
            $allProcessed = false;
        }

        $stmt_check_grade->close();
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

<?php include('includes/footer.php'); ?>
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
                    return {
                        search: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

        $('#student_id').on('change', function() {
            let studentId = $(this).val();

            if (studentId) {
                $("#grade-form-container").html('<p class="text-center text-primary">Loading...</p>');

                $.ajax({
                    url: "load-forms.php",
                    type: "POST",
                    data: {
                        student_id: studentId
                    },
                    success: function(response) {
                        $("#grade-form-container").html(response);
                    },
                    error: function() {
                        $("#grade-form-container").html('<p class="text-center text-danger">Error loading data.</p>');
                    }
                });
            } else {
                $("#grade-form-container").html('<p class="text-center text-muted">Please select a student.</p>');
            }
        });
    });
</script>