<?php
session_start();
include('includes/config.php');

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user data
$query = "SELECT id, full_name, email, password, created_at, profile_image, year FROM users WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if (!$student) {
    echo "User data not found.";
    exit();
}

// Set timezone & format date
date_default_timezone_set('Asia/Kuala_Lumpur');
$formatted_created_at = date("F j, Y g:i a", strtotime($student['created_at']));

// Set default profile image
$profileImage = !empty($student['profile_image']) ? $student['profile_image'] : './assets/profile-images/default-profile.png';
if (!file_exists($profileImage)) {
    $profileImage = './assets/profile-images/default-profile.png';
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = htmlspecialchars($_POST['full_name'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $year = $_POST['year'];
    $password = $_POST['password'];
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Invalid email format.";
        exit();
    }

    // Check for duplicate email
    $check_email_query = "SELECT id FROM users WHERE email = ? AND id != ?";
    $stmt = $con->prepare($check_email_query);
    $stmt->bind_param("si", $email, $user_id);
    $stmt->execute();
    $email_result = $stmt->get_result();

    if ($email_result->num_rows > 0) {
        echo "Error: The email is already in use by another account.";
        exit();
    }

    // Handle profile image upload
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "./assets/profile-images/";
        $file_extension = strtolower(pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($file_extension, $allowed_extensions)) {
            echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
            exit();
        }

        if ($_FILES["profile_image"]["size"] > 2 * 1024 * 1024) { // 2MB limit
            echo "Error: File size exceeds 2MB.";
            exit();
        }

        $unique_file_name = $target_dir . uniqid('profile_', true) . '.' . $file_extension;

        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $unique_file_name)) {
            $profileImage = $unique_file_name;
        } else {
            echo "Error uploading profile image.";
            exit();
        }
    }

    // Keep old password if no new password is provided
    $hashed_password = empty($password) ? $student['password'] : password_hash($password, PASSWORD_DEFAULT);

    // Begin transaction
    $con->begin_transaction();
    try {
        // Update users table
        $update_query = "UPDATE users SET full_name = ?, email = ?, profile_image = ?, year = ?, password = ? WHERE id = ?";
        $stmt = $con->prepare($update_query);
        $stmt->bind_param("sssssi", $full_name, $email, $profileImage, $year, $hashed_password, $user_id);
        $stmt->execute();

        // Year tables mapping
        $year_tables = [
            '1st Year' => 'first_year',
            '2nd Year' => 'second_year',
            '3rd Year' => 'third_year',
            '4th Year' => 'fourth_year'
        ];

        // Handle year transition
        if ($student['year'] != $year) {
            if (isset($year_tables[$student['year']])) {
                $old_year_table = $year_tables[$student['year']];
                $delete_query = "DELETE FROM $old_year_table WHERE id = ?";
                $stmt = $con->prepare($delete_query);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
            }

            if (isset($year_tables[$year])) {
                $new_year_table = $year_tables[$year];
                $insert_query = "INSERT INTO $new_year_table (id, full_name, email, profile_image, password) VALUES (?, ?, ?, ?, ?)";
                $stmt = $con->prepare($insert_query);
                $stmt->bind_param("issss", $user_id, $full_name, $email, $profileImage, $hashed_password);
                $stmt->execute();
            }
        } else {
            if (isset($year_tables[$year])) {
                $current_year_table = $year_tables[$year];
                $update_year_query = "UPDATE $current_year_table SET full_name = ?, email = ?, profile_image = ?, password = ? WHERE id = ?";
                $stmt = $con->prepare($update_year_query);
                $stmt->bind_param("ssssi", $full_name, $email, $profileImage, $hashed_password, $user_id);
                $stmt->execute();
            }
        }

        // Commit transaction
        $con->commit();
        header("Location: edit-profile.php?update=success");
        exit();
    } catch (Exception $e) {
        // Rollback transaction on error
        $con->rollback();
        echo "Error updating profile: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>

</head>

<body class="bg-light">
    <?php include('includes/sidebar-account.php') ?>


    <!-- Success alert if profile updated -->
    <?php if (isset($_GET['update']) && $_GET['update'] == 'success'): ?>
        <script>
            alert("Profile updated successfully!");
        </script>
    <?php endif; ?>

    <div class="d-flex">
        <!-- Main Profile Content -->
        <div class="container mt-5 p-4 bg-white shadow rounded flex-grow-1">
            <a href="index.php" class="d-flex align-items-center text-decoration-none p-2 rounded-lg back-link" style="color: #6a0dad;">
                <i class="fa fa-long-arrow-left mr-2" style="font-size: 20px;"></i>
                <span class="font-weight-bold">Back to home page</span>
            </a>

            <style>
                span:hover {
                    text-decoration: underline;
                }
            </style>

            <div class="row">
                <!-- Left Profile Section -->
                <div class="col-md-4 text-white text-center py-4 rounded-left" style="background-color: #6a0dad; border-right: 2px solid #6a0dad;">
                    <img id="image-preview" class="rounded-circle mt-4 border border-white" src="<?php echo htmlentities($profileImage); ?>" alt="Profile Image" width="150" height="150">
                    <h5 class="mt-3"><?php echo htmlentities($student['full_name']); ?></h5>
                    <p><?php echo htmlentities($student['email']); ?></p>
                    <p>Year: <?php echo htmlentities($student['year']); ?></p>
                    <p><?php echo htmlentities($formatted_created_at); ?></p>
                </div>

                <!-- Right Edit Section -->
                <div class="col-md-8">
                    <div class="py-4">
                        <!-- Back to Profile Link -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5>Edit Profile</h5>
                        </div>

                        <!-- Form Section -->
                        <form method="POST" enctype="multipart/form-data">
                            <!-- Full Name -->
                            <div class="form-group">
                                <label for="full_name" class="font-weight-bold" style="color: black;">Full Name:</label>
                                <input type="text" id="full_name" class="form-control" name="full_name" value="<?php echo htmlentities($student['full_name']); ?>" required>
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email" class="font-weight-bold" style="color: black;">Email:</label>
                                <input type="email" id="email" class="form-control" name="email" value="<?php echo htmlentities($student['email']); ?>" required>
                            </div>

                            <!-- Profile Image -->
                            <div class="form-group">
                                <label for="profile_image" class="font-weight-bold" style="color: black;">Profile Image:</label>
                                <input type="file" id="profile_image" class="form-control" name="profile_image">
                                <div class="small text-muted">Leave blank if you don't want to change your image.</div>
                            </div>

                            <!-- Year Selection -->
                            <div class="form-group">
                                <label for="year" class="font-weight-bold" style="color: black;">Year:</label>
                                <select name="year" class="form-control" required>
                                    <option value="1st Year" <?php echo $student['year'] == '1st Year' ? 'selected' : ''; ?>>1st Year</option>
                                    <option value="2nd Year" <?php echo $student['year'] == '2nd Year' ? 'selected' : ''; ?>>2nd Year</option>
                                    <option value="3rd Year" <?php echo $student['year'] == '3rd Year' ? 'selected' : ''; ?>>3rd Year</option>
                                    <option value="4th Year" <?php echo $student['year'] == '4th Year' ? 'selected' : ''; ?>>4th Year</option>
                                </select>
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <label for="password" class="font-weight-bold" style="color: black;">Password:</label>
                                <input type="password" id="password" class="form-control" name="password">
                                <div class="small text-muted">Leave blank if you don't want to change your password.</div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mt-4" style="background-color: #6a0dad;">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Image preview functionality
        document.getElementById('profile_image').addEventListener('change', function(event) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var previewImage = document.getElementById('image-preview');
                previewImage.src = e.target.result;
                previewImage.classList.remove('d-none'); // Show the image once loaded
            };
            reader.readAsDataURL(event.target.files[0]);
        });


        // Toggle password visibility
        function togglePassword() {
            var passwordField = document.getElementById('new_password');
            passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>

</html>