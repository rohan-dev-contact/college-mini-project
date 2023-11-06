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
    <div class="container mt-3 my-class-to-b">
        <div class="gap-2 mb-3 d-inline">
            <a href="address_selection.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i>Back to Address Selection</a>
            <p class="text-center fs-2 fw-bold">Medicine bag</p>
        </div>
        <form action="save_order.php" method="post">
            <!-- Display payment options -->
            <div class="mb-3">
                <label for="payment_method" class="form-label">Select Payment Method</label>
                <select class="form-select" id="payment_method" name="payment_method" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="cash_on_delivery" selected>Cash on Delivery</option>
                </select>
            </div>
            <div id="unavailable_message" class="alert alert-warning" style="display: none;">
                This payment method is currently unavailable.
            </div>

            <!-- Hidden input to pass selected address to save_order.php -->
            <input type="hidden" name="selected_address"
                value="<?php echo htmlentities($_POST['selected_address']); ?>">

            <button id="submit_button" type="submit" class="btn btn-primary" name="complete_order">Complete Order</button>
        </form>

    </div>
    <?php print ($commonFooter)?>
</body>
<script>
    // JavaScript to handle payment method selection
    const paymentMethodSelect = document.getElementById('payment_method');
    const unavailableMessage = document.getElementById('unavailable_message');
    const submitButton = document.getElementById('submit_button');

    paymentMethodSelect.addEventListener('change', function() {
        if (paymentMethodSelect.value !== 'cash_on_delivery') {
            // Show the unavailable message
            unavailableMessage.style.display = 'block';
            submitButton.disabled = true;
        } else {
            // Hide the unavailable message
            unavailableMessage.style.display = 'none';
            submitButton.disabled = false;
        }
    });
</script>

</html>