<?php
session_start();
include('../includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $user = null;

    // Check for student login (in the student tables)
    $yearTables = ['first_year', 'second_year', 'third_year', 'fourth_year'];
    foreach ($yearTables as $table) {
        $sql = "SELECT * FROM $table WHERE email='$email' AND password='$password'";
        $result = mysqli_query($con, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $user['role'] = 'student'; // Set role for students
            break;
        }
    }

    // Check for professor login
    if (!$user) {
        $sql = "SELECT * FROM professors WHERE email='$email' AND password='$password'";
        $result = mysqli_query($con, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $user['role'] = 'professor'; // Set role for professors
        }
    }



    // Validate user login and session creation
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on role
        if ($_SESSION['role'] === 'professor') {
            header("Location: professor/index.php");
        } elseif ($_SESSION['role'] === 'student') {
            header("Location: student/index.php");
        } else {
            echo "<script>alert('User role not found.');</script>";
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