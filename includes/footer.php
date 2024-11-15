<head>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* General Styling */
        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .footer-section {
            background: #151414;
            color: #fff;
            position: relative;
            padding-bottom: 40px;
        }

        .footer-cta {
            border-bottom: 1px solid #373636;
            padding: 40px 0;
        }

        .single-cta {
            display: flex;
            align-items: center;
            padding: 10px 0;
        }

        .single-cta i {
            color: white;
            font-size: 30px;
            margin-right: 15px;
        }

        .cta-text h4 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .cta-text span {
            color: #757575;
            font-size: 15px;
        }

        /* Footer Content */
        .footer-content {
            padding: 60px 0;
        }

        .footer-logo img {
            max-width: 200px;
            margin-bottom: 20px;
        }

        .footer-text p {
            font-size: 14px;
            color: #7e7e7e;
            line-height: 24px;
            margin-bottom: 15px;
        }

        .footer-social-icon span {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .footer-social-icon a {
            color: #fff;
            font-size: 16px;
            margin-right: 15px;
            transition: all 0.3s ease;
        }

        .footer-social-icon i {
            height: 40px;
            width: 40px;
            text-align: center;
            line-height: 38px;
            border-radius: 50%;
            transition: background-color 0.3s ease;
        }

        .footer-social-icon a:hover i {
            background-color: #ffffff;
            color: #151414;
        }

        /* Footer Widgets */
        .footer-widget-heading h3 {
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 30px;
            position: relative;
        }

        .footer-widget-heading h3::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: -10px;
            height: 2px;
            width: 50px;
            background: #fff;
        }

        .footer-widget ul li {
            margin-bottom: 10px;
        }

        .footer-widget ul li a {
            color: #878787;
            font-size: 14px;
            text-transform: capitalize;
            transition: color 0.3s ease;
        }

        .footer-widget ul li a:hover {
            color: #fff;
        }

        /* Subscribe Form */
        .subscribe-form {
            position: relative;
            margin-top: 30px;
        }

        .subscribe-form input {
            width: 100%;
            padding: 14px 28px;
            background: #2E2E2E;
            border: 1px solid #2E2E2E;
            color: #fff;
            font-size: 14px;
            border-radius: 25px;
            outline: none;
            transition: all 0.3s ease;
        }

        .subscribe-form input:focus {
            background-color: #444444;
        }

        .subscribe-form button {
            position: absolute;
            right: 0;
            background: #007bff;
            padding: 14px 20px;
            border: none;
            top: 0;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .subscribe-form button:hover {
            background-color: #0056b3;
        }

        .subscribe-form button i {
            color: #fff;
            font-size: 20px;
            transform: rotate(-6deg);
        }

        /* Copyright Section */
        .copyright-area {
            background: #202020;
            padding: 25px 0;
            text-align: center;
        }

        .copyright-text p {
            font-size: 14px;
            color: #878787;
            margin: 0;
        }

        .copyright-text p a {
            color: #fff;
        }

        /* Footer Menu */
        .footer-menu li {
            display: inline-block;
            margin-left: 20px;
        }

        .footer-menu li a {
            font-size: 14px;
            color: #878787;
            transition: color 0.3s ease;
        }

        .footer-menu li a:hover {
            color: #fff;
        }

        /* Scroll to Top Button */
        .scroll-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            width: 50px;          /* Set the width */
            height: 50px;         /* Set the height */
            border-radius: 50%;   /* Ensure it’s perfectly circular */
            display: none;
            justify-content: center; /* Center content horizontally */
            align-items: center; /* Center content vertically */
            font-size: 20px;
            transition: opacity 0.3s ease;
            text-align: center; /* Center the text inside */
            line-height: 50px;   /* Align text vertically inside the circle */
        }

        .scroll-to-top:hover {
            background-color: #0056b3;
        }

        .scroll-to-top.show {
            display: flex;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .footer-cta {
                padding: 20px 0;
            }

            .footer-cta .col-md-4 {
                text-align: center;
                margin-bottom: 20px;
            }

            .footer-content .row {
                flex-direction: column;
                align-items: center;
            }

            .footer-widget-heading h3 {
                font-size: 18px;
            }

            .footer-social-icon a {
                margin-right: 10px;
            }

            .footer-logo img {
                max-width: 150px;
            }

            .footer-text p {
                font-size: 12px;
            }

            .footer-menu li {
                display: inline-block;
                margin-left: 10px;
            }

            .footer-menu li a {
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .footer-section {
                padding: 20px;
            }

            .footer-widget {
                margin-bottom: 30px;
                text-align: center;
            }

            .footer-menu {
                text-align: center;
                margin-top: 20px;
            }

            .footer-menu ul {
                display: block;
            }

            .footer-menu li {
                display: block;
                margin-left: 0;
            }

            .scroll-to-top {
                bottom: 10px;
                right: 10px;
            }
        }
    </style>
</head>

<footer class="footer-section">
    <div class="container">
        <!-- Footer CTA Section -->
        <div class="footer-cta pt-5 pb-5">
            <div class="row">
                <!-- Find Us Section -->
                <div class="col-xl-4 col-md-4 mb-30">
                    <div class="single-cta">
                        <i class="fas fa-map-marker-alt footer-icon"></i>
                        <div class="cta-text">
                            <h4>Find us</h4>
                            <span>San Carlos City, Negros Occidental, <br> Philippines</span>
                        </div>
                    </div>
                </div>
                <!-- Call Us Section -->
                <div class="col-xl-4 col-md-4 mb-30">
                    <div class="single-cta">
                        <i class="fas fa-phone footer-icon"></i>
                        <div class="cta-text">
                            <h4>Call us</h4>
                            <span>9876543210</span>
                        </div>
                    </div>
                </div>
                <!-- Mail Us Section -->
                <div class="col-xl-4 col-md-4 mb-30">
                    <div class="single-cta">
                        <i class="far fa-envelope-open footer-icon"></i>
                        <div class="cta-text">
                            <h4>Mail us</h4>
                            <span>mail@bsitcpsu.edu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Content Section -->
        <div class="footer-content pt-5 pb-5">
            <div class="row">
                <!-- Footer Logo Section -->
                <div class="col-xl-4 col-lg-4 mb-50">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="index.html"><img src="admin/assets/images/BSIT_name.webp" alt="Logo"></a>
                        </div>
                        <div class="footer-text">
                            <p>Get your brand new website or app developed from our platform. We help in creating an online presence with fantastic user experience.</p>
                        </div>
                        <div class="footer-social-icon">
                            <span>Follow Us</span>
                            <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Footer Menu Section -->
                <div class="col-xl-2 col-lg-2 col-md-4 mb-50">
                    <div class="footer-widget">
                        <div class="footer-widget-heading">
                            <h3>About Us</h3>
                        </div>
                        <ul class="footer-menu">
                            <li><a href="#">Our Story</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Career</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Footer Menu Section -->
                <div class="col-xl-2 col-lg-2 col-md-4 mb-50">
                    <div class="footer-widget">
                        <div class="footer-widget-heading">
                            <h3>Services</h3>
                        </div>
                        <ul class="footer-menu">
                            <li><a href="#">Web Design</a></li>
                            <li><a href="#">App Development</a></li> 
                        </ul>
                    </div>
                </div>

                <!-- Footer Menu Section -->
                <div class="col-xl-2 col-lg-2 col-md-4 mb-50">
                    <div class="footer-widget">
                        <div class="footer-widget-heading">
                            <h3>Quick Links</h3>
                        </div>
                        <ul class="footer-menu">
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Subscribe Section -->
                <div class="col-xl-2 col-lg-2 col-md-4 mb-50">
                    <div class="footer-widget">
                        <div class="footer-widget-heading">
                            <h3>Subscribe</h3>
                        </div>
                        <div class="subscribe-form">
                            <input type="email" placeholder="Enter your email">
                            <button><i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright Section -->
        <div class="copyright-area pt-5 pb-5">
            <div class="container">
                <div class="copyright-text">
                    <p>&copy; 2024 CPSU BSIT - All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button -->
    <div class="scroll-to-top"><i class="fas fa-arrow-up"></i></div>
</footer>

<script>
    // Scroll to Top Button Visibility
    window.addEventListener('scroll', function() {
        let scrollToTopBtn = document.querySelector('.scroll-to-top');
        if (document.documentElement.scrollTop > 100) {
            scrollToTopBtn.classList.add('show');
        } else {
            scrollToTopBtn.classList.remove('show');
        }
    });

    // Scroll to Top Button Functionality
    document.querySelector('.scroll-to-top').addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>
