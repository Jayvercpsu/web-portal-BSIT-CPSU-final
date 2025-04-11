<?php
if (!isset($query)) {
    die("Query not set.");
}

$first = true; // initialize for carousel "active" class
?>

<div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="3000">
    <div class="carousel-inner">
        <?php
        while ($row = mysqli_fetch_assoc($query)) {
            $images = explode(",", htmlspecialchars($row['PostImage']));
            $cloudinaryImages = explode(",", $row['cloudinary_url']);
            $isCloudinary = filter_var($_ENV['ENABLE_CLOUDINARY'], FILTER_VALIDATE_BOOLEAN);

            // Choose first available image
            $firstImage = $isCloudinary ? trim($cloudinaryImages[0]) : 'admin/postimages/' . trim($images[0]);

            $title = htmlspecialchars(strip_tags($row['PostTitle']));
            $details = strip_tags($row['PostDetails']);
            $date = date("M d, Y h:i A", strtotime($row['PostingDate']));
        ?>
            <div class="carousel-item <?php echo $first ? 'active' : ''; ?>">
                <div class="page-hero bg-image overlay-dark" style="background-image: url('<?php echo $firstImage; ?>');">
                    <div class="hero-section d-flex align-items-center">
                        <div class="container text-center text-white">
                            <span class="subhead d-block mb-2 fs-5">Latest News</span>
                            <h1 class="display-5"><?php echo $title; ?></h1>
                            <p class="lead"><?php echo substr($details, 0, 100); ?>...</p>

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
    $(document).ready(function () {
        $('#carouselExample').carousel({
            interval: 3000,
            pause: 'hover'
        });
    });
</script>

<!-- Optional Styling -->
<style>
    .posted-info {
        font-size: 0.9rem;
        color: #ddd; /* Light grey text */
        font-weight: 300;
        letter-spacing: 0.5px;
    }

    .posted-info i {
        margin-right: 5px;
        color: #007bff; /* Blue icon */
    }
    
    /* Adjust carousel height */
    .carousel-inner {
        height: 350px; /* Reduced from 450px */
    }
    
    .page-hero {
        height: 350px; /* Match carousel-inner height */
    }
    
    .hero-section {
        min-height: 350px; /* Match carousel-inner height */
        padding: 20px 0; /* Reduced padding */
    }
    
    /* Adjust text sizes for smaller carousel */
    .hero-section h1 {
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
    }
    
    .hero-section p {
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
    
    .hero-section .btn {
        padding: 0.25rem 0.75rem;
        font-size: 0.9rem;
    }
</style>