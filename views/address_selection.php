<?php 
require('../middleware/protected_page.php');
require('../partials/header.php');
require('../partials/navbar.php');
require('../partials/footer.php');

print($header);
?>

<body>
    <?php
    print($commonNav);?>
    <div class="container-fluid m-2">
        <div class="gap-2 mb-3 d-inline">
            <a href="cart.php"class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i></a>
            <p class="text-center fs-2 fw-bold">Medicine bag</p>
        </div>
            <?php
                require('dbConnect.php'); // Include your database connection

                $user_id = $_SESSION["user_id"]; // Replace with the actual user ID
                $query = "SELECT address_id, address FROM user_addresses WHERE user_id = :user_id";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->execute();

                $addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($addresses) > 0) {
                    echo '<form action="payment.php" method="post">';
                    echo '<div class="mb-3">';
                    echo '<label for="selected_address" class="form-label">Select Delivery Address</label>';
                    echo '<select class="form-select" id="selected_address" name="selected_address" required>';
                    foreach ($addresses as $address) {
                        echo '<option value="' . htmlspecialchars($address['address_id']) . '">' . htmlspecialchars($address['address']) . '</option>';
                    }
                    echo '</select>';
                    echo '</div>';
                    echo '<button type="submit" class="btn btn-primary" name="select_address">Proceed to Payment</button>';
                    echo '</form>';
                } else {
                    echo '<p>No addresses are saved in your address book.</p>';
                }
            ?>
                </select>
            </div>
   
    </div>
    <?php print ($commonFooter)?>
</body>
</html>