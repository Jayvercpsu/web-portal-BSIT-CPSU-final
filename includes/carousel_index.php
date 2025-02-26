    <!-- Bootstrap Carousel -->
    <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="3000">
        <div class="carousel-inner">

            <!-- First Slide -->
            <div class="carousel-item active">
                <div class="page-hero bg-image overlay-dark" style="background-image: url('images/sample_bsit.jpg');">
                    <div class="hero-section d-flex align-items-center">
                        <div class="container text-center text-white wow zoomIn mt-5">
                            <span class="subhead d-block mb-2 fs-5">CPSU BSIT Department</span>
                            <h1 class="display-5 fw-bold">Empowering Future IT Professionals</h1>
                            <a href="about-us.php" class="btn btn-primary mt-4 px-5 py-2">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Slide -->
            <div class="carousel-item">
                <div class="page-hero bg-image overlay-dark" style="background-image: url('images/sample2.jpg');">
                    <div class="hero-section d-flex align-items-center">
                        <div class="container text-center text-white wow zoomIn mt-5">
                            <span class="subhead d-block mb-2 fs-5">Innovating Education</span>
                            <h1 class="display-5 fw-bold">Shaping Tomorrow's Leaders</h1>
                            <a href="about-us.php" class="btn btn-primary mt-4 px-5 py-2">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Third Slide -->
            <div class="carousel-item">
                <div class="page-hero bg-image overlay-dark" style="background-image: url('images/whole.jpg');">
                    <div class="hero-section d-flex align-items-center">
                        <div class="container text-center text-white wow zoomIn mt-5">
                            <span class="subhead d-block mb-2 fs-5">A New Era of Technology</span>
                            <h1 class="display-5 fw-bold">Leading the Digital Transformation</h1>
                            <a href="about-us.php" class="btn btn-primary mt-4 px-5 py-2">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
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


    <!-- Initialize Carousel (Optional for extra control) -->
    <script>
        $(document).ready(function() {
            $('#carouselExample').carousel({
                interval: 3000 // Slide every 5 seconds
            });
        });
    </script>
