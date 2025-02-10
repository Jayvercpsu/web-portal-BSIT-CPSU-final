<?php
session_start();
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        echo "error: Unauthorized access!";
        exit();
    }

    $postId = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $userId = $_SESSION['user_id']; // Secure: Use session instead of POST
    $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';

    if (empty($comment)) {
        echo "error: Comment cannot be empty!";
        exit();
    }

    // Verify the user is a professor
    $query = "SELECT role, full_name, profile_image FROM users WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if (!$user || $user['role'] !== 'professor') {
        echo "error: You must be a professor to post a comment.";
        exit();
    }

    // Insert the comment into the professor_comments table
    $query = "INSERT INTO professor_comments (post_id, user_id, comment_text, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "iis", $postId, $userId, $comment);
    $insertSuccess = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($insertSuccess) {
        // Return only the new comment as JSON (instead of fetching all comments)
        echo json_encode([
            "status" => "success",
            "comment" => [
                "full_name" => $user['full_name'],
                "profile_image" => !empty($user['profile_image']) ? '/bsit_final/users/professor/assets/profile-images/' . $user['profile_image'] : '/assets/profile-images/default-profile.png',
                "comment_text" => htmlentities($comment),
                "created_at" => date("Y-m-d H:i:s")
            ]
        ]);
    } else {
        echo "error: Failed to post comment.";
    }
}
