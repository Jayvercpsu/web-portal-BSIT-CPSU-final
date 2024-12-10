<?php
session_start();
include('includes/config.php');
error_reporting(0);

// Get professor data
$professor_id = $_GET['pid'];  // Get the professor ID from the URL
$query = mysqli_query($con, "SELECT * FROM professors WHERE id = '$professor_id'");
$professor = mysqli_fetch_array($query);

// Handle year level assignment
if (isset($_POST['assign_year'])) {
    $year_level = $_POST['year_level'];

    // Begin transaction to ensure both updates happen successfully
    mysqli_begin_transaction($con);
    try {
        // Update the year_level in the professors table
        $query1 = mysqli_query($con, "UPDATE professors SET year_level = '$year_level' WHERE id = '$professor_id'");

        // Update the year_level in the users table using email
        $query2 = mysqli_query($con, "UPDATE users SET year_level = '$year_level' WHERE email = '{$professor['email']}' AND role = 'professor'");

        // Check if both queries were successful
        if ($query1 && $query2) {
            // Commit the transaction if both queries succeed
            mysqli_commit($con);
            echo "<script>alert('Professor assigned to year level $year_level successfully');</script>";
            echo "<script>window.location.href = 'all-professors.php';</script>";
        } else {
            // Rollback the transaction if any query fails
            mysqli_rollback($con);
            echo "<script>alert('Error assigning year level');</script>";
        }
    } catch (Exception $e) {
        // Rollback the transaction in case of an exception
        mysqli_rollback($con);
        echo "<script>alert('Error assigning year level: " . $e->getMessage() . "');</script>";
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
                        <h4 class="page-title">Assign Year Level to Professor</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="demo-box m-t-20">
                        <h5><strong>Assign Year Level to <?php echo $professor['full_name']; ?></strong></h5>
                        <form method="POST">
                            <div class="form-group">
                                <label for="professor_name">Professor Name</label>
                                <input type="text" class="form-control" id="professor_name" value="<?php echo $professor['full_name']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="year_level">Select Year Level</label>
                                <select name="year_level" class="form-control" required>
                                    <option value="1st Year">1st Year</option>
                                    <option value="2nd Year">2nd Year</option>
                                    <option value="3rd Year">3rd Year</option>
                                    <option value="4th Year">4th Year</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="assign_year" class="btn btn-purple">Assign Year Level</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
</div>