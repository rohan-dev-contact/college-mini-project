<?php
// Include your database connection
require('dbConnect.php');
$name = $_POST['username'];
$email = $_POST['email'];
$message = $_POST['message'];
$phone = $_POST['phone'];

$sql = "INSERT INTO contact_us (email, name, message, phone) VALUES (?, ?, ?,?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email, $name, $message,$phone]);


// Redirect back to the cart page with a success message
header('Location: ../index.php?success=1');
exit;
?>
