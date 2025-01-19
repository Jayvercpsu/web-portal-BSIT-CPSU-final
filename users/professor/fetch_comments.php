<?php
session_start();
include('includes/config.php');

// Ensure user is logged in and is a professor
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'professor') {
    echo "Unauthorized access!";
    exit();
}

if (isset($_POST['post_id'])) {
    $post_id = intval($_POST['post_id']); // Sanitize post_id
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $limit = 5; // Number of comments to fetch per request

    // Query to fetch comments with LIMIT and OFFSET
    $query = "
        SELECT sc.comment_text, sc.created_at, u.full_name, u.profile_image
        FROM student_comments sc
        INNER JOIN users u ON sc.user_id = u.id
        WHERE sc.post_id = '$post_id'
        ORDER BY sc.created_at ASC
        LIMIT $limit OFFSET $offset
    ";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Resolve profile image path
            $profileImageRelativePath = $row['profile_image'];
            $profileImageAbsolutePath = $_SERVER['DOCUMENT_ROOT'] . '/bsit_final/users/student/assets/profile-images/' . basename($profileImageRelativePath);

            if (file_exists($profileImageAbsolutePath)) {
                $profileImage = '/bsit_final/users/student/assets/profile-images/' . basename($profileImageRelativePath);
            } else {
                $profileImage = '/assets/profile-images/default-profile.png'; // Fallback image
            }

            // Generate HTML for each comment
            echo '
            <div class="comment mb-3">
                <div class="d-flex align-items-center">
                    <img src="' . $profileImage . '" alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
                    <div>
                        <strong>' . htmlentities($row['full_name']) . '</strong>
                        <small class="text-muted d-block">' . htmlentities($row['created_at']) . '</small>
                    </div>
                </div>
                <p class="mt-2">' . htmlentities($row['comment_text']) . '</p>
            </div>';
        }
    } else {
        // No comments found
        echo '<p class="text-muted">No comments yet. Be the first to comment!</p>';
    }
} else {
    echo "Invalid request!";
}
?>
