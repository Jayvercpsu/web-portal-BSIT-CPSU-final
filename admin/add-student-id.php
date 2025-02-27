<?php
session_start();
include('includes/config.php');
error_reporting(0);

if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['submit'])) {
        $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
        $student_name = mysqli_real_escape_string($con, $_POST['student_name']);
        $student_year = mysqli_real_escape_string($con, $_POST['student_year']);

        // Insert data into database
        $query = mysqli_query($con, "INSERT INTO tblstudents(student_id, student_name, student_year) VALUES('$student_id', '$student_name', '$student_year')");

        if ($query) {
            $msg = "Student ID added successfully!";
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
                            <h4 class="page-title">Add Student ID</h4>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title"><b>Add Student ID</b></h4>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?php if ($msg) { ?>
                                        <div class="alert alert-success" role="alert">
                                            <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($error) { ?>
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <form method="post">
                                <div class="form-group col-md-6">
                                    <label class="control-label">Student ID</label>
                                    <input type="number" class="form-control" name="student_id" id="student_id" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">Student Name</label>
                                    <input type="text" class="form-control" name="student_name" id="student_name" disabled required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">Year Level</label>
                                    <select class="form-control" name="student_year" id="student_year" disabled required>
                                        <option value="">Select Year Level</option>
                                        <option value="1st Year">1st Year</option>
                                        <option value="2nd Year">2nd Year</option>
                                        <option value="3rd Year">3rd Year</option>
                                        <option value="4th Year">4th Year</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submit">
                                        Add Student ID
                                    </button>
                                </div>
                            </form>



                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php include('includes/footer.php'); ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const studentIdInput = document.getElementById('student_id');
            const studentNameInput = document.getElementById('student_name');
            const studentYearSelect = document.getElementById('student_year');

            studentIdInput.addEventListener("input", function() {
                if (this.value.trim() !== "") {
                    studentNameInput.disabled = false;
                } else {
                    studentNameInput.disabled = true;
                    studentYearSelect.disabled = true;
                    studentNameInput.value = "";
                    studentYearSelect.value = "";
                }
            });

            studentNameInput.addEventListener("input", function() {
                studentYearSelect.disabled = this.value.trim() === "";
            });
        });
    </script>

<?php } ?>