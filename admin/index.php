<?php
session_start();
//Database Configuration File
include('includes/config.php');
//error_reporting(0);
if (isset($_POST['login'])) {

    // Getting username/ email and password
    $uname = $_POST['username'];
    $password = md5($_POST['password']);
    // Fetch data from database on the basis of username/email and password
    $sql = mysqli_query($con, "SELECT AdminUserName, AdminEmailId, AdminPassword, userType FROM tbladmin WHERE (AdminUserName='$uname' && AdminPassword='$password')");
    $num = mysqli_fetch_array($sql);
    if ($num > 0) {

        $_SESSION['login'] = $_POST['username'];
        $_SESSION['utype'] = $num['userType'];
        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="101 + News Station Portal.">
    <meta name="author" content="xyz">


    <!-- App title -->
    <title>CPSU BSIT Web Portal | Admin Panel</title>

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

    <script src="assets/js/modernizr.min.js"></script>

</head>

<body class="bg-transparent">
    <style>
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }

        .logo img {
            max-width: 100%;
            height: auto;
        }

        .account-logo-box h2 {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        @media (max-width: 767px) {
            .account-logo-box h2 {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 767px) {
            .col-md-7 {
                display: none;
            }

            .col-md-4 {
                width: 100%;
            }
        }



        /* Styling the Form Group */
        .form-group.position-relative {
            position: relative;
            margin-bottom: 20px;
        }

        /* Styling the Input Fields */
        .form-control {
            width: 100%;
            padding: 10px 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            background-color: #fff;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #8a2be2;
            box-shadow: 0 0 5px rgba(138, 43, 226, 0.5);
        }

        /* Floating Placeholder Styling */
        .floating-label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            font-size: 16px;
            color: #888;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        /* When Input is Focused or Has Content */
        .form-control:focus~.floating-label,
        .form-control:not(:placeholder-shown)~.floating-label {
            top: 0;
            left: 10px;
            transform: translateY(-100%);
            font-size: 12px;
            color: #8a2be2;
        }

        /* Hide Placeholder Text */
        .form-control::placeholder {
            color: transparent;
        }

        /* Link Styling */
        .text-custom {
            color: #8a2be2;
            text-decoration: none;
        }

        .text-custom:hover {
            color: #000000;
            text-decoration: underline;
        }

        /* Button Styling */
        .btn-custom {
            background: linear-gradient(45deg, #000000, #8a2be2);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background: linear-gradient(45deg, #8a2be2, #000000);
            color: white;
        }
    </style>

    <section>
        <div class="container mt-5">
            <div class="row align-items-center">
                <div class="col-md-7 text-center m-t-50">
                    <img src="assets/images/admin_bg.jpg" class="img-fluid" alt="Admin Background">
                </div>
                <div class="col-md-4">
                    <div class="wrapper-page">
                        <div class="m-t-40 account-pages">
                            <div class="account-logo-box">
                                <h2 class="text-uppercase">
                                    <div class="logo">
                                        <span class="d-inline-block"><img src="assets/images/bsit_logo.png" alt="" width="100px"></span>
                                        <span class="d-inline-block mr-2"><img src="assets/images/BSIT_name.webp" alt="" width="350px"></span>
                                    </div>
                                </h2>
                                <p>Please sign-in to your account and start the adventure</p>
                            </div>

                            <div class="account-content">
                                <form class="form-horizontal" method="post">
                                    <!-- Username Input with Floating Placeholder -->
                                    <div class="form-group position-relative">
                                        <input
                                            class="form-control"
                                            type="text"
                                            required
                                            name="username"
                                            id="username"
                                            autocomplete="off"
                                            placeholder=" " />
                                        <label for="username" class="floating-label">Username or Email</label>
                                    </div>

                                    <!-- Forgot Password Link with Color Change -->
                                    <div class="text-right mb-2">
                                        <a href="forgot-password.php" class="text-custom">
                                            <i class="mdi mdi-lock"></i> Forgot your password?
                                        </a>
                                    </div>

                                    <!-- Password Input with Floating Placeholder -->
                                    <div class="form-group position-relative">
                                        <input
                                            class="form-control"
                                            type="password"
                                            name="password"
                                            id="password"
                                            required
                                            autocomplete="off"
                                            placeholder=" " />
                                        <label for="password" class="floating-label">Password</label>
                                    </div>

                                    <!-- Login Button -->
                                    <div class="form-group account-btn text-center mt-3">
                                        <div class="col-xs-12">
                                            <button
                                                class="btn btn-custom waves-effect waves-light btn-md w-100"
                                                type="submit"
                                                name="login">
                                                Log In
                                            </button>
                                        </div>
                                    </div>
                                </form>


                                <!-- Back Home Link with Color Change -->
                                <div class="text-center mt-3">
                                    <a href="../index.php" class="text-custom"><i class="mdi mdi-home"></i> Back Home</a>
                                </div>
                            </div>
                        </div>
                        <!-- end card-box -->
                    </div>
                    <!-- end wrapper -->
                </div>
            </div>
        </div>
    </section>


    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- <script src="assets/js/bootstrap.min.js"></script> -->
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>

    <!-- App js -->
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>

</body>

</html>