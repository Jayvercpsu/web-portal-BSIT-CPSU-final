<?php
session_start();
include('../includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Check for login in the `users` table
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on role
        if ($user['role'] === 'professor') {
            header("Location: professor/dashboard.php");
        } elseif ($user['role'] === 'student') {
            header("Location: student/index.php");
        } else {
            echo "<script>alert('Invalid role assigned. Please contact admin.');</script>";
        }
        exit();
    } else {
        echo "<script>alert('Invalid email or password.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSIT Login</title>
    <link rel="stylesheet" href="../css/home-signup.css">
    <link rel="stylesheet" href="../css/home-login-signup.css">
</head>
<body>

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>

    <div class="container">
        <div class="logo-container">
            <img src="../admin/assets/images/bsit_logo.png" alt="BSIT Logo">
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
                <a href="../index.php" style="color: white;">Back Home</a> |
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
