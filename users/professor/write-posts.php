<?php
session_start();
include('includes/config.php');

// Handle post submission
if (isset($_POST['submit'])) {
    $posttext = isset($_POST['posttext']) ? $_POST['posttext'] : null;

    // Handle file upload
    $postimage = null;
    if (!empty($_FILES["postimage"]["name"])) {
        $imgfile = $_FILES["postimage"]["name"];
        $extension = pathinfo($imgfile, PATHINFO_EXTENSION);
        $valid_extensions = array("jpg", "jpeg", "png", "gif");

        if (in_array($extension, $valid_extensions)) {
            // Ensure target directory exists
            $target_dir = "./assets/professors_updates/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
            }

            // Define the new image file name
            $postimage = uniqid() . "." . $extension;
            $target_file = $target_dir . $postimage;

            // Move the uploaded file
            if (move_uploaded_file($_FILES["postimage"]["tmp_name"], $target_file)) {
                // File successfully uploaded
            } else {
                $_SESSION['error'] = "There was an error uploading the file.";
            }
        } else {
            $_SESSION['error'] = "Invalid file format. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    }

    // Validate at least one field is filled
    if (empty($posttext) && empty($postimage)) {
        $_SESSION['error'] = "Please provide either text content or an image.";
    } else {
        // Insert into database
        $query = mysqli_query($con, "INSERT INTO professors_post (PostText, PostImage, created_at) 
            VALUES ('$posttext', '$postimage', NOW())");

        if ($query) {
            $_SESSION['msg'] = "Post successfully added!";
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again.";
        }
    }
}

// Handle post deletion
if (isset($_GET['delete_post_id'])) {
    $post_id = $_GET['delete_post_id'];

    // First, check if the post exists and fetch the post image (if exists)
    $query = mysqli_query($con, "SELECT PostImage FROM professors_post WHERE id = '$post_id'");
    $row = mysqli_fetch_assoc($query);

    if ($row && isset($row['PostImage']) && !empty($row['PostImage'])) {
        // If a post image exists, proceed with file deletion
        $post_image_path = './assets/professors_updates/' . $row['PostImage'];

        // Check if it's a valid file before unlinking
        if (file_exists($post_image_path) && !is_dir($post_image_path)) {
            unlink($post_image_path); // Delete the image from the server
        }
    }

    // Now, delete the post from the database
    $delete_query = mysqli_query($con, "DELETE FROM professors_post WHERE id = '$post_id'");

    if ($delete_query) {
        $_SESSION['msg'] = "Post successfully deleted!";
    } else {
        $_SESSION['error'] = "Failed to delete the post. Please try again.";
    }
}

// Fetch professor details
try {
    // Query to fetch professor's name and profile image
    $query = "SELECT full_name, profile_image FROM professors LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $full_name = $row['full_name'];
        $profile_image = $row['profile_image'];
    }
} catch (Exception $e) {
    // Log the error and fallback to default value
    error_log("Error fetching professor name: " . $e->getMessage());
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
                        <h4 class="page-title">Newsfeed</h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Newsfeed</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>


            <!-- Display success or error message -->
            <?php if (isset($_SESSION['msg'])): ?>
                <div class="alert alert-success" id="success-msg">
                    <?php
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']); // Clear message after displaying
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger" id="error-msg">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']); // Clear message after displaying
                    ?>
                </div>
            <?php endif; ?>

            <script>
                // Hide success message after 2 seconds
                setTimeout(function() {
                    var successMsg = document.getElementById("success-msg");
                    if (successMsg) {
                        successMsg.style.display = "none";
                    }
                }, 2000);

                // Hide error message after 2 seconds
                setTimeout(function() {
                    var errorMsg = document.getElementById("error-msg");
                    if (errorMsg) {
                        errorMsg.style.display = "none";
                    }
                }, 2000);
            </script>



            <!-- Newsfeed Posts -->
            <div class="container py-5">
                <div class="row justify-content-center">
                    <!-- Form to Add Post -->
                    <form name="addpost" method="post" class="row mb-4" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="posttext" class="text-dark">Post Text (Optional)</label>
                                <textarea class="form-control" id="posttext" name="posttext" rows="5" placeholder="Share your thoughts..."></textarea>
                            </div>

                            <div class="form-group">
                                <input type="file" class="form-control-file" id="postimage" name="postimage" accept="image/*">
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block mt-3">Post</button>
                        </div>
                    </form>

                    <?php
                    // Fetch posts from the database
                    $query = mysqli_query($con, "SELECT id, PostText as content, PostImage as image, created_at FROM professors_post ORDER BY created_at DESC");
                    $rowcount = mysqli_num_rows($query);

                    if ($rowcount == 0) {
                    ?>
                        <div class="col-12 text-center">
                            <h3 style="color:red">No posts found</h3>
                        </div>
                        <?php
                    } else {
                        while ($row = mysqli_fetch_array($query)) {
                            // Set default profile image if not available
                            $profileImagePath = $profile_image ? './assets/profile_image/' . htmlentities($profile_image) : './assets/profile_image/default.jpg';
                        ?>

                            <br><br>

                            <!-- New Post UI -->
                            <section class="mb-4 mt-2">
                                <div class="card shadow-sm rounded-lg">
                                    <div class="card-body">
                                        <!-- Post Header -->
                                        <div class="mb-3 align-items-center">
                                            <div class="">
                                                <div>
                                                    <img src="<?php echo $profileImagePath; ?>" class="border rounded-circle me-2" alt="Avatar" style="height: 40px; width:auto" />
                                                    <strong><?php echo htmlentities($full_name); ?></strong>
                                                    <div class="text-muted d-block" style="margin-top: -6px">
                                                        <small><?php echo htmlentities($row['created_at']); ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Three dots icon with toggle delete button aligned to the right -->
                                            <div class="text-right">
                                                <button class="btn btn-link" onclick="toggleDelete(<?php echo $row['id']; ?>)">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div id="delete-btn-<?php echo $row['id']; ?>" class="delete-btn" style="display: none;">
                                                    <a href="?delete_post_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete Post</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <?php if (!empty($row['content'])) { ?>
                                                <p class="text-dark" style="font-size: 16px;"><?php echo htmlentities($row['content']); ?></p>
                                            <?php } ?>
                                        </div>

                                    </div>

                                    <!-- Media -->
                                    <?php if (!empty($row['image'])) { ?>
                                        <div class="bg-image hover-overlay ripple rounded-0" data-mdb-ripple-color="light">
                                            <img src="./assets/professors_updates/<?php echo htmlentities($row['image']); ?>" class="w-100 rounded" />
                                            <a href="#!">
                                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>

                                <!-- Reactions -->
                                <div class="card-body">
                                    <div class="d-flex justify-content-between text-center border-top border-bottom mb-4">
                                        <button type="button" class="btn btn-link btn-lg" data-mdb-ripple-color="dark">
                                            <i class="fas fa-thumbs-up me-2"></i>Like
                                        </button>
                                        <button type="button" class="btn btn-link btn-lg comment-btn" data-mdb-ripple-color="dark">
                                            <i class="fas fa-comment-alt me-2"></i>Comment
                                        </button>
                                        <button type="button" class="btn btn-link btn-lg" data-mdb-ripple-color="dark">
                                            <i class="fas fa-share me-2"></i>Share
                                        </button>
                                    </div>
                                </div>
                </div>
                <!-- Comments Section (below the reactions) -->
                <div class="comments-section" id="comments-<?php echo $row['id']; ?>" style="padding: 15px; background-color: #f8f9fa;">
                    <div class="comment-list" id="comment-list-<?php echo $row['id']; ?>"></div>
                    <textarea class="form-control" id="commentText-<?php echo $row['id']; ?>" rows="3" placeholder="Write a comment..."></textarea>
                    <button type="button" class="btn btn-primary mt-2" id="submitComment-<?php echo $row['id']; ?>">Post Comment</button>
                </div>
                </section>
        <?php }
                    } ?>
            </div>
        </div>
    </div>
    <!-- End Newsfeed Posts -->


    <!-- JavaScript to toggle delete button visibility -->
    <script>
        function toggleDelete(postId) {
            var deleteButton = document.getElementById('delete-btn-' + postId);
            deleteButton.style.display = (deleteButton.style.display === 'none' || deleteButton.style.display === '') ? 'block' : 'none';
        }
    </script>
</div>

<?php include('includes/footer.php'); ?>