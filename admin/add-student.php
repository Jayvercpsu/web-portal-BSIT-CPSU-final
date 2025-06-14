<?php
session_start();
include('includes/config.php');
error_reporting(0);

if (isset($_POST['submit'])) {
    $full_name = mysqli_real_escape_string($con, $_POST['full_name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $year = mysqli_real_escape_string($con, $_POST['year']);
    $password = $_POST['password']; // No need to escape since it will be hashed
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
    $created_at = date('Y-m-d H:i:s');

    // Start transaction
    mysqli_begin_transaction($con);

    try {
        // Insert into the users table
        $user_query = mysqli_prepare($con, "INSERT INTO users (full_name, email, role, year, password, created_at) VALUES (?, ?, 'student', ?, ?, ?)");
        mysqli_stmt_bind_param($user_query, "sssss", $full_name, $email, $year, $hashed_password, $created_at);
        if (!mysqli_stmt_execute($user_query)) {
            throw new Exception("Error adding student to users table: " . mysqli_error($con));
        }

        // Determine the correct year table
        $year_table = "";
        switch ($year) {
            case '1st Year':
                $year_table = 'first_year';
                break;
            case '2nd Year':
                $year_table = 'second_year';
                break;
            case '3rd Year':
                $year_table = 'third_year';
                break;
            case '4th Year':
                $year_table = 'fourth_year';
                break;
            default:
                throw new Exception("Invalid year selected");
        }

        // Insert into the respective year table
        $year_query = mysqli_prepare($con, "INSERT INTO $year_table (full_name, email, password, created_at) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($year_query, "ssss", $full_name, $email, $hashed_password, $created_at);
        if (!mysqli_stmt_execute($year_query)) {
            throw new Exception("Error adding student to year table: " . mysqli_error($con));
        }

        // Commit transaction
        mysqli_commit($con);

        echo "<script>alert('Student added successfully');</script>";
        echo "<script>window.location.href = 'all-students.php';</script>";
    } catch (Exception $e) {
        // Rollback transaction on error
        mysqli_rollback($con);
        echo "<script>alert('Transaction failed: " . $e->getMessage() . "');</script>";
    }
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
                        <h4 class="page-title">Add Student</h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li><a href="#">Admin</a></li>
                            <li><a href="#">Students</a></li>
                            <li class="active">Add Student</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="demo-box m-t-20">
                        <div class="m-b-30">
                            <a href="all-students.php">
                                <button class="btn btn-custom waves-effect waves-light btn-md">Back to All Students</button>
                            </a>
                        </div>
                        <form method="POST">
                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input type="text" name="full_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="year">Year</label>
                                <select name="year" class="form-control" required>
                                    <option value="">Select Year</option>
                                    <option value="1st Year">First Year</option>
                                    <option value="2nd Year">Second Year</option>
                                    <option value="3rd Year">Third Year</option>
                                    <option value="4th Year">Fourth Year</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-success">Add Student</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
</div>
