<?php
session_start();
include('includes/config.php');

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$professor_id = $_SESSION['user_id'];
$msg = $error = "";

// Fetch user details
$query = mysqli_query($con, "SELECT * FROM users WHERE id = '$professor_id' AND role = 'professor'");
$professor = mysqli_fetch_assoc($query);

if (!$professor) {
    $error = "Unable to fetch profile details. Please contact the administrator.";
}

// Handle profile update
if (isset($_POST['update_details'])) {
    $full_name = htmlspecialchars($_POST['full_name'], ENT_QUOTES, 'UTF-8');
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate if password update is requested
    if (!empty($current_password) && !empty($new_password) && !empty($confirm_password)) {
        // Check if the current password is correct
        if (!password_verify($current_password, $professor['password'])) {
            $error = "Current password is incorrect.";
        } elseif ($new_password !== $confirm_password) {
            $error = "New passwords do not match.";
        } else {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            
            // Update user password
            $update_query = "UPDATE users SET full_name = ?, password = ? WHERE id = ?";
            $stmt = $con->prepare($update_query);
            $stmt->bind_param("ssi", $full_name, $hashed_password, $professor_id);
            if ($stmt->execute()) {
                $msg = "Profile updated successfully!";
            } else {
                $error = "Error updating profile: " . $stmt->error;
            }
        }
    } else {
        // Update full name only if no password change
        $update_query = "UPDATE users SET full_name = ? WHERE id = ?";
        $stmt = $con->prepare($update_query);
        $stmt->bind_param("si", $full_name, $professor_id);
        if ($stmt->execute()) {
            $msg = "Profile updated successfully!";
        } else {
            $error = "Error updating profile: " . $stmt->error;
        }
    }
}

// Handle profile image update (unchanged from your code)
if (isset($_POST['update_profile_image'])) {
    $current_image = $professor['profile_image'];
    $default_image_path = "./assets/profile-images/default-profile.png"; 
    $image_folder = './assets/profile-images/';

    if (!is_dir($image_folder)) {
        mkdir($image_folder, 0777, true);
    }

    if (!empty($_FILES["profile_image"]["name"])) {
        $imgfile = $_FILES["profile_image"]["name"];
        $extension = pathinfo($imgfile, PATHINFO_EXTENSION);
        $valid_extensions = ["jpg", "jpeg", "png", "gif"];

        if (in_array($extension, $valid_extensions)) {
            $unique_id = uniqid();
            $profile_image = "profile_" . $unique_id . "." . $extension;
            $target_path = $image_folder . $profile_image;

            if (!empty($current_image) && $current_image !== $default_image_path && file_exists($current_image)) {
                unlink($current_image);
            }

            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_path)) {
                $profile_image_db = $target_path;

                $update_users_query = "UPDATE users SET profile_image = '$profile_image_db' WHERE id = '$professor_id' AND role = 'professor'";
                $update_professors_query = "UPDATE professors SET profile_image = '$profile_image_db' WHERE id = '$professor_id'";

                if (mysqli_query($con, $update_users_query) && mysqli_query($con, $update_professors_query)) {
                    $msg = "Profile image updated successfully!";
                    $professor['profile_image'] = $profile_image_db;
                } else {
                    $error = "Failed to update profile image in the database: " . mysqli_error($con);
                }
            } else {
                $error = "Failed to upload the profile image.";
            }
        } else {
            $error = "Invalid file format. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    } else {
        $profile_image_db = $default_image_path;
        $update_users_query = "UPDATE users SET profile_image = '$profile_image_db' WHERE id = '$professor_id' AND role = 'professor'";
        $update_professors_query = "UPDATE professors SET profile_image = '$profile_image_db' WHERE id = '$professor_id'";

        if (mysqli_query($con, $update_users_query) && mysqli_query($con, $update_professors_query)) {
            $msg = "Profile image reverted to default successfully!";
            $professor['profile_image'] = $profile_image_db;
        } else {
            $error = "Failed to update the profile image to default: " . mysqli_error($con);
        }
    }
}
?>

<!-- HTML -->
<?php include('includes/topheader.php'); ?>
<?php include('includes/leftsidebar.php'); ?>


<?php if (!empty($msg)) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $msg; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <!-- Auto-hide the alert after 3 seconds -->
    <script>
        setTimeout(function() {
            document.querySelector('.alert').style.display = 'none';
        }, 3000);
    </script>
<?php endif; ?>

<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">My Profile</h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">My Profile</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <!-- Display messages -->
            <?php if ($msg) { ?>
                <div class="alert alert-success mt-3"><?php echo $msg; ?></div>
            <?php } elseif ($error) { ?>
                <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
            <?php } ?>

            <?php if ($professor) { ?>
                <!-- User Details Form -->
                <div class="user-profile">
                    <h4>User Details</h4>
                    <form method="POST">
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" name="full_name" class="form-control" 
                                   value="<?php echo htmlentities($professor['full_name']); ?>" required>
                        </div>
                        
                        <!-- Password Update Fields -->
                        <h4>Change Password</h4>
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" name="current_password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm New Password</label>
                            <input type="password" name="confirm_password" class="form-control">
                        </div>

                        <button type="submit" name="update_details" class="btn btn-primary">Update Details</button>
                    </form>
                </div>

                <!-- Profile Image Update -->
                <form method="POST" enctype="multipart/form-data" class="mt-3">
                    <div class="form-group">
                        <label for="profile_image">Profile Image</label>
                        <input type="file" name="profile_image" class="form-control">
                        <img src="<?php echo htmlentities($professor['profile_image'] ?? './assets/profile-images/default-profile.png'); ?>" 
                             alt="Profile Image" style="width: 100px; height: 100px; margin-top: 10px;">
                    </div>
                    <button type="submit" name="update_profile_image" class="btn btn-primary">Update Profile Image</button>
                </form>
            <?php } ?>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
</div>
