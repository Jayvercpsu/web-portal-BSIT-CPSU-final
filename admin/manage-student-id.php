<?php
session_start();
include('includes/config.php');
error_reporting(0);

if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
?>
    <?php include('includes/topheader.php'); ?>
    <?php include('includes/leftsidebar.php'); ?>

    <!-- DataTables CSS & JS CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title text-center">Manage Student IDs</h4>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <!-- Success or Error Message -->
                <?php if (isset($_SESSION['success'])) { ?>
                    <div id="successMessage" class="alert alert-success text-center">
                        <?php echo $_SESSION['success'];
                        unset($_SESSION['success']); ?>
                    </div>
                <?php } ?>

                <?php if (isset($_SESSION['error'])) { ?>
                    <div id="errorMessage" class="alert alert-danger text-center">
                        <?php echo $_SESSION['error'];
                        unset($_SESSION['error']); ?>
                    </div>
                <?php } ?>

                <!-- JavaScript to fade out messages -->
                <script>
                    $(document).ready(function() {
                        setTimeout(function() {
                            $("#successMessage, #errorMessage").fadeOut(1000); // Fade out in 1 second
                        }, 2000); // Wait 2 seconds before fading out
                    });
                </script>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title text-center"><b>All Student IDs</b></h4>
                            <hr>

                            <div class="table-responsive">
                                <table id="studentTable" class="table table-hover table-bordered w-100">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Student ID</th>
                                            <th>Student Name</th>
                                            <th>Year Level</th>
                                            <th>Action</th>
                                            <th>Move To</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($con, "SELECT * FROM tblstudents ORDER BY id DESC");
                                        $cnt = 1;
                                        while ($row = mysqli_fetch_array($query)) {
                                            $currentYear = $row['student_year'];

                                            // Determine next year
                                            $yearMapping = [
                                                "1st Year" => "2nd Year",
                                                "2nd Year" => "3rd Year",
                                                "3rd Year" => "4th Year",
                                                "4th Year" => "Graduated"
                                            ];

                                            $nextYear = isset($yearMapping[$currentYear]) ? $yearMapping[$currentYear] : "N/A";
                                            $disabled = ($nextYear === "Graduated") ? "disabled" : "";
                                        ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($row['student_id']); ?></td>
                                                <td><?php echo htmlentities($row['student_name']); ?></td>
                                                <td><?php echo htmlentities($row['student_year']); ?></td>
                                                <td>
                                                    <a href="edit-student-id.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                                    <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['id']; ?>)" class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                                <td>
                                                    <a href="move-student.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm <?php echo $disabled; ?>">
                                                        Move to <?php echo $nextYear; ?>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php $cnt++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php include('includes/footer.php'); ?>
    </div>

    <!-- DataTables Initialization -->
    <script>
        $(document).ready(function() {
            $('#studentTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true
            });
        });

        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this student and all their grades?")) {
                window.location.href = "delete-student-id.php?id=" + id;
            }
        }
    </script>

    <style>
        h4 {
            font-weight: bold;
            color: #333;
        }

        .table {
            width: 100%;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
        }

        .table th {
            background-color: #343a40;
            color: white;
        }

        .table-responsive {
            overflow-x: auto;
        }
    </style>

<?php } ?>