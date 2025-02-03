<?php
session_start();
include('includes/config.php');

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $subject_id = mysqli_real_escape_string($con, $_GET['id']);

    // Fetch subject details from the database
    $query = "SELECT * FROM subjects WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $subject_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $subject = $result->fetch_assoc();

    // Update subject details when form is submitted
    if (isset($_POST['update_subject'])) {
        $subject_name = mysqli_real_escape_string($con, $_POST['subject_name']);
        $semester = mysqli_real_escape_string($con, $_POST['semester']);

        $update_query = "UPDATE subjects SET subject_name = ?, semester = ? WHERE id = ?";
        $update_stmt = $con->prepare($update_query);
        $update_stmt->bind_param("ssi", $subject_name, $semester, $subject_id);

        if ($update_stmt->execute()) {
            $_SESSION['message'] = "Subject updated successfully!";
        } else {
            $_SESSION['message'] = "Failed to update subject.";
        }

        $update_stmt->close();
        $con->close();

        header("Location: add-subject.php"); // Redirect to the main page
        exit();
    }
} else {
    // Redirect if 'id' is not set
    header("Location: add-subject.php");
    exit();
}

include('includes/topheader.php');
include('includes/leftsidebar.php');
?>

<!-- Form for editing subject -->
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                        <!-- Back Button -->
                        <div class="text-left mt-3">
                        <a href="add-subject.php" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Subjects
                        </a>
                    </div>
                    <h4 class="text-center">Edit Subject</h4>
                    <div class="col-xs-6 col-xs-offset-3">
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="subject_name">Subject Name:</label>
                                <input type="text" class="form-control" id="subject_name" name="subject_name" value="<?php echo htmlspecialchars($subject['subject_name']); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="semester">Semester:</label>
                                <select class="form-control" id="semester" name="semester" required>
                                    <option value="1st Semester" <?php echo ($subject['semester'] == "1st Semester") ? 'selected' : ''; ?>>1st Semester</option>
                                    <option value="2nd Semester" <?php echo ($subject['semester'] == "2nd Semester") ? 'selected' : ''; ?>>2nd Semester</option>
                                </select>
                            </div>

                            <div class="text-center">
                                <button type="submit" name="update_subject" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Update Subject
                                </button>
                            </div>
                        </form>
                     
                    </div>

                   
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
