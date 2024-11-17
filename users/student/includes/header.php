<?php
session_start();
include('config.php');

// Check if the user is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    $userId = $_SESSION['user_id'];
    $role = $_SESSION['role']; // Get the role (student or professor)

    // Initialize user data
    $fullName = '';
    $profileImage = '';

    if ($role == 'student') {
        // For student, fetch data from the student tables (first_year, second_year, etc.)
        $yearTables = ['first_year', 'second_year', 'third_year', 'fourth_year'];
        foreach ($yearTables as $table) {
            $query = "SELECT full_name, profile_image FROM $table WHERE id = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 'i', $userId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $fullName, $profileImage);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            if ($fullName) {
                break; // If user found, stop the loop
            }
        }
    } elseif ($role == 'professor') {
        // For professor, fetch data from the professors table
        $query = "SELECT full_name, profile_image FROM professors WHERE id = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $fullName, $profileImage);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    // Set default profile image if none is set
    if (empty($profileImage)) {
        $profileImage = './assets/profile-images/default-profile.png';
    }
} else {
    // Redirect to login if not logged in
    header("Location: login.php");
    exit();
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container">
        <!-- BSIT Logo and Name (Visible on all screen sizes) -->
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="../../admin/assets/images/bsit_logo.png" height="65" alt="BSIT Logo">
            <img src="../../admin/assets/images/BSIT_name.webp" alt="BSIT Name" class="ml-2" style="height: 65px; width: auto;" onload="this.style.height = window.innerWidth < 992 ? '50px' : '65px';">
        </a>

        <!-- Toggler for Mobile View -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links - Collapsible -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarResponsive">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="index.php"><i class="fa fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="about-us.php"><i class="fa fa-info-circle"></i> About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="instructor.php"><i class="fa fa-users"></i> Instructors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="news.php"><i class="fa fa-newspaper-o"></i> News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="contact-us.php"><i class="fa fa-phone"></i> Contact us</a>
                </li>

                <!-- Profile Section -->
                <li class="nav-item dropdown">
                    <button class="btn btn-link nav-link text-dark p-0 border-0" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo htmlspecialchars($profileImage); ?>" alt="Profile" class="rounded-circle" width="40" height="40">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="#"><strong>Hi <?php echo htmlspecialchars($fullName); ?></strong></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="edit-profile.php"><i class="fa fa-edit"></i> Edit Profile</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fa fa-sign-out"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </div>

        <!-- CPSU Text and Logo (Visible on large screens only) -->
        <div class="navbar-brand d-lg-flex align-items-center d-none d-lg-flex">
            <h1 class="mb-0" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">CPSU</h1>
            <img src="../../admin/assets/images/cpsu_logo.png" height="65" alt="CPSU Logo" class="ml-2">
        </div>
    </div>
</nav>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark">
                Are you sure you want to log out?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>