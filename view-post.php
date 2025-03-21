<?php
include('includes/config.php');
session_start();

$postid = intval($_GET['id']);

if ($postid > 0) {
    $sessionKey = "viewed_$postid";
    if (!isset($_SESSION[$sessionKey])) {
        $updateViews = mysqli_query($con, "UPDATE tblposts SET viewCounter = viewCounter + 1 WHERE id = $postid");
        if ($updateViews) {
            $_SESSION[$sessionKey] = true; // Set session to avoid duplicate views
        }
    }
}

$query = mysqli_query($con, "SELECT * FROM tblposts WHERE id = $postid AND Is_Active = 1");
$post = mysqli_fetch_array($query);

if (!$post) {
    header("Location: index.php");
    exit();
}

$postDetails = strip_tags($post['PostDetails']);
$images = explode(",", $post['PostImage']);

// Fetch updated viewCounter after increment
$latestPostQuery = mysqli_query($con, "SELECT viewCounter FROM tblposts WHERE id = '$postid'");
$latestPost = mysqli_fetch_array($latestPostQuery);

// Fetch related posts
$relatedQuery = mysqli_query($con, "SELECT id, PostTitle, PostImage FROM tblposts WHERE id != '$postid' AND Is_Active = 1 ORDER BY RAND()");

// Fetch latest posts for sidebar
$latestQuery = mysqli_query($con, "SELECT id, PostTitle, PostImage FROM tblposts WHERE Is_Active = 1 ORDER BY id DESC");
?>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo htmlentities($postDetails); ?>">
    <meta name="author" content="CPSU BSIT Web Portal">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

    <title><?php echo htmlentities($post['PostTitle']) . " - Details"; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/icons.css">
    <link rel="stylesheet" href="css/view-post.css">

</head>

<body style="
    background-image: url('https://static.vecteezy.com/system/resources/previews/006/699/632/original/technology-connection-circuit-system-design-background-abstract-free-vector.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
">
</body>

    <?php include('includes/header.php'); ?>

    <div class="container my-5">
        <div class="row">

            <!-- Left Section -->
            <div class="col-lg-9">
                <div class="card shadow-sm p-4">
                    <button class="btn btn-sm btn-outline-secondary mb-3" onclick="goBack()">← Back</button>
                    <h2 class="fw-bold"><?php echo htmlentities($post['PostTitle']); ?></h2>
                    <p class="text-muted">
                        <i class="fa fa-user"></i> Admin |
                        <i class="fa fa-clock"></i> <?php echo date("M d, Y h:i A", strtotime($post['PostingDate'])); ?> |
                        <i class="fas fa-eye"></i> <?php echo htmlentities($post['viewCounter']); ?> Views

                    </p>


                    <div id="postCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Carousel Indicators -->
                        <div class="carousel-indicators">
                            <?php foreach ($images as $index => $image) { ?>
                                <button type="button" data-target="#postCarousel"
                                    data-slide-to="<?php echo $index; ?>"
                                    class="<?php echo $index == 0 ? 'active' : ''; ?>"></button>
                            <?php } ?>
                        </div>

                        <!-- Carousel Images -->
                        <div class="carousel-inner">
                            <?php foreach ($images as $index => $image) { ?>
                                <div class="carousel-item <?php echo $index == 0 ? 'active' : ''; ?>">
                                    <img src="admin/postimages/<?php echo htmlentities($image); ?>" class="d-block w-100 rounded zoom-image" alt="Post Image">
                                </div>
                            <?php } ?>
                        </div>

                        <!-- Navigation Arrows -->
                        <button class="carousel-control-prev" type="button" data-target="#postCarousel" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-target="#postCarousel" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>



                    <!-- Post Details -->
                    <div class="post-details mt-4">
                        <div class="post-content" style="text-align: justify;">
                            <?php echo $postDetails; ?>
                        </div>
                        <div class="btn-container">
                            <button id="toggle" class="btn btn-outline-primary btn-sm">Read More</button>
                        </div>
                    </div>

                </div>




                <h3 class="mt-5 fw-bold">Related Posts</h3>
                <div class="row">
                    <?php
                    while ($related = mysqli_fetch_array($relatedQuery)) {
                        $images = explode(",", $related['PostImage']); // Split images by commas
                        $firstImage = trim($images[0]); // Get the first image only
                    ?>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm h-100 d-flex flex-column">
                                <div class="rounded overflow-hidden">
                                    <img src="admin/postimages/<?php echo htmlentities($firstImage); ?>" class="card-img-top zoom-image" style="height: 200px; object-fit: cover;">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h6 class="fw-bold mb-2"><?php echo htmlentities($related['PostTitle']); ?></h6>
                                    <a href="view-post.php?id=<?php echo htmlentities($related['id']); ?>" class="btn btn-primary btn-sm mt-auto">Read More</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>


            </div>


            <!-- Sidebar -->
            <div class="col-lg-3">
                <h4 class="fw-bold text-white">Latest Posts</h4>
                <ul class="list-group latest-posts-scroll">
                    <?php
                    while ($latest = mysqli_fetch_array($latestQuery)) {
                        $images = explode(",", $latest['PostImage']); // Split images by commas
                        $firstImage = trim($images[0]); // Get the first image only
                    ?>
                        <li class="list-group-item list-group-item-action p-3">
                            <a href="view-post.php?id=<?php echo htmlentities($latest['id']); ?>" class="d-flex align-items-center text-decoration-none gap-3">
                                <div class="flex-shrink-0 rounded overflow-hidden" style="width: 80px; height: 60px; border: 1px solid #ddd;">
                                    <img src="admin/postimages/<?php echo htmlentities($firstImage); ?>" class="img-fluid w-100 h-100" style="object-fit: cover;">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 fw-semibold"><?php echo htmlentities($latest['PostTitle']); ?></h6>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                </ul>




                <!-- Quick Links -->
                <h4 class="mt-4 fw-bold text-white">Quick Links</h4>
                <ul class="list-group shadow-sm">
                    <li class="list-group-item">
                        <a href="index.php" class="quick-link"><i class="fa fa-home"></i> Home</a>
                    </li>
                    <li class="list-group-item">
                        <a href="about-us.php" class="quick-link"><i class="fa fa-info-circle"></i> About Us</a>
                    </li>
                    <li class="list-group-item">
                        <a href="contact-us.php" class="quick-link"><i class="fa fa-phone"></i> Contact</a>
                    </li>
                    <li class="list-group-item">
                        <a href="users/grade_inquiry/input-student-id.php" class="quick-link"><i class="fa fa-graduation-cap"></i> Grade Inquiry</a>
                    </li>
                </ul>

            </div>





        </div>
    </div>


    <script>
        function goBack() {
            window.history.back();
        }
    </script>


    <?php include('includes/footer.php'); ?>

    <script src="./assets/js/jquery-3.5.1.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#toggle").click(function() {
                $(".post-content").toggleClass("open");

                if ($(".post-content").hasClass("open")) {
                    $("#toggle").text("Read Less");
                } else {
                    $("#toggle").text("Read More");
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#postCarousel').carousel({
                interval: 3000, // Auto slide every 3 seconds
                pause: 'hover', // Pause on hover
                ride: 'carousel'
            });

            $(".carousel-control-prev, .carousel-control-next").click(function() {
                $('#postCarousel').carousel('cycle');
            });
        });
    </script>




    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Your Custom JS -->
    <script>
        $(document).ready(function() {
            $('#postCarousel').carousel();
        });
    </script>

</body>

</html>