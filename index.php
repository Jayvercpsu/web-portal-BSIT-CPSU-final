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

 
    <!-- Bootstrap Carousel -->
    <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="3000">
        <div class="carousel-inner">

            <!-- First Slide -->
            <div class="carousel-item active">
                <div class="page-hero bg-image overlay-dark" style="background-image: url('images/sample_bsit.jpg');">
                    <div class="hero-section d-flex align-items-center">
                        <div class="container text-center text-white wow zoomIn mt-5">
                            <span class="subhead d-block mb-2 fs-5">CPSU BSIT Department</span>
                            <h1 class="display-5 fw-bold">Empowering Future IT Professionals</h1>
                            <a href="about-us.php" class="btn btn-primary mt-4 px-5 py-2">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Slide -->
            <div class="carousel-item">
                <div class="page-hero bg-image overlay-dark" style="background-image: url('images/sample2.jpg');">
                    <div class="hero-section d-flex align-items-center">
                        <div class="container text-center text-white wow zoomIn mt-5">
                            <span class="subhead d-block mb-2 fs-5">Innovating Education</span>
                            <h1 class="display-5 fw-bold">Shaping Tomorrow's Leaders</h1>
                            <a href="about-us.php" class="btn btn-primary mt-4 px-5 py-2">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Third Slide -->
            <div class="carousel-item">
                <div class="page-hero bg-image overlay-dark" style="background-image: url('images/whole.jpg');">
                    <div class="hero-section d-flex align-items-center">
                        <div class="container text-center text-white wow zoomIn mt-5">
                            <span class="subhead d-block mb-2 fs-5">A New Era of Technology</span>
                            <h1 class="display-5 fw-bold">Leading the Digital Transformation</h1>
                            <a href="about-us.php" class="btn btn-primary mt-4 px-5 py-2">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carousel Controls -->
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <!-- Initialize Carousel (Optional for extra control) -->
    <script>
        $(document).ready(function() {
            $('#carouselExample').carousel({
                interval: 3000 // Slide every 5 seconds
            });
        });
    </script>





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





    <!-- <div class="page-section pb-0" id="about">
        <div class="container">
            <div class="row align-items-center" style="padding-bottom: 40px;">
                <div class="col-lg-6 py-3 wow fadeInUp">
                    <h1>Welcome to the CPSU BSIT Program</h1>
                    <p class="text-white mb-4">
                        At CPSU, the Bachelor of Science in Information Technology program equips students with the skills and knowledge to lead in a technology-driven world. From software development to networking, our curriculum fosters innovation and problem-solving in the field of IT.
                    </p>
                    <a href="news.php" class="btn btn-primary">Explore Updates</a>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="400ms">
                    <div class="img-place custom-img-1">
                        <img src="images/sample2.jpg" alt="CPSU Students">
                    </div>
                </div>
            </div>
        </div>
    </div> -->

<!-- Latest News Start -->
<div class="container-fluid latest-news py-5 bg-white">
    <div class="container py-5">
        <h2 class="mb-4 text-dark fw-bold">Latest News</h2>
        <div class="latest-news-carousel owl-carousel owl-theme">
            <!-- News Item 1 -->
            <div class="latest-news-item">
                <div class="bg-light rounded shadow-sm">
                    <div class="rounded-top overflow-hidden">
                        <img src="img/news-7.jpg" class="img-fluid rounded-top w-100" alt="News 7">
                    </div>
                    <div class="d-flex flex-column p-4">
                        <a href="#" class="h4 text-dark text-decoration-none">Lorem Ipsum is simply dummy text...</a>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="small text-muted">by Willum Skeem</a>
                            <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> Dec 9, 2024</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- News Item 2 -->
            <div class="latest-news-item">
                <div class="bg-light rounded shadow-sm">
                    <div class="rounded-top overflow-hidden">
                        <img src="img/news-6.jpg" class="img-fluid rounded-top w-100" alt="News 6">
                    </div>
                    <div class="d-flex flex-column p-4">
                        <a href="#" class="h4 text-dark text-decoration-none">Lorem Ipsum is simply dummy text...</a>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="small text-muted">by Willum Skeem</a>
                            <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> Dec 9, 2024</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- News Item 3 -->
            <div class="latest-news-item">
                <div class="bg-light rounded shadow-sm">
                    <div class="rounded-top overflow-hidden">
                        <img src="img/news-3.jpg" class="img-fluid rounded-top w-100" alt="News 3">
                    </div>
                    <div class="d-flex flex-column p-4">
                        <a href="#" class="h4 text-dark text-decoration-none">Lorem Ipsum is simply dummy text...</a>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="small text-muted">by Willum Skeem</a>
                            <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> Dec 9, 2024</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- News Item 4 -->
            <div class="latest-news-item">
                <div class="bg-light rounded shadow-sm">
                    <div class="rounded-top overflow-hidden">
                        <img src="img/news-4.jpg" class="img-fluid rounded-top w-100" alt="News 4">
                    </div>
                    <div class="d-flex flex-column p-4">
                        <a href="#" class="h4 text-dark text-decoration-none">Lorem Ipsum is simply dummy text...</a>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="small text-muted">by Willum Skeem</a>
                            <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> Dec 9, 2024</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- News Item 5 -->
            <div class="latest-news-item">
                <div class="bg-light rounded shadow-sm">
                    <div class="rounded-top overflow-hidden">
                        <img src="img/news-5.jpg" class="img-fluid rounded-top w-100" alt="News 5">
                    </div>
                    <div class="d-flex flex-column p-4">
                        <a href="#" class="h4 text-dark text-decoration-none">Lorem Ipsum is simply dummy text...</a>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="small text-muted">by Willum Skeem</a>
                            <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> Dec 9, 2024</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- Latest News End -->
