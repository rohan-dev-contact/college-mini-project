<?php
// Include your database connection configuration
require('dbConnect.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = $_POST["otp"];
    
    // Validate the OTP against the database
    $sql = "SELECT user_email FROM user_otp WHERE otp = :otp AND NOW() <= expiration_time";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':otp', $otp, PDO::PARAM_STR);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        // OTP is valid, grant access to the user's account
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_email = $row["user_email"];
        if($user_email == $_SESSION["user_email"]){
            $_SESSION["otp_verified"] = true;
            if ($_SESSION["user_role"] == 'admin') {
            
                header("Location: admin.php"); // Redirect admin to admin portal
            } else {
                header("Location: home.php"); // Redirect regular users to home page
            }
        }
    } else {
        echo "Invalid OTP. Please try again.";
    }
} else {
    header("Location: login.php");
}
?>
