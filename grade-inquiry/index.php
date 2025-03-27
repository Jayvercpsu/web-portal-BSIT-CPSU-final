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
            60
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
                            <button type="button" class="btn w-100 mt-3 custom-btn" onclick="checkStudentID()">Check Grades</button>
                        </form>

                        <style>
                            .custom-btn {
                                background-color: rgb(148, 76, 200);
                                color: white;
                                transition: background-color 0.3s ease-in-out;
                            }

                            .custom-btn:hover {
                                background-color: rgb(68, 36, 91);
                                /* Darker shade for hover effect */
                                color: white;
                            }
                        </style>


                        <!-- Student Year Hidden Input -->
                        <input type="hidden" id="student_year">
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="container">
        <div id="grade-forms">

            <div class="container">
                <div id="student-info" class="text-center mb-4" style="display:none;">
                    <h4 id="student-name" class="text-white px-4 py-2 rounded d-inline-block shadow-sm" style="background-color:rgb(148, 76, 200); color: white;"></h4>
                    <h5 id="student-year" class="badge mt-2 px-3 py-2 text-white" style="background-color:rgb(148, 76, 200); color: white;"></h5>
                </div>
            </div>

            <!-- Semester Grade Sections -->
            <?php
            $years = ["1st Year", "2nd Year", "3rd Year", "4th Year"];
            $semesters = ["1st Semester", "2nd Semester"];

            foreach ($years as $yIndex => $year) {
                foreach ($semesters as $sIndex => $semester) {
                    $divId = "grades-" . ($yIndex + 1) . "-" . ($sIndex + 1);
                    $noGradesId = "no-grades-" . ($yIndex + 1) . "-" . ($sIndex + 1);
                    echo "<div id='$divId'></div>";
                    echo "<p id='$noGradesId' style='display:none;'>🚫 No grades released yet.</p>";
                }
            }
            ?>

            <script>
                function getAcademicYear() {
                    let currentYear = new Date().getFullYear();
                    return `${currentYear - 1}-${currentYear}`;
                }

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

                            document.getElementById("student-info").style.display = "block";
                            document.getElementById("student-name").innerText = "Student Name: " + data.student_name;
                            document.getElementById("student-year").innerText = data.student_year;

                            let years = ["1st Year", "2nd Year", "3rd Year", "4th Year"];
                            let semesters = ["1st Sem", "2nd Sem"];

                            years.forEach((year, yIndex) => {
                                semesters.forEach((semester, sIndex) => {
                                    let gradeDivId = `grades-${yIndex + 1}-${sIndex + 1}`;
                                    let noGradesDivId = `no-grades-${yIndex + 1}-${sIndex + 1}`;

                                    let gradeDiv = document.getElementById(gradeDivId);
                                    let noGradesDiv = document.getElementById(noGradesDivId);

                                    if (!gradeDiv || !noGradesDiv) return;

                                    gradeDiv.innerHTML = "";
                                    noGradesDiv.style.display = "none";

                                    let grades = data.grades[year][semester];

                                    if (grades && grades.length > 0) {
                                        gradeDiv.innerHTML = generateGradeTable(grades);
                                    } else {
                                        noGradesDiv.style.display = "block";
                                    }
                                });
                            });

                            document.getElementById("grade-forms").style.display = "block";
                        })
                        .catch(error => console.error("Error fetching student grades:", error));
                }

                function generateGradeTable(grades) {
                    let table = `<table class="table table-bordered">
        <thead>
            <tr>
                <th>Course No.</th>
                <th>Descriptive Title</th>
                <th>Grade</th>
                <th>Unit</th>
                <th>Pre-Req</th>
            </tr>
        </thead>
        <tbody>`;

                    grades.forEach(grade => {
                        table += `<tr>
            <td>${grade.course_no}</td>
            <td>${grade.descriptive_title}</td>
            <td>${grade.grade}</td>
            <td>${grade.unit}</td>
            <td>${grade.pre_req}</td>
        </tr>`;
                    });

                    table += `</tbody></table>`;
                    return table;
                }
            </script>

        </div>
    </div>




    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/wow/wow.min.js"></script>
    <script src="../assets/js/theme.js"></script>

</body>

</html>