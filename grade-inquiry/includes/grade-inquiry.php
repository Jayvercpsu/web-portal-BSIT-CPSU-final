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
                                        <div class="floating-label">
                                            <input type="number" class="form-control" id="student_id" name="student_id" placeholder=" " required>
                                            <label for="student_id">Enter Student ID</label>
                                        </div>
                                        <button type="button" id="checkGradesBtn" class="btn w-100 mt-3 custom-btn" onclick="checkStudentID()">Check Grades</button>
                                    </form>

                                    <style>
                                        .custom-btn {
                                            background-color: rgb(148, 76, 200);
                                            color: white;
                                            transition: background-color 0.3s ease-in-out;
                                        }

                                        .custom-btn:hover {
                                            background-color: rgb(68, 36, 91);
                                            color: white;
                                        }

                                        .year-header {
                                            background-color: rgb(68, 36, 91);
                                        }

                                        .semester-header {
                                            background-color: rgb(148, 76, 200);
                                        }

                                        .year-container {
                                            margin-bottom: 30px;
                                        }

                                        .alert-warning {
                                            background-color: #fff3cd;
                                            color: #856404;
                                            border-color: #ffeeba;
                                            padding: 15px;
                                            border-radius: 5px;
                                            margin-bottom: 20px;
                                        }

                                        .empty-message {
                                            padding: 20px;
                                            text-align: center;
                                            font-style: italic;
                                            color: #6c757d;
                                        }

                                        .year-header {
                                            background-color: #f1f1f1;
                                            font-weight: bold;
                                            border-radius: 5px;
                                        }

                                        .year-container {
                                            background-color: #fff;
                                        }

                                        .toggle-icon {
                                            font-size: 18px;
                                            font-weight: bold;
                                            color: #007bff;
                                        }

                                        /* Smooth slide animation */
                                        .semester-wrapper {
                                            overflow: hidden;
                                            max-height: 0;
                                            transition: max-height 0.5s ease-in-out;
                                        }
                                    </style>

                                    <input type="hidden" id="student_year">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Student Info & Grade Forms (Initially Hidden) -->
                <div class="container">
                    <div id="grade-forms" style="display: none;">
                        <div class="container">
                            <!-- ✅ Student Info -->
                            <div id="student-info" class="text-center mb-4">
                                <h4 id="student-name" class="text-white px-4 py-2 rounded d-inline-block shadow-sm" style="background-color:rgb(148, 76, 200);"></h4>
                                <h5 id="student-year" class="badge mt-2 px-3 py-2 text-white" style="background-color:rgb(148, 76, 200);"></h5> 
                            </div>

                            <!-- ✅ Warning message container -->
                            <div id="warning-message" class="alert-warning text-center" style="display: none;"></div>
                        </div>

                        <!-- ✅ Year-based Grade Containers -->
                        <div id="year-containers">
                            <!-- Year containers will be dynamically generated here -->
                        </div>
                    </div>
                </div>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $("#checkGradesBtn").on("click", function() {
                            $("#grade-forms").fadeIn(); // Show the form
                            $("#countdown-timer").text("60").css({
                                "background-color": "white",
                                "color": "black",
                                "display": "block"
                            }).fadeIn();

                            let timeLeft = 60;
                            let timer = setInterval(function() {
                                $("#countdown-timer").text(timeLeft);

                                // Change background to red if time is 10 or below
                                if (timeLeft <= 10) {
                                    $("#countdown-timer").css("background-color", "red").css("color", "white");
                                }

                                if (timeLeft <= 0) {
                                    clearInterval(timer);
                                    $("#grade-forms").fadeOut(); // Hide the form
                                    $("#countdown-timer").fadeOut(); // Hide the timer
                                }

                                timeLeft--;
                            }, 1000);
                        });
                    });

                    function checkStudentID() {
                        var studentId = document.getElementById("student_id").value.trim();
                        if (studentId === "") {
                            alert("Please enter a valid Student ID.");
                            return;
                        }

                        // Show loading indicator
                        document.getElementById("student-id-form").innerHTML += '<div class="text-center mt-3"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';

                        fetch("fetch-student-grades.php?student_id=" + studentId)
                            .then(response => response.json())
                            .then(data => {
                                document.getElementById("student-id-form").querySelector(".spinner-border")?.remove();

                                if (data.status === "error") {
                                    alert(data.message);
                                    return;
                                }

                                // ✅ Show student info
                                document.getElementById("student-info").style.display = "block";
                                document.getElementById("student-name").innerHTML = `<strong>Name:</strong> ${data.student_name}`;
                                document.getElementById("student-year").innerHTML = `<strong>Current Year:</strong> ${data.student_year_label}`;

                                // ✅ Handle warning message
                                let warningElement = document.getElementById("warning-message");
                                warningElement.style.display = data.status === "warning" ? "block" : "none";
                                warningElement.innerText = data.message || "";

                                // ✅ Clear previous grade data
                                let yearContainers = document.getElementById("year-containers");
                                yearContainers.innerHTML = "";

                                let yearLabels = ["1st Year", "2nd Year", "3rd Year", "4th Year"];
                                let semesterLabels = ["1st Sem", "2nd Sem"];

                                // ✅ Loop through years
                                yearLabels.forEach(yearLabel => {
                                    let yearContainer = document.createElement("div");
                                    yearContainer.className = "year-container mb-4 p-3 border rounded";

                                    // 📌 Year Header (with toggle)
                                    let yearHeader = document.createElement("div");
                                    yearHeader.className = "year-header d-flex justify-content-between align-items-center p-2";
                                    yearHeader.style.cursor = "pointer";
                                    yearHeader.innerHTML = `<h3 class="mb-0">${yearLabel} <span class="text-muted">(SY 2024 - 2025)</span></h3>
                                    <span class="toggle-icon">[+]</span>`;

                                    // 📌 Semester Container (Initially Hidden)
                                    let semesterWrapper = document.createElement("div");
                                    semesterWrapper.className = "semester-wrapper mt-3";
                                    semesterWrapper.style.maxHeight = "0"; // Initially collapsed
                                    semesterWrapper.style.overflow = "hidden";
                                    semesterWrapper.style.transition = "max-height 0.5s ease-in-out";

                                    semesterLabels.forEach(semesterLabel => {
                                        let semesterGrades = data.grades[yearLabel][semesterLabel] || [];

                                        let semesterContainer = document.createElement("div");
                                        semesterContainer.className = "mb-3 p-3 border rounded";

                                        let semesterHeader = document.createElement("h4");
                                        semesterHeader.className = "text-center mb-2";
                                        semesterHeader.innerText = semesterLabel;
                                        semesterContainer.appendChild(semesterHeader);

                                        let semesterBody = document.createElement("div");
                                        semesterBody.innerHTML = semesterGrades.length > 0 ?
                                            generateGradeTable(semesterGrades) :
                                            `<div class="text-center text-muted">No grades recorded.</div>`;

                                        semesterContainer.appendChild(semesterBody);
                                        semesterWrapper.appendChild(semesterContainer);
                                    });

                                    // ✅ Toggle Animation on Click
                                    yearHeader.addEventListener("click", function() {
                                        let isVisible = semesterWrapper.style.maxHeight !== "0px";

                                        if (isVisible) {
                                            semesterWrapper.style.maxHeight = "0";
                                            this.querySelector(".toggle-icon").textContent = "[+]";
                                        } else {
                                            semesterWrapper.style.maxHeight = semesterWrapper.scrollHeight + "px";
                                            this.querySelector(".toggle-icon").textContent = "[-]";
                                        }
                                    });

                                    yearContainer.appendChild(yearHeader);
                                    yearContainer.appendChild(semesterWrapper);
                                    yearContainers.appendChild(yearContainer);
                                });

                                document.getElementById("grade-forms").style.display = "block";
                            })
                            .catch(error => {
                                console.error("Error fetching student grades:", error);
                                alert("An error occurred while fetching student data. Please try again.");
                                document.getElementById("student-id-form").querySelector(".spinner-border")?.remove();
                            });

                    }

                    // Function to generate HTML table for grades
                    function generateGradeTable(grades) {
                        if (!grades || grades.length === 0) {
                            return '<div class="empty-message">No grades recorded for this semester</div>';
                        }

                        let table = `<table class="table table-bordered">
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
                                    <tbody>`;

                        grades.forEach(grade => {
                            let remarks = "N/A";
                            let remarkColor = "gray"; // Default color for no grade

                            if (grade.re && grade.re.trim() !== "") {
                                remarks = grade.re;
                            } else {
                                let numericGrade = parseFloat(grade.grade);
                                if (!isNaN(numericGrade)) {
                                    if (numericGrade >= 75) {
                                        remarks = "Passed";
                                        remarkColor = "green"; // Green for passed
                                    } else {
                                        remarks = "Failed";
                                        remarkColor = "red"; // Red for failed
                                    }
                                }
                            }

                            table += `<tr>
                <td>${grade.course_no}</td>
                <td>${grade.descriptive_title}</td>
                <td>${grade.grade}</td>
                <td style="color: ${remarkColor}; font-weight: bold;">${remarks}</td>
                <td>${grade.unit}</td>
                <td>${grade.pre_req || "None"}</td>
              </tr>`;
                        });


                        table += `</tbody></table>`;
                        return table;
                    }
                </script>