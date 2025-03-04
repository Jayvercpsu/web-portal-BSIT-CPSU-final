<?php
$latestPostQuery = mysqli_query($con, "SELECT id, PostTitle, PostDetails, PostImage, PostingDate, viewCounter FROM tblposts WHERE Is_Active = 1 ORDER BY id DESC");
$latestPost = mysqli_fetch_array($latestPostQuery);

$secondPostQuery = mysqli_query($con, "SELECT id, PostTitle, PostDetails, PostImage, PostingDate, viewCounter FROM tblposts WHERE Is_Active = 1 ORDER BY id DESC");
$secondPost = mysqli_fetch_array($secondPostQuery);



// Fetch the next latest posts for the sidebar
$sidePostsQuery = mysqli_query($con, "SELECT id, PostTitle, PostImage, PostingDate, viewCounter FROM tblposts WHERE Is_Active = 1 ORDER BY id DESC");
?>

<div class="container my-5" style="background-color:#f5f9f6; padding: 20px;">
    <div class="row">
        <!-- Left Section: Featured Post -->
        <div class="col-lg-8">
            <?php if ($latestPost) {
                $latestImages = explode(",", $latestPost['PostImage']);
                $latestFirstImage = trim($latestImages[0]); ?>
                <div class="position-relative card shadow-sm border-0 overflow-hidden">
                    <img src="admin/postimages/<?php echo htmlentities($latestFirstImage); ?>"
                        class="img-fluid w-100 rounded zoom-image"
                        style="height: 450px; object-fit: cover;">

                    <div class="position-absolute bottom-0 w-100 p-4 text-dark" style="background-color:#f5f9f6; padding: 20px; opacity: .8;">
                        <h2 class="fw-bold mb-2 text-dark"><?php echo htmlentities($latestPost['PostTitle']); ?></h2>
                        <p class="small mb-2">
                            <i class="fas fa-user"></i> Admin &nbsp;|&nbsp;
                            <i class="fas fa-clock"></i> <?php echo date("M d, Y", strtotime($latestPost['PostingDate'])); ?> &nbsp;|&nbsp;
                            <i class="fas fa-eye"></i> <?php echo htmlentities($latestPost['viewCounter']); ?> Views
                        </p>


                        <p class="small text-dark">
                            <?php echo substr(strip_tags($latestPost['PostDetails']), 0, 150) . '...'; ?>
                        </p>
                        <a href="view-post.php?id=<?php echo htmlentities($latestPost['id']); ?>" class="btn btn-primary btn-sm">Read More</a>
                    </div>
                </div>
            <?php } ?>

            <!-- Top Story -->
            <?php if ($secondPost) {
                $secondImages = explode(",", $secondPost['PostImage']);
                $secondFirstImage = trim($secondImages[0]); ?>
                <h3 class="mt-4 fw-bold text-dark">Top Story</h3>
                <div class="card shadow-sm border-0 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="admin/postimages/<?php echo htmlentities($secondFirstImage); ?>"
                                class="img-fluid w-100 rounded zoom-image"
                                style="height: 180px; object-fit: cover;">
                        </div>
                        <div class="col-md-8 p-3 d-flex flex-column justify-content-center">
                            <h5 class="fw-bold mb-2 text-dark"><?php echo htmlentities($secondPost['PostTitle']); ?></h5>
                            <p class="small text-muted">
                                <i class="fas fa-user"></i> Admin &nbsp;|&nbsp;
                                <i class="fas fa-clock"></i> <?php echo date("M d, Y", strtotime($secondPost['PostingDate'])); ?> &nbsp;|&nbsp;
                                <i class="fas fa-eye"></i> <?php echo htmlentities($secondPost['viewCounter']); ?> Views
                            </p>
                            <p class="small text-dark">
                                <?php echo substr(strip_tags($secondPost['PostDetails']), 0, 120) . '...'; ?>
                            </p>
                            <a href="view-post.php?id=<?php echo htmlentities($secondPost['id']); ?>" class="btn btn-primary btn-sm">Read More</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <h4 class="fw-bold text-dark">Latest Posts</h4>
            <div class="list-group latest-news-list">
                <?php while ($sidePost = mysqli_fetch_array($sidePostsQuery)) {
                    $sideImages = explode(",", $sidePost['PostImage']);
                    $sideFirstImage = trim($sideImages[0]); ?>
                    <a href="view-post.php?id=<?php echo htmlentities($sidePost['id']); ?>" class="list-group-item list-group-item-action d-flex align-items-center p-3 gap-3" style="">
                        <div class="flex-shrink-0 rounded overflow-hidden" style="width: 80px; height: 60px;">
                            <img src="admin/postimages/<?php echo htmlentities($sideFirstImage); ?>" class="img-fluid w-100 h-100" style="object-fit: cover;">
                        </div>
                        <div class="flex-grow-1 m-3">
                            <h6 class="mb-0 fw-semibold"><?php echo htmlentities($sidePost['PostTitle']); ?></h6>
                        </div>
                    </a>
                <?php } ?>
            </div>

            <!-- Quick Links -->
            <h4 class="mt-4 fw-bold text-dark">Quick Links</h4>
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
    .card {
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.02);
    }

    .latest-news-list {
        max-height: 400px;
        overflow-y: auto;
        padding-right: 10px;
    }

    .latest-news-list::-webkit-scrollbar {
        width: 6px;
    }

    .latest-news-list::-webkit-scrollbar-thumb {
        background: #007bff;
        border-radius: 10px;
    }

    .zoom-image {
        transition: transform 0.3s ease-in-out;
        object-fit: cover;
    }

    .zoom-image:hover {
        transform: scale(1.1);
    }

    .position-absolute {
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        color: white;
    }

    .list-group-item:hover {
        background: #f8f9fa;
    }

    /* Featured Post Overlay */
    .position-absolute {
        bottom: 0;
        left: 0;
        right: 0;
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