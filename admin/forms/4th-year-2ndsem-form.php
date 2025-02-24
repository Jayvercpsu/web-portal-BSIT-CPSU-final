<div id="grade-form" style="display:none;">
    <h4 class="text-center" id="form-title"></h4>
    <form method="post">
        <input type="hidden" name="student_id" id="selected_student_id">
        <input type="hidden" name="student_name" id="selected_student_name">
        <input type="hidden" name="student_year" id="selected_student_year">
        <input type="hidden" name="semester" id="selected_semester"> <!-- ✅ Ensure Semester is Passed -->

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

<!-- ✅ JavaScript: Handle 2nd Sem Courses Only -->
<script>
    document.getElementById("semester").addEventListener("change", function() {
        var semester = this.value;
        var studentYear = document.getElementById("student_year").value;
        var studentId = document.getElementById("student_id").value;
        var studentName = document.querySelector("#student_id option:checked").text;

        if (semester === "2nd Sem" && studentYear === "4th Year") {
            document.getElementById("form-title").innerText = "FOURTH YEAR " + semester.toUpperCase();
            document.getElementById("selected_semester").value = semester; 
            document.getElementById("selected_student_id").value = studentId;
            document.getElementById("selected_student_name").value = studentName;
            document.getElementById("selected_student_year").value = studentYear;

            var courses = [
                { course_no: "PCIT-15", title: "System Integration & Architecture 2", unit: 3, pre_req: "PCIT-11" },
                { course_no: "PCIT-16", title: "Capstone Project & Research 2", unit: 3, pre_req: "" },
                { course_no: "PSIT-01", title: "Application Development & Emerging Tech 2", unit: 3, pre_req: "" },
                { course_no: "GEL3", title: "Philippine Popular Culture", unit: 3, pre_req: "" }
            ];

            var tbody = document.getElementById("grade-table-body");
            tbody.innerHTML = "";
            courses.forEach(course => {
                tbody.innerHTML += `<tr>
                    <td>${course.course_no}</td>
                    <td>${course.title}</td>
                    <td><input type="text" name="grade[]" class="form-control" required></td>
                    <td><input type="text" name="re[]" class="form-control"></td>
                    <td>${course.unit}</td>
                    <td>${course.pre_req}</td>
                </tr>`;
            });

            document.getElementById("grade-form").style.display = "block";
        }
    });
</script>
