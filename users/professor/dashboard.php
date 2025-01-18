<?php
session_start();
include('includes/config.php');

// Sample Queries for Dashboard Content
// Fetch the total number of students for each year level
$total_first_year_query = "SELECT COUNT(*) as total_students FROM first_year";
$total_first_year_result = mysqli_query($con, $total_first_year_query);
$total_first_year = mysqli_fetch_assoc($total_first_year_result)['total_students'] ?? 0;

$total_second_year_query = "SELECT COUNT(*) as total_students FROM second_year";
$total_second_year_result = mysqli_query($con, $total_second_year_query);
$total_second_year = mysqli_fetch_assoc($total_second_year_result)['total_students'] ?? 0;

$total_third_year_query = "SELECT COUNT(*) as total_students FROM third_year";
$total_third_year_result = mysqli_query($con, $total_third_year_query);
$total_third_year = mysqli_fetch_assoc($total_third_year_result)['total_students'] ?? 0;

$total_fourth_year_query = "SELECT COUNT(*) as total_students FROM fourth_year";
$total_fourth_year_result = mysqli_query($con, $total_fourth_year_query);
$total_fourth_year = mysqli_fetch_assoc($total_fourth_year_result)['total_students'] ?? 0;

// Fetch average grade for all students
$average_grade_query = "SELECT AVG(grade) as avg_grade FROM student_grades";
$average_grade_result = mysqli_query($con, $average_grade_query);
$average_grade = number_format($average_grade_result ? mysqli_fetch_assoc($average_grade_result)['avg_grade'] : 0, 2);

// Fetch grades grouped by range for chart (e.g., 0-75, 76-80, 81+)
$grades_distribution_query = "
    SELECT
        SUM(CASE WHEN grade <= 75 THEN 1 ELSE 0 END) as below_75,
        SUM(CASE WHEN grade > 75 AND grade <= 80 THEN 1 ELSE 0 END) as between_75_80,
        SUM(CASE WHEN grade > 80 THEN 1 ELSE 0 END) as above_80
    FROM student_grades";
$grades_distribution_result = mysqli_query($con, $grades_distribution_query);
$grades_distribution = mysqli_fetch_assoc($grades_distribution_result);
?>

<?php include('includes/topheader.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">

<!-- ========== Left Sidebar Start ========== -->
<?php include('includes/leftsidebar.php'); ?>
<!-- #region -->

<!-- Start right Content here -->
<div class="content-page">
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div class="page-title-box">
            <h4 class="page-title">Professor Dashboard</h4>
            <ol class="breadcrumb p-0 m-0">
              <li><a href="#">Dashboard</a></li>
            </ol>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>

      <!-- Dashboard Stats Cards -->
      <div class="row">
        <div class="col-md-3">
          <div class="card text-center bg-primary text-white">
            <div class="card-body">
              <h4 class="card-title">First Year</h4>
              <h3><?php echo $total_first_year; ?></h3>
              <i class="mdi mdi-account-group mdi-48px"></i>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-center bg-info text-white">
            <div class="card-body">
              <h4 class="card-title">Second Year</h4>
              <h3><?php echo $total_second_year; ?></h3>
              <i class="mdi mdi-account-group mdi-48px"></i>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-center bg-warning text-white">
            <div class="card-body">
              <h4 class="card-title">Third Year</h4>
              <h3><?php echo $total_third_year; ?></h3>
              <i class="mdi mdi-account-group mdi-48px"></i>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-center bg-success text-white">
            <div class="card-body">
              <h4 class="card-title">Fourth Year</h4>
              <h3><?php echo $total_fourth_year; ?></h3>
              <i class="mdi mdi-account-group mdi-48px"></i>
            </div>
          </div>
        </div>
      </div>

       <br>

      <?php include('includes/footer.php'); ?>

    </div>
  </div>
</div>

 
