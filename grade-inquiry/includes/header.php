<link rel="stylesheet" href="./assets/css/header.css">
<!-- Main Navigation (Fixed Header) -->
<nav class="navbar navbar-expand-lg shadow-sm text-white fixed-top" style="background-color:rgb(148, 76, 200); color: white;">
    <div class="container d-flex justify-content-between align-items-center flex-wrap">
        <!-- Logo & Branding -->
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="../admin/assets/images/bsit_logo.png" height="50" alt="BSIT Logo" class="mr-2 rounded-circle shadow-sm">
            <div class="d-flex align-items-center">
                <span class="mx-2 text-white d-none d-md-inline">|</span>
                <span class="text-white font-weight-bold custom-btn-logo responsive-text">College of Computer Studies</span>
            </div>
        </a>

        <!-- Font Awesome (Latest Version) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

        <!-- Right Side: Date & Time -->
        <div class="d-flex align-items-center flex-wrap">
            <span class="small text-white mr-3">
                <i class="fa fa-clock"></i> <span id="live-time"></span>
            </span>
            <span class="mx-2 text-white d-none d-md-inline">|</span>
            <span class="small text-white">
                <i class="fa fa-calendar"></i> <span id="live-date"></span>
            </span>
        </div>
    </div>
</nav>


<script>
    function updateTime() {
        const now = new Date();

        // Time (HH:MM:SS AM/PM)
        const timeString = now.toLocaleTimeString('en-US', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
        document.getElementById('live-time').innerText = timeString;

        // Date (Weekday, Month Day, Year)
        const dateString = now.toLocaleDateString('en-US', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        document.getElementById('live-date').innerText = dateString;
    }

    setInterval(updateTime, 1000); // Update every second
    updateTime(); // Initial call
</script>



<script src="./assets/js/header.js"></script>
<!-- Bootstrap JS & Popper.js (Already in Your Setup) -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>