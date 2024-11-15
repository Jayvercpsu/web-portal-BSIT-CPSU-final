<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container">
        <!-- BSIT Logo and Name (Visible on all screen sizes) -->
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="admin/assets/images/bsit_logo.png" height="65" alt="BSIT Logo">
            <img src="admin/assets/images/BSIT_name.webp" alt="BSIT Name" class="ml-2"
                style="height: 65px; width: auto;"
                onload="this.style.height = window.innerWidth < 992 ? '50px' : '65px';">
        </a>

        <!-- Toggler for Mobile View -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links - Collapsible -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarResponsive">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fa fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about-us.php"><i class="fa fa-info-circle"></i> About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="instructor.php"><i class="fa fa-users"></i> Instructors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="news.php"><i class="fa fa-newspaper-o"></i> News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact-us.php"><i class="fa fa-phone"></i> Contact us</a>
                </li>
            </ul>
        </div>

        <!-- CPSU Text and Logo (Visible on large screens only) -->
        <div class="navbar-brand d-lg-flex align-items-center d-none d-lg-flex">
            <h1 class="mb-0" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">CPSU</h1>
            <img src="admin/assets/images/cpsu_logo.png" height="65" alt="CPSU Logo" class="ml-2">
        </div>
    </div>
</nav>