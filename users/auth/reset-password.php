<?php
session_start();
include('../../includes/config.php');

if (!isset($_SESSION['reset_email'])) {
    die("Unauthorized access!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['reset_email'];
    $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Update the password
    $updateQuery = mysqli_prepare($con, "UPDATE users SET password=? WHERE email=?");
    mysqli_stmt_bind_param($updateQuery, "ss", $newPassword, $email);
    mysqli_stmt_execute($updateQuery);

    unset($_SESSION['reset_email']);

    echo "success"; // Send success response to JavaScript
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - BSIT</title>
    <link rel="stylesheet" href="../../css/home-signup.css">
    <link rel="stylesheet" href="../../css/home-login-signup.css">
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

        <!-- Reset Password Form -->
        <form class="form" id="resetPasswordForm">
            <div class="form-title"><span>Reset your</span></div>
            <div class="title-2"><span>PASSWORD</span></div>
            <p class="text-center">Enter a new password for your account.</p>
            <div class="input-container">
                <input id="password" placeholder="New Password" name="password" type="password" class="input-pwd" required />
            </div>
            <button class="submit" id="submitBtn" type="submit">
                <span class="sign-text">Reset Password</span>
                <i class="fa fa-spinner fa-spin" id="loadingIcon" style="display: none;"></i>
            </button>
            <p class="signup-link">
                <a href="../login.php" style="color: white;">Back to Login</a>
            </p>
        </form>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modalMessage">✅ Password updated successfully! Redirecting...</p>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $("#successModal").hide(); // Ensure modal is hidden on page load

        $("#resetPasswordForm").submit(function(e) {
            e.preventDefault();
            var password = $("#password").val();
            $("#loadingIcon").show(); // Show loading spinner
            $("#submitBtn").prop("disabled", true);

            $.ajax({
                type: "POST",
                url: "reset-password.php",
                data: { password: password },
                success: function(response) {
                    $("#loadingIcon").hide();
                    $("#submitBtn").prop("disabled", false);

                    if (response.trim() === "success") {
                        $("#successModal").fadeIn(); // Show modal

                        setTimeout(function() {
                            window.location.href = "../login.php";
                        }, 1500); // Redirect after 1.5 seconds
                    }
                }
            });
        });

        // Close modal when clicking "X" button
        $(".close").click(function() {
            $("#successModal").fadeOut();
        });

        // Close modal when clicking outside of it
        $(window).click(function(event) {
            if (event.target.id === "successModal") {
                $("#successModal").fadeOut();
            }
        });

        window.onload = function() {
            document.getElementById('preloader').style.display = 'none';
        };
    });
</script>


    <style>
       /* Ensure modal is hidden when page loads */
.modal {
    display: none; /* Now it starts hidden */
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Modal content */
.modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    width: 90%;
    max-width: 400px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
    position: relative;
    color: black
}

/* Close button */
.close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover {
    color: red;
}

/* Responsive adjustments */
@media (max-width: 600px) {
    .modal-content {
        width: 90%;
    }
}

    </style>

</body>

</html>
