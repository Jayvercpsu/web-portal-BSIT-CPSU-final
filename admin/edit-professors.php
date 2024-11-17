<?php
session_start();
include('includes/config.php');
error_reporting(E_ALL); // Enable error reporting for debugging
ini_set('display_errors', 1);

if (isset($_GET['pid'])) {
    $pid = mysqli_real_escape_string($con, $_GET['pid']);

    // Fetch the current professor's data
    $query = mysqli_query($con, "SELECT * FROM professors WHERE id='$pid'");
    if (!$query) {
        die("Error fetching professor data: " . mysqli_error($con));
    }

    $row = mysqli_fetch_array($query);
    if (!$row) {
        die("No professor found with the given ID.");
    }

    $full_name = $row['full_name'];
    $email = $row['email'];
    $password = $row['password'];

    if (isset($_POST['submit'])) {
        $new_full_name = mysqli_real_escape_string($con, $_POST['full_name']);
        $new_email = mysqli_real_escape_string($con, $_POST['email']);
        $new_password = mysqli_real_escape_string($con, $_POST['password']);

        // Start transaction
        mysqli_begin_transaction($con);

        try {
            // Update the professor's data
            $update_professor = mysqli_query($con, "UPDATE professors SET full_name='$new_full_name', email='$new_email', password='$new_password' WHERE id='$pid'");
            if (!$update_professor) {
                throw new Exception("Error updating professor: " . mysqli_error($con));
            }

            // Update the user's data
            $update_user = mysqli_query($con, "UPDATE users SET full_name='$new_full_name', email='$new_email', password='$new_password' WHERE email='$email'");
            if (!$update_user) {
                throw new Exception("Error updating user: " . mysqli_error($con));
            }

            // Commit transaction
            mysqli_commit($con);

            echo "<script>alert('Professor updated successfully');</script>";
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
                        <h4 class="page-title">Edit Professor</h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li><a href="#">Admin</a></li>
                            <li><a href="#">Professors</a></li>
                            <li class="active">Edit Professor</li>
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

                        <form method="POST" action="edit-professors.php?pid=<?php echo $pid; ?>">
                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo htmlspecialchars($full_name); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>" required>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary">Update Professor</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
</div>
