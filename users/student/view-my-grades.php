<?php
session_start();
include('includes/config.php');

if (!isset($_SESSION['user_id'])) {
    die("Error: Session user_id is not set.");
}

$users_table_id = $_SESSION['user_id']; // The logged-in user's ID
$student_id = null;

// Get student_id from users table where role is 'student'
$query = "SELECT id FROM users WHERE id = ? AND role = 'student'";
if ($stmt = $con->prepare($query)) {
    $stmt->bind_param("i", $users_table_id);
    $stmt->execute();
    $stmt->bind_result($student_id);
    $stmt->fetch();
    $stmt->close();
}

if ($student_id === null) {
    die("Error: Student not found or not authorized.");
}

// Fetch grades from both first and second semester
$query = "
    SELECT fs.grade, fs.date_added, s.subject_name, p.full_name AS professor_name, 'First Semester' AS semester
    FROM first_semester_students fs
    JOIN subjects s ON fs.subject_id = s.id
    LEFT JOIN professors p ON fs.professor_id = p.id
    WHERE fs.student_id = ?
 
    UNION

    SELECT ss.grade, ss.date_added, s.subject_name, p.full_name AS professor_name, 'Second Semester' AS semester
    FROM second_semester_students ss
    JOIN subjects s ON ss.subject_id = s.id
    LEFT JOIN professors p ON ss.professor_id = p.id
    WHERE ss.student_id = ?

    ORDER BY FIELD(semester, 'First Semester', 'Second Semester'), date_added DESC
";


$grades = [];
if ($stmt = $con->prepare($query)) {
    $stmt->bind_param("ii", $student_id, $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $grades[] = $row;
    }
    $stmt->close();
}

$con->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Student - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link
        href="vendor/fontawesome-free/css/all.min.css"
        rel="stylesheet"
        type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />
</head>

<body id="page-top">



    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include('includes/sidebar-dashboard.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <nav class="navbar navbar-expand-lg navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Navbar Title or Section Link -->
                    <div class="ml-auto">
                        <span class="navbar-text font-weight-bold" style="font-size: 1.2rem;">
                            View My Grades
                        </span>
                    </div>
                </nav>
                <!-- End of Topbar -->






                <body class="bg-light">

                    <div class="container mt-5 p-4 bg-white shadow rounded">
                        <!-- Back Link -->
                        <a href="index.php" class="d-flex align-items-center text-decoration-none p-2 rounded-lg back-link" style="color: #6a0dad;">
                            <i class="fa fa-long-arrow-left mr-2" style="font-size: 20px;"></i>
                            <span class="font-weight-bold">Back to home page</span>
                        </a>

                        <!-- Main Content -->
                        <h2 class="text-center mb-4">Your Grades (Both Semesters)</h2>

                        <?php if (!empty($grades)) { ?>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Semester</th>
                                            <th>Subject</th>
                                            <th>Grade</th>
                                            <th>Instructor</th>
                                            <th>Date Recorded</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($grades as $grade_data) {
                                            $grade = htmlspecialchars($grade_data['grade']);
                                            $subject_name = htmlspecialchars($grade_data['subject_name']);
                                            $professor_name = !empty($grade_data['professor_name']) ? htmlspecialchars($grade_data['professor_name']) : 'Unknown';
                                            $date_added = htmlspecialchars(date("F j, Y, g:i A", strtotime($grade_data['date_added'])));
                                            $semester = htmlspecialchars($grade_data['semester']);

                                            // Determine the grade color
                                            $color = ($grade <= 75) ? 'red' : (($grade > 80) ? 'green' : 'black');
                                        ?>
                                            <tr>
                                                <td><?php echo $semester; ?></td>
                                                <td><?php echo $subject_name; ?></td>
                                                <td class="font-weight-bold" style="color: <?php echo $color; ?>;"><?php echo $grade; ?></td>
                                                <td><?php echo $professor_name; ?></td>
                                                <td><?php echo $date_added; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <div class="text-center">
                                <h1 class="display-4 text-danger">No grades available</h1>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <?php include('includes/sidebar-footer.php'); ?>


        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>

</html>