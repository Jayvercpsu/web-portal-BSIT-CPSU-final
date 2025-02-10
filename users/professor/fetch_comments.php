<?php
include('includes/config.php');

if (isset($_POST['post_id'])) {
    $post_id = intval($_POST['post_id']);
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $limit = 5;

    $query = "
        SELECT sc.id, sc.comment_text, sc.created_at, u.full_name, u.profile_image
        FROM student_comments sc
        INNER JOIN users u ON sc.user_id = u.id
        WHERE sc.post_id = '$post_id'
        ORDER BY sc.created_at ASC  -- Fetch comments in order from oldest to newest
        LIMIT $limit OFFSET $offset
    ";
    $result = mysqli_query($con, $query);

    $comments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $comments[] = [
            "id" => $row['id'],
            "full_name" => htmlentities($row['full_name']),
            "profile_image" => !empty($row['profile_image']) 
                ? '../student/' . htmlentities($row['profile_image']) 
                : '../student/assets/profile-images/default-profile.png',
            "comment_text" => nl2br(htmlentities($row['comment_text'])),
            "created_at" => htmlentities($row['created_at'])
        ];
    }

    echo json_encode(["comments" => $comments]);
}
?>
