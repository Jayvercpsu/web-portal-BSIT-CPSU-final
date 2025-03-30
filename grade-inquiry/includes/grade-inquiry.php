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
                                            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                                        </div>
                                    <?php } ?>

                                    <form id="student-id-form">
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
                                <h5 id="school-year" class="badge mt-2 px-3 py-2 text-white" style="background-color:rgb(68, 36, 91);">School Year: 2024 - 2025</h5>
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

                <script>
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
                            // Remove loading indicator
                            document.getElementById("student-id-form").querySelector(".spinner-border")?.remove();
                            
                            if (data.status === "error") {
                                alert(data.message);
                                return;
                            }

                            // ✅ Show student info
                            document.getElementById("student-info").style.display = "block";
                            document.getElementById("student-name").innerText = `Name: ${data.student_name}`;
                            document.getElementById("student-year").innerText = `Current Year: ${data.student_year_label}`;
                            
                            // ✅ Handle warning message if present
                            let warningElement = document.getElementById("warning-message");
                            if (data.status === "warning" && data.message) {
                                warningElement.innerText = data.message;
                                warningElement.style.display = "block";
                            } else {
                                warningElement.style.display = "none";
                            }
                            
                            // Clear previous data
                            let yearContainers = document.getElementById("year-containers");
                            yearContainers.innerHTML = "";

                            // Define all years and semesters to display
                            let yearLabels = ["1st Year", "2nd Year", "3rd Year", "4th Year"];
                            let semesterLabels = ["1st Sem", "2nd Sem"];
                            
                            // Create containers for each year (always show all years)
                            yearLabels.forEach(yearLabel => {
                                // Create year container
                                let yearContainer = document.createElement("div");
                                yearContainer.className = "year-container";
                                
                                // Create year header
                                let yearHeader = document.createElement("div");
                                yearHeader.className = "card-header year-header text-white text-center";
                                yearHeader.innerHTML = `<h3>${yearLabel}</h3>`;
                                yearContainer.appendChild(yearHeader);
                                
                                // Get the year form number from the year label
                                const yearNumber = yearLabel.charAt(0);
                                
                                // Add each semester for this year
                                semesterLabels.forEach(semesterLabel => {
                                    // Check if we have grades for this semester
                                    let semesterGrades = data.grades[yearLabel][semesterLabel] || [];
                                    
                                    // Create semester container
                                    let semesterContainer = document.createElement("div");
                                    semesterContainer.className = "card mt-3 shadow-sm";
                                    
                                    // Add semester header
                                    let semesterHeader = document.createElement("div");
                                    semesterHeader.className = "card-header semester-header text-white text-center";
                                    semesterHeader.innerHTML = `<h4>${semesterLabel}</h4>`;
                                    semesterContainer.appendChild(semesterHeader);
                                    
                                    // Add semester body with grades table or message
                                    let semesterBody = document.createElement("div");
                                    semesterBody.className = "card-body";
                                    
                                    if (semesterGrades.length > 0) {
                                        // Show grades if available
                                        semesterBody.innerHTML = generateGradeTable(semesterGrades);
                                    } else {
                                        // Show empty message if no grades
                                        semesterBody.innerHTML = `<div class="empty-message">No grades recorded for ${yearLabel}, ${semesterLabel}</div>`;
                                    }
                                    
                                    semesterContainer.appendChild(semesterBody);
                                    
                                    // Add completed semester to year container
                                    yearContainer.appendChild(semesterContainer);
                                });
                                
                                // Add completed year to main container
                                yearContainers.appendChild(yearContainer);
                            });

                            document.getElementById("grade-forms").style.display = "block";
                        })
                        .catch(error => {
                            console.error("Error fetching student grades:", error);
                            alert("An error occurred while fetching student data. Please try again.");
                            // Remove loading indicator on error
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
                        if (grade.re && grade.re.trim() !== "") {
                            remarks = grade.re;
                        } else {
                            remarks = (parseFloat(grade.grade) >= 75) ? "Passed" : "Failed";
                        }
                        
                        table += `<tr>
                                    <td>${grade.course_no}</td>
                                    <td>${grade.descriptive_title}</td>
                                    <td>${grade.grade}</td>
                                    <td>${remarks}</td>
                                    <td>${grade.unit}</td>
                                    <td>${grade.pre_req || "None"}</td>
                                </tr>`;
                    });

                    table += `</tbody></table>`;
                    return table;
                }
                </script>