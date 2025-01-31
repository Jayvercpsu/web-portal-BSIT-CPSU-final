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

// Fetch grades with subjects and professor names
$query = "
    SELECT fs.grade, fs.date_added, s.subject_name, p.full_name AS professor_name
    FROM first_semester_students fs
    JOIN subjects s ON fs.subject_id = s.id
    LEFT JOIN professors p ON fs.professor_id = p.id
    WHERE fs.student_id = ?
    ORDER BY fs.date_added DESC
";

$grades = [];
if ($stmt = $con->prepare($query)) {
    $stmt->bind_param("i", $student_id);
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Grades</title>
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
        <h2 class="text-center mb-4">Your Grades</h2>

        <?php if (!empty($grades)) { ?>
            <table class="table table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
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

                        // Determine the grade color
                        $color = ($grade <= 75) ? 'red' : (($grade > 80) ? 'green' : 'black');
                    ?>
                        <tr>
                            <td><?php echo $subject_name; ?></td>
                            <td class="font-weight-bold" style="color: <?php echo $color; ?>;"><?php echo $grade; ?></td>
                            <td><?php echo $professor_name; ?></td>
                            <td><?php echo $date_added; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="text-center">
                <h1 class="display-4 text-danger">No grades available</h1>
            </div>
        <?php } ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>