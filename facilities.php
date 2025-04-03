<?php
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CPSU BSIT Facilities including laboratories and classrooms">
    <meta name="author" content="CPSU BSIT">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

    <title>CPSU BSIT Web Portal | Facilities</title>

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
    <link rel="stylesheet" href="css/facilities/image-preview.css">
    <link rel="stylesheet" href="css/facilities/facilities.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


</head>

<body>
    <!-- Navigation -->
    <?php include('includes/header.php'); ?>

    <!-- Page Banner -->
    <div class="page-banner overlay-dark bg-image" style="background-image: url(images/sample_bsit.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <br><br>
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <h1 class="font-weight-normal">Our Facilities</h1>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <?php include('includes/facilities/laboratory.php') ?>
    <?php include('includes/facilities/smarthub.php') ?>
    <?php include('includes/facilities/lecture.php') ?>


    <!-- Footer -->
    <?php include('includes/footer.php'); ?>

    <!-- Scripts -->
    <script src="./assets/js/jquery-3.5.1.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/vendor/wow/wow.min.js"></script>
    <script src="./assets/js/theme.js"></script>

    <!-- AOS Animation Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });

        // Additional animations for elements
        $(document).ready(function() {
            // Hover effects for icons
            $('.feature-icon').hover(
                function() {
                    $(this).addClass('text-primary');
                },
                function() {
                    $(this).removeClass('text-primary');
                }
            );

            // Scroll reveal animation
            $(window).scroll(function() {
                var scrollPos = $(window).scrollTop();

                $('.facility-card').each(function() {
                    var elemPos = $(this).offset().top;

                    if (scrollPos + $(window).height() * 0.8 > elemPos) {
                        $(this).addClass('animate__animated animate__fadeIn');
                    }
                });
            });
        });
    </script>
</body>

</html>