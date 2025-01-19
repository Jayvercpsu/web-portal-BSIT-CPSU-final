<?php
// Start session
session_start();

// Include the database connection file
include('includes/config.php');

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['user_id'];

// Fetch grades for the logged-in student
$query = "SELECT grade, date_added 
          FROM student_grades 
          WHERE user_id = '$student_id'
          ORDER BY date_added DESC";

$result = mysqli_query($con, $query);
$grades = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Final Grade</title>
    <!-- Include Bootstrap 4.5 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <?php include('includes/sidebar-account.php'); ?> <!-- Include Sidebar -->

    <div class="container mt-5 p-4 bg-white shadow rounded">
        <!-- Back Link -->
        <a href="index.php" class="d-flex align-items-center text-decoration-none p-2 rounded-lg back-link" style="color: #6a0dad;">
            <i class="fa fa-long-arrow-left mr-2" style="font-size: 20px;"></i>
            <span class="font-weight-bold">Back to home page</span>
        </a>

        <!-- Main Content -->
        <h2 class="text-center mb-4">Your Final Grade is:</h2>

        <?php if (!empty($grades)) { 
            $grade = $grades[0]['grade'];
            $color = 'black'; // Default color for grades > 75 and ≤ 80

            // Determine the grade color based on conditions
            if ($grade <= 75) {
                $color = 'red';
            } elseif ($grade > 80) {
                $color = 'green';
            }
        ?>
            <div class="text-center">
                <h1 class="display-3 font-weight-bold" style="color: <?php echo $color; ?>;">
                    <?php echo htmlentities($grade); ?>
                </h1>
                <p class="text-muted">Recorded on: 
                    <?php echo htmlentities($grades[0]['date_added'] ?? 'N/A'); ?>
                </p>
            </div>
        <?php } else { ?>
            <div class="text-center">
                <h1 class="display-4 text-danger">No grades available</h1>
            </div>
        <?php } ?>

       
    </div>

    <!-- Include Bootstrap 4.5 JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
