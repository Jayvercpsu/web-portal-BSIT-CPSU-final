<head>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/footer.css">
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
                            <li><a href="FAQ.php">FAQ</a></li>
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