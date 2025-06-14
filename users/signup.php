<?php
session_start();
include('../includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = mysqli_real_escape_string($con, $_POST['fullName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hashing password
    $role = mysqli_real_escape_string($con, $_POST['role']);
    $year = isset($_POST['year']) ? mysqli_real_escape_string($con, $_POST['year']) : null;

    // Check if the email is already taken
    if ($role === 'student') {
        $yearTables = [
            '1st Year' => 'first_year',
            '2nd Year' => 'second_year',
            '3rd Year' => 'third_year',
            '4th Year' => 'fourth_year'
        ];

        if (!isset($yearTables[$year])) {
            echo "<script>alert('Invalid year selected.');</script>";
            exit();
        }

        $table = $yearTables[$year];
        $checkEmailSql = "SELECT * FROM $table WHERE email='$email'";
    } elseif ($role === 'professor') {
        $checkEmailSql = "SELECT * FROM professors WHERE email='$email'";
    } else {
        echo "<script>alert('Invalid role selected.');</script>";
        exit();
    }

    $checkEmailResult = mysqli_query($con, $checkEmailSql);

    if (mysqli_num_rows($checkEmailResult) > 0) {
        echo "<script>alert('This email is already registered. Please use a different email.');</script>";
    } else {
        if ($role === 'student') {
            $sql = "INSERT INTO $table (full_name, email, password) VALUES ('$fullName', '$email', '$hashedPassword')";
        } elseif ($role === 'professor') {
            $sql = "INSERT INTO professors (full_name, email, password) VALUES ('$fullName', '$email', '$hashedPassword')";
        }

        $userSql = "INSERT INTO users (full_name, email, password, role, year) VALUES ('$fullName', '$email', '$hashedPassword', '$role', '$year')";

        if (mysqli_query($con, $sql) && mysqli_query($con, $userSql)) {
            $sessionQuery = $role === 'professor'
                ? "SELECT * FROM professors WHERE email='$email'"
                : "SELECT * FROM $table WHERE email='$email'";

            $result = mysqli_query($con, $sessionQuery);

            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['role'] = $role;

                echo "<script>alert('Sign up successful! Please log in.'); window.location.href='login.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Error during registration: " . mysqli_error($con) . "');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSIT Sign Up</title>
    <link rel="stylesheet" href="../css/home-signup.css">
    <link rel="stylesheet" href="../css/home-login-signup.css">
    <script>
        function toggleYearSelect() {
            const roleSelect = document.getElementById('role');
            const yearSelect = document.getElementById('yearSelect');
            const yearInput = document.querySelector('[name="year"]');

            if (roleSelect.value === 'student') {
                yearSelect.style.display = 'block';
                yearInput.setAttribute('required', 'required');
            } else {
                yearSelect.style.display = 'none';
                yearInput.removeAttribute('required');
                yearInput.value = ""; // Reset the year value
            }
        }
    </script>
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

        <!-- Sign Up Form -->
        <form class="form" id="signUpForm" method="POST">
            <div class="form-title"><span>Create your</span></div>
            <div class="title-2"><span>ACCOUNT</span></div>
            <div class="input-container">
                <input placeholder="Full Name" name="fullName" type="text" class="input-name" required />
            </div>
            <div class="input-container">
                <input placeholder="Email" name="email" type="email" class="input-mail" required />
            </div>
            <div class="input-container">
                <input placeholder="Password" name="password" type="password" class="input-pwd" required />
            </div>
            <div class="input-container">
                <select id="role" name="role" class="input-role" required onchange="toggleYearSelect()">
                    <option value="" disabled selected>Select Role</option>
                    <option value="student">Student</option>
                    <option value="professor">Professor</option>
                </select>
            </div>
            <div id="yearSelect" class="input-container" style="display: none;">
                <select name="year" class="input-year">
                    <option value="" selected disabled>Select Year</option>
                    <option value="1st Year">1st Year</option>
                    <option value="2nd Year">2nd Year</option>
                    <option value="3rd Year">3rd Year</option>
                    <option value="4th Year">4th Year</option>
                </select>
            </div>
            <button class="submit" type="submit">
                <span class="sign-text">Sign up</span>
            </button>
            <p class="signup-link">
                Already have an account? <a class="up" href="login.php">Log in!</a>
            </p>
            <p class="signup-link">
                <a href="../index.php" style="color: white;">Back Home</a>
            </p>
        </form>
    </div>

    <script>
        window.onload = function() {
            document.getElementById('preloader').style.display = 'none';
        };
    </script>
</body>

</html>