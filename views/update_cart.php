<?php
// Include your database connection
require('dbConnect.php');
session_start();
$user_id = $_SESSION['user_id']; // User ID from session or login info
$medicine_id = $_POST['medicine_id'];
$new_quantity = $_POST['new_quantity'];

$sql_update_cart = "UPDATE user_carts SET quantity = ? WHERE user_id = ? AND medicine_id = ?";
$stmt_update_cart = $pdo->prepare($sql_update_cart);
$stmt_update_cart->execute([$new_quantity, $user_id, $medicine_id]);

// Redirect back to the cart page with a success message
header('Location: cart.php?success=1');
exit;
?>
