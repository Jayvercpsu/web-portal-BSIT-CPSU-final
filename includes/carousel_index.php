

<!-- Bootstrap Carousel -->
<div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="3000">
    <div class="carousel-inner">
        <?php
        while ($row = mysqli_fetch_assoc($query)) {
            $image = htmlspecialchars($row['PostImage']);
            $title = htmlspecialchars($row['PostTitle']);
            $details = htmlspecialchars($row['PostDetails']);
        ?>
            <div class="carousel-item <?php echo $first ? 'active' : ''; ?>">
                <div class="page-hero bg-image overlay-dark" style="background-image: url('admin/postimages/<?php echo $image; ?>');">
                    <div class="hero-section d-flex align-items-center">
                        <div class="container text-center text-white wow zoomIn mt-5">
                            <span class="subhead d-block mb-2 fs-5">Latest News</span>
                            <h1 class="display-5 fw-bold"><?php echo $title; ?></h1>
                            <p class="lead"><?php echo substr($details, 0, 100); ?>...</p> <!-- Preview with 100 characters -->
                            <a href="news-details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary mt-4 px-5 py-2">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            $first = false; // Set false after first iteration
        }
        ?>
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

<!-- Initialize Carousel -->
<script>
    $(document).ready(function() {
        $('#carouselExample').carousel({
            interval: 3000 // Slide every 3 seconds
        });
    });
</script>
