<?php
 

$professor_id = $_SESSION['user_id'] ?? null; // Ensure user ID exists in the session
$msg = $error = "";

// Default values for name and profile image
$full_name = 'Guest';
$profile_image = '../assets/profile-images/default-profile.png';

if ($professor_id) {
    // Fetch professor details from the 'users' table where role is 'professor'
    $query = "SELECT full_name, profile_image FROM users WHERE id = '$professor_id' AND role = 'professor' LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $full_name = $row['full_name'] ?? 'Guest';
        $profile_image = !empty($row['profile_image']) ? $row['profile_image'] : '../assets/profile-images/default-profile.png';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>CPSU BSIT Web Portal | Professors</title>
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
    <script src="assets/js/modernizr.min.js"></script>
    <!-- Additional Plugins -->
    <link href="../plugins/summernote/summernote.css" rel="stylesheet" />
    <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
    <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
</head>
<body class="fixed-left">
    <!-- Begin page -->
    <div id="wrapper">
        <div class="topbar">
            <!-- LOGO -->
            <div class="topbar-left">
                <a href="index.php" class="logo">
                    <span>
                        <img src="assets/images/bsit_logo.png" alt="" height="60">
                        <span class="text-dark p-5">Professors</span>
                    </span>
                </a>
            </div>

            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container">
                    <!-- Navbar-left -->
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <button class="button-menu-mobile open-left waves-effect">
                                <i class="mdi mdi-menu"></i>
                            </button>
                        </li>
                    </ul>

                    <!-- Right(Notification) -->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown user-box">
                            <a href="" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true">
                                <img src="<?php echo htmlentities($profile_image); ?>" alt="user-img" class="img-circle user-img">
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                                <li>
                                    <h5>Hi, <?php echo htmlentities($full_name); ?></h5>
                                </li>

                                <li><a href="profile.php"><i class="ti-settings m-r-5"></i> Change Password</a></li>
                                <li><a href="logout.php"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul> <!-- end navbar-right -->

                </div><!-- end container -->
            </div><!-- end navbar -->
        </div>
    </div>
</body>
</html>
