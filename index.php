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
            <div class="container text-center text-white wow zoomIn mt-5">
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
                    <p class="text-white mb-4">
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




    <div class="container" id="about">
        <!-- Key Features of the BSIT Program Section -->
        <div class="text-center mb-5" style="margin-top: 10%;">
            <h2 class="text-white wow fadeInRight">Key Features of the BSIT Program</h2>
        </div>

        <div class="row mb-4">
            <!-- Industry-Oriented Curriculum -->
            <div class="col-md-4 mb-4  wow fadeInLeft">
                <div class="card h-100 shadow border border-violet">
                    <div class="card-body bg-black text-white rounded">
                        <h5 class="card-title text-violet">Industry-Oriented Curriculum</h5>
                        <p class="card-text">The curriculum is designed to address the latest trends and technologies in IT, ensuring that students are job-ready upon graduation.</p>
                    </div>
                </div>
            </div>

            <!-- Hands-on Learning -->
            <div class="col-md-4 mb-4  wow fadeInDown">
                <div class="card h-100 shadow border border-violet">
                    <div class="card-body bg-black text-white rounded">
                        <h5 class="card-title text-violet">Hands-on Learning</h5>
                        <p class="card-text">With state-of-the-art laboratories and technology-driven resources, students gain practical experience through real-world projects, internships, and laboratory sessions.</p>
                    </div>
                </div>
            </div>

            <!-- Skilled Faculty -->
            <div class="col-md-4 mb-4  wow fadeInRight">
                <div class="card h-100 shadow border border-violet">
                    <div class="card-body bg-black text-white rounded">
                        <h5 class="card-title text-violet">Skilled Faculty</h5>
                        <p class="card-text">The department boasts a team of highly qualified and experienced faculty members who are committed to the academic growth and development of students.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Why Choose BSIT at CPSU Section -->
        <div class="py-5">
            <div class="text-center mb-5 wow fadeInLeft">
                <h2 class="text-white">Why Choose BSIT at CPSU?</h2>
            </div>
            <div class="row">
                <!-- Modern Infrastructure -->
                <div class="col-md-4 mb-4  wow fadeInLeft">
                    <div class="card h-100 shadow border border-violet">
                        <div class="card-body bg-black text-white rounded">
                            <h5 class="card-title text-violet">Modern Infrastructure</h5>
                            <p class="card-text">Access to well-equipped computer labs and the latest software tools.</p>
                        </div>
                    </div>
                </div>

                <!-- Career Opportunities -->
                <div class="col-md-4 mb-4  wow fadeInDown">
                    <div class="card h-100 shadow border border-violet">
                        <div class="card-body bg-black text-white rounded">
                            <h5 class="card-title text-violet">Career Opportunities</h5>
                            <p class="card-text">Strong partnerships with top tech companies for internships and job placements.</p>
                        </div>
                    </div>
                </div>

                <!-- Student Support -->
                <div class="col-md-4 mb-4  wow fadeInRight">
                    <div class="card h-100 shadow border border-violet">
                        <div class="card-body bg-black text-white rounded">
                            <h5 class="card-title text-violet">Student Support</h5>
                            <p class="card-text">Our department offers mentorship, academic advising, and career counseling services to help students achieve their academic and professional goals.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Join Now Button Section -->
        <div class="text-center mb-5  wow fadeInUp">
            <a href="#" class="btn btn-violet text-white btn-lg">Join Now</a>
        </div>
    </div>

    <!-- Custom Bootstrap Violet Button Styling -->
    <style>
        .btn-violet {
            background-color: #6f42c1;
            border-color: #6f42c1;
        }

        .btn-violet:hover {
            background-color: #5a2a9b;
            border-color: #5a2a9b;
        }

        .text-violet {
            color: #6f42c1;
        }

        .bg-black {
            background-color: #000000;
        }

        /* Adding violet border to each card */
        .card {
            border: 2px solid #6f42c1;
            /* Violet border */
        }
    </style>






