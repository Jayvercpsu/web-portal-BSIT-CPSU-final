<?php
session_start();
include('includes/config.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id']; // The ID of the post being liked

// Check if the user is a student
$result = mysqli_query($con, "SELECT role FROM users WHERE id = '$user_id' AND role = 'student'");
$student = mysqli_fetch_assoc($result);

if (!$student) {
    echo json_encode(['status' => 'error', 'message' => 'Only students can react']);
    exit();
}

// Check if the user has already liked the post
$query = mysqli_query($con, "SELECT * FROM like_reactions WHERE user_id = '$user_id' AND post_id = '$post_id'");

if (mysqli_num_rows($query) > 0) {
    // If already liked, remove the like
    $delete = mysqli_query($con, "DELETE FROM like_reactions WHERE user_id = '$user_id' AND post_id = '$post_id'");
    // Get the updated like count
    $like_count_query = mysqli_query($con, "SELECT COUNT(*) AS total_likes FROM like_reactions WHERE post_id = '$post_id'");
    $like_count = mysqli_fetch_assoc($like_count_query)['total_likes'];

    echo json_encode(['status' => 'success', 'action' => 'unliked', 'total_likes' => $like_count]);
} else {
    // Otherwise, insert the like
    $insert = mysqli_query($con, "INSERT INTO like_reactions (user_id, post_id, reaction_type) VALUES ('$user_id', '$post_id', 'like')");
    // Get the updated like count
    $like_count_query = mysqli_query($con, "SELECT COUNT(*) AS total_likes FROM like_reactions WHERE post_id = '$post_id'");
    $like_count = mysqli_fetch_assoc($like_count_query)['total_likes'];

    echo json_encode(['status' => 'success', 'action' => 'liked', 'total_likes' => $like_count]);
}
?>
