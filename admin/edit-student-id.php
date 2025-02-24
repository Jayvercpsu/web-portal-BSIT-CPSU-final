<?php
session_start();
include('includes/config.php');
error_reporting(0);

if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    $id = intval($_GET['id']); // Get student ID from URL

    // Fetch existing student data
    $query = mysqli_query($con, "SELECT * FROM tblstudents WHERE id='$id'");
    $row = mysqli_fetch_array($query);

    if (isset($_POST['update'])) {
        $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
        $student_name = mysqli_real_escape_string($con, $_POST['student_name']);
        $student_year = mysqli_real_escape_string($con, $_POST['student_year']);

        // Update student record
        $updateQuery = mysqli_query($con, "UPDATE tblstudents SET student_id='$student_id', student_name='$student_name', student_year='$student_year' WHERE id='$id'");

        if ($updateQuery) {
            $msg = "Student ID updated successfully!";
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
                        <h4 class="page-title">Edit Student ID</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <h4 class="m-t-0 header-title"><b>Edit Student ID</b></h4>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <?php if ($msg) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Success!</strong> <?php echo htmlentities($msg); ?>
                                    </div>
                                <?php } ?>
                                <?php if ($error) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Error!</strong> <?php echo htmlentities($error); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <form method="post">
                            <div class="form-group col-md-6">
                                <label class="control-label">Student ID</label>
                                <input type="text" class="form-control" name="student_id" value="<?php echo htmlentities($row['student_id']); ?>" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Student Name</label>
                                <input type="text" class="form-control" name="student_name" value="<?php echo htmlentities($row['student_name']); ?>" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Year Level</label>
                                <select class="form-control" name="student_year" required>
                                    <option value="1st Year" <?php if ($row['student_year'] == "1st Year") echo "selected"; ?>>1st Year</option>
                                    <option value="2nd Year" <?php if ($row['student_year'] == "2nd Year") echo "selected"; ?>>2nd Year</option>
                                    <option value="3rd Year" <?php if ($row['student_year'] == "3rd Year") echo "selected"; ?>>3rd Year</option>
                                    <option value="4th Year" <?php if ($row['student_year'] == "4th Year") echo "selected"; ?>>4th Year</option>
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success waves-effect waves-light btn-md" name="update">
                                    Update Student ID
                                </button>
                                <a href="manage-student-id.php" class="btn btn-danger btn-md">Back</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php include('includes/footer.php'); ?>
</div>

<?php } ?>
