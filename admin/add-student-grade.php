<?php
session_start();
include('includes/config.php');
error_reporting(0);

if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit_grades'])) {
        $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
        $student_name = mysqli_real_escape_string($con, $_POST['student_name']);
        $student_year = mysqli_real_escape_string($con, $_POST['student_year']);
        $semester = mysqli_real_escape_string($con, $_POST['semester']);

        // ✅ Debugging - Check if Values are Received
        if (empty($student_id) || empty($student_name) || empty($student_year) || empty($semester)) {
            die("Error: Missing Required Fields. Ensure all fields are selected.");
        }

        $courses = $_POST['course_no'];
        $descriptions = $_POST['descriptive_title'];
        $grades = $_POST['grade'];
        $res = $_POST['re'];
        $units = $_POST['unit'];
        $pre_reqs = $_POST['pre_req'];

        $allInserted = true;

        foreach ($courses as $index => $course_no) {
            $desc = $descriptions[$index];
            $grade = !empty($grades[$index]) ? $grades[$index] : NULL;
            $re = !empty($res[$index]) ? $res[$index] : NULL;
            $unit = $units[$index];
            $pre_req = $pre_reqs[$index];

            $query = mysqli_query($con, "INSERT INTO tblgrades(student_id, student_name, student_year, semester, course_no, descriptive_title, grade, re, unit, pre_req) 
            VALUES('$student_id', '$student_name', '$student_year', '$semester', '$course_no', '$desc', '$grade', '$re', '$unit', '$pre_req')");

            if (!$query) {
                $allInserted = false;
                error_log("SQL Error: " . mysqli_error($con)); 
            }
        }

        if ($allInserted) {
            $msg = "Grades for " . htmlentities($semester) . " successfully added!";
        } else {
            $error = "Something went wrong. Please try again.";
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

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <h4 class="m-t-0 header-title"><b>Select Student & Semester</b></h4>
                        <hr>

                        <?php if ($msg) { ?>
                            <div class="alert alert-success"><?php echo htmlentities($msg); ?></div>
                        <?php } ?>
                        <?php if ($error) { ?>
                            <div class="alert alert-danger"><?php echo htmlentities($error); ?></div>
                        <?php } ?>

                        <form method="post">
                            <div class="form-group col-md-6">
                                <label>Year Level</label>
                                <select class="form-control" name="student_year" id="student_year" required>
                                    <option value="">Select Year</option>
                                    <option value="1st Year">1st Year</option>
                                    <option value="2nd Year">2nd Year</option>
                                    <option value="3rd Year">3rd Year</option>
                                    <option value="4th Year">4th Year</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Student</label>
                                <select class="form-control" name="student_id" id="student_id" required>
                                    <option value="">Select Student</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Semester</label>
                                <select class="form-control" name="semester" id="semester" required>
                                    <option value="">Select Semester</option>
                                    <option value="1st Sem">1st Semester</option>
                                    <option value="2nd Sem">2nd Semester</option>
                                </select>
                            </div>
                        </form>

                        <!-- Include the 4th Year Form if 4th Year is Selected -->
                        <div id="4th-year-container" style="display:none;">
                            <?php include('forms/4th-year-1stsem-form.php'); ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php include('includes/footer.php'); ?>
</div>

<script>
    // ✅ Update student list based on selected year
    document.getElementById("student_year").addEventListener("change", function() {
        var selectedYear = this.value;
        var studentDropdown = document.getElementById("student_id");

        studentDropdown.innerHTML = '<option value="">Select Student</option>';

        fetch('fetch-students.php?year=' + selectedYear)
        .then(response => response.json())
        .then(data => {
            data.forEach(student => {
                var option = document.createElement("option");
                option.value = student.student_id;
                option.textContent = student.student_name;
                studentDropdown.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching students:', error));

        // Show 4th Year Form if "4th Year" is selected
        if (selectedYear === "4th Year") {
            document.getElementById("4th-year-container").style.display = "block";
        } else {
            document.getElementById("4th-year-container").style.display = "none";
        }
    });
</script>

<?php } ?>
