<div id="grade-form-1st">
    <h3 class="text-center">FIRST YEAR GRADE</h3>
 
    <form method="post" id="grade-entry-form">
        <input type="hidden" name="student_id" id="selected_student_id_1st">
        <input type="hidden" name="student_name" id="selected_student_name_1st">

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
            <tbody id="grade-table-body-1st-sem"></tbody>
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
            <tbody id="grade-table-body-2nd-sem"></tbody>
        </table>

        <button type="submit" class="btn btn-success mt-3">Submit Grades</button>
        <p id="success-message" class="text-success mt-2" style="display:none;">Grades successfully saved!</p>
    </form>
</div>

<script>
$(document).ready(function() {
    var courses = {
        "1st Sem": [
            { course_no: "CCIT-01", title: "Introduction to Computing", unit: 3, pre_req: "None" },
            { course_no: "CCIT-02", title: "Computer Programming 1", unit: 3, pre_req: "None" },
            { course_no: "GEC-1", title: "Understanding the Self", unit: 3, pre_req: "None" },
            { course_no: "GEC-6", title: "Art Appreciation", unit: 3, pre_req: "None" },
            { course_no: "GEC-2", title: "Readings in Philippine History", unit: 3, pre_req: "None" },
            { course_no: "GEC-5", title: "Purposive Communication", unit: 3, pre_req: "None" },
            { course_no: "GEC-4", title: "Mathematics in the Modern World", unit: 3, pre_req: "None" },
            { course_no: "PE-1", title: "PATH FIT 1 - Movement Enhancement", unit: 2, pre_req: "None" },
            { course_no: "NSTP-1", title: "National Service Training Program 1", unit: 3, pre_req: "None" }
        ],
        "2nd Sem": [
            { course_no: "CCIT-03", title: "Computer Programming 2", unit: 3, pre_req: "CCIT-02" },
            { course_no: "CCIT-04", title: "Discrete Structures", unit: 3, pre_req: "None" },
            { course_no: "CCIT-05", title: "Digital Logic Design", unit: 3, pre_req: "None" },
            { course_no: "GEC-3", title: "The Contemporary World", unit: 3, pre_req: "None" },
            { course_no: "GEC-7", title: "Science, Technology, and Society", unit: 3, pre_req: "None" },
            { course_no: "GEC-8", title: "Ethics", unit: 3, pre_req: "None" },
            { course_no: "GEC-9", title: "Filipino 1 - Komunikasyon sa Akademikong Filipino", unit: 3, pre_req: "None" },
            { course_no: "PE-2", title: "PATH FIT 2 - Exercise-based Fitness Activities", unit: 2, pre_req: "PE-1" },
            { course_no: "NSTP-2", title: "National Service Training Program 2", unit: 3, pre_req: "NSTP-1" }
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

        $("#selected_student_id_1st").val(studentId);
        $("#selected_student_name_1st").val($("#student_id option:selected").text());

        let tbody1st = $("#grade-table-body-1st-sem");
        let tbody2nd = $("#grade-table-body-2nd-sem");
        tbody1st.html("");
        tbody2nd.html("");

        courses["1st Sem"].forEach((course, index) => {
            tbody1st.append(createTableRow(course, `1-${index}`));
        });

        courses["2nd Sem"].forEach((course, index) => {
            tbody2nd.append(createTableRow(course, `2-${index}`));
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
                    $(this).val(grades[courseNo].grade); // ✅ Set fetched grade in input field
                    updateRemarks($(this));
                }
            });
        },
        error: function() {
            console.log("Error fetching grades.");
        }
    });
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
                    $(this).val(grades[courseNo].grade); // ✅ Set fetched grade in input field
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
        let index = input.data("index");
        let grade = parseFloat(input.val());
        let remarksCell = $(`#remarks-${index}`);

        if (!grade) {
            remarksCell.text("No Grade").removeClass("text-success text-danger").addClass("text-muted");
        } else if (grade < 75) {
            remarksCell.text("Failed").removeClass("text-success text-muted").addClass("text-danger fw-bold");
        } else {
            remarksCell.text("Passed").removeClass("text-danger text-muted").addClass("text-success fw-bold");
        }
    }

   
      $("#grade-entry-form").on("submit", function(e) {
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
                    $("#success-message").fadeIn().delay(2000).fadeOut();
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
