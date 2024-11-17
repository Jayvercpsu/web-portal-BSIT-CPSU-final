<?php
session_start();
include('includes/config.php'); // Ensure the config file is correct
error_reporting(E_ALL); // Show all errors for debugging
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {
    $full_name = mysqli_real_escape_string($con, $_POST['full_name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $created_at = date("Y-m-d H:i:s");
    $role = 'professor'; // Define role for users table

    // Check if email already exists in professors or users
    $email_check_query = mysqli_query($con, "SELECT email FROM professors WHERE email='$email' UNION SELECT email FROM users WHERE email='$email'");
    if (!$email_check_query) {
        die("Error in email check query: " . mysqli_error($con));
    }

    if (mysqli_num_rows($email_check_query) > 0) {
        // Email already exists, show alert
        echo "<script>alert('Email already exists. Please choose a different email.');</script>";
    } else {
        // Start transaction
        mysqli_begin_transaction($con);

        try {
            // Insert into professors table
            $query_professor = mysqli_query($con, "INSERT INTO professors (full_name, email, password, created_at) VALUES ('$full_name', '$email', '$password', '$created_at')");
            if (!$query_professor) {
                throw new Exception("Error inserting into professors table: " . mysqli_error($con));
            }

            // Insert into users table
            $query_user = mysqli_query($con, "INSERT INTO users (full_name, email, password, role, created_at) VALUES ('$full_name', '$email', '$password', '$role', '$created_at')");
            if (!$query_user) {
                throw new Exception("Error inserting into users table: " . mysqli_error($con));
            }

            // Commit transaction
            mysqli_commit($con);

            echo "<script>alert('Professor added successfully');</script>";
            echo "<script>window.location.href = 'all-professors.php';</script>";
        } catch (Exception $e) {
            // Rollback transaction on error
            mysqli_rollback($con);
            echo "<script>alert('Transaction failed: " . $e->getMessage() . "');</script>";
        }
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
                        <h4 class="page-title">Add Professor</h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li><a href="#">Admin</a></li>
                            <li><a href="#">Professors</a></li>
                            <li class="active">Add Professor</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="demo-box m-t-20">
                        <div class="m-b-30">
                            <a href="all-professors.php">
                                <button class="btn btn-custom waves-effect waves-light btn-md">Back to Professors</button>
                            </a>
                        </div>

                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary">Add Professor</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
</div>
