<?php
require('../middleware/protected_page.php');

// Check user's role before allowing access
if ($_SESSION["user_role"] !== 'admin') {
    // User does not have admin role, redirect or show an error
    header("Location: unauthorized.php"); // You can create an unauthorized page
    exit();
}

require('../partials/header.php');
require('../partials/navbar.php');
require('../partials/footer.php');

print($header);
?>

<style>
    .my-class-to-b {
        margin-bottom: 50px;
    }
</style>

<body>
    <?php
    print($commonNav); // Use the common navigation bar
    ?>

    <div class="container mt-2 my-class-to-b">
        <div class="gap-2 mb-3 d-inline">
            <a href="admin.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back to Admin Panel</a>
            <p class="text-center fs-4 fw-bold">Manage Contact Messages</p>
        </div>
        <table class="table">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col">Message</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Include your database connection configuration
        require('dbConnect.php');

        // Fetch messages from the contact form
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

        // Fetch messages from the database based on search query
        $sql = "SELECT id, name, email, message, phone FROM contact_us WHERE active = 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($messages as $message) {
            echo '<tr>';
            echo '<td>' . $message['name'] . '</td>';
            echo '<td>' . $message['phone'] . '</td>';
            echo '<td>' . $message['email'] . '</td>';
            echo '<td><span class="overflow-scroll">' . $message['message'] . '<span></td>';
            echo '<td>
                <form method="post" action="delete_message.php">
                    <input type="hidden" name="message_id" value="' . $message['id'] . '">
                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm(\'Are you sure you want to delete this message?\');">
                        <i class="bi bi-trash3-fill"></i>
                    </button>
                </form>
            </td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>

    </div>

    <?php print($commonFooter)?>
</body>

</html>
