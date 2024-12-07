<?php
session_start();
include('includes/config.php');

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
            <h4 class="page-title">Dashboard</h4>
            <ol class="breadcrumb p-0 m-0">
              <li><a href="#">Dashboard</a></li> 
            </ol>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>


      <?php include('includes/footer.php'); ?>

    </div>
    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->