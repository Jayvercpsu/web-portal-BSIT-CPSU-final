<?php
session_start();
include('includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $yearTables = ['first_year', 'second_year', 'third_year', 'fourth_year'];
    $user = null;

    foreach ($yearTables as $table) {
        $sql = "SELECT * FROM $table WHERE email='$email'";
        $result = mysqli_query($con, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $user['role'] = 'student'; // Set role explicitly for students
            break;
        }
    }

    if (!$user) {
        $sql = "SELECT * FROM professors WHERE email='$email'";
        $result = mysqli_query($con, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $user['role'] = 'professor'; // Set role explicitly for professors
        }
    }

    if (!$user) {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($con, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
        }
    }

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];

            if ($_SESSION['role'] === 'professor') {
                header("Location: professor_dashboard.php");
            } else if ($_SESSION['role'] === 'student') {
                header("Location: student_dashboard.php");
            } else {
                echo "<script>alert('User role not found.');</script>";
            }
            exit();
        } else {
            echo "<script>alert('Invalid email or password.');</script>";
        }
    } else {
        echo "<script>alert('No account found with that email.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSIT Login</title>
    <link rel="stylesheet" href="./css/home-signup.css">
    <link rel="stylesheet" href="./css/home-login-signup.css">
</head>

<body>

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>

    <div class="container">
        <div class="logo-container">
            <img src="./admin/assets/images/bsit_logo.png" alt="BSIT Logo">
            <h1>BSIT</h1>
        </div>

        <!-- Login Form -->
        <form class="form" id="loginForm" method="POST">
            <div class="form-title"><span>Sign in to your</span></div>
            <div class="title-2"><span>ACCOUNT</span></div>
            <div class="input-container">
                <input placeholder="Email" name="email" type="email" class="input-mail" required />
            </div>
            <div class="input-container">
                <input placeholder="Password" name="password" type="password" class="input-pwd" required />
            </div>
            <button class="submit" type="submit">
                <span class="sign-text">Sign in</span>
            </button>
            <p class="signup-link">
                No account? <a class="up" href="signup.php">Sign up!</a>
            </p>
            <p class="signup-link">
                <a href="index.php" style="color: white;">Back Home</a> |
                <a href="#" style="color: white;">Forgot Password?</a>
            </p>
        </form>
    </div>

    <script>
        // Hide preloader when the window is loaded
        window.onload = function() {
            document.getElementById('preloader').style.display = 'none';
        };
    </script>

</body>

</html>