<style>
  /* Latest News Styling */
.latest-news-item {
    transition: transform 0.3s ease-in-out;
}

.latest-news-item:hover {
    transform: scale(1.05);
}

/* Ensure Image & Content Fit Well */
.latest-news-item img {
    height: 220px; /* Set a uniform height */
    object-fit: cover; /* Crop image instead of stretching */
    border-radius: 10px;
}

/* Background & Text Colors */
.bg-light {
    background-color: #f8f9fa !important;
}

.text-dark {
    color: #212529 !important;
}

.shadow-sm {
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1) !important;
}

/* Owl Carousel Navigation Arrows - Move Outside */
.owl-nav {
    position: absolute;
    top: 50%;
    width: 100%;
    transform: translateY(-50%);
    display: flex;
    justify-content: space-between;
    pointer-events: none; /* Allows clicks on slides */
}

.owl-nav button {
    pointer-events: all;
    background: rgba(0, 0, 0, 0.7) !important;
    color: white !important;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    transition: background 0.3s;
}

.owl-nav button:hover {
    background: rgba(0, 0, 0, 0.9) !important;
}

.owl-prev {
    margin-left: -60px; /* Moves arrow further left */
}

.owl-next {
    margin-right: -60px; /* Moves arrow further right */
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .owl-prev {
        margin-left: -30px; /* Adjust position for smaller screens */
    }
    .owl-next {
        margin-right: -30px;
    }
    .latest-news-item img {
        height: 180px; /* Reduce image size on smaller screens */
    }
}

</style>

 <div class="row" style="margin-top: 4%">

            <!-- Blog Entries Column -->
            <div class="col-md-2 mt-4">

            </div>
            <div class="col-md-7">
                <h4 class="widget-title mb-4">Today <span>Highlight</span></h4>
                <!-- Blog Post -->
                <div class="row">


                    <?php
                    if (isset($_GET['pageno'])) {
                        $pageno = $_GET['pageno'];
                    } else {
                        $pageno = 1;
                    }
                    $no_of_records_per_page = 8;
                    $offset = ($pageno - 1) * $no_of_records_per_page;


                    $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
                    $result = mysqli_query($con, $total_pages_sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $no_of_records_per_page);


                    $query = mysqli_query($con, "select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 order by tblposts.id desc  LIMIT $offset, $no_of_records_per_page");
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                        <div class="col-md-6">
                            <div class="card mb-4 border-0">
                                <img class="card-img-top" src="admin/postimages/<?php echo htmlentities($row['PostImage']); ?>" alt="<?php echo htmlentities($row['posttitle']); ?>" height="200px">
                                <div class="card-body">
                                    <p class="m-0">
                                        <!--category-->
                                        <a class="badge bg-dark text-decoration-none link-light" href="category.php?catid=<?php echo htmlentities($row['cid']) ?>" style="color:#fff"><?php echo htmlentities($row['category']); ?></a>
                                        <!--Subcategory--->
                                        <a class="badge bg-warning text-decoration-none link-light" style="color:#fff"><?php echo htmlentities($row['subcategory']); ?></a>
                                    </p>
                                    <p class="m-0"><small> Posted on <?php echo htmlentities($row['postingdate']); ?></small></p>
                                    <a href="news-details.php?nid=<?php echo htmlentities($row['pid']) ?>" class="card-title text-decoration-none text-dark">
                                        <h5 class="card-title"><?php echo htmlentities($row['posttitle']); ?></h5>
                                    </a>
                                    <!-- <a href="news-details.php?nid=<?php echo htmlentities($row['pid']) ?>" class="">Read More &rarr;</a> -->
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-md-12">


                        <!-- Pagination -->
                        <!-- <ul class="pagination justify-content-center mb-4">
                            <li class="page-item"><a href="?pageno=1"  class="page-link border-0">First</a></li>
                            <li class="<?php if ($pageno <= 1) {
                                            echo 'disabled';
                                        } ?> page-item">
                            <a href="<?php if ($pageno <= 1) {
                                            echo '#';
                                        } else {
                                            echo "?pageno=" . ($pageno - 1);
                                        } ?>" class="page-link border-0">Prev</a>
                            </li>
                            <li class="<?php if ($pageno >= $total_pages) {
                                            echo 'disabled';
                                        } ?> page-item">
                            <a href="<?php if ($pageno >= $total_pages) {
                                            echo '#';
                                        } else {
                                            echo "?pageno=" . ($pageno + 1);
                                        } ?> " class="page-link border-0">Next</a>
                            </li>
                            <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link border-0">Last</a></li>
                            </ul> -->
                    </div>






                </div>

            </div>
            <!-- Sidebar Widgets Column -->
            <?php include('includes/sidebar.php'); ?>
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
            <a href="./users/login.php" class="btn btn-violet text-white btn-lg">Join Now</a>
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
    <div> 
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
        <!-- jQuery & Owl Carousel -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- Bootstrap JS (Already in Your Setup) -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Owl Carousel Initialization -->
<script>
$(document).ready(function(){
    $(".latest-news-carousel").owlCarousel({
        loop: true,             
        margin: 20,             
        nav: true,              /* Enable navigation arrows */
        dots: false,            
        autoplay: true,         
        autoplayTimeout: 4000,  
        autoplayHoverPause: true, 
        responsive:{
            0:{ items:1 },      
            600:{ items:2 },    
            1000:{ items:4 }    
        }
    });
});
</script>

</body>


</html>