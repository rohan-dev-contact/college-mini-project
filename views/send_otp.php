<?php
// This is a simplified example of sending OTP via email
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $userEmail = $_POST["email"];
    // Generate an OTP (simplified example)
    $otp = mt_rand(100000, 999999);

    // Send the OTP to the user's email (simplified example)
    mail($userEmail, "Your OTP for Password Reset", "Your OTP is: $otp");

    // Redirect to the OTP verification page
    header("Location: ../views/verify_otp.php?email=" . urlencode($userEmail));
    exit();
}
?>
