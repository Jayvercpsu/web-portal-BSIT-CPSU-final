<div id="grade-form" style="display:none;">
    <h4 class="text-center" id="form-title"></h4>
    <form method="post">
        <input type="hidden" name="student_id" id="selected_student_id">
        <input type="hidden" name="student_name" id="selected_student_name">
        <input type="hidden" name="student_year" id="selected_student_year">
        <input type="hidden" name="semester" id="selected_semester">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Course No.</th>
                    <th>Descriptive Title</th>
                    <th>Grade</th>
                    <th>Re</th>
                    <th>Unit</th>
                    <th>Pre-Req</th>
                </tr>
            </thead>
            <tbody id="grade-table-body">
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

        if (semester && studentYear === "3rd Year") {
            document.getElementById("form-title").innerText = "THIRD YEAR " + semester.toUpperCase();
            document.getElementById("selected_semester").value = semester;
            document.getElementById("selected_student_id").value = studentId;
            document.getElementById("selected_student_name").value = studentName;
            document.getElementById("selected_student_year").value = studentYear;

            var courses = {
                "1st Sem": [
                    { course_no: "CCIT 06", title: "Applications Development and Emerging Technologies", unit: 3, pre_req: "" },
                    { course_no: "PFIT 03", title: "Web System and Technology", unit: 3, pre_req: "PCIT 02" },
                    { course_no: "PCIT 11", title: "System Architecture", unit: 3, pre_req: "PCIT 03" },
                    { course_no: "PCIT 09", title: "Networking 2", unit: 3, pre_req: "PCIT 04" },
                    { course_no: "PSIT 04", title: "Technopreneurship", unit: 3, pre_req: "" },
                    { course_no: "PSIT 03", title: "IT Security and Management", unit: 3, pre_req: "CCIT 05" },
                    { course_no: "GEC 9", title: "Life, Works and Writing of Dr. Jose Rizal", unit: 3, pre_req: "" }
                ],
                "2nd Sem": [
                    { course_no: "PCIT 12", title: "Information Assurance and Security 2", unit: 3, pre_req: "PCIT 07" },
                    { course_no: "PCIT 13", title: "Capstone Project and Research 1", unit: 3, pre_req: "PCIT 07, CCIT 06" },
                    { course_no: "PSIT 02", title: "Data Mining Methodology", unit: 3, pre_req: "" },
                    { course_no: "PFIT 04", title: "Software Engineering", unit: 3, pre_req: "CCIT 06" },
                    { course_no: "PSIT 05", title: "Regression Analysis", unit: 3, pre_req: "" },
                    { course_no: "PFIT 06", title: "Business Process Management", unit: 3, pre_req: "" },
                    { course_no: "SEMINAR", title: "Seminars", unit: 3, pre_req: "" }
                ]
            };

            var tbody = document.getElementById("grade-table-body");
            tbody.innerHTML = "";
            courses[semester].forEach(course => {
                tbody.innerHTML += `<tr>
                    <td>${course.course_no}<input type="hidden" name="course_no[]" value="${course.course_no}"></td>
                    <td>${course.title}<input type="hidden" name="descriptive_title[]" value="${course.title}"></td>
                    <td><input type="text" name="grade[]" class="form-control" required></td>
                    <td><input type="text" name="re[]" class="form-control"></td>
                    <td>${course.unit}<input type="hidden" name="unit[]" value="${course.unit}"></td>
                    <td>${course.pre_req}<input type="hidden" name="pre_req[]" value="${course.pre_req}"></td>
                </tr>`;
            });

            document.getElementById("grade-form").style.display = "block";
        } else {
            document.getElementById("grade-form").style.display = "none";
        }
    });
</script>
