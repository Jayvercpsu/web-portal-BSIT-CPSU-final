<?php
include('includes/config.php');

// Get post ID from URL
$postid = intval($_GET['id']);

// Fetch post details
$query = mysqli_query($con, "SELECT * FROM tblposts WHERE id = '$postid' AND Is_Active = 1");
$post = mysqli_fetch_array($query);

// Redirect if post not found
if (!$post) {
    header("Location: index.php");
    exit();
}

// Truncate and clean PostDetails (remove HTML tags & limit text length)
$postDetails = strip_tags($post['PostDetails']);
$postDetails = substr($postDetails, 0, 200) . "...";

// Fetch related posts (same category, excluding current post)
$relatedQuery = mysqli_query($con, "SELECT id, PostTitle, PostImage FROM tblposts WHERE id != '$postid' AND Is_Active = 1 ORDER BY RAND()");

// Fetch latest posts for sidebar
$latestQuery = mysqli_query($con, "SELECT id, PostTitle, PostImage FROM tblposts WHERE Is_Active = 1 ORDER BY id DESC LIMIT 9");
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
</head>

<body>

    <?php include('includes/header.php'); ?>

    <div class="container my-5">
        <div class="row" style="margin-top: 10%;">

            <!-- Left Section: Full Post -->
            <div class="col-lg-9">
                <div class="card shadow-sm p-4">
                    <button class="btn btn-sm btn-outline-secondary mb-3" onclick="goBack()">← Back</button>

                    <!-- Post Details -->
                    <h2 class="fw-bold"><?php echo htmlentities($post['PostTitle']); ?></h2>

                    <div class="image-container">
                        <img src="admin/postimages/<?php echo htmlentities($post['PostImage']); ?>" class="img-fluid rounded w-100 zoom-image">
                    </div>

                    <p class="lead mt-3"><?php echo nl2br(htmlentities($postDetails)); ?></p>
                    <p class="text-muted">
                        <i class="fa fa-user"></i> Posted by Admin |
                        <i class="fa fa-calendar-alt"></i> <?php echo date("M d, Y h:i A", strtotime($post['PostingDate'])); ?>
                    </p>

                </div>

                <!-- Related Posts -->
                <h3 class="mt-5 fw-bold">Related Posts</h3>
                <div class="row">
                    <?php while ($related = mysqli_fetch_array($relatedQuery)) { ?>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm h-100 d-flex flex-column">
                                <div class="image-container">
                                    <img src="admin/postimages/<?php echo htmlentities($related['PostImage']); ?>"
                                        class="card-img-top zoom-image fixed-size-image">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title"><?php echo htmlentities($related['PostTitle']); ?></h6>
                                    <a href="view-post.php?id=<?php echo htmlentities($related['id']); ?>"
                                        class="btn btn-primary btn-sm mt-auto">Read More</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>


            </div>

            <!-- Right Section: Sidebar -->
            <div class="col-md-3">
                <!-- Latest Post Thumbnail -->
                <?php if ($latest = mysqli_fetch_array($latestQuery)) { ?>
                    <div class="mb-3">
                        <div class="image-container">
                            <img src="admin/postimages/<?php echo htmlentities($latest['PostImage']); ?>" class="w-100 rounded zoom-image">
                        </div>
                    </div>
                <?php } ?>

                <!-- Quick Links -->
                <h4 class="mb-3 fw-bold">Quick Links</h4>
                <ul class="list-group shadow-sm">
                    <li class="list-group-item"><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                    <li class="list-group-item"><a href="about-us.php"><i class="fa fa-info-circle"></i> About Us</a></li>
                    <li class="list-group-item"><a href="contact-us.php"><i class="fa fa-phone"></i> Contact</a></li>
                    <li class="list-group-item"><a href="users/grade_inquiry/input-student-id.php"><i class="fa fa-graduation-cap"></i> Grade Inquiry</a></li>
                </ul>


                <!-- Latest Posts -->
                <h4 class="mt-4 fw-bold">Latest Posts</h4>
                <ul class="list-group shadow-sm latest-posts-list">
                    <?php while ($latest = mysqli_fetch_array($latestQuery)) { ?>
                        <li class="list-group-item p-3">
                            <a href="view-post.php?id=<?php echo htmlentities($latest['id']); ?>"
                                class="d-flex align-items-center text-decoration-none text-dark">
                                <div class="flex-shrink-0 rounded overflow-hidden me-3" style="width: 60px; height: 60px;">
                                    <img src="admin/postimages/<?php echo htmlentities($latest['PostImage']); ?>"
                                        class="img-fluid w-100 h-100" style="object-fit: cover;">
                                </div>
                                <span class="fw-semibold"><?php echo htmlentities($latest['PostTitle']); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

    <style>
        body {
            background-color: #f8f9fa;
        }


        .text-muted {
            font-size: 14px;
        }

        .card {
            border-radius: 10px;
            background: white;
            padding: 20px;
        }

        .latest-posts-list {
            max-height: 400px;
            /* Limit height */
            overflow-y: auto;
            /* Enable scrolling */
        }


        .list-group-item a {
            text-decoration: none;
            color: #333;
            transition: 0.3s;
        }

        .list-group-item a:hover {
            color: #007bff;
        }

        .list-group-item a {
            display: flex;
            align-items: center;
            gap: 10px;
            /* Adds space between image and text */
        }

        .list-group-item img {
            border-radius: 5px;
        }

        .card-title {
            font-size: 1rem;
            font-weight: bold;
        }

        /* Hover Zoom Effect (Image only zooms inside the box) */
        .image-container {
            overflow: hidden;
            border-radius: 10px;
        }

        .zoom-image {
            transition: transform 0.3s ease-in-out;
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .image-container:hover .zoom-image {
            transform: scale(1.1);
        }
    </style>

    <?php include('includes/footer.php'); ?>

    <script src="./assets/js/jquery-3.5.1.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>