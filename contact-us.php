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
     <title>CPSU BSIT Web Portal || Contact us</title>
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
                         <li class="breadcrumb-item active" aria-current="page">News</li>
                     </ol>
                 </nav>
                 <h1 class="font-weight-normal">News</h1>
             </div> <!-- .container -->
         </div> <!-- .banner-section -->
     </div> <!-- .page-banner -->



     <!-- Page Content -->
     <div class="container">

         <?php
            $pagetype = 'contactus';
            $query = mysqli_query($con, "select PageTitle,Description from tblpages where PageName='$pagetype'");
            while ($row = mysqli_fetch_array($query)) { ?>

             <h1 class="mt-5 mb-3 text-center  wow fadeInRight"><?php echo htmlentities($row['PageTitle']) ?></h1>

             <!-- Intro Content -->
             <div class="row">

                 <div class="col-lg-12  wow fadeInLeft" style="text-align: center;">

                     <p><?php echo $row['Description']; ?></p>
                 </div>
             </div>
             <!-- /.row -->
         <?php } ?>
     </div>
     <!-- /.container -->








     <div class="page-section">
         <div class="container">
             <h1 class="text-center wow fadeInUp">Get In Touch</h1>
             <form class="main-form">
                 <div class="row mt-5">
                     <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
                         <input type="text" class="form-control" placeholder="Full Name">
                     </div>
                     <div class="col-12 col-sm-6 py-2 wow fadeInRight">
                         <input type="email" class="form-control" placeholder="Email Address">
                     </div>
                     <div class="col-12 py-2 wow fadeInUp">
                         <textarea name="message" class="form-control" rows="6" placeholder="Enter Message"></textarea>
                     </div>
                 </div>
                 <button type="submit" class="btn btn-primary mt-3 wow zoomIn">Send Message</button>
             </form>
         </div>
     </div>
     </div>

     <div class="maps-container wow fadeInUp">
         <div class="responsive-map">
             <iframe
                 src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d980.9179023218929!2d123.35990996159614!3d10.447612092268333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a93f4321fa90b3%3A0x5a32a445f78a1f2f!2sCentral%20Philippines%20State%20University%20-%20Don%20Justo%20V.%20Valmayor%20Campus!5e0!3m2!1sen!2sph!4v1731682023909!5m2!1sen!2sph"
                 width="600"
                 height="450"
                 style="border:0;"
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

 </body>


 </html>