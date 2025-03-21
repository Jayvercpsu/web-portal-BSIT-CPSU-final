<?php
include('../includes/config.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">

    <title>CPSU | Grade Inquiry</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <link rel="stylesheet" href="../css/icons.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../assets/css/maicons.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">
    <link rel="stylesheet" href="../assets/vendor/animate/animate.css">
    <link rel="stylesheet" href="../assets/css/theme.css">

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

        #student-info {
            transition: all 0.5s ease-in-out;
        }

        #countdown-timer {
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            animation: pulse 1s infinite alternate;
            transition: background-color 0.5s ease-in-out;
            /* Smooth transition effect */
        }

        #countdown-timer.red {
            background-color: red !important;
            color: white;
            font-weight: bold;
        }

        @keyframes pulse {
            from {
                opacity: 1;
                transform: scale(1);
            }

            to {
                opacity: 0.8;
                transform: scale(1.1);
            }
        }

        #countdown-timer {
            text-align: center;
            padding: 10px;
            border-radius: 8px;
            transition: transform 0.3s ease, opacity 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            /* Box Shadow for better front appearance */
        }

        #countdown-timer:hover {
            transform: scale(1.1);
            /* Zoom Effect on Hover */
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            #countdown-timer {
                width: 80px;
                /* Smaller Width on Mobile */
                font-size: 16px;
                /* Smaller Font Size */
                top: 10px;
                /* Adjust Position */
                right: 10px;
            }
        }

        @media (max-width: 480px) {
            #countdown-timer {
                width: 60px;
                font-size: 14px;
            }
        }

        body {
            position: relative;
            min-height: 100vh;
            overflow-y: auto;
            background: black;
            /* Fallback color */
        }

        /* Blurred Background */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://wallpaperaccess.com/full/1892753.jpg') no-repeat center center;
            background-size: cover;
            filter: blur(2px);
            opacity: 0.9;
            z-index: -1;
        }

        /* Gradient Overlay for Better Readability */
        body::after {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.8));
            z-index: -1;
        }


        /* Floating label container */
        .floating-label {
            position: relative;
            margin-bottom: 1.5rem;
        }

        /* Input styling */
        .floating-label input {
            width: 100%;
            padding: 12px 10px;
            font-size: 16px;
            border: 2px solid #ced4da;
            border-radius: 8px;
            outline: none;
            background: transparent;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        /* Label starts inside the input field */
        .floating-label label {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: #6c757d;
            transition: all 0.3s ease-in-out;
            pointer-events: none;
            background: white;
            padding: 0 5px;
        }

        /* Move label when input is focused or has a value */
        .floating-label input:focus+label,
        .floating-label input:not(:placeholder-shown)+label {
            top: 5px;
            font-size: 14px;
            color: #007bff;
        }

        /* Input focus effect */
        .floating-label input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        /* Hide the default placeholder text */
        .floating-label input::placeholder {
            color: transparent;
        }
    </style>

</head>

<body>

    <!-- Navigation -->
    <?php include('includes/header.php'); ?>


    <!-- Page Content -->
    <div class="container my-5">
        <div id="countdown-timer" class="text-center bg-white text-dark p-2 rounded shadow-sm"
            style="display:none; position: fixed; top: 20px; right: 20px; width: 100px; font-size: 20px; z-index: 9999;">
            20
        </div>

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
                            <!-- Floating label container -->
                            <div class="floating-label">
                                <input type="number" class="form-control" id="student_id" name="student_id" placeholder=" " required>
                                <label for="student_id">Enter Student ID</label>
                            </div>
                            <button type="button" class="btn btn-primary w-100 mt-3" onclick="checkStudentID()">Check Grades</button>
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

            <div class="container">
                <div id="student-info" class="text-center mb-4" style="display:none;">
                    <h4 id="student-name" class="bg-primary text-white px-4 py-2 rounded d-inline-block shadow-sm"></h4>
                    <h5 id="student-year" class="badge bg-secondary mt-2 px-3 py-2 text-white"></h5>
                </div>
            </div>



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



    <script>
        function checkStudentID() {
            var studentId = document.getElementById("student_id").value.trim();
            if (studentId === "") {
                alert("Please enter a valid Student ID.");
                return;
            }

            fetch("fetch-student-grades.php?student_id=" + studentId)
                .then(response => response.json())
                .then(data => {
                    if (data.status === "error") {
                        alert(data.message);
                        return;
                    }

                    // Display Student Info
                    document.getElementById("student-info").style.display = "block";
                    document.getElementById("student-name").innerText = "Student Name: " + data.student_name;
                    document.getElementById("student-year").innerText = "Year: " + data.student_year;

                    // Show grade forms
                    document.getElementById("grade-form-1st").style.display = "block";
                    document.getElementById("grade-form-2nd").style.display = "block";

                    // Reset previous grades
                    document.getElementById("grades-1st").innerHTML = "";
                    document.getElementById("grades-2nd").innerHTML = "";
                    document.getElementById("no-grades-1st").style.display = "none";
                    document.getElementById("no-grades-2nd").style.display = "none";

                    // Display 1st Semester Grades
                    if (data.grades_1st.length > 0) {
                        document.getElementById("grades-1st").innerHTML = generateGradeTable(data.grades_1st, "total-units-1st", "gwa-1st");
                    } else {
                        document.getElementById("no-grades-1st").style.display = "block";
                    }

                    // Display 2nd Semester Grades
                    if (data.grades_2nd.length > 0) {
                        document.getElementById("grades-2nd").innerHTML = generateGradeTable(data.grades_2nd, "total-units-2nd", "gwa-2nd");
                    } else {
                        document.getElementById("no-grades-2nd").style.display = "block";
                    }

                    // Start Countdown Timer
                    let timer = 20;
                    document.getElementById("countdown-timer").style.display = "block";
                    document.getElementById("countdown-timer").innerText = timer;

                    let countdown = setInterval(() => {
                        timer--;
                        document.getElementById("countdown-timer").innerText = timer;

                        if (timer <= 10) {
                            document.getElementById("countdown-timer").classList.add("red");
                        }

                        if (timer <= 0) {
                            clearInterval(countdown);

                            // Reset everything after 20 seconds
                            document.getElementById("student-id-form").reset();
                            document.getElementById("student-info").style.display = "none";
                            document.getElementById("grade-form-1st").style.display = "none";
                            document.getElementById("grade-form-2nd").style.display = "none";
                            document.getElementById("countdown-timer").style.display = "none";
                            document.getElementById("countdown-timer").classList.remove("red"); // Reset timer color
                        }
                    }, 1000); // 1000ms = 1 second

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
                <th>Remarks</th>
                <th>Unit</th>
                <th>Pre-Req</th>
            </tr>
        </thead>
        <tbody>
    `;

            grades.forEach(grade => {
                let numericGrade = parseFloat(grade.grade); // Convert to number
                let unitValue = parseFloat(grade.unit); // Convert to number

                // Determine Remarks
                let remarks;
                if (!grade.grade || numericGrade === 0) {
                    remarks = `<span class='text-muted'>No Grade</span>`;
                } else if (numericGrade < 75) {
                    remarks = `<span class='text-danger fw-bold'>Failed</span>`;
                } else {
                    remarks = `<span class='text-success fw-bold'>Passed</span>`;
                }

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
            <td>${remarks}</td>
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




    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/wow/wow.min.js"></script>
    <script src="../assets/js/theme.js"></script>

</body>

</html>