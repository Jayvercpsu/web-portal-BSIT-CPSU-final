<?php
session_start();
include('includes/config.php');

if (!isset($_SESSION['user_id'])) {
    die("Error: Session user_id is not set.");
}

$users_table_id = $_SESSION['user_id']; // ID from users table
$student_id = null; // This will store the actual student ID

// Debugging: Print session user_id
// echo "Session user_id from users table: " . htmlspecialchars($users_table_id) . "<br>";

// List of student year tables
$year_tables = ['first_year', 'second_year', 'third_year', 'fourth_year'];

// Find the correct student ID
foreach ($year_tables as $table) {
    $query = "SELECT id FROM $table WHERE email = (SELECT email FROM users WHERE id = ?)";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("i", $users_table_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $student_id = $row['id'];
            break; // Stop searching once found
        }
        $stmt->close();
    }
}

// Debugging: Print the correct student_id
// echo "Correct student_id from year table: " . htmlspecialchars($student_id) . "<br>";

if ($student_id === null) {
    die("Error: Student not found in any year table.");
}

// Fetch grades using the correct student_id
$query = "SELECT grade, date_added FROM student_grades WHERE user_id = ? ORDER BY date_added DESC LIMIT 1";

if ($stmt = $con->prepare($query)) {
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $grade_data = $result->fetch_assoc();
    $stmt->close();
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Final Grade</title>
    <!-- Include Bootstrap 4.5 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> <!-- FontAwesome Icons -->
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

        <?php if (!empty($grade_data)) { 
            $grade = htmlspecialchars($grade_data['grade']);
            $date_added = htmlspecialchars(date("F j, Y, g:i A", strtotime($grade_data['date_added'] ?? 'N/A')));

            // Determine the grade color
            $color = ($grade <= 75) ? 'red' : (($grade > 80) ? 'green' : 'black');
        ?>
            <div class="text-center">
                <h1 class="display-3 font-weight-bold" style="color: <?php echo $color; ?>;">
                    <?php echo $grade; ?>
                </h1>
                <p class="text-muted">Recorded on: <?php echo $date_added; ?></p>
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
