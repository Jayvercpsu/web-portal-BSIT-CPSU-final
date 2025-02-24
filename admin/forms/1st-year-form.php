<div id="grade-form-1st" style="display:none;">
    <h4 class="text-center" id="form-title-1st"></h4>
    <form method="post">
        <input type="hidden" name="student_id" id="selected_student_id_1st">
        <input type="hidden" name="student_name" id="selected_student_name_1st">
        <input type="hidden" name="student_year" id="selected_student_year_1st">
        <input type="hidden" name="semester" id="selected_semester_1st"> 

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
            <tbody id="grade-table-body-1st">
                <!-- Data will be inserted via JS -->
            </tbody>
        </table>

        <button type="submit" class="btn btn-success" name="submit_grades">Submit Grades</button>
    </form> 
</div>

<!-- ✅ JavaScript: Handle 1st Year Course Display & Ensure Semester is Passed -->
<script>
    document.getElementById("semester").addEventListener("change", function() {
        var semester = this.value;
        var studentYear = document.getElementById("student_year").value;
        var studentId = document.getElementById("student_id").value;
        var studentName = document.querySelector("#student_id option:checked").text;

        if (semester && studentYear === "1st Year") {
            document.getElementById("form-title-1st").innerText = "FIRST YEAR " + semester.toUpperCase();
            document.getElementById("selected_semester_1st").value = semester;
            document.getElementById("selected_student_id_1st").value = studentId;
            document.getElementById("selected_student_name_1st").value = studentName;
            document.getElementById("selected_student_year_1st").value = studentYear;

            var courses = {
                "1st Sem": [
                    { course_no: "CCIT-01", title: "Introduction to Computing", unit: 3, pre_req: "None" },
                    { course_no: "CCIT-02", title: "Computer Programming 1", unit: 3, pre_req: "None" },
                    { course_no: "GEC-1", title: "Understanding the Self", unit: 3, pre_req: "None" },
                    { course_no: "GEC-6", title: "Art Appreciation", unit: 3, pre_req: "None" },
                    { course_no: "GEC-2", title: "Readings in Philippine History", unit: 3, pre_req: "None" },
                    { course_no: "GEC-5", title: "Purposive Communication", unit: 3, pre_req: "None" },
                    { course_no: "GEC-4", title: "Mathematics in Modern World", unit: 3, pre_req: "None" },
                    { course_no: "PE-1", title: "PATH FIT 1 - Movement Competency Training", unit: 2, pre_req: "None" },
                    { course_no: "NSTP-1", title: "National Service Training Program 1", unit: 3, pre_req: "None" }
                ],
                "2nd Sem": [
                    { course_no: "CCIT-03", title: "Computer Programming 2", unit: 3, pre_req: "CCIT-02" },
                    { course_no: "CCIT-04", title: "Discrete Structures", unit: 3, pre_req: "None" },
                    { course_no: "GEC-3", title: "The Contemporary World", unit: 3, pre_req: "None" },
                    { course_no: "GEC-7", title: "Science, Technology, and Society", unit: 3, pre_req: "None" },
                    { course_no: "GEC-8", title: "Ethics", unit: 3, pre_req: "None" },
                    { course_no: "GEC-9", title: "Filipino 1", unit: 3, pre_req: "None" },
                    { course_no: "PE-2", title: "PATH FIT 2 - Fitness Training", unit: 2, pre_req: "PE-1" },
                    { course_no: "NSTP-2", title: "National Service Training Program 2", unit: 3, pre_req: "NSTP-1" }
                ]
            }; 

            var tbody = document.getElementById("grade-table-body-1st");
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

            document.getElementById("grade-form-1st").style.display = "block";
        } else {
            document.getElementById("grade-form-1st").style.display = "none";
        }
    });
</script>
