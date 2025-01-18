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

// Fetch user details from the 'users' table where role is 'professor'
$query = mysqli_query($con, "SELECT * FROM users WHERE id = '$professor_id' AND role = 'professor'");
$professor = mysqli_fetch_assoc($query);

if (!$professor) {
    $error = "Unable to fetch profile details. Please contact the administrator.";
}

// Synchronize the professors table: Add missing entries
$sync_query = "
    INSERT INTO professors (id, full_name, email, profile_image, year_level)
    SELECT u.id, u.full_name, u.email, 
           IFNULL(u.profile_image, './assets/profile-images/default-profile.png') AS profile_image, 
           IFNULL(u.year_level, 'Unassigned') AS year_level
    FROM users u
    WHERE u.role = 'professor'
    ON DUPLICATE KEY UPDATE
        full_name = VALUES(full_name),
        email = VALUES(email),
        profile_image = VALUES(profile_image),
        year_level = VALUES(year_level)
";
mysqli_query($con, $sync_query);

// Update profile image
if (isset($_POST['update_profile_image'])) {
    $current_image = $professor['profile_image'];
    $default_image_path = "./assets/profile-images/default-profile.png"; // Full path for default image
    $image_folder = './assets/profile-images/';

    // Ensure the directory exists
    if (!is_dir($image_folder)) {
        mkdir($image_folder, 0777, true);
    }

    if (!empty($_FILES["profile_image"]["name"])) {
        $imgfile = $_FILES["profile_image"]["name"];
        $extension = pathinfo($imgfile, PATHINFO_EXTENSION);
        $valid_extensions = array("jpg", "jpeg", "png", "gif");

        if (in_array($extension, $valid_extensions)) {
            // Generate a unique filename with the desired format
            $unique_id = uniqid();
            $profile_image = "profile_" . $unique_id . "." . $extension;
            $target_path = $image_folder . $profile_image; // Full file path

            // Delete the old profile image if it's not the default
            if (!empty($current_image) && $current_image !== $default_image_path) {
                $old_image_path = $current_image; // Full path is already saved in DB
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            }

            // Upload the new image
            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_path)) {
                // Save the full path in the database
                $profile_image_db = $target_path; // Full path to save

                // Update the database in both users and professors tables
                $update_users_query = "UPDATE users SET profile_image = '$profile_image_db' WHERE id = '$professor_id' AND role = 'professor'";
                $update_professors_query = "UPDATE professors SET profile_image = '$profile_image_db' WHERE id = '$professor_id'";

                if (mysqli_query($con, $update_users_query) && mysqli_query($con, $update_professors_query)) {
                    $msg = "Profile image updated successfully!";
                    $professor['profile_image'] = $profile_image_db;
                } else {
                    $error = "Failed to update profile image in the database: " . mysqli_error($con);
                }
            } else {
                $error = "Failed to upload the profile image. Please check folder permissions.";
            }
        } else {
            $error = "Invalid file format. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    } else {
        // If no new file is uploaded, revert to default image
        $profile_image_db = $default_image_path;

        // Update the database in both users and professors tables
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

<!-- Start right Content here -->
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

            <!-- Display success/error messages -->
            <?php if ($msg) { ?>
                <div class="alert alert-success mt-3" role="alert">
                    <?php echo $msg; ?>
                </div>
            <?php } elseif ($error) { ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php } ?>



            <?php if ($professor) { ?>
                <!-- Display user details -->
                <div class="user-profile">
                    <h4>User Details</h4>
                    <form method="POST">
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" name="full_name" class="form-control" value="<?php echo htmlentities($professor['full_name']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" name="password" class="form-control" value="<?php echo htmlentities($professor['password']); ?>" required>
                        </div>
                        <button type="submit" name="update_details" class="btn btn-primary">Update Details</button>
                    </form>
                </div>
                <!-- Profile image section -->
                <form method="POST" enctype="multipart/form-data" class="mt-3">
                    <div class="form-group">
                        <label for="profile_image">Profile Image</label>
                        <input type="file" name="profile_image" class="form-control">
                        <?php
                        // Use the full path directly from the database
                        $profile_image = !empty($professor['profile_image'])
                            ? htmlentities($professor['profile_image'])
                            : './assets/profile-images/default-profile.png';
                        ?>
                        <img src="<?php echo $profile_image; ?>" alt="Profile Image" style="width: 100px; height: 100px; margin-top: 10px;">
                    </div>
                    <button type="submit" name="update_profile_image" class="btn btn-primary">Update Profile Image</button>
                </form>




            <?php } ?>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>
</div>