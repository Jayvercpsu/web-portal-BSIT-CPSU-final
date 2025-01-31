                        <?php
                        session_start();
                        include('includes/config.php');

                        if (!isset($_SESSION['user_id'])) {
                            header("Location: login.php");
                            exit();
                        }

                        $professor_id = $_SESSION['user_id'];

                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if (isset($_POST['action']) && $_POST['action'] == "add_or_edit") {
                                $student_id = isset($_POST['student_id']) ? intval($_POST['student_id']) : 0;
                                $grade = isset($_POST['grade']) ? $_POST['grade'] : null;
                                $subject_id = isset($_POST['subject_id']) ? intval($_POST['subject_id']) : null;
                                $professor_id = isset($_POST['professor_id']) ? intval($_POST['professor_id']) : 0;
                                $current_time = date("Y-m-d H:i:s");

                                // Fetch full_name from users table
                                $stmt = $con->prepare("SELECT full_name FROM users WHERE id = ?");
                                $stmt->bind_param("i", $student_id);
                                $stmt->execute();
                                $stmt->bind_result($full_name);
                                $stmt->fetch();
                                $stmt->close();

                                if (!$student_id || !$subject_id || !$professor_id || $grade === null || empty($full_name)) {
                                    echo json_encode(["status" => "error", "message" => "Missing required fields."]);
                                    exit();
                                }

                                // Check if the student already has a grade in this subject
                                $stmt = $con->prepare("SELECT COUNT(*) FROM first_semester_students WHERE student_id = ? AND subject_id = ?");
                                $stmt->bind_param("ii", $student_id, $subject_id);
                                $stmt->execute();
                                $stmt->bind_result($count);
                                $stmt->fetch();
                                $stmt->close();

                                if ($count > 0) {
                                    // Update existing record
                                    $stmt = $con->prepare("UPDATE first_semester_students 
                                                            SET full_name = ?, grade = ?, subject_id = ?, professor_id = ?, date_added = ? 
                                                            WHERE student_id = ?");
                                    $stmt->bind_param("ssiiis", $full_name, $grade, $subject_id, $professor_id, $current_time, $student_id);
                                    $success = $stmt->execute();
                                    $stmt->close();

                                    echo json_encode(["status" => $success ? "success" : "error", "message" => $success ? "Grade updated successfully!" : "Failed to update grade."]);
                                } else {
                                    // Insert new record
                                    $stmt = $con->prepare("INSERT INTO first_semester_students (student_id, full_name, grade, date_added, professor_id, subject_id) 
                                                            VALUES (?, ?, ?, ?, ?, ?)");
                                    $stmt->bind_param("isssii", $student_id, $full_name, $grade, $current_time, $professor_id, $subject_id);
                                    $success = $stmt->execute();
                                    $stmt->close();

                                    echo json_encode(["status" => $success ? "success" : "error", "message" => $success ? "Grade saved successfully!" : "Failed to save grade."]);
                                }
                                exit();
                            }

                            // Delete grade
                            if (isset($_POST['action']) && $_POST['action'] == "delete") {
                                $student_id = isset($_POST['student_id']) ? intval($_POST['student_id']) : 0;

                                if ($student_id > 0) {
                                    $stmt = $con->prepare("DELETE FROM first_semester_students WHERE student_id = ?");
                                    $stmt->bind_param("i", $student_id);
                                    $success = $stmt->execute();
                                    $stmt->close();
                                    $response = [
                                        "status" => $success ? "success" : "error",
                                        "message" => $success ? "Grade removed successfully!" : "Error removing grade."
                                    ];

                                    echo "<script>
                                            alert('{$response['message']}');
                                            window.location.href = 'students-4th-year.php';
                                        </script>";
                                } else {
                                    echo json_encode(["status" => "error", "message" => "Invalid student ID."]);
                                }
                                exit();
                            }
                        }

                        // Fetch students with role 'student' and year '4th Year'
                        $students_query = mysqli_query($con, "
SELECT u.id AS student_id, u.full_name, u.profile_image, u.created_at, 
       fs.grade, fs.subject_id, fs.professor_id, 
       s.subject_name, p.full_name AS professor_name
FROM users u
LEFT JOIN first_semester_students fs ON u.id = fs.student_id
LEFT JOIN subjects s ON fs.subject_id = s.id
LEFT JOIN professors p ON fs.professor_id = p.id
WHERE u.role = 'student' 
  AND u.year = '4th Year'
ORDER BY u.id ASC
");
                        $first_sem_students = mysqli_fetch_all($students_query, MYSQLI_ASSOC);


                        // Fetch professors & subjects
                        $professors = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM professors"), MYSQLI_ASSOC);
                        $subjects = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM subjects"), MYSQLI_ASSOC);

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
                                                <h4 class="page-title">Fourth Year Students</h4>
                                                <ol class="breadcrumb p-0 m-0">
                                                    <li><a href="#">Dashboard</a></li>
                                                    <li class="active">Fourth Year Students</li>
                                                </ol>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <h4>1st Semester Students</h4>
                                    <table id="firstSemesterTable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Profile Image</th>
                                                <th>Student Name</th>
                                                <th>Grade</th>
                                                <th>Subject</th>
                                                <th>Professor</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($first_sem_students as $student) { ?>
                                                <tr>
                                                    <td>
                                                        <img src="<?php echo (!empty($student['profile_image']) && file_exists('../student/assets/profile-images/' . basename($student['profile_image'])))
                                                                        ? '../student/assets/profile-images/' . basename($student['profile_image'])
                                                                        : '../student/assets/profile-images/default-profile.png'; ?>"
                                                            alt="Profile Image" style="width: 50px; height: 50px;">
                                                    </td>
                                                    <td><?php echo htmlentities($student['full_name']); ?></td>
                                                    <td>
                                                        <?php if (!empty($student['grade'])) { ?>
                                                            <span><?php echo $student['grade']; ?></span>
                                                        <?php } else { ?>
                                                            <input type="number" class="form-control grade-input"
                                                                data-student-id="<?php echo $student['student_id']; ?>">
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if (!empty($student['subject_name'])) { ?>
                                                            <span><?php echo $student['subject_name']; ?></span>
                                                        <?php } else { ?>
                                                            <select class="form-control subject-select" data-student-id="<?php echo $student['student_id']; ?>">
                                                                <option value="">Select Subject</option>
                                                                <?php foreach ($subjects as $subject) { ?>
                                                                    <option value="<?php echo $subject['id']; ?>"><?php echo $subject['subject_name']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if (!empty($student['professor_name'])) { ?>
                                                            <span><?php echo $student['professor_name']; ?></span>
                                                        <?php } else { ?>
                                                            <select class="form-control professor-select" data-student-id="<?php echo $student['student_id']; ?>">
                                                                <option value="">Select Professor</option>
                                                                <?php foreach ($professors as $professor) { ?>
                                                                    <option value="<?php echo $professor['id']; ?>"><?php echo $professor['full_name']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if (!empty($student['grade'])) { ?>
                                                            <button class="btn btn-primary btn-sm edit-grade-btn"
                                                                data-student-id="<?php echo $student['student_id']; ?>"
                                                                data-grade="<?php echo $student['grade']; ?>">
                                                                Edit
                                                            </button>

                                                            <form method="POST" action="students-4th-year.php" style="display:inline;">
                                                                <input type="hidden" name="action" value="delete">
                                                                <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
                                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to remove this grade?');">
                                                                    Remove
                                                                </button>
                                                            </form>
                                                        <?php } else { ?>
                                                            <button class="btn btn-primary btn-sm submit-grade-btn"
                                                                data-student-id="<?php echo $student['student_id']; ?>">
                                                                Submit
                                                            </button>
                                                        <?php } ?>
                                                    </td>


                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Grade Modal -->
                        <div id="editGradeModal" class="modal fade" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Grade</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editGradeForm">
                                            <input type="hidden" id="editStudentId">

                                            <label>Grade:</label>
                                            <input type="number" id="editGradeInput" class="form-control">

                                            <label>Subject:</label>
                                            <select id="editSubjectId" class="form-control">
                                                <?php foreach ($subjects as $subject) { ?>
                                                    <option value="<?php echo $subject['id']; ?>"><?php echo $subject['subject_name']; ?></option>
                                                <?php } ?>
                                            </select>

                                            <label>Professor:</label>
                                            <select id="editProfessorId" class="form-control">
                                                <?php foreach ($professors as $professor) { ?>
                                                    <option value="<?php echo $professor['id']; ?>"><?php echo $professor['full_name']; ?></option>
                                                <?php } ?>
                                            </select>

                                            <button type="button" class="btn btn-primary mt-2 save-grade-btn">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        </div>

                        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



                        <script>
                            $(document).ready(function() {
                                $('#firstSemesterTable').DataTable();

                                // Submit new grade (Add)
                                $(".submit-grade-btn").click(function() {
                                    let student_id = $(this).data("student-id");
                                    let grade = $(".grade-input[data-student-id='" + student_id + "']").val();
                                    let subject_id = $(".subject-select[data-student-id='" + student_id + "']").val();
                                    let professor_id = $(".professor-select[data-student-id='" + student_id + "']").val();

                                    if (!grade || !subject_id || !professor_id) {
                                        alert("Please enter a grade, select a subject, and select a professor.");
                                        return;
                                    }

                                    $.post("students-4th-year.php", {
                                        action: "add_or_edit",
                                        student_id: student_id,
                                        grade: grade,
                                        subject_id: subject_id,
                                        professor_id: professor_id
                                    }, function(response) {
                                        let res = JSON.parse(response);
                                        alert(res.message);
                                        if (res.status === "success") location.reload();
                                    });
                                });

                                // Open edit modal (Now includes Subject and Professor)
                                $(".edit-grade-btn").click(function() {
                                    let student_id = $(this).data("student-id");
                                    let grade = $(this).data("grade");
                                    let subject_id = $(this).data("subject-id");
                                    let professor_id = $(this).data("professor-id");

                                    $("#editStudentId").val(student_id);
                                    $("#editGradeInput").val(grade);
                                    $("#editSubjectId").val(subject_id);
                                    $("#editProfessorId").val(professor_id);

                                    $("#editGradeModal").modal("show");
                                });

                                // Save edited grade, subject, and professor
                                $(".save-grade-btn").click(function() {
                                    let student_id = $("#editStudentId").val();
                                    let grade = $("#editGradeInput").val();
                                    let subject_id = $("#editSubjectId").val();
                                    let professor_id = $("#editProfessorId").val();

                                    if (!grade || !subject_id || !professor_id) {
                                        alert("Please enter a grade, select a subject, and select a professor.");
                                        return;
                                    }

                                    $.post("students-4th-year.php", {
                                        action: "add_or_edit",
                                        student_id: student_id,
                                        grade: grade,
                                        subject_id: subject_id,
                                        professor_id: professor_id
                                    }, function(response) {
                                        let res = JSON.parse(response);
                                        alert(res.message);
                                        if (res.status === "success") location.reload();
                                    });
                                });

                                // Delete grade
                                $(".delete-grade-btn").click(function() {
                                    if (confirm("Are you sure you want to remove this grade?")) {
                                        let student_id = $(this).data("student-id");

                                        $.post("students-4th-year.php", {
                                            action: "delete",
                                            student_id: student_id
                                        }, function(response) {
                                            let res = JSON.parse(response);
                                            alert(res.message);
                                            if (res.status === "success") location.reload();
                                        });
                                    }
                                });
                            });
                        </script>

                        <?php include('includes/footer.php'); ?>