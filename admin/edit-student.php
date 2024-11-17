<?php
session_start();
include('includes/config.php');
error_reporting(0);

if (isset($_GET['email'])) {
    $email = mysqli_real_escape_string($con, $_GET['email']);

    // Fetch the current student details
    $query = "SELECT * FROM users WHERE email = '$email' AND role = 'student'";
    $result = mysqli_query($con, $query);
    $student = mysqli_fetch_assoc($result);

    if (!$student) {
        echo "<script>alert('No student found');</script>";
        echo "<script>window.location.href = 'all-students.php';</script>";
        exit;
    }

    // Determine current year by checking year tables
    $current_year = ''; 
    $year_tables = ['first_year', 'second_year', 'third_year', 'fourth_year'];
    foreach ($year_tables as $year_table) {
        $year_query = "SELECT * FROM $year_table WHERE email = '$email'";
        $year_result = mysqli_query($con, $year_query);
        if (mysqli_num_rows($year_result) > 0) {
            $current_year = $year_table;
            break;
        }
    }

    if (isset($_POST['update'])) {
        $full_name = mysqli_real_escape_string($con, $_POST['full_name']);
        $new_email = mysqli_real_escape_string($con, $_POST['email']);
        $new_year = mysqli_real_escape_string($con, $_POST['year']);
        $new_password = mysqli_real_escape_string($con, $_POST['password']);

        // Step 1: Update in the users table
        $update_query = "UPDATE users SET full_name = '$full_name', email = '$new_email', password = '$new_password' WHERE email = '$email'";
        if (mysqli_query($con, $update_query)) {

            // Step 2: Remove from the current year table
            if ($current_year) {
                $delete_from_current_year = "DELETE FROM $current_year WHERE email = '$email'";
                mysqli_query($con, $delete_from_current_year);
            }

            // Step 3: Insert the student into the new year table with password
            $insert_query = "INSERT INTO $new_year (full_name, email, password, created_at) 
                             VALUES ('$full_name', '$new_email', '$new_password', NOW()) 
                             ON DUPLICATE KEY UPDATE full_name = '$full_name', password = '$new_password'";

            if (mysqli_query($con, $insert_query)) {
                echo "<script>alert('Student updated successfully');</script>";
                echo "<script>window.location.href = 'all-students.php';</script>";
            } else {
                echo "<script>alert('Error updating student in the new year table');</script>";
            }
        } else {
            echo "<script>alert('Error updating student in the users table');</script>";
        }
    }
} else {
    echo "<script>alert('No student found');</script>";
    echo "<script>window.location.href = 'all-students.php';</script>";
}
?>

<?php include('includes/topheader.php'); ?>
<?php include('includes/leftsidebar.php'); ?>

<!-- Start right Content here -->
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit Student</h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li><a href="#">Admin</a></li>
                            <li><a href="#">Students</a></li>
                            <li class="active">Edit Student</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="demo-box m-t-20">
                        <form method="POST">
                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input type="text" name="full_name" class="form-control" value="<?php echo $student['full_name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $student['email']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="year">Year</label>
                                <select name="year" class="form-control">
                                    <option value="first_year" <?php echo $current_year == 'first_year' ? 'selected' : ''; ?>>First Year</option>
                                    <option value="second_year" <?php echo $current_year == 'second_year' ? 'selected' : ''; ?>>Second Year</option>
                                    <option value="third_year" <?php echo $current_year == 'third_year' ? 'selected' : ''; ?>>Third Year</option>
                                    <option value="fourth_year" <?php echo $current_year == 'fourth_year' ? 'selected' : ''; ?>>Fourth Year</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" value="<?php echo $student['password']; ?>" required>
                            </div>
                            <button type="submit" name="update" class="btn btn-success">Update Student</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
</div>
