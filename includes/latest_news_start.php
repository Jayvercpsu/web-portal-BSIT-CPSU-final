<!-- Latest News Start -->
<div class="container-fluid latest-news py-2 bg-white">
    <div class="container py-2">
        <h2 class="mb-4 text-dark fw-bold">Latest News</h2>
        <div class="latest-news-carousel owl-carousel owl-theme">
            <?php while ($row = mysqli_fetch_array($query)) { ?>
                <div class="latest-news-item">
                    <div class="bg-light rounded shadow-sm">
                        <div class="rounded-circle overflow-hidden latest-news-img-container">
                            <img src="admin/postimages/<?php echo htmlentities($row['PostImage']); ?>" 
                                 class="img-fluid latest-news-img" 
                                 alt="<?php echo htmlentities($row['PostTitle']); ?>">
                        </div>
                        <div class="d-flex flex-column p-4">
                            <a href="view-post.php?id=<?php echo htmlentities($row['id']); ?>" 
                               class="h4 text-dark text-decoration-none latest-news-title">
                               <?php echo htmlentities($row['PostTitle']); ?>
                            </a>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="small text-muted">
                                    <i class="fa fa-user me-1"></i> Posted by Admin
                                </a>
                                <small class="text-muted">
                                    <i class="fas fa-calendar-alt me-1"></i> 
                                    <?php echo date("M d, Y", strtotime($row['PostingDate'])); ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- Latest News End -->

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
                0: { items: 1 },
                600: { items: 2 },
                1000: { items: 3 }
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

    /* Circular Image Styling */
    .latest-news-img-container {
        width: 150px; 
        height: 150px; 
        margin: 15px auto;
        border-radius: 50%;
        overflow: hidden;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    /* Make images circular */
    .latest-news-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease-in-out;
    }

    /* Image hover effect */
    .latest-news-img-container:hover {
        transform: scale(1.1);
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
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
