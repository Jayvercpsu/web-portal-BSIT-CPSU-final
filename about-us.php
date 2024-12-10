<?php
include('includes/config.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

    <title> CPSU BSIT Web Portal | About us</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/icons.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="./assets/css/maicons.css">

    <link rel="stylesheet" href="./assets/css/bootstrap.css">

    <link rel="stylesheet" href="./assets/vendor/owl-carousel/css/owl.carousel.css">

    <link rel="stylesheet" href="./assets/vendor/animate/animate.css">

    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="css/home-page.css">
</head>

<body>

    <!-- Navigation -->
    <?php include('includes/header.php'); ?>






    <div class="page-banner overlay-dark bg-image" style="background-image: url(images/sample_bsit.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <br><br>
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a style="color: violet;" href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">About</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">About</h1>
            </div> <!-- .container -->
        </div> <!-- .banner-section -->
    </div> <!-- .page-banner -->


    <!-- Services Section -->
    <div class="bg-light">
        <div class="page-section py-3 mt-md-n5 custom-index">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card-service wow fadeInUp">
                            <div class="circle-shape">
                                <span class="mai-chatbubbles-outline"></span>
                            </div>
                            <p><span>Hands-on</span> Experience</p>
                        </div>
                    </div>
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card-service wow fadeInUp">
                            <div class="circle-shape">
                                <span class="mai-shield-checkmark"></span>
                            </div>
                            <p><span>Global</span> Career Opportunities </p>
                        </div>
                    </div>
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card-service wow fadeInUp">
                            <div class="circle-shape">
                                <span class="mai-basket"></span>
                            </div>
                            <p><span>Innovative</span> Solutions</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






    </div>
















    <!-- Page Content -->
    <div class="container">

        <?php
        $pagetype = 'aboutus';
        $query = mysqli_query($con, "select PageTitle,Description from tblpages where PageName='$pagetype'");
        while ($row = mysqli_fetch_array($query)) {

        ?>







            <div class="page-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 wow fadeInUp">
                            <h1 class="mt-5 mb-3 text-center"><?php echo htmlentities($row['PageTitle']) ?></h1>
                            <div class="text-lg">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <p><?php echo $row['Description']; ?></p>
                                    </div>
                                </div>

                            <?php } ?>
                            </div>
                        </div>



                        <div class="col-lg-10 mt-5">
                            <h1 class="text-center mb-5 wow fadeInUp">Meet Our Instructors</h1>
                            <div class="row justify-content-center">
                                <div class="col-md-6 col-lg-4 wow zoomIn">
                                    <div class="card-doctor">
                                        <div class="header">
                                            <img src="./assets/faculty_image/dandan.jpg" alt="">
                                            <div class="meta">
                                                <a href="#"><span class="mai-call"></span></a>
                                                <a href="#"><span class="mai-logo-whatsapp"></span></a>
                                            </div>
                                        </div>
                                        <div class="body">
                                            <p class="text-xl mb-0">Dexter G. Dandan</p>
                                            <span class="text-sm text-grey">Program Head</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 wow zoomIn">
                                    <div class="card-doctor">
                                        <div class="header">
                                            <img src="./assets/faculty_image/deliza.jpg" alt="">
                                            <div class="meta">
                                                <a href="#"><span class="mai-call"></span></a>
                                                <a href="#"><span class="mai-logo-whatsapp"></span></a>
                                            </div>
                                        </div>
                                        <div class="body">
                                            <p class="text-xl mb-0">Deliza Grace Delgado</p>
                                            <span class="text-sm text-grey">Instructor</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 wow zoomIn">
                                    <div class="card-doctor">
                                        <div class="header">
                                            <img src="./assets/faculty_image/clint.jpg" alt="">
                                            <div class="meta">
                                                <a href="#"><span class="mai-call"></span></a>
                                                <a href="#"><span class="mai-logo-whatsapp"></span></a>
                                            </div>
                                        </div>
                                        <div class="body">
                                            <p class="text-xl mb-0">Clint Clarido</p>
                                            <span class="text-sm text-grey">Instructor</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="instructor.php" class="btn btn-primary wow fadeInUp">Show More</a>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
    </div>




    <!-- Static -->
    <div class="col-md-12 p-0 Tops">
        <div class="py-5">
            <!-- Adjusted row with gap -->
            <div class="row d-flex justify-content-center text-center gy-4 gap-4">
                <!-- Vision Section -->
                <div class="col-md-3 text-center wow fadeInLeft" data-wow-delay="0.2s">
                    <img src="admin/assets/images/vision.jpg" alt="Vision" class="img-fluid rounded shadow-sm mb-2" draggable="false">
                    <h5 class="text-white">Vision</h5>
                    <p class="text-white">Our vision is to create a better future through innovation and excellence.</p>
                </div>
                <!-- Mission Section -->
                <div class="col-md-3 text-center wow fadeInUp" data-wow-delay="0.2s">
                    <img src="admin/assets/images/mission.jpg" alt="Mission" class="img-fluid rounded shadow-sm mb-2" draggable="false">
                    <h5 class="text-white">Mission</h5>
                    <p class="text-white">Our mission is to empower individuals by providing exceptional learning opportunities.</p>
                </div>
                <!-- Objectives Section -->
                <div class="col-md-3 text-center wow fadeInRight" data-wow-delay="0.2s">
                    <img src="admin/assets/images/objectives.jpg" alt="Objectives" class="img-fluid rounded shadow-sm mb-2" draggable="false">
                    <h5 class="text-white">Objectives</h5>
                    <p class="text-white">Our objectives include fostering creativity, leadership, and a passion for learning.</p>
                </div>
            </div>
        </div>
    </div>



    <!-- /.container -->

    <!-- Footer -->
    <?php include('includes/footer.php'); ?>



    <script src="./assets/js/jquery-3.5.1.min.js"></script>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>

    <script src="./assets/vendor/wow/wow.min.js"></script>

    <script src="./assets/js/theme.js"></script>


</body>

</html>