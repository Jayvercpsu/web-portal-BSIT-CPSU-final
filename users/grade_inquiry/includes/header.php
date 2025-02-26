<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container">
        <!-- BSIT Logo and Name -->
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="../../admin/assets/images/bsit_logo.png" height="65" alt="BSIT Logo">
            <img src="../../admin/assets/images/BSIT_name.webp" alt="BSIT Name" class="ml-2"
                style="height: 65px; width: auto;"
                onload="this.style.height = window.innerWidth < 992 ? '50px' : '65px';">
        </a>

        <!-- Toggler for Mobile View -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarResponsive">
            <ul class="navbar-nav">
                <!-- Home with Hover Dropdown -->
                <li class="nav-item">
                    <a class="nav-link text-dark" href="../../index.php"><i class="fa fa-home"></i> Home</a>
                </li>




                <!-- Grade Inquiry with Hover Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="gradeInquiryDropdown" role="button">
                        <i class="fa fa-user"></i> Grade Inquiry
                    </a>
                    <div class="dropdown-menu" aria-labelledby="gradeInquiryDropdown">
                        <a class="dropdown-item" href="input-student-id.php">Enter Student ID</a>
                    </div>
                </li>


                <!-- More Info with About & Instructors -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="moreInfoDropdown" role="button">
                        <i class="fa fa-info-circle"></i> More Info
                    </a>
                    <div class="dropdown-menu" aria-labelledby="moreInfoDropdown">
                        <a class="dropdown-item" href="../../about-us.php"><i class="fa fa-info-circle"></i> About</a>
                        <a class="dropdown-item" href="../../instructor.php"><i class="fa fa-users"></i> Instructors</a>
                        <a class="dropdown-item" href="../../contact-us.php"><i class="fa fa-envelope"></i> Contact</a>
                    </div>
                </li>

            </ul>
        </div>

        <!-- CPSU Logo & Name -->
        <div class="navbar-brand d-lg-flex align-items-center d-none d-lg-flex">
            <h1 class="mb-0" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">CPSU</h1>
            <img src="../../admin/assets/images/cpsu_logo.png" height="65" alt="CPSU Logo" class="ml-2">
        </div>
    </div>
</nav>


<style>
    /* Enable dropdown on hover for desktop */
    @media (min-width: 992px) {
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }

        /* Smooth dropdown animation */
        .dropdown-menu {
            transition: all 0.3s ease-in-out;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
        }

        .nav-item.dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
    }

    /* Ensure dropdowns work on mobile (click) */
    @media (max-width: 991px) {
        .dropdown-menu {
            display: none;
        }

        .dropdown.show .dropdown-menu {
            display: block;
        }
    }
</style>

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