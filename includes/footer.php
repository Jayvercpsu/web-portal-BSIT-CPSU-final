<head>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<footer class="footer-section" style="background-color:rgb(89, 40, 124);">
    <div class="container">
        <div class="footer-con">
            <!-- Location Section -->
            <div class="footer-cta">
                <div class="single-cta">
                    <i class="fas fa-map-marker-alt text-white"></i>
                    <div class="cta-text">
                        <h4 style="color: white;">Find Us</h4>
                        <div class="map-container">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d980.9179023218929!2d123.35990996159614!3d10.447612092268333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a93f4321fa90b3%3A0x5a32a445f78a1f2f!2sCentral%20Philippines%20State%20University%20-%20Don%20Justo%20V.%20Valmayor%20Campus!5e0!3m2!1sen!2sph!4v1731682023909!5m2!1sen!2sph"
                                width="100%" height="200" style="border: 0; border-radius: 10px;" allowfullscreen loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <!-- About Us Section -->
            <div class="footer-content">
                <div class="footer-widget">
                    <div class="footer-logo">
                        <img src="admin/assets/images/bsit_logo.png" height="80" alt="BSIT Logo" class="mr-2 rounded-circle shadow-sm">
                    </div>
                    <p>Empowering innovation and technology. Join us to build a brighter future.</p>
                    <div class="footer-social-icon">
                        <span>Follow Us:</span>
                        <a href="https://web.facebook.com/CollegeofComputrStudies" class="facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="footer-contact">
                <h4>Contact Us</h4>
                <ul>
                    <li>
                        <i class="fas fa-phone-alt"></i> +63 912 345 6789
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i> cpsu_bsit@cpsu.edu.ph
                    </li>
                    <li>
                        <i class="fas fa-clock"></i> Mon - Fri: 8:00AM - 5:00PM
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright Section -->
        <div class="copyright-area">
            <p>&copy; 2025 CPSU BSIT - All Rights Reserved.</p>
        </div>
    </div>

    <!-- Scroll to Top Button -->
    <div class="scroll-to-top">
        <i class="fas fa-arrow-up"></i>
    </div>

</footer>


<style>
    .scroll-to-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background-color: #262b2d;
        color: #fff;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: transform 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .scroll-to-top i {
        font-size: 20px;
        /* Adjust size to fit well inside the circle */
    }

    .scroll-to-top:hover {
        transform: scale(.6);
    }

    .footer-section {
        background-color: #6a0dad;
        padding: 40px 0;
        font-family: Arial, sans-serif;
    }

    .footer-con {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 40px;
        text-align: center;
    }

    .footer-logo img {
        margin-bottom: 20px;
    }

    .footer-social-icon {
        margin-top: 20px;
    }

    .footer-social-icon a {
        font-size: 20px;
        color: #262b2d;
        margin-left: 10px;
        transition: transform 0.3s ease;
    }

    .footer-social-icon a:hover {
        transform: scale(1.2);
        color: #fff;
    }

    .footer-contact {
        text-align: left;
        padding-top: 10px;
    }

    .footer-contact ul {
        list-style: none;
        padding: 0;
    }

    .footer-contact ul li {
        margin-bottom: 10px;
        font-size: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .footer-contact ul li i {
        color: #fff;
        /* White Color for Icons */
        transition: color 0.3s ease;
    }


    .copyright-area {
        text-align: center;
        padding: 20px;
        background-color: #222;
        margin-top: 20px;
    }

    .footer-section {
        background-color: #000;
        color: #fff;
        padding: 40px 0;
        font-family: Arial, sans-serif;
    }

    .footer-con {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        justify-content: space-between;
        align-items: flex-start;
    }

    .footer-logo img {
        max-width: 150px;
        margin-bottom: 20px;
        border-radius: 10px;
    }

    .footer-cta {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .single-cta {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .single-cta i {
        font-size: 30px;
        color: #262b2d;
    }

    .cta-text h4 {
        font-size: 20px;
        margin-bottom: 10px;
        color: #262b2d;
    }

    .footer-social-icon {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .footer-social-icon a {
        font-size: 20px;
        color: #fff;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .footer-social-icon a:hover {
        color: #1a89ff;
        transform: scale(1.2);
    }

    .copyright-area {
        text-align: center;
        background-color: #222;
        padding: 15px 0;
        margin-top: 40px;
        font-size: 14px;
    }

    .scroll-to-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background-color: #262b2d;
        color: #fff;
        padding: 15px;
        border-radius: 50%;
        cursor: pointer;
        transition: opacity 0.3s ease, transform 0.3s ease;
        z-index: 9999;
        display: none;
    }

    .scroll-to-top:hover {
        transform: scale(1.2);
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const scrollToTopBtn = document.querySelector(".scroll-to-top");

        window.addEventListener("scroll", () => {
            if (window.scrollY > 100) {
                scrollToTopBtn.style.display = "block";
            } else {
                scrollToTopBtn.style.display = "none";
            }
        });

        scrollToTopBtn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        });
    });
</script>