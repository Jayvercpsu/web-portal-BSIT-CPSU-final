    <?php
    session_start();
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
        <title> CPSU BSIT Web Portal | News Page</title>
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



        <div class="page-hero bg-image overlay-dark" style="background-image: url('images/sample_bsit.jpg');">
            <div class="hero-section d-flex align-items-center">
                <div class="container text-center text-white wow zoomIn">
                    <span class="subhead d-block mb-2 fs-5">CPSU BSIT Department</span>
                    <h1 class="display-5 fw-bold">Empowering Future IT Professionals</h1>
                    <a href="about-us.php" class="btn btn-primary mt-4 px-5 py-2">Learn More</a>
                </div>
            </div>
        </div>


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
                                <p><span>Chat</span> with IT Experts</p>
                            </div>
                        </div>
                        <div class="col-md-4 py-3 py-md-0">
                            <div class="card-service wow fadeInUp">
                                <div class="circle-shape">
                                    <span class="mai-shield-checkmark"></span>
                                </div>
                                <p><span>Secure</span> Systems</p>
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





        <div class="page-section pb-0" id="about">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 py-3 wow fadeInUp">
                        <h1>Welcome to the CPSU BSIT Program</h1>
                        <p class="text-grey mb-4">
                            At CPSU, the Bachelor of Science in Information Technology program equips students with the skills and knowledge to lead in a technology-driven world. From software development to networking, our curriculum fosters innovation and problem-solving in the field of IT.
                        </p>
                        <a href="#courses" class="btn btn-primary">Discover Courses</a>
                    </div>
                    <div class="col-lg-6 wow fadeInRight" data-wow-delay="400ms">
                        <div class="img-place custom-img-1">
                            <img src="images/sample2.jpg" alt="CPSU Students">
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
                                <h1 class="text-center mb-5 wow fadeInUp">Meet Our Faculty</h1>
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






        <div class="page-section bg-light" id="news">
            <div class="container">
                <h1 class="text-center text-dark wow fadeInUp">Latest News</h1>
                <div class="row mt-5">
                    <div class="col-lg-4 py-2 wow zoomIn">
                        <div class="card-blog">
                            <div class="header">
                                <div class="post-category">
                                    <a href="#">Events</a>
                                </div>
                                <a href="news-details.html" class="post-thumb">
                                    <img src="./assets/img/news/news_1.jpg" alt="">
                                </a>
                            </div>
                            <div class="body">
                                <h5 class="post-title"><a href="news-details.html">CPSU Hackathon 2024</a></h5>
                                <div class="site-info">
                                    <div class="avatar mr-2">
                                        <div class="avatar-img">
                                            <img src="./assets/img/person/person_1.jpg" alt="">
                                        </div>
                                        <span>Admin</span>
                                    </div>
                                    <span class="mai-time"></span> 2 weeks ago
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 py-2 wow zoomIn">
                        <div class="card-blog">
                            <div class="header">
                                <div class="post-category">
                                    <a href="#">Awards</a>
                                </div>
                                <a href="news-details.html" class="post-thumb">
                                    <img src="./assets/img/news/news_2.jpg" alt="">
                                </a>
                            </div>
                            <div class="body">
                                <h5 class="post-title"><a href="news-details.html">CPSU BSIT Tops Regional IT Competition</a></h5>
                                <div class="site-info">
                                    <div class="avatar mr-2">
                                        <div class="avatar-img">
                                            <img src="./assets/img/person/person_2.jpg" alt="">
                                        </div>
                                        <span>Admin</span>
                                    </div>
                                    <span class="mai-time"></span> 1 month ago
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center mt-4 wow zoomIn">
                    <a href="news.html" class="btn btn-primary">View All News</a>
                </div>
            </div>
        </div>

        <div class="page-section">
            <div class="container">
                <h1 class="text-center wow fadeInUp">Contact Us</h1>
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























        <!-- Footer -->
        <?php include('includes/footer.php'); ?>

        <script src="./assets/js/jquery-3.5.1.min.js"></script>

        <script src="./assets/js/bootstrap.bundle.min.js"></script>

        <script src="./assets/vendor/wow/wow.min.js"></script>

        <script src="./assets/js/theme.js"></script>
    </body>


    </html>