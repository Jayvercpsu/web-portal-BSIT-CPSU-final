<?php
session_start();
include('includes/config.php');
error_reporting(0);

// Handle student deletion
if (isset($_GET['delete'])) {
    $student_id = mysqli_real_escape_string($con, $_GET['delete']);
    $query = "DELETE FROM tblstudents WHERE student_id = '$student_id'";
    if (mysqli_query($con, $query)) {
        echo "<script>alert('Student deleted successfully');</script>";
        echo "<script>window.location.href = 'all-students.php';</script>";
    } else {
        echo "<script>alert('Error deleting student');</script>";
    }
}

// Fetch all students from tblstudents
$query = "SELECT * FROM tblstudents";
$result = mysqli_query($con, $query);
if (!$result) {
    die("Error fetching students: " . mysqli_error($con));
}
?>

<?php include('includes/topheader.php'); ?>
<?php include('includes/leftsidebar.php'); ?>

<!-- DataTables CSS & JS CDN -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Start right Content here -->
<div class="content-page">
    <div class="content">
        <div class="container-fluid text-center"> <!-- Full-width container -->

            <!-- Page Header -->
            <h1 class="my-4">All Students</h1>

            <!-- Filter Buttons -->
            <div class="btn-group mb-4">
                <button class="btn btn-primary filter-btn" data-year="all">All</button>
                <button class="btn btn-success filter-btn" data-year="1st Year">1st Year</button>
                <button class="btn btn-info filter-btn" data-year="2nd Year">2nd Year</button>
                <button class="btn btn-warning filter-btn" data-year="3rd Year">3rd Year</button>
                <button class="btn btn-danger filter-btn" data-year="4th Year">4th Year</button>
            </div>

            <!-- Student Table -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="studentTable" class="table table-bordered table-hover text-center w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Year</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr data-year="<?php echo $row['student_year']; ?>">
                                        <td><?php echo $row['student_id']; ?></td>
                                        <td><?php echo $row['student_name']; ?></td>
                                        <td><?php echo $row['student_year']; ?></td>
                                        <td>
                                            <a href="all-students.php?delete=<?php echo $row['student_id']; ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure?')">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<!-- JavaScript for DataTables & Filtering -->
<script>
    $(document).ready(function() {
        var table = $('#studentTable').DataTable(); // Initialize DataTable

        $('.filter-btn').on('click', function() {
            let year = $(this).data('year');
            table.search(year === 'all' ? '' : year).draw(); // Use DataTables search instead of manually hiding rows
        });
    });
</script>

<!-- CSS for Full Width & Clean Design -->
<style>
    h1 {
        font-weight: bold;
        color: #333;
    }

    .btn-group .btn {
        margin: 5px;
        font-size: 16px;
    }

    .table {
        width: 100%;
        /* Full width */
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .table th {
        background-color: #343a40;
        color: white;
    }

    .table-responsive {
        overflow-x: auto;
    }
</style>