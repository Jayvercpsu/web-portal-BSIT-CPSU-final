<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Sidebar</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    
    <style>
        /* General Sidebar Styling */
        .w3-sidebar {
            background-color: black;
            color: white;
            padding-top: 20px;
        }

        /* Sidebar Links */
        .w3-sidebar a {
            color: white;
            padding: 10px 15px;
            font-size: 16px;
            transition: all 0.3s;
        }

        .w3-sidebar a:hover {
            background-color: #6a0dad;
            color: #fff;
            border-radius: 5px;
        }

        .w3-sidebar .header-ti {
            font-size: 22px;
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Main Content Area */
        .w3-main {
            margin-left: 200px;
            transition: margin-left 0.3s;
        }

        /* Mobile View */
        @media screen and (max-width: 768px) {
            .w3-main {
                margin-left: 0;
            }

            .w3-teall {
                display: flex; 
                padding: 10px;
            }

            .w3-sidebar {
                width: 200px;
                display: none;
                position: fixed;
                z-index: 1000;
                height: 100%;
            }

            .w3-sidebar.open {
                display: block;
            }
        }

        /* Button Styling */
        .w3-button {
            border-radius: 5px;
            font-weight: 500;
            text-align: center;
        }

        .w3-teall {
            background-color: #4b0082;
            color: white;
            padding: 10px;
        }

        .w3-button.w3-teal {
            background-color: #4b0082;
        }

        .w3-button.w3-teal:hover {
            background-color: #6a0dad;
        }

        /* Modal Styling */
        .modal-header {
            background-color: #4b0082;
            color: white;
        }

        .modal-footer .btn {
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left" id="mySidebar">
        <button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close()">Close &times;</button>
        <h2 class="header-ti">My Account</h2>

        <!-- Sidebar Links with Icons -->
        <a href="edit-profile.php" class="w3-bar-item w3-button"><i class="fa fa-user-circle"></i> Edit Account</a>
        <a href="my-instructors.php" class="w3-bar-item w3-button"><i class="fa fa-users"></i> My Instructors</a>
        <a href="my-subjects.php" class="w3-bar-item w3-button"><i class="fa fa-book"></i> My Subjects</a>
        <a href="#" data-toggle="modal" data-target="#logoutModal" class="w3-bar-item w3-button"><i class="fa fa-sign-out"></i> Logout</a>
    </div>

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
                    <button type="button" class="btn text-white" data-dismiss="modal" style="background-color: #6a0dad;">Cancel</button>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="w3-main">
        <div class="w3-teall">
            <button class="w3-button w3-teall w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</button>
            <h1 class="text-white">Settings</h1>
        </div>
 

    <script>
        // Open sidebar
        function w3_open() {
            document.getElementById("mySidebar").classList.add("open");
        }

        // Close sidebar
        function w3_close() {
            document.getElementById("mySidebar").classList.remove("open");
        }

        // Ensure the sidebar toggles on all screen sizes
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 993) {
                document.getElementById("mySidebar").classList.add("open"); // Show sidebar on large screens
            } else {
                document.getElementById("mySidebar").classList.remove("open"); // Hide sidebar on small screens
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>

</html>
