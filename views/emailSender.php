<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require('../phpMailer/src/Exception.php');
require('../phpMailer/src/PHPMailer.php');
require('../phpMailer/src/SMTP.php');
// require('../phpMailer/src/Exception.php')

try {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'rohan19mondal@gmail.com'; // Your Gmail email address
    $mail->Password = 'ngmagrvmzllruskq';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // $mail->setFrom('rohan.mondal.mca24@geritageir.edu.in'); // Your Gmail email and your name
    $mail->addAddress('rohan18mondal@gmail.com'); // Recipient's email and name
    $mail->Subject = 'Subject of the Email';
    $mail->Body = 'This is the message content';
    // $mail->SMTPDebug = 2;

    if ($mail->send()) {
        echo 'Email sent successfully';
    } else {
        echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
}
