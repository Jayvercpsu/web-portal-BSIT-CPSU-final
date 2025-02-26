<!-- Top Header (Black Section) -->
<div class="top-header bg-dark text-white py-2">
    <div class="container d-flex flex-wrap justify-content-between align-items-center">

        <!-- Left Side: School Logo & Name -->
        <div class="d-flex align-items-center">
            <img src="admin/assets/images/cpsu_logo.png" height="40" alt="CPSU Logo">
            <span class="ml-2 font-weight-bold">CPSU</span>
            <span class="text-muted mx-2 d-none d-md-inline">|</span>
            <span class="small d-none d-md-inline">Central Philippine State University San Carlos Campus.</span>
        </div>

        <!-- Right Side: Date & Facebook Icon -->
        <div class="d-flex align-items-center mt-2 mt-md-0">
            <span class="small"><i class="fa fa-calendar"></i> <span id="live-date"></span></span>
            <span class="ml-3">Follow Us:</span>
            <a href="#" class="text-white ml-2"><i class="fab fa-facebook"></i></a>
        </div>

    </div>
</div>

<!-- Main Navigation (White Section) -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">

        <!-- Left: CPSU Logo & VNHS Branding -->
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="admin/assets/images/bsit_logo.png" height="50" alt="BSIT Logo">
            <span class="ml-2 text-primary font-weight-bold" style="font-size: 24px;">BSIT</span>
            <span class="text-muted ml-1" style="letter-spacing: 2px;">Web Portal</span>
        </a>

        <!-- Toggler Button for Mobile -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links (Your Current Menu) -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarResponsive">
            <ul class="navbar-nav">
                <!-- Home -->
                <li class="nav-item">
                    <a class="nav-link text-dark" href="index.php"><i class="fa fa-home"></i> Home</a>
                </li>

                <!-- Grade Inquiry Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="users/grade_inquiry/input-student-id.php" id="gradeInquiryDropdown" role="button">
                        <i class="fa fa-user"></i> Grade Inquiry
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="users/grade_inquiry/input-student-id.php">Enter Student ID</a>
                    </div>
                </li>

                <!-- More Info Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="moreInfoDropdown" role="button">
                        <i class="fa fa-info-circle"></i> More Info
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="about-us.php"><i class="fa fa-info-circle"></i> About</a>
                        <a class="dropdown-item" href="vis_mis.php"><i class="fa fa-users"></i> Vision and Mission</a>
                        <a class="dropdown-item" href="contact-us.php"><i class="fa fa-envelope"></i> Contact</a>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Right: Current Time -->
        <div class="d-flex align-items-center mt-2 mt-lg-0">
            <span class="text-dark mr-3">
                <i class="fa fa-clock"></i> <span id="current-time"></span>
            </span> 
        </div>

    </div>
</nav>

<!-- JavaScript to Update Date and Time -->
<script>
    function updateDateTime() {
        const now = new Date();
        // Format current time
        const timeString = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        document.getElementById('current-time').textContent = timeString;

        // Format current date
        const options = { weekday: 'long', month: 'short', day: 'numeric', year: 'numeric' };
        document.getElementById('live-date').innerText = now.toLocaleDateString('en-US', options);
    }

    setInterval(updateDateTime, 1000);
    updateDateTime();
</script>

<!-- Responsive Styling -->
<style>
    /* Top Header (Black Section) */
    .top-header {
        font-size: 14px;
    }

    /* Make sure items wrap properly */
    @media (max-width: 767px) {
        .top-header .d-flex {
            flex-wrap: wrap;
            justify-content: center;
            text-align: center;
        }

        .top-header div {
            width: 100%;
            justify-content: center;
        }

        .navbar-nav {
            text-align: center;
        }

        .navbar-nav .nav-item {
            margin-bottom: 10px;
        }
    }

    /* Navbar Links */
    .navbar-nav .nav-item {
        margin: 0 10px;
    }

    .navbar-nav .nav-link {
        transition: color 0.3s;
    }

    .navbar-nav .nav-link:hover {
        color: #007bff;
    }

    /* Responsive Font Sizes */
    @media (max-width: 576px) {
        .navbar-brand span {
            font-size: 20px !important;
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