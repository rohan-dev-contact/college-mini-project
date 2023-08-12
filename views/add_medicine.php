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

<body>
    <?php
    print($adminNav);
    ?>
    
    <div class="col-md-6 offset-md-3">
                    <form method="post" action="process_add_stock.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="medicine_name" class="form-label">Medicine Name</label>
                            <input type="text" class="form-control" id="medicine_name" name="medicine_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="unit" class="form-label">Unit</label>
                            <input type="number" class="form-control" id="unit" name="unit" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="expiration_date" class="form-label">Expiration Date</label>
                            <input type="date" class="form-control" id="expiration_date" name="expiration_date">
                        </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control" id="notes" name="notes"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Stock</button>
                    </form>
                </div>
    <?php print ($commonFooter)?>
</body>

</html>