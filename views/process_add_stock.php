<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection configuration
    require('dbConnect.php');

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
        // Insert new stock item into the database
        $sql = "INSERT INTO stock (medicine_name, quantity,unit, price, expiration_date, notes, image) VALUES (?, ?, ?, ?,?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$medicine_name, $quantity, $unit,$price, $expiration_date, $notes, $imageContent]);

        header("Location: manage_stock.php"); // Redirect back to the manage_stock page
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Handle invalid access
    header("Location: manage_stock.php"); // Redirect back to the manage_stock page
}
?>
