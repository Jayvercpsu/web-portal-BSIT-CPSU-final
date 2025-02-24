    <!-- Latest News Start -->
    <div class="container-fluid latest-news py-2 bg-white">
        <div class="container py-2">
            <h2 class="mb-4 text-dark fw-bold">Latest News</h2>
            <div class="latest-news-carousel owl-carousel owl-theme">
                <!-- News Item 1 -->
                <div class="latest-news-item">
                    <div class="bg-light rounded shadow-sm">
                        <div class="rounded-top overflow-hidden">
                            <img src="img/news-7.jpg" class="img-fluid rounded-top w-100" alt="News 7">
                        </div>
                        <div class="d-flex flex-column p-4">
                            <a href="#" class="h4 text-dark text-decoration-none">Lorem Ipsum is simply dummy text...</a>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="small text-muted">by Willum Skeem</a>
                                <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> Dec 9, 2024</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- News Item 2 -->
                <div class="latest-news-item">
                    <div class="bg-light rounded shadow-sm">
                        <div class="rounded-top overflow-hidden">
                            <img src="img/news-6.jpg" class="img-fluid rounded-top w-100" alt="News 6">
                        </div>
                        <div class="d-flex flex-column p-4">
                            <a href="#" class="h4 text-dark text-decoration-none">Lorem Ipsum is simply dummy text...</a>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="small text-muted">by Willum Skeem</a>
                                <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> Dec 9, 2024</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- News Item 3 -->
                <div class="latest-news-item">
                    <div class="bg-light rounded shadow-sm">
                        <div class="rounded-top overflow-hidden">
                            <img src="img/news-3.jpg" class="img-fluid rounded-top w-100" alt="News 3">
                        </div>
                        <div class="d-flex flex-column p-4">
                            <a href="#" class="h4 text-dark text-decoration-none">Lorem Ipsum is simply dummy text...</a>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="small text-muted">by Willum Skeem</a>
                                <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> Dec 9, 2024</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- News Item 4 -->
                <div class="latest-news-item">
                    <div class="bg-light rounded shadow-sm">
                        <div class="rounded-top overflow-hidden">
                            <img src="img/news-4.jpg" class="img-fluid rounded-top w-100" alt="News 4">
                        </div>
                        <div class="d-flex flex-column p-4">
                            <a href="#" class="h4 text-dark text-decoration-none">Lorem Ipsum is simply dummy text...</a>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="small text-muted">by Willum Skeem</a>
                                <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> Dec 9, 2024</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- News Item 5 -->
                <div class="latest-news-item">
                    <div class="bg-light rounded shadow-sm">
                        <div class="rounded-top overflow-hidden">
                            <img src="img/news-5.jpg" class="img-fluid rounded-top w-100" alt="News 5">
                        </div>
                        <div class="d-flex flex-column p-4">
                            <a href="#" class="h4 text-dark text-decoration-none">Lorem Ipsum is simply dummy text...</a>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="small text-muted">by Willum Skeem</a>
                                <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> Dec 9, 2024</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Latest News End -->
    <style>
        /* Latest News Styling */
        .latest-news-item {
            transition: transform 0.3s ease-in-out;
        }

        .latest-news-item:hover {
            transform: scale(1.05);
        }

        /* Ensure Image & Content Fit Well */
        .latest-news-item img {
            height: 220px;
            /* Set a uniform height */
            object-fit: cover;
            /* Crop image instead of stretching */
            border-radius: 10px;
        }

        /* Background & Text Colors */
        .bg-light {
            background-color: #f8f9fa !important;
        }

        .text-dark {
            color: #212529 !important;
        }

        .shadow-sm {
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1) !important;
        }

        /* Owl Carousel Navigation Arrows - Move Outside */
        .owl-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            transform: translateY(-50%);
            display: flex;
            justify-content: space-between;
            pointer-events: none;
            /* Allows clicks on slides */
        }

        .owl-nav button {
            pointer-events: all;
            background: rgba(0, 0, 0, 0.7) !important;
            color: white !important;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            transition: background 0.3s;
        }

        .owl-nav button:hover {
            background: rgba(0, 0, 0, 0.9) !important;
        }

        .owl-prev {
            margin-left: -60px;
            /* Moves arrow further left */
        }

        .owl-next {
            margin-right: -60px;
            /* Moves arrow further right */
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .owl-prev {
                margin-left: -30px;
                /* Adjust position for smaller screens */
            }

            .owl-next {
                margin-right: -30px;
            }

            .latest-news-item img {
                height: 180px;
                /* Reduce image size on smaller screens */
            }
        }
    </style>