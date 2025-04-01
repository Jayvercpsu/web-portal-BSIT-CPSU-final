<!-- Main Navigation (Enhanced Design) -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <!-- Logo & Branding -->
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="admin/assets/images/bsit_logo.png" height="50" alt="BSIT Logo" class="mr-2 rounded-circle shadow-sm">
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
                    <a class="nav-link text-dark" href="index.php"><i class="fa fa-home"></i> Home</a>
                </li>
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="gradeInquiryDropdown" role="button">
                        <i class="fa fa-user"></i> Grade Inquiry
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="users/grade_inquiry/input-student-id.php">Enter Student ID</a>
                    </div>
                </li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="moreInfoDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-info-circle"></i> More Info
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="about-us.php"><i class="fa fa-info-circle"></i> About</a>
                        <a class="dropdown-item" href="vis_mis.php"><i class="fa fa-users"></i> Vision & Mission</a>
                        <a class="dropdown-item" href="contact-us.php"><i class="fa fa-envelope"></i> Contact</a>
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



    </div>
</nav>

<style>
    a:hover i.fab.fa-facebook {
        color: #0056b3;
        transform: scale(1.2);
    }
</style>

<style>
    .navbar-nav .nav-link {
        position: relative;
        display: inline-block;
        color: #333;
        /* Default link color */
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .navbar-nav .nav-link::after {
        content: "";
        position: absolute;
        width: 0;
        height: 2px;
        /* Underline thickness */
        bottom: 0;
        left: 0;
        background-color: #007bff;
        /* Underline color */
        transition: width 0.3s ease;
        /* Smooth animation */
    }

    .navbar-nav .nav-link:hover {
        color: #007bff;
        /* Hover color */
    }

    .navbar-nav .nav-link:hover::after {
        width: 100%;
        /* Full width on hover */
    }

    .dropdown-item {
        position: relative;
        display: inline-block;
        transition: color 0.3s ease;
    }

    .dropdown-item::after {
        content: "";
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 0;
        background-color: #007bff;
        transition: width 0.3s ease;
    }

    .dropdown-item:hover {
        color: #007bff;
    }

    .dropdown-item:hover::after {
        width: 100%;
    }

    /* Sticky Navbar on Desktop */
    @media (min-width: 992px) {
        .navbar {
            position: sticky;
            top: 0;
            z-index: 1020;
            /* Keeps navbar above other content */
            background-color: #f8f9fa;
            /* Navbar Background */
        }
    }

    /* Mobile View: Hide Branding Text, Show Logo Only */
    @media (max-width: 991.98px) {
        .navbar-brand div {
            display: none;
            /* Hides College of Computer Studies text */
        }

        .d-flex.align-items-center {
            display: none;
            /* Hides date and Facebook icon outside the menu */
        }

        .navbar-collapse .d-flex.align-items-center {
            display: flex;
            /* Shows date and Facebook icon inside the menu */
            justify-content: center;
            margin-top: 10px;
        }

        .navbar-toggler {
            transition: none;
            /* Remove Rotation Animation */
        }

        /* Fix for dropdown in mobile view */
        .dropdown-menu {
            position: static !important;
            float: none;
            width: 100%;
            margin-top: 0;
            background-color: #f8f9fa;
            border: none;
            box-shadow: none;
            display: none;
            transition: none !important;
            transform: none !important;
            opacity: 1 !important;
            animation: none !important;
        }

        /* Show dropdown when active */
        .dropdown-menu.show {
            display: block !important;
        }

        /* Style for active dropdown */
        .dropdown.show .nav-link {
            color: #007bff !important;
        }

        .dropdown.show .nav-link::after {
            width: 100%;
        }
    }

    /* Animation only for desktop */
    @media (min-width: 992px) {
        .dropdown-menu {
            display: none;
            animation: fadeIn 0.3s ease-in-out;
        }

        .dropdown-menu.show {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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
        // Handle dropdown toggle on mobile
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                if (window.innerWidth < 992) {
                    e.preventDefault();
                    e.stopPropagation(); // Prevent event bubbling

                    const parent = this.parentElement;
                    const menu = parent.querySelector('.dropdown-menu');

                    // Toggle current dropdown visibility
                    if (parent.classList.contains('show')) {
                        parent.classList.remove('show');
                        menu.classList.remove('show');
                    } else {
                        // Close all other dropdowns first
                        document.querySelectorAll('.dropdown').forEach(dropdown => {
                            if (dropdown !== parent) {
                                dropdown.classList.remove('show');
                                const dropMenu = dropdown.querySelector('.dropdown-menu');
                                if (dropMenu) dropMenu.classList.remove('show');
                            }
                        });

                        // Open current dropdown
                        parent.classList.add('show');
                        menu.classList.add('show');
                    }
                }
            });
        });

        // Desktop dropdown behavior (hover)
        if (window.innerWidth >= 992) {
            const dropdowns = document.querySelectorAll('.dropdown');

            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('mouseenter', function() {
                    this.classList.add('show');
                    this.querySelector('.dropdown-menu').classList.add('show');
                });

                dropdown.addEventListener('mouseleave', function() {
                    this.classList.remove('show');
                    this.querySelector('.dropdown-menu').classList.remove('show');
                });
            });
        }

        // Keep dropdowns open when clicking on them
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.addEventListener('click', function(e) {
                if (window.innerWidth < 992) {
                    e.stopPropagation(); // Prevent closing when clicking inside
                }
            });
        });

        // Close dropdowns when clicking outside navbar
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.navbar')) {
                document.querySelectorAll('.dropdown').forEach(dropdown => {
                    dropdown.classList.remove('show');
                    const menu = dropdown.querySelector('.dropdown-menu');
                    if (menu) menu.classList.remove('show');
                });
            }
        });

        // Close navbar collapse but keep dropdown open when clicking a dropdown item
        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', function(e) {
                if (window.innerWidth < 992) {
                    // Don't close dropdown, just close the main navbar collapse
                    const navbarCollapse = document.querySelector('.navbar-collapse');
                    if (navbarCollapse.classList.contains('show')) {
                        e.stopPropagation(); // Prevent event from closing dropdown
                        const toggle = document.querySelector('.navbar-toggler');
                        toggle.click(); // Close the main navbar
                    }
                }
            });
        });

        // Reset layout on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 992) {
                document.querySelectorAll('.dropdown').forEach(dropdown => {
                    dropdown.classList.remove('show');
                    const menu = dropdown.querySelector('.dropdown-menu');
                    if (menu) menu.classList.remove('show');
                });
            }
        });
    });
</script>

<!-- Bootstrap JS & Popper.js (Already in Your Setup) -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>