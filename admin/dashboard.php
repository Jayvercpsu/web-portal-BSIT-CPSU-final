<?php
session_start();
include('includes/config.php');
error_reporting(0);

// Prevent browser from caching pages (important for logout security)
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION['login']) || strlen($_SESSION['login']) == 0) {
    header("Location: index.php");
    exit(); // Prevent further execution
}
?>

<?php include('includes/topheader.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">

<!-- ========== Left Sidebar Start ========== -->
<?php include('includes/leftsidebar.php'); ?>
<!-- Left Sidebar End -->
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Dashboard</h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="#">BSIT DEPARTMENT</a>
                            </li>
                            <li>
                                <a href="#">Admin</a>
                            </li>
                            <li class="active">
                                Dashboard
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <!-- end row -->
            <div class="row">

                <a href="#">
                    <div class="col-lg-2 col-md-2 col-sm-6">
                        <div class="card-box widget-box-one text-center">
                            <i class="mdi mdi-account-group widget-one-icon"></i>
                            <div class="wigdet-one-content">
                                <p class="m-0 text-secondary" title="Statistics">First Year Students</p>
                                <?php
                                $query = mysqli_query($con, "SELECT * FROM first_year");
                                $countFirstYear = mysqli_num_rows($query);
                                ?>
                                <h2><?php echo htmlentities($countFirstYear); ?></h2>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="#">
                    <div class="col-lg-2 col-md-2 col-sm-6">
                        <div class="card-box widget-box-one text-center">
                            <i class="mdi mdi-account-group widget-one-icon"></i>
                            <div class="wigdet-one-content">
                                <p class="m-0 text-secondary" title="Statistics">Second Year Students</p>
                                <?php
                                $query = mysqli_query($con, "SELECT * FROM second_year");
                                $countSecondYear = mysqli_num_rows($query);
                                ?>
                                <h2><?php echo htmlentities($countSecondYear); ?></h2>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="#">
                    <div class="col-lg-2 col-md-2 col-sm-6">
                        <div class="card-box widget-box-one text-center">
                            <i class="mdi mdi-account-group widget-one-icon"></i>
                            <div class="wigdet-one-content">
                                <p class="m-0 text-secondary" title="Statistics">Third Year Students</p>
                                <?php
                                $query = mysqli_query($con, "SELECT * FROM third_year");
                                $countThirdYear = mysqli_num_rows($query);
                                ?>
                                <h2><?php echo htmlentities($countThirdYear); ?></h2>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="#">
                    <div class="col-lg-2 col-md-2 col-sm-6">
                        <div class="card-box widget-box-one text-center">
                            <i class="mdi mdi-account-group widget-one-icon"></i>
                            <div class="wigdet-one-content">
                                <p class="m-0 text-secondary" title="Statistics">Fourth Year Students</p>
                                <?php
                                $query = mysqli_query($con, "SELECT * FROM fourth_year");
                                $countFourthYear = mysqli_num_rows($query);
                                ?>
                                <h2><?php echo htmlentities($countFourthYear); ?></h2>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="#">
                    <div class="col-lg-2 col-md-2 col-sm-6">
                        <div class="card-box widget-box-one text-center">
                            <i class="mdi mdi-account-multiple widget-one-icon"></i>
                            <div class="wigdet-one-content">
                                <p class="m-0 text-secondary" title="Statistics">All Students</p>
                                <?php
                                $query = mysqli_query($con, "SELECT COUNT(*) AS total FROM users WHERE role = 'student'");
                                $row = mysqli_fetch_assoc($query);
                                $countStudents = $row['total'];
                                ?>
                                <h2><?php echo htmlentities($countStudents); ?></h2>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Total Posts in tblposts -->
                <a href="manage-posts.php">
                    <div class="col-lg-2 col-md-2 col-sm-6">
                        <div class="card-box widget-box-one text-center">
                            <i class="mdi mdi-post-outline widget-one-icon"></i>
                            <div class="wigdet-one-content">
                                <p class="m-0 text-secondary" title="Statistics">Total Posts</p>
                                <?php
                                $query = mysqli_query($con, "SELECT COUNT(*) AS total FROM tblposts");
                                $row = mysqli_fetch_assoc($query);
                                $countPosts = $row['total'];
                                ?>
                                <h2><?php echo htmlentities($countPosts); ?></h2>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Total Student IDs in tblstudents -->
                <a href="manage-student-id.php">
                    <div class="col-lg-2 col-md-2 col-sm-6">
                        <div class="card-box widget-box-one text-center">
                            <i class="mdi mdi-school widget-one-icon"></i>
                            <div class="wigdet-one-content">
                                <p class="m-0 text-secondary" title="Statistics">Total ID Students</p>
                                <?php
                                $query = mysqli_query($con, "SELECT COUNT(student_id) AS total FROM tblstudents");
                                $row = mysqli_fetch_assoc($query);
                                $countStudents = $row['total'];
                                ?>
                                <h2><?php echo htmlentities($countStudents); ?></h2>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
            <!-- end row -->

            <style>
                .card-box {
                    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
                    border-radius: 10px;
                    overflow: hidden;
                }

                .card-box:hover {
                    transform: translateY(-8px);
                    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
                }

                .widget-one-icon {
                    font-size: 3rem;
                    transition: transform 0.3s ease-in-out, color 0.3s ease-in-out;
                }

                .card-box:hover .widget-one-icon {
                    transform: scale(1.1);
                    color: #007bff;
                    /* Change icon color on hover */
                }

                .wigdet-one-content p {
                    transition: color 0.3s ease-in-out;
                }

                .card-box:hover .wigdet-one-content p {
                    color: #007bff;
                    /* Change text color on hover */
                }
            </style>


        </div>
        <!-- container -->
    </div>
    <!-- content -->
    <?php include('includes/footer.php'); ?>

</div>
<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
<!-- Right Sidebar -->
<div class="side-bar right-bar">
    <a href="javascript:void(0);" class="right-bar-toggle">
        <i class="mdi mdi-close-circle-outline"></i>
    </a>
    <h4 class="">Settings</h4>
    <div class="setting-list nicescroll">
        <div class="row m-t-20">
            <div class="col-xs-8">
                <h5 class="m-0">Notifications</h5>
                <p class="text-muted m-b-0"><small>Do you need them?</small></p>
            </div>
            <div class="col-xs-4 text-right">
                <input type="checkbox" checked data-plugin="switchery" data-color="#7fc1fc" data-size="small" />
            </div>
        </div>

        <div class="row m-t-20">
            <div class="col-xs-8">
                <h5 class="m-0">API Access</h5>
                <p class="m-b-0 text-muted"><small>Enable/Disable access</small></p>
            </div>
            <div class="col-xs-4 text-right">
                <input type="checkbox" checked data-plugin="switchery" data-color="#7fc1fc" data-size="small" />
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-xs-8">
                <h5 class="m-0">Auto Updates</h5>
                <p class="m-b-0 text-muted"><small>Keep up to date</small></p>
            </div>
            <div class="col-xs-4 text-right">
                <input type="checkbox" checked data-plugin="switchery" data-color="#7fc1fc" data-size="small" />
            </div>
        </div>

        <div class="row m-t-20">
            <div class="col-xs-8">
                <h5 class="m-0">Online Status</h5>
                <p class="m-b-0 text-muted"><small>Show your status to all</small></p>
            </div>
            <div class="col-xs-4 text-right">
                <input type="checkbox" checked data-plugin="switchery" data-color="#7fc1fc" data-size="small" />
            </div>
        </div>
    </div>

</div>
<!-- /Right-bar -->
</div>
<!-- END wrapper -->
<script>
    var options = {
        series: [44, 55, 67],
        chart: {
            height: 265,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        fontSize: '40px',
                    },
                    value: {
                        fontSize: '16px',
                    },
                    total: {
                        show: true,
                        label: 'Total',
                        formatter: function(w) {
                            // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                            return 249
                        }
                    }
                }
            }
        },
        labels: ['Apples', 'Oranges', 'Bananas'],
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>