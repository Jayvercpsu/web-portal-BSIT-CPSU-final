<?php
include('../../includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../images/favicon.png" type="image/x-icon">

    <title>CPSU BSIT Web Portal | Grade Inquiry</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <link rel="stylesheet" href="../../css/icons.css">
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../../assets/css/maicons.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/vendor/owl-carousel/css/owl.carousel.css">
    <link rel="stylesheet" href="../../assets/vendor/animate/animate.css">
    <link rel="stylesheet" href="../../assets/css/theme.css">

    <style>
        .card-custom {
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background: #fff;
            opacity: 0;
            /* Initially hidden */
            transform: translateY(20px);
            /* Start slightly lower */
            animation: fadeIn 0.8s ease-out forwards;
            /* Apply animation */
        }

        .form-floating input {
            border-radius: 8px;
            padding: 10px;
        }

        .btn-primary {
            width: 100%;
            border-radius: 8px;
            padding: 12px;
            font-size: 1.1rem;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
        }
    </style>

</head>

<body>

    <!-- Navigation -->
    <?php include('includes/header.php'); ?>

    <div class="page-banner overlay-dark bg-image" style="background-image: url(../../images/sample_bsit.jpg);">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <br><br>
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a style="color: violet;" href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Grade Inquiry</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Input Student ID</h1>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-custom shadow-lg mt-5 mb-5"> <!-- Changed to mt-5 and mb-5 -->
                    <div class="card-body">
                        <h4 class="text-center mb-4">Enter Your Student ID</h4>
                        <form action="grades.php" method="POST">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="student_id" name="student_id" placeholder="Enter Student ID" required>

                            </div>
                            <button type="submit" class="btn btn-primary">Check Grades</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <?php include('includes/footer.php'); ?>

    <script src="../../assets/js/jquery-3.5.1.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendor/wow/wow.min.js"></script>
    <script src="../../assets/js/theme.js"></script>

</body>

</html>