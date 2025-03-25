<div id="grade-form-3rd">
    <h3 class="text-center">THIRD YEAR GRADE</h3>

    <form method="post" id="grade-entry-form-3rd">
        <input type="hidden" name="student_id" id="selected_student_id_3rd">
        <input type="hidden" name="student_name" id="selected_student_name_3rd">

        <!-- ✅ First Semester Table -->
        <h4 class="text-center mt-4">1ST SEMESTER</h4>
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
            <tbody id="grade-table-body-3rd-sem-1st"></tbody>
        </table>

        <!-- ✅ Second Semester Table -->
        <h4 class="text-center mt-4">2ND SEMESTER</h4>
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
            <tbody id="grade-table-body-3rd-sem-2nd"></tbody>
        </table>

        <button type="submit" class="btn btn-success mt-3">Submit Grades</button>
        <p id="success-message-3rd" class="text-success mt-2" style="display:none;">Grades successfully saved!</p>
    </form>
</div>

<script>
$(document).ready(function() {
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

    function getStudentId() {
        return $("#student_id").val();
    }

    function loadCourses() {
        let studentId = getStudentId();
        if (!studentId) {
            alert("Please select a student first.");
            return;
        }

        $("#selected_student_id_3rd").val(studentId);
        $("#selected_student_name_3rd").val($("#student_id option:selected").text());

        let tbody1st = $("#grade-table-body-3rd-sem-1st");
        let tbody2nd = $("#grade-table-body-3rd-sem-2nd");
        tbody1st.html("");
        tbody2nd.html("");

        courses["1st Sem"].forEach((course, index) => {
            tbody1st.append(createTableRow(course, `3-1-${index}`));
        });

        courses["2nd Sem"].forEach((course, index) => {
            tbody2nd.append(createTableRow(course, `3-2-${index}`));
        });

        loadSavedGrades(studentId);
    }

    function createTableRow(course, index) {
        return `<tr>
            <td>${course.course_no}<input type="hidden" name="course_no[]" value="${course.course_no}"></td>
            <td>${course.title}<input type="hidden" name="descriptive_title[]" value="${course.title}"></td>
            <td><input type="number" name="grade[]" class="form-control grade-input" data-index="${index}" min="0" max="100"></td>
            <td id="remarks-${index}" class="text-center text-muted">No Grade</td>
            <td>${course.unit}<input type="hidden" name="unit[]" value="${course.unit}"></td>
            <td>${course.pre_req}<input type="hidden" name="pre_req[]" value="${course.pre_req}"></td>
        </tr>`;
    }

    function loadSavedGrades(studentId) {
        $.ajax({
            url: "fetch-grades.php",
            type: "POST",
            data: { student_id: studentId },
            dataType: "json",
            success: function(grades) {
                $(".grade-input").each(function() {
                    let courseNo = $(this).closest("tr").find("input[name='course_no[]']").val();
                    if (grades[courseNo] !== undefined) {
                        $(this).val(grades[courseNo].grade);
                        updateRemarks($(this));
                    }
                });
            },
            error: function() {
                console.log("Error fetching grades.");
            }
        });
    }

    function updateRemarks(input) {
        let grade = parseFloat(input.val());
        let index = input.data("index");
        let remarksCell = $(`#remarks-${index}`);

        if (!grade) {
            remarksCell.text("No Grade").removeClass("text-success text-danger").addClass("text-muted");
        } else if (grade < 75) {
            remarksCell.text("Failed").removeClass("text-success text-muted").addClass("text-danger fw-bold");
        } else {
            remarksCell.text("Passed").removeClass("text-danger text-muted").addClass("text-success fw-bold");
        }
    }

    $(document).on("input", ".grade-input", function() {
        updateRemarks($(this));
    });

    $("#grade-entry-form-3rd").on("submit", function(e) {
        e.preventDefault();
        let studentId = getStudentId();
        if (!studentId) {
            alert("Please select a student before submitting.");
            return;
        }

        $.ajax({
            url: "add-student-grade.php",
            type: "POST",
            data: $(this).serialize() + "&submit_grades=1",
            dataType: "json",
            success: function(response) {
                if (response.status === "success") {
                    $("#success-message-3rd").fadeIn().delay(2000).fadeOut();
                    loadSavedGrades(studentId);
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert("Grade updated successfully!");
            }
        });
    });

    loadCourses();
});
</script>
