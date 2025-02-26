<?php
include('../../includes/config.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../images/favicon.png" type="image/x-icon">

    <title>CPSU BSIT Web Portal | Grade Inquiry</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <link rel="stylesheet" href="../../css/icons.css">
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../../assets/css/maicons.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/vendor/owl-carousel/css/owl.carousel.css">
    <link rel="stylesheet" href="../../assets/vendor/animate/animate.css">
    <link rel="stylesheet" href="../../assets/css/theme.css">

    <style>
        .card-custom {
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background: #fff;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.8s ease-out forwards;
        }

        .form-floating input {
            border-radius: 8px;
            padding: 10px;
        }

        .btn-primary {
            width: 100%;
            border-radius: 8px;
            padding: 12px;
            font-size: 1.1rem;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
        }
    </style>

</head>

<body>

    <!-- Navigation -->
    <?php include('includes/header.php'); ?>

    <div class="page-banner overlay-dark bg-image" style="background-image: url(../../images/sample_bsit.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <br><br>
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a style="color: violet;" href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Grade Inquiry</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Input Student ID</h1>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-custom shadow-lg mt-5 mb-5">
                    <div class="card-body">
                        <h4 class="text-center mb-4">Enter Your Student ID</h4>

                        <!-- Show error message if Student ID not found -->
                        <?php if (isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger text-center">
                                <?php echo $_SESSION['error'];
                                unset($_SESSION['error']); ?>
                            </div>
                        <?php } ?>

                        <form id="student-id-form">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="student_id" name="student_id" placeholder="Enter Student ID" required>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="checkStudentID()">Check Grades</button>
                        </form>

                        <!-- Student Year Hidden Input -->
                        <input type="hidden" id="student_year">
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Grade Forms -->
<div class="container">
    <div id="grade-forms">
        <!-- 1st Semester -->
        <div id="grade-form-1st" style="display:none;">
            <div class="card shadow-sm border-primary mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="text-center">1st Semester Grades</h4>
                </div>
                <div class="card-body">
                    <p class="text-center text-muted" id="no-grades-1st" style="display:none;">🚫 No grades released yet. Please wait.</p>
                    <div id="grades-1st"></div>
                </div>
            </div>
        </div>

        <!-- 2nd Semester -->
        <div id="grade-form-2nd" style="display:none;">
            <div class="card shadow-sm border-success mb-4">
                <div class="card-header bg-success text-white">
                    <h4 class="text-center">2nd Semester Grades</h4>
                </div>
                <div class="card-body">
                    <p class="text-center text-muted" id="no-grades-2nd" style="display:none;">🚫 No grades released yet. Please wait.</p>
                    <div id="grades-2nd"></div>
                </div>
            </div>
        </div>
    </div>
</div>



    <!-- Footer -->
    <?php include('includes/footer.php'); ?>

    <script>
    function checkStudentID() {
        var studentId = document.getElementById("student_id").value.trim();
        if (studentId === "") {
            alert("Please enter a valid Student ID.");
            return;
        }

        // Fetch student year and grades
        fetch("fetch-student-grades.php?student_id=" + studentId)
            .then(response => response.json())
            .then(data => {
                if (data.status === "error") {
                    alert(data.message);
                    return;
                }

                document.getElementById("student_year").value = data.student_year;

                // Show forms even if no grades are available
                document.getElementById("grade-form-1st").style.display = "block";
                document.getElementById("grade-form-2nd").style.display = "block";

                // Reset messages and grade tables
                document.getElementById("grades-1st").innerHTML = "";
                document.getElementById("grades-2nd").innerHTML = "";
                document.getElementById("no-grades-1st").style.display = "none";
                document.getElementById("no-grades-2nd").style.display = "none";

                // Check and display grades
                if (Array.isArray(data.grades_1st) && data.grades_1st.length > 0) {
                    document.getElementById("grades-1st").innerHTML = generateGradeTable(data.grades_1st, "total-units-1st", "gwa-1st");
                } else {
                    document.getElementById("no-grades-1st").style.display = "block";
                }

                if (Array.isArray(data.grades_2nd) && data.grades_2nd.length > 0) {
                    document.getElementById("grades-2nd").innerHTML = generateGradeTable(data.grades_2nd, "total-units-2nd", "gwa-2nd");
                } else {
                    document.getElementById("no-grades-2nd").style.display = "block";
                }
            })
            .catch(error => console.error("Error fetching student grades:", error));
    }

    // Function to generate the grade table dynamically
    function generateGradeTable(grades, totalUnitsId, gwaId) {
        let totalUnits = 0;
        let totalGradePoints = 0;
        let hasValidGrades = false; // Check if at least one valid grade exists

        let table = `
        <table class="table table-hover table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Course No.</th>
                    <th>Descriptive Title</th>
                    <th>Grade</th>
                    <th>Re</th>
                    <th>Unit</th>
                    <th>Pre-Req</th>
                </tr>
            </thead>
            <tbody>
    `;

        grades.forEach(grade => {
            let numericGrade = parseFloat(grade.grade); // Convert to number
            let unitValue = parseFloat(grade.unit); // Convert to number

            // If the grade is valid (a number), add it to GWA computation
            if (!isNaN(numericGrade) && !isNaN(unitValue)) {
                totalGradePoints += numericGrade * unitValue;
                totalUnits += unitValue;
                hasValidGrades = true;
            }

            table += `
            <tr>
                <td>${grade.course_no}</td>
                <td>${grade.descriptive_title}</td>
                <td>${grade.grade ? grade.grade : '-'}</td>
                <td>${grade.re ? grade.re : '-'}</td>
                <td>${grade.unit}</td>
                <td>${grade.pre_req ? grade.pre_req : '-'}</td>
            </tr>
        `;
        });

        table += `</tbody></table>`;

        // Compute GWA
        let gwa = hasValidGrades ? (totalGradePoints / totalUnits).toFixed(2) : "N/A";

        table += `
        <div class="alert alert-info text-center">
            <strong>Total Units:</strong> <span id="${totalUnitsId}">${totalUnits}</span> | 
            <strong>General Weighted Average (GWA):</strong> <span id="${gwaId}">${gwa}</span>
        </div>
    `;

        return table;
    }
</script>




    <script src="../../assets/js/jquery-3.5.1.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendor/wow/wow.min.js"></script>
    <script src="../../assets/js/theme.js"></script>

</body>

</html>