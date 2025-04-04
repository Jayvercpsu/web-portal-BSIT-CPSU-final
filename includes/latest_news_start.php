<?php if (!isset($query)) {
    die("Query not set.");
} ?>
<div class="container-fluid latest-news py-2">
    <div class="container py-2">
        <h2 class="mb-4 text-dark fw-bold text-center" style="font-weight: bold;">Latest News</h2>
        <div class="latest-news-carousel owl-carousel owl-theme" style="background-color: #f5f9f6;">
            <?php
            mysqli_data_seek($query, 0); // Reset the query pointer
            while ($row = mysqli_fetch_assoc($query)) {
                $title = strip_tags($row['PostTitle']);
                $details = strip_tags($row['PostDetails']);
                $images = explode(",", htmlspecialchars($row['PostImage'])); // Split images by commas
                $firstImage = trim($images[0]); // Get only the first image
                
                // Limit title length for consistency
                $truncatedTitle = (strlen($title) > 60) ? substr($title, 0, 60) . '...' : $title;
                
                // Limit details to exactly 100 characters for consistency
                $truncatedDetails = substr($details, 0, 100) . '...';
            ?>
                <div class="latest-news-item">
                    <div class="rounded shadow card-equal bg-white">
                        <div class="circle-image-container">
                            <div class="circle-image">
                                <img src="admin/postimages/<?php echo $firstImage; ?>"
                                    class="img-fluid"
                                    alt="<?php echo $truncatedTitle; ?>">
                            </div>
                        </div>
                        <div class="p-4 d-flex flex-column h-100">
                            <a href="view-post.php?id=<?php echo $row['id']; ?>" class="h4 text-dark text-decoration-none latest-news-title truncate-title">
                                <?php echo $truncatedTitle; ?>
                            </a>
                            <p class="text-dark flex-grow-1 truncate-details">
                                <?php echo $truncatedDetails; ?>
                            </p>
                            <small class="text-dark">
                                <i class="fas fa-calendar-alt"></i>
                                <?php echo date("M d, Y", strtotime($row['PostingDate'])); ?>
                            </small>
                            <div class="mt-3 text-center">
                                <a href="view-post.php?id=<?php echo $row['id']; ?>" class="btn btn-primary px-2 py-1" style="font-size: 16px;">
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

<style>
    .latest-news-item {
        transition: transform 0.3s ease-in-out;
        margin: 10px 5px;
    }

    .latest-news-item:hover {
        transform: scale(1.03);
    }

    .card-equal {
        height: 450px;
        width: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        transition: box-shadow 0.3s ease;
    }
    
    .card-equal:hover {
        box-shadow: 0 12px 24px rgba(0,0,0,0.2);
    }

    /* Enhanced circular image styling */
    .circle-image-container {
        display: flex;
        justify-content: center;
        padding-top: 20px;
    }
    
    .circle-image {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        border: 4px solid #fff;
        position: relative;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .circle-image:hover {
        transform: scale(1.08);
        box-shadow: 0 6px 16px rgba(0,0,0,0.3);
    }
    
    .circle-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    
    .circle-image:hover img {
        transform: scale(1.15);
    }

    .p-4 {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .truncate-title {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 50px;
    }

    .truncate-details {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 80px;
    }

    .mt-auto {
        margin-top: auto;
    }

    .latest-news-title:hover {
        color: #007bff;
        text-decoration: underline;
    }

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
        
        .circle-image {
            width: 130px;
            height: 130px;
        }
        
        .card-equal {
            height: 400px;
        }
    }
</style>    