<?php
session_start();
include('includes/config.php');
error_reporting(0);

// Delete professor and also remove from users table
if (isset($_GET['action']) && $_GET['action'] == 'del') {
    $pid = $_GET['rid'];

    // Fetch the email of the professor being deleted
    $professorQuery = mysqli_query($con, "SELECT email FROM professors WHERE id = '$pid'");
    $professor = mysqli_fetch_assoc($professorQuery);
    $email = $professor['email'];

    if ($email) {
        // Begin transaction
        mysqli_begin_transaction($con);
        try {
            // Delete from professors table
            $deleteProfessorQuery = mysqli_query($con, "DELETE FROM professors WHERE id = '$pid'");
            if (!$deleteProfessorQuery) {
                throw new Exception('Failed to delete professor from professors table.');
            }

            // Delete from users table using email
            $deleteUserQuery = mysqli_query($con, "DELETE FROM users WHERE email = '$email' AND role = 'professor'");
            if (!$deleteUserQuery) {
                throw new Exception('Failed to delete associated user from users table.');
            }

            // Commit transaction if both queries are successful
            mysqli_commit($con);
            echo "<script>alert('Professor and associated user deleted successfully');</script>";
        } catch (Exception $e) {
            // Rollback transaction on error
            mysqli_rollback($con);
            echo "<script>alert('Error: {$e->getMessage()}');</script>";
        }
    } else {
        echo "<script>alert('Professor not found');</script>";
    }

    echo "<script>window.location.href = 'all-professors.php';</script>";
}

// Assign professor to users table after adding or updating
function assignToUsersTable($professor_id, $full_name, $email) {
    global $con;
    // Check if user already exists
    $checkUser = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND role='professor'");
    if (mysqli_num_rows($checkUser) == 0) {
        // Insert into users table with role professor and default year_level
        $insertUser = mysqli_query($con, "INSERT INTO users (email, full_name, role, professor_id, year_level) VALUES ('$email', '$full_name', 'professor', '$professor_id', 'Unassigned')");
        if (!$insertUser) {
            echo "<script>alert('Error assigning professor to users table');</script>";
        }
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
                        <h4 class="page-title">View All Professors</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="demo-box m-t-20">
                        <div class="m-b-30">
                            <a href="add-professors.php">
                                <button class="btn btn-custom waves-effect waves-light btn-md">Add Professor</button>
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table m-0 table-bordered" id="example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Year Level</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($con, "SELECT * FROM professors");
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($query)) {
                                        // Check if user is already assigned in users table
                                        assignToUsersTable($row['id'], $row['full_name'], $row['email']);
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $row['full_name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['year_level'] ?: 'Unassigned'; ?></td>
                                        <td><?php echo $row['created_at']; ?></td>
                                        <td>
                                            <a href="edit-professors.php?pid=<?php echo $row['id']; ?>">
                                                <button class="btn btn-primary">Edit</button>
                                            </a>
                                            <a href="all-professors.php?action=del&rid=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete?')">
                                                <button class="btn btn-danger">Delete</button>
                                            </a>
                                            <a href="assign-professors.php?pid=<?php echo $row['id']; ?>" class="btn btn-info">Assign Year Level</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $cnt++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
</div>
