<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection configuration
    require('dbConnect.php');

    $item_id = $_POST['item_id'];
    $medicine_name = $_POST['medicine_name'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];
    $price = $_POST['price'];
    $expiration_date = $_POST['expiration_date'];
    $notes = $_POST['notes'];
        // Handle image upload
        $image = $_FILES['image']['tmp_name'];
        $imageContent = file_get_contents($image);

    try {
        // Update stock item in the database
        $sql = "UPDATE stock SET medicine_name = ?, quantity = ?,unit = ?, price = ?, expiration_date = ?, notes = ?,image=? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$medicine_name, $quantity,$unit, $price, $expiration_date, $notes,$imageContent, $item_id]);

        header("Location: manage_stock.php"); // Redirect back to the manage_stock page
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Handle invalid access
    header("Location: manage_stock.php"); // Redirect back to the manage_stock page
}
?>
