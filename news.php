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
    <link rel="stylesheet" href="css/icons.css">

    <link rel="stylesheet" href="./assets/css/maicons.css">

    <link rel="stylesheet" href="./assets/css/bootstrap.css">

    <link rel="stylesheet" href="./assets/vendor/owl-carousel/css/owl.carousel.css">

    <link rel="stylesheet" href="./assets/vendor/animate/animate.css">

    <link rel="stylesheet" href="./assets/css/theme.css">




</head>
<style>
    .breadcrumb li {
        margin-top: 10px;
    }
</style>

<body>

    <!-- Navigation -->
    <?php include('includes/header.php'); ?>


    <div class="page-banner overlay-dark bg-image" style="background-image: url(images/sample_bsit.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <br><br>
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">News</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">News</h1>
            </div> <!-- .container -->
        </div> <!-- .banner-section -->
    </div> <!-- .page-banner -->








    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row" style="margin-top: 4%">
            <!-- Blog Entries Column -->
            <div class="col-md-2 mt-4">

            </div>
            <div class="col-md-7">
                <h4 class="widget-title mb-4">Today <span>Highlight</span></h4>
                <!-- Blog Post -->
                <div class="row">
                    <div class="owl-carousel owl-theme" id="slider">
                        <div class="card mb-4 border-0">
                            <img class="card-img-top" src="admin/assets/images/01.jpg" alt="" width="100%">
                            <div class="card-body">
                                <p class="m-0">
                                    <!--category-->
                                    <a class="badge bg-dark text-decoration-none link-light" href="#" style="color:#fff">Sports</a>
                                    <!--Subcategory--->
                                    <a class="badge bg-warning text-decoration-none link-light" style="color:#fff">Sports</a>
                                </p>
                                <p class="m-0"><small> Posted on 2022-11-11 00:20:09</small></p>
                                <a href="#" class="card-title text-decoration-none text-dark">
                                    <h5 class="card-title">FIFA World Cup 2022: Semi-final 1, England vs New Zealand Who Said What</h5>
                                </a>
                                <!-- <a href="news-details.php?nid=<?php echo htmlentities($row['pid']) ?>" class="">Read More &rarr;</a> -->
                            </div>
                        </div>
                        <div class="card mb-4 border-0">
                            <img class="card-img-top" src="admin/postimages/8bc5c30be91dca9d07c1db858c60e39f.jpg" alt="" width="100%">
                            <div class="card-body">
                                <p class="m-0">
                                    <!--category-->
                                    <a class="badge bg-dark text-decoration-none link-light" href="#" style="color:#fff">Sports</a>
                                    <!--Subcategory--->
                                    <a class="badge bg-warning text-decoration-none link-light" style="color:#fff">Sports</a>
                                </p>
                                <p class="m-0"><small> Posted on 2022-11-11 00:20:09</small></p>
                                <a href="#" class="card-title text-decoration-none text-dark">
                                    <h5 class="card-title">T20 World Cup 2022: Semi-final 1, England vs New Zealand Who Said What</h5>
                                </a>
                                <!-- <a href="news-details.php?nid=<?php echo htmlentities($row['pid']) ?>" class="">Read More &rarr;</a> -->
                            </div>
                        </div>
                        <div class="card mb-4 border-0">
                            <img class="card-img-top" src="admin/postimages/8bc5c30be91dca9d07c1db858c60e39f.jpg" alt="" width="100%">
                            <div class="card-body">
                                <p class="m-0">
                                    <!--category-->
                                    <a class="badge bg-dark text-decoration-none link-light" href="#" style="color:#fff">Sports</a>
                                    <!--Subcategory--->
                                    <a class="badge bg-warning text-decoration-none link-light" style="color:#fff">Sports</a>
                                </p>
                                <p class="m-0"><small> Posted on 2022-11-11 00:20:09</small></p>
                                <a href="#" class="card-title text-decoration-none text-dark">
                                    <h5 class="card-title">T20 World Cup 2022: Semi-final 1, England vs New Zealand Who Said What</h5>
                                </a>
                                <!-- <a href="news-details.php?nid=<?php echo htmlentities($row['pid']) ?>" class="">Read More &rarr;</a> -->
                            </div>
                        </div>
                    </div>
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


                    <!-- Static -->
                    <div class="col-md-12">
                        <div class="card mb-4 mt-5 border-0">
                            <div class="row g-3">
                                <!-- Vision Section -->
                                <div class="col-md-4 text-center">
                                    <img src="admin/assets/images/vision.jpg" alt="Vision" class="img-fluid rounded shadow-sm mb-2" draggable="false">
                                    <h5 class="text-dark">Vision</h5>
                                    <p class="text-secondary">Our vision is to create a better future through innovation and excellence.</p>
                                </div>
                                <!-- Mission Section -->
                                <div class="col-md-4 text-center">
                                    <img src="admin/assets/images/mission.jpg" alt="Mission" class="img-fluid rounded shadow-sm mb-2" draggable="false">
                                    <h5 class="text-dark">Mission</h5>
                                    <p class="text-secondary">Our mission is to empower individuals by providing exceptional learning opportunities.</p>
                                </div>
                                <!-- Objectives Section -->
                                <div class="col-md-4 text-center">
                                    <img src="admin/assets/images/objectives.jpg" alt="Objectives" class="img-fluid rounded shadow-sm mb-2" draggable="false">
                                    <h5 class="text-dark">Objectives</h5>
                                    <p class="text-secondary">Our objectives include fostering creativity, leadership, and a passion for learning.</p>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>

            </div>
            <!-- Sidebar Widgets Column -->
            <?php include('includes/sidebar.php'); ?>
        </div>

    </div>
    <!-- /.row -->
    </div>
    <!-- /.container -->
    <!-- Footer -->
    <?php include('includes/footer.php'); ?>



    <!-- Add wow.js for animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>



    <script src="./assets/js/jquery-3.5.1.min.js"></script>

    <script src="./assets/js/bootstrap.bundle.min.js"></script>

    <script src="./assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

    <script src="./assets/vendor/wow/wow.min.js"></script>

    <script src="./assets/js/theme.js"></script>

    <script src="js/foot.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script>
        $('#slider').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            dots: false,
            autoplay: true,
            animateOut: 'fadeOut',
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
        $('#slider2').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            dots: false,
            autoplay: true,
            animateOut: 'fadeOut',
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 4
                }
            }
        });
    </script>

</body>


</html>