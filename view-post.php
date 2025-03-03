<?php
include('includes/config.php');

// Get post ID from URL
$postid = intval($_GET['id']);

if ($postid) {
    // Increment view counter (only once per session)
    if (!isset($_SESSION["viewed_$postid"])) {
        $updateViews = mysqli_query($con, "UPDATE tblposts SET viewCounter = viewCounter + 1 WHERE id = '$postid'");
        $_SESSION["viewed_$postid"] = true;
    }
}

// Fetch post details
$query = mysqli_query($con, "SELECT * FROM tblposts WHERE id = '$postid' AND Is_Active = 1");
$post = mysqli_fetch_array($query);

// Redirect if post not found
if (!$post) {
    header("Location: index.php");
    exit();
}

$postDetails = strip_tags($post['PostDetails']);
$postDetails = substr($postDetails, 0, 200) . "...";

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
</head>

<body>

    <?php include('includes/header.php'); ?>

    <div class="container my-5">
        <div class="row">
           
        <!-- Left Section -->
            <div class="col-lg-9">
            <div class="card shadow-sm p-4">
    <button class="btn btn-sm btn-outline-secondary mb-3" onclick="goBack()">← Back</button>
    <h2 class="fw-bold"><?php echo htmlentities($post['PostTitle']); ?></h2>

    <p class="text-muted">
        <i class="fa fa-user"></i> Admin &nbsp;|&nbsp;
        <i class="fa fa-clock"></i> <?php echo date("M d, Y h:i A", strtotime($post['PostingDate'])); ?> &nbsp;|&nbsp;
        <i class="fas fa-eye"></i> <?php echo htmlentities($post['viewCounter']); ?> Views
    </p>

    <img src="admin/postimages/<?php echo htmlentities($post['PostImage']); ?>" class="img-fluid rounded mb-4">

    <!-- Post Details with Read More -->
    <div class="post-details">
        <div class="post-content">
            <?php echo nl2br(htmlentities($post['PostDetails'])); ?>
        </div>
        <div class="btn-container">
            <button id="toggle" class="btn btn-outline-primary btn-sm">Read More</button>
        </div>
    </div>
</div>



                <!-- Related Posts -->
                <h3 class="mt-5 fw-bold">Related Posts</h3>
                <div class="row">
                    <?php while ($related = mysqli_fetch_array($relatedQuery)) { ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="admin/postimages/<?php echo htmlentities($related['PostImage']); ?>" class="card-img-top">
                                <div class="card-body">
                                    <h6><?php echo htmlentities($related['PostTitle']); ?></h6>
                                    <a href="view-post.php?id=<?php echo htmlentities($related['id']); ?>" class="btn btn-primary btn-sm">Read More</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>


            <!-- Sidebar -->
            <div class="col-lg-3">
                <h4 class="fw-bold">Latest Posts</h4>
                <ul class="list-group latest-posts-scroll">
                    <?php while ($latest = mysqli_fetch_array($latestQuery)) { ?>
                        <li class="list-group-item">
                            <a href="view-post.php?id=<?php echo htmlentities($latest['id']); ?>" class="d-flex align-items-center">
                                <img src="admin/postimages/<?php echo htmlentities($latest['PostImage']); ?>" style="width: 80px; height: 60px;" class="me-3 rounded">
                                <?php echo htmlentities($latest['PostTitle']); ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>

                <!-- Quick Links -->
                <h4 class="mt-4 fw-bold">Quick Links</h4>
                <ul class="list-group shadow-sm">
                    <li class="list-group-item"><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                    <li class="list-group-item"><a href="about-us.php"><i class="fa fa-info-circle"></i> About Us</a></li>
                    <li class="list-group-item"><a href="contact-us.php"><i class="fa fa-phone"></i> Contact</a></li>
                    <li class="list-group-item"><a href="users/grade_inquiry/input-student-id.php"><i class="fa fa-graduation-cap"></i> Grade Inquiry</a></li>
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
        .post-content {
    overflow: hidden;
    max-height: 150px; /* Initially show 6 lines approximately */
    line-height: 1.6; /* Adjust line spacing */
    transition: max-height 0.6s ease-in-out;
}

.post-content.open {
    max-height: 1000px; /* Large height to reveal full content */
}

.btn-container {
    margin-top: 10px;
}

button {
    cursor: pointer;
    padding: 8px 12px;
    font-size: 14px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    transition: background 0.3s ease-in-out;
}

button:hover {
    background: #0056b3;
}


        .latest-posts-scroll {
            max-height: 400px;
            /* Fixed height for the sidebar */
            overflow-y: auto;
            /* Enable vertical scroll */
            padding-right: 5px;
            /* Prevent scrollbar overlap */
        }

        .latest-posts-scroll::-webkit-scrollbar {
            width: 6px;
            /* Customize scrollbar width */
        }

        .latest-posts-scroll::-webkit-scrollbar-thumb {
            background: #007bff;
            /* Scrollbar color */
            border-radius: 10px;
        }

        .latest-posts-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            /* Track background */
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $("#toggle").click(function () {
        $(".post-content").toggleClass("open");

        if ($(".post-content").hasClass("open")) {
            $("#toggle").text("Read Less");
        } else {
            $("#toggle").text("Read More");
        }
    });
});
</script>



</body>

</html>