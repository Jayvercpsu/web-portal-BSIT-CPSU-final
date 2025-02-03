<?php
session_start();
include('includes/config.php');

if (isset($_POST['add_subject'])) {
    $subject_name = mysqli_real_escape_string($con, $_POST['subject_name']);
    $semester = mysqli_real_escape_string($con, $_POST['semester']);

    $query = "INSERT INTO subjects (subject_name, semester) VALUES (?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $subject_name, $semester);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Subject added successfully!";
    } else {
        $_SESSION['message'] = "Failed to add subject.";
    }

    $stmt->close();
    $con->close();

    header("Location: add-subject.php"); // Refresh the page
    exit();
}

include('includes/topheader.php');
include('includes/leftsidebar.php');
?>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Add New Subject</h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Add New Subject</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <!-- Add Subject Button to Trigger Modal -->
            <div class="text-left">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addSubjectModal">
                    <i class="fas fa-plus"></i> Add Subject
                </button>
            </div>

            <!-- Modal Structure -->
            <div class="modal fade" id="addSubjectModal" tabindex="-1" aria-labelledby="addSubjectModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="addSubjectModalLabel">Add Subject</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label for="subject_name">Subject Name:</label>
                                    <input type="text" class="form-control" id="subject_name" name="subject_name" required>
                                </div>

                                <div class="form-group">
                                    <label for="semester">Semester:</label>
                                    <select class="form-control" id="semester" name="semester" required>
                                        <option value="1st Semester">1st Semester</option>
                                        <option value="2nd Semester">2nd Semester</option>
                                    </select>
                                </div>

                                <div class="text-center">
                                    <button type="submit" name="add_subject" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add Subject
                                    </button>
                                </div>
                            </form>

                            <!-- Success Message -->
                            <?php if (isset($_SESSION['message'])) { ?>
                                <div class="alert alert-success mt-3">
                                    <?php echo $_SESSION['message'];
                                    unset($_SESSION['message']); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Display Subjects in a Table -->
            <div class="row mt-4">
                <div class="col-xs-12">
                    <h4 class="text-center">Added Subjects</h4>
                    <div class="table-responsive">
                        <table id="studentsTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Subject Name</th>
                                    <th>Semester</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch the subjects from the database and display them
                                $query = "SELECT id, subject_name, semester FROM subjects";
                                $result = mysqli_query($con, $query);

                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['subject_name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['semester']) . "</td>";
                                        echo "<td><a href='edit_subject.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a> <a href='delete_subject.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this subject?\")'>Delete</a></td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div> <!-- container -->
    </div> <!-- content -->
</div> <!-- content-page -->

<?php include('includes/footer.php'); ?>

<!-- Bootstrap & jQuery (Make sure to include them) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- Initialize DataTables -->
<script>
    $(document).ready(function() {
        $('#studentsTable').DataTable();
    });
</script>

<!-- Success Message fade-out -->
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $("#success-alert, #error-alert").fadeOut('slow');
        }, 1800);
    });
</script>