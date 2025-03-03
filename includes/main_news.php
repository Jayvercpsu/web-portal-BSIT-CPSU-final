<?php
// Fetch the latest post (for the large image)
$latestPostQuery = mysqli_query($con, "SELECT id, PostTitle, PostDetails, PostImage, PostingDate, viewCounter FROM tblposts WHERE Is_Active = 1 ORDER BY id DESC LIMIT 1");
$latestPost = mysqli_fetch_array($latestPostQuery);

// Fetch the second latest post (for the "Top Story" section)
// Fetch the second latest post (for the "Top Story" section)
$secondPostQuery = mysqli_query($con, "SELECT id, PostTitle, PostDetails, PostImage, PostingDate, viewCounter FROM tblposts WHERE Is_Active = 1 ORDER BY id DESC LIMIT 1,1");
$secondPost = mysqli_fetch_array($secondPostQuery);

// Fetch the next latest 5 posts for the sidebar
$sidePostsQuery = mysqli_query($con, "SELECT id, PostTitle, PostImage, PostingDate, viewCounter FROM tblposts WHERE Is_Active = 1 ORDER BY id DESC");
?>

<div class="container my-5">
    <div class="row">
        <!-- Left Section: Large Featured Post -->
        <div class="col-lg-8">
            <?php if ($latestPost) { ?>
                <div class="position-relative card shadow-sm border-0 overflow-hidden">
                    <img src="admin/postimages/<?php echo htmlentities($latestPost['PostImage']); ?>"
                        class="img-fluid w-100 rounded"
                        style="height: 450px; object-fit: cover;">

                    <div class="position-absolute bottom-0 w-100 p-4 text-white" style="background: rgba(0,0,0,0.6);">
                        <h2 class="fw-bold mb-2"><?php echo htmlentities($latestPost['PostTitle']); ?></h2>
                        <p class="small mb-2">
                            <i class="fas fa-user"></i> Admin &nbsp;|&nbsp;
                            <i class="fas fa-clock"></i> <?php echo date("M d, Y", strtotime($latestPost['PostingDate'])); ?> &nbsp;|&nbsp;
                            <i class="fas fa-eye"></i> <?php echo htmlentities($latestPost['viewCounter']); ?> Views
                        </p>
                        <p class="small mb-3">
                            <?php echo substr(htmlentities(strip_tags($latestPost['PostDetails'])), 0, 150) . '...'; ?>
                        </p>
                        <a href="view-post.php?id=<?php echo htmlentities($latestPost['id']); ?>" class="btn btn-primary btn-sm">Read More</a>
                    </div>
                </div>
            <?php } ?>

            <!-- Top Story -->
            <?php if ($secondPost) { ?>
                <h3 class="mt-4 fw-bold">Top Story</h3>
                <div class="card shadow-sm border-0 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="admin/postimages/<?php echo htmlentities($secondPost['PostImage']); ?>"
                                class="img-fluid w-100 rounded"
                                style="height: 180px; object-fit: cover;">
                        </div>
                        <div class="col-md-8 p-3 d-flex flex-column justify-content-center">
                            <h5 class="fw-bold mb-2"><?php echo htmlentities($secondPost['PostTitle']); ?></h5>
                            <p class="text-muted small">
                                <i class="fas fa-user"></i> Admin &nbsp;|&nbsp;
                                <i class="fas fa-clock"></i> <?php echo date("M d, Y", strtotime($secondPost['PostingDate'])); ?> &nbsp;|&nbsp;
                                <i class="fas fa-eye"></i> <?php echo htmlentities($secondPost['viewCounter']); ?> Views
                            </p>
                            <p class="small text-secondary">
                                <?php echo substr(htmlentities(strip_tags($secondPost['PostDetails'])), 0, 120) . '...'; ?>
                            </p>
                            <a href="view-post.php?id=<?php echo htmlentities($secondPost['id']); ?>"
                                class="btn btn-primary btn-sm align-self-start">Read More</a>
                        </div>
                    </div>
                </div>
            <?php } ?>



        </div>

        <!-- Right Section: Sidebar -->
        <div class="col-lg-4">

            <h4 class="mb-3 fw-bold">Latest Post</h4>
            <div class="list-group latest-news-list">
                <?php while ($sidePost = mysqli_fetch_array($sidePostsQuery)) { ?>
                    <a href="view-post.php?id=<?php echo htmlentities($sidePost['id']); ?>"
                        class="list-group-item list-group-item-action d-flex align-items-center p-3 gap-3">
                        <div class="flex-shrink-0 rounded overflow-hidden" style="width: 80px; height: 60px;">
                            <img src="admin/postimages/<?php echo htmlentities($sidePost['PostImage']); ?>"
                                class="img-fluid w-100 h-100"
                                style="object-fit: cover;">
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-semibold"><?php echo htmlentities($sidePost['PostTitle']); ?></h6>
                        </div>
                    </a>
                <?php } ?>
            </div>


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


<style>
    /* General Styles */
    .card {
        border-radius: 10px;
        overflow: hidden;
    }

    .latest-news-list {
        max-height: 400px;
        /* Limit height */
        overflow-y: auto;
        /* Enable scroll */
    }

    /* Ensure balanced alignment for Top Story */
    .top-story .row {
        align-items: center;
    }

    /* Text Preview Styling */
    .top-story p {
        font-size: 0.9rem;
        line-height: 1.4;
    }

    /* Button Adjustment */
    .btn-sm {
        font-size: 0.85rem;
        padding: 5px 12px;
    }

    .list-group-item {
        border: none;
        transition: background-color 0.3s ease-in-out;
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
    }

    /* Featured Post Overlay */
    .position-absolute {
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        padding: 20px;
    }

    /* Image Hover Zoom Effect */
    .card img,
    .list-group-item img {
        transition: transform 0.3s ease-in-out;
        object-fit: cover;
    }

    .card:hover img,
    .list-group-item:hover img {
        transform: scale(1.1);
    }
</style>