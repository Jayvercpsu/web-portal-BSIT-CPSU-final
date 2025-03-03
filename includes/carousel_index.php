<?php if (!isset($query)) {
    die("Query not set.");
} ?>
<div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="3000">
    <div class="carousel-inner">
        <?php
        while ($row = mysqli_fetch_assoc($query)) {
            $image = htmlspecialchars($row['PostImage']);
            $title = htmlspecialchars(strip_tags($row['PostTitle']));
            $details = strip_tags($row['PostDetails']);
            $date = date("M d, Y h:i A", strtotime($row['PostingDate'])); // Format date and time
        ?>
            <div class="carousel-item <?php echo $first ? 'active' : ''; ?>">
                <div class="page-hero bg-image overlay-dark" style="background-image: url('admin/postimages/<?php echo $image; ?>');">
                    <div class="hero-section d-flex align-items-center">
                        <div class="container text-center text-white">
                            <span class="subhead d-block mb-2 fs-5">Latest News</span>
                            <h1><?php echo $title; ?></h1>

                            <p><?php echo substr($details, 0, 100); ?>...</p>

                            <!-- Posted by Admin with Date and Time -->
                            <div class="posted-info mb-2">
                                <small>
                                    <i class="fas fa-user"></i> Posted by Admin on <?php echo $date; ?>
                                </small>
                            </div>

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

<!-- Optional Styling -->
<style>
    .posted-info {
        font-size: 0.9rem;
        /* Smaller text */
        color: #ddd;
        /* Light grey for better contrast */
        font-weight: 300;
        letter-spacing: 0.5px;
    }

    .posted-info i {
        margin-right: 5px;
        /* Space between icon and text */
        color: #007bff;
        /* Blue icon */
    }
</style>