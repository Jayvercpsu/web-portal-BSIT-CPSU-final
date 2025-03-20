<?php
session_start();
include('includes/config.php');
error_reporting(0);

if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    // DELETE GRADE FUNCTIONALITY
    if (isset($_GET['delete_id'])) {
        $delete_id = intval($_GET['delete_id']);
        $query = mysqli_query($con, "DELETE FROM tblgrades WHERE student_id='$delete_id'");

        if ($query) {
            echo "<script>alert('Grades deleted successfully!');</script>";
        } else {
            echo "<script>alert('Error deleting grades.');</script>";
        }
        echo "<script>window.location.href='2ndsem-3rd-year-grades.php';</script>";
        exit();
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
                        <h4 class="page-title">3rd Year - 2nd Semester Grades</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <h4 class="m-t-0 header-title"><b>Student List</b></h4>
                        <hr>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = mysqli_query($con, "SELECT DISTINCT student_id, student_name FROM tblgrades WHERE student_year='3rd Year' AND semester='2nd Sem' ORDER BY student_name ASC");
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt); ?></td>
                                        <td><?php echo htmlentities($row['student_id']); ?></td>
                                        <td><?php echo htmlentities($row['student_name']); ?></td>
                                        <td>
                                            <a href="view-grades-2ndsem-3rd-year.php?student_id=<?php echo htmlentities($row['student_id']); ?>" class="btn btn-info btn-sm">
                                                View Grades
                                            </a>
                                            <a href="2ndsem-3rd-year-grades.php?delete_id=<?php echo htmlentities($row['student_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student\'s grades?');">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php $cnt++; } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php include('includes/footer.php'); ?>
</div>

<?php } ?>
