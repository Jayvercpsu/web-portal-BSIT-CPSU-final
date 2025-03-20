<div id="grade-form-4th" style="display:none;">
    <h4 class="text-center" id="form-title-4th"></h4>
    <form method="post">
        <input type="hidden" name="student_id" id="selected_student_id_4th">
        <input type="hidden" name="student_name" id="selected_student_name_4th">
        <input type="hidden" name="student_year" id="selected_student_year_4th">
        <input type="hidden" name="semester" id="selected_semester_4th">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Course No.</th>
                    <th>Descriptive Title</th>
                    <th>Grade</th>
                    <th>Remarks</th>
                    <th>Unit</th>
                    <th>Pre-Req</th>
                </tr>
            </thead>
            <tbody id="grade-table-body-4th">
                <!-- Data will be inserted via JS -->
            </tbody>
        </table>

        <button type="submit" class="btn btn-success" name="submit_grades">Submit Grades</button>
    </form>
</div>
<script>
    document.getElementById("semester").addEventListener("change", function() {
        var semester = this.value;
        var studentYear = document.getElementById("student_year").value;
        var studentId = document.getElementById("student_id").value;
        var studentName = document.querySelector("#student_id option:checked").text;

        if (semester && studentYear === "4th Year") {
            document.getElementById("form-title-4th").innerText = "FOURTH YEAR " + semester.toUpperCase();
            document.getElementById("selected_semester_4th").value = semester;
            document.getElementById("selected_student_id_4th").value = studentId;
            document.getElementById("selected_student_name_4th").value = studentName;
            document.getElementById("selected_student_year_4th").value = studentYear;

            var courses = {
                "1st Sem": [{
                    course_no: "PCIT-14",
                    title: "Practicum",
                    unit: 6,
                    pre_req: "4th Year"
                }],
                "2nd Sem": [{
                        course_no: "PCIT-15",
                        title: "System Integration & Architecture 2",
                        unit: 3,
                        pre_req: "PCIT-11"
                    },
                    {
                        course_no: "PCIT-16",
                        title: "Capstone Project & Research 2",
                        unit: 3,
                        pre_req: ""
                    },
                    {
                        course_no: "PSIT-01",
                        title: "Application Development & Emerging Tech 2",
                        unit: 3,
                        pre_req: ""
                    },
                    {
                        course_no: "GEL3",
                        title: "Philippine Popular Culture",
                        unit: 3,
                        pre_req: ""
                    }
                ]
            };

            var tbody = document.getElementById("grade-table-body-4th");
            tbody.innerHTML = "";
            courses[semester].forEach((course, index) => {
                tbody.innerHTML += `<tr>
                <td>${course.course_no}<input type="hidden" name="course_no[]" value="${course.course_no}"></td>
                <td>${course.title}<input type="hidden" name="descriptive_title[]" value="${course.title}"></td>
                <td>
                    <input type="number" name="grade[]" class="form-control grade-input" data-index="${index}" min="0" max="100">
                </td>
                <td id="remarks-${index}" class="text-center text-muted">No Grade</td>
                <td>${course.unit}<input type="hidden" name="unit[]" value="${course.unit}"></td>
                <td>${course.pre_req}<input type="hidden" name="pre_req[]" value="${course.pre_req}"></td>
            </tr>`;
            });

            document.getElementById("grade-form-4th").style.display = "block";

            // Add event listeners for grade inputs to update remarks dynamically
            document.querySelectorAll(".grade-input").forEach(input => {
                input.addEventListener("input", function() {
                    var index = this.getAttribute("data-index");
                    var grade = parseFloat(this.value);
                    var remarksCell = document.getElementById(`remarks-${index}`);

                    if (!this.value || grade === 0) {
                        remarksCell.textContent = "No Grade";
                        remarksCell.className = "text-center text-muted";
                    } else if (grade < 75) {
                        remarksCell.textContent = "Failed";
                        remarksCell.className = "text-center text-danger fw-bold";
                    } else {
                        remarksCell.textContent = "Passed";
                        remarksCell.className = "text-center text-success fw-bold";
                    }
                });
            });
        } else {
            document.getElementById("grade-form-4th").style.display = "none";
        }
    });
</script>