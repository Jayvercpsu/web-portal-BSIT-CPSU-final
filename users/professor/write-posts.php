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




if (isset($_POST['submit'])) {
    // Sanitize inputs
    $posttext = isset($_POST['posttext']) ? mysqli_real_escape_string($con, $_POST['posttext']) : null;
    $postimage = null;

    // Check if an image is uploaded
    if (!empty($_FILES["postimage"]["name"])) {
        $imgfile = $_FILES["postimage"]["name"];
        $extension = pathinfo($imgfile, PATHINFO_EXTENSION);
        $valid_extensions = ["jpg", "jpeg", "png", "gif"];

        // Validate file type
        if (in_array($extension, $valid_extensions)) {
            $target_dir = "./assets/professors_updates/"; // Set the upload directory
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
            }

            // Generate a unique filename for the image
            $postimage = uniqid() . "." . $extension;
            $target_file = $target_dir . $postimage;

            // Move the uploaded file to the target directory
            if (!move_uploaded_file($_FILES["postimage"]["tmp_name"], $target_file)) {
                $_SESSION['error'] = "There was an error uploading the file.";
            }
        } else {
            $_SESSION['error'] = "Invalid file format. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    }

    // Ensure that there's either text or an image
    if (empty($posttext) && empty($postimage)) {
        $_SESSION['error'] = "Please provide either text content or an image.";
    } else {
        // Save the full path for the image in the database (save just the image name)
        $full_image_path = $postimage; // Don't store the full path, just the image name

        // Insert the post into the database
        $query = mysqli_query($con, "INSERT INTO professors_post (user_id, PostText, PostImage, created_at) 
                                     VALUES ('$user_id', '$posttext', '$full_image_path', NOW())");

        if ($query) {
            $_SESSION['msg'] = "Post successfully added!";
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again.";
        }
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
<link rel="stylesheet" href="./assets/css/write-posts.css">

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


            <?php include('includes/newsfeed/display-sucess-msg.php') ?>


            <!-- Newsfeed Posts -->
            <div class="container py-5">
                <div class="row justify-content-center">

                    <?php include('includes/newsfeed/newsfeed-addpost.php') ?>
                    <?php
                    // Fetch posts made by the logged-in professor
                    $query = mysqli_query($con, "
    SELECT 
        pp.id, 
        pp.PostText AS content, 
        pp.PostImage AS image, 
        pp.created_at, 
        u.full_name, 
        u.profile_image 
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
                        while ($row = mysqli_fetch_assoc($query)) {
                            // Use the profile_image directly from the database, or fallback to the default image
                            $profileImagePath = !empty($row['profile_image'])
                                ? htmlentities($row['profile_image'])
                                : './assets/profile-images/default-profile.png';

                            // Check if the user has liked this post
                            $like_check_query = mysqli_query($con, "SELECT * FROM like_reactions WHERE user_id = '$user_id' AND post_id = '{$row['id']}'");
                            $is_liked = mysqli_num_rows($like_check_query) > 0;

                            // Get the total number of likes for the post
                            $like_count_query = mysqli_query($con, "SELECT COUNT(*) AS total_likes FROM like_reactions WHERE post_id = '{$row['id']}'");
                            $like_count = mysqli_fetch_assoc($like_count_query)['total_likes'] ?? 0;

                            // Fetch total number of comments for the current post
                            $comment_count_query = mysqli_query($con, "SELECT COUNT(*) AS total_comments FROM student_comments WHERE post_id = '{$row['id']}'");
                            $comment_count = mysqli_fetch_assoc($comment_count_query)['total_comments'] ?? 0;
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

                                                <script>
                                                    function toggleDelete(postId) {
                                                        const deleteBtn = document.getElementById(`delete-btn-${postId}`);

                                                        // Check if the delete button is currently visible or hidden and toggle it
                                                        if (deleteBtn.style.display === 'none' || deleteBtn.style.display === '') {
                                                            deleteBtn.style.display = 'block'; // Show the delete button
                                                        } else {
                                                            deleteBtn.style.display = 'none'; // Hide the delete button
                                                        }
                                                    }
                                                </script>
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
                                                    <img src="./assets/professors_updates/<?php echo htmlentities($row['image']); ?>" class="w-30 rounded" style="height:500px; width: 70%;" />
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


                                            <button type="button" class="btn btn-link btn-lg" id="likeBtn-<?php echo $row['id']; ?>" onclick="toggleLike(<?php echo $row['id']; ?>)">
                                                <i class="fas fa-thumbs-up me-2" id="likeIcon-<?php echo $row['id']; ?>"></i>Like
                                                <span id="likeCount-<?php echo $row['id']; ?>" class="like-count mx-2"><?php echo $like_count; ?></span>
                                            </button>



                                            <button type="button" class="btn btn-link btn-lg comment-btn" onclick="toggleComments(<?php echo $row['id']; ?>)">
                                                <i class="fas fa-comment-alt me-2"></i>Comment (<?php echo $comment_count; ?>)
                                            </button>
                                            <button type="button" class="btn btn-link btn-lg">
                                                <i class="fas fa-share me-2"></i>Share
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Comments Section -->
                                    <div class="comments-section" id="comments-<?php echo $row['id']; ?>" style="display: none; padding: 15px; background-color: #f8f9fa;">
                                        <textarea class="form-control mt-3" id="commentText-<?php echo $row['id']; ?>" rows="3" placeholder="Write a comment..."></textarea>
                                        <div class="comment-list" id="comment-list-<?php echo $row['id']; ?>"></div>
                                        <button type="button" class="btn btn-primary mt-2" onclick="submitProfessorComment(<?php echo $row['id']; ?>)">Post Comment</button>
                                        <button type="button" class="btn btn-link load-more-comments" id="loadMore-<?php echo $row['id']; ?>" onclick="loadMoreComments(<?php echo $row['id']; ?>)">
                                            Load More Comments
                                        </button>

                                        <button type="button" class="btn btn-secondary mt-2" onclick="hideComments(<?php echo $row['id']; ?>)">Hide Comments</button>
                                    </div>

                                    <script>
                                        const commentOffsets = {}; // Track offsets for each post ID

                                        function toggleComments(postId) {
                                            const commentsSection = document.getElementById(`comments-${postId}`);
                                            commentsSection.style.display = commentsSection.style.display === 'none' ? 'block' : 'none';
                                        }

                                        function hideComments(postId) {
                                            const commentsSection = document.getElementById(`comments-${postId}`);
                                            commentsSection.style.display = 'none';
                                        }

                                        function loadMoreComments(postId) {
                                            const button = document.getElementById(`loadMore-${postId}`);
                                            const commentList = document.getElementById(`comment-list-${postId}`);

                                            if (!commentOffsets[postId]) commentOffsets[postId] = 0;

                                            const offset = commentOffsets[postId];
                                            const limit = 5;

                                            button.disabled = true;
                                            button.innerHTML = 'Loading...';

                                            fetch('fetch_comments.php', {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/x-www-form-urlencoded'
                                                    },
                                                    body: `post_id=${postId}&offset=${offset}`
                                                })
                                                .then(response => response.text())
                                                .then(data => {
                                                    if (data.trim()) {
                                                        commentList.insertAdjacentHTML('beforeend', data);
                                                        commentOffsets[postId] += limit;

                                                        if (data.split('<div class="comment').length - 1 < limit) {
                                                            button.style.display = 'none';
                                                        } else {
                                                            button.disabled = false;
                                                            button.innerHTML = 'Load More Comments';
                                                        }
                                                    } else {
                                                        button.style.display = 'none';
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error('Error loading comments:', error);
                                                    button.disabled = false;
                                                    button.innerHTML = 'Load More Comments';
                                                });
                                        }

                                        function submitProfessorComment(postId) {
                                            const commentText = document.getElementById(`commentText-${postId}`).value;

                                            if (commentText.trim() === '') {
                                                alert('Comment cannot be empty!');
                                                return;
                                            }

                                            fetch('submit_professor_comment.php', {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/x-www-form-urlencoded'
                                                    },
                                                    body: `post_id=${postId}&comment=${encodeURIComponent(commentText)}`
                                                })
                                                .then(response => response.text())
                                                .then(data => {
                                                    if (data === 'success') {
                                                        document.getElementById(`commentText-${postId}`).value = '';
                                                        document.getElementById(`comment-list-${postId}`).innerHTML = '';
                                                        commentOffsets[postId] = 0;
                                                        loadMoreComments(postId);
                                                    } else {
                                                        console.error('Error submitting comment:', data);
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error('Error:', error);
                                                });
                                        }
                                    </script>

                            </section>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
        <!-- End Newsfeed Posts -->
        <!-- AJAX to Toggle the Like Button -->
        <script>
            function toggleLike(postId) {
                $.ajax({
                    url: 'like_reactions.php',
                    type: 'POST',
                    data: {
                        post_id: postId
                    },
                    success: function(response) {
                        const data = JSON.parse(response);
                        const likeBtn = $('#likeBtn-' + postId);
                        const likeIcon = $('#likeIcon-' + postId);
                        const likeCount = $('#likeCount-' + postId);

                        if (data.status === 'success') {
                            if (data.action === 'liked') {
                                likeIcon.css('color', '#4b0082'); // Change color to purple
                            } else {
                                likeIcon.css('color', ''); // Reset color to default
                            }

                            likeCount.text(data.total_likes); // Update the like count
                        } else {
                            alert(data.message);
                        }
                    },
                    error: function() {
                        alert('Error processing your request');
                    }
                });
            }
        </script>

        <?php include('includes/newsfeed/edit-modal.php') ?>

    </div>

    <?php include('includes/footer.php'); ?>