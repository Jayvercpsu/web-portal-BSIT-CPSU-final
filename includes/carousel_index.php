<?php if (!isset($query)) { die("Query not set."); } ?>
<div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="3000">
    <div class="carousel-inner">
        <?php
        while ($row = mysqli_fetch_assoc($query)) {
            $image = htmlspecialchars($row['PostImage']);
            $title = htmlspecialchars(strip_tags($row['PostTitle']));
            $details = strip_tags($row['PostDetails']);
        ?>
        <div class="carousel-item <?php echo $first ? 'active' : ''; ?>">
            <div class="page-hero bg-image overlay-dark" style="background-image: url('admin/postimages/<?php echo $image; ?>');">
                <div class="hero-section d-flex align-items-center">
                    <div class="container text-center text-white">
                        <span class="subhead d-block mb-2 fs-5">Latest News</span>
                        <h1><?php echo $title; ?></h1>
                        <p><?php echo substr($details, 0, 100); ?>...</p>
                        <a href="view-post.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
            $first = false; 
        }
        ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>


<!-- Initialize Carousel -->
<script>
    $(document).ready(function() {
        $('#carouselExample').carousel({
            interval: 3000
        });
    });
</script>