<!-- Main Navigation (Enhanced Design) -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <!-- Logo & Branding -->
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="../../admin/assets/images/bsit_logo.png" height="50" alt="BSIT Logo" class="mr-2 rounded-circle shadow-sm">
            <div> <span class="mx-2 text-muted">|</span>

                <span class="text-dark font-weight-bold" style="font-size: 20px; transition: color 0.3s;">College of Computer Studies</span>
            </div>
        </a>


        <!-- Toggler Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarResponsive">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="../../index.php"><i class="fa fa-home"></i> Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="gradeInquiryDropdown" role="button">
                        <i class="fa fa-user"></i> Grade Inquiry
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="input-student-id.php">Enter Student ID</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="moreInfoDropdown" role="button">
                        <i class="fa fa-info-circle"></i> More Info
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../../about-us.php"><i class="fa fa-info-circle"></i> About</a>
                        <a class="dropdown-item" href="../../vis_mis.php"><i class="fa fa-users"></i> Vision & Mission</a>
                        <a class="dropdown-item" href="../../contact-us.php"><i class="fa fa-envelope"></i> Contact</a>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Right Side: Date & Social Media -->
        <div class="d-flex align-items-center">
            <span class="small text-dark mr-3"><i class="fa fa-calendar"></i> <span id="live-date"></span></span>
            <span class="mx-2 text-muted">|</span>
            <a href="https://web.facebook.com/CollegeofComputrStudies" class="ml-2" style="color: #007bff; transition: color 0.3s, transform 0.3s;">
                <i class="fab fa-facebook fa-lg"></i>
            </a>
        </div>

        <style>
            a:hover i.fab.fa-facebook {
                color: #0056b3;
                transform: scale(1.2);
            }
        </style>

    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dateElement = document.getElementById("live-date");
        const options = {
            weekday: 'long',
            month: 'short',
            day: 'numeric',
            year: 'numeric'
        };
        dateElement.innerText = new Date().toLocaleDateString('en-US', options);
    });

    document.querySelectorAll('.dropdown-toggle').forEach(item => {
        item.addEventListener('click', function(e) {
            if (window.innerWidth < 992) {
                e.preventDefault();
                let parent = this.parentElement;
                parent.classList.toggle('show');
                parent.querySelector('.dropdown-menu').classList.toggle('show');
            }
        });
    });
</script>

<style>
    .navbar-nav .nav-link:hover {
        color: #007bff;
        text-shadow: 0 0 5px rgba(0, 123, 255, 0.8);
    }

    .navbar-brand img {
        transition: transform 0.3s;
    }

    .navbar-brand:hover img {
        transform: scale(1.1);
    }

    @media (max-width: 576px) {
        .navbar-brand span {
            font-size: 20px;
        }

        .navbar-nav .nav-item {
            text-align: center;
            margin-bottom: 10px;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dateElement = document.getElementById("live-date");
        const options = {
            weekday: 'long',
            month: 'short',
            day: 'numeric',
            year: 'numeric'
        };
        dateElement.innerText = new Date().toLocaleDateString('en-US', options);
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Enable hover dropdown for desktop, click for mobile
        if (window.innerWidth >= 992) {
            document.querySelectorAll('.nav-item.dropdown').forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.classList.add('show');
                    this.querySelector('.dropdown-menu').classList.add('show');
                });
                item.addEventListener('mouseleave', function() {
                    this.classList.remove('show');
                    this.querySelector('.dropdown-menu').classList.remove('show');
                });
            });
        }

        // Ensure mobile click still works
        document.querySelectorAll('.dropdown-toggle').forEach(item => {
            item.addEventListener('click', function(e) {
                if (window.innerWidth < 992) {
                    e.preventDefault();
                    let parent = this.parentElement;
                    let menu = parent.querySelector('.dropdown-menu');
                    let isOpen = parent.classList.contains('show');

                    // Close all dropdowns first
                    document.querySelectorAll('.dropdown-menu').forEach(menu => menu.classList.remove('show'));
                    document.querySelectorAll('.nav-item.dropdown').forEach(item => item.classList.remove('show'));

                    // Open the clicked dropdown
                    if (!isOpen) {
                        parent.classList.add('show');
                        menu.classList.add('show');
                    }
                }
            });
        });
    });
</script>

<!-- Bootstrap JS & Popper.js (Already in Your Setup) -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>