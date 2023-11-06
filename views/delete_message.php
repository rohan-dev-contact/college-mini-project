<?php
// Include your database connection configuration
require('dbConnect.php');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['message_id'])) {
    $messageId = $_POST['message_id'];

    // Perform the deletion of the message
    $sql = "DELETE FROM contact_us WHERE id = :message_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':message_id', $messageId, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        // Redirect back to the manage_messages.php page after deletion
        header("Location: list_contact_us_messages.php");
        exit();
    } else {
        echo "Failed to delete the message.";
    }
} else {
    echo "Invalid request.";
}
?>
