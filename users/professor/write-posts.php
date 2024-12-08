<?php
session_start();
include('includes/config.php');

// Ensure user is logged in and fetch their role
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch the user's role
$result = mysqli_query($con, "SELECT role FROM users WHERE id = '$user_id'");
$user = mysqli_fetch_assoc($result);
if (!$user || $user['role'] !== 'professor') {
    $_SESSION['error'] = "Access denied. Only professors can post.";
    header('Location: dashboard.php');
    exit();
}

// Handle post submission
if (isset($_POST['submit'])) {
    $posttext = isset($_POST['posttext']) ? $_POST['posttext'] : null;
    $postimage = null;

    if (!empty($_FILES["postimage"]["name"])) {
        $imgfile = $_FILES["postimage"]["name"];
        $extension = pathinfo($imgfile, PATHINFO_EXTENSION);
        $valid_extensions = ["jpg", "jpeg", "png", "gif"];

        if (in_array($extension, $valid_extensions)) {
            $target_dir = "./assets/professors_updates/";
            if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
            $postimage = uniqid() . "." . $extension;
            $target_file = $target_dir . $postimage;

            if (!move_uploaded_file($_FILES["postimage"]["tmp_name"], $target_file)) {
                $_SESSION['error'] = "There was an error uploading the file.";
            }
        } else {
            $_SESSION['error'] = "Invalid file format. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    }

    if (empty($posttext) && empty($postimage)) {
        $_SESSION['error'] = "Please provide either text content or an image.";
    } else {
        $query = mysqli_query($con, "INSERT INTO professors_post (user_id, PostText, PostImage, created_at) VALUES ('$user_id', '$posttext', '$postimage', NOW())");
        $_SESSION['msg'] = $query ? "Post successfully added!" : "Something went wrong. Please try again.";
    }
}

// Handle post update
if (isset($_POST['edit_post'])) {
    $post_id = $_POST['edit_post_id'];
    $posttext = $_POST['edit_posttext'];
    $edit_image = null;

    if (!empty($_FILES["edit_postimage"]["name"])) {
        $imgfile = $_FILES["edit_postimage"]["name"];
        $extension = pathinfo($imgfile, PATHINFO_EXTENSION);
        $valid_extensions = ["jpg", "jpeg", "png", "gif"];

        if (in_array($extension, $valid_extensions)) {
            $target_dir = "./assets/professors_updates/";
            if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
            $edit_image = uniqid() . "." . $extension;
            $target_file = $target_dir . $edit_image;

            if (!move_uploaded_file($_FILES["edit_postimage"]["tmp_name"], $target_file)) {
                $_SESSION['error'] = "There was an error uploading the file.";
            }
        } else {
            $_SESSION['error'] = "Invalid file format. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    }

    if (!empty($posttext) || !empty($edit_image)) {
        $update_query = "UPDATE professors_post SET PostText = '$posttext'";
        if (!empty($edit_image)) $update_query .= ", PostImage = '$edit_image'";
        $update_query .= " WHERE id = '$post_id' AND user_id = '$user_id'";

        $query = mysqli_query($con, $update_query);
        $_SESSION['msg'] = $query ? "Post successfully updated!" : "Failed to update the post.";
    } else {
        $_SESSION['error'] = "Please provide content or an image.";
    }
}


// Handle post deletion
if (isset($_GET['delete_post_id'])) {
    $post_id = $_GET['delete_post_id'];

    // Ensure the post belongs to the current professor
    $query = mysqli_query($con, "SELECT PostImage FROM professors_post WHERE id = '$post_id' AND user_id = '$user_id'");
    $row = mysqli_fetch_assoc($query);

    if ($row && isset($row['PostImage']) && !empty($row['PostImage'])) {
        // Delete post image from server
        $post_image_path = './assets/professors_updates/' . $row['PostImage'];
        if (file_exists($post_image_path) && !is_dir($post_image_path)) {
            unlink($post_image_path);
        }
    }

    // Delete the post from the database
    $delete_query = mysqli_query($con, "DELETE FROM professors_post WHERE id = '$post_id' AND user_id = '$user_id'");

    if ($delete_query) {
        $_SESSION['msg'] = "Post successfully deleted!";
    } else {
        $_SESSION['error'] = "Failed to delete the post. Please try again.";
    }
}

// Fetch posts made by professors
$query = mysqli_query($con, "
    SELECT pp.id, pp.PostText as content, pp.PostImage as image, pp.created_at, u.full_name, u.profile_image 
    FROM professors_post pp
    INNER JOIN users u ON pp.user_id = u.id
    WHERE u.id = '$user_id'
    ORDER BY pp.created_at DESC
");
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
                    <div class="post-form">
                        <form name="addpost" method="post" class="row mb-4" enctype="multipart/form-data">
                            <div class="form-group">
                                <textarea class="form-control post-textarea" id="posttext" name="posttext" rows="2" placeholder="What's on your mind?"></textarea>
                            </div>
                            <div class="form-actions">
                                <label for="postimage" class="upload-btn">
                                    <i class="fa fa-image"></i> Add Photo
                                    <input type="file" id="postimage" name="postimage" accept="image/*" hidden>
                                </label>
                                <button type="submit" name="submit" class="btn btn-primary">Post</button>
                            </div>
                            <!-- Image Preview -->
                            <div id="imagePreviewContainer" class="mt-3" style="display: none;">
                                <img id="imagePreview" src="#" alt="Image Preview" class="img-fluid rounded" style="max-height: 300px; object-fit: cover;">
                            </div>
                        </form>
                    </div>

                    <!-- JavaScript for Image Preview -->
                    <script>
                        const postImageInput = document.getElementById('postimage');
                        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
                        const imagePreview = document.getElementById('imagePreview');

                        postImageInput.addEventListener('change', function(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    imagePreview.src = e.target.result;
                                    imagePreviewContainer.style.display = 'block';
                                };
                                reader.readAsDataURL(file);
                            } else {
                                imagePreviewContainer.style.display = 'none';
                            }
                        });
                    </script>

                    <style>
                        .post-form {
                            background: #fff;
                            border: 1px solid #ddd;
                            border-radius: 10px;
                            padding: 15px;
                            width: 100%;
                            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                        }

                        .post-textarea {
                            width: 100%;
                            border: 1px solid #ddd;
                            border-radius: 10px;
                            padding: 10px;
                            font-size: 14px;
                            outline: none;
                            resize: none;
                            margin-bottom: 10px;
                            font-family: 'Arial', sans-serif;
                        }

                        .post-textarea::placeholder {
                            color: #888;
                        }

                        .form-actions {
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                        }

                        .upload-btn {
                            display: inline-flex;
                            align-items: center;
                            background: #f1f1f1;
                            border: 1px solid #ddd;
                            border-radius: 20px;
                            padding: 8px 15px;
                            font-size: 14px;
                            color: #444;
                            cursor: pointer;
                            transition: background 0.3s, color 0.3s;
                        }

                        .upload-btn:hover {
                            background: #eaeaea;
                            color: #000;
                        }

                        .upload-btn i {
                            margin-right: 8px;
                            font-size: 16px;
                        }

                        .btn-primary {
                            background-color: #007bff;
                            border: none;
                            border-radius: 20px;
                            padding: 8px 20px;
                            color: white;
                            font-size: 14px;
                            cursor: pointer;
                            transition: background 0.3s ease;
                        }

                        .btn-primary:hover {
                            background-color: #0056b3;
                        }
                    </style>


                    <?php
                    // Fetch posts made by the logged-in professor
                    $query = mysqli_query($con, "
    SELECT pp.id, pp.PostText as content, pp.PostImage as image, pp.created_at, u.full_name, u.profile_image 
    FROM professors_post pp
    INNER JOIN users u ON pp.user_id = u.id
    WHERE u.id = '$user_id'
    ORDER BY pp.created_at DESC
");

                    $rowcount = mysqli_num_rows($query);

                    if ($rowcount == 0) {
                    ?>
                        <div class="col-12 text-center">
                            <h3 style="color:red">No posts found</h3>
                        </div>
                        <?php
                    } else {
                        while ($row = mysqli_fetch_array($query)) {
                            // Set profile image path
                            $profileImagePath = !empty($row['profile_image'])
                                ? './assets/profile-images/' . htmlentities($row['profile_image'])
                                : './assets/profile-images/default-profile.png';
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
                                                    <strong><?php echo htmlentities($row['full_name']); ?></strong>
                                                    <div class="text-muted d-block" style="margin-top: -6px">
                                                        <small><?php echo htmlentities($row['created_at']); ?></small>

                                                    </div>
                                                </div>
                                                <!-- Three dots icon with toggle delete button aligned to the right -->
                                                <div class="text-right">
                                                    <button class="btn btn-link" onclick="toggleDelete(<?php echo $row['id']; ?>)">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <div id="delete-btn-<?php echo $row['id']; ?>" class="delete-btn" style="display: none;">
                                                        <a href="?delete_post_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete Post</a>
                                                        <button class="btn btn-primary btn-sm" onclick="openEditModal('<?php echo $row['id']; ?>', '<?php echo htmlentities($row['content']); ?>')">Edit Post</button>
                                                    </div>
                                                </div>

                                            </div>

                                            <div>
                                                <?php if (!empty($row['content'])) { ?>
                                                    <p class="text-dark" style="font-size: 16px;"><?php echo htmlentities($row['content']); ?></p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="post-content" style="align-items:center; margin:auto; margin-left: 20%;">

                                            <!-- Media -->
                                            <?php if (!empty($row['image'])) { ?>
                                                <div class="bg-image hover-overlay ripple rounded-0" data-mdb-ripple-color="light">
                                                    <img src="./assets/professors_updates/<?php echo htmlentities($row['image']); ?>" class="w-30 rounded" style="height:500px; width: 7    0%; " />
                                                    <a href="#!">
                                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>
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


       <!-- Edit Post Modal -->
<div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="editPostModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPostModalLabel">Edit Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="edit_post_id" id="edit_post_id">
                    <div class="form-group">
                        <label for="edit_posttext">Edit Content</label>
                        <textarea class="form-control" name="edit_posttext" id="edit_posttext" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_postimage">Change Photo</label>
                        <input type="file" class="form-control-file" name="edit_postimage" id="edit_postimage" accept="image/*">
                    </div>
                    <!-- Image Preview -->
                    <div id="editImagePreviewContainer" class="text-center mt-3" style="display: none;">
                        <img id="editImagePreview" src="#" alt="Image Preview" class="img-fluid rounded" style="max-height: 300px; object-fit: cover;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="edit_post" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Function to preview image when editing a post
    document.getElementById('edit_postimage').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('editImagePreviewContainer');
        const previewImage = document.getElementById('editImagePreview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewContainer.style.display = 'block';
                previewImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
            previewImage.src = '#';
        }
    });

    // Function to open the edit modal and populate existing data
    function openEditModal(postId, content, imageSrc) {
        document.getElementById('edit_post_id').value = postId;
        document.getElementById('edit_posttext').value = content;

        const previewContainer = document.getElementById('editImagePreviewContainer');
        const previewImage = document.getElementById('editImagePreview');

        if (imageSrc) {
            previewContainer.style.display = 'block';
            previewImage.src = imageSrc;
        } else {
            previewContainer.style.display = 'none';
            previewImage.src = '#';
        }

        $('#editPostModal').modal('show');
    }
</script>




        <!-- JavaScript to toggle delete button visibility -->
        <script>
            function toggleDelete(postId) {
                var deleteButton = document.getElementById('delete-btn-' + postId);
                deleteButton.style.display = (deleteButton.style.display === 'none' || deleteButton.style.display === '') ? 'block' : 'none';
            }
        </script>
    </div>

    <?php include('includes/footer.php'); ?>