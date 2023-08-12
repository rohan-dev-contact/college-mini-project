<?php
// reset_password.php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["otp"]) && isset($_POST["email"])) {
    // This is a simplified example of handling the reset password logic
    $enteredOTP = $_POST["otp"];
    $userEmail = $_POST["email"];
    // You would compare the entered OTP with the generated OTP here

    if ($enteredOTP === "123456") { // Replace with the actual OTP
        // Valid OTP, proceed to reset password
        $resetEmail = $userEmail; // Store the email for resetting

        // Redirect to reset password form
        header("Location: set_new_password.php?email=" . urlencode($resetEmail));
        exit();
    } else {
        // Invalid OTP, redirect back to OTP verification
        header("Location: verify_otp.php?email=" . urlencode($userEmail));
        exit();
    }
}
?>
