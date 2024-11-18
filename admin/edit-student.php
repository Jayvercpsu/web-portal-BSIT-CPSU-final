<?php
session_start();
include('includes/config.php');
error_reporting(0);

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Fetch current student details
    $stmt = $con->prepare("SELECT * FROM users WHERE email = ? AND role = 'student'");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if (!$student) {
        echo "<script>alert('No student found');</script>";
        echo "<script>window.location.href = 'all-students.php';</script>";
        exit;
    }

    // Determine current year by checking year tables
    $current_year = '';
    $year_tables = [
        '1st Year' => 'first_year',
        '2nd Year' => 'second_year',
        '3rd Year' => 'third_year',
        '4th Year' => 'fourth_year'
    ];
    foreach ($year_tables as $year => $table) {
        $year_stmt = $con->prepare("SELECT * FROM $table WHERE email = ?");
        $year_stmt->bind_param('s', $email);
        $year_stmt->execute();
        $year_result = $year_stmt->get_result();
        if ($year_result->num_rows > 0) {
            $current_year = $table;
            break;
        }
    }

    if (isset($_POST['update'])) {
        $full_name = $_POST['full_name'];
        $new_email = $_POST['email'];
        $new_year = $_POST['year'];
        $new_password = $_POST['password'];
        $new_year_table = $year_tables[$new_year];

        // Update in the users table
        $update_stmt = $con->prepare("UPDATE users SET full_name = ?, email = ?, password = ?, year = ? WHERE email = ?");
        $update_stmt->bind_param('sssss', $full_name, $new_email, $new_password, $new_year, $email);
        if ($update_stmt->execute()) {

            // Remove from the current year table
            if ($current_year) {
                $delete_stmt = $con->prepare("DELETE FROM $current_year WHERE email = ?");
                $delete_stmt->bind_param('s', $email);
                $delete_stmt->execute();
            }

            // Insert into the new year table
            $insert_stmt = $con->prepare("INSERT INTO $new_year_table (full_name, email, password, created_at) 
                                          VALUES (?, ?, ?, NOW()) 
                                          ON DUPLICATE KEY UPDATE full_name = ?, password = ?");
            $insert_stmt->bind_param('sssss', $full_name, $new_email, $new_password, $full_name, $new_password);
            if ($insert_stmt->execute()) {
                echo "<script>alert('Student updated successfully');</script>";
                echo "<script>window.location.href = 'all-students.php';</script>";
            } else {
                echo "<script>alert('Error inserting student into the new year table');</script>";
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
                                    <option value="1st Year" <?php echo $student['year'] == '1st Year' ? 'selected' : ''; ?>>First Year</option>
                                    <option value="2nd Year" <?php echo $student['year'] == '2nd Year' ? 'selected' : ''; ?>>Second Year</option>
                                    <option value="3rd Year" <?php echo $student['year'] == '3rd Year' ? 'selected' : ''; ?>>Third Year</option>
                                    <option value="4th Year" <?php echo $student['year'] == '4th Year' ? 'selected' : ''; ?>>Fourth Year</option>
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
