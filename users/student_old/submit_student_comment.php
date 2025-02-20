            <?php
            // Include the database connection configuration
            include('includes/config.php');

            // Check if the request is valid
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $postId = $_POST['post_id'];
                $userId = $_POST['user_id'];
                $comment = trim($_POST['comment']);

                // Ensure the user is a student
                $query = "SELECT role FROM users WHERE id = ?";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, "i", $userId);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $role);
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);

                if ($role === 'student') {
                    if (!empty($comment)) {
                        // Insert the comment into the database
                        $query = "INSERT INTO student_comments (post_id, user_id, comment_text, created_at) VALUES (?, ?, ?, NOW())";
                        $stmt = mysqli_prepare($con, $query);
                        mysqli_stmt_bind_param($stmt, "iis", $postId, $userId, $comment);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);

                        // Fetch the updated list of comments for the post, including full name
                        $query = "SELECT sc.comment_text, sc.created_at, u.full_name FROM student_comments sc
                                JOIN users u ON sc.user_id = u.id
                                WHERE sc.post_id = ? ORDER BY sc.created_at DESC";
                        $stmt = mysqli_prepare($con, $query);
                        mysqli_stmt_bind_param($stmt, "i", $postId);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        // Generate HTML for the comment list
                        $commentListHtml = '';
                        while ($row = mysqli_fetch_assoc($result)) {
                            $commentListHtml .= '<div class="comment">';
                            $commentListHtml .= '<p><strong>' . htmlspecialchars($row['full_name']) . ':</strong> ' . htmlspecialchars($row['comment_text']) . ' <small>(' . htmlspecialchars($row['created_at']) . ')</small></p>';
                            $commentListHtml .= '</div>';
                        }
                        mysqli_stmt_close($stmt);

                        // Return the updated comment list
                        echo $commentListHtml;
                    }
                } else {
                    echo 'You must be a student to post a comment.';
                }
            }
            ?>
