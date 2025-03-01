<?php
session_start();
include('includes/config.php');

// Fetch the latest posts from the database
$query = mysqli_query($con, "SELECT id, PostTitle, PostImage, PostingDate, postedBy FROM tblposts WHERE Is_Active=1 ORDER BY id DESC");
$query = mysqli_query($con, "SELECT PostTitle, PostDetails, PostImage FROM tblposts WHERE Is_Active = 1 ORDER BY id DESC LIMIT 5");
$first = true; 
?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <title> CPSU BSIT Web Portal | Home Page</title>
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

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">


</head>

<body>

    <!-- Navigation -->
    <?php include('includes/header.php'); ?>


    <?php include('includes/carousel_index.php') ?>

    <?php include('includes/latest_news_start.php') ?>

    <?php include('includes/main_news.php') ?>

    <?php include('includes/key_features.php') ?>

    <?php include('includes/about-us.php') ?>

    <?php include('includes/vis&mis.php') ?>

    <!-- Responsive Map Section -->
    <div class="maps-container wow fadeInUp">
        <div class="responsive-map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d980.9179023218929!2d123.35990996159614!3d10.447612092268333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a93f4321fa90b3%3A0x5a32a445f78a1f2f!2sCentral%20Philippines%20State%20University%20-%20Don%20Justo%20V.%20Valmayor%20Campus!5e0!3m2!1sen!2sph!4v1731682023909!5m2!1sen!2sph"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>

    <br><br>

    <!-- Footer -->
    <?php include('includes/footer.php'); ?>

    <script src="./assets/js/jquery-3.5.1.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/vendor/wow/wow.min.js"></script>
    <script src="./assets/js/theme.js"></script>
    <!-- jQuery & Owl Carousel -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- Bootstrap JS (Already in Your Setup) -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Owl Carousel Initialization -->
    <script>
        $(document).ready(function() {
            $(".latest-news-carousel").owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                /* Enable navigation arrows */
                dots: false,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 4
                    }
                }
            });
        });
    </script>
</body>

</html>