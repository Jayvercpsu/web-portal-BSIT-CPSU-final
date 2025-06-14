<?php
session_start();
include('includes/config.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch the logged-in student's year level from the users table
$user_id = $_SESSION['user_id'];
$result = mysqli_query($con, "SELECT year FROM users WHERE id = '$user_id' AND role = 'student'");
$student = mysqli_fetch_assoc($result);
if (!$student) {
    $_SESSION['error'] = "Student data not found or invalid role.";
    header('Location: dashboard.php');
    exit();
}

$year_level = $student['year'];  // Get the student's year level

// Get professor user_id from the URL
$professor_id = isset($_GET['professor_id']) ? $_GET['professor_id'] : null;

if ($professor_id) {
    // Fetch professor posts for the selected professor using user_id
    $query = mysqli_query($con, "
        SELECT pp.id, pp.PostText as content, pp.PostImage as image, pp.created_at, u.full_name, u.profile_image 
        FROM professors_post pp
        INNER JOIN users u ON pp.user_id = u.id
        WHERE u.id = '$professor_id'
        ORDER BY pp.created_at DESC
    ");
} else {
    $_SESSION['error'] = "Professor ID is missing.";
    header('Location: my-professors.php');
    exit();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Student - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link
        href="vendor/fontawesome-free/css/all.min.css"
        rel="stylesheet"
        type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />

    <link rel="stylesheet" href="./assets/css/view-prof-updates.css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />
</head>

<body id="page-top">



    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include('includes/sidebar-dashboard.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <nav class="navbar navbar-expand-lg navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Navbar Title or Section Link -->
                    <div class="ml-auto">
                        <span class="navbar-text font-weight-bold" style="font-size: 1.2rem;">
                        My Professors Updates
                        </span>
                    </div>
                </nav>
                <!-- End of Topbar -->




                <div class="d-flex">
                    <div class="container bg-white shadow rounded flex-grow-1">
                        <a href="my-professors.php" class="d-flex align-items-center text-decoration-none p-2 rounded-lg back-link" style="color: #6a0dad;">
                            <i class="fa fa-long-arrow-left mr-2" style="font-size: 20px;"></i>
                            <span class="font-weight-bold">Back to My Professors</span>
                        </a>

                        <!-- Newsfeed Posts -->
                        <div class="newsfeed-container py-5">
                            <?php
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
                                    if (!empty($row['profile_image'])) {
                                        // Remove './assets/profile-images/' if it exists in the database value
                                        $cleaned_profile_image = str_replace('./assets/profile-images/', '', $row['profile_image']);
                                        $profileImagePath = '../professor/assets/profile-images/' . htmlentities($cleaned_profile_image);
                                    } else {
                                        // Use default profile image
                                        $profileImagePath = '../professor/assets/profile-images/default-profile.png';
                                    }


                                    // Check if the file exists on the server
                                    if (!file_exists(realpath($profileImagePath))) {
                                        // If the file doesn't exist, fall back to the default image
                                        $profileImagePath = '../professor/assets/profile-images/default-profile.png';
                                        echo '<pre>File does not exist. Using default profile image.</pre>';
                                    }


                                    // Check if the user has liked this post
                                    $like_check_query = mysqli_query($con, "SELECT * FROM like_reactions WHERE user_id = '$user_id' AND post_id = '{$row['id']}'");
                                    $is_liked = mysqli_num_rows($like_check_query) > 0;

                                    // Get the total number of likes for the post
                                    $like_count_query = mysqli_query($con, "SELECT COUNT(*) AS total_likes FROM like_reactions WHERE post_id = '{$row['id']}'");
                                    $like_count = mysqli_fetch_assoc($like_count_query)['total_likes'];

                                    // Fetch total number of comments for the current post
                                    $comment_count_query = mysqli_query($con, "SELECT COUNT(*) AS total_comments FROM student_comments WHERE post_id = '{$row['id']}'");
                                    $comment_count = mysqli_fetch_assoc($comment_count_query)['total_comments'];

                                ?>
                                    <br><br>

                                    <!-- New Post UI -->
                                    <section class="mb-4 mt-2">
                                        <div class="card shadow-sm rounded-lg">
                                            <div class="card-body">
                                                <!-- Post Header -->
                                                <div class="post-header">
                                                    <div class="d-flex align-items-center">
                                                        <img src="<?php echo $profileImagePath; ?>" alt="Avatar">
                                                        <strong><?php echo htmlentities($row['full_name']); ?></strong>
                                                        <div class="text-muted d-block ml-3">
                                                            <small><?php echo htmlentities($row['created_at']); ?></small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="post-content">
                                                    <?php if (!empty($row['content'])) { ?>
                                                        <p class="text-dark" style="font-size: 16px;"><?php echo htmlentities($row['content']); ?></p>
                                                    <?php } ?>
                                                </div>

                                                <!-- Post Image -->
                                                <?php if (!empty($row['image'])) { ?>
                                                    <div class="bg-image hover-overlay ripple rounded-0 d-flex justify-content-center" data-mdb-ripple-color="light">
                                                        <!-- Corrected this line and added a class for centering -->
                                                        <img src="../professor/assets/professors_updates/<?php echo htmlentities($row['image']); ?>" class="w-30 rounded" style="height:500px; width: 70%;" />
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <!-- Reactions Section -->
                                            <div class="card-body">
                                                <div class="d-flex justify-content-center align-items-center border-top border-bottom mb-4 gap-3">
                                                    <!-- Like Button -->
                                                    <button type="button" class="btn btn-link btn-lg" id="likeBtn-<?php echo $row['id']; ?>" onclick="toggleLike(<?php echo $row['id']; ?>)">
                                                        <i class="fas fa-thumbs-up me-2" id="likeIcon-<?php echo $row['id']; ?>"></i>Like <span id="likeCount-<?php echo $row['id']; ?>" class="like-count mx-2"><?php echo $like_count; ?></span>
                                                    </button>


                                                    <!-- Comment Button -->
                                                    <button type="button" class="btn btn-link btn-lg comment-btn" onclick="toggleComments(<?php echo $row['id']; ?>)">
                                                        <i class="fas fa-comment-alt me-2"></i>Comment (<?php echo $comment_count; ?>)
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Comments Section -->
                                            <div class="comments-section" id="comments-<?php echo $row['id']; ?>" style="display: none;">
                                                <!-- Student Comment Form -->
                                                <?php if ($_SESSION['role'] === 'student') : ?>
                                                    <textarea class="form-control comment-textarea" id="commentText-<?php echo $row['id']; ?>" rows="3" placeholder="Write a comment..."></textarea>
                                                    <button type="button" class="btn btn-custom mt-2" onclick="submitStudentComment(<?php echo $row['id']; ?>)">Post Comment</button>
                                                <?php else : ?>
                                                    <p>You must be a student to post a comment.</p>
                                                <?php endif; ?>

                                                <!-- Comments List -->
                                                <div class="comment-list" id="comment-list-<?php echo $row['id']; ?>">
                                                    <!-- Comments will be dynamically loaded here -->
                                                </div>

                                                <!-- Load More Comments Button -->
                                                <button type="button" class="btn btn-link load-more-comments" id="loadMore-<?php echo $row['id']; ?>" onclick="loadMoreComments(<?php echo $row['id']; ?>)">
                                                    Load More Comments
                                                </button>

                                                <!-- Hide Comments Button -->
                                                <button type="button" class="btn btn-link hide-comments" id="hideComments-<?php echo $row['id']; ?>" onclick="hideComments(<?php echo $row['id']; ?>)">
                                                    Hide Comments
                                                </button>
                                            </div>



                                            <script>
                                                const commentOffsets = {}; // To track offsets for each post ID

                                                // Toggle comments
                                                function toggleComments(postId) {
                                                    var commentSection = document.getElementById('comments-' + postId);
                                                    var commentList = document.getElementById('comment-list-' + postId);
                                                    var loadMoreButton = document.getElementById(`loadMore-${postId}`);

                                                    if (commentSection.style.display === 'none' || commentList.innerHTML.trim() === '') {
                                                        commentSection.style.display = 'block';

                                                        // Reset offset when toggling comments
                                                        commentOffsets[postId] = 0;

                                                        // Clear previous comments before loading to prevent duplicates
                                                        commentList.innerHTML = '';

                                                        fetchComments(postId, true); // Load initial comments
                                                    } else {
                                                        commentSection.style.display = 'none';
                                                    }
                                                }

                                                // Fetch comments via AJAX
                                                function fetchComments(postId, reset = false) {
                                                    const commentList = document.getElementById(`comment-list-${postId}`);
                                                    const button = document.getElementById(`loadMore-${postId}`);

                                                    if (reset) commentOffsets[postId] = 0; // Reset offset on first load

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
                                                                if (reset) {
                                                                    commentList.innerHTML = data; // Replace old comments on reset
                                                                } else {
                                                                    commentList.insertAdjacentHTML('beforeend', data); // Append new comments
                                                                }

                                                                commentOffsets[postId] += limit; // Update offset

                                                                // Hide "Load More" button if no more comments
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

                                                // Load more comments
                                                function loadMoreComments(postId) {
                                                    fetchComments(postId, false);
                                                }

                                                // Submit a student comment
                                                function submitStudentComment(postId) {
                                                    var commentText = document.getElementById('commentText-' + postId).value;

                                                    if (commentText.trim() === "") {
                                                        alert("Please enter a comment.");
                                                        return;
                                                    }

                                                    var xhr = new XMLHttpRequest();
                                                    xhr.open("POST", "submit_student_comment.php", true);
                                                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                                    xhr.onreadystatechange = function() {
                                                        if (xhr.readyState == 4 && xhr.status == 200) {
                                                            document.getElementById('commentText-' + postId).value = "";
                                                            toggleComments(postId); // Reload comments after posting
                                                        }
                                                    };
                                                    xhr.send("post_id=" + postId + "&user_id=" + <?php echo $_SESSION['user_id']; ?> + "&comment=" + encodeURIComponent(commentText));
                                                }


                                                function hideComments(postId) {
                                                    const commentsSection = document.getElementById(`comments-${postId}`);
                                                    const toggleButton = document.getElementById(`toggleComments-${postId}`);

                                                    commentsSection.style.display = 'none';
                                                    toggleButton.textContent = 'Show Comments';
                                                }
                                            </script>


                                    </section>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

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

                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


            </div>
            <!-- End of Main Content -->

            <?php include('includes/sidebar-footer.php'); ?>


        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

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