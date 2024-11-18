<?php
session_start();
include('includes/config.php');  

// Check if the user is logged in and has a valid user_id in the session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("Location: login.php");
    exit();
}

// Fetch the student's data from the users table
$query = "SELECT id, full_name, email, password, created_at, profile_image, year FROM users WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if (!$student) {
    echo "Student data not found.";
    exit();
}

date_default_timezone_set('Asia/Kuala_Lumpur');
$formatted_created_at = date("F j, Y g:i a", strtotime($student['created_at']));
$profileImage = $student['profile_image'] ?: './assets/profile-images/default-profile.png';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = htmlspecialchars($_POST['full_name'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $year = $_POST['year'];
    $password = $_POST['password'];

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
        $file_extension = pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION);
        $unique_file_name = $target_dir . uniqid('profile_', true) . '.' . $file_extension;

        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $unique_file_name)) {
            $profileImage = $unique_file_name;
        } else {
            echo "Error uploading profile image.";
            exit();
        }
    }

    // Keep old password if no new password is provided
    $hashed_password = empty($password) ? $student['password'] : $password;

    // Begin transaction for profile and year transition updates
    $con->begin_transaction();
    try {
        $update_query = "UPDATE users SET full_name = ?, email = ?, profile_image = ?, year = ?, password = ? WHERE id = ?";
        $stmt = $con->prepare($update_query);
        $stmt->bind_param("sssssi", $full_name, $email, $profileImage, $year, $hashed_password, $user_id);
        $stmt->execute();

        $year_tables = [
            '1st Year' => 'first_year',
            '2nd Year' => 'second_year',
            '3rd Year' => 'third_year',
            '4th Year' => 'fourth_year'
        ];

        if ($student['year'] != $year) {
            // Remove from old year table
            if (isset($year_tables[$student['year']])) {
                $old_year_table = $year_tables[$student['year']];
                $delete_query = "DELETE FROM $old_year_table WHERE id = ?";
                $stmt = $con->prepare($delete_query);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
            }

            // Add to new year table
            if (isset($year_tables[$year])) {
                $new_year_table = $year_tables[$year];
                $insert_query = "INSERT INTO $new_year_table (id, full_name, email, profile_image, password) VALUES (?, ?, ?, ?, ?)";
                $stmt = $con->prepare($insert_query);
                $stmt->bind_param("issss", $user_id, $full_name, $email, $profileImage, $hashed_password);
                $stmt->execute();
            }
        } else {
            // Update in the same year table
            if (isset($year_tables[$year])) {
                $current_year_table = $year_tables[$year];
                $update_year_query = "UPDATE $current_year_table SET full_name = ?, email = ?, profile_image = ?, password = ? WHERE id = ?";
                $stmt = $con->prepare($update_year_query);
                $stmt->bind_param("ssssi", $full_name, $email, $profileImage, $hashed_password, $user_id);
                $stmt->execute();
            }
        }

        $con->commit();
        header("Location: edit-profile.php?update=success");
        exit();
    } catch (Exception $e) {
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
    <link rel="stylesheet" href="./assets/css/edit-profile.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php if (isset($_GET['update']) && $_GET['update'] == 'success'): ?>
        <script type="text/javascript">
            alert("Profile updated successfully!");
        </script>
    <?php endif; ?>

    <div class="container rounded bg-white mt-5">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" src="<?php echo htmlentities($profileImage); ?>" width="200" height="200">
                    <span class="font-weight-bold"><?php echo htmlentities($student['full_name']); ?></span>
                    <span class="text-black-50"><?php echo htmlentities($student['email']); ?></span>
                    <span>Year: <?php echo htmlentities($student['year']); ?></span>
                    <span><?php echo htmlentities($formatted_created_at); ?></span> <!-- Display formatted date -->
                </div>
            </div>
            <div class="col-md-8">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="index.php" class="d-flex flex-row align-items-center">
                            <i style="color: #6a0dad;" class="fa fa-long-arrow-left mr-1 mb-1"></i>
                            <h6 class="h6-custom">Back to profile</h6>
                        </a>
                        <h6>Edit Profile</h6>
                    </div>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" class="form-control" name="full_name" value="<?php echo htmlentities($student['full_name']); ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" value="<?php echo htmlentities($student['email']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="profile_image">Profile Image:</label>
                            <input type="file" id="profile_image" class="form-control" name="profile_image">
                            <img id="image-preview" class="img-thumbnail" alt="New Image Preview" style="display:none;">
                        </div>


                        <div class="form-group">
                            <label for="year">Year:</label>
                            <select class="form-control" name="year">
                                <option value="1st Year" <?php echo ($student['year'] == '1st Year') ? 'selected' : ''; ?>>First Year</option>
                                <option value="2nd Year" <?php echo ($student['year'] == '2nd Year') ? 'selected' : ''; ?>>Second Year</option>
                                <option value="3rd Year" <?php echo ($student['year'] == '3rd Year') ? 'selected' : ''; ?>>Third Year</option>
                                <option value="4th Year" <?php echo ($student['year'] == '4th Year') ? 'selected' : ''; ?>>Fourth Year</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="new_password">Your Password</label>
                            <input type="password" class="form-control" value="<?php echo htmlentities($student['password']); ?>" name="password" id="new_password" placeholder="Enter new password">
                            <input type="checkbox" onclick="togglePassword()"> Show Password
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-custom">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        .btn-custom {
            background-color: #6a0dad;
            color: white;
        }

        .h6-custom {
            color: #6a0dad;
        }

        .btn-custom:hover {
            background-color: #5a0dad;
            color: white;
        }
    </style>
    <script>
        document.getElementById('profile_image').addEventListener('change', function(event) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var previewImage = document.getElementById('image-preview');
                previewImage.src = e.target.result;
                previewImage.style.display = 'block'; // Show the preview image
            }
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById('new_password');
            var passwordType = passwordField.type;
            if (passwordType === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
    </script>

</body>

</html>