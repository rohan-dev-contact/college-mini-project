<?php
require('dbConnect.php'); // Include your database connection
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $otp = generateOTP(); // Generate a random OTP
    date_default_timezone_set('Asia/Kolkata'); 
    $expirationTime = date('Y-m-d H:i:s', strtotime('+10 minutes')); // OTP expiration time

    // Check if the user with the provided email exists in the database
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION["user_email_for_password_reset"] = $email;
        // Insert the OTP into the OTP table
        $stmt = $pdo->prepare("INSERT INTO user_otp (user_email, otp, expiration_time) VALUES (?, ?, ?)");
        $stmt->execute([$email, $otp, $expirationTime]);

        // Send the OTP to the user's email
        sendOTPByEmail($email, $otp);

        // Redirect to the OTP validation page
        header('Location: verify_otp.php');
        exit();
    } else {
        echo "Email not found in our records.";
    }
}

function generateOTP() {
    // Generate a 6-digit random OTP
    return sprintf('%06d', mt_rand(0, 999999));
}

function sendOTPByEmail($email, $otp) {
    require('../phpMailer/src/Exception.php');
    require('../phpMailer/src/PHPMailer.php');
    require('../phpMailer/src/SMTP.php');

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'rohan19mondal@gmail.com'; // Your Gmail email address
    $mail->Password = 'ngmagrvmzllruskq';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;


    // $mail->setFrom('your_email@gmail.com', 'Your Name'); // Your email address and name
    $mail->addAddress($email); // Recipient's email address
    $mail->Subject = 'OTP for Password Reset';
    $mail->Body = "Your OTP for password reset is: $otp";

    $mail->send();
}
?>
