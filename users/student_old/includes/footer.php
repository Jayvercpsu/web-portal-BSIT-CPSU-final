<head>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<footer class="footer-section" style="background-color: #000; color: #fff; padding-top: 30px; padding-bottom: 30px;">
    <div class="container">
        <div class="footer-con" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap;">

            <!-- Footer CTA Section -->
            <div class="footer-cta" style="width: 100%; padding: 30px 0; flex: 1 1 30%; margin-bottom: 30px;">
                <div class="single-cta" style="display: flex; align-items: center; margin-bottom: 20px;">
                    <i class="fas fa-map-marker-alt" style="font-size: 30px; margin-right: 15px; color: #f79c42;"></i>
                    <div class="cta-text">
                        <h4 style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Find Us</h4>
                        <div class="map-container">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3891.345006405893!2d123.3578011!3d10.4477552!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a93f4321fa90b3%3A0x5a32a445f78a1f2f!2sCentral%20Philippines%20State%20University%20-%20Don%20Justo%20V.%20Valmayor%20Campus!5e0!3m2!1sen!2sph!4v1620283063423!5m2!1sen!2sph"
                                width="100%" height="250" style="border: 0; border-radius: 8px;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Content Section -->
            <div class="footer-content" style="padding: 30px 0; flex: 1 1 30%; margin-bottom: 50px;">
                <div class="footer-widget">
                    <div class="footer-logo">
                        <img src="admin/assets/images/BSIT_name.webp" alt="Logo" style="max-width: 200px; margin-bottom: 20px;">
                    </div>
                    <div class="footer-text">
                        <p style="font-size: 16px; margin-bottom: 15px;">Get your brand new website or app developed from our platform. We help in creating an online presence with fantastic user experience.</p>
                    </div>
                    <div class="footer-social-icon" style="display: flex; gap: 10px;">
                        <span>Follow Us</span>
                        <a href="https://web.facebook.com/CollegeofComputrStudies" class="facebook" style="font-size: 20px; color: #fff; transition: color 0.3s ease;">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright Section -->
        <div class="copyright-area" style="background-color: #222; text-align: center; padding: 15px 0; font-size: 14px;">
            <p>&copy; 2024 CPSU BSIT - All Rights Reserved.</p>
        </div>
    </div>

    <!-- Scroll to Top Button -->
    <div class="scroll-to-top" style="position: fixed; bottom: 30px; right: 30px; background-color: #6f42c1; color: #fff; padding: 15px; border-radius: 50%; cursor: pointer; transition: opacity 0.3s ease; z-index: 9999; display: none;">
        <i class="fas fa-arrow-up" style="font-size: 20px;"></i>
    </div>
</footer>

<script>
    // Scroll to Top Button Visibility
    window.addEventListener('scroll', function() {
        let scrollToTopBtn = document.querySelector('.scroll-to-top');
        if (document.documentElement.scrollTop > 100) {
            scrollToTopBtn.style.display = 'block';  // Show button when scrolling down
        } else {
            scrollToTopBtn.style.display = 'none';   // Hide button when near the top
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
