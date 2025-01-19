<?php
    session_start();
    include('includes/config.php');

    // Ensure user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $professor_id = $_SESSION['user_id'];
    $msg = $error = "";

    // Fetch all students from the 'second_year' table
    $students_query = mysqli_query($con, "SELECT * FROM second_year ORDER BY id ASC");
    $students = mysqli_fetch_all($students_query, MYSQLI_ASSOC);

    // Fetch existing grades for each student with date and time
    $grades_query = mysqli_query($con, "SELECT * FROM student_grades");
    $existing_grades = [];
    while ($row = mysqli_fetch_assoc($grades_query)) {
        $existing_grades[$row['user_id']] = [
            'grade' => $row['grade'],
            'date_added' => $row['date_added']
        ];
    }

    // Handle grade submission, edit, and removal
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['submit_grades'])) {
            $grades = $_POST['grades'];
            $success = true;
            $current_time = date("Y-m-d H:i:s");

            foreach ($grades as $student_id => $grade) {
                if (trim($grade) === "") {
                    continue; // Skip empty grade inputs
                }

                $student_id = mysqli_real_escape_string($con, $student_id);
                $grade = mysqli_real_escape_string($con, $grade);

                $query = mysqli_query($con, "INSERT INTO student_grades (user_id, grade, date_added) 
                                            VALUES ('$student_id', '$grade', '$current_time') 
                                            ON DUPLICATE KEY UPDATE grade = '$grade', date_added = '$current_time'");

                if (!$query) {
                    $success = false;
                    $_SESSION['error'] = "Failed to save grades: " . mysqli_error($con);
                    break;
                }
            }

            if ($success) {
                $_SESSION['msg'] = "Grades have been successfully saved!";
                // Reload existing grades after submission
                $grades_query = mysqli_query($con, "SELECT * FROM student_grades");
                $existing_grades = [];
                while ($row = mysqli_fetch_assoc($grades_query)) {
                    $existing_grades[$row['user_id']] = [
                        'grade' => $row['grade'],
                        'date_added' => $row['date_added']
                    ];
                }
            }
        }

        if (isset($_POST['edit_grade'])) {
            $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
            $grade = mysqli_real_escape_string($con, $_POST['grade']);
            $current_time = date("Y-m-d H:i:s");

            $query = mysqli_query($con, "UPDATE student_grades SET grade='$grade', date_added='$current_time' WHERE user_id='$student_id'");

            if ($query) {
                $_SESSION['msg'] = "Grade has been successfully updated!";
                $existing_grades[$student_id] = ['grade' => $grade, 'date_added' => $current_time];
            } else {
                $_SESSION['error'] = "Failed to update grade: " . mysqli_error($con);
            }
        }

        if (isset($_POST['remove_grade'])) {
            $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

            $query = mysqli_query($con, "DELETE FROM student_grades WHERE user_id='$student_id'");

            if ($query) {
                $_SESSION['msg'] = "Grade has been successfully removed!";
            } else {
                $_SESSION['error'] = "Failed to remove grade: " . mysqli_error($con);
            }
        }

        // Redirect to prevent form resubmission on refresh
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
    ?>

    <?php include('includes/topheader.php'); ?>
    <?php include('includes/leftsidebar.php'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <div class="content-page">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Second Year Students</h4>
                            <ol class="breadcrumb p-0 m-0">
                                <li><a href="#">Dashboard</a></li>
                                <li class="active">Second Year Students</li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <!-- Display success/error messages -->
                <div id="alert-container">
                    <?php if (isset($_SESSION['msg'])) { ?>
                        <div class="alert alert-success mt-3" role="alert" id="success-alert">
                            <?php echo $_SESSION['msg'];
                            unset($_SESSION['msg']); ?>
                        </div>
                    <?php } elseif (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger mt-3" role="alert" id="error-alert">
                            <?php echo $_SESSION['error'];
                            unset($_SESSION['error']); ?>
                        </div>
                    <?php } ?>
                </div>

                <!-- Grade Submission Form -->
                <form method="POST" id="gradeForm">
                    <!-- Updated table with DataTables initialization -->
                    <div class="table-responsive">
                        <table id="studentsTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Profile Image</th>
                                    <th>Student Name</th>
                                    <th>Existing Grade</th>
                                    <th>Date & Time</th>
                                    <th>Enter Grade</th>
                                    <th>Edit</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $student) { ?>
                                    <tr>
                                        <td>
                                            <?php
                                            $profileImageFromDb = $student['profile_image'];
                                            $profileImageDir = __DIR__ . '/../student/assets/profile-images/';
                                            $imageFileName = basename($profileImageFromDb);
                                            $fullImagePath = $profileImageDir . $imageFileName;
                                            $profileImageUrl = '../student/assets/profile-images/' . $imageFileName;
                                            $defaultImageUrl = '../student/assets/profile-images/default-profile.png';

                                            if (!empty($imageFileName) && file_exists($fullImagePath)) {
                                                echo '<img src="' . htmlentities($profileImageUrl) . '" alt="Profile Image" style="width: 50px; height: 50px;">';
                                            } else {
                                                echo '<img src="' . htmlentities($defaultImageUrl) . '" alt="Default Image" style="width: 50px; height: 50px;">';
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo htmlentities($student['full_name']); ?></td>
                                        <td>
                                            <?php
                                            if (isset($existing_grades[$student['id']])) {
                                                echo htmlentities($existing_grades[$student['id']]['grade']);
                                            } else {
                                                echo "N/A";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if (isset($existing_grades[$student['id']])) {
                                                echo htmlentities($existing_grades[$student['id']]['date_added']);
                                            } else {
                                                echo "N/A";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <input type="number" name="grades[<?php echo $student['id']; ?>]" class="form-control grade-input" placeholder="Enter grade">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editGradeModal<?php echo $student['id']; ?>">Edit</button>
                                        </td>
                                        <td>
                                            <form method="POST">
                                                <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                                <button type="submit" name="remove_grade" class="btn btn-danger" onclick="return confirm('Are you sure you want to remove this grade?');">Remove</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Edit Grade Modal -->
                                    <div class="modal fade" id="editGradeModal<?php echo $student['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editGradeModalLabel<?php echo $student['id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Grade</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                                        <div class="form-group">
                                                            <label for="grade">Final Grade</label>
                                                            <input type="number" name="grade" class="form-control" value="<?php echo isset($existing_grades[$student['id']]['grade']) ? htmlentities($existing_grades[$student['id']]['grade']) : ''; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="edit_grade" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" name="submit_grades" class="btn btn-primary">Submit Grades</button>
                </form>
            </div>
        </div>

        <?php include('includes/footer.php'); ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#success-alert, #error-alert").fadeOut('slow');
            }, 1800);
        });
    </script>

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#studentsTable').DataTable();
        });
    </script>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>