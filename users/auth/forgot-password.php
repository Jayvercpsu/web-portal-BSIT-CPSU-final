<?php
session_start();
include('../../includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($con, $_POST['email']);

    // Check if email exists
    $query = mysqli_prepare($con, "SELECT id FROM users WHERE email=?");
    mysqli_stmt_bind_param($query, "s", $email);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);

    if ($user = mysqli_fetch_assoc($result)) {
        $_SESSION['reset_email'] = $email;
        header("Location: reset-password.php");
        exit();
    } else {
        echo "<script>alert('Email not found!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - BSIT</title>
    <link rel="stylesheet" href="../../css/home-signup.css">
    <link rel="stylesheet" href="../../css/home-login-signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>

    <div class="container">
        <div class="logo-container">
            <img src="../../admin/assets/images/bsit_logo.png" alt="BSIT Logo">
            <h1>BSIT</h1>
        </div>

        <!-- Forgot Password Form -->
        <form class="form" id="forgotPasswordForm">
            <div class="form-title"><span>Forgot your</span></div>
            <div class="title-2"><span>PASSWORD?</span></div>
            <p class="text-center">Enter your email to reset your password.</p>
            <div class="input-container">
                <input id="email" placeholder="Email" name="email" type="email" class="input-mail" required />
            </div>
            <button class="submit" id="submitBtn" type="submit">
                <span class="sign-text">Send Reset Link</span>
                <i class="fa fa-spinner fa-spin" id="loadingIcon" style="display: none;"></i>
            </button>
            <p class="signup-link">
                <a href="../login.php" style="color: white;">Back to Login</a>
            </p>
        </form>
    </div>

    <!-- Modal -->
    <div id="messageModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modalMessage"></p>
        </div>
    </div>

    <script>
 $(document).ready(function() {
    $("#forgotPasswordForm").submit(function(e) {
        e.preventDefault();
        var email = $("#email").val();
        $("#loadingIcon").show(); // Show loading spinner
        $("#submitBtn").prop("disabled", true);

        $.ajax({
            type: "POST",
            url: "forgot-password-process.php",
            data: { email: email },
            success: function(response) {
                $("#loadingIcon").hide();
                $("#submitBtn").prop("disabled", false);

                if (response.trim() === "success") {
                    $("#modalMessage").text("✅ Verified email! Redirecting...");
                    $("#messageModal").show();

                    setTimeout(function() {
                        window.location.href = "reset-password.php";
                    }, 1500); // Delay of 1.5 seconds
                } else {
                    $("#modalMessage").text("❌ Sorry, wrong email!");
                    $("#messageModal").show();
                }
            }
        });
    });

    // Close modal
    $(".close").click(function() {
        $("#messageModal").hide();
    });

    $(window).click(function(event) {
        if (event.target.id === "messageModal") {
            $("#messageModal").hide();
        }
    });

    window.onload = function() {
        document.getElementById('preloader').style.display = 'none';
    };
});


    </script>

    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            
        }

        .modal-content {
            background-color: #fff;
            margin: 20% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            text-align: center;
            border-radius: 10px;
            color: black;
        }

        .close {
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: red;
        }
    </style>

</body>
</html>