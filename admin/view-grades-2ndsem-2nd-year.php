<?php
session_start();
include('includes/config.php');
error_reporting(0);

if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    $student_id = $_GET['student_id']; // Get student ID from URL

    // Fetch student details
    $query_student = mysqli_query($con, "SELECT * FROM tblstudents WHERE student_id='$student_id' AND student_year='2nd Year'");
    $student = mysqli_fetch_array($query_student);

    if (!$student) {
        echo "<script>alert('Student not found!');</script>";
        echo "<script>window.location.href='2ndsem-2nd-year-grades.php';</script>";
        exit();
    }

    // DELETE GRADE FUNCTIONALITY
    if (isset($_GET['delete_id'])) {
        $delete_id = intval($_GET['delete_id']);
        $query = mysqli_query($con, "DELETE FROM tblgrades WHERE id='$delete_id'");

        if ($query) {
            echo "<script>alert('Grade deleted successfully!');</script>";
        } else {
            echo "<script>alert('Error deleting grade.');</script>";
        }
        echo "<script>window.location.href='view-grades-2ndsem-2nd-year.php?student_id=$student_id';</script>";
        exit();
    }

    // UPDATE GRADE FUNCTIONALITY
    if (isset($_POST['update_grade'])) {
        $grade_id = $_POST['grade_id'];
        $new_grade = $_POST['grade'];

        $update_query = mysqli_query($con, "UPDATE tblgrades SET grade='$new_grade' WHERE id='$grade_id'");

        if ($update_query) {
            echo "<script>alert('Grade updated successfully!');</script>";
        } else {
            echo "<script>alert('Error updating grade.');</script>";
        }
        echo "<script>window.location.href='view-grades-2ndsem-2nd-year.php?student_id=$student_id';</script>";
        exit();
    }

    // Fetch grades for 2nd Semester
    $query_grades = mysqli_query($con, "SELECT * FROM tblgrades WHERE student_id='$student_id' AND semester='2nd Sem'");
?>

<?php include('includes/topheader.php'); ?>
<?php include('includes/leftsidebar.php'); ?>

<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Grades for <?php echo htmlentities($student['student_name']); ?> (2nd Semester - 2nd Year)</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Course No.</th>
                                    <th>Descriptive Title</th>
                                    <th>Grade</th>
                                    <th>Remarks</th>
                                    <th>Unit</th>
                                    <th>Pre-Req</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($query_grades)) {
                                    $grade = intval($row['grade']);

                                    // Determine remarks based on grade
                                    if ($grade == 0 || $grade == null) {
                                        $remarks = "<span class='text-muted'>No Grade</span>";
                                    } elseif ($grade < 75) {
                                        $remarks = "<span class='text-danger fw-bold'>Failed</span>";
                                    } else {
                                        $remarks = "<span class='text-success fw-bold'>Passed</span>";
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo htmlentities($row['course_no']); ?></td>
                                        <td><?php echo htmlentities($row['descriptive_title']); ?></td>
                                        <td>
                                            <form method="post">
                                                <input type="hidden" name="grade_id" value="<?php echo $row['id']; ?>">
                                                <input type="number" name="grade" class="form-control grade-input" value="<?php echo htmlentities($row['grade']); ?>" min="0" max="100">
                                        </td>
                                        <td id="remarks-<?php echo $row['id']; ?>"><?php echo $remarks; ?></td>
                                        <td><?php echo htmlentities($row['unit']); ?></td>
                                        <td><?php echo htmlentities($row['pre_req']); ?></td>
                                        <td>
                                            <button type="submit" class="btn btn-success btn-sm" name="update_grade">Save</button>
                                            <a href="?student_id=<?php echo $student_id; ?>&delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <a href="2ndsem-2nd-year-grades.php" class="btn btn-danger">Back</a>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php include('includes/footer.php'); ?>
</div>

<script>
    // Add event listeners to update remarks dynamically when editing grades
    document.querySelectorAll(".grade-input").forEach(input => {
        input.addEventListener("input", function() {
            var grade = parseFloat(this.value);
            var remarksCell = document.getElementById("remarks-" + this.closest("tr").querySelector("input[name='grade_id']").value);

            if (!this.value || grade === 0) {
                remarksCell.innerHTML = "<span class='text-muted'>No Grade</span>";
            } else if (grade < 75) {
                remarksCell.innerHTML = "<span class='text-danger fw-bold'>Failed</span>";
            } else {
                remarksCell.innerHTML = "<span class='text-success fw-bold'>Passed</span>";
            }
        });
    });
</script>

<?php } ?>
