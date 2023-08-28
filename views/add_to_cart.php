<?php
// Include your database connection
require('dbConnect.php');
session_start();
$user_id = $_SESSION['user_id']; // User ID from session or login info
$medicine_id = $_POST['medicine_id'];
$quantity = $_POST['quantity'];

// Check if the item is already in the user's cart
$sql_check_cart = "SELECT * FROM user_carts WHERE user_id = ? AND medicine_id = ? and active=1";
$stmt_check_cart = $pdo->prepare($sql_check_cart);
$stmt_check_cart->execute([$user_id, $medicine_id]);
$existing_item = $stmt_check_cart->fetch(PDO::FETCH_ASSOC);

if ($existing_item) {
    // If item exists, increase the quantity by 1
    $new_quantity = $existing_item['quantity'] + 1;
    $sql_update_cart = "UPDATE user_carts SET quantity = ? WHERE user_id = ? AND medicine_id = ?";
    $stmt_update_cart = $pdo->prepare($sql_update_cart);
    $stmt_update_cart->execute([$new_quantity, $user_id, $medicine_id]);
} else {
    // If item doesn't exist, add it to the cart
    $active =1;
    $sql_add_to_cart = "INSERT INTO user_carts (user_id, medicine_id, quantity, active) VALUES (?, ?, ?, ?)";
    $stmt_add_to_cart = $pdo->prepare($sql_add_to_cart);
    $stmt_add_to_cart->execute([$user_id, $medicine_id, $quantity ,$active]);
}

// Redirect back to the previous page with a success message
header('Location: ' . $_SERVER['HTTP_REFERER'] . '?success=1');
exit;
?>
