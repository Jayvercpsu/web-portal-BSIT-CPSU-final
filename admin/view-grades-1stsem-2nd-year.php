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
        echo "<script>window.location.href='1stsem-2nd-year-grades.php';</script>";
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
        echo "<script>window.location.href='view-grades-1stsem-1st-year.php?student_id=$student_id';</script>";
        exit();
    }

    // UPDATE GRADE FUNCTIONALITY
    if (isset($_POST['update_grade'])) {
        $grade_id = $_POST['grade_id'];
        $new_grade = $_POST['grade'];
        $new_re = $_POST['re'];

        $update_query = mysqli_query($con, "UPDATE tblgrades SET grade='$new_grade', re='$new_re' WHERE id='$grade_id'");

        if ($update_query) {
            echo "<script>alert('Grade updated successfully!');</script>";
        } else {
            echo "<script>alert('Error updating grade.');</script>";
        }
        echo "<script>window.location.href='view-grades-1stsem-2nd-year.php?student_id=$student_id';</script>";
        exit();
    }

    // Fetch grades for 2nd Semester (Updated Courses)
    $query_grades = mysqli_query($con, "SELECT * FROM tblgrades WHERE student_id='$student_id' AND semester='1st Sem'");

    // Define new 1st Semester subjects
    $courses = [
        ["course_no" => "PCIT-15", "title" => "Data Structures and Algorithms", "unit" => 3, "pre_req" => "CCIT-03"],
        ["course_no" => "PCIT-16", "title" => "Integrative Programming and Technologies 1", "unit" => 3, "pre_req" => "CCIT-03"],
        ["course_no" => "PSIT-01", "title" => "Platform Technologies", "unit" => 3, "pre_req" => ""],
        ["course_no" => "GEL3", "title" => "Introduction to Human-Computer Interaction", "unit" => 3, "pre_req" => "CCIT-02"],
        ["course_no" => "PSIT-02", "title" => "Social and Professional Issues", "unit" => 3, "pre_req" => ""],
        ["course_no" => "PATHFIT-3", "title" => "Folk Dance and Other Dance Forms", "unit" => 2, "pre_req" => "PE-02"]
    ];
?>

    <?php include('includes/topheader.php'); ?>
    <?php include('includes/leftsidebar.php'); ?>

    <div class="content-page">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Grades for <?php echo htmlentities($student['student_name']); ?> (1st Semester - 2nd Year)</h4>
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
                                        <th>Re</th>
                                        <th>Unit</th>
                                        <th>Pre-Req</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_units = 0;
                                    $grades = [];

                                    // Store grades from database in an associative array
                                    while ($row = mysqli_fetch_array($query_grades)) {
                                        $grades[$row['course_no']] = $row;
                                        $total_units += $row['unit'];
                                    }

                                    // Display courses with corresponding grades if available
                                    foreach ($courses as $course) {
                                        $course_no = $course['course_no'];
                                        $grade_data = isset($grades[$course_no]) ? $grades[$course_no] : null;
                                    ?>
                                        <tr>
                                            <td><?php echo htmlentities($course['course_no']); ?></td>
                                            <td><?php echo htmlentities($course['title']); ?></td>
                                            <td>
                                                <form method="post">
                                                    <input type="hidden" name="grade_id" value="<?php echo $grade_data ? $grade_data['id'] : ''; ?>">
                                                    <input type="text" name="grade" class="form-control" value="<?php echo $grade_data ? htmlentities($grade_data['grade']) : ''; ?>" required>
                                            </td>
                                            <td>
                                                <input type="text" name="re" class="form-control" value="<?php echo $grade_data ? htmlentities($grade_data['re']) : ''; ?>">
                                            </td>
                                            <td><?php echo htmlentities($course['unit']); ?></td>
                                            <td><?php echo htmlentities($course['pre_req']); ?></td>
                                            <td>
                                                <?php if ($grade_data) { ?>
                                                    <button type="submit" class="btn btn-success btn-sm" name="update_grade">Save</button>
                                                    <a href="?student_id=<?php echo $student_id; ?>&delete_id=<?php echo $grade_data['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                                                <?php } ?>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <a href="1stsem-2nd-year-grades.php" class="btn btn-danger">Back</a>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php include('includes/footer.php'); ?>
    </div>

<?php } ?>