<?php
require('../middleware/protected_page.php');

require('../partials/header.php');
require('../partials/navbar.php');
require('../partials/footer.php');
// session_start();
print($header);
?>

<body>
    <?php
    print($commonNav);
    ?>

    <div class="container">
    <a href="user.php"class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i></a>
        <h2><?php print_r($_SESSION["name"]);?></h2>

        <h2>Complete Orders</h2>

    <?php
        require('dbConnect.php'); // Include your database connection

        $user_id = $_SESSION["user_id"]; // Replace with the actual user ID
        $query = "SELECT * FROM orders WHERE user_id = :user_id AND status = 'delivered'";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
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
                echo '<a href="view_invoice.php?order_id=';
                echo $row['order_id'];
                echo 'class="btn btn-primary" target="_blank">View Invoice</a>';
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
                
                // Display more order details as needed
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
    
    <?php print ($commonFooter)?>
</body>

</html>