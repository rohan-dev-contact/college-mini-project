<?php
session_Start();
require('dbConnect.php');
if (isset($_POST['complete_order'])) {
    $selected_address = $_POST['selected_address'];
    $user_id = $_SESSION['user_id']; 
    $subtotal = 0; 
    
    $query = "SELECT s.price, c.quantity FROM user_carts c JOIN stock s ON c.medicine_id = s.id WHERE c.user_id = :user_id AND c.active = 1";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $subtotal += $row['price'] * $row['quantity'];
    }
    
    $gst = $subtotal * 0.18; 
    $deliveryCharges = $subtotal < 500 ? ($subtotal * 0.05) : 0; 

    
    $total_Amount = $subtotal + $gst + $deliveryCharges;
    $status = 'pending'; // Set the initial status
    $query = "INSERT INTO orders (user_id, total_amount, status, address, gst_amount, delivery_charges) VALUES (:user_id, :total_amount, :status, :address_id,:delivery_charges,:gst_amount)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':total_amount', $total_Amount, PDO::PARAM_INT);
    $stmt->bindParam(':delivery_charges', $deliveryCharges, PDO::PARAM_INT);
    $stmt->bindParam(':gst_amount', $gst, PDO::PARAM_INT);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':address_id', $selected_address, PDO::PARAM_INT);
    $stmt->execute();


    $order_id = $pdo->lastInsertId();

    // Update the cart table
    $query = "UPDATE user_carts SET orderId = :order_id, active = 0 WHERE user_id = :user_id AND active = 1";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: order_confirmation.php');
    exit();
}
else {
    header('Location: home.php'); 
    exit();
}
?>
