<?php 
require('../middleware/protected_page.php');
require('../partials/header.php');
require('../partials/navbar.php');
require('../partials/footer.php');

print($header);
?>
<style>
    .cart-container {
        max-height: 300px;
        overflow-y: auto;
    }
    .cart-summary {
        background-color: #f5f5f5;
        padding: 10px;
    }
    .checkout-button-container {
        position: sticky;
        bottom: 0;
        background-color: #fff;
        padding: 10px;
        box-shadow: 0px -5px 5px rgba(0, 0, 0, 0.2);
        display: flex;
        justify-content: space-between;
    }
    .my-class-to-b{
        margin-bottom : 50px
    }
    .checkout-button {
        display: flex;
        justify-content: center;
    }
</style>
<body>
    <?php
    print($commonNav);
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<div class="alert alert-success mt-3" id="success-alert">Cart updated successfully.</div>';
    }
    ?>  
    <div class="container mt-3 my-class-to-b">
        <div class="d-inline mb-3">
            <a href="home.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back to Home</a>
            <p class="text-center fs-2 fw-bold">Medicine Bag</p>
        </div>

        <div class="cart-container">
            <?php
            require('dbConnect.php');
            $user_id = $_SESSION['user_id'];
            $sql_user_cart = "SELECT uc.quantity, s.medicine_name, s.price, uc.medicine_id
                FROM user_carts uc
                INNER JOIN stock s ON uc.medicine_id = s.id
                WHERE uc.user_id = ? and active = 1";
            $stmt_user_cart = $pdo->prepare($sql_user_cart);
            $stmt_user_cart->execute([$user_id]);
            $cart_items = $stmt_user_cart->fetchAll(PDO::FETCH_ASSOC);
            
            if (count($cart_items) > 0) {
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Medicine</th>';
                echo '<th>Price</th>';
                echo '<th>Quantity</th>';
                echo '<th>Update</th>';
                echo '<th>Delete</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($cart_items as $item) {
                    echo '<tr>';
                    echo '<td>' . $item['medicine_name'] . '</td>';
                    echo '<td>$' . $item['price'] . '</td>';
                    echo '<td>' . $item['quantity'] . '</td>';
                    echo '<td>';
                    echo '<form action="update_cart.php" method="post" class="d-flex">';
                    echo '<input type="hidden" name="medicine_id" value="' . $item['medicine_id'] . '">';
                    echo '<input type="number" name="new_quantity" value="' . $item['quantity'] . '" min="1" class="form-control me-2">';
                    echo '<button type="submit" class="btn btn-primary"><i class="bi bi-cloud-arrow-up"></i></button>';
                    echo '</form>';
                    echo '</td>';
                    echo '<td>';
                    echo '<form action="delete_cart.php" method="post" class="d-flex">';
                    echo '<input type="hidden" name="medicine_id" value="' . $item['medicine_id'] . '">';
                    echo '<button type="submit" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>Your cart is empty.</p>';
            }
            ?>
        </div>
        <?php
        if (count($cart_items) > 0) {
            echo '<div class="cart-summary">';
            $total_price = 0;
            $order_data = array(
                'total_price' => 0,
                'total_gst' => 0,
                'delivery_charges' => 0,
                'items' => array()
            );
            foreach ($cart_items as $item) {
                $item_price = $item['price'] * $item['quantity'];
                $order_data['total_price'] += $item_price;
                $order_data['total_gst'] += $item_price * 0.18;
                $order_data['items'][] = array(
                    'medicine_id' => $item['medicine_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item_price,
                    'gst' => $item_price * 0.18,
                    'total' => $item_price * 1.18,
                );
            }
            $order_data['delivery_charges'] = ($order_data['total_price'] < 500) ? ($order_data['total_price'] * 0.05) : 0;
            echo '<p>Total Price: $' . $order_data['total_price'] . '</p>';
            echo '<p>GST (18%): $' . $order_data['total_gst'] . '</p>';
            if ($order_data['delivery_charges'] > 0) {
                echo '<p>Delivery Charges: $' . $order_data['delivery_charges'] . '</p>';
            }
            $order_data['total_price'] = $order_data['total_price'] + $order_data['delivery_charges'];
            echo '<h4>Grand Total: $' . $order_data['total_price'] . '</h4>';
        //    echo ' <div class="checkout-button-container">';
        //    echo ' <div class="checkout-button">';
           echo '     <a href="address_selection.php" class="btn btn-outline-primary">Checkout</a>';
        //    echo ' </div>';
        //    echo '</div>';
            echo '</div>';
        }
        ?>
        
    </div>
    <script>
        var successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.style.display = 'block';
            setTimeout(function() {
                successAlert.style.display = 'none';
            }, 2000);
        }
    </script>
    <?php print ($commonFooter)?>
</body>
</html>
