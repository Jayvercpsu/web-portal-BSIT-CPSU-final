<?php if (!isset($query)) {
    die("Query not set.");
} ?>
<div class="container-fluid latest-news py-2">
    <div class="container py-2">
        <h2 class="mb-4 text-dark fw-bold">Latest News</h2>
        <div class="latest-news-carousel owl-carousel owl-theme" style="background-color: #f5f9f6;">
            <?php
            mysqli_data_seek($query, 0); // Reset the query pointer
            while ($row = mysqli_fetch_assoc($query)) {
                $title = strip_tags($row['PostTitle']);
                $details = strip_tags($row['PostDetails']);
                $images = explode(",", htmlspecialchars($row['PostImage'])); // Split images by commas
                $firstImage = trim($images[0]); // Get only the first image
            ?>
                <div class="latest-news-item">
                    <div class=" rounded shadow-sm card-equal">
                        <div class="rounded-circle overflow-hidden latest-news-img-container text-dark">
                            <img src="admin/postimages/<?php echo $firstImage; ?>"
                                class="img-fluid"
                                alt="<?php echo $title; ?>">
                        </div>
                        <div class="p-4 d-flex flex-column h-100">
                            <a href="view-post.php?id=<?php echo $row['id']; ?>" class="h4 text-dark text-decoration-none latest-news-title">
                                <?php echo $title; ?>
                            </a>
                            <p class="text-dark flex-grow-1">
                                <?php echo substr($details, 0, 100); ?>...
                            </p>
                            <small class="text-dark">
                                <i class="fas fa-calendar-alt"></i>
                                <?php echo date("M d, Y", strtotime($row['PostingDate'])); ?>
                            </small>
                            <div class="mt-3 mt-auto">
                                <a href="view-post.php?id=<?php echo $row['id']; ?>" class="btn btn-primary px-4 py-2">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>



<!-- Include Owl Carousel -->
<link rel="stylesheet" href="assets/vendor/owl-carousel/css/owl.carousel.css">
<link rel="stylesheet" href="assets/vendor/owl-carousel/css/owl.theme.default.css">
<script src="assets/vendor/owl-carousel/owl.carousel.min.js"></script>

<script>
    $(document).ready(function() {
        $(".latest-news-carousel").owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    });
</script>

<!-- Latest News Styling -->
<style>
    /* Ensure smooth hover effect */
    .latest-news-item {
        transition: transform 0.3s ease-in-out;
    }

    .latest-news-item:hover {
        transform: scale(1.05);
    }

    .latest-news-item {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .latest-news-item {
        transition: transform 0.3s ease-in-out;
        overflow: hidden;
    }

    .latest-news-item:hover {
        transform: scale(1.05);
    }

    .latest-news-img-container {
        width: 150px;
        height: 150px;
        margin: 0 auto;
        border-radius: 50%;
        overflow: hidden;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .latest-news-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease-in-out;
    }

    .latest-news-img-container:hover img {
        transform: scale(1.1);
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
    }

    .card-equal {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .latest-news-item {
        display: flex;
        height: 100%;
        /* Full height for each item */
    }

    .card-equal {
        display: flex;
        flex-direction: column;
        height: 100%;
        /* Force the card to be the same height */
        min-height: 450px;
        /* Set minimum height for all cards */
    }

    .p-4 {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        /* Make content stretch to fill available space */
    }

    .mt-auto {
        margin-top: auto;
        /* Push Read More button to the bottom */
    }

    .latest-news-img-container {
        width: 150px;
        height: 150px;
        margin: 15px auto;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .latest-news-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }



    /* Title hover effect */
    .latest-news-title:hover {
        color: #007bff;
        text-decoration: underline;
    }

    /* Navigation buttons */
    .owl-nav {
        position: absolute;
        top: 50%;
        width: 100%;
        transform: translateY(-50%);
        display: flex;
        justify-content: space-between;
        pointer-events: none;
    }

    .owl-nav button {
        pointer-events: all;
        background: rgba(0, 0, 0, 0.7) !important;
        color: white !important;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        transition: background 0.3s, transform 0.3s;
    }

    .owl-nav button:hover {
        background: rgba(0, 0, 0, 0.9) !important;
        transform: scale(1.1);
    }

    .owl-prev {
        margin-left: -50px;
    }

    .owl-next {
        margin-right: -50px;
    }

    @media (max-width: 768px) {
        .owl-prev {
            margin-left: -30px;
        }

        .owl-next {
            margin-right: -30px;
        }

        .latest-news-img-container {
            width: 120px;
            height: 120px;
        }
    }
</style>