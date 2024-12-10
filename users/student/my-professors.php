<?php
session_start();
include('includes/config.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch the logged-in student's year level from the users table (where the student role is defined)
$result = mysqli_query($con, "SELECT year FROM users WHERE id = '$user_id' AND role = 'student'");
$student = mysqli_fetch_assoc($result);
if (!$student) {
    // Handle error if student data is not found
    $_SESSION['error'] = "Student data not found or invalid role.";
    header('Location: dashboard.php');
    exit();
}

$year_level = $student['year'];  // Get the student's year level

// Fetch professors who match the student's year level from the users table
$query = mysqli_query($con, "SELECT * FROM users WHERE year_level = '$year_level' AND role = 'professor'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professors List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="bg-light">
    <?php include('includes/sidebar-account.php'); ?>
    <div class="d-flex">
        <div class="container mt-5 p-4 bg-white shadow rounded flex-grow-1">
            <a href="index.php" class="d-flex align-items-center text-decoration-none p-2 rounded-lg back-link" style="color: #6a0dad;">
                <i class="fa fa-long-arrow-left mr-2" style="font-size: 20px;"></i>
                <span class="font-weight-bold">Back to home page</span>
            </a>

            <h3 class="mt-4 mb-3 text-center">Professors List</h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['full_name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="view-professor-updates.php?professor_id=<?php echo $row['id']; ?>">View Updates</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <style>
        .dropdown-item:focus {
            background-color: #6a0dad;
        }

        .dropdown-item:hover {
            color: white;
            background-color: #6a0dad;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>