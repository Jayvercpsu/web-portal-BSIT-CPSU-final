<?php
session_start();
include('includes/config.php');

// Check if the user is logged in and has a valid user_id in the session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch the student's data from the users table
    $query = "SELECT full_name, profile_image FROM users WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    // Check if student data exists
    if (!$student) {
        echo "Student data not found.";
        exit();
    }

    // Set the path for the default profile image
    $defaultImage = './assets/profile-images/default-profile.png';

    // Determine the correct profile image path
    if (!empty($student['profile_image'])) {
        $profileImage = $student['profile_image'];
        
        // Handle relative path correction if needed
        if (!file_exists($profileImage)) {
            $profileImage = './assets/profile-images/' . basename($student['profile_image']); // Add default path prefix
        }

        // If the image still doesn't exist, revert to default
        if (!file_exists($profileImage)) {
            $profileImage = $defaultImage;
        }
    } else {
        // Use the default profile image if no image is set in the database
        $profileImage = $defaultImage;
    }

    // Get the full name of the user
    $full_name = $student['full_name'];
} else {
    // Set default values for guests
    $full_name = "Guest";
    $profileImage = './assets/profile-images/default-profile.png'; // Default image path for guest
}

?>

<!-- Your HTML for the Navbar -->
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
                        <!-- Profile Image -->
                        <img src="<?php echo htmlspecialchars($profileImage); ?>" alt="Profile" class="rounded-circle" width="40" height="40">
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="#"><strong>Hi <?php echo htmlspecialchars($full_name); ?></strong></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="edit-profile.php"><i class="fa fa-edit"></i> My account</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt"></i> Logout 
                        </a>
                    </div>
                </li>
            </ul>
        </div>
        <style>
            .dropdown-item:hover {
                background-color: #6a0dad;
                color: white;
            }

            .nav-link:hover {
                text-decoration: underline;
                color: #6a0dad;
            }
        </style>

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
                <button type="button" class="btn btn-primary text-white" data-dismiss="modal">Cancel</button>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>
