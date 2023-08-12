<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection configuration
    require('dbConnect.php');

    $item_id = $_POST['item_id'];

    try {
        // Delete stock item from the database
        $sql = "DELETE FROM stock WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$item_id]);

        header("Location: manage_stock.php"); // Redirect back to the manage_stock page
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Handle invalid access
    header("Location: manage_stock.php"); // Redirect back to the manage_stock page
}
?>
