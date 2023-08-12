<?php
// Include your database connection
require('dbConnect.php');
session_start();
$user_id = $_SESSION['user_id']; // User ID from session or login info
$medicine_id = $_POST['medicine_id'];

$sql_delete_cart = "DELETE FROM user_carts WHERE user_id = ? AND medicine_id = ?";
$stmt_delete_cart = $pdo->prepare($sql_delete_cart);
$stmt_delete_cart->execute([$user_id, $medicine_id]);

// Redirect back to the cart page with a success message
header('Location: cart.php?success=1');
exit;
?>
