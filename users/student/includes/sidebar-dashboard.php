<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #6a0dad;">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Student Account</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Edit Account -->
    <li class="nav-item">
        <a class="nav-link" href="edit-profile.php">
            <i class="fas fa-fw fa-user"></i>
            <span>Edit Account</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Nav Item - My Professors -->
    <li class="nav-item">
        <a class="nav-link" href="my-professors.php">
            <i class="fas fa-fw fa-table"></i>
            <span>My Professors</span>
        </a>
    </li>

    <!-- Nav Item - View My Grades -->
    <li class="nav-item">
        <a class="nav-link" href="view-my-grades.php">
            <i class="fas fa-fw fa-graduation-cap"></i>
            <span>View My Grades</span>
        </a>
    </li>

    <!-- Nav Item - Logout -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
<style>
    /* Change text and icon color when active */
    .nav-item.active .nav-link,
    .nav-item.active .nav-link i {
        color: black !important;
    }

    /* Light white background for active menu item with opacity */
    .nav-item.active {
        background-color: #ffffff !important;
        /* Light white */
    }
</style>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        let links = document.querySelectorAll(".nav-item a");
        let currentUrl = window.location.href;

        links.forEach(link => {
            if (link.href === currentUrl) {
                let parent = link.parentElement;
                parent.classList.add("active");
                parent.style.backgroundColor = "#f8f9fa"; // Light white
            }
        });
    });
</script>


<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark">
                Are you sure you want to log out?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary text-white" data-dismiss="modal">Cancel</button>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>