<?php
require('dbConnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST["newPassword"];
    $otp = $_POST["otp"];

    // Verify OTP and get the associated email
    echo($otp);
    $query = "SELECT user_email FROM user_otp WHERE otp = :otp AND expiration_time >= NOW()";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':otp', $otp, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount() == 1) {
        echo("inside if");
        // OTP is valid
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $userEmail = $row['user_email'];

        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the user's password in the database
        $updateQuery = "UPDATE users SET password = :password WHERE email = :email";
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $updateStmt->bindParam(':email', $userEmail, PDO::PARAM_STR);

        if ($updateStmt->execute()) {
            header("Location: login.php");
        } else {
            $errorMessage = "Error updating the password.";
        }
    } else {
        $errorMessage = "Invalid OTP or OTP has expired.";
    }
} else {
    header("Location: resetPassword.php?error=Invalid request.");
}
?>
