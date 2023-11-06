<?php
require('../middleware/protected_page.php');
require('../partials/header.php');
require('../partials/navbar.php');
require('../partials/footer.php');
print($header);
?>

<body>
    <?php print($commonNav); ?>

    <div class="container mt-4">
        <a href="user.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back to Profile</a>
        <h2 class="mb-4">Manage Your Address Book</h2>

        <!-- Add New Address Form -->
        <h3>Add a New Address</h3>
        <form action="address_book.php" method="post">
            <div class="mb-3">
                <label for="address">New Address:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_address">Add Address</button>
        </form>

        <hr>

        <!-- Display current addresses with scrolling -->
        <h3>Your Saved Addresses</h3>
        <div class="scrolling-address-table" style="max-height: 400px; overflow-y: scroll; margin-bottom: 50px;">
            <?php
            // Include your database connection
            require('dbConnect.php');

            // Assuming $user_id holds the current user's ID
            $user_id = $_SESSION["user_id"]; // Replace with the actual user ID

            $query = "SELECT address_id, address FROM user_addresses WHERE user_id = :user_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($addresses) > 0) {
                echo '<ul class="list-group">';
                foreach ($addresses as $address) {
                    echo '<li class="list-group-item">' . htmlspecialchars($address['address']) . '</li>';
                }
                echo '</ul>';
            } else {
                echo '<p>No addresses are saved in your address book.</p>';
            }
            ?>
        </div>
    </div>

    <?php print($commonFooter); ?>

    <?php
    // Handle adding a new address
    if (isset($_POST['add_address'])) {
        $new_address = $_POST['address'];

        // Insert the new address into the user_addresses table
        $insert_query = "INSERT INTO user_addresses (user_id, address) VALUES (:user_id, :address)";
        $insert_stmt = $pdo->prepare($insert_query);
        $insert_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $insert_stmt->bindParam(':address', $new_address, PDO::PARAM_STR);
        $insert_stmt->execute();

        // Redirect back to the address book page
        header('Location: address_book.php');
        exit;
    }
    ?>
</body>
</html>
