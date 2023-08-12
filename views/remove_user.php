<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection configuration
    require('dbConnect.php');

    $user_id = $_POST['user_id'];

    try {
        // Delete user from the database
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);

        header("Location: manage_user.php"); // Redirect back to the manage_users page
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Handle invalid access
    header("Location: manage_user.php"); // Redirect back to the manage_users page
}
?>
