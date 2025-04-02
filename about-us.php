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
                        <!-- <li class="breadcrumb-item"><a style="color: violet;" href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">About</li> -->
                    </ol>
                </nav>
                <h1 class="font-weight-normal">About</h1>
            </div> <!-- .container -->
        </div> <!-- .banner-section -->
    </div> <!-- .page-banner -->
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
                                        <?php
                                        // Remove HTML tags from the description
                                        $plainText = strip_tags($row['Description']);
                                        $paragraphs = explode("\n", trim($plainText)); // Split text into paragraphs

                                        foreach ($paragraphs as $para) {
                                            if (!empty(trim($para))) { // Avoid empty paragraphs
                                                echo '<p class="text-justify">' . htmlentities($para) . '</p>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
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