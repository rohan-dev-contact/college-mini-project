<?php
require('../middleware/protected_page.php');
require('../partials/header.php');
require('../partials/navbar.php');
require('../partials/footer.php');
print($header);
?>

<body>
     <?php
    print($loginNav);
    ?>

    <div class="container">
        <!-- <a href="user.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i></a>
        <h2><?//php print_r($_SESSION["name"]); ?></h2> -->
        <!-- <h2>Invoice</h2> -->

        <?php
        require('dbConnect.php');

        if (isset($_GET['order_id'])) {
            $order_id = $_GET['order_id'];

            $query = "SELECT * FROM orders WHERE order_id = :order_id AND user_id = :user_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $_SESSION["user_id"], PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
                <!-- Display invoice details -->
                <div class="invoice">
                    <h3>Invoice for Order ID: <?php echo $row['order_id']; ?></h3>
                    <p>Order Date: <?php echo $row['order_date']; ?></p>
                    <p>Status: <?php echo $row['status']; ?></p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Medicine Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $order_id = $row['order_id'];
                            $query_items = "SELECT uc.quantity, s.medicine_name, s.price, uc.medicine_id
                                            FROM user_carts uc
                                            INNER JOIN stock s ON uc.medicine_id = s.id
                                            WHERE uc.orderId = :order_id";
                            $stmt_items = $pdo->prepare($query_items);
                            $stmt_items->bindParam(':order_id', $order_id, PDO::PARAM_INT);
                            $stmt_items->execute();

                            $totalAmount = 0; // Initialize the total amount variable

                            while ($item = $stmt_items->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                echo '<td>' . $item['medicine_name'] . '</td>';
                                echo '<td>' . $item['quantity'] . '</td>';
                                echo '<td>$' . $item['price'] . '</td>';
                                $itemTotal = $item['price'] * $item['quantity'];
                                echo '<td>$' . $itemTotal . '</td>';
                                echo '</tr>';

                                // Add the current item's total to the total amount
                                $totalAmount += $itemTotal;
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- Display the total amount -->
                    <p>Total Amount: $<?php echo $totalAmount; ?></p>
                    <button type="button" class="btn btn-primary" onclick="window.print();">Print Invoice</button>
                </div>
        <?php
            } else {
                echo '<p>Invoice not found.</p>';
            }
        } else {
            echo '<p>Invalid request.</p>';
        }
        ?>
    </div>

    <?php print($commonFooter); ?>
</body>

</html>
