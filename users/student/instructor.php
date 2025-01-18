            <?php
            // include('includes/config.php');

            ?>

            <!DOCTYPE html>
            <html lang="en">

            <head>

                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <meta name="description" content="">
                <meta name="author" content="">
                <link rel="shortcut icon" href="../../images/favicon.png" type="image/x-icon">

                <title> CPSU BSIT Web Portal | About us</title>
                <!-- Bootstrap core CSS -->
                <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
                <!-- Custom styles for this template -->
                <link rel="stylesheet" href="../../css/icons.css">
                <link rel="stylesheet" href="../../css/owl.carousel.min.css">
                <link rel="stylesheet" href="../../css/owl.theme.default.min.css">

                <link rel="stylesheet" href="../../assets/css/maicons.css">

                <link rel="stylesheet" href="../../assets/css/bootstrap.css">

                <link rel="stylesheet" href="../../assets/vendor/owl-carousel/css/owl.carousel.css">

                <link rel="stylesheet" href="../../assets/vendor/animate/animate.css">

                <link rel="stylesheet" href="../../assets/css/theme.css">
                <link rel="stylesheet" href="../../css/home-page.css">

            </head>


            <body>

                <!-- Navigation -->
                <?php include('includes/header.php'); ?>






                <div class="page-banner overlay-dark bg-image" style="background-image: url(assets/images/sample_bsit.jpg);">
                    <div class="banner-section">
                        <div class="container text-center wow fadeInUp">
                            <nav aria-label="Breadcrumb">
                                <br><br>
                                <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                                    <li class="breadcrumb-item"><a style="color: violet;" href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Instructors</li>
                                </ol>
                            </nav>
                            <h1 class="font-weight-normal">Instructors</h1>
                        </div> <!-- .container -->
                    </div> <!-- .banner-section -->
                </div> <!-- .page-banner -->


                <div class="page-section">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">

                                <div class="row">
                                <?php
// Query to fetch all users with the role of professor
$query = "SELECT full_name, profile_image FROM users WHERE role = 'professor'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $full_name = htmlspecialchars($row['full_name']); // Sanitize output
        $profile_image = $row['profile_image']; // Get image from the database

        // Remove './assets/profile-images/' prefix if it exists
        if (strpos($profile_image, './assets/profile-images/') === 0) {
            $profile_image = str_replace('./assets/profile-images/', '', $profile_image);
        }

        // Construct the absolute path for `file_exists()`
        $absolute_path = __DIR__ . "/../professor/assets/profile-images/" . $profile_image;

        // Debug: Log the absolute path being checked
        echo "<script>console.log('Absolute Path Checked: " . addslashes($absolute_path) . "');</script>";

        // Construct the relative path for the HTML output
        $image_path = (!empty($profile_image) && file_exists($absolute_path))
            ? "../professor/assets/profile-images/" . $profile_image
            : "../professor/assets/profile-images/default-profile.png";

        // Debug: Log the final image path used
        echo "<script>console.log('Image Path Used: " . addslashes($image_path) . "');</script>";

        // PHP error log for missing file
        if (!file_exists($absolute_path)) {
            error_log("File not found: " . $absolute_path);
        }
?>
        <div class="col-md-6 col-lg-4 wow zoomIn">
            <div class="card-doctor">
                <div class="header">
                    <img src="<?php echo htmlentities($image_path); ?>" alt="<?php echo $full_name; ?>" class="img-fluid">
                    <div class="meta">
                        <a href="https://facebook.com" target="_blank" class="text-dark">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.messenger.com/" target="_blank" class="text-dark">
                            <i class="fab fa-facebook-messenger"></i>
                        </a>
                    </div>
                </div>
                <div class="body">
                    <p class="text-xl mb-0"><?php echo $full_name; ?></p>
                    <span class="text-sm text-grey">Professor</span>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "<p class='text-center text-danger'>No professors found.</p>";
}
?>

                                </div>

                            </div>
                        </div>
                    </div> <!-- .container -->
                </div> <!-- .page-section -->










                <!-- Footer -->
                <?php include('includes/footer.php'); ?>

                <script src="../../assets/js/jquery-3.5.1.min.js"></script>

                <script src="../../assets/js/bootstrap.bundle.min.js"></script>

                <script src="../../assets/vendor/wow/wow.min.js"></script>

                <script src="../../assets/js/theme.js"></script>

            </body>

            </html>