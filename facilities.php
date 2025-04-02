<?php
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CPSU BSIT Facilities including laboratories and classrooms">
    <meta name="author" content="CPSU BSIT">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

    <title>CPSU BSIT Web Portal | Facilities</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/icons.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="./assets/css/maicons.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/vendor/owl-carousel/css/owl.carousel.css">
    <link rel="stylesheet" href="./assets/vendor/animate/animate.css">
    <link rel="stylesheet" href="./assets/css/theme.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        .facility-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            margin-bottom: 30px;
            position: relative;
        }
        
        .facility-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        
        .facility-img {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }
        
        .facility-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
            padding: 20px;
            color: white;
        }
        
        .section-title {
            position: relative;
            margin-bottom: 40px;
            padding-bottom: 15px;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: #5e1195;
        }
        
        .room-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #5e1195;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }
        
        .facility-detail {
            padding: 20px;
            background: #fff;
        }
        
        .feature-icon {
            font-size: 20px;
            color: #5e1195;
            margin-right: 10px;
        }
        
        .lab-section, .classroom-section {
            padding: 50px 0;
        }
        
        .lab-section {
            background-color: #f8f9fa;
        }
        
        .classroom-section {
            background-color: #fff;
        }
        
        @media (max-width: 768px) {
            .facility-card {
                margin-top: 20px;
            }
            
            .section-title {
                margin-top: 20px;
            }
        }
        
        .smart-hub-section {
            background: linear-gradient(135deg, #6a11cb 0%,rgb(173, 43, 224) 100%);
            color: white;
            padding: 60px 0;
            margin: 40px 0;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        
        .smart-hub-img {
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            transition: transform 0.5s ease;
        }
        
        .smart-hub-img:hover {
            transform: scale(1.05);
        }
        
        /* Additional animated elements */
        .animated-icon {
            transition: all 0.3s ease;
        }
        
        .animated-icon:hover {
            transform: scale(1.2) rotate(10deg);
        }
        
        .bounce-animation {
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            40% {transform: translateY(-20px);}
            60% {transform: translateY(-10px);}
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {box-shadow: 0 0 0 0 rgba(94, 17, 149, 0.7);}
            70% {box-shadow: 0 0 0 10px rgba(94, 17, 149, 0);}
            100% {box-shadow: 0 0 0 0 rgba(94, 17, 149, 0);}
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <?php include('includes/header.php'); ?>

    <!-- Page Banner -->
    <div class="page-banner overlay-dark bg-image" style="background-image: url(images/sample_bsit.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <br><br>
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <h1 class="font-weight-normal">Our Facilities</h1>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Laboratory Facilities -->
    <div class="lab-section">
        <div class="container">
            <h2 class="text-center section-title" data-aos="fade-up">Computer Laboratories</h2>
            <p class="text-center mb-5" data-aos="fade-up" data-aos-delay="200">State-of-the-art learning environments equipped with the latest technology for hands-on experiences.</p>
            
            <div class="row">
                <!-- Lab 1 -->
                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="100">
                    <div class="facility-card wow fadeIn">
                        <span class="room-badge">Lab 1</span>
                        <img src="images/lab1.jpg" alt="Laboratory 1" class="facility-img">
                        <div class="facility-detail">
                            <h5>Programming Laboratory</h5>
                            <p>Equipped with high-performance computers for coding and programming practices.</p>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-desktop feature-icon animated-icon"></i>
                                <span>30 Workstations</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-tools feature-icon animated-icon"></i>
                                <span>IDE Software Suite</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Lab 2 -->
                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="200">
                    <div class="facility-card wow fadeIn">
                        <span class="room-badge">Lab 2</span>
                        <img src="images/lab2.jpg" alt="Laboratory 2" class="facility-img">
                        <div class="facility-detail">
                            <h5>Networking Laboratory</h5>
                            <p>Specialized for network configuration and system administration training.</p>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-network-wired feature-icon animated-icon"></i>
                                <span>Network Equipment</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-server feature-icon animated-icon"></i>
                                <span>Server Infrastructure</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Lab 3 -->
                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
                    <div class="facility-card wow fadeIn">
                        <span class="room-badge">Lab 3</span>
                        <img src="images/lab3.jpg" alt="Laboratory 3" class="facility-img">
                        <div class="facility-detail">
                            <h5>Multimedia Laboratory</h5>
                            <p>Designed for graphic design, video editing, and digital content creation.</p>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-photo-video feature-icon animated-icon"></i>
                                <span>Creative Suite</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-headphones feature-icon animated-icon"></i>
                                <span>Audio Equipment</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Lab 4 -->
                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="400">
                    <div class="facility-card wow fadeIn">
                        <span class="room-badge">Lab 4</span>
                        <img src="images/lab4.jpg" alt="Laboratory 4" class="facility-img">
                        <div class="facility-detail">
                            <h5>Database & Development Lab</h5>
                            <p>Focused on database management and software development projects.</p>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-database feature-icon animated-icon"></i>
                                <span>Database Servers</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-code-branch feature-icon animated-icon"></i>
                                <span>Version Control</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Smart Hub Section -->
    <div class="smart-hub-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6" data-aos="fade-right" data-aos-duration="1200">
                    <h2 class="mb-4">BSIT Smart Hub</h2>
                    <p class="lead">Our innovative smart hub integrates modern technology with collaborative learning environments.</p>
                    <p>The Smart Hub serves as the central technology nerve center for BSIT students, featuring:</p>
                    <ul class="list-unstyled mt-4">
                        <li class="mb-3"><i class="fas fa-check-circle mr-2 text-warning"></i> Advanced research stations</li>
                        <li class="mb-3"><i class="fas fa-check-circle mr-2 text-warning"></i> Collaborative workspaces</li>
                        <li class="mb-3"><i class="fas fa-check-circle mr-2 text-warning"></i> IoT development environment</li>
                        <li class="mb-3"><i class="fas fa-check-circle mr-2 text-warning"></i> 24/7 access for enrolled students</li>
                    </ul>
                    <button class="btn btn-light mt-3 bounce-animation">Take a Virtual Tour</button>
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-duration="1200">
                    <img src="images/smart-hub.jpg" alt="Smart Hub" class="img-fluid rounded smart-hub-img">
                </div>
            </div>
        </div>
    </div>
    
    <!-- Classroom Facilities -->
    <div class="classroom-section">
        <div class="container">
            <h2 class="text-center section-title" data-aos="fade-up">Lecture Rooms</h2>
            <p class="text-center mb-5" data-aos="fade-up" data-aos-delay="200">Modern classrooms designed for effective learning and collaboration.</p>
            
            <div class="row">
                <!-- Classroom A1 -->
                <div class="col-md-6" data-aos="flip-left" data-aos-duration="1000">
                    <div class="facility-card wow fadeInLeft">
                        <span class="room-badge">Room A1</span>
                        <img src="images/classroom-a1.jpg" alt="Classroom A1" class="facility-img">
                        <div class="facility-detail">
                            <h5>Interactive Lecture Room</h5>
                            <p>Modern classroom with interactive teaching tools and flexible seating arrangements.</p>
                            <div class="row mt-3">
                                <div class="col-6 d-flex align-items-center mb-2">
                                    <i class="fas fa-users feature-icon animated-icon"></i>
                                    <span>50 Capacity</span>
                                </div>
                                <div class="col-6 d-flex align-items-center mb-2">
                                    <i class="fas fa-chalkboard feature-icon animated-icon"></i>
                                    <span>Smart Board</span>
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <i class="fas fa-wifi feature-icon animated-icon"></i>
                                    <span>High-Speed WiFi</span>
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <i class="fas fa-air-conditioner feature-icon animated-icon"></i>
                                    <span>Air Conditioned</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Classroom A2 -->
                <div class="col-md-6" data-aos="flip-right" data-aos-duration="1000">
                    <div class="facility-card wow fadeInRight">
                        <span class="room-badge">Room A2</span>
                        <img src="images/classroom-a2.jpg" alt="Classroom A2" class="facility-img">
                        <div class="facility-detail">
                            <h5>Collaborative Learning Space</h5>
                            <p>Designed specifically for group work, presentations, and collaborative projects.</p>
                            <div class="row mt-3">
                                <div class="col-6 d-flex align-items-center mb-2">
                                    <i class="fas fa-users feature-icon animated-icon"></i>
                                    <span>40 Capacity</span>
                                </div>
                                <div class="col-6 d-flex align-items-center mb-2">
                                    <i class="fas fa-projector feature-icon animated-icon"></i>
                                    <span>Projector Systems</span>
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <i class="fas fa-plug feature-icon animated-icon"></i>
                                    <span>Power Stations</span>
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <i class="fas fa-microphone feature-icon animated-icon"></i>
                                    <span>Audio System</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include('includes/footer.php'); ?>

    <!-- Scripts -->
    <script src="./assets/js/jquery-3.5.1.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/vendor/wow/wow.min.js"></script>
    <script src="./assets/js/theme.js"></script>
    
    <!-- AOS Animation Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });
        
        // Additional animations for elements
        $(document).ready(function() {
            // Hover effects for icons
            $('.feature-icon').hover(
                function() { $(this).addClass('text-primary'); },
                function() { $(this).removeClass('text-primary'); }
            );
            
            // Scroll reveal animation
            $(window).scroll(function() {
                var scrollPos = $(window).scrollTop();
                
                $('.facility-card').each(function() {
                    var elemPos = $(this).offset().top;
                    
                    if (scrollPos + $(window).height() * 0.8 > elemPos) {
                        $(this).addClass('animate__animated animate__fadeIn');
                    }
                });
            });
        });
    </script>
</body>
</html>