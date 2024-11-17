<?php
session_start();
include('includes/config.php');
error_reporting(0);

// Handle student deletion
if (isset($_GET['delete'])) {
    $email = mysqli_real_escape_string($con, $_GET['delete']);

    // Delete student from users table
    $query = "DELETE FROM users WHERE email = '$email'";
    if (mysqli_query($con, $query)) {
        echo "<script>alert('Student deleted successfully');</script>";
        echo "<script>window.location.href = 'all-students.php';</script>";
    } else {
        echo "<script>alert('Error deleting student');</script>";
    }
}
 

// Fetch all students from the users table where the role is 'student'
$query = "SELECT * FROM users WHERE role = 'student'";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Error fetching students: " . mysqli_error($con));
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
                        <h4 class="page-title">All Students</h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li><a href="#">Admin</a></li>
                            <li><a href="#">Students</a></li>
                            <li class="active">All Students</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>





            <div class="row">
                <div class="col-md-12">
                    <div class="demo-box m-t-20">
                        <div class="m-b-30">
                            <a href="add-student.php">
                                <button class="btn btn-custom waves-effect waves-light btn-md">Add New Student</button>
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table m-0 table-bordered" id="example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Year</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch all students from the users table
                                    $query = "SELECT u.id, u.full_name, u.email, u.created_at, 
                                              CASE 
                                                  WHEN y.email IS NOT NULL THEN 'first_year' 
                                                  WHEN y2.email IS NOT NULL THEN 'second_year' 
                                                  WHEN y3.email IS NOT NULL THEN 'third_year' 
                                                  WHEN y4.email IS NOT NULL THEN 'fourth_year' 
                                              END AS year
                                              FROM users u
                                              LEFT JOIN first_year y ON u.email = y.email
                                              LEFT JOIN second_year y2 ON u.email = y2.email
                                              LEFT JOIN third_year y3 ON u.email = y3.email
                                              LEFT JOIN fourth_year y4 ON u.email = y4.email
                                              WHERE u.role = 'student'";

                                    $result = mysqli_query($con, $query);
                                    $cnt = 1;

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <tr>
                                                <td><?php echo $cnt++; ?></td>
                                                <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                                <td><?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $row['year']))); ?></td>
                                                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                                <td>
                                                    <a href="edit-student.php?email=<?php echo $row['email']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="delete-student.php?email=<?php echo $row['email']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No students found.</td></tr>";
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