<?php
$pagetype = 'aboutus';
$query = mysqli_query($con, "select PageTitle,Description from tblpages where PageName='$pagetype'");
while ($row = mysqli_fetch_array($query)) {
?>
    <div class="page-section" style="display: flex; align-items: center; padding: 50px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Image on the left side -->
                <div class="col-lg-6 col-md-6 col-sm-12 wow fadeInLeft"
                    style="background-image: url('./assets/faculty_image/whole.jpg'); 
                           background-size: cover; 
                           background-position: center; 
                           height: 620px; 
                           width: 100%;
                           margin-top: 60px;
                           background-color: #ddd; /* Default color in case image fails */
                           border-radius: 10px;">
                </div>

                <!-- Text content on the right side -->
                <div class="col-lg-6 col-md-6 col-sm-12 wow fadeInUp"
                    style="background-color: rgba(0, 0, 0, 0.5); padding: 20px; border-radius: 10px;">
                    <h1 class="mt-5 mb-3 text-center text-white"><?php echo htmlentities($row['PageTitle']) ?></h1>
                    <div class="text-lg">
                        <div class="row">
                            <div class="col-12">
                                <p class="text-white"><?php echo $row['Description']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>




                    <div class="col-lg-10 mt-5">
                        <h1 class="text-center mb-5 wow fadeInUp">Meet Our Instructors</h1>
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-lg-4 wow zoomIn">
                                <div class="card-doctor">
                                    <div class="header">
                                        <img src="./assets/faculty_image/dandan.jpg" alt="">
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
                                            <a href="https://facebook.com" target="_blank" class="text-dark">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                            <a href="https://www.messenger.com/" target="_blank" class="text-dark">
                                                <i class="fab fa-facebook-messenger"></i>
                                            </a>
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
                                            <a href="https://facebook.com" target="_blank" class="text-dark">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                            <a href="https://www.messenger.com/" target="_blank" class="text-dark">
                                                <i class="fab fa-facebook-messenger"></i>
                                            </a>
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
                    <?php
                    // Limit to 3 posts for the homepage
                    $pageno = isset($_GET['pageno']) ? $_GET['pageno'] : 1;
                    $no_of_records_per_page = 3;  // Show only 3 posts initially
                    $offset = ($pageno - 1) * $no_of_records_per_page;

                    // Fetch total rows and calculate the total pages
                    $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
                    $result = mysqli_query($con, $total_pages_sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $no_of_records_per_page);

                    // Fetch the posts
                    $query = mysqli_query($con, "SELECT tblposts.id AS pid, tblposts.PostTitle AS posttitle, tblposts.PostImage, tblcategory.CategoryName AS category, tblcategory.id AS cid, tblsubcategory.Subcategory AS subcategory, tblposts.PostDetails AS postdetails, tblposts.PostingDate AS postingdate, tblposts.PostUrl AS url FROM tblposts LEFT JOIN tblcategory ON tblcategory.id = tblposts.CategoryId LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId = tblposts.SubCategoryId WHERE tblposts.Is_Active = 1 ORDER BY tblposts.id DESC LIMIT $offset, $no_of_records_per_page");

                    // Loop through the posts and display them
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                        <div class="col-md-6">
                            <div class="card mb-4 border-0">
                                <img class="card-img-top" src="./admin/postimages/<?php echo htmlentities($row['PostImage']); ?>" alt="<?php echo htmlentities($row['posttitle']); ?>" height="200px">
                                <div class="card-body">
                                    <p class="m-0">
                                        <!-- Category -->
                                        <a class="badge bg-dark text-decoration-none link-light" href="category.php?catid=<?php echo htmlentities($row['cid']) ?>" style="color:#fff"><?php echo htmlentities($row['category']); ?></a>
                                        <!-- Subcategory -->
                                        <a class="badge bg-warning text-decoration-none link-light" style="color:#fff"><?php echo htmlentities($row['subcategory']); ?></a>
                                    </p>
                                    <p class="m-0"><small>Posted on <?php echo htmlentities($row['postingdate']); ?></small></p>
                                    <a href="news-details.php?nid=<?php echo htmlentities($row['pid']) ?>" class="card-title text-decoration-none text-dark">
                                        <h5 class="card-title"><?php echo htmlentities($row['posttitle']); ?></h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <!-- Show More Button -->
                <div class="col-md-12 text-center">
                    <a href="news.php" class="btn btn-primary">Show More</a>
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
</body>


</html>