<?php
require('../middleware/protected_page.php');
require('../partials/header.php');
require('../partials/navbar.php');
require('../partials/footer.php');
print($header);
?>

<style>
    .my-class-to-b {
        margin-bottom: 50px;
    }

    .scrollable-container {
        max-height: 500px; /* Adjust the max height as needed */
        overflow-y: scroll;
    }
</style>

<body>
    <?php
    print($commonNav);
    ?>

    <div class="container mt-5 my-class-to-b">
        <div class="gap-2 mb-3 d-inline">
            <a href="admin.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back to Admin Panel</a>
            <h2 class="text-center fs-4 fw-bold">Pending Orders</h2>
        </div>

        <div class="scrollable-container">
            <?php
            require('dbConnect.php');

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Process the form submission to update the order status
                $order_id = $_POST['order_id'];
                $new_status = $_POST['new_status'];

                // Update the order status in the database
                $update_query = "UPDATE orders SET status = :new_status WHERE order_id = :order_id";
                $stmt_update = $pdo->prepare($update_query);
                $stmt_update->bindParam(':order_id', $order_id, PDO::PARAM_INT);
                $stmt_update->bindParam(':new_status', $new_status, PDO::PARAM_STR);
                $stmt_update->execute();
            }

            $search = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : '';
            if ($search != '') {
                $query = "SELECT o.*, u.name 
                FROM orders o
                INNER JOIN users u ON o.user_id = u.id
                WHERE o.status <> 'delivered' 
                AND (o.order_id LIKE :search OR u.name LIKE :search) 
                ORDER BY o.order_date DESC";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':search', $search, PDO::PARAM_STR);
            } else {
                $query = "SELECT o.*, u.name 
                FROM orders o
                INNER JOIN users u ON o.user_id = u.id
                WHERE o.status <> 'delivered'
                ORDER BY o.order_date DESC";
                $stmt = $pdo->prepare($query);
            }

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="accordion">';
                    echo '<div class="accordion-item">';
                    echo '<h2 class="accordion-header">';
                    echo '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#order_' . $row['order_id'] . '">';
                    echo 'Order ID: ' . $row['order_id'] . ' - Total Amount: $' . $row['total_amount'];
                    echo '</button>';
                    echo '</h2>';
                    echo '<div id="order_' . $row['order_id'] . '" class="accordion-collapse collapse">';
                    echo '<div class="accordion-body">';
                    echo '<p>Order Date: ' . $row['order_date'] . '</p>';
                    echo '<p>Status: ' . $row['status'] . '</p>';

                    // Fetch order items for the current order
                    $order_id = $row['order_id'];
                    $query_items = "SELECT uc.quantity, s.medicine_name, s.price, uc.medicine_id
                    FROM user_carts uc
                    INNER JOIN stock s ON uc.medicine_id = s.id
                    WHERE uc.orderId = :order_id";
                    $stmt_items = $pdo->prepare($query_items);
                    $stmt_items->bindParam(':order_id', $order_id, PDO::PARAM_INT);
                    $stmt_items->execute();

                    echo '<table class="table">';
                    echo '<thead><tr><th>Medicine Name</th><th>Quantity</th><th>Unit Price</th><th>Total Price</th></tr></thead>';
                    echo '<tbody>';
                    while ($item = $stmt_items->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td>' . $item['medicine_name'] . '</td>';
                        echo '<td>' . $item['quantity'] . '</td>';
                        echo '<td>$' . $item['price'] . '</td>';
                        echo '<td>$' . $item['price'] * $item['quantity'] . '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';

                    // Add the order status change form
                    echo '<form method="post">';
                    echo '<input type="hidden" name="order_id" value="' . $order_id . '">';
                    echo '<div class="mb-3">';
                    echo '<label for="new_status">Change Status:</label>';
                    echo '<select class="form-select" name="new_status">';
                    echo '<option value="pending">Pending</option>';
                    echo '<option value="processing">Processing</option>';
                    echo '<option value="shipped">Shipped</option>';
                    echo '<option value="delivered">Delivered</option>';
                    // Add more status options as needed
                    echo '</select>';
                    echo '</div>';
                    echo '<button type="submit" class="btn btn-primary">Update Status</button>';
                    echo '</form>';

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>You have no pending orders.</p>';
            }
            ?>
        </div>
    </div>

    <?php print($commonFooter)?>
</body>

</html>
